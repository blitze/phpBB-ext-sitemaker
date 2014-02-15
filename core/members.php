<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core;

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
class members
{
	/**
	 * Database
	 * @var \phpbb\db\driver\driver
	 */
	protected $db;

	/**
	 * User object
	 * @var \phpbb\user
	 */
	protected $user;

	/**
	 * Template object for primetime blocks
	 * @var \primetime\primetime\core\template
	 */
	protected $ptemplate;

	/** @var string */
	protected $phpbb_root_path = null;

	/** @var string */
	protected $php_ext = null;

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver				$db     			Database connection
	 * @param \phpbb\template\template				$user				User object
	 * @param \primetime\primetime\core\template	$ptemplate			Primetime template object
	 * @param string								$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string								$php_ext			php file extension
	 */
	public function __construct(\phpbb\db\driver\driver $db, \phpbb\user $user, \primetime\primetime\core\template $ptemplate, $phpbb_root_path, $php_ext)
	{
		$this->db = $db;
		$this->user = $user;
		$this->ptemplate = $ptemplate;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * get members
	 */
	public function get_list($get = array())
	{
		$get += array(
			'query_type'	=> 'recent',
			'date_range'	=> 'month',
			'max_members'	=> 5,
		);

		$method = 'member_date';
		$append = $list = '';
		$l_user = $this->user->lang['USERNAME'];
		$l_info = $this->user->lang['MEMBERS_DATE'];
	
		$sql_ary = array(
			'SELECT'		=> 'u.user_id, u.username, u.user_colour, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height',
			'FROM'			=> array(
					USERS_TABLE => 'u'
			),
			'WHERE'			=> $this->db->sql_in_set('u.user_type', array(USER_NORMAL, USER_FOUNDER)),
		);

		switch ($get['query_type'])
		{
			case 'visits':
			// no break
			case 'bots':
				$sql_between = 'user_lastvisit';
				$sql_ary['SELECT'] .= ', u.user_lastvisit as member_date';
				$sql_ary['ORDER_BY'] = 'u.user_lastvisit DESC';
				
				if ($get['query_type'] == 'bots')
				{
					$l_user = $l_info = '';
					$method = 'member_bots';
					$sql_ary['WHERE'] = 'u.user_type = ' . USER_IGNORE;
				}
				$sql_ary['WHERE'] .= ' AND u.user_lastvisit <> 0';
			break;

			case 'recent':
			// no break;
			case 'tenured':
				$get['date_range'] = '';
				$sql_between = 'u.user_regdate';
				$sql_ary['SELECT'] .= ', u.user_regdate as member_date';
				$sql_ary['ORDER_BY'] = 'u.user_regdate ' . (($get['query_type'] == 'tenured') ? 'ASC' : 'DESC');
			break;

			case 'posts':
				$method = 'member_posts';
				$sql_between = 'p.post_time';
				$l_info = $this->user->lang['POSTS'];

				$sql_ary['SELECT'] .= ', COUNT(p.post_id) as user_posts';
				$sql_ary['FROM'] += array(TOPICS_TABLE => 't');
				$sql_ary['FROM'] += array(POSTS_TABLE => 'p');
				$sql_ary['WHERE'] .= ' AND ' . time() . ' > t.topic_time AND t.topic_id = p.topic_id AND p.post_visibility = ' . ITEM_APPROVED . ' AND p.poster_id = u.user_id';
				$sql_ary['GROUP_BY'] = 'p.poster_id';
				$sql_ary['ORDER_BY'] = 'user_posts DESC';
			break;
		}

		if ($get['date_range'])
		{
			$time = $this->user->create_datetime();
			$now = phpbb_gmgetdate($time->getTimestamp() + $time->getOffset());

			switch($get['date_range'])
			{
				case 'today':
					$start = $this->user->create_datetime()
						->setDate($now['year'], $now['mon'], $now['mday'])
						->setTime(0, 0, 0)
						->getTimestamp();
					$stop = $start + 86399;
					$date = $this->user->format_date($start, 'Y-m-d', true);
				break;

				case 'week':
					$info = getdate($now[0] - (86400 * $now['wday']));
					$start = $this->user->create_datetime()
						->setDate($info['year'], $info['mon'], $info['mday'])
						->setTime(0, 0, 0)
						->getTimestamp();
					$stop = $start + 604799;
					$date = $this->user->format_date($start, 'Y-m-d', true) . '&amp;dsp=week';
				break;

				case 'month':
					$start = $this->user->create_datetime()
						->setDate($now['year'], $now['mon'], 1)
						->setTime(0, 0, 0)
						->getTimestamp();
					$num_days = gmdate('t', $start);
					$stop = $start + (86400 * $num_days) - 1;
					$date = $this->user->format_date($start, 'Y-m', true);
				break;	

				case 'year':
					$start = $this->user->create_datetime()
						->setDate($now['year'], 1, 1)
						->setTime(0, 0, 0)
						->getTimestamp();
					$leap_year = gmdate('L', $start);
					$num_days = ($leap_year) ? 366 : 365;
					$stop = $start + (86400 * $num_days) - 1;
					$date = $this->user->format_date($start, 'Y', true);
				break;
			}

			$append = '&amp;date=' . $date;
			$sql_ary['WHERE'] .= " AND $sql_between BETWEEN $start AND $stop";
		}

		$sql = $this->db->sql_build_query('SELECT', $sql_ary);
		$result = $this->db->sql_query_limit($sql, $get['max_members']);

		$members = false;
		while ($row = $this->db->sql_fetchrow($result))
		{
			$members = true;
			$this->ptemplate->assign_block_vars('member', $this->$method($row, $append));
		}
		$this->db->sql_freeresult($result);

		if ($members !== false)
		{
			$this->ptemplate->assign_var('S_LIST', $get['query_type']);

			$this->ptemplate->assign_vars(array(
				'L_USER'	=> $l_user,
				'L_INFO'	=> $l_info)
			);

			$list = $this->ptemplate->render_view('primetime/primetime', 'blocks/members.html', 'members_block');
		}

		return $list;
	}

	protected function member_posts($row, $append)
	{
		$u_posts = append_sid($this->phpbb_root_path . 'search.' . $this->php_ext, "author_id={$row['user_id']}&amp;sr=posts" . $append);
		$user_posts = '<a href="' . $u_posts . '">' . $row['user_posts'] . '</a>';
	
		return array(
			'USERNAME'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
			'USER_AVATAR'	=> get_user_avatar($row['user_avatar'], $row['user_avatar_type'], $row['user_avatar_width'], $row['user_avatar_height'], ''),
			'USER_INFO'		=> $user_posts
		);
	}

	protected function member_date($row)
	{
		return array(
			'USERNAME'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
			'USER_AVATAR'	=> get_user_avatar($row['user_avatar'], $row['user_avatar_type'], $row['user_avatar_width'], $row['user_avatar_height'], ''),
			'USER_INFO'		=> $this->user->format_date($row['member_date'], $this->user->lang['DATE_FORMAT'], true)
		);
	}
	
	protected function member_bots($row)
	{
		return array(
			'USERNAME'	=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour']),
			'USER_INFO'	=> $this->user->format_date($row['member_date'])
		);
	}
}
