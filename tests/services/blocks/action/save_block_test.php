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

class save_block_test extends base_action
{
	/**
	 * Data set for test_edit_block
	 * @return array
	 */
	public function save_block_test_data()
	{
		return array(
			// block has settings, but do not upate similar
			array(
				array(
					array('similar', false, false, request_interface::REQUEST, false),
					array('id', 0, false, request_interface::REQUEST, 1),
					array('class', '', false, request_interface::REQUEST, 'bg3'),
					array('hide_title', 0, false, request_interface::REQUEST, 1),
					array('permission', array(0), false, request_interface::REQUEST, array(1, 4)),
					array('config', array('' => array(0 => '')), true, request_interface::REQUEST, array()),
					array('config', array('' => ''), true, request_interface::REQUEST, array(
						'my_setting'	=> 0,
						'other_setting'	=> 1,
					)),
				),
				array(
					'bid'			=> 1,
					'title'			=> 'I am baz block',
					'permission'	=> array(1, 4),
					'class'			=> ' bg3',
					'hide_title'	=> true,
					'settings'		=> array(
						'my_setting'	=> 0,
						'other_setting'	=> 1,
					),
					'content'		=> 'I love others',
					'view'			=> '',
				),
				1,
			),
			// block has settings, upate similar across routes and styles
			array(
				array(
					array('similar', false, false, request_interface::REQUEST, true),
					array('id', 0, false, request_interface::REQUEST, 6),
					array('hide_title', 0, false, request_interface::REQUEST, 1),
					array('view', '', false, request_interface::REQUEST, 'simple'),
					array('permission', array(0), false, request_interface::REQUEST, array()),
					array('config', array('' => array(0 => '')), true, request_interface::REQUEST, array()),
					array('config', array('' => ''), true, request_interface::REQUEST, array(
						'my_setting'	=> 1,
						'other_setting'	=> 1,
					)),
				),
				array(
					'bid'			=> 6,
					'title'			=> 'I am baz block',
					'permission'	=> array(),
					'class'			=> '',
					'hide_title'	=> true,
					'settings'		=> array(
						'my_setting'	=> 1,
						'other_setting'	=> 1,
					),
					'content'		=> 'I love myself and others',
					'view'			=> 'simple',
				),
				3,
			),
			// block has no settings, update similar is set to true
			array(
				array(
					array('similar', false, false, request_interface::REQUEST, true),
					array('id', 0, false, request_interface::REQUEST, 2),
					array('status', 0, false, request_interface::REQUEST, 1),
					array('type', 0, false, request_interface::REQUEST, 2),
					array('view', '', false, request_interface::REQUEST, 'basic'),
					array('permission', array(0), false, request_interface::REQUEST, array()),
					array('config', array('' => array(0 => '')), true, request_interface::REQUEST, array()),
					array('config', array('' => ''), true, request_interface::REQUEST, array()),
				),
				array(
					'bid'			=> 2,
					'title'			=> 'I am foo block',
					'status'		=> true,
					'type'			=> 2,
					'settings'		=> array(),
					'content'		=> 'foo block content',
					'view'			=> 'basic',
				),
				0,
			),
		);
	}

	/**
	 * Test save block
	 *
	 * @dataProvider save_block_test_data
	 * @param array $variable_map
	 * @param array $expected_data
	 * @param int $expected_similar
	 */
	public function test_save_block(array $variable_map, array $expected_data, $expected_similar)
	{
		$command = $this->get_command('save_block', $variable_map);

		$result = $command->execute(1);

		$actual_similar = 0;
		$updated_block = array_shift($result['list']);

		if ($updated_block['hash'])
		{
			$mapper = $this->mapper_factory->create('blocks', 'blocks');
			$collection = $mapper->find(array('hash', '=', $updated_block['hash']));
			$actual_similar = $collection->count();
		}

		$this->assertEquals($expected_data, array_intersect_key($updated_block, $expected_data));
		$this->assertEquals($expected_similar, $actual_similar);
	}

	function test_invalid_block_exceptions()
	{
		$command = $this->get_command('save_block', array(
			array('id', 0, false, request_interface::REQUEST, 9),
		));

		try
		{
			$this->assertNull($command->execute(1));
			$this->fail('no exception thrown');
		}
		catch (\blitze\sitemaker\exception\out_of_bounds $e)
		{
			$this->assertEquals('EXCEPTION_OUT_OF_BOUNDS-bid', $e->get_message($this->translator));
		}
	}
}
