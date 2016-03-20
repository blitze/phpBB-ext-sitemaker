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

	/** @var \phpbb\user */
	protected $user;

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
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\content_visibility $content_visibility, \phpbb\db\driver\driver_interface $db, \phpbb\user $user, $cache_time = 10800)
	{
		parent::__construct($auth, $config, $content_visibility, $db, $user, $cache_time);

		$this->auth = $auth;
		$this->config = $config;
		$this->content_visibility = $content_visibility;
		$this->db = $db;
		$this->user = $user;
	}

	/**
	 * Get topics count
	 *
	 * @return integer
	 */
	public function get_topics_count()
	{
		$sql_array = array(
			'SELECT'	=> 'COUNT(*) AS total_topics',
			'FROM'		=> $this->store['sql_array']['FROM'],
			'WHERE'		=> $this->store['sql_array']['WHERE'],
		);
		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query($sql);
		$total_topics = $this->db->sql_fetchfield('total_topics');
		$this->db->sql_freeresult($result);

		return $total_topics;
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
	 * @param mixed|bool $limit
	 * @param bool $exclude_in_message
	 * @param string $order_by
	 * @return array
	 */
	public function get_attachments($forum_id = 0, $allowed_extensions = array(), $limit = false, $exclude_in_message = true, $order_by = 'filetime DESC, post_msg_id ASC')
	{
		$this->store['attachments'] = array_filter($this->store['attachments']);

		$attachments = array();
		if ($this->_attachments_allowed($forum_id))
		{
			$sql = $this->_get_attachment_sql($allowed_extensions, $exclude_in_message, $order_by);
			$result = $this->db->sql_query_limit($sql, $limit);

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
}
