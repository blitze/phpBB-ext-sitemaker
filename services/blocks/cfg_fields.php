<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks;

use phpbb\user;

abstract class cfg_fields
{
	/** @var user */
	protected $user;

	/**
	 * Constructor
	 *
	 * @param user	$user	User object
	 */
	public function __construct(user $user)
	{
		$this->user = $user;
	}

	/**
	 * Used to add multi-select drop down in blocks config
	 *
	 * @param array $option_ary
	 * @param $selected_items
	 * @param $key
	 * @return string
	 */
	public function build_multi_select(array $option_ary, $selected_items, $key)
	{
		$selected_items = $this->_ensure_array($selected_items);
		$html = '<select id="' . $key . '" name="config[' . $key . '][]" multiple="multiple">';
		foreach ($option_ary as $value => $title)
		{
			$title = $this->user->lang($title);
			$selected = $this->_get_selected_option($value, $selected_items);
			$html .= '<option value="' . $value . '"' . $selected . '>' . $title . '</option>';
		}
		$html .= '</select>';

		return $html;
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
	 * @param $selected_items
	 * @param $field
	 * @return string
	 */
	public function build_checkbox(array $option_ary, $selected_items, $field)
	{
		$column_class = 'grid__col grid__col--1-of-2 ';
		$html = '';

		$selected_items = $this->_ensure_array($selected_items);
		$option_ary = $this->_ensure_multi_array($option_ary, $column_class);

		foreach ($option_ary as $col => $row)
		{
			$html .= $this->_get_checkbox_column($row, $selected_items, $field, $col, $column_class);
		}

		return $html;
	}

	/**
	 * build hidden field for blocks config
	 *
	 * @param $value
	 * @param $key
	 * @return string
	 */
	public function build_hidden($value, $key)
	{
		return '<input type="hidden" name="config[' . $key . ']" value="' . $value . '" />';
	}

	/**
	 * @param $selected_items
	 * @return array
	 */
	protected function _ensure_array($selected_items)
	{
		return array_filter(is_array($selected_items) ? $selected_items : explode(',', $selected_items));
	}

	/**
	 * @param $options
	 * @param $css_class
	 * @return array
	 */
	protected function _ensure_multi_array($options, &$css_class)
	{
		$test = current($this->_ensure_array($options));
		if (!is_array($test))
		{
			$css_class = '';
			$options = array($options);
		}
		return $options;
	}

	/**
	 * @param string $needle
	 * @param array $haystack
	 * @param string $type selected|checked
	 * @return string
	 */
	protected function _get_selected_option($needle, array $haystack, $type = 'selected')
	{
		return (in_array($needle, $haystack)) ? ' ' . $type . '="' . $type . '"' : '';
	}

	/**
	 * @param array $row
	 * @param array $selected_items
	 * @param string $field
	 * @param integer $column_count
	 * @param string $column_class
	 * @return string
	 */
	protected function _get_checkbox_column(array $row, array $selected_items, $field, $column_count, $column_class)
	{
		$column = '<div class="' . $column_class . $field . '-checkbox" id="' . $field . '-col-' . $column_count . '">';
		foreach ($row as $value => $title)
		{
			$title = $this->user->lang($title);
			$selected = $this->_get_selected_option($value, $selected_items, 'checked');
			$column .= '<label><input type="checkbox" name="config[' . $field . '][]" value="' . $value . '"' . $selected . ' accesskey="' . $field . '" class="checkbox" /> ' . $title . '</label><br />';
		}
		$column .= '</div>';

		return $column;
	}
}
