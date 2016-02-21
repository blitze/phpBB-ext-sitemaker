<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\forum;

use blitze\sitemaker\services\forum\query_builder;

class data extends query_builder
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\content_visibility */
	protected $content_visibility;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth					$auth					Auth object
	 * @param \phpbb\config\config				$config					Config object
	 * @param \phpbb\content_visibility			$content_visibility		Content visibility
	 * @param \phpbb\db\driver\driver_interface	$db     				Database connection
	 * @param \phpbb\language\language			$translator				Language object
	 * @param \phpbb\user						$user					User object
	 * @param string							$phpbb_root_path		Path to the phpbb includes directory.
	 * @param string							$php_ext				php file extension
	 * @param integer							$cache_time				Cache results for 3 hours by default
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\content_visibility $content_visibility, \phpbb\db\driver\driver_interface $db, \phpbb\language\language $translator, \phpbb\user $user, $phpbb_root_path, $php_ext, $cache_time = 10800)
	{
		parent::__construct($auth, $config, $content_visibility, $db, $user, $cache_time);

		$this->auth = $auth;
		$this->config = $config;
		$this->content_visibility = $content_visibility;
		$this->db = $db;
		$this->translator = $translator;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * Get topic data
	 *
	 * @param mixed|false $limit
	 * @param int $start
	 * @return array
	 */
	public function get_topic_data($limit = false, $start = 0)
	{
		$sql = $this->db->sql_build_query('SELECT', $this->store['sql_array']);
		$result = $this->db->sql_query_limit($sql, $limit, $start, $this->cache_time);

		while ($row = $this->db->sql_fetchrow($result))
		{
			$this->store['topic'][$row['topic_id']] = $row;

			$this->store['tracking'][$row['forum_id']]['topic_list'][] = $row['topic_id'];
			$this->store['tracking'][$row['forum_id']]['mark_time'] =& $row['forum_mark_time'];
			$this->store['post_ids']['first'][] = $row['topic_first_post_id'];
			$this->store['post_ids']['last'][] = $row['topic_last_post_id'];
		}
		$this->db->sql_freeresult($result);

		return $this->store['topic'];
	}

	/**
	 * Get post data
	 *
	 * @param mixed|false $topic_first_or_last_post (first|last)
	 * @param array $post_ids
	 * @param bool|false $limit
	 * @param int $start
	 * @param array $sql_array
	 * @return array
	 */
	public function get_post_data($topic_first_or_last_post = false, $post_ids = array(), $limit = false, $start = 0, $sql_array = array())
	{
		$sql = $this->db->sql_build_query('SELECT_DISTINCT', $this->_get_posts_sql_array($topic_first_or_last_post, $post_ids, $sql_array));
		$result = $this->db->sql_query_limit($sql, $limit, $start, $this->cache_time);

		$post_data = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$parse_flags = ($row['bbcode_bitfield'] ? OPTION_FLAG_BBCODE : 0) | OPTION_FLAG_SMILIES;
			$row['post_text'] = generate_text_for_display($row['post_text'], $row['bbcode_uid'], $row['bbcode_bitfield'], $parse_flags, true);

			$post_data[$row['topic_id']][$row['post_id']] = $row;
			$this->store['poster_ids'][] = $row['poster_id'];
			$this->store['poster_ids'][] = $row['post_edit_user'];
			$this->store['poster_ids'][] = $row['post_delete_user'];
			$this->store['attachments'][] = $row['post_id'];
		}
		$this->db->sql_freeresult($result);

		return $post_data;
	}

	/**
	 * Get attachments...
	 *
	 * @param int $forum_id
	 * @param array $allowed_extensions
	 * @param bool $exclude_in_message
	 * @param string $order_by
	 * @return array
	 */
	public function get_attachments($forum_id = 0, $allowed_extensions = array(), $exclude_in_message = true, $order_by = 'filetime DESC, post_msg_id ASC')
	{
		$this->store['attachments'] = array_filter($this->store['attachments']);

		$attachments = array();
		if ($this->_attachments_allowed($forum_id))
		{
			$sql = $this->_get_attachment_sql($allowed_extensions, $exclude_in_message, $order_by);
			$result = $this->db->sql_query($sql);

			while ($row = $this->db->sql_fetchrow($result))
			{
				$attachments[$row['post_msg_id']][] = $row;
			}
			$this->db->sql_freeresult($result);
		}
		$this->store['attachments'] = array();

		return $attachments;
	}

	/**
	 * Get topic tracking info
	 *
	 * @param int $forum_id
	 * @return array
	 */
	public function get_topic_tracking_info($forum_id = 0)
	{
		if (!sizeof($this->store['tracking']))
		{
			return array();
		}

		$tracking_info = $this->_get_tracking_info();

		return ($forum_id) ? (isset($tracking_info[$forum_id]) ? $tracking_info[$forum_id] : array()) : $tracking_info;
	}

	/**
	 * Returns an array of topic first post or last post ids
	 *
	 * @param string $first_or_last_post
	 * @return array
	 */
	public function get_topic_post_ids($first_or_last_post = 'first')
	{
		return (isset($this->store['post_ids'][$first_or_last_post])) ? $this->store['post_ids'][$first_or_last_post] : array();
	}

	/**
	 * Returns an array of topic first post or last post ids
	 */
	public function get_posters_info()
	{
		$this->store['poster_ids'] = array_filter(array_unique($this->store['poster_ids']));

		if (!sizeof($this->store['poster_ids']))
		{
			return array();
		}

		return $this->_get_user_data();
	}

	/**
	 * @param mixed $topic_first_or_last_post
	 * @param array $post_ids
	 * @param array $sql_array
	 * @return array
	 */
	private function _get_posts_sql_array($topic_first_or_last_post, array $post_ids, array $sql_array)
	{
		$sql_array = array_merge_recursive(
			array(
				'SELECT'	=> array('p.*'),
				'FROM'		=> array(POSTS_TABLE => 'p'),
				'WHERE'		=> $this->_get_post_data_where($post_ids, $topic_first_or_last_post),
				'ORDER_BY'	=> 'p.topic_id, p.post_time ASC',
			),
			$sql_array
		);

		$sql_array['SELECT'] = join(', ', array_filter($sql_array['SELECT']));
		$sql_array['WHERE'] = join(' AND ', array_filter($sql_array['WHERE']));

		return $sql_array;
	}

	/**
	 * @param array $post_ids
	 * @param string $topic_first_or_last_post
	 * @return array
	 */
	private function _get_post_data_where(array $post_ids, $topic_first_or_last_post)
	{
		$sql_where = array();

		if (sizeof($post_ids))
		{
			$sql_where[] = $this->db->sql_in_set('p.post_id', $post_ids);
		}
		else if (sizeof($this->store['topic']))
		{
			$this->_limit_posts_by_topic($sql_where, $topic_first_or_last_post);
		}

		$sql_where[] = $this->content_visibility->get_global_visibility_sql('post', $this->ex_fid_ary, 'p.');

		return $sql_where;
	}

	/**
	 * @param array $sql_where
	 * @param string $topic_first_or_last_post
	 */
	private function _limit_posts_by_topic(array &$sql_where, $topic_first_or_last_post)
	{
		$sql_where[] = $this->db->sql_in_set('p.topic_id', array_keys($this->store['topic']));

		if ($topic_first_or_last_post)
		{
			$sql_where[] = $this->db->sql_in_set('p.post_id', $this->get_topic_post_ids($topic_first_or_last_post));
		}
	}

	/**
	 * @return array
	 */
	private function _get_tracking_info()
	{
		$info = array();
		if ($this->_can_track_by_lastread())
		{
			$info = $this->_build_tracking_info('get_topic_tracking');
		}
		else if ($this->_can_track_anonymous())
		{
			$info = $this->_build_tracking_info('get_complete_topic_tracking');
		}

		return $info;
	}

	/**
	 * @param string $function
	 * @return array
	 */
	private function _build_tracking_info($function)
	{
		$tracking_info = array();
		foreach ($this->store['tracking'] as $fid => $forum)
		{
			$tracking_info[$fid] = call_user_func_array($function, array($fid, $forum['topic_list'], &$this->store['topic'], array($fid => $forum['mark_time'])));
		}

		return $tracking_info;
	}

	/**
	 * @return bool
	 */
	private function _can_track_by_lastread()
	{
		return ($this->config['load_db_lastread'] && $this->user->data['is_registered']) ? true : false;
	}

	/**
	 * @return bool
	 */
	private function _can_track_anonymous()
	{
		return ($this->config['load_anon_lastread'] || $this->user->data['is_registered']) ? true : false;
	}

	/**
	 * @param int $forum_id
	 * @return bool
	 */
	private function _attachments_allowed($forum_id)
	{
		return ($this->store['attachments'] && $this->_user_can_download_attachments($forum_id)) ? true : false;
	}

	/**
	 * @param int $forum_id
	 * @return bool
	 */
	private function _user_can_download_attachments($forum_id)
	{
		return ($this->auth->acl_get('u_download') && (!$forum_id || $this->auth->acl_get('f_download', $forum_id))) ? true : false;
	}

	/**
	 * @param array $allowed_extensions
	 * @param bool $exclude_in_message
	 * @param string $order_by
	 * @return string
	 */
	private function _get_attachment_sql($allowed_extensions, $exclude_in_message, $order_by)
	{
		return 'SELECT *
			FROM ' . ATTACHMENTS_TABLE . '
			WHERE ' . $this->db->sql_in_set('post_msg_id', $this->store['attachments']) .
				(($exclude_in_message) ? ' AND in_message = 0' : '') .
				(sizeof($allowed_extensions) ? ' AND ' . $this->db->sql_in_set('extension', $allowed_extensions) : '') . '
			ORDER BY ' . $order_by;
	}

	/**
	 * @return array
	 */
	private function _get_user_data()
	{
		$sql = 'SELECT *
			FROM ' . USERS_TABLE . '
			WHERE ' . $this->db->sql_in_set('user_id', $this->store['poster_ids']);
		$result = $this->db->sql_query($sql);

		$user_cache = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$poster_id = $row['user_id'];

			$user_cache[$poster_id] = array(
				'user_type'					=> $row['user_type'],
				'user_inactive_reason'		=> $row['user_inactive_reason'],

				'joined'			=> $this->user->format_date($row['user_regdate'], 'M d, Y'),
				'posts'				=> $row['user_posts'],
				'warnings'			=> (isset($row['user_warnings'])) ? $row['user_warnings'] : 0,
				'allow_pm'			=> $row['user_allow_pm'],
				'avatar'			=> ($this->user->optionget('viewavatars')) ? phpbb_get_user_avatar($row) : '',

				'contact_user' 		=> $this->translator->lang('CONTACT_USER', get_username_string('username', $poster_id, $row['username'], $row['user_colour'], $row['username'])),
				'search'			=> ($this->auth->acl_get('u_search')) ? append_sid("{$this->phpbb_root_path}search.$this->php_ext", "author_id=$poster_id&amp;sr=posts") : '',

				'username'			=> get_username_string('username', $poster_id, $row['username'], $row['user_colour']),
				'username_full'		=> get_username_string('full', $poster_id, $row['username'], $row['user_colour']),
				'user_colour'		=> get_username_string('colour', $poster_id, $row['username'], $row['user_colour']),
				'user_profile'		=> get_username_string('profile', $poster_id, $row['username'], $row['user_colour']),
			);

			$user_cache[$poster_id] += $this->_get_user_rank($row);
			$user_cache[$poster_id] += $this->_get_user_email($row);
		}
		$this->db->sql_freeresult($result);

		return $user_cache;
	}

	/**
	 * @param array $row
	 */
	private function _get_user_rank(array $row)
	{
		if (!function_exists('phpbb_get_user_rank'))
		{
			include($this->phpbb_root_path . 'includes/functions_display.' . $this->php_ext);
		}

		$user_rank_data = phpbb_get_user_rank($row, $row['user_posts']);

		if (!empty($user_rank_data))
		{
			return array(
				'rank_title'		=> $user_rank_data['title'],
				'rank_image'		=> $user_rank_data['img'],
				'rank_image_src'	=> $user_rank_data['img_src'],
			);
		}
		else
		{
			return array(
				'rank_title'		=> '',
				'rank_image'		=> '',
				'rank_image_src'	=> '',
			);
		}
	}

	/**
	 * @param array $row
	 */
	private function _get_user_email(array $row)
	{
		$email = '';
		if ((!empty($row['user_allow_viewemail']) && $this->auth->acl_get('u_sendemail')) || $this->auth->acl_get('a_email'))
		{
			$email = ($this->config['board_email_form'] && $this->config['email_enable']) ? append_sid("{$this->phpbb_root_path}memberlist.$this->php_ext", 'mode=email&amp;u=' . $row['user_id']) : (($this->config['board_hide_emails'] && !$this->auth->acl_get('a_email')) ? '' : 'mailto:' . $row['user_email']);
		}

		return array('email' => $email);
	}
}
