<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\config\fields;

interface cfg_field_interface
{
	/**
	 * Get service name
	 *
	 * @return string
	 */
	public function get_name();

	/**
	 * @param array $vars
	 * @param array $type
	 * @param string $field
	 * @param array $db_settings
	 */
	public function prep_field(array &$vars, array &$type, $field, array $db_settings);
}
