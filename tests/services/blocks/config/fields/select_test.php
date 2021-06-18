<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks\config\fields;

use blitze\sitemaker\services\blocks\config\fields\select;

class select_test extends cfg_test_base
{
	/**
	 * @return \blitze\sitemaker\services\blocks\config\fields\select
	 */
	protected function get_service()
	{
		return new select($this->translator);
	}

	/**
	 */
	public function test_name()
	{
		$cfg_fields = $this->get_service();
		$this->assertEquals('select', $cfg_fields->get_name());
	}

	/**
	 * Data set for test_build_select
	 *
	 * @return array
	 */
	public function build_select_test_data()
	{
		return array(
			array(
				array(),
				'',
				'topic_ids',
				1,
				false,
				'',
				array(
					'field' => 'topic_ids',
					'selected' => [''],
					'options' =>  [],
					'size' => 1,
					'multi_select' => false,
					'togglable_key' => '',
				)
			),
			array(
				array(
					'option1'	=> 'Option #1',
					'option2'	=> 'Option #2',
					'option3'	=> 'Option #3',
				),
				'option2',
				'topic_ids',
				1,
				false,
				'',
				array(
					'field' => 'topic_ids',
					'selected' => ['option2'],
					'options' =>  array(
						'option1' => 'Option #1',
						'option2' => 'Option #2',
						'option3' => 'Option #3',
					),
					'size' => 1,
					'multi_select' => false,
					'togglable_key' => '',
				)
			),
			array(
				array(
					'option1'	=> 'Option #1',
					'option2'	=> 'Option #2',
					'option3'	=> 'Option #3',
				),
				['option1', 'option2'],
				'topic_ids',
				5,
				true,
				'foo',
				array(
					'field' => 'topic_ids',
					'selected' => ['option1', 'option2'],
					'options' =>  array(
						'option1' => 'Option #1',
						'option2' => 'Option #2',
						'option3' => 'Option #3',
					),
					'size' => 5,
					'multi_select' => true,
					'togglable_key' => 'foo',
				)
			),
		);
	}

	/**
	 * Test the build_select method
	 *
	 * @dataProvider build_select_test_data
	 * @param array $option_ary
	 * @param string|array $selected_item
	 * @param string $field
	 * @param int $size
	 * @param bool $multi_select
	 * @param string $toggle_key
	 * @param array $expected
	 */
	public function test_build_select($option_ary, $selected_item, $field, $size, $multi_select, $toggle_key, array $expected)
	{
		$cfg_fields = $this->get_service();
		$result = $cfg_fields->build_select($option_ary, $selected_item, $field, $size, $multi_select, $toggle_key);

		$this->assertEquals($expected, $result);
	}
}
