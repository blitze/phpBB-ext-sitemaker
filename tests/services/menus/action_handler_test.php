<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\menus;

use blitze\sitemaker\services\menus\action_handler;

class action_handler_test extends \phpbb_test_case
{
	protected $cache;
	protected $translator;

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
	 * @return \blitze\sitemaker\services\menus\action_handler
	 */
	public function get_action_handler()
	{
		$this->cache = $this->getMockBuilder('\phpbb\cache\driver\driver_interface')
			->disableOriginalConstructor()
			->getMock();

		$request = $this->getMock('\phpbb\request\request_interface');

		$this->translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$this->translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode('-', func_get_args());
			});

		$mapper_factory = $this->getMockBuilder('\blitze\sitemaker\model\mapper_factory')
			->disableOriginalConstructor()
			->getMock();

		return new action_handler($this->cache, $request, $this->translator, $mapper_factory);
	}

	/**
	 * Data set for test_create_action
	 *
	 * @return array
	 */
	public function create_action_test_data()
	{
		return array(
			array('add_bulk'),
			array('add_item'),
			array('add_menu'),
			array('delete_menu'),
			array('edit_menu'),
			array('load_item'),
			array('load_items'),
			array('save_item'),
			array('save_tree'),
			array('update_item'),
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

		$this->assertInstanceOf('\\blitze\\sitemaker\\services\\menus\\action\\' . $action, $command);
	}

	/**
	 * Test invalid action request
	 */
	public function test_invalid_actioin()
	{
		$action = 'rotate';
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

	public function test_clear_cache()
	{
		$handler = $this->get_action_handler();

		$this->cache->expects($this->once())
			->method('destroy')
			->with('sitemaker_menus');

		$handler->clear_cache();
	}
}
