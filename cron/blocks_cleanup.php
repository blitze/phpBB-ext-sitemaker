<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\cron;

class blocks_cleanup extends \phpbb\cron\task\base
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \primetime\core\services\blocks\manager */
	protected $manager;

	/** @var string */
	protected $blocks_table;

	/** @var string */
	protected $cblocks_table;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config						$config					Config object
	 * @param \phpbb\db\driver\driver_interface			$db						Database object
	 * @param \primetime\core\services\blocks\manager	$manager				Blocks manager object
	 * @param string									$blocks_table			Name of blocks database table
	 * @param string									$cblocks_table			Name of custom blocks database table
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \primetime\core\services\blocks\manager $manager, $blocks_table, $cblocks_table)
	{
		$this->config = $config;
		$this->db = $db;
		$this->manager = $manager;
		$this->blocks_table = $blocks_table;
		$this->cblocks_table = $cblocks_table;
	}

	/**
	 * Runs this cron task.
	 *
	 * @return null
	 */
	public function run()
	{
		$routes_ary	= $this->manager->get_all_routes();
		$style_ids	= $this->get_style_ids();
		$board_url	= generate_board_url();

		$this->config->set('primetime_blocks_cleanup_last_gc', time());

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

		foreach ($routes as $route => $row)
		{
			$url = $board_url . '/' . (($row['ext_name']) ? 'app.php' : '') . $row['route'];

			$file_headers = @get_headers($url);

			// Route no longer exists => remove all blocks for route
			if ($file_headers[0] !== 'HTTP/1.1 200 OK')
			{
				$this->manager->set_style($row['style']);
				$this->manager->delete_blocks_by_route($route);
			}
		}

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
		return $this->config['primetime_blocks_cleanup_last_gc'] < time() - $this->config['primetime_blocks_cleanup_gc'];
	}

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
            'WHERE'		=> "b.bid IS NULL")
        );
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

	private function clean_blocks()
	{
		$sql = $this->db->sql_build_query('SELECT', array(
            'SELECT'	=> 'b.name',
            'FROM'		=> array(
                $this->blocks_table    => 'b',
            ),
			'GROUP_BY'	=> 'b.name'
        ));
        $result = $this->db->sql_query($sql);

		$blocks = array();
        while ($row = $this->db->sql_fetchrow($result))
        {
			if (!$this->manager->block_exists($row['name']))
			{
            	$blocks[] = $row['name'];
			}
        }
        $this->db->sql_freeresult($result);

		if (sizeof($blocks))
		{
			$this->manager->delete_blocks_by_name($blocks);
		}
	}

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
