<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model;

interface entity_interface
{
	/**
	 * Get an associative array with the values assigned to the fields of the entity, ready for display
	 * @return array
	 */
	public function to_array();

	/**
	 * Get an associative array with the raw values assigned to the fields of the entity, ready for storage
	 * This array only contains database fields in a form that can be saved to a database with all required fields
	 * @return array
	 */
	public function to_db();
}
