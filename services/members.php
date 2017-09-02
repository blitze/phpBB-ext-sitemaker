<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services;

class members
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\date_range */
	protected $date_range;

	/** @var \blitze\sitemaker\services\template driver_interface */
	protected $ptemplate;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	protected $explain_range = '';
	protected $sql_date_field = '';
	protected $view_mode = 'member_date';
	protected $user_header = 'USERNAME';
	protected $info_header = 'MEMBERS_DATE';
	protected $settings = array();

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver_interface		$db     			Database connection
	 * @param \phpbb\language\language				$translator			Language Object
	 * @param \phpbb\user							$user				User object
	 * @param \blitze\sitemaker\services\date_range	$date_range			Date range object
	 * @param \blitze\sitemaker\services\template	$ptemplate			Sitemaker template object
	 * @param string								$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string								$php_ext			php file extension
	 */
	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\language\language $translator, \phpbb\user $user, \blitze\sitemaker\services\date_range $date_range, \blitze\sitemaker\services\template $ptemplate, $phpbb_root_path, $php_ext)
	{
		$this->db = $db;
		$this->translator = $translator;
		$this->user = $user;
		$this->date_range = $date_range;
		$this->ptemplate = $ptemplate;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;

		// @codeCoverageIgnoreStart
		if (!function_exists('phpbb_get_user_avatar'))
		{
			include($phpbb_root_path . 'includes/functions_display.' . $php_ext);
		}
		// @codeCoverageIgnoreEnd
	}

	/**
	 * get members
	 * @param array $get
	 * @return string
	 */
	public function get_list(array $get = array())
	{
		$this->settings = $get + array(
			'query_type'	=> 'recent',
			'date_range'	=> '',
			'max_members'	=> 5,
		);

		$sql = $this->get_sql_statement();
		$result = $this->db->sql_query_limit($sql, $this->settings['max_members']);

		$has_results = false;
		while ($row = $this->db->sql_fetchrow($result))
		{
			$has_results = true;
			$this->ptemplate->assign_block_vars('member', call_user_func_array(array($this, $this->view_mode), array($row)));
		}
		$this->db->sql_freeresult($result);

		return $this->show_results($has_results);
	}

	/**
	 * @param array $row
	 * @return array
	 */
	protected function member_posts(array $row)
	{
		$u_posts = append_sid($this->phpbb_root_path . 'search.' . $this->php_ext, "author_id={$row['user_id']}&amp;sr=posts" . $this->explain_range);
		$user_posts = '<a href="' . $u_posts . '">' . $row['user_posts'] . '</a>';

		return array(
			'USERNAME'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
			'USER_AVATAR'	=> phpbb_get_user_avatar($row),
			'USER_INFO'		=> $user_posts
		);
	}

	/**
	 * @param array $row
	 * @return array
	 */
	protected function member_date(array $row)
	{
		return array(
			'USERNAME'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
			'USER_AVATAR'	=> phpbb_get_user_avatar($row),
			'USER_INFO'		=> $this->user->format_date($row['member_date'], $this->translator->lang('DATE_FORMAT'), true)
		);
	}

	/**
	 * @param array $row
	 * @return array
	 */
	protected function member_bots(array $row)
	{
		return array(
			'USERNAME'	=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour']),
			'USER_INFO'	=> $this->user->format_date($row['member_date'])
		);
	}

	/**
	 * @param bool $has_results
	 * @return string
	 */
	protected function show_results($has_results)
	{
		$html = '';
		if ($has_results)
		{
			$this->ptemplate->assign_vars(array(
				'S_LIST'		=> $this->settings['query_type'],
				'USER_TITLE'	=> $this->translator->lang($this->user_header),
				'INFO_TITLE'	=> $this->translator->lang($this->info_header),
			));

			$html = $this->ptemplate->render_view('blitze/sitemaker', 'blocks/members.html', 'members_block');
		}

		return $html;
	}

	/**
	 * @return string
	 */
	protected function get_sql_statement()
	{
		$sql_ary = array(
			'SELECT'		=> 'u.user_id, u.username, u.user_colour, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height',
			'FROM'			=> array(
					USERS_TABLE => 'u'
			),
			'WHERE'			=> $this->db->sql_in_set('u.user_type', array(USER_NORMAL, USER_FOUNDER)),
		);

		$sql_method = 'set_' . $this->settings['query_type'] . '_sql';
		call_user_func_array(array($this, $sql_method), array(&$sql_ary));

		$this->set_range_sql($sql_ary);

		return $this->db->sql_build_query('SELECT', $sql_ary);
	}

	/**
	 * @param array $sql_ary
	 */
	protected function set_visits_sql(array &$sql_ary)
	{
		$sql_ary['SELECT'] .= ', u.user_lastvisit as member_date';
		$sql_ary['WHERE'] .= ' AND u.user_lastvisit <> 0 AND u.user_id <> ' . (int) $this->user->data['user_id'];
		$sql_ary['ORDER_BY'] = 'u.user_lastvisit DESC';

		$this->sql_date_field = 'user_lastvisit';
	}

	/**
	 * @param array $sql_ary
	 */
	protected function set_bots_sql(array &$sql_ary)
	{
		$this->set_visits_sql($sql_ary);
		$this->user_header = '';
		$this->info_header = '';
		$this->view_mode = 'member_bots';

		$sql_ary['WHERE'] = 'u.user_type = ' . USER_IGNORE;
	}

	/**
	 * @param array $sql_ary
	 */
	protected function set_tenured_sql(array &$sql_ary)
	{
		$sql_ary['SELECT'] .= ', u.user_regdate as member_date';
		$sql_ary['ORDER_BY'] = 'u.user_regdate ' . (($this->settings['query_type'] == 'tenured') ? 'ASC' : 'DESC');

		$this->sql_date_field = 'u.user_regdate';
		$this->settings['date_range'] = '';
	}

	/**
	 * @param array $sql_ary
	 */
	protected function set_recent_sql(array &$sql_ary)
	{
		$this->set_tenured_sql($sql_ary);
		$this->info_header = 'JOIN_DATE';
	}

	/**
	 * @param array $sql_ary
	 */
	protected function set_posts_sql(array &$sql_ary)
	{
		$sql_ary['SELECT'] .= ', COUNT(p.post_id) as user_posts';
		$sql_ary['FROM'] += array(TOPICS_TABLE => 't');
		$sql_ary['FROM'] += array(POSTS_TABLE => 'p');
		$sql_ary['WHERE'] .= ' AND ' . time() . ' > t.topic_time AND t.topic_id = p.topic_id AND p.post_visibility = ' . ITEM_APPROVED . ' AND p.poster_id = u.user_id';
		$sql_ary['GROUP_BY'] = 'u.user_id';
		$sql_ary['ORDER_BY'] = 'user_posts DESC, u.username ASC';

		$this->info_header = 'POSTS';
		$this->view_mode = 'member_posts';
		$this->sql_date_field = 'p.post_time';
	}

	/**
	 * @param array $sql_ary
	 */
	protected function set_range_sql(array &$sql_ary)
	{
		if ($this->settings['date_range'] && $this->sql_date_field)
		{
			$range = $this->date_range->get($this->settings['date_range']);
			$this->explain_range = '&amp;date=' . $range['date'];

			$sql_ary['WHERE'] .= " AND {$this->sql_date_field} BETWEEN {$range['start']} AND {$range['stop']}";
		}
	}
}
