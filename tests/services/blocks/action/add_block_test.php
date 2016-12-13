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
				array(),
				array(
					'id'		=> 8,
					'route_id'	=> 1,
					'title'		=> 'I am foo block',
					'content'	=> 'foo block content',
					'class'		=> '',
					'settings'	=> array(),
					'view'		=> 'boxed',
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
					'view' => 'simple',
				),
				array(
					'id'		=> 8,
					'route_id'	=> 6,
					'title'		=> 'I am baz block',
					'content'	=> 'I love myself',
					'class'		=> '',
					'settings'	=> array(
						'my_setting'	=> 1,
						'other_setting'	=> 0,
					),
					'view'		=> 'simple'
				)
			),
			array(
				array(
					array('block', '', false, request_interface::REQUEST, 'my.empty.block'),
					array('route', '', false, request_interface::REQUEST, 'app.php/foo/foo'),
					array('position', '', false, request_interface::REQUEST, 'sidebar'),
					array('weight', 0, false, request_interface::REQUEST, 0),
				),
				array(
					'view' => 'basic',
				),
				array(
					'id'		=> 8,
					'route_id'	=> 6,
					'title'		=> 'I am an empty block',
					'content'	=> 'BLOCK_NO_DATA',
					'class'		=> ' sm-inactive',
					'settings'	=> array(),
					'view'		=> 'basic'
				)
			),
		);
	}

	/**
	 * Test add block
	 *
	 * @dataProvider add_block_test_data
	 * @param array $variable_map
	 * @param array $config_text
	 * @param array $expected
	 */
	public function test_add_block(array $variable_map, array $config_text, array $expected)
	{
		$command = $this->get_command('add_block', $variable_map);

		$style_id = 1;
		if (sizeof($config_text))
		{
			$data[$style_id] = $config_text;
			$this->config_text->set('sm_layout_prefs', json_encode($data));
		}

		$result = $command->execute($style_id);

		$actual = array(
			'id'		=> $result['bid'],
			'route_id'	=> $result['route_id'],
			'title'		=> $result['title'],
			'content'	=> $result['content'],
			'class'		=> $result['class'],
			'settings'	=> $result['settings'],
			'view'		=> $result['view'],
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
			$this->assertEquals('EXCEPTION_INVALID_ARGUMENT-my.invalid.block-SERVICE_NOT_FOUND', $e->get_message($this->translator));
		}
	}
}
