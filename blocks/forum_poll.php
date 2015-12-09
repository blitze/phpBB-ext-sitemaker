<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

class forum_poll extends \blitze\sitemaker\services\blocks\driver\block
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\forum\data */
	protected $forum;

	/** @var \blitze\sitemaker\services\util */
	protected $sitemaker;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/** @var array */
	private $settings = array();

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth						$auth				Permission object
	 * @param \phpbb\cache\driver\driver_interface	$cache				Cache driver interface
	 * @param \phpbb\config\config					$config				Config object
	 * @param \phpbb\db\driver\driver_interface		$db	 				Database connection
	 * @param \phpbb\request\request_interface		$request			Request object
	 * @param \phpbb\user							$user				User object
	 * @param \blitze\sitemaker\services\forum\data	$forum				Forum Data object
	 * @param \blitze\sitemaker\services\util		$sitemaker			Sitemaker Object
	 * @param string								$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string								$php_ext			php file extension
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\cache\driver\driver_interface $cache, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\request\request_interface $request, \phpbb\user $user, \blitze\sitemaker\services\forum\data $forum, \blitze\sitemaker\services\util $sitemaker, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->cache = $cache;
		$this->config = $config;
		$this->db = $db;
		$this->request = $request;
		$this->user = $user;
		$this->forum = $forum;
		$this->sitemaker = $sitemaker;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_config(array $settings)
	{
		$forum_options = $this->_get_forum_options();
		$group_options = $this->_get_group_options();
		$topic_type_options = array(POST_NORMAL => 'POST_NORMAL', POST_STICKY => 'POST_STICKY', POST_ANNOUNCE => 'POST_ANNOUNCEMENT', POST_GLOBAL => 'POST_GLOBAL');
		$sort_options = array('' => 'RANDOM', FORUMS_ORDER_FIRST_POST	=> 'FIRST_POST_TIME', FORUMS_ORDER_LAST_POST => 'LAST_POST_TIME', FORUMS_ORDER_LAST_READ => 'LAST_READ_TIME');

		return array(
			'legend1'		=> $this->user->lang('SETTINGS'),
			'user_ids'		=> array('lang' => 'POLL_FROM_USERS', 'validate' => 'string', 'type' => 'textarea:3:40', 'maxlength' => 2, 'explain' => true, 'default' => ''),
			'group_ids'		=> array('lang' => 'POLL_FROM_GROUPS', 'validate' => 'string', 'type' => 'multi_select', 'options' => $group_options, 'default' => array(), 'explain' => true),
			'topic_ids'		=> array('lang' => 'POLL_FROM_TOPICS', 'validate' => 'string', 'type' => 'textarea:3:40', 'maxlength' => 2, 'explain' => true, 'default' => ''),
			'forum_ids'		=> array('lang' => 'POLL_FROM_FORUMS', 'validate' => 'string', 'type' => 'multi_select', 'options' => $forum_options, 'default' => array(), 'explain' => true),
			'topic_type'	=> array('lang' => 'TOPIC_TYPE', 'validate' => 'string', 'type' => 'checkbox', 'options' => $topic_type_options, 'default' => array(POST_NORMAL), 'explain' => false),
			'order_by'		=> array('lang' => 'ORDER_BY', 'validate' => 'string', 'type' => 'select', 'options' => $sort_options, 'default' => 0, 'explain' => false),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $bdata, $edit_mode = false)
	{
		$this->user->add_lang('viewtopic');

		$this->settings = $bdata['settings'];

		if (!($topic_data = $this->_get_topic_data()))
		{
			return array(
				'title'		=> '',
				'content'	=> '',
			);
		}

		$forum_id = (int) $topic_data['forum_id'];
		$topic_id = (int) $topic_data['topic_id'];

		$viewtopic_url = append_sid("{$this->phpbb_root_path}viewtopic.{$this->php_ext}", "f=$forum_id&amp;t=$topic_id");
		$cur_voted_id = $this->_get_users_votes($topic_id);
		$s_can_vote = $this->_user_can_vote($forum_id, $topic_data, $cur_voted_id);

		$poll_total = $poll_most = 0;
		$poll_info = $this->_get_poll_info($topic_data, $poll_total, $poll_most);
		$poll_info = $this->_parse_poll($topic_data, $poll_info);
		$poll_end = $topic_data['poll_length'] + $topic_data['poll_start'];

		$this->_build_poll_options($cur_voted_id, $poll_info, $poll_total, $poll_most);

		$this->ptemplate->assign_vars(array(
			'POLL_QUESTION'		=> $topic_data['poll_title'],
			'TOTAL_VOTES' 		=> $poll_total,
			'POLL_LEFT_CAP_IMG'	=> $this->user->img('poll_left'),
			'POLL_RIGHT_CAP_IMG'=> $this->user->img('poll_right'),

			'L_MAX_VOTES'		=> $this->user->lang('MAX_OPTIONS_SELECT', (int) $topic_data['poll_max_options']),
			'L_POLL_LENGTH'		=> $this->_get_poll_length_lang($topic_data['poll_length'], $poll_end),

			'S_CAN_VOTE'		=> $s_can_vote,
			'S_DISPLAY_RESULTS'	=> $this->_show_results($s_can_vote, $cur_voted_id),
			'S_IS_MULTI_CHOICE'	=> $this->_poll_is_multiple_choice($topic_data['poll_max_options']),
			'S_POLL_ACTION'		=> $viewtopic_url,
			'S_FORM_TOKEN'		=> $this->sitemaker->get_form_key('posting'),

			'U_VIEW_RESULTS'	=> $viewtopic_url . '&amp;view=viewpoll',
		));

		return array(
			'title'		=> 'POLL',
			'content'	=> $this->ptemplate->render_view('blitze/sitemaker', 'blocks/forum_poll.html', 'forum_poll_block')
		);
	}

	/**
	 * @return array|null
	 */
	private function _get_topic_data()
	{
		$sql_array = array(
			'WHERE'		=> array(
				't.poll_start <> 0',
			),
		);

		$this->_limit_by_user($sql_array);
		$this->_limit_by_topic($sql_array);
		$this->_limit_by_group($sql_array);

		$this->forum->query()
			->fetch_forum($this->settings['forum_ids'])
			->fetch_topic_type($this->settings['topic_type'])
			->set_sorting($this->_get_sorting())
			->fetch_custom($sql_array)
			->build();
		$topic_data = $this->forum->get_topic_data(1);

		return array_shift($topic_data);
	}

	/**
	 * @param array $topic_data
	 * @param int $poll_total
	 * @param int $poll_most
	 * @return array
	 */
	private function _get_poll_info(array $topic_data, &$poll_total, &$poll_most)
	{
		$topic_id = (int) $topic_data['topic_id'];
		$post_id = (int) $topic_data['topic_first_post_id'];

		$sql = 'SELECT o.*, p.bbcode_bitfield, p.bbcode_uid
			FROM ' . POLL_OPTIONS_TABLE . ' o, ' . POSTS_TABLE . " p
			WHERE o.topic_id = $topic_id
				AND p.post_id = $post_id
				AND p.topic_id = o.topic_id
			ORDER BY o.poll_option_id";
		$result = $this->db->sql_query($sql);

		$poll_info = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$poll_info[] = $row;
			$poll_total += $row['poll_option_total'];
			$poll_most = ($row['poll_option_total'] >= $poll_most) ? $row['poll_option_total'] : $poll_most;
		}
		$this->db->sql_freeresult($result);

		return $poll_info;
	}

	/**
	 * @param array $topic_data
	 * @param array $poll_info
	 * @return array
	 */
	private function _parse_poll(array &$topic_data, array $poll_info)
	{
		$parse_flags = ($poll_info[0]['bbcode_bitfield'] ? OPTION_FLAG_BBCODE : 0) | OPTION_FLAG_SMILIES;

		for ($i = 0, $size = sizeof($poll_info); $i < $size; $i++)
		{
			$poll_info[$i]['poll_option_text'] = generate_text_for_display($poll_info[$i]['poll_option_text'], $poll_info[$i]['bbcode_uid'], $poll_info[$i]['bbcode_bitfield'], $parse_flags, true);
		}

		$topic_data['poll_title'] = generate_text_for_display($topic_data['poll_title'], $poll_info[0]['bbcode_uid'], $poll_info[0]['bbcode_bitfield'], $parse_flags, true);

		return $poll_info;
	}

	/**
	 * @param array $cur_voted_id
	 * @param array $poll_info
	 * @param int $poll_total
	 * @param int $poll_most
	 */
	private function _build_poll_options(array $cur_voted_id, array $poll_info, $poll_total, $poll_most)
	{
		foreach ($poll_info as $poll_option)
		{
			$option_pct = $this->_calculate_option_percent($poll_option['poll_option_total'], $poll_total);
			$option_pct_rel = $this->_calculate_option_percent_rel($poll_option['poll_option_total'], $poll_most);

			$this->ptemplate->assign_block_vars('poll_option', array(
				'POLL_OPTION_ID' 			=> $poll_option['poll_option_id'],
				'POLL_OPTION_CAPTION' 		=> $poll_option['poll_option_text'],
				'POLL_OPTION_RESULT' 		=> $poll_option['poll_option_total'],
				'POLL_OPTION_PERCENT' 		=> sprintf("%.1d%%", round($option_pct * 100)),
				'POLL_OPTION_PERCENT_REL' 	=> sprintf("%.1d%%", round($option_pct_rel * 100)),
				'POLL_OPTION_PCT'			=> round($option_pct * 100),
				'POLL_OPTION_WIDTH'     	=> round($option_pct * 250),
				'POLL_OPTION_VOTED'			=> $this->_user_has_voted_option($poll_option['poll_option_id'], $cur_voted_id),
				'POLL_OPTION_MOST_VOTES'	=> $this->_is_most_voted($poll_option['poll_option_total'], $poll_most),
			));
		}
	}

	/**
	 * @param array $sql_array
	 */
	private function _limit_by_user(array &$sql_array)
	{
		$from_users_ary = array_filter(explode(',', str_replace(' ', '', $this->settings['user_ids'])));
		$sql_array['WHERE'][] = (sizeof($from_users_ary)) ? $this->db->sql_in_set('t.topic_poster', $from_users_ary) : '';
	}

	/**
	 * @param array $sql_array
	 */
	private function _limit_by_topic(array &$sql_array)
	{
		$from_topics_ary = array_filter(explode(',', str_replace(' ', '', $this->settings['topic_ids'])));
		$sql_array['WHERE'][] = (sizeof($from_topics_ary)) ? $this->db->sql_in_set('t.topic_id', $from_topics_ary) : '';
	}

	/**
	 * @param array $sql_array
	 */
	private function _limit_by_group(array &$sql_array)
	{
		if (!empty($this->settings['group_ids']))
		{
			$sql_array['FROM'][USER_GROUP_TABLE] = 'ug';
			$sql_array['WHERE'][] = 't.topic_poster = ug.user_id';
			$sql_array['WHERE'][] = $this->db->sql_in_set('ug.group_id', $this->settings['group_ids']);
		}
	}

	/**
	 * @param int $topic_id
	 * @return array
	 */
	private function _get_users_votes($topic_id)
	{
		$cur_voted_id = array();
		if ($this->user->data['is_registered'])
		{
			$sql = 'SELECT poll_option_id
			FROM ' . POLL_VOTES_TABLE . '
			WHERE topic_id = ' . $topic_id . '
				AND vote_user_id = ' . $this->user->data['user_id'];
			$result = $this->db->sql_query($sql);

			while ($row = $this->db->sql_fetchrow($result))
			{
				$cur_voted_id[] = $row['poll_option_id'];
			}
			$this->db->sql_freeresult($result);
		}
		else
		{
			// Cookie based guest tracking ... I don't like this but hum ho
			// it's oft requested. This relies on "nice" users who don't feel
			// the need to delete cookies to mess with results.
			if ($this->request->is_set($this->config['cookie_name'] . '_poll_' . $topic_id, \phpbb\request\request_interface::COOKIE))
			{
				$cur_voted_id = explode(',', $this->request->variable($this->config['cookie_name'] . '_poll_' . $topic_id, '', true, \phpbb\request\request_interface::COOKIE));
				$cur_voted_id = array_map('intval', $cur_voted_id);
			}
		}

		return $cur_voted_id;
	}

	/**
	 * @param int $poll_option_id
	 * @param array $cur_voted_id
	 * @return bool
	 */
	private function _user_has_voted_option($poll_option_id, array $cur_voted_id)
	{
		return (in_array($poll_option_id, $cur_voted_id)) ? true : false;
	}

	/**
	 * @param int $poll_option_total
	 * @param int $poll_total
	 * @return float|int
	 */
	private function _calculate_option_percent($poll_option_total, $poll_total)
	{
		return ($poll_total > 0) ? $poll_option_total / $poll_total : 0;
	}

	/**
	 * @param int $poll_option_total
	 * @param int $poll_most
	 * @return float|int
	 */
	private function _calculate_option_percent_rel($poll_option_total, $poll_most)
	{
		return ($poll_most > 0) ? $poll_option_total / $poll_most : 0;
	}

	/**
	 * @param int $poll_option_total
	 * @param int $poll_most
	 * @return bool
	 */
	private function _is_most_voted($poll_option_total, $poll_most)
	{
		return ($poll_option_total > 0 && $poll_option_total == $poll_most) ? true : false;
	}

	/**
	 * @param int $poll_max_options
	 * @return bool
	 */
	private function _poll_is_multiple_choice($poll_max_options)
	{
		return ($poll_max_options > 1) ? true : false;
	}

	/**
	 * @param int $poll_length
	 * @param int $poll_end
	 * @return string
	 */
	private function _get_poll_length_lang($poll_length, $poll_end)
	{
		return ($poll_length) ? sprintf($this->user->lang(($poll_end > time()) ? 'POLL_RUN_TILL' : 'POLL_ENDED_AT'), $this->user->format_date($poll_end)) : '';
	}

	/**
	 * @param bool $s_can_vote
	 * @param array $cur_voted_id
	 * @return bool
	 */
	private function _show_results($s_can_vote, array $cur_voted_id)
	{
		return (!$s_can_vote || ($s_can_vote && sizeof($cur_voted_id))) ? true : false;
	}

	/**
	 * @param int $forum_id
	 * @param array $topic_data
	 * @param array $cur_voted_id
	 * @return bool
	 */
	private function _user_can_vote($forum_id, array $topic_data, array $cur_voted_id)
	{
		return ($this->auth->acl_get('f_vote', $forum_id) &&
			(($topic_data['poll_length'] != 0 && $topic_data['poll_start'] + $topic_data['poll_length'] > time()) || $topic_data['poll_length'] == 0) &&
			$topic_data['topic_status'] != ITEM_LOCKED &&
			$topic_data['forum_status'] != ITEM_LOCKED &&
			(!sizeof($cur_voted_id) ||
			($this->auth->acl_get('f_votechg', $forum_id) && $topic_data['poll_vote_change']))) ? true : false;
	}

	/**
	 * @return string
	 */
	private function _get_sorting()
	{
		$sort_order = array(
			FORUMS_ORDER_FIRST_POST		=> 't.topic_time',
			FORUMS_ORDER_LAST_POST		=> 't.topic_last_post_time',
			FORUMS_ORDER_LAST_READ		=> 't.topic_last_view_time'
		);

		return (isset($sort_order[$this->settings['order_by']])) ? $sort_order[$this->settings['order_by']] : 'RAND()';
	}

	/**
	 * @return array
	 */
	private function _get_forum_options()
	{
		if (!function_exists('make_forum_select'))
		{
			include($this->phpbb_root_path . 'includes/functions_admin.' . $this->php_ext);
		}

		$forumlist = make_forum_select(false, false, true, false, false, false, true);

		$forum_options = array('' => 'ALL');
		foreach ($forumlist as $row)
		{
			$forum_options[$row['forum_id']] = $row['padding'] . $row['forum_name'];
		}

		return $forum_options;
	}

	/**
	 * @return array
	 */
	private function _get_group_options()
	{
		$sql = 'SELECT group_id, group_name
			FROM ' . GROUPS_TABLE . '
			WHERE group_type = ' . GROUP_SPECIAL . '
			ORDER BY group_name ASC';
		$result = $this->db->sql_query($sql);

		$group_options = array('' => 'ALL');
		while ($row = $this->db->sql_fetchrow($result))
		{
			$group_options[$row['group_id']] = $this->user->lang('G_' . $row['group_name']);
		}
		$this->db->sql_freeresult($result);

		return $group_options;
	}
}
