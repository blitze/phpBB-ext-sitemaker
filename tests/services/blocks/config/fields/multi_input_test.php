<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks\config\fields;

use blitze\sitemaker\services\blocks\config\fields\multi_input;

class multi_input_test extends cfg_test_base
{
	/**
	 * @return \blitze\sitemaker\services\blocks\config\fields\multi_input
	 */
	protected function get_service()
	{
		return new multi_input($this->translator, $this->ptemplate);
	}

	/**
	 */
	public function test_name()
	{
		$cfg_fields = $this->get_service();
		$this->assertEquals('multi_input', $cfg_fields->get_name());
	}

	/**
	 * Data set for test_build_multi_select
	 *
	 * @return array
	 */
	public function build_multi_input_test_data()
	{
		return array(
			array(
				false,
				[],
				'',
				'<div class="sm-multi-input-ui">' .
					'<div class="sm-multi-input-list">' .
					'<div class="sm-multi-input-item">' .
					'<input type="text" name="config[foo][]" value="" />' .
					'<button class="sm-multi-input-delete"><i class="fa fa-times" aria-hidden="true"></i></button>' .
					'</div>' .
					'</div>' .
					'<button class="sm-multi-input-add pull-right"><i class="fa fa-plus" aria-hidden="true"></i></button>' .
					'</div>',
			),
			array(
				true,
				['https://google.com', 'some-site.com'],
				'MY_FOO_INPUT',
				'<div class="sm-multi-input-ui sortable">' .
					'<label><strong>MY_FOO_INPUT</strong></label>' .
					'<div class="sm-multi-input-list">' .
					'<div class="sm-multi-input-item">' .
					'<span><i class="fa fa-bars" aria-hidden="true"></i></span>' .
					'<input type="text" name="config[foo][]" value="https://google.com" />' .
					'<button class="sm-multi-input-delete"><i class="fa fa-times" aria-hidden="true"></i></button>' .
					'</div>' .
					'<div class="sm-multi-input-item">' .
					'<span><i class="fa fa-bars" aria-hidden="true"></i></span>' .
					'<input type="text" name="config[foo][]" value="some-site.com" />' .
					'<button class="sm-multi-input-delete"><i class="fa fa-times" aria-hidden="true"></i></button>' .
					'</div>' .
					'<div class="sm-multi-input-item">' .
					'<span><i class="fa fa-bars" aria-hidden="true"></i></span>' .
					'<input type="text" name="config[foo][]" value="" />' .
					'<button class="sm-multi-input-delete"><i class="fa fa-times" aria-hidden="true"></i></button>' .
					'</div>' .
					'</div>' .
					'<button class="sm-multi-input-add pull-right"><i class="fa fa-plus" aria-hidden="true"></i></button>' .
					'</div>',
			),
		);
	}

	/**
	 * Test the build_multi_input method
	 *
	 * @dataProvider build_multi_input_test_data
	 * @param bool $sortable
	 * @param array $values
	 * @param string $label
	 * @param string $expected
	 */
	public function test_build_multi_input($sortable, array $values, $label, $expected)
	{
		$cfg_fields = $this->get_service();
		$html = $cfg_fields->build_multi_input('foo', $sortable, $values, $label);

		$this->assertEquals($expected, preg_replace('/\s{2,}/', '', $html));
	}
}
