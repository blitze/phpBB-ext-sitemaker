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

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\driver\driver_interface			$cache					Cache driver interface
	 * @param \phpbb\config\config							$config					Config object
	 * @param \blitze\sitemaker\services\blocks\factory		$block_factory			Blocks factory object
	 * @param \blitze\sitemaker\model\mapper_factory		$mapper_factory			Mapper factory object
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\config\config $config, \blitze\sitemaker\services\blocks\factory $block_factory, \blitze\sitemaker\model\mapper_factory $mapper_factory)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->block_factory = $block_factory;
		$this->mapper_factory = $mapper_factory;
	}

	/**
	 * @param string $current_route
	 * @param int $style_id
	 * @param bool|false $edit_mode
	 * @return array
	 */
	public function get_route_info($current_route, $style_id, $edit_mode = false)
	{
		$all_routes = $this->_get_all_routes();

		if (isset($all_routes[$style_id][$current_route]))
		{
			return $all_routes[$style_id][$current_route];
		}
		else
		{
			return $this->_get_default_route_info($all_routes, $current_route, $style_id, $edit_mode);
		}
	}

	/**
	 * @param array $route_info
	 * @param int $style_id
	 * @param bool $edit_mode
	 * @return array
	 */
	public function get_blocks_for_route(array $route_info, $style_id, $edit_mode)
	{
		$blocks = $this->_get_cached_blocks($edit_mode);
		$route_id = $this->_get_display_route_id($route_info, $style_id, $edit_mode);

		return (isset($blocks[$style_id][$route_id]) && !$route_info['hide_blocks']) ? $blocks[$style_id][$route_id] : array();
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
	protected function _get_cached_blocks($edit_mode)
	{
		if (($blocks = $this->cache->get('sitemaker_blocks')) === false || $edit_mode)
		{
			$blocks = $this->_get_all_blocks();
			$this->_cache_block($blocks, $edit_mode);
		}

		return $blocks;
	}

	/**
	 * @return array
	 */
	protected function _get_all_blocks()
	{
		$block_mapper = $this->mapper_factory->create('blocks', 'blocks');
		$collection = $block_mapper->find();

		$blocks = array();
		foreach ($collection as $entity)
		{
			if ($block_instance = $this->block_factory->get_block($entity->get_name()))
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
	protected function _get_all_routes()
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
	 * @param int $style_id
	 * @param bool $edit_mode
	 * @return array
	 */
	protected function _get_default_route_info(array $all_routes, $current_route, $style_id, $edit_mode)
	{
		$default_route = $this->config['sitemaker_default_layout'];
		$default_info = array(
			'route_id'		=> 0,
			'route'			=> $current_route,
			'style'			=> $style_id,
			'hide_blocks'	=> false,
			'ex_positions'	=> array(),
			'has_blocks'	=> false,
		);

		return ($edit_mode === false && isset($all_routes[$style_id][$default_route])) ? $all_routes[$style_id][$default_route] : $default_info;
	}

	/**
	 * @param array $route_info
	 * @param int $style_id
	 * @param bool $edit_mode
	 * @return int
	 */
	protected function _get_display_route_id(array $route_info, $style_id, $edit_mode)
	{
		$route_id = $route_info['route_id'];
		if ($edit_mode === false && !$route_info['has_blocks'])
		{
			$default_route = $this->get_route_info($this->config['sitemaker_default_layout'], $style_id, $edit_mode);
			$route_id = $default_route['route_id'];
		}

		return (int) $route_id;
	}

	/**
	 * @param array $blocks
	 * @param bool $edit_mode
	 */
	protected function _cache_block(array $blocks, $edit_mode)
	{
		if (!$edit_mode)
		{
			$this->cache->put('sitemaker_blocks', $blocks);
		}
	}
}
