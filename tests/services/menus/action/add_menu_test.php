<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\menus\action;

class add_menu_test extends base_action
{
	/**
	 * Test add menu
	 */
	public function test_add_menu()
	{
		$command = $this->get_command('add_menu', array());

		$result = $command->execute();

		$this->assertEquals(4, $result['id']);
		$this->assertContains('MENU', $result['title']);
	}
}
