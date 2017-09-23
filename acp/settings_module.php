<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\acp;

/**
* @package acp
*/
class settings_module
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\config\db_text */
	protected $config_text;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\finder */
	protected $finder;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \blitze\sitemaker\services\icon_picker */
	protected $icon;

	/** @var \blitze\sitemaker\model\mapper_factory */
	protected $mapper_factory;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var string phpEx */
	protected $php_ext;

	/** @var string */
	protected $filemanager_config_file;

	/** @var string */
	public $tpl_name;

	/** @var string */
	public $page_title;

	/** @var string */
	public $u_action;

	/** @var bool */
	public $trigger_errors;

	/**
	 * settings_module constructor.
	 */
	public function __construct($trigger_errors = true)
	{
		global $phpbb_container, $config, $db, $request, $template, $phpbb_root_path, $phpEx;

		$this->db = $db;
		$this->config = $config;
		$this->request = $request;
		$this->template = $template;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;

		$this->config_text = $phpbb_container->get('config_text');
		$this->finder = $phpbb_container->get('ext.manager')->get_finder();
		$this->translator = $phpbb_container->get('language');
		$this->icon = $phpbb_container->get('blitze.sitemaker.icon_picker');
		$this->mapper_factory = $phpbb_container->get('blitze.sitemaker.mapper.factory');
		$this->trigger_errors = $trigger_errors;

		$this->filemanager_config_file = $this->phpbb_root_path . 'ext/blitze/sitemaker/styles/all/theme/vendor/ResponsiveFilemanager/filemanager/config/config.' . $this->php_ext;
	}

	/**
	 * @return void
	 */
	public function main()
	{
		$this->translator->add_lang('acp/board');
		$this->translator->add_lang('blocks_admin', 'blitze/sitemaker');

		$form_key = 'blitze/sitemaker/settings';

		if ($this->request->is_set_post('submit'))
		{
			$this->check_form_key($form_key);
			$this->save_filemanager_settings();
			$this->save_config_settings();

			$this->trigger_error($this->translator->lang('SETTINGS_SAVED') . adm_back_link($this->u_action));
		}

		add_form_key($form_key);

		$layouts = $this->get_layouts();
		$this->template->assign_vars(array(
			'u_action'			=> $this->u_action,
			'icon_picker'		=> $this->icon->picker(),
			'config'			=> $this->config,
			'filemanager'		=> $this->get_filemanager_settings(),
			'styles'			=> $this->get_styles_data($layouts),
			'layouts'			=> $layouts,
			'menu_options'		=> $this->get_menu_options(),
		));

		$this->tpl_name = 'acp_settings';
		$this->page_title = 'ACP_SM_SETTINGS';
	}

	/**
	 * @param string $path
	 * @return void
	 */
	public function set_filemanager_config_file($path)
	{
		$this->filemanager_config_file = $path;
	}

	/**
	 * @param array $layouts
	 * @return array
	 */
	protected function get_styles_data(array $layouts)
	{
		$style_prefs = (array) json_decode($this->config_text->get('sm_layout_prefs'), true);

		$result = $this->db->sql_query('SELECT style_id, style_name FROM ' . STYLES_TABLE);

		$styles = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$id = $row['style_id'];

			$pref = $this->get_style_pref($id, $style_prefs, $layouts['portal']);

			$styles[] = array(
				'id'		=> $id,
				'name'		=> $row['style_name'],
				'layout'	=> $pref['layout'],
				'view'		=> $pref['view'],
			);
		}
		$this->db->sql_freeresult();

		return $styles;
	}

	/**
	 * @param int $style_id
	 * @param array $style_prefs
	 * @param string $default_layout
	 * @return array
	 */
	protected function get_style_pref($style_id, array $style_prefs, $default_layout)
	{
		$pref = array(
			'layout'	=> $default_layout,
			'view'		=> '',
		);

		if (isset($style_prefs[$style_id]))
		{
			$pref = $style_prefs[$style_id];
		}

		return $pref;
	}

	/**
	 * @param string $form_key
	 */
	protected function check_form_key($form_key)
	{
		if (!check_form_key($form_key))
		{
			$this->trigger_error('FORM_INVALID');
		}
	}

	/**
	 * @param string $message
	 */
	protected function trigger_error($message)
	{
		$this->trigger_errors ? trigger_error($message) : null;
	}

	/**
	 * @return array
	 */
	protected function get_layouts()
	{
		$files = $this->finder
			->suffix('_layout.twig')
			->extension_directory('/styles')
			->find();
		$files = array_keys($files);

		$layouts = array();
		foreach ($files as $path)
		{
			$path = dirname($path);
			$name = basename($path);

			$layouts[$name] = $this->phpbb_root_path . $path . '/';
		}
		ksort($layouts);

		return $layouts;
	}

	/**
	 * @return void
	 */
	protected function save_config_settings()
	{
		$settings = $this->request->variable('config', array('' => ''));
		$layout_prefs = $this->request->variable('layouts', array(0 => array('' => '')));

		$this->config_text->set('sm_layout_prefs', json_encode($layout_prefs));

		foreach ($settings as $key => $value)
		{
			$this->config->set($key, $value);
		}
	}

	/**
	 * @return void
	 */
	protected function save_filemanager_settings()
	{
		$settings = $this->request->variable('filemanager', array('' => ''));

		$settings['aviary_active'] = ($settings['aviary_apiKey']) ? 'true' : 'false';
		$settings['image_watermark_position'] = ($settings['image_watermark_coordinates']) ? $settings['image_watermark_coordinates'] : $settings['image_watermark_position'];
		unset($settings['image_watermark_coordinates']);

		$curr_settings = (array) $this->get_filemanager_settings();
		$file = file_get_contents($this->filemanager_config_file);

		foreach ($settings as $prop => $value)
		{
			$this->type_cast_filemanager_config_value($curr_settings[$prop], $value);
			$file = preg_replace("/\s'$prop'(\s+)=>\s+(.*?),/i", "	'$prop'$1=> $value,", $file);
		}

		file_put_contents($this->filemanager_config_file, $file);
	}

	/**
	 * @return array
	 */
	protected function get_filemanager_settings()
	{
		$editing = true;
		return include($this->filemanager_config_file);
	}

	/**
	 * @param mixed $curr_val
	 * @param mixed $value
	 * @return void
	 */
	protected function type_cast_filemanager_config_value($curr_val, &$value)
	{
		$type = gettype($curr_val);
		switch($type)
		{
			case 'string':
				$value = "'$value'";
			break;
			case 'integer':
				$value = (int) $value;
			break;
		}
	}

	/**
	 * @return string
	 */
	protected function get_menu_options()
	{
		$menu_mapper = $this->mapper_factory->create('menus');

		// Get all menus
		$collection = $menu_mapper->find();

		$options = '';
		foreach ($collection as $entity)
		{
			$id = $entity->get_menu_id();
			$name = $entity->get_menu_name();
			$selected = ($id == $this->config['sm_navbar_menu']) ? ' selected="selected"' : '';
			$options .= '<option value="' . $id . '"' . $selected . '>' . $name . '</option>';
		}

		return $options;
	}
}
