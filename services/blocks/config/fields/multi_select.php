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
class multi_select extends cfg_field_base
{
	/**
	 * @inheritdoc
	 */
	public function get_name()
	{
		return 'multi_select';
	}

	/**
	 * {@inheritdoc}
	 */
	public function prep_field(array &$vars, array &$type, $field, array $db_settings)
	{
		$vars['method'] ='build_multi_select';
		$vars['params'][] = $field;
		$type[0] = 'custom';
	}

	/**
	 * Used to add multi-select drop down in blocks config
	 *
	 * @param array $option_ary
	 * @param mixed $selected_items
	 * @param string $field
	 * @return string
	 */
	public function build_multi_select(array $option_ary, $selected_items, $field)
	{
		$this->ptemplate->assign_vars(array(
			'field'		=> $field,
			'options'	=> $option_ary,
			'selected'	=> cfg_utils::ensure_array($selected_items),
		));

		return $this->ptemplate->render_view('blitze/sitemaker', 'cfg_fields/multi_select.html', 'multi_select');

	}
}
