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

class save_item_test extends base_action
{
	/**
	 * Test save item
	 */
	public function test_save_item()
	{
		$variable_map = array(
			array('item_id', 0, false, request_interface::REQUEST, 2),
			array('item_title', '', true, request_interface::REQUEST, 'about us'),
			array('item_url', '', false, request_interface::REQUEST, 'index.php'),
			array('item_target', 0, false, request_interface::REQUEST, 1),
		);

		$expected = array(
			'item_title'	=> 'About Us',
			'item_url'		=> 'index.php',
			'item_target'	=> 1,
		);

		$command = $this->get_command('save_item', $variable_map);

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

		$command = $this->get_command('save_item', $variable_map);

		$this->assert_exception_called($command, $expected);
	}
}
