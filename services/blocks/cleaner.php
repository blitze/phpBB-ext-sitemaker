<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks;

class cleaner implements cleaner_interface
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \blitze\sitemaker\services\blocks\manager */
	protected $manager;

	/** @var \blitze\sitemaker\services\blocks\routes */
	protected $routes;

	/** @var \blitze\sitemaker\services\url_checker */
	protected $url_checker;

	/** @var string */
	protected $blocks_table;

	/** @var string */
	protected $cblocks_table;

	/** @var bool */
	protected $is_dry_run = false;

	/** @var array */
	protected $orphaned = [];

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config							$config				Config object
	 * @param \phpbb\db\driver\driver_interface				$db					Database object
	 * @param \blitze\sitemaker\services\blocks\manager		$manager			Blocks manager object
	 * @param \blitze\sitemaker\services\blocks\routes		$routes				Blocks routes object
	 * @param \blitze\sitemaker\services\url_checker		$url_checker		Url checker object
	 * @param string										$blocks_table		Name of blocks database table
	 * @param string										$cblocks_table		Name of custom blocks database table
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \blitze\sitemaker\services\blocks\manager $manager, \blitze\sitemaker\services\blocks\routes $routes, \blitze\sitemaker\services\url_checker $url_checker, $blocks_table, $cblocks_table)
	{
		$this->config = $config;
		$this->db = $db;
		$this->manager = $manager;
		$this->routes = $routes;
		$this->url_checker = $url_checker;
		$this->blocks_table = $blocks_table;
		$this->cblocks_table = $cblocks_table;
	}

	/**
	 * @inheritdoc
	 */
	public function run(array $components)
	{
		// force order of components here
		$components = array_intersect(['styles', 'routes', 'blocks'], $components);

		foreach ($components as $component)
		{
			$method = 'clean_' . $component;
			if (is_callable(array($this, $method)))
			{
				call_user_func(array($this, $method));
			}
		}

		$this->config->set('sm_orphaned_blocks', '');
	}

	/**
	 * @inheritdoc
	 */
	public function test()
	{
		$this->is_dry_run = true;
		$this->orphaned = [];
		$this->run(['blocks', 'routes', 'styles']);
		$this->clean_custom_blocks();

		$this->config->set('sm_orphaned_blocks', sizeof($this->orphaned) ? json_encode($this->orphaned) : '');
	}
	/**
	 * @return null|array
	 */
	public function get_orphans()
	{
		return ($this->config['sm_orphaned_blocks']) ? json_decode($this->config['sm_orphaned_blocks'], true) : null;
	}

	/**
	 * Removes all block routes and blocks belonging to these routes for styles that no longer exist
	 * @return void
	 */
	protected function clean_styles()
	{
		$routes_ary	= array_keys($this->manager->get_routes('style'));
		$style_ids	= $this->get_style_ids();
		$col_widths	= (array) json_decode($this->config['sitemaker_column_widths'], true);

		foreach ($routes_ary as $style_id)
		{
			// Style no longer exists => remove all routes and blocks for style
			if (!isset($style_ids[$style_id]))
			{
				$this->orphaned['styles'][] = $style_id;

				// we let the user confirm that they want to delete blocks for unavailable style as it may be temporary
				if (!$this->is_dry_run)
				{
					$this->manager->delete_blocks_by_style($style_id);
					unset($col_widths[$style_id]);
				}
			}
		}

		$this->config->set('sitemaker_column_widths', json_encode(array_filter($col_widths)));
	}

	/**
	 * Removes all blocks for routes that no longer exist
	 * @return void
	 */
	protected function clean_routes()
	{
		$board_url = generate_board_url();
		$routes	= array_keys($this->manager->get_routes('route'));
		$forumslist = (array) make_forum_select(false, false, true, false, false, false, true);

		foreach ($routes as $route)
		{
			// Route no longer exists => remove all blocks for route
			if (!$this->route_exists($route, $board_url, $forumslist))
			{
				// we dry_run this via cron because routes may be temporarily unreachable for any number of reasons
				if (!$this->is_dry_run)
				{
					$this->manager->delete_blocks_by_route($route);
				}
			}
		}
	}

	/**
	 * Removes all blocks that (the service) no longer exist
	 * @return void
	 */
	protected function clean_blocks()
	{
		$block_names = $this->manager->get_unique_block_names();

		$blocks = array();
		foreach ($block_names as $block_name)
		{
			if (!$this->manager->block_exists($block_name))
			{
				$blocks[] = $block_name;
			}
		}

		if (sizeof($blocks))
		{
			// We dry_run this via cron because the block service might only be temporarily unavailable
			// such as when updating (disable/re-enable) the extension that provides the block
			if (!$this->is_dry_run)
			{
				$this->manager->delete_blocks_by_name($blocks);
			}
			$this->orphaned['blocks'] = $blocks;
		}
	}

	/**
	 * Removes from custom blocks table, any custom blocks no longer present in blocks table
	 * @return void
	 */
	protected function clean_custom_blocks()
	{
		$sql = $this->db->sql_build_query('SELECT', array(
			'SELECT'	=> 'cb.block_id',
			'FROM'		=> array(
				$this->cblocks_table    => 'cb',
			),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array($this->blocks_table => 'b'),
					'ON'	=> 'b.bid = cb.block_id',
				)
			),
			'WHERE'		=> 'b.bid IS NULL'
		));
		$result = $this->db->sql_query($sql);

		$block_ids = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$block_ids[] = $row['block_id'];
		}
		$this->db->sql_freeresult($result);

		if (sizeof($block_ids))
		{
			$this->db->sql_query('DELETE FROM ' . $this->cblocks_table . ' WHERE ' . $this->db->sql_in_set('block_id', $block_ids));
		}
	}

	/**
	 * @return array
	 */
	protected function get_style_ids()
	{
		$sql = 'SELECT style_id, style_name
			FROM ' . STYLES_TABLE;
		$result = $this->db->sql_query($sql);

		$style_ids = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$style_ids[$row['style_id']] = $row['style_name'];
		}
		$this->db->sql_freeresult($result);

		return $style_ids;
	}

	/**
	 * @param string $route
	 * @param string $board_url
	 * @param array $forumslist
	 * @return bool
	 */
	protected function route_exists($route, $board_url, array $forumslist)
	{
		if (!$this->routes->is_forum_route($route))
		{
			return $this->url_exists($route, $board_url);
		}

		return $this->forum_exists($route, $board_url, $forumslist);
	}

	/**
	 * @param string $route
	 * @param string $board_url
	 * @return bool
	 */
	protected function url_exists($route, $board_url)
	{
		$url = $board_url . '/' . $route;
		if (!$this->url_checker->exists($url))
		{
			$this->orphaned['routes'][] = $url;
			return false;
		}

		return true;
	}

	/**
	 * @param string $route
	 * @param string $board_url
	 * @param array $forumslist
	 * @return bool
	 */
	protected function forum_exists($route, $board_url, array $forumslist)
	{
		[$file, $forum_id] = explode('?f=', $route);
		
		if (!isset($forumslist[$forum_id]))
		{
			$this->orphaned['routes'][] = $board_url . '/' . $file . '?f=' . $forum_id;
			return false;
		}

		return true;
	}
}
