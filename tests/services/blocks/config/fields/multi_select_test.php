<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks\config\fields;

use blitze\sitemaker\services\blocks\config\fields\multi_select;

class multi_select_test extends cfg_test_base
{
	/**
	 * @return \blitze\sitemaker\services\blocks\config\fields\multi_select
	 */
	protected function get_service()
	{
		return new multi_select($this->translator);
	}

	/**
	 */
	public function test_name()
	{
		$cfg_fields = $this->get_service();
		$this->assertEquals('multi_select', $cfg_fields->get_name());
	}

	/**
	 * Data set for test_build_multi_select
	 *
	 * @return array
	 */
	public function build_multi_select_test_data()
	{
		return array(
			array(
				array(),
				'',
				'topic_ids',
				array(
					'field' => 'topic_ids',
					'options' => [],
					'selected' => [''],
				)
			),
			array(
				array(
					'option1'	=> 'Option #1',
					'option2'	=> 'Option #2',
					'option3'	=> 'Option #3',
				),
				array('option1', 'option2'),
				'topic_ids',
				array(
					'field' => 'topic_ids',
					'options' => array(
						'option1' => 'Option #1',
						'option2' => 'Option #2',
						'option3' => 'Option #3',
					),
					'selected' => array(
						0 => 'option1',
						1 => 'option2',
					),
				)
			),
		);
	}

	/**
	 * Test the build_multi_select method
	 *
	 * @dataProvider build_multi_select_test_data
	 * @param array $option_ary
	 * @param string|array $selected_items
	 * @param string $key
	 * @param array $expected
	 */
	public function test_build_multi_select(array $option_ary, $selected_items, $key, array $expected)
	{
		$cfg_fields = $this->get_service();
		$result = $cfg_fields->build_multi_select($option_ary, $selected_items, $key);

		$this->assertEquals($expected, $result);
	}
}
