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
		return new multi_input($this->translator);
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
				array(
					'field' => 'foo',
					'values' => array(),
					'sortable' => false,
					'label' => '',
				),
			),
			array(
				true,
				['https://google.com', 'some-site.com'],
				'MY_FOO_INPUT',
				array(
					'field' => 'foo',
					'values' => array(
						0 => 'https://google.com',
						1 => 'some-site.com',
					),
					'sortable' => true,
					'label' => 'MY_FOO_INPUT',
				),
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
	 * @param array $expected
	 */
	public function test_build_multi_input($sortable, array $values, $label, array $expected)
	{
		$cfg_fields = $this->get_service();
		$result = $cfg_fields->build_multi_input('foo', $sortable, $values, $label);

		$this->assertEquals($expected, $result);
	}
}
