<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\services\forum;

class query
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\content_visibility */
	protected $content_visibility;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/** @var array */
	protected $store;

	/** @var array */
	protected $ex_fid_ary;

	/** @var integer */
	protected $cache_time = 10800; // caching for 3 hours

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth						$auth					Auth object
	 * @param \phpbb\config\config					$config					Config object
	 * @param \phpbb\content_visibility				$content_visibility		Content visibility
	 * @param \phpbb\db\driver\driver_interface		$db     				Database connection
	 * @param \phpbb\user							$user					User object
	 * @param string								$phpbb_root_path		Path to the phpbb includes directory.
	 * @param string								$php_ext				php file extension
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\content_visibility $content_visibility, \phpbb\db\driver\driver_interface $db, \phpbb\user $user, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->content_visibility = $content_visibility;
		$this->db = $db;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;

		$this->ex_fid_ary = array_unique(array_keys($this->auth->acl_getf('!f_read', true)));
	}

	/**
	 * Begin query
	 *
	 * @return	\primetime\core\forum\query		This object for chaining calls
	 */
	public function query()
	{
		$this->store = array(
			'attachments'	=> array(),
			'post_ids'		=> array(),
			'poster_ids'	=> array(),
			'sql_array'		=> array(),
			'topic'			=> array(),
			'tracking'		=> array(),
		);

		$this->store['sql_array'] = array(
			'SELECT'	=> array('t.*, f.*'),

			'FROM'		=> array(FORUMS_TABLE => 'f'),

			'LEFT_JOIN'	=> array(),

			'WHERE'		=> array(),
		);

		// Topics table need to be the last in the chain
		$this->store['sql_array']['FROM'][TOPICS_TABLE] = 't';

		return $this;
	}

	/**
	 * Fetch Forum by id(s)
	 *
	 * @param	mixed	$forum_id	Limit by forum id: single id or array of forum ids
	 * @return	\primetime\core\forum\query		This object for chaining calls
	 */
	public function fetch_forum($forum_id)
	{
		$this->_fetch($forum_id, 'f.forum_id');

		return $this;
	}

	/**
	 * Fetch Topic by id(s)
	 *
	 * @param	mixed	$topic_id	Limit by topic id: single id or array of topic ids
	 * @return	\primetime\core\forum\query		This object for chaining calls
	 */
	public function fetch_topic($topic_id)
	{
		$this->_fetch($topic_id, 't.topic_id');

		return $this;
	}

	/**
	 * Fetch Topic by Poster id(s)
	 *
	 * @param	mixed	$user_id	User id of topic poster: single id or array of user ids
	 * @return	\primetime\core\forum\query		This object for chaining calls
	 */
	public function fetch_topic_poster($user_id)
	{
		$this->_fetch($user_id, 't.topic_poster');

		return $this;
	}

	/**
	 * Fetch Post by id(s)
	 *
	 * @param	mixed	$post_id	Limit by post id: single id or array of post ids
	 * @return	\primetime\core\forum\query		This object for chaining calls
	 */
	public function fetch_post($post_id)
	{
		$this->store['sql_array']['SELECT'][] = 'p.post_visibility, p.post_time, p.post_id';
		$this->store['sql_array']['FROM'][POSTS_TABLE] = 'p';
		$this->store['sql_array']['WHERE'][] = ((is_array($post_id)) ? $this->db->sql_in_set('p.post_id', $post_id) : 'p.post_id = ' . (int) $post_id) . ' AND t.topic_id = p.topic_id';

		return $this;
	}

	/**
	 * Fetch by Topic Type
	 *
	 * @param	mixed	$topic_type		Limit by post id: single id or array of post ids
	 * @return	\primetime\core\forum\query		This object for chaining calls
	 */
	public function fetch_topic_type($topic_type)
	{
		$topic_type = (is_array($topic_type)) ? $topic_type : array($topic_type);
		$this->store['sql_array']['WHERE'][] = $this->db->sql_in_set('t.topic_type', $topic_type);

		if (in_array($topic_type, array(POST_STICKY, POST_ANNOUNCE)))
		{
			$this->store['sql_array']['WHERE'][] = '(t.topic_time_limit > 0 AND (t.topic_time + t.topic_time_limit) < ' . time() . ')';
		}

		return $this;
	}

	/**
	 * Fetch Topic Watch info
	 *
	 * @return	\primetime\core\forum\query		This object for chaining calls
	 */
	public function fetch_watch_status()
	{
		if ($this->user->data['is_registered'])
		{
			$this->store['sql_array']['SELECT'][] = 'tw.notify_status';
			$this->store['sql_array']['LEFT_JOIN'][] = array(
				'FROM'	=> array(TOPICS_WATCH_TABLE => 'tw'),
				'ON'	=> 'tw.user_id = ' . $this->user->data['user_id'] . ' AND t.topic_id = tw.topic_id'
			);

			$this->store['sql_array']['SELECT'][] = 'fw.notify_status';
			$this->store['sql_array']['LEFT JOIN'][] = array(
				'FROM'	=> array(FORUMS_WATCH_TABLE => 'fw'),
				'ON'	=> '(fw.forum_id = f.forum_id AND fw.user_id = ' . $this->user->data['user_id'] . ')',
			);
		}

		return $this;
	}

	/**
	 * Fetch Topic Bookmark Info
	 *
	 * @return	\primetime\core\forum\query		This object for chaining calls
	 */
	public function fetch_bookmark_status()
	{
		if ($this->user->data['is_registered'] && $this->config['allow_bookmarks'])
		{
			$this->store['sql_array']['SELECT'][] = 'bm.topic_id as bookmarked';
			$this->store['sql_array']['LEFT_JOIN'][] = array(
				'FROM'	=> array(BOOKMARKS_TABLE => 'bm'),
				'ON'	=> 'bm.user_id = ' . $this->user->data['user_id'] . ' AND t.topic_id = bm.topic_id'
			);
		}

		return $this;
	}

	/**
	 * Fetch Topic Tracking Info
	 *
	 * @return	\primetime\core\forum\query		This object for chaining calls
	 */
	public function fetch_tracking_info($track = true)
	{
		if ($track && $this->user->data['is_registered'] && $this->config['load_db_lastread'])
		{
			$this->cache_time = 0;

			$this->store['sql_array']['SELECT'][] = 'tt.mark_time, ft.mark_time as forum_mark_time';
			$this->store['sql_array']['LEFT_JOIN'][] = array(
				'FROM'	=> array(TOPICS_TRACK_TABLE => 'tt'),
				'ON'	=> 'tt.user_id = ' . $this->user->data['user_id'] . ' AND t.topic_id = tt.topic_id'
			);

			$this->store['sql_array']['LEFT_JOIN'][] = array(
				'FROM'	=> array(FORUMS_TRACK_TABLE => 'ft'),
				'ON'	=> 'ft.user_id = ' . $this->user->data['user_id'] . ' AND t.forum_id = ft.forum_id'
			);
		}

		return $this;
	}

	/**
	 * Fetch by Date Range
	 *
	 * @param	integer		$start		Unix start time
	 * @param	integer		$start		Unix stop time
	 * @return	\primetime\core\forum\query		This object for chaining calls
	 */
	public function fetch_date_range($start, $stop, $mode = 'topic')
	{
		if ($start && $stop)
		{
			$this->store['sql_array']['WHERE'][] = (($mode == 'topic') ? 't.topic_time' : 'p.post_time') . " BETWEEN $start AND $stop";
		}

		return $this;
	}

	/**
	 * Fetch by Custom Query
	 *
	 * @param	array	$sql_array		Array of elements to merge into query
	 * 										array(
	 * 											'SELECT'	=> array('p.*'),
	 * 											'WHERE'		=> array('p.post_id = 2'),
	 * 										)
	 * @return	\primetime\core\forum\query		This object for chaining calls
	 */
	public function fetch_custom($sql_array)
	{
		$this->store['sql_array'] = array_merge_recursive($this->store['sql_array'], $sql_array);

		return $this;
	}

	/**
	 * Set Sorting Order
	 *
	 * @param	string	$sort_key	The sorting key e.g. t.topic_time
	 * @param	string	$sort_dir	Sort direction: ASC/DESC
	 * @return	\primetime\core\forum\query		This object for chaining calls
	 */
	public function set_sorting($sort_key, $sort_dir = 'DESC')
	{
		$this->store['sql_array']['ORDER_BY'] = $sort_key . ' ' . $sort_dir;

		return $this;
	}

	/**
	 * Build the query
	 *
	 * @param	bool	$check_visibility	Should we only return data from forums the user is allowed to see?
	 * @param	bool	$enable_caching		Should the query be cached where possible?
	 * @return	\primetime\core\forum\query		This object for chaining calls
	 */
	public function build($check_visibility = true, $enable_caching = true)
	{
		if ($enable_caching !== true)
		{
			$this->cache_time = 0;
		}

		if ($check_visibility)
		{
			$this->store['sql_array']['WHERE'][] = 't.topic_time <= ' . time();
			$this->store['sql_array']['WHERE'][] = $this->content_visibility->get_global_visibility_sql('topic', $this->ex_fid_ary, 't.');
		}

		$this->store['sql_array']['WHERE'][] = 'f.forum_id = t.forum_id';
		$this->store['sql_array']['WHERE'][] = 't.topic_moved_id = 0';

		$this->store['sql_array']['SELECT'] = join(', ', array_filter($this->store['sql_array']['SELECT']));
		$this->store['sql_array']['WHERE'] = join(' AND ', array_filter($this->store['sql_array']['WHERE']));

		return $this;
	}

	/**
	 * Get the query array
	 *
	 * @return	array	The sql array that can be used with sql_build_query
	 */
	public function get_sql_array()
	{
		return $this->store['sql_array'];
	}

	/**
	 * Get topic data
	 */
	public function get_topic_data($limit = 0, $start = 0)
	{
		$sql = $this->db->sql_build_query('SELECT', $this->store['sql_array']);
		$result = $this->db->sql_query_limit($sql, ($limit) ? $limit : false, $start, $this->cache_time);

		while($row = $this->db->sql_fetchrow($result))
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
	 */
	public function get_post_data($topic_first_or_last_post = '', $post_ids = array(), $limit = false, $start = 0, $sql_array = array())
	{
		$sql_where = array();
		if (sizeof($this->store['topic']))
		{
			$sql_where[] = $this->db->sql_in_set('topic_id', array_keys($this->store['topic']));

			if ($topic_first_or_last_post)
			{
				$post_ids = array_merge($post_ids, $this->get_topic_post_ids($topic_first_or_last_post));
				$sql_where[] = $this->db->sql_in_set('post_id', $post_ids);
			}
		}

		$sql_where[] = $this->content_visibility->get_global_visibility_sql('post', $this->ex_fid_ary, 'p.');

		$sql_array = array_merge_recursive(array(
				'SELECT'	=> array('p.*'),
				'FROM'		=> array(POSTS_TABLE => 'p'),
				'WHERE'		=> $sql_where,
				'ORDER_BY'	=> 'p.topic_id, p.post_time ASC',
			),
			$sql_array
		);

		$sql_array['SELECT'] = join(', ', array_filter($sql_array['SELECT']));
		$sql_array['WHERE'] = join(' AND ', array_filter($sql_array['WHERE']));

		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query_limit($sql, $limit, $start, $this->cache_time);

		$post_data = array();
		while($row = $this->db->sql_fetchrow($result))
		{
			$parse_flags = ($row['bbcode_bitfield'] ? OPTION_FLAG_BBCODE : 0) | OPTION_FLAG_SMILIES;
			$row['post_text'] = generate_text_for_display($row['post_text'], $row['bbcode_uid'], $row['bbcode_bitfield'], $parse_flags, true);

			$post_data[$row['topic_id']][$row['post_id']] = $row;
			$this->store['poster_ids'][] = $row['poster_id'];
			$this->store['poster_ids'][] = $row['post_edit_user'];
			$this->store['poster_ids'][] = $row['post_delete_user'];
			$this->store['attachments'][$row['post_id']] = $row['post_attachment'];
		}
		$this->db->sql_freeresult($result);

		return $post_data;
	}

	/**
	 * Get attachments...
	 */
	public function get_attachments($forum_id)
	{
		$this->store['attachments'] = array_flip(array_filter($this->store['attachments']));

		$attachments = array();
		if (sizeof($this->store['attachments']) && $this->auth->acl_get('u_download') && $this->auth->acl_get('f_download', $forum_id))
		{
			$sql = 'SELECT *
				FROM ' . ATTACHMENTS_TABLE . '
				WHERE ' . $this->db->sql_in_set('post_msg_id', $this->store['attachments']) . '
					AND in_message = 0
				ORDER BY filetime DESC, post_msg_id ASC';
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
	 */
	public function get_topic_tracking_info($forum_id = 0)
	{
		if (!sizeof($this->store['tracking']))
		{
			return array();
		}

		$tracking_info = array();
		if ($this->config['load_db_lastread'] && $this->user->data['is_registered'])
		{
			foreach ($this->store['tracking'] as $fid => $forum)
			{
				$tracking_info[$fid] = get_topic_tracking($fid, $forum['topic_list'], $this->store['topic'], array($fid => $forum['mark_time']));
			}
		}
		else if ($this->config['load_anon_lastread'] || $this->user->data['is_registered'])
		{
			foreach ($this->store['tracking'] as $fid => $forum)
			{
				$tracking_info[$fid] = get_complete_topic_tracking($fid, $forum['topic_list']);
			}
		}

		return ($forum_id) ? (isset($tracking_info[$forum_id]) ? $tracking_info[$forum_id] : array()) : $tracking_info;
	}

	/**
	 * Returns an array of topic first post or last post ids
	 */
	public function get_posters_info()
	{
		$this->store['poster_ids'] = array_filter(array_unique($this->store['poster_ids']));

		if (!function_exists('get_user_rank'))
		{
			include($this->phpbb_root_path . 'includes/functions_display.' . $this->php_ext);
		}

		if (!sizeof($this->store['poster_ids']))
		{
			return array();
		}

		$now = $this->user->create_datetime();
		$now = phpbb_gmgetdate($now->getTimestamp() + $now->getOffset());

		$sql = 'SELECT *
			FROM ' . USERS_TABLE . '
			WHERE ' . $this->db->sql_in_set('user_id', $this->store['poster_ids']);
		$result = $this->db->sql_query($sql);

		$user_cache = array();
		while($row = $this->db->sql_fetchrow($result))
		{
			$poster_id = $row['user_id'];

			$user_cache[$poster_id] = array(
				'user_type'					=> $row['user_type'],
				'user_inactive_reason'		=> $row['user_inactive_reason'],

				'joined'			=> $this->user->format_date($row['user_regdate'], 'M d, Y'),
				'posts'				=> $row['user_posts'],
				'warnings'			=> (isset($row['user_warnings'])) ? $row['user_warnings'] : 0,

				'viewonline'		=> $row['user_allow_viewonline'],
				'allow_pm'			=> $row['user_allow_pm'],

				'avatar'			=> ($this->user->optionget('viewavatars')) ? phpbb_get_user_avatar($row) : '',
				'age'				=> '',

				'rank_title'		=> '',
				'rank_image'		=> '',
				'rank_image_src'	=> '',

				'contact_user' 		=> $this->user->lang('CONTACT_USER', get_username_string('username', $poster_id, $row['username'], $row['user_colour'], $row['username'])),

				'online'			=> false,
				'jabber'			=> ($row['user_jabber'] && $this->auth->acl_get('u_sendim')) ? append_sid("{$this->phpbb_root_path}memberlist.$this->php_ext", "mode=contact&amp;action=jabber&amp;u=$poster_id") : '',
				'search'			=> ($this->auth->acl_get('u_search')) ? append_sid("{$this->phpbb_root_path}search.$this->php_ext", "author_id=$poster_id&amp;sr=posts") : '',

				'username'			=> get_username_string('username', $poster_id, $row['username'], $row['user_colour']),
				'username_full'		=> get_username_string('full', $poster_id, $row['username'], $row['user_colour']),
				'user_colour'		=> get_username_string('colour', $poster_id, $row['username'], $row['user_colour']),
				'user_profile'		=> get_username_string('profile', $poster_id, $row['username'], $row['user_colour']),
			);

			get_user_rank($row['user_rank'], $row['user_posts'], $user_cache[$poster_id]['rank_title'], $user_cache[$poster_id]['rank_image'], $user_cache[$poster_id]['rank_image_src']);

			if ((!empty($row['user_allow_viewemail']) && $this->auth->acl_get('u_sendemail')) || $this->auth->acl_get('a_email'))
			{
				$user_cache[$poster_id]['email'] = ($this->config['board_email_form'] && $this->config['email_enable']) ? append_sid("{$this->phpbb_root_path}memberlist.$this->php_ext", "mode=email&amp;u=$poster_id") : (($this->config['board_hide_emails'] && !$this->auth->acl_get('a_email')) ? '' : 'mailto:' . $row['user_email']);
			}
			else
			{
				$user_cache[$poster_id]['email'] = '';
			}

			if ($this->config['allow_birthdays'] && !empty($row['user_birthday']))
			{
				list($bday_day, $bday_month, $bday_year) = array_map('intval', explode('-', $row['user_birthday']));

				if ($bday_year)
				{
					$diff = $now['mon'] - $bday_month;
					if ($diff == 0)
					{
						$diff = ($now['mday'] - $bday_day < 0) ? 1 : 0;
					}
					else
					{
						$diff = ($diff < 0) ? 1 : 0;
					}

					$user_cache[$poster_id]['age'] = (int) ($now['year'] - $bday_year - $diff);
				}
			}
		}
		$this->db->sql_freeresult($result);

		return $user_cache;
	}

	/**
	 * Returns an array of topic first post or last post ids
	 */
	public function get_topic_post_ids($first_or_last_post = 'first')
	{
		return (isset($this->store['post_ids'][$first_or_last_post])) ? $this->topic_post_ids[$first_or_last_post] : array();
	}

	private function _fetch($column_id, $column)
	{
		if (!empty($column_id))
		{
			$this->store['sql_array']['WHERE'][] = (is_array($column_id)) ? $this->db->sql_in_set($column, $column_id) : $column . ' = ' . (int) $column_id;
		}
	}
}
