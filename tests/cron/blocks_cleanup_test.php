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

	/**
	 * Configure the test environment.
	 *
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();

		require_once dirname(__FILE__) . '/../../../../../includes/functions.php';
	}

	protected function create_cron_manager($tasks)
	{
		global $phpbb_root_path, $phpEx;

		return new \phpbb\cron\manager($tasks, $phpbb_root_path, $phpEx);
	}

	/**
	 * Create the cron task
	 *
	 * @return \blitze\sitemaker\cron\blocks_cleanup
	 */
	protected function create_blocks_cleanup_cron_task()
	{
		global $cache, $request, $phpbb_root_path, $phpEx;

		$table_prefix = 'phpbb_';
		$blocks_table = $table_prefix . 'sm_blocks';
		$block_routes_table = $table_prefix . 'sm_block_routes';
		$custom_blocks_table = $table_prefix . 'sm_cblocks';

		$db = $this->new_dbal();

		$user = $this->getMock('\phpbb\user', array(), array('\phpbb\datetime'));
		$request = $this->getMock('\phpbb\request\request_interface');

		$config = new \phpbb\config\config(array(
			// these config vars are set in migrations upon install
			'sitemaker_blocks_cleanup_last_gc'	=> 0,
			'sitemaker_blocks_cleanup_gc'		=> 604800
		));

		$cache = new \phpbb\cache\service(new \phpbb\cache\driver\null, $config, $db, $phpbb_root_path, $phpEx);

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

		$mapper_factory = new \blitze\sitemaker\model\mapper_factory($db, $tables);

		$this->block_mapper = $mapper_factory->create('blocks', 'blocks');

		$blocks_manager = new manager($cache, $blocks_factory, $mapper_factory);

		$url = $this->getMockBuilder('\blitze\sitemaker\services\url_checker')
			->getMock();

		$url->expects($this->any())
			->method('exists')
			->will($this->returnCallback(function($url) {
				return (strpos($url, 'index.php') !== false) ? true : false;
			}));

		$task = new blocks_cleanup($config, $db, $blocks_manager, $url, $blocks_table, $custom_blocks_table);

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

		// We start out with 4 blocks (see fixtures)
		// 3 blocks with style_id = 1 and the other block is of style_id = 2, which does not exist
		$blocks = $this->block_mapper->find();
		$this->assertEquals(4, count($blocks));

		// run the task
		$task->run();

		// After run cron trask, we should end up with just 1 block
		$blocks = $this->block_mapper->find();
		$this->assertEquals(1, count($blocks));

		// after successful run, the task should not be ready to run again until enough time has elapsed
		$this->assertFalse($task->should_run());
	}
}
