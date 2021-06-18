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
class multi_input extends cfg_field_base
{
	/**
	 * @inheritdoc
	 */
	public function get_name()
	{
		return 'multi_input';
	}

	/**
	 * {@inheritdoc}
	 */
	public function prep_field(array &$vars, array &$type, $field, array $db_settings)
	{
		// set defaults for types: field type, sortable, full width
		$type += array('', 0, 1);

		if ($type[2])
		{
			$vars['params'][] = $vars['lang'];
			$vars['lang'] = '';
		}

		$vars['params'][] = array_filter((array) $db_settings[$field]);
		$vars['params'][] = $type[1];	// sortable
		$vars['params'][] = $field;

		$type[0] = 'custom';
		$vars['method'] = 'build_multi_input';
		$vars['params'] = array_reverse($vars['params']);
	}

	/**
	 * Used to add multi-select drop down in blocks config
	 *
	 * @param string $field
	 * @param bool $sortable
	 * @param array $values
	 * @param string $label
	 * @return array
	 */
	public function build_multi_input($field, $sortable, array $values, $label = '')
	{
		return array(
			'field'		=> $field,
			'values'	=> array_filter((array) $values),
			'sortable'	=> $sortable,
			'label'		=> $label,
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_template()
	{
		return '@blitze_sitemaker/cfg_fields/multi_input.html';
	}
}
