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

class edit_menu_test extends base_action
{
	/**
	 * Test edit menu
	 */
	public function test_edit_menu()
	{
		$menu_id = 1;
		$expected = array(
			'id'	=> 1,
			'name'	=> 'My Menu',
		);
		$variable_map = array(
			array('menu_id', 0, false, request_interface::REQUEST, $menu_id),
			array('title', '', true, request_interface::REQUEST, 'my menu'),
		);

		$command = $this->get_command('edit_menu', $variable_map);

		$result = $command->execute();

		$this->assertSame($expected, $result);
	}

	/**
	 * Data set for test_exceptions
	 * @return array
	 */
	public function excetions_test_data()
	{
		return array(
			array(
				array(
					array('menu_id', 0, false, request_interface::REQUEST, 4),
					array('title', '', true, request_interface::REQUEST, 'my menu'),
				),
				'MENU_NOT_FOUND',
			),
			array(
				array(
					array('menu_id', 0, false, request_interface::REQUEST, 2),
					array('title', '', true, request_interface::REQUEST, ''),
				),
				'menu_name',
			),
		);
	}

	/**
	 * Test exceptions
	 *
	 * @dataProvider excetions_test_data
	 */
	public function test_exceptions($variable_map, $expected)
	{
		$command = $this->get_command('edit_menu', $variable_map);

		$this->assert_exception_called($command, $expected);
	}
}
