<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\forum;

class query_builder
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

	/** @var array */
	protected $store;

	/** @var array */
	protected $ex_fid_ary;

	/** @var integer */
	protected $cache_time;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth					$auth					Auth object
	 * @param \phpbb\config\config				$config					Config object
	 * @param \phpbb\content_visibility			$content_visibility		Content visibility
	 * @param \phpbb\db\driver\driver_interface	$db     				Database connection
	 * @param \phpbb\user						$user					User object
	 * @param integer							$cache_time				Cache results for 3 hours by default
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\content_visibility $content_visibility, \phpbb\db\driver\driver_interface $db, \phpbb\user $user, $cache_time)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->content_visibility = $content_visibility;
		$this->db = $db;
		$this->user = $user;
		$this->cache_time = $cache_time;

		$this->ex_fid_ary = array_unique(array_keys($this->auth->acl_getf('!f_read', true)));
	}

	/**
	 * Begin query
	 *
	 * @param bool $track_topics
	 * @param bool $get_forum_data
	 * @return $this
	 */
	public function query($track_topics = true, $get_forum_data = true)
	{
		$this->_reset();

		$this->store['sql_array'] = array_fill_keys(array('SELECT', 'FROM', 'LEFT_JOIN', 'WHERE'), array());

		if ($get_forum_data)
		{
			$this->store['sql_array']['SELECT'][] = 'f.*';
			$this->store['sql_array']['FROM'][FORUMS_TABLE] = 'f';
		}

		$this->store['sql_array']['SELECT'][] = 't.*';

		if ($track_topics)
		{
			$this->fetch_tracking_info();
		}

		return $this;
	}

	/**
	 * Fetch Forum by id(s)
	 *
	 * @param int|array $forum_id
	 * @return $this
	 */
	public function fetch_forum($forum_id)
	{
		$this->_fetch($forum_id, (isset($this->store['sql_array']['FROM'][FORUMS_TABLE])) ? 'f.forum_id' : 't.forum_Id');

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

		return $this;
	}

	/**
	 * Fetch Topic Watch info
	 *
	 * @param $type
	 * @return $this
	 */
	public function fetch_watch_status($type = 'topic')
	{
		if ($this->user->data['is_registered'])
		{
			$keys = array(
				'forum'	=> array(
					'table'	=> FORUMS_WATCH_TABLE,
					'cond'	=> 'ws.forum_id = f.forum_id',
				),
				'topic'	=> array(
					'table'	=> TOPICS_WATCH_TABLE,
					'cond'	=> 'ws.topic_id = t.topic_id',
				),
			);

			$this->store['sql_array']['SELECT'][] = 'ws.notify_status';
			$this->store['sql_array']['LEFT_JOIN'][] = array(
				'FROM'	=> array($keys[$type]['table'] => 'ws'),
				'ON'	=> $keys[$type]['cond'] . ' AND ws.user_id = ' . (int) $this->user->data['user_id'],
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
				'ON'	=> 'bm.user_id = ' . (int) $this->user->data['user_id'] . ' AND t.topic_id = bm.topic_id'
			);
		}

		return $this;
	}

	/**
	 * Fetch Topic Tracking Info
	 *
	 * @return $this
	 */
	public function fetch_tracking_info()
	{
		if ($this->user->data['is_registered'] && $this->config['load_db_lastread'])
		{
			$this->cache_time = 0;

			$this->store['sql_array']['SELECT'][] = 'tt.mark_time, ft.mark_time as forum_mark_time';
			$this->store['sql_array']['LEFT_JOIN'][] = array(
				'FROM'	=> array(TOPICS_TRACK_TABLE => 'tt'),
				'ON'	=> 'tt.user_id = ' . (int) $this->user->data['user_id'] . ' AND t.topic_id = tt.topic_id'
			);

			$this->store['sql_array']['LEFT_JOIN'][] = array(
				'FROM'	=> array(FORUMS_TRACK_TABLE => 'ft'),
				'ON'	=> 'ft.user_id = ' . (int) $this->user->data['user_id'] . ' AND t.forum_id = ft.forum_id'
			);
		}

		return $this;
	}

	/**
	 * Fetch by Date Range
	 *
	 * @param int $unix_start_time
	 * @param int $unix_stop_time
	 * @param string $mode topic|post
	 * @return $this
	 */
	public function fetch_date_range($unix_start_time, $unix_stop_time, $mode = 'topic')
	{
		if ($unix_start_time && $unix_stop_time)
		{
			$this->store['sql_array']['WHERE'][] = (($mode == 'topic') ? 't.topic_time' : 'p.post_time') . " BETWEEN $unix_start_time AND $unix_stop_time";
		}

		return $this;
	}

	/**
	 * Fetch by Custom Query
	 *
	 * @param array	$sql_array			Array of elements to merge into query
	 * 										array(
	 * 											'SELECT'	=> array('p.*'),
	 * 											'WHERE'		=> array('p.post_id = 2'),
	 * 										)
	 * @param array $overwrite_keys		Array of query keys to overwrite with yours instead of merging
	 *									e.g array('SELECT') will overwrite the 'SELECT' key with whatever is provided in $sql_array
	 * @return $this
	 */
	public function fetch_custom(array $sql_array, $overwrite_keys = array())
	{
		$this->store['sql_array'] = array_merge_recursive($this->store['sql_array'], $sql_array);

		foreach ($overwrite_keys as $key)
		{
			$this->store['sql_array'][$key] = $sql_array[$key];
		}

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
	 * @param bool|true $check_visibility		Should we only return data from forums the user is allowed to see?
	 * @param bool|true $enable_caching			Should the query be cached where possible?
	 * @param bool|true $exclude_hidden_forums	Leave out hidden forums?
	 * @return $this
	 */
	public function build($check_visibility = true, $enable_caching = true, $exclude_hidden_forums = true)
	{
		$this->_set_cache_time($enable_caching);
		$this->_set_topic_visibility($check_visibility);
		$this->_set_forum_table($exclude_hidden_forums);

		// Topics table need to be the last in the chain
		$this->store['sql_array']['FROM'][TOPICS_TABLE] = 't';
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
	 * @return int
	 */
	public function time()
	{
		return time();
	}

	/**
	 * @param bool $enable_caching
	 * @return void
	 */
	protected function _set_cache_time($enable_caching)
	{
		if ($enable_caching === false)
		{
			$this->cache_time = 0;
		}
	}

	/**
	 * @param int|array $column_id
	 * @param string $column
	 * @return void
	 */
	private function _fetch($column_id, $column)
	{
		if (!empty($column_id))
		{
			$this->store['sql_array']['WHERE'][] = (is_array($column_id)) ? $this->db->sql_in_set($column, $column_id) : $column . ' = ' . (int) $column_id;
		}
	}

	/**
	 * @param bool $check_visibility
	 * @return void
	 */
	private function _set_topic_visibility($check_visibility)
	{
		if ($check_visibility)
		{
			$this->store['sql_array']['WHERE'][] = 't.topic_time <= ' . (int) $this->time();
			$this->store['sql_array']['WHERE'][] = $this->content_visibility->get_global_visibility_sql('topic', array_map('intval', $this->ex_fid_ary), 't.');
		}
	}

	/**
	 * @param bool $exclude_hidden_forums
	 * @return void
	 */
	private function _set_forum_table($exclude_hidden_forums)
	{
		if ($exclude_hidden_forums)
		{
			$this->store['sql_array']['FROM'][FORUMS_TABLE] = 'f';
			$this->store['sql_array']['WHERE'][] = 'f.hidden_forum = 0';
		}

		if (isset($this->store['sql_array']['FROM'][FORUMS_TABLE]))
		{
			$this->store['sql_array']['WHERE'][] = 'f.forum_id = t.forum_id';
		}
	}

	/**
	 * Reset data
	 * @return void
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
}
