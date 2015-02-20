<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\services;

class members
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var \primetime\core\services\util */
	protected $primetime;

	/** @var \primetime\core\services\template driver_interface */
	protected $ptemplate;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver_interface		$db     			Database connection
	 * @param \phpbb\user							$user				User object
	 * @param \primetime\core\services\util			$primetime			Primetime object
	 * @param \primetime\core\services\template		$ptemplate			Primetime template object
	 * @param string								$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string								$php_ext			php file extension
	 */
	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\user $user, \primetime\core\services\util $primetime, \primetime\core\services\template $ptemplate, $phpbb_root_path, $php_ext)
	{
		$this->db = $db;
		$this->user = $user;
		$this->primetime = $primetime;
		$this->ptemplate = $ptemplate;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;

		if (!function_exists('phpbb_get_user_avatar'))
		{
			include($phpbb_root_path . 'includes/functions_display.' . $php_ext);
		}
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
				$l_info = $this->user->lang['JOIN_DATE'];
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

			default:
				$sql_between = '';
			break;
		}

		if ($get['date_range'] && $sql_between)
		{
			$range_info = $this->primetime->get_date_range($get['date_range']);

			if ($range_info['start'] && $range_info['stop'])
			{
				$append = '&amp;date=' . $range_info['date'];
				$sql_ary['WHERE'] .= " AND $sql_between BETWEEN {$range_info['start']} AND {$range_info['stop']}";
			}
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

			$list = $this->ptemplate->render_view('primetime/core', 'blocks/members.html', 'members_block');
		}

		return $list;
	}

	protected function member_posts($row, $append)
	{
		$u_posts = append_sid($this->phpbb_root_path . 'search.' . $this->php_ext, "author_id={$row['user_id']}&amp;sr=posts" . $append);
		$user_posts = '<a href="' . $u_posts . '">' . $row['user_posts'] . '</a>';

		return array(
			'USERNAME'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
			'USER_AVATAR'	=> phpbb_get_user_avatar($row),
			'USER_INFO'		=> $user_posts
		);
	}

	protected function member_date($row)
	{
		return array(
			'USERNAME'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
			'USER_AVATAR'	=> phpbb_get_user_avatar($row),
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
