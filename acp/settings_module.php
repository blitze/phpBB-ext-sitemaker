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

	/** @var \blitze\sitemaker\services\util */
	protected $util;

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
		$this->util = $phpbb_container->get('blitze.sitemaker.util');
		$this->trigger_errors = $trigger_errors;
	}

	/**
	 *
	 */
	public function main()
	{
		$this->translator->add_lang('blocks_admin', 'blitze/sitemaker');

		$form_key = 'blitze/sitemaker';

		add_form_key($form_key);

		$this->save_settings($form_key);

		$layouts = $this->get_layouts();

		$this->template->assign_vars(array(
			'u_action'			=> $this->u_action,
			'icon_picker'		=> $this->icon->picker(),
			'forum_icon'		=> $this->config['sm_forum_icon'],
			'show_forum_nav'	=> (bool) $this->config['sm_show_forum_nav'],
			'hide_login'		=> (bool) $this->config['sm_hide_login'],
			'hide_online'		=> (bool) $this->config['sm_hide_online'],
			'hide_birthday'		=> (bool) $this->config['sm_hide_birthday'],
			'styles'			=> $this->get_styles_data($layouts),
			'layouts'			=> $layouts,
		));

		$this->util->add_assets(array(
			'js'	=> array('@blitze_sitemaker/assets/settings/admin.min.js'),
			'css'	=> array('@blitze_sitemaker/assets/settings/admin.min.css'),
		));

		$this->tpl_name = 'acp_settings';
		$this->page_title = 'ACP_SM_SETTINGS';
	}

	/**
	 * @param string $form_key
	 */
	protected function save_settings($form_key)
	{
		if ($this->request->is_set_post('submit'))
		{
			$this->check_form_key($form_key);

			$layout_prefs = $this->request->variable('layouts', array(0 => array('' => '')));
			$this->config_text->set('sm_layout_prefs', json_encode($layout_prefs));

			$this->config->set('sm_hide_login', $this->request->variable('hide_login', 0));
			$this->config->set('sm_hide_online', $this->request->variable('hide_online', 0));
			$this->config->set('sm_hide_birthday', $this->request->variable('hide_birthday', 0));
			$this->config->set('sm_show_forum_nav', $this->request->variable('show_forum_nav', 0));
			$this->config->set('sm_forum_icon', $this->request->variable('forum_icon', ''));

			$this->trigger_error($this->translator->lang('SETTINGS_SAVED') . adm_back_link($this->u_action));
		}
	}

	/**
	 * @param array $layouts
	 * @return array
	 */
	protected function get_styles_data(array $layouts)
	{
		$style_prefs = json_decode($this->config_text->get('sm_layout_prefs'), true);

		$result = $this->db->sql_query('SELECT style_id, style_name FROM ' . STYLES_TABLE);

		$styles = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$id = $row['style_id'];

			$pref = $this->get_style_pref($id, $style_prefs);

			$styles[] = array(
				'id'		=> $id,
				'name'		=> $row['style_name'],
				'layout'	=> $pref['layout'],
				'layouts'	=> $this->get_layout_options($layouts, $pref['layout']),
				'views'		=> $this->get_view_options($pref['view']),
			);
		}
		$this->db->sql_freeresult();

		return $styles;
	}

	/**
	 * @param int $style_id
	 * @param array $style_prefs
	 * @return array
	 */
	protected function get_style_pref($style_id, array $style_prefs)
	{
		$pref = array(
			'layout'	=> '',
			'view'		=> '',
		);

		if (isset($style_prefs[$style_id]))
		{
			$pref = $style_prefs[$style_id];
		}

		return $pref;
	}

	/**
	 * @param array $layouts
	 * @param string $pref
	 * @return string
	 */
	protected function get_layout_options(array $layouts, $pref)
	{
		$options = '';
		foreach ($layouts as $name => $path)
		{
			$selected = ($path == $pref) ? ' selected="selected"' : '';
			$options .= '<option value="' . $path . '"' . $selected . '>' . $this->translator->lang('LAYOUT_' . strtoupper($name)) . '</option>';
		}

		return $options;
	}

	/**
	 * @param string $pref
	 * @return string
	 */
	protected function get_view_options($pref)
	{
		$views = array('basic', 'boxed', 'simple');

		$options = '<option value="">' . $this->translator->lang('BLOCK_VIEW_DEFAULT') . '</option>';
		foreach ($views as $view)
		{
			$selected = ($view == $pref) ? ' selected="selected"' : '';
			$options .= '<option value="' . $view . '"' . $selected . '>' . $this->translator->lang('BLOCK_VIEW_' . strtoupper($view)) . '</option>';
		}

		return $options;
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
}
