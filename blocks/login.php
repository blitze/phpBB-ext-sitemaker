<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Login Block
 */
class login extends \blitze\sitemaker\services\blocks\driver\block
{
	/** @var ContainerInterface */
	protected $phpbb_container;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param ContainerInterface	$phpbb_container		Service container
	 * @param \phpbb\user			$user					User object
	 * @param string 				$phpbb_root_path		Relative path to phpBB root
	 * @param string 				$php_ext				PHP extension (php)
	 */
	public function __construct(ContainerInterface $phpbb_container, \phpbb\user $user, $phpbb_root_path, $php_ext)
	{
		$this->phpbb_container = $phpbb_container;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	public function get_config($data)
	{
		return array(
			'legend1'			=> $this->user->lang['SETTINGS'],
			'show_hide_me'		=> array('lang' => 'SHOW_HIDE_ME', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => 1),
			'allow_autologin'	=> array('lang' => 'AUTO_LOGIN', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => 1),
			'show_member_menu'	=> array('lang' => 'SHOW_MEMBER_MENU', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true, 'default' => false),
		);
	}

	public function display($bdata, $edit_mode = false)
	{
		$settings = $bdata['settings'];

		if (!$this->user->data['is_registered'] || $edit_mode === true)
		{
			$this->ptemplate->assign_vars(array(
				'S_SHOW_HIDE_ME'		=> ($settings['show_hide_me']) ? true : false,
				'S_AUTOLOGIN_ENABLED'   => ($settings['allow_autologin']) ? true : false,
				'S_LOGIN_ACTION'		=> append_sid("{$this->phpbb_root_path}ucp" . $this->php_ext, 'mode=login'),
				'U_REGISTER'			=> append_sid("{$this->phpbb_root_path}ucp" . $this->php_ext, 'mode=register'),
				'U_SEND_PASSWORD'		=> append_sid("{$this->phpbb_root_path}ucp" . $this->php_ext, 'mode=sendpassword'),
				'U_REDIRECT'			=> reapply_sid(ltrim(rtrim(build_url(array('edit_mode')), '?'), './../'))
			));

			return array(
				'title'		=> 'LOGIN',
				'content'	=> $this->ptemplate->render_view('blitze/sitemaker', 'blocks/login.html', 'login_block')
			);
		}
		else if ($settings['show_member_menu'])
		{
			$block = $this->phpbb_container->get('blitze.sitemaker.block.member_menu');
			$block->set_template($this->ptemplate);
			return $block->display(array(), $edit_mode);
		}
	}
}
