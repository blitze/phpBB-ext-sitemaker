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

class add_item_test extends base_action
{
	/**
	 * Test add item
	 */
	public function test_add_item()
	{
		$variable_map = array(
			array('menu_id', 0, false, request_interface::REQUEST, 1),
		);

		$command = $this->get_command('add_item', $variable_map);

		$result = $command->execute();

		$expected = array(
			'parent_id'	=> 0,
			'left_id'	=> 7,
			'right_id'	=> 8,
			'depth'		=> 0,
			'item_id'	=> 7,
		);

		$this->assertEquals($expected, array_intersect_key($result, $expected));
	}

	/**
	 * Test exceptions
	 */
	public function test_exceptions()
	{
		$expected = 'MENU_NOT_FOUND';
		$variable_map = array(
			array('menu_id', 0, false, request_interface::REQUEST, 0),
		);

		$command = $this->get_command('add_bulk', $variable_map);

		$this->assert_exception_called($command, $expected);
	}
}
