<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\forum;

use phpbb\auth\auth;
use phpbb\config\config;
use phpbb\content_visibility;
use phpbb\db\driver\driver_interface;
use phpbb\user;

class data
{
	/** @var auth */
	protected $auth;

	/** @var config */
	protected $config;

	/** @var content_visibility */
	protected $content_visibility;

	/** @var driver_interface */
	protected $db;

	/** @var user */
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
	protected $cache_time = 0;

	/**
	 * Constructor
	 *
	 * @param auth					$auth					Auth object
	 * @param config				$config					Config object
	 * @param content_visibility	$content_visibility		Content visibility
	 * @param driver_interface		$db     				Database connection
	 * @param user					$user					User object
	 * @param string				$phpbb_root_path		Path to the phpbb includes directory.
	 * @param string				$php_ext				php file extension
	 */
	public function __construct(auth $auth, config $config, content_visibility $content_visibility, driver_interface $db, user $user, $phpbb_root_path, $php_ext)
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
	 * @return $this
	 */
	public function query()
	{
		$this->_reset();

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
	 * @param $forum_id
	 * @return $this
	 */
	public function fetch_forum($forum_id)
	{
		$this->_fetch($forum_id, 'f.forum_id');

		return $this;
	}

	/**
	 * Fetch Topic by id(s)
	 *
	 * @param mixed $topic_id	Limit by topic id: single id or array of topic ids
	 * @return $this
	 */
	public function fetch_topic($topic_id)
	{
		$this->_fetch($topic_id, 't.topic_id');

		return $this;
	}

	/**
	 * Fetch Topic by Poster id(s)
	 *
	 * @param mixed $user_id	User id of topic poster: single id or array of user ids
	 * @return $this
	 */
	public function fetch_topic_poster($user_id)
	{
		$this->_fetch($user_id, 't.topic_poster');

		return $this;
	}

	/**
	 * Fetch Post by id(s)
	 *
	 * @param mixed $post_id	Limit by post id: single id or array of post ids
	 * @return $this
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
	 * @param array $topic_type
	 * @return $this
	 */
	public function fetch_topic_type(array $topic_type)
	{
		if (sizeof($topic_type))
		{
			$this->store['sql_array']['WHERE'][] = $this->db->sql_in_set('t.topic_type', $topic_type);
		}

		if (in_array($topic_type, array(POST_STICKY, POST_ANNOUNCE)))
		{
			$this->store['sql_array']['WHERE'][] = '(t.topic_time_limit > 0 AND (t.topic_time + t.topic_time_limit) < ' . time() . ')';
		}

		return $this;
	}

	/**
	 * Fetch Topic Watch info
	 *
	 * @return $this
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
	 * @return $this
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
	 * @param bool $track
	 * @return $this
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
	 * @param int $start	Unix start time
	 * @param int $stop		Unix stop time
	 * @param string $mode
	 * @return $this
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
	 * @param array	$sql_array		Array of elements to merge into query
	 * 										array(
	 * 											'SELECT'	=> array('p.*'),
	 * 											'WHERE'		=> array('p.post_id = 2'),
	 * 										)
	 * @return $this
	 */
	public function fetch_custom(array $sql_array)
	{
		$this->store['sql_array'] = array_merge_recursive($this->store['sql_array'], $sql_array);

		return $this;
	}

	/**
	 * Set Sorting Order
	 *
	 * @param string $sort_key		The sorting key e.g. t.topic_time
	 * @param string $sort_dir		Sort direction: ASC/DESC
	 * @return $this
	 */
	public function set_sorting($sort_key, $sort_dir = 'DESC')
	{
		$this->store['sql_array']['ORDER_BY'] = $sort_key . ' ' . $sort_dir;

		return $this;
	}

	/**
	 * Build the query
	 *
	 * @param bool|true $check_visibility	Should we only return data from forums the user is allowed to see?
	 * @param bool|true $enable_caching		Should the query be cached where possible?
	 * @return $this
	 */
	public function build($check_visibility = true, $enable_caching = true)
	{
		$this->_set_cache_time($enable_caching);
		$this->_set_topic_visibility($check_visibility);

		$this->store['sql_array']['WHERE'][] = 'f.forum_id = t.forum_id';
		$this->store['sql_array']['WHERE'][] = 't.topic_moved_id = 0';

		$this->store['sql_array']['SELECT'] = join(', ', array_filter($this->store['sql_array']['SELECT']));
		$this->store['sql_array']['WHERE'] = join(' AND ', array_filter($this->store['sql_array']['WHERE']));

		return $this;
	}

	/**
	 * Get the query array
	 *
	 * @return array	The sql array that can be used with sql_build_query
	 */
	public function get_sql_array()
	{
		return $this->store['sql_array'];
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
	 * @param string $topic_first_or_last_post
	 * @param array $post_ids
	 * @param bool|false $limit
	 * @param int $start
	 * @param array $sql_array
	 * @return array
	 */
	public function get_post_data($topic_first_or_last_post = '', $post_ids = array(), $limit = false, $start = 0, $sql_array = array())
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

		$sql = $this->db->sql_build_query('SELECT', $sql_array);
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
			$this->store['attachments'][$row['post_id']] = $row['post_attachment'];
		}
		$this->db->sql_freeresult($result);

		return $post_data;
	}

