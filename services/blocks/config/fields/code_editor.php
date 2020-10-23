<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\config\fields;

/**
 * @package sitemaker
 */
class code_editor extends cfg_field_base
{
	/**
	 * @inheritdoc
	 */
	public function get_name()
	{
		return 'code_editor';
	}

	/**
	 * {@inheritdoc}
	 */
	public function prep_field(array &$vars, array &$type, $field, array $db_settings)
	{
		$vars['method'] = 'build_code_editor';
		$vars['params'] = array_reverse((array) $vars['params']);
		$vars['params'][] = $vars['lang_explain'];
		$vars['params'][] = $db_settings[$field];
		$vars['params'][] = $field;
		$vars['params'] = array_reverse($vars['params']);

		$type[0] = 'custom';
	}

	/**
	 * Used to add a code editor to blocks config
	 *
	 * @param string $key
	 * @param string $value
	 * @param string $explain
	 * @param array $data_props
	 * @param string $label
	 * @return []
	 */
	public function build_code_editor($key, $value, $explain, array $data_props = array(), $label = '')
	{
		return array(
			'key'			=> $key,
			'value'			=> $value,
			'label'			=> $label,
			'explain'		=> $explain,
			'attributes'	=> $this->get_code_editor_attributes($data_props),
			'fullscreen'	=> $this->fullscreen_allowed($data_props),
		);
	}

	/**
	 * @param array $data_props
	 * @return bool
	 */
	protected function fullscreen_allowed(array $data_props = array())
	{
		return (!isset($data_props['allow-full-screen']) || $data_props['allow-full-screen']);
	}

	/**
	 * @param array $data_props
	 * @return string
	 */
	protected function get_code_editor_attributes(array $data_props = array())
	{
		$attributes = '';
		foreach ($data_props as $prop => $value)
		{
			$value = (gettype($value) === 'boolean') ? (int) $value : $value;
			$attributes .= " data-{$prop}=\"{$value}\"";
		}
		return $attributes;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_template()
	{
		return '@blitze_sitemaker/cfg_fields/code_editor.html';
	}
}
