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

class delete_menu_test extends base_action
{
	/**
	 * Test delete menu
	 */
	public function test_delete_menu()
	{
		$menu_id = 1;
		$variable_map = array(
			array('menu_id', 0, false, request_interface::REQUEST, $menu_id),
		);

		$command = $this->get_command('delete_menu', $variable_map);

		$result = $command->execute();

		$items_mapper = $this->mapper_factory->create('items');

		$collection = $items_mapper->find(array('menu_id', '=', $menu_id));

		$this->assertEquals(1, $result['id']);
		$this->assertFalse($collection->valid());
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

		$command = $this->get_command('delete_menu', $variable_map);

		$this->assert_exception_called($command, $expected);
	}
}
