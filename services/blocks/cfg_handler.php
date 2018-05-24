<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks;

class cfg_handler extends cfg_fields
{
	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \blitze\sitemaker\services\groups */
	protected $groups;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var string phpEx */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\request\request_interface		$request				Request object
	 * @param \phpbb\template\template				$template				Template object
	 * @param \phpbb\language\language				$translator				Language object
	 * @param \blitze\sitemaker\services\groups		$groups					Groups object
	 * @param string								$phpbb_root_path		phpBB root path
	 * @param string								$php_ext				phpEx
	 */
	public function __construct(\phpbb\request\request_interface $request, \phpbb\template\template $template, \phpbb\language\language $translator, \blitze\sitemaker\services\groups $groups, $phpbb_root_path, $php_ext)
	{
		parent::__construct($translator);

		$this->request = $request;
		$this->template = $template;
		$this->translator = $translator;
		$this->groups = $groups;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * @param array $block_data
	 * @param array $default_settings
	 * @return mixed
	 */
	public function get_edit_form(array $block_data, array $default_settings)
	{
		// @codeCoverageIgnoreStart
		if (!function_exists('build_cfg_template'))
		{
			include($this->phpbb_root_path . 'includes/functions_acp.' . $this->php_ext);
		}
		// @codeCoverageIgnoreEnd

		$this->generate_config_fields($block_data['settings'], $default_settings);

		return $this->get_form($block_data);
	}

	/**
	 * @param array $default_settings
	 * @return array
	 */
	public function get_submitted_settings(array $default_settings)
	{
		$cfg_array = $this->request->variable('config', array('' => ''), true);
		$cfg_array = $this->decode_source_html($cfg_array);
		$errors = $this->validate_block_settings($default_settings, $cfg_array);

		if (sizeof($errors))
		{
			return array('errors' => join("\n", $errors));
		}

		$this->get_multi_select($cfg_array, $default_settings);

		return array_intersect_key($cfg_array, $default_settings);
	}

	/**
	 * @param array $default_settings
	 * @param array $cfg_array
	 * @return array
	 */
	protected function validate_block_settings(array $default_settings, array $cfg_array)
	{
		// @codeCoverageIgnoreStart
		if (!function_exists('validate_config_vars'))
		{
			include($this->phpbb_root_path . 'includes/functions_acp.' . $this->php_ext);
		}
		// @codeCoverageIgnoreEnd

		$errors = array();
		validate_config_vars($default_settings, $cfg_array, $errors);

		return $errors;
	}

	/**
	 * As a workaround to prevent mod_security and similar from preventing us from posting html/script,
	 * we use encodeURI before submitting data via ajax (see develop/blocks/manager.js).
	 * This decodes the data before submitting to the database
	 *
	 * @param array $cfg_array
	 * @return array
	 */
	private function decode_source_html(array $cfg_array)
	{
		if (isset($cfg_array['source']))
		{
			$cfg_array['source'] = rawurldecode($cfg_array['source']);
		}

		return $cfg_array;
	}

	/**
	 * Get the html form
	 *
	 * @param array $block_data
	 * @return mixed
	 */
	private function get_form(array $block_data)
	{
		$selected_groups = $this->ensure_array($block_data['permission']);

		$this->template->assign_vars(array(
			'S_ACTIVE'		=> $block_data['status'],
			'S_TYPE'		=> $block_data['type'],
			'S_VIEW'		=> $block_data['view'],
			'S_HIDE_TITLE'	=> $block_data['hide_title'],
			'S_BLOCK_CLASS'	=> trim($block_data['class']),
			'S_GROUP_OPS'	=> $this->groups->get_options('all', $selected_groups),
		));

		$this->template->set_filenames(array(
			'block_settings' => 'block_settings.html',
		));

		return $this->template->assign_display('block_settings');
	}

	/**
	 * Generate block configuration fields
	 *
	 * @param array $db_settings
	 * @param array $default_settings
	 */
	private function generate_config_fields(array &$db_settings, array $default_settings)
	{
		foreach ($default_settings as $field => $vars)
		{
			if (!$this->is_input_field($field, $vars))
			{
				continue;
			}

			// set some defaults for optional props
			$vars += array(
				'explain'		=> false,
				'lang_explain'	=> '',
				'lang'			=> '', // optional for hidden field type
			);

			$db_settings[$field] = $this->get_field_value($field, $vars['default'], $db_settings);
			$content = $this->get_field_template($field, $db_settings, $vars);

			$this->template->assign_block_vars('options', array(
				'KEY'			=> $field,
				'TITLE'			=> $this->translator->lang($vars['lang']),
				'S_EXPLAIN'		=> $vars['explain'],
				'TITLE_EXPLAIN'	=> $vars['lang_explain'],
				'CONTENT'		=> $content,
			));
		}
	}

	/**
	 * Get the field html
	 *
	 * @param string $field
	 * @param array $db_settings
	 * @param array $vars
	 * @return string
	 */
	private function get_field_template($field, array &$db_settings, array &$vars)
	{
		global $module;

		$vars['lang_explain'] = $this->explain_field($vars);
		$vars['append'] = $this->append_field($vars);

		$type = explode(':', $vars['type']);

		// We fake this class as it is needed by the build_cfg_template function
		$module = new \stdClass();
		$module->module = $this->get_field_object($vars, $type, $db_settings, $field);

		return build_cfg_template($type, $field, $db_settings, $field, $vars);
	}

	/**
	 * @param array $vars
	 * @param array $type
	 * @param array $db_settings
	 * @param string $field
	 * @return object
	 */
	private function get_field_object(array &$vars, array &$type, array &$db_settings, $field)
	{
		if (empty($vars['object']))
		{
			$object = $this;
			$method = 'prep_' . $type[0] . '_field_for_display';

			if (is_callable(array($this, $method)))
			{
				$this->set_params($field, $vars, $db_settings);
				$this->$method($vars, $type, $field, $db_settings);
			}
		}
		else
		{
			$object = $vars['object'];
			$this->set_params($field, $vars, $db_settings);
		}

		return $object;
	}

	/**
	 * Set field legend
	 *
	 * @param string $field
	 * @param string|array $vars
	 * @return boolean
	 */
	private function is_input_field($field, $vars)
	{
		return ($this->set_legend($field, $vars) || !is_array($vars)) ? false : true;
	}

	/**
	 * Set field legend
	 *
	 * @param string $field
	 * @param string|array $vars
	 * @return boolean
	 */
	private function set_legend($field, $vars)
	{
		if (strpos($field, 'legend') !== false)
		{
			$this->template->assign_block_vars('options', array(
				'S_LEGEND'	=> $field,
				'LEGEND'	=> $this->translator->lang($vars)
			));

			return true;
		}

		return false;
	}

	/**
	 * Get field details
	 *
	 * @param array $vars
	 * @return mixed|string
	 */
	private function explain_field(array $vars)
	{
		$l_explain = '';
		if (!empty($vars['explain']))
		{
			$l_explain = (!empty($vars['lang_explain'])) ? $this->translator->lang($vars['lang_explain']) : $this->translator->lang($vars['lang'] . '_EXPLAIN');
		}

		return $l_explain;
	}

	/**
	 * Add text after field
	 *
	 * @param array $vars
	 * @return mixed|string
	 */
	private function append_field(array $vars)
	{
		$append = '';
		if (!empty($vars['append']))
		{
			$append = $this->translator->lang($vars['append']);
		}

		return $append;
	}

	/**
	 * Set field parameters
	 *
	 * @param string $field
	 * @param array $vars
	 * @param array $settings
	 */
	private function set_params($field, array &$vars, array $settings)
	{
		if (isset($vars['options']))
		{
			$vars['params'][] = $vars['options'];
			$vars['params'][] = $settings[$field];
		}
	}

	/**
	 * Get field value
	 *
	 * @param string $field
	 * @param mixed $default
	 * @param array $db_settings
	 * @return mixed
	 */
	private function get_field_value($field, $default, array $db_settings)
	{
		return (isset($db_settings[$field])) ? $db_settings[$field] : $default;
	}

	/**
	 * @param array $vars
	 * @param array $type
	 * @param string $field
	 */
	private function prep_select_field_for_display(array &$vars, array &$type, $field)
	{
		// set defaults for types: field type, size, multi select, toggle key
		$type += array('', 1, false, '');

		$vars['method'] = 'build_select';
		$vars['params'][] = $field;
		$vars['params'][] = (int) $type[1];		// size
		$vars['params'][] = (bool) $type[2];	// multi select
		$vars['params'][] = (string) $type[3];	// togggle key
		$type[0] = 'custom';
	}

	/**
	 * @param array $vars
	 * @param array $type
	 * @param string $field
	 */
	private function prep_checkbox_field_for_display(array &$vars, array &$type, $field)
	{
		$vars['method'] = 'build_checkbox';
		$vars['params'][] = $field;
		$type[0] = 'custom';
	}

	/**
	 * @param array $vars
	 * @param array $type
	 * @param string $field
	 */
	private function prep_radio_field_for_display(array &$vars, array &$type, $field)
	{
		if (!isset($type[1]))
		{
			$vars['method'] = 'build_radio';
			$vars['params'][] = $field;
			$type[0] = 'custom';
		}
	}

	/**
	 * @param array $vars
	 * @param array $type
	 * @param string $field
	 */
	private function prep_multi_select_field_for_display(array &$vars, array &$type, $field)
	{
		$this->prep_checkbox_field_for_display($vars, $type, $field);

		$vars['method'] ='build_multi_select';
	}

	/**
	 * @param array $vars
	 */
	private function prep_hidden_field_for_display(array &$vars)
	{
		unset($vars);
	}

	/**
	 * @param array $vars
	 * @param array $type
	 */
	private function prep_custom_field_for_display(array &$vars, array &$type)
	{
		$vars['function'] = (!empty($vars['function'])) ? $vars['function'] : '';
		$type[0] = 'custom';
	}

	/**
	 * @param array $cfg_array
	 * @param array $df_settings
	 */
	private function get_multi_select(array &$cfg_array, array $df_settings)
	{
		$multi_select = $this->request->variable('config', array('' => array(0 => '')), true);
		$multi_select = array_filter($multi_select);

		foreach ($multi_select as $field => $settings)
		{
			$cfg_array[$field] = (!empty($settings)) ? $settings : $df_settings[$field]['default'];
		}
	}
}
