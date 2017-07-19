<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks;

use blitze\sitemaker\services\blocks\action_handler;

class action_handler_test extends \phpbb_test_case
{
	protected $translator;
	protected $blocks;

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
	 * Get the action_handler object
	 *
	 * @return \blitze\sitemaker\services\blocks\action_handler
	 */
	public function get_action_handler()
	{
		global $phpEx;

		$cache = new \phpbb_mock_cache();
		$config = new \phpbb\config\config(array());
		$phpbb_container = new \phpbb_mock_container_builder();
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
		$request = $this->createMock('\phpbb\request\request_interface');

		$this->translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$this->translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode('-', func_get_args());
			});

		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$block_factory = $this->getMockBuilder('\blitze\sitemaker\services\blocks\factory')
			->disableOriginalConstructor()
			->getMock();

		$groups = $this->getMockBuilder('\blitze\sitemaker\services\groups')
			->disableOriginalConstructor()
			->getMock();

		$mapper = $this->getMockBuilder('\blitze\sitemaker\model\mapper_factory')
			->disableOriginalConstructor()
			->getMock();

		$blocks = new \blitze\sitemaker\services\blocks\blocks($cache, $config, $phpbb_dispatcher, $template, $this->translator, $block_factory, $groups, $mapper, $phpEx);

		return new action_handler($config, $phpbb_container, $request, $this->translator, $blocks, $block_factory, $mapper);
	}

	/**
	 * Data set for test_create_action
	 *
	 * @return array
	 */
	public function create_action_test_data()
	{
		return array(
			array('add_block'),
			array('copy_route'),
			array('edit_block'),
			array('handle_custom_action'),
			array('save_block'),
			array('save_blocks'),
			array('set_default_route'),
			array('set_route_prefs'),
			array('set_startpage'),
			array('update_block'),
		);
	}

	/**
	 * Test create action
	 *
	 * @dataProvider create_action_test_data
	 * @param string $action
	 * @throws \blitze\sitemaker\exception\unexpected_value
	 */
	public function test_create_action($action)
	{
		$handler = $this->get_action_handler();

		$command = $handler->create($action);

		$this->assertInstanceOf('\\blitze\\sitemaker\\services\\blocks\\action\\' . $action, $command);
	}

	/**
	 * Test invalid action request
	 */
	public function test_invalid_actioin()
	{
		$action = 'dance';
		$handler = $this->get_action_handler();

		try
		{
			$this->assertNull($handler->create($action));
			$this->fail('no exception thrown');
		}
		catch (\blitze\sitemaker\exception\base $e)
		{
			$this->assertEquals("EXCEPTION_UNEXPECTED_VALUE-{$action}-INVALID_ACTION", $e->get_message($this->translator));
		}
	}
}
