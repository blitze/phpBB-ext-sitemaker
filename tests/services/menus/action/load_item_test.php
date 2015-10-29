<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\menus\action;

use phpbb\request\request_interface;

class load_item_test extends base_action
{
	/**
	 * Test load a single menu item
	 */
	public function test_load_item()
	{
		$variable_map = array(
			array('item_id', 0, false, request_interface::REQUEST, 2),
		);

		$command = $this->get_command('load_item', $variable_map);

		$result = $command->execute();

		$expected = array(
			'item_id'	=> 2,
			'parent_id'	=> 1,
			'left_id'	=> 2,
			'right_id'	=> 3,
			'depth'		=> 1,
		);

		$this->assertSame($expected, array_intersect_key($result, $expected));
	}

	/**
	 * Test exceptions
	 */
	public function test_exceptions()
	{
		$expected = 'MENU_ITEM_NOT_FOUND';
		$variable_map = array(
			array('item_id', 0, false, request_interface::REQUEST, 23),
		);

		$command = $this->get_command('load_item', $variable_map);

		$this->assert_exception_called($command, $expected);
	}
}
