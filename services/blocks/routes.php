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

	/** @var \blitze\sitemaker\services\blocks\factory */
	protected $block_factory;

	/** @var \blitze\sitemaker\model\mapper_factory */
	protected $mapper_factory;

	/** @var string */
	protected $php_ext;

	/** @var bool */
	protected $is_sub_route = false;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\driver\driver_interface			$cache					Cache driver interface
	 * @param \phpbb\config\config							$config					Config object
	 * @param \blitze\sitemaker\services\blocks\factory		$block_factory			Blocks factory object
	 * @param \blitze\sitemaker\model\mapper_factory		$mapper_factory			Mapper factory object
	 * @param string										$php_ext				phpEx
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\config\config $config, \blitze\sitemaker\services\blocks\factory $block_factory, \blitze\sitemaker\model\mapper_factory $mapper_factory, $php_ext)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->block_factory = $block_factory;
		$this->mapper_factory = $mapper_factory;
		$this->php_ext = $php_ext;
	}

	/**
	 * @param string $current_route
	 * @param string $page_dir
	 * @param int $style_id
	 * @param bool $edit_mode
	 * @return array
	 */
	public function get_route_info($current_route, $page_dir, $style_id, $edit_mode = false)
	{
		$routes = $this->get_routes_for_style($style_id);
		$route_info = array();

		// does route have own settings?
		if (isset($routes[$current_route]))
		{
			$route_info = $routes[$current_route];
		}

		if ($edit_mode)
		{
			$route_info += $this->get_default_route_info($current_route, $style_id);
			return $route_info;
		}

		return $this->inherit_route_info($routes, $route_info, $current_route, $page_dir, $style_id);
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
		$route_id = $route_info['route_id'];

		return (isset($blocks[$style_id][$route_id])) ? $blocks[$style_id][$route_id] : array();
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
	 * @param array $routes
	 * @param array $route_info
	 * @param string $current_route
	 * @param string $page_dir
	 * @param int $style_id
	 * @return array
	 */
	protected function inherit_route_info(array $routes, array $route_info, $current_route, $page_dir, $style_id)
	{
		// if block does not have own settings, inherit settings from parent route if it exists
		// if block has own settings but no blocks, inherit route_id and has_blocks from parent route if it exists
		if (empty($route_info['has_blocks']))
		{
			unset($route_info['route_id'], $route_info['has_blocks']);
			$route_info += $this->get_parent_route($routes, $current_route, $page_dir);
		}

		// fill in missing fields, while forcing route and style props to current route and style
		unset($route_info['style'], $route_info['route']);
		$route_info += $this->get_default_route_info($current_route, $style_id);

		return $this->set_display_route_id($routes, $route_info);
	}

	/**
	 * @param string $current_route
	 * @param int $style_id
	 * @return array
	 */
	protected function get_default_route_info($current_route, $style_id)
	{
		return array(
			'route_id'		=> 0,
			'route'			=> $current_route,
			'style'			=> $style_id,
			'hide_blocks'	=> false,
			'ex_positions'	=> array(),
			'has_blocks'	=> false,
			'is_sub_route'	=> $this->is_sub_route,
		);
	}

	/**
	 * @param array $routes
	 * @param string $current_route
	 * @param string $page_dir
	 * @return array
	 */
	protected function get_parent_route(array $routes, $current_route, $page_dir)
	{
		if ($page_dir)
		{
			$route = ltrim(dirname($page_dir) . '/index.php', './');
			$parent_route = $this->get_parent_route_info($routes, $route);
		}
		else if ($current_route === 'viewtopic.' . $this->php_ext)
		{
			$route = 'viewforum.' . $this->php_ext;
			$parent_route = $this->get_parent_route_info($routes, $route);
		}
		else
		{
			$parent_route = $this->get_virtual_parent($routes, $current_route);
		}

		return $parent_route;
	}

	/**
	 * @param array $routes_data
	 * @param string $current_route
	 * @return array
	 */
	protected function get_virtual_parent(array $routes_data, $current_route)
	{
		$routes = array_keys($routes_data);
		$routes[] = $current_route;
		sort($routes);
		$index = (int) array_search($current_route, $routes);

		$parent_route = array();
		if (isset($routes[$index - 1]) && strpos($current_route, $routes[$index - 1]) !== false)
		{
			$parent_route = $routes_data[$routes[$index - 1]];
			$this->is_sub_route = $parent_route['has_blocks'];
		}

		return $parent_route;
	}

	/**
	 * @param array $routes
	 * @param string $route
	 * @return array
	 */
	protected function get_parent_route_info(array $routes, $route)
	{
		$route_info = array();
		if (isset($routes[$route]))
		{
			$this->is_sub_route = $routes[$route]['has_blocks'];
			$route_info = $routes[$route];
		}

		return $route_info;
	}

	/**
	 * We get blocks to display by route id, so we update the route id here,
	 * to show blocks from default route if current route or it's parent has no blocks
	 *
	 * @param array $routes
	 * @param array $route_info
	 * @return array
	 */
	protected function set_display_route_id(array $routes, array $route_info)
	{
		$default_route = $this->config['sitemaker_default_layout'];
		if (!$route_info['has_blocks'] && isset($routes[$default_route]))
		{
			$route_info['route_id'] = $routes[$default_route]['route_id'];
		}

		return $route_info;
	}

	/**
	 * @param array $condition
	 * @return array
	 */
	protected function get_all_blocks(array $condition)
	{
		$collection = $this->mapper_factory->create('blocks')->find($condition);

		$blocks = array();
		foreach ($collection as $entity)
		{
			if (($block_instance = $this->block_factory->get_block($entity->get_name())) !== null)
			{
				$default_settings = $block_instance->get_config(array());
				$settings = $this->sync_settings($default_settings, $entity->get_settings());
				$entity->set_settings($settings);

				$blocks[$entity->get_style()][$entity->get_route_id()][$entity->get_position()][] = $entity;
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
			$route_mapper = $this->mapper_factory->create('routes');
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
	 * @param int $style_id
	 * @return array
	 */
	protected function get_routes_for_style($style_id)
	{
		$all_routes = $this->get_all_routes();
		return (isset($all_routes[$style_id])) ? $all_routes[$style_id] : array();
	}

	/**
	 * @param bool $edit_mode
	 * @return array
	 */
	protected function get_cached_blocks($edit_mode)
	{
		if (($blocks = $this->cache->get('sitemaker_blocks')) === false || $edit_mode)
		{
			$condition = (!$edit_mode) ? array('status', '=', 1) : array();
			$blocks = $this->get_all_blocks($condition);
			$this->cache_block($blocks, $edit_mode);
		}

		return $blocks;
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
