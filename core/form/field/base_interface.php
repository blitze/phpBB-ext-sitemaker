<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core\form\field;

/**
*
*/
interface base_interface
{
	/**
	 * Service name of content field
	 */
	public function get_name();

	/**
	 * Default content field properties
	 */
	public function get_default_props();

	/**
	 * Returns the value of the field
	 */
	public function get_field_value($name, $value);

	/**
	 * Display content field
	 */
	public function display_field($value);

	/**
	 * Render content field as form element
	 */
	public function render_view($name, &$data);

	/**
	 * Validate content field
	 */
	public function validate_field($row);

	/**
	 * Save content field
	 */
	public function save_field($field, $value);
}
