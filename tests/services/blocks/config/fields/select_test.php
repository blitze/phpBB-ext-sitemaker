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
		return new select($this->translator, $this->ptemplate);
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
				'<select id="topic_ids" name="config[topic_ids]"></select>'
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
				'<select id="topic_ids" name="config[topic_ids]">' .
					'<option value="option1">Option #1</option>' .
					'<option value="option2" selected="selected">Option #2</option>' .
					'<option value="option3">Option #3</option>' .
				'</select>'
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
				'<select id="topic_ids" name="config[topic_ids][]" multiple="multiple" size="5" data-togglable-settings="true">' .
					'<option value="option1" selected="selected" data-toggle-setting="#foo-option1">Option #1</option>' .
					'<option value="option2" selected="selected" data-toggle-setting="#foo-option2">Option #2</option>' .
					'<option value="option3" data-toggle-setting="#foo-option3">Option #3</option>' .
				'</select>'
			),
		);
	}

	/**
	 * Test the build_select method
	 *
	 * @dataProvider build_select_test_data
	 */
	public function test_build_select($option_ary, $selected_item, $field, $size, $multi_select, $toggle_key, $expected)
	{
		$cfg_fields = $this->get_service();
		$html = $cfg_fields->build_select($option_ary, $selected_item, $field, $size, $multi_select, $toggle_key);

		$this->assertEquals($expected, $this->clean_output($html));
	}
}
