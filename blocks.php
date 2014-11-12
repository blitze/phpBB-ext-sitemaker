<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * Used to add multi-select dropdown in blocks config
 */
function build_multi_select($option_ary, $selected_items, $key)
{
	global $user;

	$selected_items = explode(',', $selected_items);

	$html = '<select id="' . $key . '" name="config[' . $key . '][]" multiple="multiple">';
	foreach ($option_ary as $value => $title)
	{
		$title = (isset($user->lang[$title])) ? $user->lang[$title] : $title;
		$selected = (in_array($value, $selected_items)) ? ' selected="selected"' : '';
		$html .= '<option value="' . $value . '"' . $selected . '>' . $title . '</option>';
	}
	$html .= '</select>';

	return $html;
}

/**
 * Used to build multi-column checkboxes for blocks config
 */
function build_checkbox($option_ary, $selected_items, $key)
{
	global $user;

	$selected_items = explode(',', $selected_items);
	$id_assigned = false;
	$html = '';

	$test = current($option_ary);
	if (!is_array($test))
	{
		$option_ary = array($option_ary);
	}

	foreach ($option_ary as $col => $row)
	{
		$html .= '<div class="unit sizeAuto ' . $key . '-checkbox" id="' . $key . '-col-' . $col . '">';
		foreach ($row as $value => $title)
		{
			$selected = (in_array($value, $selected_items)) ? ' checked="checked"' : '';
			$title = (isset($user->lang[$title])) ? $user->lang[$title] : $title;
			$html .= '<label><input type="checkbox" name="config[' . $key . '][]"' . ((!$id_assigned) ? ' id="' . $key . '"' : '') . ' value="' . $value . '"' . $selected . (($key) ? ' accesskey="' . $key . '"' : '') . ' class="checkbox" /> ' . $title . '</label><br />';
			$id_assigned = true;
		}
		$html .= '</div>';
	}

	return $html;
}

/**
 * build hidden field for blocks config
 */
function build_hidden($value, $key)
{
	return '<input type="hidden" name="config[' . $key . ']" value="' . $value . '" />';
}
