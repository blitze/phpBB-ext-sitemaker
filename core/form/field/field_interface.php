<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core\form\field;

interface field_interface
{
	/**
	 * Short name of content field
	 */
	public function get_name();

	/**
	 * Lang name of content field
	 */
	public function get_langname();

	/**
	 * Default content field properties
	 */
	public function get_default_props();

	/**
	 * Returns the value of the field
	 */
	public function get_field_value($field_name, $field_value);

	/**
	 * Display content field
	 */
	public function display_field($field_value, $field_data, $view = 'detail', $item_id = 0);

	/**
	 * Render content field as form element
	 */
	public function render_view($field_name, &$field_data, $item_id = 0);

	/**
	 * Validate content field
	 */
	public function validate_field($field_data);

	/**
	 * Save content field
	 */
	public function save_field($field_name, $field_value, $item_id);
}
