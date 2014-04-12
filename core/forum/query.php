<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core\forum;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
*
*/
class query
{

	/**
	 * Config object
	 * @var \phpbb\config\db
	 */
	protected $config;

	/**
	 * Database connection
	 * @var \phpbb\db\driver\driver
	 */
	protected $db;

	/**
	 * User object
	 * @var \phpbb\user
	 */
	protected $user;

	/**
	 * Primetime object
	 * @var \primetime\primetime\core\primetime
	 */
	protected $primetime;

	protected $sql_array		= array();
	protected $topic_tracking	= array();
	protected $topic_data		= array();
	protected $topic_post_ids	= array('first' => array(), 'last' => array());

	/**
	 * Constructor
	 * 
	 * @param \phpbb\config\db						$config			Config object
	 * @param \phpbb\db\driver\driver				$db     		Database connection
	 * @param \phpbb\user							$user			User object
	 * @param \primetime\primetime\core\primetime	$primetime		Primetime object
	 */
	public function __construct(\phpbb\config\db $config, \phpbb\db\driver\driver $db, \phpbb\user $user, \primetime\primetime\core\primetime $primetime)
	{
		$this->config = $config;
		$this->db = $db;
		$this->user = $user;
		$this->primetime = $primetime;
	}

	/**
	 * Build a query to pull up forum data
	 */
	public function build_query($get = array(), $sql_array = array())
	{
		$get += array(
			'forum_id'		=> 0,
			'topic_id'		=> 0,
			'post_id'		=> 0,

			'topic_type'		=> false,
			'watch_info'		=> false,
			'tracking_info'		=> false,
			'bookmark_status'	=> false,
			'sort_key'			=> false,
			'sort_dir'			=> 'DESC',
		);

		$this->topic_data = array();
		$this->sql_array = array(
			'SELECT'	=> 't.*, f.*',

			'FROM'		=> array(FORUMS_TABLE => 'f'),

			'LEFT_JOIN'	=> array(),

			'WHERE'		=> array(),
		);

		// The FROM-Order is quite important here, else t.* columns can not be correctly bound.
		if (!empty($get['post_id']))
		{
			$post_id = (int) $get['post_id'];

			$this->sql_array['SELECT'] .= ', p.post_visibility, p.post_time, p.post_id';
			$this->sql_array['FROM'][POSTS_TABLE] = 'p';
			$this->sql_array['WHERE'][] = "p.post_id = $post_id AND t.topic_id = p.topic_id";
		}

		// Topics table need to be the last in the chain
		$this->sql_array['FROM'][TOPICS_TABLE] = 't';

		if ($this->user->data['is_registered'])
		{
			if ($get['watch_info'])
			{
				$this->sql_array['SELECT'] .= ', tw.notify_status';
				$this->sql_array['LEFT_JOIN'][] = array(
					'FROM'	=> array(TOPICS_WATCH_TABLE => 'tw'),
					'ON'	=> 'tw.user_id = ' . $this->user->data['user_id'] . ' AND t.topic_id = tw.topic_id'
				);

				$this->sql_array['SELECT'] .= ', fw.notify_status';
				$this->sql_array['LEFT JOIN'][] = array(
					'FROM'	=> array(FORUMS_WATCH_TABLE => 'fw'),
					'ON'	=> '(fw.forum_id = f.forum_id AND fw.user_id = ' . $this->user->data['user_id'] . ')',
				);
			}

			if ($get['bookmark_status'] && $this->config['allow_bookmarks'])
			{
				$this->sql_array['SELECT'] .= ', bm.topic_id as bookmarked';
				$this->sql_array['LEFT_JOIN'][] = array(
					'FROM'	=> array(BOOKMARKS_TABLE => 'bm'),
					'ON'	=> 'bm.user_id = ' . $this->user->data['user_id'] . ' AND t.topic_id = bm.topic_id'
				);
			}

			if ($get['tracking_info'] && $this->config['load_db_lastread'])
			{
				$this->sql_array['SELECT'] .= ', tt.mark_time, ft.mark_time as forum_mark_time';

				$this->sql_array['LEFT_JOIN'][] = array(
					'FROM'	=> array(TOPICS_TRACK_TABLE => 'tt'),
					'ON'	=> 'tt.user_id = ' . $this->user->data['user_id'] . ' AND t.topic_id = tt.topic_id'
				);

				$this->sql_array['LEFT_JOIN'][] = array(
					'FROM'	=> array(FORUMS_TRACK_TABLE => 'ft'),
					'ON'	=> 'ft.user_id = ' . $this->user->data['user_id'] . ' AND t.forum_id = ft.forum_id'
				);
			}
		}

		if (!empty($get['topic_type']))
		{
			$topic_type = (is_array($get['topic_type'])) ? $get['topic_type'] : array($get['topic_type']);
			$this->sql_array['WHERE'][] = $this->db->sql_in_set('t.topic_type', $topic_type);

			if (in_array($topic_type, array(POST_STICKY, POST_ANNOUNCE)))
			{
				$this->sql_array['WHERE'][] = '(t.topic_time_limit > 0 AND (t.topic_time + t.topic_time_limit) < ' . time() . ')';
			}
		}

		if (!empty($get['forum_id']))
		{
			$forum_id = $get['forum_id'];
			$forum_id = (is_array($forum_id)) ? $forum_id : array((int) $forum_id);
			$this->sql_array['WHERE'][] = $this->db->sql_in_set('f.forum_id', $forum_id);
		}

		if (!empty($get['topic_id']))
		{
			$this->sql_array['WHERE'][] = 't.topic_id = ' . (int) $get['topic_id'];
		}

		// let's exlude forums this user is not allowed to view
		if (isset($this->user->data['ex_forums']))
		{
			$this->sql_array['WHERE'][] = $this->db->sql_in_set('f.forum_id', $this->user->data['ex_forums'], true);
		}

		$this->sql_array['WHERE'][] = 'f.forum_id = t.forum_id';

		$this->sql_array['WHERE'] = join(' AND ', $this->sql_array['WHERE']);

		if ($get['sort_key'])
		{
			$this->sql_array['ORDER_BY'] = $get['sort_key'] . ' ' . $get['sort_dir'];
		}

		if (sizeof($sql_array))
		{
			$this->sql_array = $this->primetime->merge_dbal_arrays($this->sql_array, $sql_array);
		}

		return $this->sql_array;
	}

