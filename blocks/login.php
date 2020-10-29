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
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Login Block
 */
class login extends block
{
	/** @var ContainerInterface */
	protected $phpbb_container;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\util */
	protected $util;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/** @var string */
	protected $block_template = '@blitze_sitemaker/blocks/login.html';

	/**
	 * Constructor
	 *
	 * @param ContainerInterface					$phpbb_container		Service container
	 * @param \phpbb\template\template				$template				Template object
	 * @param \phpbb\user							$user					User object
	 * @param \blitze\sitemaker\services\util		$util					Utility Object
	 * @param string 								$phpbb_root_path		Relative path to phpBB root
	 * @param string 								$php_ext				PHP extension (php)
	 */
	public function __construct(ContainerInterface $phpbb_container, \phpbb\template\template $template, \phpbb\user $user, \blitze\sitemaker\services\util $util, $phpbb_root_path, $php_ext)
	{
		$this->phpbb_container = $phpbb_container;
		$this->template = $template;
		$this->user = $user;
		$this->util = $util;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_config(array $settings)
	{
		return array(
			'legend1'			=> 'SETTINGS',
			'show_hide_me'		=> array('lang' => 'SHOW_HIDE_ME', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => 1),
			'allow_autologin'	=> array('lang' => 'AUTO_LOGIN', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => 1),
			'show_member_menu'	=> array('lang' => 'SHOW_MEMBER_MENU', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true, 'default' => false),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $bdata, $edit_mode = false)
	{
		$settings = $bdata['settings'];

		$data = [];
		if (!$this->user->data['is_registered'] || $edit_mode === true)
		{
			$this->hide_quicklogin();
			$data = array(
				'S_SHOW_HIDE_ME'		=> ($settings['show_hide_me']) ? true : false,
				'S_AUTOLOGIN_ENABLED'   => ($settings['allow_autologin']) ? true : false,
				'S_FORM_TOKEN'			=> $this->util->get_form_key('login'),
				'S_LOGIN_ACTION'		=> append_sid("{$this->phpbb_root_path}ucp." . $this->php_ext, 'mode=login'),
				'U_REGISTER'			=> append_sid("{$this->phpbb_root_path}ucp." . $this->php_ext, 'mode=register'),
				'U_SEND_PASSWORD'		=> append_sid("{$this->phpbb_root_path}ucp." . $this->php_ext, 'mode=sendpassword'),
				'U_REDIRECT'			=> reapply_sid(ltrim(rtrim(build_url(array('edit_mode')), '?'), './../'))
			);
		}
		else if ($settings['show_member_menu'])
		{
			$block = $this->phpbb_container->get('blitze.sitemaker.block.member_menu');
			$this->set_template($block->get_template());
			return $block->display(array(), $edit_mode);
		}

		return array(
			'title'	=> 'LOGIN',
			'data'	=> $data,
		);
	}

	/**
	 * Quicklogin is only displayed on forum index. So we only need to hide on forum index
	 */
	private function hide_quicklogin()
	{
		$current_page = $this->user->page['page_name'];
		if ($current_page === 'index.' . $this->php_ext)
		{
			$this->template->assign_var('S_USER_LOGGED_IN', true);
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_template()
	{
		return $this->block_template;
	}

	/**
	 * @param string $template
	 */
	protected function set_template($template)
	{
		$this->block_template = $template;
	}
}
