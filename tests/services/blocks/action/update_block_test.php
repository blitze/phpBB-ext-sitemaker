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

class update_block_test extends base_action
{
	/**
	 * Data set for test_update_block
	 * @return array
	 */
	public function update_block_test_data()
	{
		return array(
			// Trying to upate invalid field
			array(
				array(
					array('id', 0, false, request_interface::REQUEST, 1),
					array('field', 'icon', false, request_interface::REQUEST, 'name'),
					array('icon', '', false, request_interface::REQUEST, 'icon'),
					array('title', '', true, request_interface::REQUEST, 'some title'),
				),
				array(
					'icon'		=> '',
					'title'		=> 'I am baz block',
					'id'		=> 1,
				),
			),
			// Update Icon
			array(
				array(
					array('id', 0, false, request_interface::REQUEST, 1),
					array('field', 'icon', false, request_interface::REQUEST, 'icon'),
					array('icon', '', false, request_interface::REQUEST, 'fa fa-circle'),
					array('title', '', true, request_interface::REQUEST, ''),
				),
				array(
					'icon'		=> 'fa fa-circle',
					'title'		=> 'I am baz block',
					'id'		=> 1,
				),
			),
			// Update title
			array(
				array(
					array('id', 0, false, request_interface::REQUEST, 1),
					array('field', 'icon', false, request_interface::REQUEST, 'title'),
					array('icon', '', false, request_interface::REQUEST, ''),
					array('title', '', true, request_interface::REQUEST, 'my best block'),
				),
				array(
					'icon'		=> '',
					'title'		=> 'My Best Block',
					'id'		=> 1,
				),
			),
		);
	}

	/**
	 * Test update_block action
	 *
	 * @dataProvider update_block_test_data
	 */
	public function test_update_block($variable_map, $expected)
	{
		$command = $this->get_command('update_block', $variable_map);

		$result = $command->execute(1);

		$this->assertSame($expected, array_intersect_key($result, $expected));
	}

	/**
	 * Test non-exitent block
	 */
	public function test_block_no_exists()
	{
		$variable_map = array(
			array('id', 0, false, request_interface::REQUEST, 45),
		);

		$command = $this->get_command('update_block', $variable_map);

		try
		{
			$this->assertNull($command->execute(1));
			$this->fail('no exception thrown');
		}
		catch (\blitze\sitemaker\exception\base $e)
		{
			$this->assertEquals('BLOCK_NOT_FOUND', $e->getMessage());
		}
	}
}
