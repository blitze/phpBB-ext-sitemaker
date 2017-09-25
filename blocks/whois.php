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
 * Whois Block
 */
class whois extends block
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth					$auth				Permission object
	 * @param \phpbb\config\config				$config				phpBB configuration
	 * @param \phpbb\language\language			$translator			Language object
	 * @param \phpbb\template\template			$template			Template object
	 * @param \phpbb\user						$user				User object
	 * @param string							$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string							$php_ext			php file extension
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\language\language $translator, \phpbb\template\template $template, \phpbb\user $user, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->translator = $translator;
		$this->template = $template;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $settings, $edit_mode = false)
	{
		$data = $this->template->retrieve_vars(array('TOTAL_USERS_ONLINE', 'LOGGED_IN_USER_LIST', 'RECORD_USERS'));

		if ($data['TOTAL_USERS_ONLINE'])
		{
			list($l_online_users, $online_userlist, $l_online_record) = array_values($data);
		}
		else
		{
			$item_id = 0;
			$item = 'forum';

			$online_users = obtain_users_online($item_id, $item);
			$user_online_strings = obtain_users_online_string($online_users, $item_id, $item);

			$l_online_users = $user_online_strings['l_online_users'];
			$online_userlist = $user_online_strings['online_userlist'];

			$l_online_record = $this->translator->lang('RECORD_ONLINE_USERS', (int) $this->config['record_online_users'], $this->user->format_date($this->config['record_online_date'], false, true));
		}

		$this->template->assign_var('S_DISPLAY_ONLINE_LIST', false);

		$this->ptemplate->assign_vars(array(
			'TOTAL_USERS_ONLINE'	=> $l_online_users,
			'LOGGED_IN_USER_LIST'	=> $online_userlist,
			'RECORD_USERS'			=> $l_online_record,
			'U_VIEWONLINE'			=> $this->get_viewonline_url(),
		));
		unset($data);

		return array(
			'title'		=> 'WHO_IS_ONLINE',
			'content'	=> $this->ptemplate->render_view('blitze/sitemaker', 'blocks/whois.html', 'whois_block')
		);
	}

	/**
	 * @return string
	 */
	private function get_viewonline_url()
	{
		return ($this->auth->acl_gets('u_viewprofile', 'a_user', 'a_useradd', 'a_userdel')) ? append_sid("{$this->phpbb_root_path}viewonline." . $this->php_ext) : '';
	}
}
