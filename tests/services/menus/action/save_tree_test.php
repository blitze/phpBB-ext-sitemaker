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

class save_tree_test extends base_action
{
	/**
	 * Data set for test_save_tree
	 * @return array
	 */
	public function save_tree_test_data()
	{
		return array(
			array(
				array(
					array('menu_id', 0, false, request_interface::REQUEST, 1),
					array('tree', array(0 => array('' => 0)), false, request_interface::REQUEST, array(
						3 => array('item_id' => 3, 'parent_id' => 0),
						1 => array('item_id' => 1, 'parent_id' => 3),
					)),
				),
				array(
					array(
						'item_id'	=> 3,
						'parent_id'	=> 0,
						'left_id'	=> 1,
						'right_id'	=> 4,
						'depth'		=> 0,
					),
					array(
						'item_id'	=> 1,
						'parent_id'	=> 3,
						'left_id'	=> 2,
						'right_id'	=> 3,
						'depth'		=> 1,
					),
				),
			),
			array(
				array(
					array('menu_id', 0, false, request_interface::REQUEST, 1),
					array('tree', array(0 => array('' => 0)), false, request_interface::REQUEST, array(
						2 => array('item_id' => 2, 'parent_id' => 0),
						1 => array('item_id' => 1, 'parent_id' => 0),
						21 => array('item_id' => 21, 'parent_id' => 3),
					)),
				),
				array(
					array(
						'item_id'	=> 2,
						'parent_id'	=> 0,
						'left_id'	=> 1,
						'right_id'	=> 2,
						'depth'		=> 0,
					),
					array(
						'item_id'	=> 1,
						'parent_id'	=> 0,
						'left_id'	=> 3,
						'right_id'	=> 4,
						'depth'		=> 0,
					),
				),
			),
		);
	}

	/**
	 * Test save tree
	 *
	 * @dataProvider save_tree_test_data
	 */
	public function test_save_tree($variable_map, $expected)
	{
		$command = $this->get_command('save_tree', $variable_map);

		$result = $command->execute();

		$this->assertSame($expected, $this->get_matching_fields($result, $expected[0]));
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

		$command = $this->get_command('save_tree', $variable_map);

		$this->assert_exception_called($command, $expected);
	}
}
