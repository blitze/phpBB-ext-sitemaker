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
class select implements cfg_field_interface
{
	/** @var \phpbb\language\language */
	protected $translator;

	/**
	 * Constructor
	 *
	 * @param \phpbb\language\language	$translator		Language object
	 */
	public function __construct(\phpbb\language\language $translator)
	{
		$this->translator = $translator;
	}

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
	 * @param array $option_ary
	 * @param string $selected_item
	 * @param string $key
	 * @param int $size
	 * @param bool $multi_select
	 * @param string $data_toggle_key
	 * @return string
	 */
	public function build_select(array $option_ary, $selected_item, $key, $size = 1, $multi_select = false, $data_toggle_key = '')
	{
		$selected_item = cfg_utils::ensure_array($selected_item);

		$options = $this->get_select_options($option_ary, $selected_item, $data_toggle_key);
		$data_toggle = ($data_toggle_key) ? ' data-togglable-settings="true"' : '';

		return '<select id="' . $key . '" name="config[' . $key . ']' . (($multi_select) ? '[]" multiple="multiple"' : '"') . (($size > 1) ? ' size="' . $size . '"' : '') . $data_toggle . '>' . $options . '</select>';
	}

	/**
	 * @param array $option_ary
	 * @param array $selected_items
	 * @param string $togglable_key
	 * @return string
	 */
	protected function get_select_options(array $option_ary, array $selected_items, $togglable_key)
	{
		$options = '';
		foreach ($option_ary as $value => $title)
		{
			$selected = cfg_utils::get_selected_option($value, $selected_items);
			$togglable_option = ($togglable_key) ? ' data-toggle-setting="#' . $togglable_key . '-' . $value . '"' : '';
			$options .= '<option value="' . $value . '"' . $selected . $togglable_option . '>' . $this->translator->lang($title) . '</option>';
		}
		return $options;
	}
}
