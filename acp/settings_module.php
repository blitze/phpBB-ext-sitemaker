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

	/** @var \phpbb\event\dispatcher_interface */
	protected $phpbb_dispatcher;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \blitze\sitemaker\services\icon_picker */
	protected $icon;

	/** @var \blitze\sitemaker\services\filemanager\settings */
	protected $filemanager;

	/** @var \blitze\sitemaker\model\mapper_factory */
	protected $mapper_factory;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var string phpEx */
	protected $php_ext;

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
		global $phpbb_container, $phpbb_dispatcher, $config, $db, $request, $template, $phpbb_root_path, $phpEx;

		$this->db = $db;
		$this->config = $config;
		$this->phpbb_dispatcher = $phpbb_dispatcher;
		$this->request = $request;
		$this->template = $template;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;

		$this->config_text = $phpbb_container->get('config_text');
		$this->finder = $phpbb_container->get('ext.manager')->get_finder();
		$this->translator = $phpbb_container->get('language');
		$this->filemanager = $phpbb_container->get('blitze.sitemaker.filemanager.settings');
		$this->icon = $phpbb_container->get('blitze.sitemaker.icon_picker');
		$this->mapper_factory = $phpbb_container->get('blitze.sitemaker.mapper.factory');
		$this->trigger_errors = $trigger_errors;
	}

	/**
	 * @return void
	 */
	public function main()
	{
		$this->translator->add_lang('acp/board');
		$this->translator->add_lang('blocks_admin', 'blitze/sitemaker');

		$form_key = 'blitze/sitemaker/settings';

		$this->handle_submit($form_key);

		add_form_key($form_key);

		$layouts = $this->get_layouts();

		/**
		 * Event to display acp settings form
		 *
		 * @event blitze.sitemaker.acp_display_settings_form
		 * @var	array	layouts		Array of layout settings
		 * @since 3.1.0
		 */
		$vars = array('layouts');
		extract($this->phpbb_dispatcher->trigger_event('blitze.sitemaker.acp_display_settings_form', compact($vars)));

		$this->template->assign_vars(array(
			'u_action'			=> $this->u_action,
			'icon_picker'		=> $this->icon->picker(),
			'config'			=> $this->config,
			'filemanager'		=> $this->filemanager->get_settings(),
			'styles'			=> $this->get_styles_data($layouts),
			'layouts'			=> $layouts,
			'menu_options'		=> $this->get_menu_options(),
		));

		$this->tpl_name = 'acp_settings';
		$this->page_title = 'ACP_SM_SETTINGS';
	}

	/**
	 * @param string $form_key
	 * @return void
	 */
	protected function handle_submit($form_key)
	{
		if ($this->request->is_set_post('submit'))
		{
			$settings = $this->request->variable('config', array('' => ''));

			$this->check_form_key($form_key);

			/**
			 * Event to save acp settings
			 *
			 * @event blitze.sitemaker.acp_save_settings
			 * @var	array	settings	Array of settings: [config_key] => [config_value]
			 * @since 3.1.0
			 */
			$vars = array('settings');
			extract($this->phpbb_dispatcher->trigger_event('blitze.sitemaker.acp_save_settings', compact($vars)));

			$this->save_filemanager_settings($settings);
			$this->save_config_settings($settings);
			$this->trigger_error($this->translator->lang('SETTINGS_SAVED') . adm_back_link($this->u_action));
		}
	}

	/**
	 * @param string $form_key
	 */
	protected function check_form_key($form_key)
	{
		if (!check_form_key($form_key))
		{
			$this->trigger_error('FORM_INVALID', E_USER_WARNING);
		}
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
	 * @param string $message
	 * @param int $error_type
	 * @return void
	 */
	protected function trigger_error($message, $error_type = E_USER_NOTICE)
	{
		$this->trigger_errors ? trigger_error($message, $error_type) : null;
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
	 * @param array $settings
	 * @return void
	 */
	protected function save_config_settings(array $settings)
	{
		$layout_prefs = $this->request->variable('layouts', array(0 => array('' => '')));

		$this->config_text->set('sm_layout_prefs', json_encode($layout_prefs));

		foreach ($settings as $key => $value)
		{
			$this->config->set($key, $value);
		}
	}

	/**
	 * @param array $config
	 * @return void
	 */
	protected function save_filemanager_settings(array &$config)
	{
		$settings = $this->request->variable('filemanager', array('' => ''));

		if (sizeof($settings))
		{
			$settings['aviary_active'] = ($settings['aviary_apiKey']) ? 'true' : 'false';
			$settings['image_watermark_position'] = ($settings['image_watermark_coordinates']) ? $settings['image_watermark_coordinates'] : $settings['image_watermark_position'];
			unset($settings['image_watermark_coordinates']);

			$this->filemanager->save($settings);
		}
		else
		{
			$config['sm_filemanager'] = 0;
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
