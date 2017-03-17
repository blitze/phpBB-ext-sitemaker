<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services;

class poll
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\util */
	protected $sitemaker;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth						$auth				Permission object
	 * @param \phpbb\config\config					$config				Config object
	 * @param \phpbb\db\driver\driver_interface		$db	 				Database connection
	 * @param \phpbb\request\request_interface		$request			Request object
	 * @param \phpbb\language\language				$translator			Language object
	 * @param \phpbb\user							$user				User object
	 * @param \blitze\sitemaker\services\util		$sitemaker			Sitemaker Object
	 * @param string								$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string								$php_ext			php file extension
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\request\request_interface $request, \phpbb\language\language $translator, \phpbb\user $user, \blitze\sitemaker\services\util $sitemaker, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->db = $db;
		$this->request = $request;
		$this->translator = $translator;
		$this->user = $user;
		$this->sitemaker = $sitemaker;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * @param array $topic_data
	 * @param \phpbb\template\twig\twig $template
	 */
	public function build(array $topic_data, \phpbb\template\twig\twig &$template)
	{
		$this->translator->add_lang('viewtopic');

		$forum_id = (int) $topic_data['forum_id'];
		$topic_id = (int) $topic_data['topic_id'];

		$cur_voted_id = $this->get_users_votes($topic_id);
		$s_can_vote = $this->user_can_vote($forum_id, $topic_data, $cur_voted_id);
		$viewtopic_url = append_sid("{$this->phpbb_root_path}viewtopic.{$this->php_ext}", "f=$forum_id&amp;t=$topic_id");

		$poll_total = $poll_most = 0;
		$poll_info = $this->get_poll_info($topic_data, $poll_total, $poll_most);
		$poll_end = $topic_data['poll_length'] + $topic_data['poll_start'];

		$this->build_poll_options($cur_voted_id, $poll_info, $poll_total, $poll_most, $template);

		$template->assign_vars(array(
			'POLL_QUESTION'		=> $topic_data['poll_title'],
			'TOTAL_VOTES' 		=> $poll_total,
			'POLL_LEFT_CAP_IMG'	=> $this->user->img('poll_left'),
			'POLL_RIGHT_CAP_IMG'=> $this->user->img('poll_right'),

			'MAX_VOTES'			=> $this->translator->lang('MAX_OPTIONS_SELECT', (int) $topic_data['poll_max_options']),
			'POLL_LENGTH'		=> $this->get_poll_length_lang($topic_data['poll_length'], $poll_end),

			'S_CAN_VOTE'		=> $s_can_vote,
			'S_DISPLAY_RESULTS'	=> $this->show_results($s_can_vote, $cur_voted_id),
			'S_IS_MULTI_CHOICE'	=> $this->poll_is_multiple_choice($topic_data['poll_max_options']),
			'S_POLL_ACTION'		=> $viewtopic_url,
			'S_FORM_TOKEN'		=> $this->sitemaker->get_form_key('posting'),

			'U_VIEW_RESULTS'	=> $viewtopic_url . '&amp;view=viewpoll',
		));
	}

	/**
	 * @param int $forum_id
	 * @param array $topic_data
	 * @param array $cur_voted_id
	 * @return bool
	 */
	private function user_can_vote($forum_id, array $topic_data, array $cur_voted_id)
	{
		return (
			$this->user_is_authorized($forum_id, $topic_data, $cur_voted_id) &&
			$this->poll_is_still_open($topic_data) &&
			$this->is_topic_status_eligible($topic_data)
		);
	}

	/**
	 * @param int $forum_id
	 * @param array $topic_data
	 * @param array $cur_voted_id
	 * @return bool
	 */
	private function user_is_authorized($forum_id, array $topic_data, array $cur_voted_id)
	{
		return ($this->auth->acl_get('f_vote', $forum_id) && $this->user_can_change_vote($forum_id, $topic_data, $cur_voted_id));
	}

	/**
	 * @param int $forum_id
	 * @param array $topic_data
	 * @param array $cur_voted_id
	 * @return bool
	 */
	private function user_can_change_vote($forum_id, array $topic_data, array $cur_voted_id)
	{
		return (!sizeof($cur_voted_id) || ($this->auth->acl_get('f_votechg', $forum_id) && $topic_data['poll_vote_change']));
	}

	/**
	 * @param array $topic_data
	 * @return bool
	 */
	private function poll_is_still_open(array $topic_data)
	{
		return (($topic_data['poll_length'] != 0 && $topic_data['poll_start'] + $topic_data['poll_length'] > time()) || $topic_data['poll_length'] == 0);
	}

	/**
	 * @param array $topic_data
	 * @return bool
	 */
	private function is_topic_status_eligible(array $topic_data)
	{
		return ($topic_data['topic_status'] != ITEM_LOCKED && $topic_data['forum_status'] != ITEM_LOCKED);
	}

	/**
	 * @param array $topic_data
	 * @param int $poll_total
	 * @param int $poll_most
	 * @return array
	 */
	private function get_poll_info(array $topic_data, &$poll_total, &$poll_most)
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

		return $this->parse_poll($topic_data, $poll_info);
	}

	/**
	 * @param array $topic_data
	 * @param array $poll_info
	 * @return array
	 */
	private function parse_poll(array &$topic_data, array $poll_info)
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
	 * @param \phpbb\template\twig\twig $template
	 */
	private function build_poll_options(array $cur_voted_id, array $poll_info, $poll_total, $poll_most, \phpbb\template\twig\twig &$template)
	{
		foreach ($poll_info as $poll_option)
		{
			$option_pct = $this->calculate_option_percent($poll_option['poll_option_total'], $poll_total);
			$option_pct_rel = $this->calculate_option_percent_rel($poll_option['poll_option_total'], $poll_most);

			$template->assign_block_vars('poll_option', array(
				'POLL_OPTION_ID' 			=> $poll_option['poll_option_id'],
				'POLL_OPTION_CAPTION' 		=> $poll_option['poll_option_text'],
				'POLL_OPTION_RESULT' 		=> $poll_option['poll_option_total'],
				'POLL_OPTION_PERCENT' 		=> sprintf("%.1d%%", round($option_pct * 100)),
				'POLL_OPTION_PERCENT_REL' 	=> sprintf("%.1d%%", round($option_pct_rel * 100)),
				'POLL_OPTION_PCT'			=> round($option_pct * 100),
				'POLL_OPTION_WIDTH'     	=> round($option_pct * 250),
				'POLL_OPTION_VOTED'			=> $this->user_has_voted_option($poll_option['poll_option_id'], $cur_voted_id),
				'POLL_OPTION_MOST_VOTES'	=> $this->is_most_voted($poll_option['poll_option_total'], $poll_most),
			));
		}
	}

	/**
	 * @param int $topic_id
	 * @return array
	 */
	private function get_users_votes($topic_id)
	{
		$cur_voted_id = array();
		if ($this->user->data['is_registered'])
		{
			$sql = 'SELECT poll_option_id
			FROM ' . POLL_VOTES_TABLE . '
			WHERE topic_id = ' . (int) $topic_id . '
				AND vote_user_id = ' . (int) $this->user->data['user_id'];
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
	private function user_has_voted_option($poll_option_id, array $cur_voted_id)
	{
		return (in_array($poll_option_id, $cur_voted_id)) ? true : false;
	}

	/**
	 * @param int $poll_option_total
	 * @param int $poll_total
	 * @return float|int
	 */
	private function calculate_option_percent($poll_option_total, $poll_total)
	{
		return ($poll_total > 0) ? $poll_option_total / $poll_total : 0;
	}

	/**
	 * @param int $poll_option_total
	 * @param int $poll_most
	 * @return float|int
	 */
	private function calculate_option_percent_rel($poll_option_total, $poll_most)
	{
		return ($poll_most > 0) ? $poll_option_total / $poll_most : 0;
	}

	/**
	 * @param int $poll_option_total
	 * @param int $poll_most
	 * @return bool
	 */
	private function is_most_voted($poll_option_total, $poll_most)
	{
		return ($poll_option_total > 0 && $poll_option_total == $poll_most) ? true : false;
	}

	/**
	 * @param int $poll_max_options
	 * @return bool
	 */
	private function poll_is_multiple_choice($poll_max_options)
	{
		return ($poll_max_options > 1) ? true : false;
	}

	/**
	 * @param int $poll_length
	 * @param int $poll_end
	 * @return string
	 */
	private function get_poll_length_lang($poll_length, $poll_end)
	{
		return ($poll_length) ? $this->translator->lang(($poll_end > time()) ? 'POLL_RUN_TILL' : 'POLL_ENDED_AT', $this->user->format_date($poll_end)) : '';
	}

	/**
	 * @param bool $s_can_vote
	 * @param array $cur_voted_id
	 * @return bool
	 */
	private function show_results($s_can_vote, array $cur_voted_id)
	{
		return (!$s_can_vote || ($s_can_vote && sizeof($cur_voted_id))) ? true : false;
	}
}
