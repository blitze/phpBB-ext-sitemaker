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

class add_block_test extends base_action
{
	/**
	 * Data set for add_block_test
	 * @return array
	 */
	public function add_block_test_data()
	{
		return array(
			array(
				array(
					array('block', '', false, request_interface::REQUEST, 'my.foo.block'),
					array('route', '', false, request_interface::REQUEST, 'index.php'),
					array('position', '', false, request_interface::REQUEST, 'sidebar'),
					array('weight', 0, false, request_interface::REQUEST, 0),
				),
				array(
					'id'		=> 7,
					'route_id'	=> 1,
					'title'		=> 'I am foo block',
					'content'	=> 'foo block content',
					'settings'	=> array(),
				)
			),
			array(
				array(
					array('block', '', false, request_interface::REQUEST, 'my.baz.block'),
					array('route', '', false, request_interface::REQUEST, 'viewforum.php?f=1'),
					array('position', '', false, request_interface::REQUEST, 'sidebar'),
					array('weight', 0, false, request_interface::REQUEST, 1),
				),
				array(
					'id'		=> 7,
					'route_id'	=> 5,
					'title'		=> 'I am baz block',
					'content'	=> 'I love myself',
					'settings'	=> array(
						'my_setting'	=> 1,
						'other_setting'	=> 0,
					),
				)
			),
		);
	}

	/**
	 * Test add block
	 *
	 * @dataProvider add_block_test_data
	 * @param array $variable_map
	 * @param array $expected
	 */
	public function test_add_block(array $variable_map, array $expected)
	{
		$command = $this->get_command('add_block', $variable_map);

		$result = $command->execute(1);

		$actual = array(
			'id'		=> $result['bid'],
			'route_id'	=> $result['route_id'],
			'title'		=> $result['title'],
			'content'	=> $result['content'],
			'settings'	=> $result['settings'],
		);

		$this->assertSame($expected, $actual);
	}

	/**
	 * Test adding non-exitent block
	 */
	public function test_add_invalid_block()
	{
		$variable_map = array(
			array('block', '', false, request_interface::REQUEST, 'my.invalid.block'),
			array('route', '', false, request_interface::REQUEST, 'index.php'),
			array('position', '', false, request_interface::REQUEST, 'sidebar'),
			array('weight', 0, false, request_interface::REQUEST, 0),
		);

		$command = $this->get_command('add_block', $variable_map);

		try
		{
			$this->assertNull($command->execute(1));
			$this->fail('no exception thrown');
		}
		catch (\blitze\sitemaker\exception\base $e)
		{
			$this->assertEquals('my.invalid.block', $e->getMessage());
		}
	}
}
