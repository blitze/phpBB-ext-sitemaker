<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\blocks;

class forum_poll extends \primetime\primetime\core\blocks\driver\block
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\config\db */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\user */
	protected $user;

	/** @var \primetime\primetime\core\forum\query */
	protected $forum;

	/** @var \primetime\primetime\core\primetime */
	protected $primetime;

	/** @var string */
	protected $phpbb_root_path = null;

	/** @var string */
	protected $php_ext = null;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth						$auth				Permission object
	 * @param \phpbb\cache\service					$cache				Cache object
	 * @param \phpbb\config\db						$config				Config object
	 * @param \phpbb\db\driver\driver_interface		$db	 				Database connection
	 * @param \phpbb\request\request_interface		$request				Request object
	 * @param \phpbb\user							$user				User object
	 * @param \primetime\primetime\core\forum\query	$forum				Forum object
	 * @param \primetime\primetime\core\primetime	$primetime			Primetime Object
	 * @param string								$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string								$php_ext			php file extension
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\cache\service $cache, \phpbb\config\db $config, \phpbb\db\driver\driver_interface $db, \phpbb\request\request_interface $request, \phpbb\user $user, \primetime\primetime\core\forum\query $forum, \primetime\primetime\core\primetime $primetime, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->cache = $cache;
		$this->config = $config;
		$this->db = $db;
		$this->request = $request;
		$this->user = $user;
		$this->forum = $forum;
		$this->primetime = $primetime;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	public function get_config($settings)
	{
		
	}

	public function display($bdata, $edit_mode = false)
	{
		$sql_array = array(
			'WHERE'		=> 't.poll_start <> 0'
		);

		$this->forum->build_query(array(), $sql_array);
		$topic_data = $this->forum->get_topic_data(1);
		$topic_data = array_shift($topic_data);

		$forum_id = (int) $topic_data['forum_id'];
		$topic_id = (int) $topic_data['topic_id'];
		$viewtopic_url = append_sid("{$this->phpbb_root_path}viewtopic.{$this->php_ext}", "f=$forum_id&amp;t=$topic_id");

		$this->user->add_lang('viewtopic');

		$sql = 'SELECT o.*, p.bbcode_bitfield, p.bbcode_uid
			FROM ' . POLL_OPTIONS_TABLE . ' o, ' . POSTS_TABLE . " p
			WHERE o.topic_id = $topic_id
				AND p.post_id = {$topic_data['topic_first_post_id']}
				AND p.topic_id = o.topic_id
			ORDER BY o.poll_option_id";
		$result = $this->db->sql_query($sql);

		$poll_info = $vote_counts = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$poll_info[] = $row;
			$option_id = (int) $row['poll_option_id'];
			$vote_counts[$option_id] = (int) $row['poll_option_total'];
		}
		$this->db->sql_freeresult($result);

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

		// Can not vote at all if no vote permission
		$s_can_vote = ($this->auth->acl_get('f_vote', $forum_id) &&
			(($topic_data['poll_length'] != 0 && $topic_data['poll_start'] + $topic_data['poll_length'] > time()) || $topic_data['poll_length'] == 0) &&
			$topic_data['topic_status'] != ITEM_LOCKED &&
			$topic_data['forum_status'] != ITEM_LOCKED &&
			(!sizeof($cur_voted_id) ||
			($this->auth->acl_get('f_votechg', $forum_id) && $topic_data['poll_vote_change']))) ? true : false;
		$s_display_results = (!$s_can_vote || ($s_can_vote && sizeof($cur_voted_id))) ? true : false;

		$poll_total = 0;
		$poll_most = 0;
		foreach ($poll_info as $poll_option)
		{
			$poll_total += $poll_option['poll_option_total'];
			$poll_most = ($poll_option['poll_option_total'] >= $poll_most) ? $poll_option['poll_option_total'] : $poll_most;
		}

		$parse_flags = ($poll_info[0]['bbcode_bitfield'] ? OPTION_FLAG_BBCODE : 0) | OPTION_FLAG_SMILIES;

		for ($i = 0, $size = sizeof($poll_info); $i < $size; $i++)
		{
			$poll_info[$i]['poll_option_text'] = generate_text_for_display($poll_info[$i]['poll_option_text'], $poll_info[$i]['bbcode_uid'], $poll_option['bbcode_bitfield'], $parse_flags, true);
		}

		$topic_data['poll_title'] = generate_text_for_display($topic_data['poll_title'], $poll_info[0]['bbcode_uid'], $poll_info[0]['bbcode_bitfield'], $parse_flags, true);

		foreach ($poll_info as $poll_option)
		{
			$option_pct = ($poll_total > 0) ? $poll_option['poll_option_total'] / $poll_total : 0;
			$option_pct_txt = sprintf("%.1d%%", round($option_pct * 100));
			$option_pct_rel = ($poll_most > 0) ? $poll_option['poll_option_total'] / $poll_most : 0;
			$option_pct_rel_txt = sprintf("%.1d%%", round($option_pct_rel * 100));
			$option_most_votes = ($poll_option['poll_option_total'] > 0 && $poll_option['poll_option_total'] == $poll_most) ? true : false;

			$this->ptemplate->assign_block_vars('poll_option', array(
				'POLL_OPTION_ID' 			=> $poll_option['poll_option_id'],
				'POLL_OPTION_CAPTION' 		=> $poll_option['poll_option_text'],
				'POLL_OPTION_RESULT' 		=> $poll_option['poll_option_total'],
				'POLL_OPTION_PERCENT' 		=> $option_pct_txt,
				'POLL_OPTION_PERCENT_REL' 	=> $option_pct_rel_txt,
				'POLL_OPTION_PCT'			=> round($option_pct * 100),
				'POLL_OPTION_WIDTH'     	=> round($option_pct * 250),
				'POLL_OPTION_VOTED'			=> (in_array($poll_option['poll_option_id'], $cur_voted_id)) ? true : false,
				'POLL_OPTION_MOST_VOTES'	=> $option_most_votes,
			));
		}

		$poll_end = $topic_data['poll_length'] + $topic_data['poll_start'];

		$this->ptemplate->assign_vars(array(
			'POLL_QUESTION'		=> $topic_data['poll_title'],
			'TOTAL_VOTES' 		=> $poll_total,
			'POLL_LEFT_CAP_IMG'	=> $this->user->img('poll_left'),
			'POLL_RIGHT_CAP_IMG'=> $this->user->img('poll_right'),

			'L_MAX_VOTES'		=> $this->user->lang('MAX_OPTIONS_SELECT', (int) $topic_data['poll_max_options']),
			'L_POLL_LENGTH'		=> ($topic_data['poll_length']) ? sprintf($this->user->lang[($poll_end > time()) ? 'POLL_RUN_TILL' : 'POLL_ENDED_AT'], $this->user->format_date($poll_end)) : '',

			'S_HAS_POLL'		=> true,
			'S_CAN_VOTE'		=> $s_can_vote,
			'S_DISPLAY_RESULTS'	=> $s_display_results,
			'S_IS_MULTI_CHOICE'	=> ($topic_data['poll_max_options'] > 1) ? true : false,
			'S_POLL_ACTION'		=> $viewtopic_url,
			'S_FORM_TOKEN'		=> $this->primetime->get_form_key('posting'),

			'U_VIEW_RESULTS'	=> $viewtopic_url . '&amp;view=viewpoll',
		));
		unset($poll_end, $poll_info, $voted_id);

		return array(
			'title'		=> 'Test Poll', //$this->user->lang[$lang_var],
			'content'	=> $this->ptemplate->render_view('primetime/primetime', 'blocks/forum_poll.html', 'forum_poll_block')
		);
	}
}
