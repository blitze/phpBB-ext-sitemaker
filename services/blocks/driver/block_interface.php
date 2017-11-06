<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\driver;

interface block_interface
{
	/**
	 * Get service name
	 *
	 * @return string
	 */
	public function get_name();

	/**
	 * Get block default settings
	 *
	 * @param array $settings
	 * @return mixed[]
	 */
	public function get_config(array $settings);

	/**
	 * Display block
	 *
	 * @param array $settings
	 * @param bool|false $edit_mode
	 * @return array
	 */
	public function display(array $settings, $edit_mode = false);
}
