<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks;

class routes
{
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\blocks\factory */
	protected $block_factory;

	/** @var \blitze\sitemaker\model\mapper_factory */
	protected $mapper_factory;

	/** @var string phpEx */
	protected $php_ext;

	public $sub_route = false;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\driver\driver_interface			$cache					Cache driver interface
	 * @param \phpbb\config\config							$config					Config object
	 * @param \phpbb\user									$user					User object
	 * @param \blitze\sitemaker\services\blocks\factory		$block_factory			Blocks factory object
	 * @param \blitze\sitemaker\model\mapper_factory		$mapper_factory			Mapper factory object
	 * @param string										$php_ext				phpEx
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\config\config $config, \phpbb\user $user, \blitze\sitemaker\services\blocks\factory $block_factory, \blitze\sitemaker\model\mapper_factory $mapper_factory, $php_ext)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->user = $user;
		$this->block_factory = $block_factory;
		$this->mapper_factory = $mapper_factory;
		$this->php_ext = $php_ext;
	}

	/**
	 * @param string $current_route
	 * @param string $page_dir
	 * @param int $style_id
	 * @param bool|false $edit_mode
	 * @return array
	 */
	public function get_route_info($current_route, $page_dir, $style_id, $edit_mode = false)
	{
		$all_routes = $this->get_all_routes();

		$is_sub_route = false;
		if (isset($all_routes[$style_id][$current_route]))
		{
			$route_info = $all_routes[$style_id][$current_route];
		}
		else
		{
			$route_info = $this->get_default_route_info($all_routes, $current_route, $page_dir, $style_id, $edit_mode, $is_sub_route);
		}
		$route_info['is_sub_route'] = $is_sub_route;

		return $route_info;
	}

	/**
	 * @param array $route_info
	 * @param int $style_id
	 * @param bool $edit_mode
	 * @return array
	 */
	public function get_blocks_for_route(array $route_info, $style_id, $edit_mode)
	{
		$blocks = $this->get_cached_blocks($edit_mode);
		$route_id = $this->get_display_route_id($route_info, $style_id, $edit_mode);

		return (isset($blocks[$style_id][$route_id]) && !$route_info['hide_blocks']) ? $blocks[$style_id][$route_id] : array();
	}

	/**
	 * @param array $df_settings
	 * @param array $db_settings
	 * @return array
	 */
	public function sync_settings(array $df_settings, array $db_settings = array())
	{
		$settings = array();
		foreach ($df_settings as $field => $vars)
		{
			if (!is_array($vars))
			{
				continue;
			}
			$settings[$field] = $vars['default'];
		}

		return array_merge($settings, array_intersect_key($db_settings, $settings));
	}

	/**
	 * Clear blocks cache
	 */
	public function clear_cache()
	{
		$this->cache->destroy('sitemaker_blocks');
		$this->cache->destroy('sitemaker_block_routes');
	}

	/**
	 * @param bool $edit_mode
	 * @return array
	 */
	protected function get_cached_blocks($edit_mode)
	{
		if (($blocks = $this->cache->get('sitemaker_blocks')) === false || $edit_mode)
		{
			$blocks = $this->get_all_blocks();
			$this->cache_block($blocks, $edit_mode);
		}

		return $blocks;
	}

	/**
	 * @return array
	 */
	protected function get_all_blocks()
	{
		$block_mapper = $this->mapper_factory->create('blocks', 'blocks');
		$collection = $block_mapper->find();

		$blocks = array();
		foreach ($collection as $entity)
		{
			if (($block_instance = $this->block_factory->get_block($entity->get_name())) !== null)
			{
				$default_settings = $block_instance->get_config(array());
				$settings = $this->sync_settings($default_settings, $entity->get_settings());

				$entity->set_settings($settings);

				$style = $entity->get_style();
				$route_id = $entity->get_route_id();
				$position = $entity->get_position();

				$blocks[$style][$route_id][$position][] = $entity;
			}
		}

		return $blocks;
	}

	/**
	 * @return array|mixed
	 */
	protected function get_all_routes()
	{
		if (($all_routes = $this->cache->get('sitemaker_block_routes')) === false)
		{
			$route_mapper = $this->mapper_factory->create('blocks', 'routes');
			$collection = $route_mapper->find();

			$all_routes = array();
			foreach ($collection as $entity)
			{
				$route = $entity->get_route();
				$style = $entity->get_style();
				$all_routes[$style][$route] = $entity->to_array();
			}

			$this->cache->put('sitemaker_block_routes', $all_routes);
		}

		return $all_routes;
	}

	/**
	 * @param array $all_routes
	 * @param string $current_route
	 * @param string $page_dir
	 * @param int $style_id
	 * @param bool $edit_mode
	 * @return array
	 */
	protected function get_default_route_info(array $all_routes, $current_route, $page_dir, $style_id, $edit_mode, &$is_sub_route)
	{
		$default_info = array(
			'route_id'		=> 0,
			'hide_blocks'	=> false,
			'ex_positions'	=> array(),
			'has_blocks'	=> false,
		);

		if (!$edit_mode)
		{
			$default_route = $this->get_parent_route($all_routes, $current_route, $page_dir, $style_id, $is_sub_route);
			$default_info = (isset($all_routes[$style_id][$default_route])) ? $all_routes[$style_id][$default_route] : $default_info;
		}

		$default_info['route'] = $current_route;
		$default_info['style'] = $style_id;

		return $default_info;
	}

	/**
	 * @param array $all_routes
	 * @param string $current_route
	 * @param string $page_dir
	 * @param int $style_id
	 * @param bool $is_sub_route
	 * @return string
	 */
	protected function get_parent_route(array $all_routes, $current_route, $page_dir, $style_id, &$is_sub_route)
	{
		if ($page_dir)
		{
			$is_sub_route = true;
			$parent_route = ltrim(dirname($page_dir) . '/index.php', './');
		}
		else
		{
			$routes = $this->get_routes_for_style($all_routes, $style_id);
			$parent_route = $this->get_virtual_parent($routes, $current_route, $is_sub_route);
		}

		return $parent_route;
	}

	/**
	 * @param array $routes
	 * @param string $current_route
	 * @param bool $is_sub_route
	 * @return string
	 */
	protected function get_virtual_parent(array $routes, $current_route, &$is_sub_route)
	{
		$routes[$current_route] = array();
		$routes = array_keys($routes);
		sort($routes);
		$index = (int) array_search($current_route, $routes);

		$parent_route = '';
		if (isset($routes[$index - 1]) && strpos($current_route, $routes[$index - 1]) !== false)
		{
			$is_sub_route = true;
			$parent_route = $routes[$index - 1];
		}

		return $parent_route;
	}

	/**
	 * @param array $all_routes
	 * @param int $style_id
	 * @return array
	 */
	protected function get_routes_for_style(array $all_routes, $style_id)
	{
		return (isset($all_routes[$style_id])) ? $all_routes[$style_id] : array();
	}

	/**
	 * @param array $route_info
	 * @param int $style_id
	 * @param bool $edit_mode
	 * @return int
	 */
	protected function get_display_route_id(array $route_info, $style_id, $edit_mode)
	{
		$route_id = $route_info['route_id'];
		if ($edit_mode === false && !$route_info['has_blocks'])
		{
			$default_route = $this->get_route_info($this->config['sitemaker_default_layout'], '', $style_id, $edit_mode);
			$route_id = $default_route['route_id'];
		}

		return (int) $route_id;
	}

	/**
	 * @param array $blocks
	 * @param bool $edit_mode
	 */
	protected function cache_block(array $blocks, $edit_mode)
	{
		if ($edit_mode === false)
		{
			$this->cache->put('sitemaker_blocks', $blocks);
		}
	}
}
