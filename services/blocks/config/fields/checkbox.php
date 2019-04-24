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
class checkbox implements cfg_field_interface
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
		return 'checkbox';
	}

	/**
	 * {@inheritdoc}
	 */
	public function prep_field(array &$vars, array &$type, $field, array $db_settings)
	{
		$vars['method'] = 'build_checkbox';
		$vars['params'][] = $field;
		$type[0] = 'custom';
	}

	/**
	 * Used to build multi-column checkboxes for blocks config
	 *
	 * if multi-dimensional array, we break the checkboxes into columns ex.
	 * array(
	 * 		'news' => array(
	 * 			'field1' => 'Label 1',
	 * 			'field2' => 'Label 2',
	 * 		),
	 * 		'articles' => array(
	 * 			'field1' => 'Label 1',
	 * 			'field2' => 'Label 2',
	 * 		),
	 * )
	 * @param array $option_ary
	 * @param mixed $selected_items
	 * @param string $field
	 * @return string
	 */
	public function build_checkbox(array $option_ary, $selected_items, $field)
	{
		$index = 0;
		$column_class = 'col ';
		$selected_items = cfg_utils::ensure_array($selected_items);
		$option_ary = cfg_utils::ensure_multi_array($option_ary, $column_class);

		$html = '';
		foreach ($option_ary as $col => $row)
		{
			$html .= $this->get_checkbox_column($row, $selected_items, $field, $column_class, $col, $index);
		}

		return ($column_class) ? '<div class="grid-noBottom">' . $html . '</div>' : $html;
	}

	/**
	 * @param array $row
	 * @param array $selected_items
	 * @param string $field
	 * @param string $column_class
	 * @param int $column_count
	 * @param int $index
	 * @return string
	 */
	protected function get_checkbox_column(array $row, array $selected_items, $field, $column_class, $column_count, &$index)
	{
		$column = "<div class=\"{$column_class}{$field}-checkbox\" id=\"{$field}-col-{$column_count}\">";
		foreach ($row as $value => $title)
		{
			$title = $this->translator->lang($title);
			$selected = cfg_utils::get_selected_option($value, $selected_items, 'checked');
			$column .= '<label><input type="checkbox" name="config[' . $field . '][' . $index . ']" value="' . $value . '"' . $selected . ' class="checkbox" /> ' . $title . '</label><br />';
			$index++;
		}
		$column .= '</div>';

		return $column;
	}
}
