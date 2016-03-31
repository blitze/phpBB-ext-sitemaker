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

class load_items_test extends base_action
{
	/**
	 * Data set for load_items_test
	 * @return array
	 */
	public function load_items_test_data()
	{
		return array(
			array(
				array(
					array('menu_id', 0, false, request_interface::REQUEST, 1),
				),
				array(
					array(
						'item_id'	=> 1,
						'parent_id'	=> 0,
						'left_id'	=> 1,
						'right_id'	=> 4,
						'depth'		=> 0,
					),
					array(
						'item_id'	=> 2,
						'parent_id'	=> 1,
						'left_id'	=> 2,
						'right_id'	=> 3,
						'depth'		=> 1,
					),
					array(
						'item_id'	=> 3,
						'parent_id'	=> 0,
						'left_id'	=> 5,
						'right_id'	=> 6,
						'depth'		=> 0,
					),
				),
			),
			array(
				array(
					array('menu_id', 0, false, request_interface::REQUEST, 2),
				),
				array(),
			),
		);
	}

	/**
	 * Test loading a tree
	 *
	 * @dataProvider load_items_test_data
	 * @param array $variable_map
	 * @param array $expected
	 */
	public function test_load_items(array $variable_map, array $expected)
	{
		$command = $this->get_command('load_items', $variable_map);

		$result = $command->execute();

		$this->assertSame($expected, $this->get_matching_fields($result['items'], $expected[0]));
	}


	/**
	 * Test exceptions
	 */
	public function test_exceptions()
	{
		$expected = 'EXCEPTION_OUT_OF_BOUNDS-menu_id';
		$variable_map = array(
			array('menu_id', 0, false, request_interface::REQUEST, 0),
		);

		$command = $this->get_command('load_items', $variable_map);

		$this->assert_exception_called($command, $expected);
	}
}
