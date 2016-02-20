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

		$translator = $this->getMock('\phpbb\language\language');

		$mapper_factory = $this->getMockBuilder('\blitze\sitemaker\model\mapper_factory')
			->disableOriginalConstructor()
			->getMock();

		return new action_handler($this->cache, $request, $translator, $mapper_factory);
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
	 */
	public function test_create_action($action)
	{
		$handler = $this->get_action_handler();

		$command = $handler->create($action);

		$this->assertInstanceOf('\\blitze\\sitemaker\\services\\menus\\action\\' . $action, $command);
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
