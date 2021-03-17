<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks\config\fields;

use blitze\sitemaker\services\blocks\config\fields\radio;

class radio_test extends cfg_test_base
{
	/**
	 * @return \blitze\sitemaker\services\blocks\config\fields\radio
	 */
	protected function get_service()
	{
		return new radio($this->translator);
	}

	/**
	 */
	public function test_name()
	{
		$cfg_fields = $this->get_service();
		$this->assertEquals('radio', $cfg_fields->get_name());
	}

	/**
	 */
	public function test_template()
	{
		$cfg_fields = $this->get_service();
		$this->assertEquals('@blitze_sitemaker/cfg_fields/radio.html', $cfg_fields->get_template());
	}

	/**
	 * Data set for test_build_radio
	 *
	 * @return array
	 */
	public function build_radio_test_data()
	{
		return array(
			array(
				array(),
				'',
				'some_var',
				array(
					'field' => 'some_var',
					'options' => [],
					'selected' => '',
				),
			),
			array(
				array(
					'option1'	=> 'Option #1',
					'option2'	=> 'Option #2',
					'option3'	=> 'Option #3',
				),
				'option2',
				'some_var',
				array(
					'field' => 'some_var',
					'options' =>  array(
						'option1' => 'Option #1',
						'option2' => 'Option #2',
						'option3' => 'Option #3',
					),
					'selected' => 'option2',
				)
			),
		);
	}

	/**
	 * Test the build_radio method
	 *
	 * @dataProvider build_radio_test_data
	 * @param array $option_ary
	 * @param string|array $selected_items
	 * @param string $key
	 * @param array $expected
	 */
	public function test_build_radio(array $option_ary, $selected_items, $key, array $expected)
	{
		$cfg_fields = $this->get_service();
		$result = $cfg_fields->build_radio($option_ary, $selected_items, $key);

		$this->assertEquals($expected, $result);
	}
}
