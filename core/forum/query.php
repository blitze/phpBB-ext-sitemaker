<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core\forum;

class query
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\db */
	protected $config;

	/** @var \phpbb\content_visibility */
	protected $content_visibility;

	/** @var \phpbb\db\driver\factory */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $phpbb_root_path = null;

	/** @var string */
	protected $php_ext = null;

	/** @var \primetime\primetime\core\primetime */
	protected $primetime;

	protected $attachments		= array();
	protected $ex_fid_ary		= array();
	protected $poster_ids		= array();
	protected $topic_data		= array();
	protected $topic_tracking	= array();
	protected $sql_array		= array();
	protected $topic_post_ids	= array('first' => array(), 'last' => array());
	protected $cache_time		= 10800; // caching for 3 hours

	/**
	 * Constructor
	 * 
	 * @param \phpbb\auth\auth						$auth					Auth object
	 * @param \phpbb\config\db						$config					Config object
	 * @param \phpbb\content_visibility				$content_visibility		Content visibility
	 * @param \phpbb\db\driver\factory				$db     				Database connection
	 * @param \phpbb\user							$user					User object
	 * @param string								$phpbb_root_path		Path to the phpbb includes directory.
	 * @param string								$php_ext				php file extension
	 * @param \primetime\primetime\core\primetime	$primetime				Primetime object
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\db $config, \phpbb\content_visibility $content_visibility, \phpbb\db\driver\factory $db, \phpbb\user $user, $phpbb_root_path, $php_ext, \primetime\primetime\core\primetime $primetime)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->content_visibility = $content_visibility;
		$this->db = $db;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		$this->primetime = $primetime;
	}

	/**
	 * Build a query to pull up forum data
	 */
	public function build_query($options = array(), $sql_array = array())
	{
		$options += array(
			'forum_id'		=> 0,
			'topic_id'		=> 0,
			'post_id'		=> 0,

			'topic_type'		=> false,
			'watch_info'		=> false,
			'topic_tracking'	=> false,
			'bookmark_status'	=> false,
			'sort_key'			=> false,
			'sort_dir'			=> 'DESC',
			'enable_caching'	=> true,
			'check_visibility'	=> true,
		);

		$this->topic_data = array();
		$this->ex_fid_ary = array_unique(array_keys($this->auth->acl_getf('!f_read', true)));

		$this->sql_array = array(
			'SELECT'	=> 't.*, f.*',

			'FROM'		=> array(FORUMS_TABLE => 'f'),

			'LEFT_JOIN'	=> array(),

			'WHERE'		=> array(),
		);

		// The FROM-Order is quite important here, else t.* columns can not be correctly bound.
		if (!empty($options['post_id']))
		{
			$post_id = (int) $options['post_id'];

			$this->sql_array['SELECT'] .= ', p.post_visibility, p.post_time, p.post_id';
			$this->sql_array['FROM'][POSTS_TABLE] = 'p';
			$this->sql_array['WHERE'][] = "p.post_id = $post_id AND t.topic_id = p.topic_id";
		}

		// Topics table need to be the last in the chain
		$this->sql_array['FROM'][TOPICS_TABLE] = 't';

		if ($this->user->data['is_registered'])
		{
			if ($options['watch_info'])
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

			if ($options['bookmark_status'] && $this->config['allow_bookmarks'])
			{
				$this->sql_array['SELECT'] .= ', bm.topic_id as bookmarked';
				$this->sql_array['LEFT_JOIN'][] = array(
					'FROM'	=> array(BOOKMARKS_TABLE => 'bm'),
					'ON'	=> 'bm.user_id = ' . $this->user->data['user_id'] . ' AND t.topic_id = bm.topic_id'
				);
			}

			if ($options['topic_tracking'] || $options['enable_caching'] !== true)
			{
				$this->cache_time = 0;
			}

			if ($options['topic_tracking'] && $this->config['load_db_lastread'])
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

		if (!empty($options['topic_type']))
		{
			$topic_type = (is_array($options['topic_type'])) ? $options['topic_type'] : array($options['topic_type']);
			$this->sql_array['WHERE'][] = $this->db->sql_in_set('t.topic_type', $topic_type);

			if (in_array($topic_type, array(POST_STICKY, POST_ANNOUNCE)))
			{
				$this->sql_array['WHERE'][] = '(t.topic_time_limit > 0 AND (t.topic_time + t.topic_time_limit) < ' . time() . ')';
			}
		}

		if (!empty($options['forum_id']))
		{
			$forum_id = $options['forum_id'];
			$forum_id = (is_array($forum_id)) ? $forum_id : array((int) $forum_id);
			$this->sql_array['WHERE'][] = $this->db->sql_in_set('f.forum_id', $forum_id);
		}

		if (!empty($options['topic_id']))
		{
			$this->sql_array['WHERE'][] = 't.topic_id = ' . (int) $options['topic_id'];
		}

		if ($options['check_visibility'])
		{
			$this->sql_array['WHERE'][] = 't.topic_time <= ' . time();
			$this->sql_array['WHERE'][] = $this->content_visibility->get_global_visibility_sql('topic', $this->ex_fid_ary, 't.');
		}

		$this->sql_array['WHERE'][] = 'f.forum_id = t.forum_id';
		$this->sql_array['WHERE'][] = 't.topic_moved_id = 0';
		$this->sql_array['WHERE'] = join(' AND ', array_filter($this->sql_array['WHERE']));

		if ($options['sort_key'] !== false)
		{
			$this->sql_array['ORDER_BY'] = $options['sort_key'] . ' ' . $options['sort_dir'];
		}

		if (sizeof($sql_array))
		{
			$this->sql_array = $this->primetime->merge_dbal_arrays($this->sql_array, $sql_array);
		}

		return $this->sql_array;
	}

	/**
	 * Get topic data
	 */
	public function get_topic_data($limit = false, $start = 0, $sql_array = array())
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
		$result = $this->db->sql_query_limit($sql, $limit, $start, $this->cache_time);

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
	 * Get post data
	 */
	public function get_post_data($topic_first_or_last = false, $post_ids = array(), $limit = false, $start = 0)
	{
		$sql_where = array();
		if (sizeof($this->topic_data))
		{
			$sql_where[] = $this->db->sql_in_set('topic_id', array_keys($this->topic_data));
		}

		if ($topic_first_or_last)
		{
			$post_ids = array_merge($post_ids, $this->get_topic_post_ids($topic_first_or_last));
		}

		if (sizeof($post_ids))
		{
			$sql_where[] = $this->db->sql_in_set('post_id', $post_ids);
		}

		$sql_where[] = $this->content_visibility->get_global_visibility_sql('post', $this->ex_fid_ary);

		$sql = 'SELECT * FROM ' . POSTS_TABLE . ((sizeof($sql_where)) ? ' WHERE ' . join(' AND ', $sql_where) : '');
		$result = $this->db->sql_query_limit($sql, $limit, $start, $this->cache_time);

		while($row = $this->db->sql_fetchrow($result))
		{
			$parse_flags = ($row['bbcode_bitfield'] ? OPTION_FLAG_BBCODE : 0) | OPTION_FLAG_SMILIES;
			$row['post_text'] = generate_text_for_display($row['post_text'], $row['bbcode_uid'], $row['bbcode_bitfield'], $parse_flags, true);

			$post_data[$row['topic_id']][$row['post_id']] = $row;
			$this->poster_ids[] = $row['poster_id'];
			$this->attachments[$row['post_id']] = $row['post_attachment'];
		}
		$this->db->sql_freeresult($result);

		$this->attachments = array_flip(array_filter($this->attachments));

		return $post_data;
	}

	/**
	 * 
	 */
	public function get_topic_tracking_info($forum_id = 0)
	{
		$tracking_info = array();
		if ($this->config['load_db_lastread'] && $this->user->data['is_registered'])
		{
			foreach ($this->topic_tracking as $fid => $forum)
			{
				$tracking_info[$fid] = get_topic_tracking($fid, $forum['topic_list'], $this->topic_data, array($fid => $forum['mark_time']));
			}
		}
		else if ($this->config['load_anon_lastread'] || $this->user->data['is_registered'])
		{
			foreach ($this->topic_tracking as $fid => $forum)
			{
				$tracking_info[$fid] = get_complete_topic_tracking($fid, $forum['topic_list']);
			}
		}

		return ($forum_id) ? (isset($tracking_info[$forum_id]) ? $tracking_info[$forum_id] : array()) : $tracking_info;
	}

	/**
	 * Get attachments...
	 */
	public function get_attachments($forum_id)
	{
		$attachments = array();
		if ($this->auth->acl_get('u_download') && $this->auth->acl_get('f_download', $forum_id))
		{
			$sql = 'SELECT *
				FROM ' . ATTACHMENTS_TABLE . '
				WHERE ' . $db->sql_in_set('post_msg_id', $this->attachments) . '
					AND in_message = 0
				ORDER BY filetime DESC, post_msg_id ASC';
			$result = $this->db->sql_query($sql);

			while ($row = $this->db->sql_fetchrow($result))
			{
				$attachments[$row['post_msg_id']][] = $row;
			}
			$this->db->sql_freeresult($result);
		}
		$this->attachments = array();

		return $attachments;
	}

	/**
	 * Returns an array of topic first post or last post ids
	 */
	public function get_posters_info()
	{
		$this->poster_ids = array_filter(array_unique($this->poster_ids));

		if (!function_exists('get_user_rank'))
		{
			include($this->phpbb_root_path . 'includes/functions_display.' . $this->php_ext);
		}

		if (!sizeof($this->poster_ids))
		{
			return array();
		}

		$sql = 'SELECT *
			FROM ' . USERS_TABLE . '
			WHERE ' . $this->db->sql_in_set('user_id', $this->poster_ids);
		$result = $this->db->sql_query($sql);

		$user_cache = array();
		while($row = $this->db->sql_fetchrow($result))
		{
			$poster_id = $row['user_id'];

			$user_cache[$poster_id] = array(
				'user_type'					=> $row['user_type'],
				'user_inactive_reason'		=> $row['user_inactive_reason'],

				'joined'		=> $this->user->format_date($row['user_regdate'], 'M d, Y'),
				'posts'			=> $row['user_posts'],
				'warnings'		=> (isset($row['user_warnings'])) ? $row['user_warnings'] : 0,

				'viewonline'	=> $row['user_allow_viewonline'],
				'allow_pm'		=> $row['user_allow_pm'],

				'avatar'		=> ($this->user->optionget('viewavatars')) ? phpbb_get_user_avatar($row) : '',
				'age'			=> '',

				'rank_title'		=> '',
				'rank_image'		=> '',
				'rank_image_src'	=> '',

				'username'			=> $row['username'],
				'user_colour'		=> $row['user_colour'],
				'contact_user' 		=> $this->user->lang('CONTACT_USER', get_username_string('username', $poster_id, $row['username'], $row['user_colour'], $row['username'])),

				'online'			=> false,
				'jabber'			=> ($row['user_jabber'] && $this->auth->acl_get('u_sendim')) ? append_sid("{$this->phpbb_root_path}memberlist.$this->php_ext", "mode=contact&amp;action=jabber&amp;u=$poster_id") : '',
				'search'			=> ($this->auth->acl_get('u_search')) ? append_sid("{$this->phpbb_root_path}search.$this->php_ext", "author_id=$poster_id&amp;sr=posts") : '',

				'author_full'		=> get_username_string('full', $poster_id, $row['username'], $row['user_colour']),
				'author_colour'		=> get_username_string('colour', $poster_id, $row['username'], $row['user_colour']),
				'author_username'	=> get_username_string('username', $poster_id, $row['username'], $row['user_colour']),
				'author_profile'	=> get_username_string('profile', $poster_id, $row['username'], $row['user_colour']),
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
	public function get_topic_post_ids($first_or_last = 'first')
	{
		return (isset($this->topic_post_ids[$first_or_last])) ? $this->topic_post_ids[$first_or_last] : array();
	}
}
