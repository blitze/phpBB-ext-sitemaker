<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks;

class cfg_fields
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var string phpEx */
	protected $php_ext;

	/** @var string */
	private static $separator = "\n";

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver_interface			$db						Database object
	 * @param \phpbb\request\request_interface			$request				Request object
	 * @param \phpbb\template\template					$template				Template object
	 * @param \phpbb\user								$user					User object
	 * @param string									$phpbb_root_path		phpBB root path
	 * @param string									$php_ext				phpEx
	 */
	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\request\request_interface $request, \phpbb\template\template $template, \phpbb\user $user, $phpbb_root_path, $php_ext)
	{
		$this->db = $db;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	public function get_edit_form(array $bdata, array $default_settings)
	{
		global $module;

		if (!function_exists('build_cfg_template'))
		{
			include($this->phpbb_root_path . 'includes/functions_acp.' . $this->php_ext);
		}

		// We fake this class as it is needed by the build_cfg_template function
		$module = new \stdClass();
		$module->module = $this;

		$this->_generate_config_fields($bdata['settings'], $default_settings);

		$this->template->assign_vars(array(
			'S_ACTIVE'		=> $bdata['status'],
			'S_TYPE'		=> $bdata['type'],
			'S_NO_WRAP'		=> $bdata['no_wrap'],
			'S_HIDE_TITLE'	=> $bdata['hide_title'],
			'S_BLOCK_CLASS'	=> trim($bdata['class']),
			'S_GROUP_OPS'	=> $this->_get_group_options($bdata['permission']),
		));

		$this->template->set_filenames(array(
			'block_settings' => 'block_settings.html',
		));

		return $this->template->assign_display('block_settings');
	}

	public function get_submitted_settings(array $default_settings)
	{
		if (!function_exists('validate_config_vars'))
		{
			include($this->phpbb_root_path . 'includes/functions_acp.' . $this->php_ext);
		}

		$cfg_array = utf8_normalize_nfc($this->request->variable('config', array('' => ''), true));

		$this->_get_multi_select($cfg_array, $default_settings);

		$errors = array();
		validate_config_vars($default_settings, $cfg_array, $errors);

		if (sizeof($errors))
		{
			return array('errors' => join("\n", $errors));
		}

		return array_intersect_key($cfg_array, $default_settings);
	}

	/**
	 * Used to add multi-select dropdown in blocks config
	 */
	public function build_multi_select(array $option_ary, $selected_items, $key)
	{
		$selected_items = explode(self::$separator, $selected_items);

		$html = '<select id="' . $key . '" name="config[' . $key . '][]" multiple="multiple">';
		foreach ($option_ary as $value => $title)
		{
			$title = $this->user->lang($title);
			$selected = (in_array($value, $selected_items)) ? ' selected="selected"' : '';
			$html .= '<option value="' . $value . '"' . $selected . '>' . $title . '</option>';
		}
		$html .= '</select>';

		return $html;
	}

	/**
	 * Used to build multi-column checkboxes for blocks config
	 */
	public function build_checkbox(array $option_ary, $selected_items, $key)
	{
		$selected_items = explode(self::$separator, $selected_items);
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
		$test = current($option_ary);
		if (!is_array($test))
		{
			$column_class = '';
			$option_ary = array($option_ary);
		}

		foreach ($option_ary as $col => $row)
		{
			$html .= '<div class="' . $column_class . $key . '-checkbox" id="' . $key . '-col-' . $col . '">';
			foreach ($row as $value => $title)
			{
				$selected = (in_array($value, $selected_items)) ? ' checked="checked"' : '';
				$title = $this->user->lang($title);
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
	public function build_hidden($value, $key)
	{
		return '<input type="hidden" name="config[' . $key . ']" value="' . $value . '" />';
	}

	/**
	 * Generate block configuration fields
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

	private function _get_field_template($field, array &$db_settings, array &$vars)
	{
		$vars['lang_explain'] = $this->_explain_field($vars);
		$vars['append'] = $this->_append_field($vars);

		$type = explode(':', $vars['type']);
		$method = '_prep_' . $type[0] . '_field_for_display';

		if (is_callable(array($this, $method)))
		{
			$this->$method($vars, $type, $field, $db_settings);
		}

		return build_cfg_template($type, $field, $db_settings, $field, $vars);
	}

	private function _explain_field(array $vars)
	{
		$l_explain = '';
		if (!empty($vars['explain']))
		{
			$l_explain = (isset($vars['lang_explain'])) ? $this->user->lang($vars['lang_explain']) : $this->user->lang($vars['lang'] . '_EXPLAIN');
		}

		return $l_explain;
	}

	private function _append_field(array $vars)
	{
		$append = '';
		if (!empty($vars['append']))
		{
			$append = $this->user->lang($vars['append']);
		}

		return $append;
	}

	private function _prep_select_field_for_display(&$vars)
	{
		$this->_add_lang_vars($vars['params'][0]);

		$vars['function'] = (!empty($vars['function'])) ? $vars['function'] : 'build_select';
	}

	private function _prep_checkbox_field_for_display(&$vars, &$type, $field, &$db_settings)
	{
		$this->_add_lang_vars($vars['params'][0]);

		$vars['method'] = 'build_checkbox';
		$vars['params'][] = $field;
		$type[0] = 'custom';

		if (!empty($db_settings[$field]))
		{
			$db_settings[$field] = explode(self::$separator, $db_settings[$field]);
		}
	}

	private function _prep_multi_select_field_for_display(&$vars, &$type, $field, &$db_settings)
	{
		$this->_prep_checkbox_field_for_display($vars, $type, $field, $db_settings);

		$vars['method'] ='build_multi_select';
	}

	private function _prep_hidden_field_for_display(&$vars, &$type)
	{
		$vars['method'] = 'build_hidden';
		$vars['explain'] = '';
		$type[0] = 'custom';
	}

	private function _prep_custom_field_for_display(&$vars, &$type)
	{
		$vars['function'] = (!empty($vars['function'])) ? $vars['function'] : '';
		$type[0] = 'custom';
	}

	/**
	 * this looks bad but its the only way without modifying phpbb code
	 * this is for select items that do not need to be translated
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

	private function _get_multi_select(array &$cfg_array, array $df_settings)
	{
		$multi_select = utf8_normalize_nfc($this->request->variable('config', array('' => array('' => ''))));

		$multi_select = array_filter($multi_select);

		foreach ($multi_select as $key => $values)
		{
			$cfg_array[$key] = array_filter($values, 'strlen');
			$cfg_array[$key] = (sizeof($cfg_array[$key])) ? join(self::$separator, $cfg_array[$key]) : $df_settings[$key]['default'];
		}
	}

	private function _get_group_options($selected = '')
	{
		$selected = array_filter((!is_array($selected)) ? explode(',', $selected) : $selected);

		$sql = 'SELECT group_id, group_name, group_type
			FROM ' . GROUPS_TABLE;
		$result = $this->db->sql_query($sql);

		$options = '<option value="0"' . ((!sizeof($selected)) ? ' selected="selected"' : '') . '>' . $this->user->lang('ALL') . '</option>';
		while ($row = $this->db->sql_fetchrow($result))
		{
			$selected_option = (in_array($row['group_id'], $selected)) ? ' selected="selected"' : '';
			$group_name = ($row['group_type'] == GROUP_SPECIAL) ? $this->user->lang('G_' . $row['group_name']) : ucfirst($row['group_name']);
			$options .= '<option' . (($row['group_type'] == GROUP_SPECIAL) ? ' class="sep"' : '') . ' value="' . $row['group_id'] . '"' . $selected_option . '>' . $group_name . '</option>';
		}
		$this->db->sql_freeresult($result);

		return $options;
	}
}
