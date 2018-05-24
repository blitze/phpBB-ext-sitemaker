<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2016 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\users;

class data extends contacts
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

	/** @var \blitze\sitemaker\services\util */
	protected $util;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/** @var string */
	protected $default_avatar;

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
	 * @param \blitze\sitemaker\services\util	$util					Sitemaker utility Object
	 * @param string							$phpbb_root_path		Path to the phpbb includes directory.
	 * @param string							$php_ext				php file extension
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\profilefields\manager $profile_fields, \phpbb\language\language $translator, \phpbb\user $user, \blitze\sitemaker\services\util $util, $phpbb_root_path, $php_ext)
	{
		parent::__construct($auth, $config, $translator, $user, $phpbb_root_path, $php_ext);

		$this->auth = $auth;
		$this->config = $config;
		$this->db = $db;
		$this->profile_fields = $profile_fields;
		$this->translator = $translator;
		$this->user = $user;
		$this->util = $util;
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
	 * @param int $limit
	 * @return array|bool
	 */
	public function query($sql_where = '', $order_by = '', $limit = 0)
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

		$this->default_avatar = $this->util->get_default_avatar();

		return array(
			'avatar'			=> $this->get_avatar($row),
			'username'			=> get_username_string('username', $user_id, $row['username'], $row['user_colour']),
			'username_full'		=> get_username_string('full', $user_id, $row['username'], $row['user_colour']),

			'joined'			=> $this->user->format_date($row['user_regdate'], "|$date_format|"),
			'visited'			=> $this->get_last_visit_date($row['user_lastvisit'], $date_format),
			'posts_pct'			=> $this->translator->lang('POST_PCT', $this->calculate_percent_posts($row['user_posts'])),
			'contact_user' 		=> $this->translator->lang('CONTACT_USER', get_username_string('username', $user_id, $row['username'], $row['user_colour'], $row['username'])),
			'posts'				=> $row['user_posts'],
			'warnings'			=> $row['user_warnings'],

			'u_search_posts'	=> $this->get_search_url($user_id),
			'u_viewprofile'		=> get_username_string('profile', $user_id, $row['username'], $row['user_colour']),

			'contact_fields'	=> array(),
			'profile_fields'	=> array(),
		);
	}

	/**
	 * @return string[]
	 */
	public function get_profile_fields()
	{
		$sql = 'SELECT l.lang_name, f.field_ident
			FROM ' . PROFILE_LANG_TABLE . ' l, ' . PROFILE_FIELDS_TABLE . ' f
			WHERE l.lang_id = ' . (int) $this->user->get_iso_lang_id() . '
				AND f.field_active = 1
				AND f.field_no_view = 0
				AND f.field_hide = 0
				AND l.field_id = f.field_id
			ORDER BY f.field_order';
		$result = $this->db->sql_query($sql);

		$cpf_options = array();
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
		$avatar = '';
		if ($this->user->optionget('viewavatars'))
		{
			$avatar = ($row['user_avatar']) ? phpbb_get_user_avatar($row) : $this->default_avatar;
		}

		return $avatar;
	}

	/**
	 * @param int $user_posts
	 * @return int
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

		return array(
			'RANK_TITLE'		=> (string) $user_rank_data['title'],
			'RANK_IMAGE'		=> (string) $user_rank_data['img'],
			'RANK_IMAGE_SRC'	=> (string) $user_rank_data['img_src'],
		);
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
	 * @param string $sql_where
	 * @param string $order_by
	 * @return string
	 */
	protected function get_sql_statement($sql_where = '', $order_by = '')
	{
		return 'SELECT * FROM ' . USERS_TABLE .
			(($sql_where) ? ' WHERE ' . $sql_where : '') .
			(($order_by) ? ' ORDER BY ' . $order_by : '');
	}
}
