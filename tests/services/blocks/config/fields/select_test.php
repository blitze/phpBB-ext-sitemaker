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

class select_test extends \phpbb_test_case
{
	/**
	 * Define the extension to be tested.
	 *
	 * @return string[]
	 */
	protected static function setup_extensions()
	{
		return array('blitze/sitemaker');
	}

	/**
	 * @return \blitze\sitemaker\services\blocks\config\fields\select
	 */
	protected function get_service()
	{
		$translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode('-', func_get_args());
			});

		return new select($translator);
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
				'<select id="topic_ids" name="config[topic_ids]">' .
					'<option value="option1">Option #1</option>' .
					'<option value="option2" selected="selected">Option #2</option>' .
					'<option value="option3">Option #3</option>' .
				'</select>'
			),
		);
	}

	/**
	 * Test the build_select method
	 *
	 * @dataProvider build_select_test_data
	 */
	public function test_build_select($option_ary, $selected_item, $key, $expected)
	{
		$cfg_fields = $this->get_service();
		$html = $cfg_fields->build_select($option_ary, $selected_item, $key);

		$this->assertEquals($expected, $html);
	}
}
