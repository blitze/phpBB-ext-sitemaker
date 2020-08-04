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
		return new code_editor($this->translator, $this->ptemplate);
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
				'<textarea id="foo-editor" class="code-editor" name="config[foo]"></textarea>' .
					'<div class="align-right">' .
					'<button class="foo-editor-button CodeMirror-button" data-action="undo" title="UNDO"><i class="fa fa-undo" aria-hidden="true"></i></button>' .
					'<button class="foo-editor-button CodeMirror-button" data-action="redo" title="REDO"><i class="fa fa-redo" aria-hidden="true"></i></button>' .
					'<button class="foo-editor-button CodeMirror-button" data-action="clear" title="CLEAR"><i class="fa fa-ban" aria-hidden="true"></i></button>' .
					'<button class="foo-editor-button CodeMirror-button" data-action="fullscreen" title="FULLSCREEN"><i class="fa fa-window-restore" aria-hidden="true"></i></button>' .
					'</div>'
			),
			array(
				'my awesome code',
				'FOO_EXPLAIN',
				array('allow-full-screen' => false, 'line-wrapping' => true),
				'FOO',
				'<label for="foo"><strong>FOO</strong></label>' .
					'<span>FOO_EXPLAIN</span>' .
					'<textarea id="foo-editor" class="code-editor" name="config[foo]" data-allow-full-screen="0" data-line-wrapping="1">my awesome code</textarea>' .
					'<div class="align-right">' .
					'<button class="foo-editor-button CodeMirror-button" data-action="undo" title="UNDO"><i class="fa fa-undo" aria-hidden="true"></i></button>' .
					'<button class="foo-editor-button CodeMirror-button" data-action="redo" title="REDO"><i class="fa fa-redo" aria-hidden="true"></i></button>' .
					'<button class="foo-editor-button CodeMirror-button" data-action="clear" title="CLEAR"><i class="fa fa-ban" aria-hidden="true"></i></button>' .
					'</div>'
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
	 * @param string $expected
	 */
	public function test_build_code_editor($value, $explain, array $data_props, $label, $expected)
	{
		$cfg_fields = $this->get_service();
		$html = $cfg_fields->build_code_editor('foo', $value, $explain, $data_props, $label);

		$this->assertEquals($expected, $this->clean_output($html));
	}
}
