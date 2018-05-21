<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\forum;

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

	/** @var \blitze\sitemaker\services\users\data */
	protected $user_data;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth						$auth					Auth object
	 * @param \phpbb\config\config					$config					Config object
	 * @param \phpbb\content_visibility				$content_visibility		Content visibility
	 * @param \phpbb\db\driver\driver_interface		$db     				Database connection
	 * @param \phpbb\user							$user					User object
	 * @param \blitze\sitemaker\services\users\data	$user_data				Sitemaker User data object
	 * @param integer								$cache_time				Cache results for given time
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\content_visibility $content_visibility, \phpbb\db\driver\driver_interface $db, \phpbb\user $user, \blitze\sitemaker\services\users\data $user_data, $cache_time)
	{
		parent::__construct($auth, $config, $content_visibility, $db, $user, $cache_time);

		$this->auth = $auth;
		$this->config = $config;
		$this->content_visibility = $content_visibility;
		$this->db = $db;
		$this->user = $user;
		$this->user_data = $user_data;
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
	 * @param int $limit
	 * @param int $start
	 * @return array
	 */
	public function get_topic_data($limit = 0, $start = 0)
	{
		// Topics table need to be the last in the chain
		$this->store['sql_array']['FROM'][TOPICS_TABLE] = 't';

		$sql = $this->db->sql_build_query('SELECT', $this->store['sql_array']);
		$result = $this->db->sql_query_limit($sql, $limit, $start, $this->cache_time);

		while ($row = $this->db->sql_fetchrow($result))
		{
			$this->store['topic'][$row['topic_id']] = $row;

			$this->store['tracking'][$row['forum_id']]['topic_list'][] = $row['topic_id'];
			$this->store['tracking'][$row['forum_id']]['mark_time'] =& $row['forum_mark_time'];
			$this->store['post_ids']['first'][] = $row['topic_first_post_id'];
			$this->store['post_ids']['last'][] = $row['topic_last_post_id'];
			$this->store['poster_ids'][] = $row['topic_poster'];
			$this->store['poster_ids'][] = $row['topic_last_poster_id'];
		}
		$this->db->sql_freeresult($result);

		return $this->store['topic'];
	}

	/**
	 * Get post data
	 *
	 * @param mixed|false $topic_first_or_last_post (first|last)
	 * @param array $post_ids
	 * @param int $limit
	 * @param int $start
	 * @param array $sql_array
	 * @return array
	 */
	public function get_post_data($topic_first_or_last_post = false, $post_ids = array(), $limit = 0, $start = 0, $sql_array = array())
	{
		$post_data = array();
		if ($topic_first_or_last_post && !sizeof($this->store['topic']))
		{
			return $post_data;
		}

		$sql_array = $this->_get_posts_sql_array($topic_first_or_last_post, $post_ids, $sql_array);
		$sql = $this->db->sql_build_query('SELECT_DISTINCT', $sql_array);
		$result = $this->db->sql_query_limit($sql, $limit, $start, $this->cache_time);

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
	 * @param int $limit
	 * @param bool $exclude_in_message
	 * @param string $order_by
	 * @return array
	 */
	public function get_attachments($forum_id = 0, $allowed_extensions = array(), $limit = 0, $exclude_in_message = true, $order_by = 'filetime DESC')
	{
		$data = array();
		if (sizeof($this->store['attachments']))
		{
			$attachments = new attachments($this->auth, $this->db);
			$data = $attachments->get_attachments($forum_id, $this->store['attachments'], $allowed_extensions, $limit, $exclude_in_message, $order_by);
		}

		return $data;
	}

	/**
	 * Get topic tracking info
	 *
	 * @param int $forum_id
	 * @return array
	 */
	public function get_topic_tracking_info($forum_id = 0)
	{
		$tracking_info = array();
		if (sizeof($this->store['tracking']))
		{
			$tracker = new tracker($this->config, $this->user);
			$tracking_info = $tracker->get_tracking_info($this->store['tracking'], $this->store['topic']);
		}

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
		$this->store['poster_ids'] = array_filter(array_keys(array_flip($this->store['poster_ids'])));

		$info = array();
		if (sizeof($this->store['poster_ids']))
		{
			$info = $this->user_data->get_users($this->store['poster_ids']);
		}

		return $info;
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
			),
			$sql_array
		);

		$sql_array['SELECT'] = (is_array($sql_array['SELECT'])) ? join(', ', array_filter($sql_array['SELECT'])) : $sql_array['SELECT'];
		$sql_array['WHERE'] = (is_array($sql_array['WHERE'])) ? join(' AND ', array_filter($sql_array['WHERE'])) : $sql_array['WHERE'];
		$sql_array['ORDER_BY'] = (!empty($sql_array['ORDER_BY'])) ? $sql_array['ORDER_BY'] : 'p.post_time DESC';

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
			$sql_where[] = $this->db->sql_in_set('p.post_id', array_map('intval', $post_ids));
			return $sql_where;
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
			$sql_where[] = $this->db->sql_in_set('p.post_id', array_map('intval', $this->get_topic_post_ids($topic_first_or_last_post)));
		}
	}
}
