<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks\action;

use phpbb\request\request_interface;

class handle_custom_action_test extends base_action
{
	/**
	 * Data set for test_handle_custom_action
	 * @return array
	 */
	public function test_data()
	{
		return array(
			array(
				array(
					array('id', 0, false, request_interface::REQUEST, 0),
					array('service', '', false, request_interface::REQUEST, 'invalid.block.service'),
					array('method', '', false, request_interface::REQUEST, 'display'),
				),
				array(
					'errors' => 'SERVICE_NOT_FOUND',
				),
			),
			array(
				array(
					array('id', 0, false, request_interface::REQUEST, 10),
					array('service', '', false, request_interface::REQUEST, 'custom.block.service'),
					array('method', '', false, request_interface::REQUEST, 'display'),
				),
				array(
					'title'		=> 'Custom Block',
					'content'	=> 'Custom content id: 10',
				),
			),
		);
	}

	/**
	 * Test handle_custom_action
	 *
	 * @dataProvider test_data
	 */
	public function test_handle_custom_action($variable_map, $expected)
	{
		$command = $this->get_command('handle_custom_action', $variable_map);

		$result = $command->execute(1);

		$this->assertSame($expected, $result);
	}
}
