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
class hidden extends cfg_field_base
{
	/**
	 * @inheritdoc
	 */
	public function get_name()
	{
		return 'hidden';
	}

	/**
	 * {@inheritdoc}
	 */
	public function prep_field(array &$vars, array &$type, $field, array $db_settings)
	{
		unset($vars);
	}
}