	/**
	 * Get attachments...
	 *
	 * @param int $forum_id
	 * @return array
	 */
	public function get_attachments($forum_id)
	{
		$this->store['attachments'] = array_flip(array_filter($this->store['attachments']));

		$attachments = array();
		if ($this->_attachments_allowed($forum_id))
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
	 * @return array
	 */
	public function get_posters_info()
	{
		$this->store['poster_ids'] = array_filter(array_unique($this->store['poster_ids']));

		$sql = 'SELECT *
			FROM ' . USERS_TABLE . '
			WHERE ' . $this->db->sql_in_set('user_id', $this->store['poster_ids']);
		$result = $this->db->sql_query($sql);

		$poster = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$poster[$row['user_id']] = $row;
		}
		$this->db->sql_freeresult($result);

		return $poster;
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
	 * Reset data
	 */
	private function _reset()
	{
		$this->store = array(
			'attachments'	=> array(),
			'post_ids'		=> array(),
			'poster_ids'	=> array(),
			'sql_array'		=> array(),
			'topic'			=> array(),
			'tracking'		=> array(),
		);
	}

	/**
	 * @param int $column_id
	 * @param string $column
	 */
	private function _fetch($column_id, $column)
	{
		if (!empty($column_id))
		{
			$this->store['sql_array']['WHERE'][] = (is_array($column_id)) ? $this->db->sql_in_set($column, $column_id) : $column . ' = ' . (int) $column_id;
		}
	}

	/**
	 * @param bool $enable_caching
	 */
	protected function _set_cache_time($enable_caching)
	{
		if ($enable_caching === true)
		{
			$this->cache_time = 10800; // caching for 3 hours
		}
	}

	/**
	 * @param bool $check_visibility
	 */
	private function _set_topic_visibility($check_visibility)
	{
		if ($check_visibility)
		{
			$this->store['sql_array']['WHERE'][] = 't.topic_time <= ' . time();
			$this->store['sql_array']['WHERE'][] = $this->content_visibility->get_global_visibility_sql('topic', $this->ex_fid_ary, 't.');
		}
	}

	/**
	 * @param array $post_ids
	 * @param string $topic_first_or_last_post
	 * @return array
	 */
	private function _get_post_data_where(array $post_ids, $topic_first_or_last_post)
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

		return $sql_where;
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
		return (sizeof($this->store['attachments']) && $this->auth->acl_get('u_download') && $this->auth->acl_get('f_download', $forum_id)) ? true : false;
	}
}
