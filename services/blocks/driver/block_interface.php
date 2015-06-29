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
	 */
	public function get_name();

	/**
	 * Get block config
	 */
	public function get_config($db_data);

	/**
	 * Display block
	 */
	public function display($db_data);
}
