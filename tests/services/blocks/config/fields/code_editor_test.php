<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks\config\fields;

use blitze\sitemaker\services\blocks\config\fields\code_editor;

class code_editor_test extends cfg_test_base
{
	/**
	 * @return \blitze\sitemaker\services\blocks\config\fields\code_editor
	 */
	protected function get_service()
	{
		return new code_editor($this->translator);
	}

	/**
	 */
	public function test_name()
	{
		$cfg_fields = $this->get_service();
		$this->assertEquals('code_editor', $cfg_fields->get_name());
	}

	/**
	 * Data set for test_build_radio
	 *
	 * @return array
	 */
	public function build_code_editor_test_data()
	{
		return array(
			array(
				'',
				'',
				array(),
				'',
				array(
					'key' => 'foo',
					'value' => '',
					'label' => '',
					'explain' => '',
					'attributes' => '',
					'fullscreen' => true,
				),
			),
			array(
				'my awesome code',
				'FOO_EXPLAIN',
				array('allow-full-screen' => false, 'line-wrapping' => true),
				'FOO',
				array(
					'key' => 'foo',
					'value' => 'my awesome code',
					'label' => 'FOO',
					'explain' => 'FOO_EXPLAIN',
					'attributes' => ' data-allow-full-screen="0" data-line-wrapping="1"',
					'fullscreen' => false,
				),
			),
		);
	}

	/**
	 * Test the build_code_editor
	 *
	 * @dataProvider build_code_editor_test_data
	 * @param string $value
	 * @param string $explain
	 * @param array $data_props
	 * @param string $label
	 * @param array $expected
	 */
	public function test_build_code_editor($value, $explain, array $data_props, $label, array $expected)
	{
		$cfg_fields = $this->get_service();
		$result = $cfg_fields->build_code_editor('foo', $value, $explain, $data_props, $label);

		$this->assertEquals($expected, $result);
	}
}
