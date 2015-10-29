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

class add_bulk_test extends base_action
{
	/**
	 * Data set for add_bulk_test
	 * @return array
	 */
	public function add_bulk_test_data()
	{
		return array(
			array(
				array(
					array('menu_id', 0, false, request_interface::REQUEST, 1),
					array('parent_id', 0, false, request_interface::REQUEST, 0),
					array('add_list', '', true, request_interface::REQUEST, "Test 1\n    Test 2"),
				),
				array(
					array(
						'item_id'	=> 7,
						'parent_id'	=> 0,
						'left_id'	=> 7,
						'right_id'	=> 10,
						'depth'		=> 0,
					),
					array(
						'item_id'	=> 8,
						'parent_id'	=> 7,
						'left_id'	=> 8,
						'right_id'	=> 9,
						'depth'		=> 1,
					),
				),
			),
			array(
				array(
					array('menu_id', 0, false, request_interface::REQUEST, 1),
					array('parent_id', 0, false, request_interface::REQUEST, 2),
					array('add_list', '', true, request_interface::REQUEST, "Test 1\n    Test 2"),
				),
				array(
					array(
						'item_id'	=> 7,
						'parent_id'	=> 2,
						'left_id'	=> 3,
						'right_id'	=> 6,
						'depth'		=> 2,
					),
					array(
						'item_id'	=> 8,
						'parent_id'	=> 7,
						'left_id'	=> 4,
						'right_id'	=> 5,
						'depth'		=> 3,
					),
				),
			),
			array(
				array(
					array('menu_id', 0, false, request_interface::REQUEST, 2),
					array('parent_id', 0, false, request_interface::REQUEST, 0),
					array('add_list', '', true, request_interface::REQUEST, "Test 1\n    Test 2"),
				),
				array(
					array(
						'item_id'	=> 7,
						'parent_id'	=> 0,
						'left_id'	=> 1,
						'right_id'	=> 4,
						'depth'		=> 0,
					),
					array(
						'item_id'	=> 8,
						'parent_id'	=> 7,
						'left_id'	=> 2,
						'right_id'	=> 3,
						'depth'		=> 1,
					),
				),
			),
		);
	}

	/**
	 * Test add bulk
	 *
	 * @dataProvider add_bulk_test_data
	 */
	public function test_add_bulk($variable_map, $expected)
	{
		$command = $this->get_command('add_bulk', $variable_map);

		$result = $command->execute();

		$this->assertSame($expected, $this->get_matching_fields($result['items'], $expected[0]));
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
					array('parent_id', 0, false, request_interface::REQUEST, 0),
					array('add_list', '', true, request_interface::REQUEST, "Test 1\n    Test 2"),
				),
				'MENU_NOT_FOUND',
			),
			array(
				array(
					array('menu_id', 0, false, request_interface::REQUEST, 2),
					array('parent_id', 0, false, request_interface::REQUEST, 3),
					array('add_list', '', true, request_interface::REQUEST, "Test 1\n    Test 2"),
				),
				'MENU_INVALID_PARENT',
			),
			array(
				array(
					array('menu_id', 0, false, request_interface::REQUEST, 2),
					array('parent_id', 0, false, request_interface::REQUEST, 0),
					array('add_list', '', true, request_interface::REQUEST, "    Test 1\nTest 2"),
				),
				'MENU_MALFORMED_TREE',
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
		$command = $this->get_command('add_bulk', $variable_map);

		$this->assert_exception_called($command, $expected);
	}
}
