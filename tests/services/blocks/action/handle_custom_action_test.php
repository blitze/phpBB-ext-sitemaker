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
	public function custom_action_test_data()
	{
		return array(
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
	 * @dataProvider custom_action_test_data
	 * @param array $variable_map
	 * @param array $expected
	 */
	public function test_handle_custom_action(array $variable_map, array $expected)
	{
		$command = $this->get_command('handle_custom_action', $variable_map);

		$result = $command->execute(1);

		$this->assertSame($expected, $result);
	}

	/**
	 * Test service does not exist
	 */
	public function test_invalid_service()
	{
		$variable_map = array(
			array('id', 0, false, request_interface::REQUEST, 0),
			array('service', '', false, request_interface::REQUEST, 'invalid.block.service'),
			array('method', '', false, request_interface::REQUEST, 'display'),
		);

		$command = $this->get_command('handle_custom_action', $variable_map);

		try
		{
			$this->assertNull($command->execute(1));
			$this->fail('no exception thrown');
		}
		catch (\blitze\sitemaker\exception\base $e)
		{
			$this->assertEquals('EXCEPTION_INVALID_ARGUMENT-invalid.block.service-SERVICE_NOT_FOUND', $e->get_message($this->user));
		}
	}
}
