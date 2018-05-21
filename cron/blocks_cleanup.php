<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\cron;

class blocks_cleanup extends \phpbb\cron\task\base
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \blitze\sitemaker\services\blocks\manager */
	protected $manager;

	/** @var \blitze\sitemaker\services\url_checker */
	protected $url_checker;

	/** @var string */
	protected $blocks_table;

	/** @var string */
	protected $cblocks_table;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config						$config					Config object
	 * @param \phpbb\db\driver\driver_interface			$db						Database object
	 * @param \blitze\sitemaker\services\blocks\manager	$manager				Blocks manager object
	 * @param \blitze\sitemaker\services\url_checker	$url_checker			Url checker object
	 * @param string									$blocks_table			Name of blocks database table
	 * @param string									$cblocks_table			Name of custom blocks database table
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \blitze\sitemaker\services\blocks\manager $manager, \blitze\sitemaker\services\url_checker $url_checker, $blocks_table, $cblocks_table)
	{
		$this->config = $config;
		$this->db = $db;
		$this->manager = $manager;
		$this->url_checker = $url_checker;
		$this->blocks_table = $blocks_table;
		$this->cblocks_table = $cblocks_table;
	}

	/**
	 * Runs this cron task.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->config->set('sitemaker_blocks_cleanup_last_gc', time());

		$routes = $this->clean_styles();
		$this->clean_routes($routes);
		$this->clean_blocks();
		$this->clean_custom_blocks();
	}

	/**
	 * Returns whether this cron task can run, given current board configuration.
	 *
	 * @return bool
	 */
	public function is_runnable()
	{
		return true;
	}

	/**
	 * Returns whether this cron task should run now, because enough time
	 * has passed since it was last run.
	 *
	 * @return bool
	 */
	public function should_run()
	{
		return (int) $this->config['sitemaker_blocks_cleanup_last_gc'] < time() - (int) $this->config['sitemaker_blocks_cleanup_gc'];
	}

	/**
	 * Removes all block routes and blocks belonging to these routes for styles that no longer exist
	 * @return array[]
	 */
	private function clean_styles()
	{
		$routes_ary	= $this->manager->get_routes_per_style();
		$style_ids	= $this->get_style_ids();

		$routes = array();
		foreach ($routes_ary as $style_id => $style_routes)
		{
			// Style no longer exists => remove all routes and blocks for style
			if (!isset($style_ids[$style_id]))
			{
				$this->manager->delete_blocks_by_style($style_id);

				continue;
			}

			$routes += $style_routes;
		}

		return $routes;
	}

	/**
	 * Removes all blocks for routes that no longer exist
	 * @param array $routes
	 * @return void
	 */
	private function clean_routes(array $routes)
	{
		$board_url = generate_board_url();

		foreach ($routes as $route => $row)
		{
			$url = $board_url . '/' . $row['route'];

			// Route no longer exists => remove all blocks for route
			if ($this->url_checker->exists($url) !== true)
			{
				$this->manager->delete_blocks_by_route($route);
			}
		}
	}

	/**
	 * Removes all blocks that (the service) no longer exist
	 * @return void
	 */
	private function clean_blocks()
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
			$this->manager->delete_blocks_by_name($blocks);
		}
	}

	/**
	 * Removes from custom blocks table, any custom blocks no longer present in blocks table
	 * @return void
	 */
	private function clean_custom_blocks()
	{
		$sql = $this->db->sql_build_query('SELECT', array(
			'SELECT'	=> 'cb.block_id',
			'FROM'		=> array(
				$this->cblocks_table    => 'cb',
			),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array($this->blocks_table => 'b'),
					'ON'	=> "b.bid = cb.block_id",
				)
			),
			'WHERE'		=> "b.bid IS NULL"
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
	private function get_style_ids()
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
}
