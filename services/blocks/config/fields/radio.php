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
class radio extends cfg_field_base
{
	/**
	 * @inheritdoc
	 */
	public function get_name()
	{
		return 'radio';
	}

	/**
	 * {@inheritdoc}
	 */
	public function prep_field(array &$vars, array &$type, $field, array $db_settings)
	{
		if (!isset($type[1]))
		{
			$vars['method'] = 'build_radio';
			$vars['params'][] = $field;
			$type[0] = 'custom';
		}
	}

	/**
	 * Build radio buttons other than yes_no/enable_disable in blocks config
	 *
	 * @param array $option_ary
	 * @param mixed $selected_item
	 * @param string $field
	 * @return string
	 */
	public function build_radio(array $option_ary, $selected_item, $field)
	{
		$selected_item = cfg_utils::ensure_array($selected_item);

		$this->ptemplate->assign_vars(array(
			'field'		=> $field,
			'options'	=> $option_ary,
			'selected'	=> array_pop($selected_item),
		));

		return $this->ptemplate->render_view('blitze/sitemaker', 'cfg_fields/radio.html', 'radio');
	}
}
