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

class update_item_test extends base_action
{
	/**
	 * Data set for test_update_item
	 * @return array
	 */
	public function update_item_test_data()
	{
		return array(
			array(
				array(
					array('item_id', 0, false, request_interface::REQUEST, 2),
					array('item_icon', '', false, request_interface::REQUEST, 'fa fa-circle'),
					array('item_title', '', true, request_interface::REQUEST, 'my page'),
					array('field', 'item_icon', false, request_interface::REQUEST, 'item_target'),
				),
				array(
					'item_id'		=> 2,
					'item_title'	=> 'Item 2',
					'item_icon'		=> '',
				),
			),
			array(
				array(
					array('item_id', 0, false, request_interface::REQUEST, 2),
					array('item_icon', '', false, request_interface::REQUEST, 'fa fa-circle'),
					array('item_title', '', true, request_interface::REQUEST, 'my page'),
					array('field', 'item_icon', false, request_interface::REQUEST, 'item_status'),
				),
				array(
					'item_id'		=> 2,
					'item_title'	=> 'Item 2',
					'item_icon'		=> '',
				),
			),
			array(
				array(
					array('item_id', 0, false, request_interface::REQUEST, 2),
					array('item_icon', '', false, request_interface::REQUEST, 'fa fa-circle'),
					array('item_title', '', true, request_interface::REQUEST, 'my page'),
					array('field', 'item_icon', false, request_interface::REQUEST, 'item_icon'),
				),
				array(
					'item_id'		=> 2,
					'item_title'	=> 'Item 2',
					'item_icon'		=> 'fa fa-circle ',
				),
			),
			array(
				array(
					array('item_id', 0, false, request_interface::REQUEST, 2),
					array('item_icon', '', false, request_interface::REQUEST, 'fa fa-circle'),
					array('item_title', '', true, request_interface::REQUEST, 'my page'),
					array('field', 'item_icon', false, request_interface::REQUEST, 'item_title'),
				),
				array(
					'item_id'		=> 2,
					'item_title'	=> 'My page',
					'item_icon'		=> '',
				),
			),
		);
	}

	/**
	 * Test update item
	 *
	 * @dataProvider update_item_test_data
	 * @param array $variable_map
	 * @param array $expected
	 */
	public function test_update_item(array $variable_map, array $expected)
	{
		$command = $this->get_command('update_item', $variable_map);

		$result = $command->execute();

		$this->assertSame($expected, array_intersect_key($result, $expected));
	}

	/**
	 * Test exceptions
	 */
	public function test_exceptions()
	{
		$expected = 'MENU_ITEM_NOT_FOUND';
		$variable_map = array(
			array('item_id', 0, false, request_interface::REQUEST, 0),
		);

		$command = $this->get_command('update_item', $variable_map);

		$this->assert_exception_called($command, $expected);
	}
}
