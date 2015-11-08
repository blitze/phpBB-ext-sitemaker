<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks;

use phpbb\db\driver\driver_interface;
use phpbb\request\request_interface;
use phpbb\template\template;
use phpbb\user;

class cfg_fields
{
	/** @var driver_interface */
	protected $db;

	/** @var request_interface */
	protected $request;

	/** @var template */
	protected $template;

	/** @var user */
	protected $user;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var string phpEx */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param driver_interface			$db						Database object
	 * @param request_interface			$request				Request object
	 * @param template					$template				Template object
	 * @param user						$user					User object
	 * @param string					$phpbb_root_path		phpBB root path
	 * @param string					$php_ext				phpEx
	 */
	public function __construct(driver_interface $db, request_interface $request, template $template, user $user, $phpbb_root_path, $php_ext)
	{
		$this->db = $db;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * @param array $block_data
	 * @param array $default_settings
	 * @return template|string
	 */
	public function get_edit_form(array $block_data, array $default_settings)
	{
		global $module;

		if (!function_exists('build_cfg_template'))
		{
			include($this->phpbb_root_path . 'includes/functions_acp.' . $this->php_ext);
		}

		// We fake this class as it is needed by the build_cfg_template function
		$module = new \stdClass();
		$module->module = $this;

		$this->_generate_config_fields($block_data['settings'], $default_settings);

		$this->template->assign_vars(array(
				'S_ACTIVE'		=> $block_data['status'],
				'S_TYPE'		=> $block_data['type'],
				'S_NO_WRAP'		=> $block_data['no_wrap'],
				'S_HIDE_TITLE'	=> $block_data['hide_title'],
				'S_BLOCK_CLASS'	=> trim($block_data['class']),
				'S_GROUP_OPS'	=> $this->_get_group_options($block_data['permission']),
		));

		$this->template->set_filenames(array(
				'block_settings' => 'block_settings.html',
		));

		return $this->template->assign_display('block_settings');
	}

	/**
	 * @param array $default_settings
	 * @return array|void
	 */
	public function get_submitted_settings(array $default_settings)
	{
		if (!function_exists('validate_config_vars'))
		{
			include($this->phpbb_root_path . 'includes/functions_acp.' . $this->php_ext);
		}

		$cfg_array = utf8_normalize_nfc($this->request->variable('config', array('' => ''), true));

		$errors = array();
		validate_config_vars($default_settings, $cfg_array, $errors);

		if (sizeof($errors))
		{
			return array('errors' => join("\n", $errors));
		}

		$this->_get_multi_select($cfg_array, $default_settings);

		return array_intersect_key($cfg_array, $default_settings);
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
	 * @param array $option_ary
	 * @param $selected_items
	 * @param $key
	 * @return string
	 */
	public function build_checkbox(array $option_ary, $selected_items, $key)
	{
		$column_class = 'grid__col grid__col--1-of-2 ';
		$id_assigned = false;
		$html = '';

		/** if multi-dimensional array, we break the checkboxes into columns
		 * ex.
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
		 */

		$selected_items = $this->_ensure_array($selected_items);
		$option_ary = $this->_ensure_multi_array($option_ary, $column_class);

		foreach ($option_ary as $col => $row)
		{
			$html .= '<div class="' . $column_class . $key . '-checkbox" id="' . $key . '-col-' . $col . '">';
			foreach ($row as $value => $title)
			{
				$selected = $this->_get_selected_option($value, $selected_items, 'checked');
				$title = $this->user->lang($title);
				$html .= '<label><input type="checkbox" name="config[' . $key . '][]"' . ((!$id_assigned) ? ' id="' . $key . '"' : '') . ' value="' . $value . '"' . $selected . ' accesskey="' . $key . '" class="checkbox" /> ' . $title . '</label><br />';
				$id_assigned = true;
			}
			$html .= '</div>';
		}

		return $html;
	}

	/**
	 * build hidden field for blocks config
	 * @param $value
	 * @param $key
	 * @return string
	 */
	public function build_hidden($value, $key)
	{
		return '<input type="hidden" name="config[' . $key . ']" value="' . $value . '" />';
	}

	/**
	 * Generate block configuration fields
	 * @param array $db_settings
	 * @param array $default_settings
	 */
	private function _generate_config_fields(array &$db_settings, array $default_settings)
	{
		foreach ($default_settings as $field => $vars)
		{
			if (!is_array($vars) && strpos($field, 'legend') === false)
			{
				continue;
			}

			if (strpos($field, 'legend') !== false)
			{
				$this->template->assign_block_vars('options', array(
						'S_LEGEND'	=> $field,
						'LEGEND'	=> $this->user->lang($vars)
				));

				continue;
			}

			$db_settings[$field] = $this->_get_field_value($field, $vars['default'], $db_settings);
			$content = $this->_get_field_template($field, $db_settings, $vars);

			if (empty($content))
			{
				continue;
			}

			$this->template->assign_block_vars('options', array(
							'KEY'			=> $field,
							'TITLE'			=> (!empty($vars['lang'])) ? $this->user->lang($vars['lang']) : '',
							'S_EXPLAIN'		=> $vars['explain'],
							'TITLE_EXPLAIN'	=> $vars['lang_explain'],
							'CONTENT'		=> $content)
			);
			unset($default_settings[$field]);
		}
	}

	/**
	 * @param $field
	 * @param array $db_settings
	 * @param array $vars
	 * @return string
	 */
	private function _get_field_template($field, array &$db_settings, array &$vars)
	{
		$vars['lang_explain'] = $this->_explain_field($vars);
		$vars['append'] = $this->_append_field($vars);

		$type = explode(':', $vars['type']);
		$method = '_prep_' . $type[0] . '_field_for_display';

		if (is_callable(array($this, $method)))
		{
			$this->_set_params($field, $vars, $db_settings);
			$this->$method($vars, $type, $field, $db_settings);
		}

		return build_cfg_template($type, $field, $db_settings, $field, $vars);
	}

	/**
	 * @param array $vars
	 * @return mixed|string
	 */
	private function _explain_field(array $vars)
	{
		$l_explain = '';
		if (!empty($vars['explain']))
		{
			$l_explain = (isset($vars['lang_explain'])) ? $this->user->lang($vars['lang_explain']) : $this->user->lang($vars['lang'] . '_EXPLAIN');
		}

		return $l_explain;
	}

	/**
	 * @param array $vars
	 * @return mixed|string
	 */
	private function _append_field(array $vars)
	{
		$append = '';
		if (!empty($vars['append']))
		{
			$append = $this->user->lang($vars['append']);
		}

		return $append;
	}

	/**
	 * @param $field
	 * @param $vars
	 * @param $settings
	 */
	private function _set_params($field, &$vars, $settings)
	{
		if (!empty($vars['options']))
		{
			$vars['params'][] = $vars['options'];
			$vars['params'][] = $settings[$field];
		}
	}

	/**
	 * @param $field
	 * @param $default
	 * @param $db_settings
	 * @return mixed
	 */
	private function _get_field_value($field, $default, $db_settings)
	{
		return (!empty($db_settings[$field])) ? $db_settings[$field] : $default;
	}

	/**
	 * @param $vars
	 */
	private function _prep_select_field_for_display(&$vars)
	{
		$this->_add_lang_vars($vars['params'][0]);

		$vars['function'] = (!empty($vars['function'])) ? $vars['function'] : 'build_select';
	}

	/**
	 * @param $vars
	 * @param $type
	 * @param $field
	 */
	private function _prep_checkbox_field_for_display(&$vars, &$type, $field)
	{
		$this->_add_lang_vars($vars['params'][0]);

		$vars['method'] = 'build_checkbox';
		$vars['params'][] = $field;
		$type[0] = 'custom';
	}

	/**
	 * @param $vars
	 * @param $type
	 * @param $field
	 */
	private function _prep_multi_select_field_for_display(&$vars, &$type, $field)
	{
		$this->_prep_checkbox_field_for_display($vars, $type, $field);

		$vars['method'] ='build_multi_select';
	}

	/**
	 * @param $vars
	 * @param $type
	 */
	private function _prep_hidden_field_for_display(&$vars, &$type)
	{
		$vars['method'] = 'build_hidden';
		$vars['explain'] = '';
		$type[0] = 'custom';
	}

	/**
	 * @param $vars
	 * @param $type
	 */
	private function _prep_custom_field_for_display(&$vars, &$type)
	{
		$vars['function'] = (!empty($vars['function'])) ? $vars['function'] : '';
		$type[0] = 'custom';
	}

	/**
	 * this looks bad but its the only way without modifying phpbb code
	 * this is for select items that do not need to be translated
	 * @param array $options
	 */
	private function _add_lang_vars(array $options)
	{
		foreach ($options as $title)
		{
			if (is_array($title))
			{
				$this->_add_lang_vars($title);
			}
			else if (!isset($this->user->lang[$title]))
			{
				$this->user->lang[$title] = $title;
			}
		}
	}

	/**
	 * @param array $cfg_array
	 * @param array $df_settings
	 */
	private function _get_multi_select(array &$cfg_array, array $df_settings)
	{
		$multi_select = utf8_normalize_nfc($this->request->variable('config', array('' => array('' => '')), true));
		$multi_select = array_filter($multi_select);

		foreach ($multi_select as $field => $settings)
		{
			$cfg_array[$field] = (!empty($settings)) ? $settings : $df_settings[$field]['default'];
		}
	}

	/**
	 * @param string $selected
	 * @return string
	 */
	private function _get_group_options($selected = '')
	{
		$selected = $this->_ensure_array($selected);

		$sql = 'SELECT group_id, group_name, group_type FROM ' . GROUPS_TABLE;
		$result = $this->db->sql_query($sql);

		$options = '<option value="0">' . $this->user->lang('ALL') . '</option>';
		while ($row = $this->db->sql_fetchrow($result))
		{
			$group_name = $this->_get_group_name($row);
			$selected_option = $this->_get_selected_option($row['group_id'], $selected);
			$options .= '<option' . (($row['group_type'] == GROUP_SPECIAL) ? ' class="sep"' : '') . ' value="' . $row['group_id'] . '"' . $selected_option . '>' . $group_name . '</option>';
		}
		$this->db->sql_freeresult($result);

		return $options;
	}

	/**
	 * @param array $row
	 * @return mixed|string
	 */
	private function _get_group_name(array $row)
	{
		return ($row['group_type'] == GROUP_SPECIAL) ? $this->user->lang('G_' . $row['group_name']) : ucfirst($row['group_name']);
	}

	/**
	 * @param string $needle
	 * @param array $haystack
	 * @param string $type selected|checked
	 * @return string
	 */
	private function _get_selected_option($needle, array $haystack, $type = 'selected')
	{
		return (in_array($needle, $haystack)) ? ' ' . $type . '="' . $type . '"' : '';
	}

	/**
	 * @param $selected_items
	 * @return array
	 */
	private function _ensure_array($selected_items)
	{
		return array_filter(is_array($selected_items) ? $selected_items : explode(',', $selected_items));
	}

	/**
	 * @param $options
	 * @param $css_class
	 * @return array
	 */
	private function _ensure_multi_array($options, &$css_class)
	{
		$test = current($this->_ensure_array($options));
		if (!is_array($test))
		{
			$css_class = '';
			$options = array($options);
		}
		return $options;
	}
}
