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
class multi_select implements cfg_field_interface
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
		return 'multi_select';
	}

	/**
	 * {@inheritdoc}
	 */
	public function prep_field(array &$vars, array &$type, $field, array $db_settings)
	{
		$vars['method'] ='build_multi_select';
		$vars['params'][] = $field;
		$type[0] = 'custom';
	}

	/**
	 * Used to add multi-select drop down in blocks config
	 *
	 * @param array $option_ary
	 * @param mixed $selected_items
	 * @param string $field
	 * @return string
	 */
	public function build_multi_select(array $option_ary, $selected_items, $field)
	{
		$selected_items = cfg_utils::ensure_array($selected_items);

		$html = '<select id="' . $field . '" name="config[' . $field . '][]" multiple="multiple">';
		foreach ($option_ary as $value => $title)
		{
			$selected = cfg_utils::get_selected_option($value, $selected_items);
			$html .= '<option value="' . $value . '"' . $selected . '>' . $this->translator->lang($title) . '</option>';
		}
		$html .= '</select>';

		return $html;
	}
}
