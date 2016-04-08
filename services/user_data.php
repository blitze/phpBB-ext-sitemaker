<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2016 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services;

class user_data
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\profilefields\manager */
	protected $profile_fields;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/** @var array */
	protected $user_cache = array();

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth					$auth					Auth object
	 * @param \phpbb\config\config				$config					Config object
	 * @param \phpbb\db\driver\driver_interface	$db     				Database connection
	 * @param \phpbb\profilefields\manager      $profile_fields			Profile fields manager
	 * @param \phpbb\language\language			$translator				Language object
	 * @param \phpbb\user						$user					User Object
	 * @param string							$phpbb_root_path		Path to the phpbb includes directory.
	 * @param string							$php_ext				php file extension
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\profilefields\manager $profile_fields, \phpbb\language\language $translator, \phpbb\user $user, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->db = $db;
		$this->profile_fields = $profile_fields;
		$this->translator = $translator;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * @param array $user_ids
	 * @param string $sql_where
	 * @return array
	 */
	public function get_users(array $user_ids, $sql_where = '')
	{
		$query_ids = array_diff($user_ids, array_keys($this->user_cache));

		if (sizeof($query_ids))
		{
			$sql_where .= (($sql_where) ? ' AND ' : '') . $this->db->sql_in_set('user_id', $query_ids);
			$this->query($sql_where);
		}

		return array_intersect_key($this->user_cache, array_flip($user_ids));
	}

	/**
	 * @param string $sql_where
	 * @param string $order_by
	 * @param int|bool $limit
	 * @return array|bool
	 */
	public function query($sql_where = '', $order_by = '', $limit = false)
	{
		$sql = $this->get_sql_statement($sql_where, $order_by);
		$result = $this->db->sql_query_limit($sql, $limit);

		$users = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$user_id = $row['user_id'];
			$users[$user_id] = $row;

			$this->user_cache[$user_id] = $this->get_data($row);
			$this->user_cache[$user_id] += $this->get_rank($row);
		}
		$this->db->sql_freeresult($result);

		if (!sizeof($users))
		{
			return false;
		}

		$this->get_additional_fields($users);
		unset($users);

		return $this->user_cache;
	}

	/**
	 * @param array $row
	 * @return array
	 */
	public function get_data($row)
	{
		$user_id = $row['user_id'];
		$date_format = $this->translator->lang('DATE_FORMAT');

		return array(
			'AVATAR'			=> $this->get_avatar($row),
			'USERNAME'			=> get_username_string('username', $user_id, $row['username'], $row['user_colour']),
			'USERNAME_FULL'		=> get_username_string('full', $user_id, $row['username'], $row['user_colour']),

			'JOINED'			=> $this->user->format_date($row['user_regdate'], "|$date_format|"),
			'VISITED'			=> $this->get_last_visit_date($row['user_lastvisit'], $date_format),
			'POSTS'				=> $row['user_posts'],
			'POSTS_PCT'			=> $this->translator->lang_array('POST_PCT', $this->calculate_percent_posts($row['user_posts'])),

			'CONTACT_USER' 		=> $this->translator->lang('CONTACT_USER', get_username_string('username', $user_id, $row['username'], $row['user_colour'], $row['username'])),

			'U_SEARCH_POSTS'	=> $this->get_search_url($user_id),
			'U_VIEWPROFILE'		=> get_username_string('profile', $user_id, $row['username'], $row['user_colour']),

			'contact_fields'	=> array(),
			'profile_fields'	=> array(),
		);
	}

	/**
	 * @return array
	 */
	public function get_profile_fields()
	{
		$sql = 'SELECT l.lang_name, f.field_ident
			FROM ' . PROFILE_LANG_TABLE . ' l, ' . PROFILE_FIELDS_TABLE . ' f
			WHERE l.lang_id = ' . $this->user->get_iso_lang_id() . '
				AND f.field_active = 1
				AND f.field_no_view = 0
				AND f.field_hide = 0
				AND l.field_id = f.field_id
			ORDER BY f.field_order';
		$result = $this->db->sql_query($sql);

		$cpf_options = false;
		while ($row = $this->db->sql_fetchrow($result))
		{
			$cpf_options[$row['field_ident']] = $row['lang_name'];
		}
		$this->db->sql_freeresult($result);

		return $cpf_options;
	}

	/**
	 * @param array $row
	 * @return string
	 */
	protected function get_avatar(array $row)
	{
		return ($this->user->optionget('viewavatars')) ? phpbb_get_user_avatar($row) : '';
	}

	/**
	 * @param int $user_posts
	 * @return int|mixed
	 */
	protected function calculate_percent_posts($user_posts)
	{
		return ($this->config['num_posts']) ? min(100, ($user_posts / $this->config['num_posts']) * 100) : 0;
	}

	/**
	 * @param int $last_visited
	 * @param string $date_format
	 * @return string
	 */
	protected function get_last_visit_date($last_visited, $date_format)
	{
		return ($last_visited) ? $this->user->format_date($last_visited, "|$date_format|") : '';
	}

	/**
	 * @param int $user_id
	 * @return string
	 */
	protected function get_search_url($user_id)
	{
		return ($this->auth->acl_get('u_search')) ? append_sid($this->phpbb_root_path . 'search.' . $this->php_ext, "author_id=$user_id&amp;sr=posts") : '';
	}

	/**
	 * @param array $row
	 * @return array
	 */
	public function get_rank(array $row)
	{
		if (!function_exists('phpbb_get_user_rank'))
		{
			include($this->phpbb_root_path . 'includes/functions_display.' . $this->php_ext);
		}

		$user_rank_data = phpbb_get_user_rank($row, $row['user_posts']);

		if (!empty($user_rank_data))
		{
			return array(
				'RANK_TITLE'		=> $user_rank_data['title'],
				'RANK_IMAGE'		=> $user_rank_data['img'],
				'RANK_IMAGE_SRC'	=> $user_rank_data['img_src'],
			);
		}
		else
		{
			return array(
				'RANK_TITLE'		=> '',
				'RANK_IMAGE'		=> '',
				'RANK_IMAGE_SRC'	=> '',
			);
		}
	}

	/**
	 * @param array $users
	 */
	protected function get_additional_fields(array $users)
	{
		$user_ids = array_keys($users);

		$can_receive_pm_list = $this->get_can_receive_pm_list($user_ids);
		$permanently_banned_users = $this->get_banned_users_list($user_ids);

		// Grab all profile fields from users in id cache for later use - similar to the poster cache
		$profile_fields_cache = $this->profile_fields->grab_profile_fields_data($user_ids);

		for ($i = 0, $size = sizeof($user_ids); $i < $size; $i++)
		{
			$id = $user_ids[$i];
			$row = $users[$id];

			$this->user_cache[$id]['contact_fields'] = array_filter(array(
				'pm'		=> $this->get_pm_contact($row, $can_receive_pm_list, $permanently_banned_users),
				'email'		=> $this->get_email_contact($row),
				'jabber'	=> $this->get_jabber_contact($row),
			));
			$this->get_custom_profile_fields($id, $profile_fields_cache);
		}
	}

	/**
	 * @param array $row
	 * @return array
	 */
	protected function get_email_contact(array &$row)
	{
		$email = array();
		if ((!empty($row['user_allow_viewemail']) && $this->auth->acl_get('u_sendemail')) || $this->auth->acl_get('a_email'))
		{
			$email = array(
				'ID'		=> 'email',
				'NAME'		=> $this->translator->lang('SEND_EMAIL'),
				'U_CONTACT'	=> ($this->config['board_email_form'] && $this->config['email_enable']) ? append_sid("{$this->phpbb_root_path}memberlist.$this->php_ext", 'mode=email&amp;u=' . $row['user_id']) : (($this->config['board_hide_emails'] && !$this->auth->acl_get('a_email')) ? '' : 'mailto:' . $row['user_email']),
			);
		}

		return $email;
	}

	/**
	 * @param array $row
	 * @param array $can_receive_pm_list
	 * @param array $permanently_banned_users
	 * @return array
	 */
	protected function get_pm_contact(array &$row, array $can_receive_pm_list, array $permanently_banned_users)
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
	 * @param array $row
	 * @return array
	 */
	protected function get_jabber_contact(array &$row)
	{
		$jabber = array();
		if ($this->user_can_jabber($row))
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
	protected function user_can_pm()
	{
		return ($this->config['allow_privmsg'] && $this->auth->acl_get('u_sendpm')) ? true : false;
	}

	/**
	 * @param array $row
	 * @return bool
	 */
	protected function user_can_jabber(array $row)
	{
		return ($this->config['jab_enable'] && $row['user_jabber'] && $this->auth->acl_get('u_sendim')) ? true : false;
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
			// They must be a "normal" user
			$row['user_type'] != USER_IGNORE &&

			// They must not be deactivated by the administrator
			($row['user_type'] != USER_INACTIVE || $row['user_inactive_reason'] != INACTIVE_MANUAL) &&

			// They must be able to read PMs
			in_array($row['user_id'], $can_receive_pm_list) &&

			// They must not be permanently banned
			!in_array($row['user_id'], $permanently_banned_users) &&

			// They must allow users to contact via PM
			(($this->auth->acl_gets('a_', 'm_') || $this->auth->acl_getf_global('m_')) || $row['allow_pm'])
		);
	}

	/**
	 * @param int $user_id
	 * @param array $profile_fields_cache
	 */
	protected function get_custom_profile_fields($user_id, array $profile_fields_cache)
	{
		$cp_row = (isset($profile_fields_cache[$user_id])) ? $this->profile_fields->generate_profile_fields_template_data($profile_fields_cache[$user_id]) : array('blockrow' => array());

		foreach ($cp_row['blockrow'] as $field_data)
		{
			$field = $field_data['PROFILE_FIELD_IDENT'];

			if ($field_data['S_PROFILE_CONTACT'])
			{
				$this->user_cache[$user_id]['contact_fields'][$field] = array(
					'ID'		=> $field,
					'NAME'		=> $field_data['PROFILE_FIELD_NAME'],
					'U_CONTACT'	=> $field_data['PROFILE_FIELD_CONTACT'],
				);
			}
			else
			{
				$this->user_cache[$user_id]['profile_fields'][$field] = $field_data;
			}
		}
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

	/**
	 * @param string $sql_where
	 * @param string $order_by
	 * @return string
	 */
	protected function get_sql_statement($sql_where = '', $order_by = '')
	{
		return 'SELECT user_id, username, user_type, user_colour, user_avatar, user_avatar_type, user_avatar_height, user_avatar_width, user_regdate, user_lastvisit, user_birthday, user_posts, user_rank, user_allow_viewemail, user_allow_pm, user_jabber, user_inactive_reason
			FROM ' . USERS_TABLE .
			(($sql_where) ? ' WHERE ' . $sql_where : '') .
			(($order_by) ? ' ORDER BY ' . $order_by : '');
	}
}
