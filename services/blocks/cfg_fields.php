<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks;

abstract class cfg_fields
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
		$selected_item = $this->ensure_array($selected_item);

		$options = $this->get_select_options($option_ary, $selected_item, $data_toggle_key);
		$data_toggle = ($data_toggle_key) ? ' data-togglable-settings="true"' : '';

		return '<select id="' . $key . '" name="config[' . $key . ']' . (($multi_select) ? '[]" multiple="multiple"' : '"') . (($size > 1) ? ' size="' . $size . '"' : '') . $data_toggle . '>' . $options . '</select>';
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
		$selected_items = $this->ensure_array($selected_items);

		$html = '<select id="' . $field . '" name="config[' . $field . '][]" multiple="multiple">';
		foreach ($option_ary as $value => $title)
		{
			$selected = $this->get_selected_option($value, $selected_items);
			$html .= '<option value="' . $value . '"' . $selected . '>' . $this->translator->lang($title) . '</option>';
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
	 * @param mixed $selected_items
	 * @param string $field
	 * @return string
	 */
	public function build_checkbox(array $option_ary, $selected_items, $field)
	{
		$index = 0;
		$column_class = 'col ';
		$selected_items = $this->ensure_array($selected_items);
		$option_ary = $this->ensure_multi_array($option_ary, $column_class);

		$html = '';
		foreach ($option_ary as $col => $row)
		{
			$html .= $this->get_checkbox_column($row, $selected_items, $field, $column_class, $col, $index);
		}

		return ($column_class) ? '<div class="grid-noBottom">' . $html . '</div>' : $html;
	}

	/**
	 * Build radio buttons other than yes_no/enable_disable in blocks config
	 *
	 * @param array $option_ary
	 * @param mixed $selected_item
	 * @param string $key
	 * @return string
	 */
	public function build_radio(array $option_ary, $selected_item, $key)
	{
		$selected_item = (is_array($selected_item)) ? $selected_item : array($selected_item);

		$html = '';
		foreach ($option_ary as $value => $title)
		{
			$selected = $this->get_selected_option($value, $selected_item, 'checked');
			$html .= '<label><input type="radio" name="config[' . $key . ']" value="' . $value . '"' . $selected . ' class="radio" /> ' . $this->translator->lang($title) . '</label><br />';
		}

		return $html;
	}

	/**
	 * Used to add a code editor to blocks config
	 *
	 * @param string $key
	 * @param string $value
	 * @param string $explain
	 * @param array $data_props
	 * @param string $label
	 * @return string
	 */
	public function build_code_editor($key, $value, $explain, array $data_props = array(), $label = '')
	{
		$html = '';
		$id = $key . '-editor';
		$class = $id . '-button';
		$attributes = $this->get_code_editor_attributes($data_props);

		$html .= ($label) ? '<label for="' . $key . '"><strong>' . $this->translator->lang($label) . '</strong></label>' : '';
		$html .= ($explain) ? '<span>' . $explain . '</span>' : '';
		$html .= '<textarea id="' . $id . '" class="code-editor" name="config[' . $key . ']"' . $attributes . '>' . $value . '</textarea>';
		$html .= '<div class="align-right">';
		$html .= '<button class="' . $class . ' CodeMirror-button" data-action="undo" title="' . $this->translator->lang('UNDO') . '"><i class="fa fa-undo" aria-hidden="true"></i></button>';
		$html .= '<button class="' . $class . ' CodeMirror-button" data-action="redo" title="' . $this->translator->lang('REDO') . '"><i class="fa fa-repeat" aria-hidden="true"></i></button>';
		$html .= '<button class="' . $class . ' CodeMirror-button" data-action="clear" title="' . $this->translator->lang('CLEAR') . '"><i class="fa fa-ban" aria-hidden="true"></i></button>';
		$html .= $this->fullscreen_allowed($data_props) ? '<button class="' . $class . ' CodeMirror-button" data-action="fullscreen" title="' . $this->translator->lang('FULLSCREEN') . '"><i class="fa fa-window-restore" aria-hidden="true"></i></button>' : '';
		$html .= '</div>';

		return $html;
	}

	/**
	 * @param array $data_props
	 * @return bool
	 */
	protected function fullscreen_allowed(array $data_props = array())
	{
		return (!isset($data_props['allow-full-screen']) || $data_props['allow-full-screen']);
	}

	/**
	 * @param array $data_props
	 * @return string
	 */
	protected function get_code_editor_attributes(array $data_props = array())
	{
		$attributes = '';
		foreach ($data_props as $prop => $value)
		{
			$value = (gettype($value) === 'boolean') ? (int) $value : $value;
			$attributes .= " data-{$prop}=\"{$value}\"";
		}
		return $attributes;
	}

	/**
	 * Force array
	 *
	 * @param mixed $items
	 * @return array
	 */
	protected function ensure_array($items)
	{
		return is_array($items) ? $items : explode(',', $items);
	}

	/**
	 * Force multi dimensional array
	 *
	 * @param mixed $options
	 * @param string $css_class
	 * @return array
	 */
	protected function ensure_multi_array($options, &$css_class)
	{
		$test = current($this->ensure_array($options));
		if (!is_array($test))
		{
			$css_class = '';
			$options = array($options);
		}

		return array_map('array_filter', $options);
	}

	/**
	 * @param string $needle
	 * @param array $haystack
	 * @param string $type selected|checked
	 * @return string
	 */
	protected function get_selected_option($needle, array $haystack, $type = 'selected')
	{
		return (in_array($needle, $haystack)) ? ' ' . $type . '="' . $type . '"' : '';
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
			$selected = $this->get_selected_option($value, $selected_items, 'checked');
			$column .= '<label><input type="checkbox" name="config[' . $field . '][' . $index . ']" value="' . $value . '"' . $selected . ' class="checkbox" /> ' . $title . '</label><br />';
			$index++;
		}
		$column .= '</div>';

		return $column;
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
			$selected = $this->get_selected_option($value, $selected_items);
			$togglable_option = ($togglable_key) ? ' data-toggle-setting="#' . $togglable_key . '-' . $value . '"' : '';
			$options .= '<option value="' . $value . '"' . $selected . $togglable_option . '>' . $this->translator->lang($title) . '</option>';
		}
		return $options;
	}
}
