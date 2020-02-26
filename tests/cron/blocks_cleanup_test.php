<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\cron;

class blocks_cleanup_test extends \phpbb_database_test_case
{
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
		$config = new \phpbb\config\config(array());

		$this->blocks_cleaner = $this->getMockBuilder('\blitze\sitemaker\services\blocks\cleaner_interface')
			->disableOriginalConstructor()
			->getMock();

		$task = new \blitze\sitemaker\cron\blocks_cleanup($config);

		// these are normally called automatically in the yaml service config
		// but we have to do it manually here
		$task->set_name($this->task_name);
		$task->set_cleaner($this->blocks_cleaner);

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
		$this->assertTrue($task->is_runnable());

		$this->blocks_cleaner->expects($this->once())
			->method('test');

		// run the task
		$task->run();

		// after successful run, the task should not be ready to run again until enough time has elapsed
		$this->assertFalse($task->should_run());
	}
}
