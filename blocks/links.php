<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

use blitze\sitemaker\services\blocks\driver\block;

/**
 * Links Block
 * @package phpBB Sitemaker
 */
class links extends block
{
	/** @var \phpbb\language\language */
	protected $language;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\menus\navigation */
	protected $navigation;

	/** @var string */
	protected $phpbb_admin_path;

	/** @var string */
	protected $php_ext;

	/** @var string */
	protected $title = 'LINKS';

	/** @var bool */
	protected $is_navigation = false;

	/**
	 * Constructor
	 *
	 * @param \phpbb\language\language						$language			Language object
	 * @param \phpbb\user									$user				User object
	 * @param \blitze\sitemaker\services\menus\navigation	$navigation			sitemaker navigation object
	 * @param string										$phpbb_admin_path	Relative path to admin
	 * @param string 										$php_ext			PHP extension (php)
	 */
	public function __construct(\phpbb\language\language $language, \phpbb\user $user, \blitze\sitemaker\services\menus\navigation $navigation, $phpbb_admin_path, $php_ext)
	{
		$this->language = $language;
		$this->user = $user;
		$this->navigation = $navigation;
		$this->phpbb_admin_path = $phpbb_admin_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_config(array $settings)
	{
		$menu_options = $this->navigation->get_menu_options();
		$u_menus = append_sid("{$this->phpbb_admin_path}index.{$this->php_ext}", 'i=-blitze-sitemaker-acp-menu_module&amp;mode=menu', true, $this->user->session_id);
		$append = '<a href="' . $u_menus . '" target="_blank" title="' . $this->language->lang('MANAGE_MENUS') . '"><i class="fa fa-cog fa-lg fa-green"></i></a>';

		return array(
			'legend1'       => 'SETTINGS',
			'menu_id'		=> array('lang' => 'MENU', 'validate' => 'int', 'type' => 'select', 'options' => $menu_options, 'default' => 0, 'explain' => false, 'append' => $append),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $db_data, $editing = false)
	{
		$menu_id = $db_data['settings']['menu_id'];

		if ($data = $this->navigation->build_menu($menu_id, $this->is_navigation, $db_data['settings']))
		{
			return array(
				'title'		=> $this->title,
				'data'		=> $data,
			);
		}

		return array(
			'title'     => $this->title,
			'status'	=> (int) !$editing,
			'content'   => $this->get_message($menu_id, $editing),
		);
	}

	/**
	 * @param int $menu_id
	 * @param bool $editing
	 * @return string
	 */
	protected function get_message($menu_id, $editing)
	{
		$msg_key = '';
		if ($editing)
		{
			$msg_key = ($menu_id) ? 'MENU_NO_ITEMS' : 'SELECT_MENU';
		}

		return $this->language->lang($msg_key);
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_template()
	{
		return '@blitze_sitemaker/blocks/lists.html';
	}
}
