<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks;

class routes extends parent_route
{
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

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
		parent::__construct($cache, $config, $mapper_factory, $php_ext);

		$this->cache = $cache;
		$this->block_factory = $block_factory;
		$this->mapper_factory = $mapper_factory;
		$this->php_ext = $php_ext;
	}

	/**
	 * @param string $current_route
	 * @param string $page_dir
	 * @param int $forum_id
	 * @param int $style_id
	 * @param bool $edit_mode
	 * @return array
	 */
	public function get_route_info($current_route, $page_dir, $forum_id, $style_id, $edit_mode = false)
	{
		$routes = $this->get_routes_for_style($style_id);
		$current_route = str_replace('viewtopic.' . $this->php_ext, 'viewforum.' . $this->php_ext, $current_route);
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

		return $this->inherit_route_info($routes, $route_info, $current_route, $page_dir, $forum_id, $style_id);
	}

	/**
	 * @param array $route_info
	 * @param bool $edit_mode
	 * @return array
	 */
	public function get_blocks_for_route(array $route_info, $edit_mode)
	{
		$blocks = $this->get_cached_blocks($edit_mode);
		$route_id = $route_info['route_id'];
		$style_id = $route_info['style'];

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
