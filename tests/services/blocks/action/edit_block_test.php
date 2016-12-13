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

class edit_block_test extends base_action
{
	/**
	 * Data set for test_edit_block
	 * @return array
	 */
	public function edit_block_test_data()
	{
		return array(
			array(
				1,
				array(
					'title'		=> 'I am baz block',
					'settings'	=> array(
						'my_setting'	=> 1,
						'other_setting'	=> 0,
					),
					'id'		=> 1,
					'content'	=> 'I love myself',
				),
				array(
					array(
						'S_LEGEND'	=> 'legend1',
						'LEGEND'	=> 'SETTINGS',
					),
					array(
						'KEY'			=> 'my_setting',
						'TITLE'			=> 'MY_SETTING',
						'S_EXPLAIN'		=> false,
						'TITLE_EXPLAIN'	=> '',
						'CONTENT'		=> '<label><input type="radio" id="my_setting" name="config[my_setting]" value="1" checked="checked" class="radio" /> </label><label><input type="radio" name="config[my_setting]" value="0" class="radio" /> </label>',
					),
					array(
						'KEY'			=> 'other_setting',
						'TITLE'			=> 'OTHER_SETTING',
						'S_EXPLAIN'		=> true,
						'TITLE_EXPLAIN'	=> 'OTHER_SETTING_EXPLAIN',
						'CONTENT'		=> '<label><input type="radio" id="other_setting" name="config[other_setting]" value="1" class="radio" /> </label><label><input type="radio" name="config[other_setting]" value="0" checked="checked" class="radio" /> </label>',
					),
				),
			),
			array(
				2,
				array(
					'title'		=> 'I am foo block',
					'settings'	=> array(),
					'id'		=> 2,
					'content'	=> 'foo block content',
				),
				null,
			),
		);
	}

	/**
	 * Test edit block
	 *
	 * @dataProvider edit_block_test_data
	 * @param $bid
	 * @param array $expected_block
	 * @param array|null $expected_form
	 */
	public function test_edit_block($bid, array $expected_block, $expected_form)
	{
		$variable_map = array(
			array('id', 0, false, request_interface::REQUEST, $bid),
		);

		$command = $this->get_command('edit_block', $variable_map);

		$result = $command->execute(1);

		$this->assertEquals($expected_block, array_intersect_key($result, $expected_block));
		$this->assertEquals($expected_form, $result['form']['options']);
	}

	/**
	 * Test editing non-exitent block id
	 */
	public function test_editing_invalid_block_id()
	{
		$variable_map = array(
			array('id', 0, false, request_interface::REQUEST, 23),
		);

		$command = $this->get_command('edit_block', $variable_map);

		try
		{
			$this->assertNull($command->execute(1));
			$this->fail('no exception thrown');
		}
		catch (\blitze\sitemaker\exception\base $e)
		{
			$this->assertEquals('EXCEPTION_OUT_OF_BOUNDS-bid', $e->get_message($this->translator));
		}
	}

	/**
	 * Test editing non-exitent block service i.e id exists (#7) but block service does not exist
	 * In this test context, blitze.sitemaker.block.custom does not exist
	 */
	public function test_editing_invalid_block_service()
	{
		$variable_map = array(
			array('id', 0, false, request_interface::REQUEST, 7),
		);

		$command = $this->get_command('edit_block', $variable_map);

		try
		{
			$this->assertNull($command->execute(1));
			$this->fail('no exception thrown');
		}
		catch (\blitze\sitemaker\exception\base $e)
		{
			$this->assertEquals('EXCEPTION_INVALID_ARGUMENT-blitze.sitemaker.block.custom-SERVICE_NOT_FOUND', $e->get_message($this->translator));
		}
	}
}