	/**
	 * 
	 */
	public function get_topic_data($limit, $start = 0, $sql_array = array())
	{
		if (sizeof($sql_array))
		{
			$this->sql_array = $this->primetime->merge_dbal_arrays($this->sql_array, $sql_array);
		}

		if (empty($this->sql_array))
		{
			$this->build_query(array(), $sql_array); 
		}

		$sql = $this->db->sql_build_query('SELECT', $this->sql_array);
		$result = $this->db->sql_query_limit($sql, $limit, $start);

		while($row = $this->db->sql_fetchrow($result))
		{
			$this->topic_data[$row['topic_id']] = $row;
			$this->topic_tracking[$row['forum_id']]['topic_list'][] = $row['topic_id'];
			$this->topic_tracking[$row['forum_id']]['mark_time'] =& $row['forum_mark_time'];
			$this->topic_post_ids['first'][] = $row['topic_first_post_id'];
			$this->topic_post_ids['last'][] = $row['topic_last_post_id'];
		}
		$this->db->sql_freeresult($result);

		return $this->topic_data;
	}

	/**
	 * 
	 */
	public function get_post_data($limit = false, $start = 0, $pagination = false, $post_ids = array())
	{
		$sql_where = array();
		if (sizeof($this->topic_data))
		{
			$sql_where[] = $this->db->sql_in_set('topic_id', array_keys($this->topic_data));
		}

		if (sizeof($post_ids))
		{
			$sql_where[] = $this->db->sql_in_set('post_id', $post_ids);
		}

		$sql = 'SELECT * FROM ' . POSTS_TABLE . ((sizeof($sql_where)) ? ' WHERE ' . join(' AND ', $sql_where) : '');
		$result = $this->db->sql_query_limit($sql, $limit, $start);

		while($row = $this->db->sql_fetchrow($result))
		{
			$post_data[$row['topic_id']][$row['post_id']] = $row;
		}
		$this->db->sql_freeresult($result);

		return $post_data;
	}

	/**
	 * 
	 */
	public function get_topic_tracking_info()
	{
		$topic_tracking_info = array();
		foreach ($this->topic_tracking as $forum_id => $forum)
		{
			$topic_tracking_info[$forum_id] = get_topic_tracking($forum_id, $forum['topic_list'], $this->topic_data, array($forum_id => $forum['mark_time']));
		}

		return $topic_tracking_info;
	}

	/**
	 * Returns an array of topic first post or last post ids
	 */
	public function get_topic_post_ids($first_or_last = 'first')
	{
		return (isset($this->topic_post_ids[$first_or_last])) ? $this->topic_post_ids[$first_or_last] : array();
	}
}
