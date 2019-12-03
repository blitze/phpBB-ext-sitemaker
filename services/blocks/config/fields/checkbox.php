<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\config\fields;

use blitze\sitemaker\services\blocks\config\cfg_utils;

/**
 * @package sitemaker
 */
class checkbox extends cfg_field_base
{
	/**
	 * @inheritdoc
	 */
	public function get_name()
	{
		return 'checkbox';
	}

	/**
	 * {@inheritdoc}
	 */
	public function prep_field(array &$vars, array &$type, $field, array $db_settings)
	{
		// set defaults for types: field type, css class
		$type += array('', 0);

		$vars['method'] = 'build_checkbox';
		$vars['params'][] = $field;
		$vars['params'][] = (string) $type[1];	// css class to be applied to list
		$type[0] = 'custom';
	}

	/**
	 * Used to build multi-column checkboxes for blocks config
	 *
	 * if multi-dimensional array, we break the checkboxes into columns ex.
	 * array(
	 * 		'news' => array(
	 * 			'field1' => 'Label 1',
	 * 			'field2' => 'Label 2',
	 * 		),
	 * 		'articles' => array(
	 * 			'field1' => 'Label 1',
	 * 			'field2' => 'Label 2',
	 * 		),
	 * )
	 * @param array $option_ary
	 * @param mixed $selected_items
	 * @param string $field
	 * @param string $css_class
	 * @return string
	 */
	public function build_checkbox(array $option_ary, $selected_items, $field, $css_class = '')
	{
		$column_class = 'col ';
		$selected_items = cfg_utils::ensure_array($selected_items);
		$option_ary = cfg_utils::ensure_multi_array($option_ary, $column_class);

		$this->ptemplate->assign_vars(array(
			'field'		=> $field,
			'selected'	=> $selected_items,
			'columns'	=> $option_ary,
			'class'		=> $column_class,
			'sortable'	=> $css_class,
		));

		return $this->ptemplate->render_view('blitze/sitemaker', 'cfg_fields/checkbox.html', 'checkbox');
	}
}
