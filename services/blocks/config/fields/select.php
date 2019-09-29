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
class select extends cfg_field_base
{
	/**
	 * @inheritdoc
	 */
	public function get_name()
	{
		return 'select';
	}

	/**
	 * {@inheritdoc}
	 */
	public function prep_field(array &$vars, array &$type, $field, array $db_settings)
	{
		// set defaults for types: field type, size, multi select, toggle key
		$type += array('', 1, 0, '');

		$vars['method'] = 'build_select';
		$vars['params'][] = $field;
		$vars['params'][] = (int) $type[1];		// size
		$vars['params'][] = (bool) $type[2];	// multi select
		$vars['params'][] = (string) $type[3];	// togggle key
		$type[0] = 'custom';
	}

	/**
	 * Used to add a select drop down in blocks config
	 *
	 * @param array $options
	 * @param string $selected
	 * @param string $field
	 * @param int $size
	 * @param bool $multi_select
	 * @param string $togglable_key
	 * @return string
	 */
	public function build_select(array $options, $selected, $field, $size = 1, $multi_select = false, $togglable_key = '')
	{
		$this->ptemplate->assign_vars(array(
			'field'			=> $field,
			'selected'		=> cfg_utils::ensure_array($selected),
			'options'		=> $options,
			'size'			=> $size,
			'multi_select'	=> $multi_select,
			'togglable_key'	=> $togglable_key,
		));

		return $this->ptemplate->render_view('blitze/sitemaker', 'cfg_fields/select.html', 'select');
	}
}
