<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\users;

abstract class contacts
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/** @var bool */
	protected $mailto_allowed;

	/** @var bool */
	protected $email_form_allowed;

	/** @var bool */
	protected $jabber_allowed;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth					$auth					Auth object
	 * @param \phpbb\config\config				$config					Config object
	 * @param \phpbb\language\language			$translator				Language object
	 * @param \phpbb\user						$user					User Object
	 * @param string							$phpbb_root_path		Path to the phpbb includes directory.
	 * @param string							$php_ext				php file extension
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\language\language $translator, \phpbb\user $user, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->translator = $translator;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;

		$this->mailto_allowed = $this->get_mailto_allowed();
		$this->email_form_allowed = $this->get_email_form_allowed();
		$this->jabber_allowed = $this->get_jabber_allowed();
	}

	/**
	 * @param array $row
	 * @return array
	 */
	protected function get_email_contact(array $row)
	{
		$email = array();
		if ($this->user_email_allowed($row))
		{
			$email = array(
				'ID'		=> 'email',
				'NAME'		=> $this->translator->lang('SEND_EMAIL'),
				'U_CONTACT'	=> $this->get_email_url($row),
			);
		}

		return $email;
	}

	/**
	 * @param array $row
	 * @return bool
	 */
	protected function user_email_allowed(array $row)
	{
		return ((!empty($row['user_allow_viewemail']) && $this->auth->acl_get('u_sendemail')) || $this->auth->acl_get('a_email')) ? true : false;
	}

	/**
	 * @param array $row
	 * @return string
	 */
	protected function get_email_url(array $row)
	{
		return ($this->email_form_allowed) ? append_sid("{$this->phpbb_root_path}memberlist.{$this->php_ext}", 'mode=email&amp;u=' . $row['user_id']) : (($this->mailto_allowed) ? 'mailto:' . $row['user_email'] : '');
	}

	/**
	 * @return bool
	 */
	protected function get_email_form_allowed()
	{
		return ($this->config['board_email_form'] && $this->config['email_enable']) ? true : false;
	}

	/**
	 * @return bool
	 */
	protected function get_mailto_allowed()
	{
		return ($this->config['board_hide_emails'] && !$this->auth->acl_get('a_email')) ? false : true;
	}

	/**
	 * @param array $row
	 * @return array
	 */
	protected function get_jabber_contact(array $row)
	{
		$jabber = array();
		if ($this->jabber_allowed && $row['user_jabber'])
		{
			$jabber = array(
				'ID'		=> 'jabber',
				'NAME' 		=> $this->translator->lang('JABBER'),
				'U_CONTACT'	=> append_sid("{$this->phpbb_root_path}memberlist.{$this->php_ext}", 'mode=contact&amp;action=jabber&amp;u=' . $row['user_id']),
			);
		}

		return $jabber;
	}

	/**
	 * @return bool
	 */
	protected function get_jabber_allowed()
	{
		return ($this->config['jab_enable'] && $this->auth->acl_get('u_sendim')) ? true : false;
	}

	/**
	 * @param array $row
	 * @param array $can_receive_pm_list
	 * @param array $permanently_banned_users
	 * @return array
	 */
	protected function get_pm_contact(array $row, array $can_receive_pm_list, array $permanently_banned_users)
	{
		$pm = array();
		if ($this->user_can_pm() && $this->can_receive_pm($row, $can_receive_pm_list, $permanently_banned_users))
		{
			$pm = array(
				'ID'		=> 'pm',
				'NAME' 		=> $this->translator->lang('SEND_PRIVATE_MESSAGE'),
				'U_CONTACT'	=> append_sid("{$this->phpbb_root_path}ucp.{$this->php_ext}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']),
			);
		}

		return $pm;
	}

	/**
	 * @return bool
	 */
	protected function user_can_pm()
	{
		return ($this->config['allow_privmsg'] && $this->auth->acl_get('u_sendpm')) ? true : false;
	}

	/**
	 * @param array $row
	 * @param array $can_receive_pm_list
	 * @param array $permanently_banned_users
	 * @return bool
	 */
	protected function can_receive_pm(array $row, array $can_receive_pm_list, array $permanently_banned_users)
	{
		return (
			$this->user_is_allowed_to_pm($row, $permanently_banned_users) &&

			// They must be able to read PMs
			in_array($row['user_id'], $can_receive_pm_list) &&

			// They must allow users to contact via PM
			$this->user_allows_pm_contact($row['user_allow_pm'])
		);
	}

	/**
	 * @param array $row
	 * @param array $permanently_banned_users
	 * @return bool
	 */
	protected function user_is_allowed_to_pm(array $row, array $permanently_banned_users)
	{
		return (
			// They must not be permanently banned
			!in_array($row['user_id'], $permanently_banned_users) &&

			// is this user type allowed to send pms?
			$this->user_type_can_pm($row)
		);
	}

	/**
	 * @param array $row
	 * @return bool
	 */
	protected function user_type_can_pm(array $row)
	{
		return (
			// They must be a "normal" user
			$row['user_type'] != USER_IGNORE &&

			// They must not be deactivated by the administrator
			($row['user_type'] != USER_INACTIVE || $row['user_inactive_reason'] != INACTIVE_MANUAL)
		);
	}

	/**
	 * @param bool $user_allow_pm
	 * @return bool
	 */
	protected function user_allows_pm_contact($user_allow_pm)
	{
		return (($this->auth->acl_gets('a_', 'm_') || $this->auth->acl_getf_global('m_')) || $user_allow_pm);
	}

	/**
	 * Get the list of users who can receive private messages
	 *
	 * @param array $user_ids
	 * @return array
	 */
	protected function get_can_receive_pm_list(array $user_ids)
	{
		$can_receive_pm_list = $this->auth->acl_get_list($user_ids, 'u_readpm');
		return (empty($can_receive_pm_list) || !isset($can_receive_pm_list[0]['u_readpm'])) ? array() : $can_receive_pm_list[0]['u_readpm'];
	}

	/**
	 * Get the list of permanently banned users
	 *
	 * @param array $user_ids
	 * @return array
	 */
	protected function get_banned_users_list(array $user_ids)
	{
		if (!function_exists('phpbb_get_banned_user_ids'))
		{
			include($this->phpbb_root_path . 'includes/functions_user.' . $this->php_ext);
		}

		return phpbb_get_banned_user_ids($user_ids, false);
	}
}
