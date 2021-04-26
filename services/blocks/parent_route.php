<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2021 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks;

class parent_route
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
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\config\config $config, \blitze\sitemaker\model\mapper_factory $mapper_factory, $php_ext)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->mapper_factory = $mapper_factory;
		$this->php_ext = $php_ext;
	}

	/**
	 * @param array $routes
	 * @param array $route_info
	 * @param string $current_route
	 * @param string $page_dir
	 * @param int $forum_id
	 * @param int $style_id
	 * @return array
	 */
	protected function inherit_route_info(array $routes, array $route_info, $current_route, $page_dir, $forum_id, $style_id)
	{
		// if block does not have own settings, inherit settings from parent route if it exists
		// if block has own settings but no blocks, inherit route_id and has_blocks from parent route if it exists
		if (empty($route_info['has_blocks']))
		{
			if ($parent_route_info = $this->get_parent_route($routes, $current_route, $page_dir, $forum_id))
			{
				$this->is_sub_route = $parent_route_info['has_blocks'];
				$route_info['route_id'] = $parent_route_info['route_id'];
				$route_info['has_blocks'] = $parent_route_info['has_blocks'];
			}
		}

		// fill in missing fields, while forcing route and style props to current route and style
		unset($route_info['style'], $route_info['route']);
		$route_info += $this->get_default_route_info($current_route, $style_id);

		return $this->set_display_route_id($style_id, $route_info);
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
			'ext_name'		=> '',
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
	 * @param int $forum_id
	 * @return array
	 */
	protected function get_parent_route(array $routes, $current_route, $page_dir, $forum_id)
	{
		if ($page_dir)
		{
			return $this->get_parent_directory_route_info($routes, $current_route, $page_dir);
		}
		else if ($forum_id)
		{
			return $this->get_parent_forum_route_info($forum_id, $routes);
		}

		return $this->get_parent_app_route_info($routes, $current_route);
	}

	/**
	 * @param array $routes
	 * @param string $current_route
	 * @param string $page_dir
	 * @return null|array
	 */
	protected function get_parent_directory_route_info(array $routes, $current_route, $page_dir)
	{
		$parent_dir = ltrim(dirname($page_dir) . '/index.php', './');
		return (isset($routes[$parent_dir])) ? $routes[$parent_dir] : null;
	}

	/**
	 * @param int $forum_id
	 * @param array $routes
	 * @return null|array
	 */
	protected function get_parent_forum_route_info($forum_id, array $routes)
	{
		$forumslist = (array) make_forum_select(false, false, true, false, false, false, true);

		do
		{
			$forum_id = &$forumslist[$forum_id]['parent_id'];
			$route = "viewforum.{$this->php_ext}?f={$forum_id}";

			if ($this->route_has_blocks($routes, $route))
			{
				return $routes[$route];
			}
		} while ($forum_id);

		return null;
	}

	/**
	 * @param array $routes
	 * @param string $route
	 * @return bool
	 */
	protected function route_has_blocks(array $routes, $route)
	{
		return isset($routes[$route]) && $routes[$route]['has_blocks'];
	}

	/**
	 * @param array $routes_data
	 * @param string $current_route
	 * @return null|array
	 */
	protected function get_parent_app_route_info(array $routes_data, $current_route)
	{
		$routes = array_keys($routes_data);

		// We add the current route to the list and sort it in ascending order
		// Its parent will likely come before it in the list
		// Eg if current route is 'app.php/content/news' the route list might be:
		// ['app.php/content', 'app.php/content/category/cars', 'app.php/content/news', 'index.php']
		$routes[] = $current_route;
		sort($routes);

		// We find the position of the current route in the list
		$index = (int) array_search($current_route, $routes);

		// we use it as our starting point and walk backwords to find the immediate parent
		// in this case 'app.php/content'
		for ($i = $index - 1; $i >= 0; $i--)
		{
			if (strpos($current_route, $routes[$i]) !== false)
			{
				return $routes_data[$routes[$i]];
			}
		}

		return null;
	}

	/**
	 * We get blocks to display by route id and style id, so we update the route id here,
	 * to show blocks from default route if current route or it's parent has no blocks
	 *
	 * @param int $style_id
	 * @param array $route_info
	 * @return array
	 */
	protected function set_display_route_id($style_id, array $route_info)
	{
		if (!$route_info['has_blocks'] && ($default = $this->get_inherited_route_info($style_id)))
		{
			$route_info['route_id'] = $default['route_id'];
			$route_info['style'] = $default['style'];
		}

		return $route_info;
	}

	/**
	 * @param int $current_style_id
	 * @return int
	 */
	protected function get_inherited_route_info($current_style_id)
	{
		[$route, $style_id] = array_filter(explode(':', $this->config['sitemaker_default_layout'])) + array('', $current_style_id);
		$routes = $this->get_all_routes();

		return (isset($routes[$style_id]) && isset($routes[$style_id][$route])) ? $routes[$style_id][$route] : 0;
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
}
