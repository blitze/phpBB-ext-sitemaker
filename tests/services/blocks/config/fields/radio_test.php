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
		return new radio($this->translator, $this->ptemplate);
	}

    /**
     */
	public function test_name()
	{
		$cfg_fields = $this->get_service();
		$this->assertEquals('radio', $cfg_fields->get_name());
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
				''
			),
			array(
				array(
					'option1'	=> 'Option #1',
					'option2'	=> 'Option #2',
					'option3'	=> 'Option #3',
				),
				'option2',
				'some_var',
				'<label><input type="radio" name="config[some_var]" value="option1" class="radio" /> Option #1</label><br />' .
				'<label><input type="radio" name="config[some_var]" value="option2" checked="checked" class="radio" /> Option #2</label><br />' .
				'<label><input type="radio" name="config[some_var]" value="option3" class="radio" /> Option #3</label><br />'
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
	 * @param string $expected
	 */
	public function test_build_radio(array $option_ary, $selected_items, $key, $expected)
	{
		$cfg_fields = $this->get_service();
		$html = $cfg_fields->build_radio($option_ary, $selected_items, $key);

		$this->assertEquals($expected, $this->clean_output($html));
	}
}
