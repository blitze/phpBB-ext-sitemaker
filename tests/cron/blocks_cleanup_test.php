<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\cron;

use blitze\sitemaker\cron\blocks_cleanup;
use blitze\sitemaker\services\blocks\manager;

class blocks_cleanup_test extends \phpbb_database_test_case
{
	protected $block_mapper;
	protected $config;

	protected $task_name = 'blitze.sitemaker.cron.blocks_cleanup';

	/**
	 * Define the extension to be tested.
	 *
	 * @return string[]
	 */
	protected static function setup_extensions()
	{
		return array('blitze/sitemaker');
	}

	/**
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/blocks_cleanup.xml');
	}

	protected function create_cron_manager($tasks)
	{
		global $phpbb_root_path, $phpEx;
		global $phpbb_root_path, $phpEx;

		$mock_config = new \phpbb\config\config(array(
			'force_server_vars' => false,
			'enable_mod_rewrite' => '',
		));

		$mock_router = $this->getMockBuilder('\phpbb\routing\router')
			->setMethods(array('setContext', 'generate'))
			->disableOriginalConstructor()
			->getMock();
		$mock_router->method('setContext')
			->willReturn(true);
		$mock_router->method('generate')
			->willReturn('foobar');

		$request = new \phpbb\request\request();
		$request->enable_super_globals();

		$routing_helper = new \phpbb\routing\helper(
			$mock_config,
			$mock_router,
			new \phpbb\symfony_request($request),
			$request,
			new \phpbb\filesystem\filesystem(),
			$phpbb_root_path,
			$phpEx
		);

		return new \phpbb\cron\manager($tasks, $routing_helper, $phpbb_root_path, $phpEx);
	}

	/**
	 * Create the cron task
	 *
	 * @return \blitze\sitemaker\cron\blocks_cleanup
	 */
	protected function create_blocks_cleanup_cron_task()
	{
		global $cache, $request;

		$table_prefix = 'phpbb_';
		$blocks_table = $table_prefix . 'sm_blocks';
		$block_routes_table = $table_prefix . 'sm_block_routes';
		$custom_blocks_table = $table_prefix . 'sm_cblocks';

		$db = $this->new_dbal();

		$request = $this->getMock('\phpbb\request\request_interface');

		$this->config = new \phpbb\config\config(array(
			'sitemaker_column_widths'	=> json_encode(array(
				1	=> array(
					'sidebar'		=> '200px',
					'subcontent'	=> '20%',
				),
				2	=> array(
					'sidebar'		=> '300px',
				),
			)),

			// these config vars are set in migrations upon install
			'sitemaker_blocks_cleanup_last_gc'	=> 0,
			'sitemaker_blocks_cleanup_gc'		=> 604800
		));

		$cache = new \phpbb_mock_cache();

		$blocks_factory = $this->getMockBuilder('\blitze\sitemaker\services\blocks\factory')
			->disableOriginalConstructor()
			->getMock();

		$blocks_factory->expects($this->any())
			->method('get_block')
			->will($this->returnCallback(function($service_name) {
				return ($service_name === 'blitze.sitemaker.blocks.stats') ? true : false;
			}));

		$tables = array(
			'mapper_tables'	=> array(
				'blocks'	=> $blocks_table,
				'routes'	=> $block_routes_table
			)
		);

		$mapper_factory = new \blitze\sitemaker\model\mapper_factory($this->config, $db, $tables);

		$this->block_mapper = $mapper_factory->create('blocks');

		$log = $this->getMockBuilder('\phpbb\log\log')
			->disableOriginalConstructor()
			->getMock();

		$blocks_manager = new manager($cache, $log, $blocks_factory, $mapper_factory);

		$url = $this->getMockBuilder('\blitze\sitemaker\services\url_checker')
			->getMock();

		$url->expects($this->any())
			->method('exists')
			->will($this->returnCallback(function($url) {
				$url = str_replace('http://', '', $url);
				return in_array($url, array('index.php', 'app.php/foo/test')) ? true : false;
			}));

		$task = new blocks_cleanup($this->config, $db, $blocks_manager, $url, $blocks_table, $custom_blocks_table);

		// this is normally called automatically in the yaml service config
		// but we have to do it manually here
		$task->set_name($this->task_name);

		return $task;
	}

	/**
	 * Test if task manager can find our task
	 */
	public function test_that_cron_task_is_discoverable()
	{
		$blocks_cleanup_task = $this->create_blocks_cleanup_cron_task();
		$cron_manager = $this->create_cron_manager(array($blocks_cleanup_task));

		$task = $cron_manager->find_task($this->task_name);
		$this->assertInstanceOf('\phpbb\cron\task\wrapper', $task);
		$this->assertEquals($this->task_name, $task->get_name());
	}

	public function test_blocks_cleanup()
	{
		$task = $this->create_blocks_cleanup_cron_task();

		// the task should be ready to run initially
		$this->assertTrue($task->should_run());

		// We start out with 5 blocks (see fixtures)
		// 4 blocks with style_id = 1 and the other block is of style_id = 2, which does not exist
		$blocks = $this->block_mapper->find();
		$this->assertEquals(5, count($blocks));

		$this->assertTrue($task->is_runnable());

		// run the task
		$task->run();

		// After run cron trask, we should end up with just 2 blocks
		$blocks = $this->block_mapper->find();
		$this->assertEquals(2, count($blocks));

		// confirm we have the expected blocks ids
		$this->assertEquals(array(1, 2), array_keys($blocks->get_entities()));

		// column widths for non-existing style should be gone
		$this->assertEquals(array(
			1 => array(
				'sidebar'		=> '200px',
				'subcontent'	=> '20%',
			)),
			json_decode($this->config['sitemaker_column_widths'], true)
		);

		// after successful run, the task should not be ready to run again until enough time has elapsed
		$this->assertFalse($task->should_run());
	}
}
