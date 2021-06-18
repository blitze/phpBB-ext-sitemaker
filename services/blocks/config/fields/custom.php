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
class custom extends cfg_field_base
{
	/**
	 * @inheritdoc
	 */
	public function get_name()
	{
		return 'custom';
	}

	/**
	 * {@inheritdoc}
	 */
	public function prep_field(array &$vars, array &$type, $field, array $db_settings)
	{
		$vars['function'] = (!empty($vars['function'])) ? $vars['function'] : '';
		$type[0] = 'custom';
	}
}
