<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

use blitze\sitemaker\services\blocks\driver\block;

/**
 * Birthday Block
 */
class birthday extends block
{
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $time;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\driver\driver_interface	$cache		Cache driver interface
	 * @param \phpbb\db\driver\driver_interface		$db     	Database connection
	 * @param \phpbb\template\template				$template	Template object
	 * @param \phpbb\user                           $user		User object
	 * @param string								$time		String in a format accepted by strtotime().
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\db\driver\driver_interface $db, \phpbb\template\template $template, \phpbb\user $user, $time = 'now')
	{
		$this->cache = $cache;
		$this->db = $db;
		$this->template = $template;
		$this->user = $user;
		$this->time = $time;
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $bdata, $edit_mode = false)
	{
		if (($content = $this->cache->get('pt_block_data_' . $bdata['bid'])) === false)
		{
			$content = '';
			if ($this->find_birthday_users())
			{
				$content = $this->ptemplate->render_view('blitze/sitemaker', 'blocks/birthday.html', 'birthday_block');

				// we only check birthdays every hour, may make this an admin choice
				$this->cache->put('pt_block_data_' . $bdata['bid'], $content, 3600);
			}
		}

		$this->template->assign_var('S_DISPLAY_BIRTHDAY_LIST', false);

		return array(
			'title'		=> 'BIRTHDAYS',
			'content'	=> $content,
		);
	}

	/**
	 * @return bool
	 */
	private function find_birthday_users()
	{
		$time = $this->user->create_datetime($this->time);
		$now = phpbb_gmgetdate($time->getTimestamp() + $time->getOffset());

		$leap_year_birthdays = $this->adjust_leap_year($now, $time);

		$sql = 'SELECT u.user_id, u.username, u.user_colour, u.user_birthday 
				FROM ' . USERS_TABLE . ' u
				LEFT JOIN ' . BANLIST_TABLE . " b ON (u.user_id = b.ban_userid)
				WHERE (b.ban_id IS NULL
					OR b.ban_exclude = 1)
					AND (u.user_birthday " . $this->db->sql_like_expression(sprintf('%2d-%2d-', $now['mday'], $now['mon']) . $this->db->get_any_char()) . " $leap_year_birthdays)
					AND u.user_type IN (" . USER_NORMAL . ', ' . USER_FOUNDER . ')
				ORDER BY u.username ASC';
		$result = $this->db->sql_query($sql);

		$show_birthday = false;
		while ($row = $this->db->sql_fetchrow($result))
		{
			$show_birthday = true;
			$this->ptemplate->assign_block_vars('birthday', array(
				'USERNAME'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
				'USER_AGE'		=> $this->get_user_age($row['user_birthday'], $now['year']),
			));
		}
		$this->db->sql_freeresult($result);

		return $show_birthday;
	}

	/**
	 * Display birthdays of 29th february on 28th february in non-leap-years
	 *
	 * @param array $now
	 * @param \DateTime $time
	 * @return string
	 */
	private function adjust_leap_year(array $now, \DateTime $time)
	{
		$leap_year_birthdays = '';
		if ($now['mday'] == 28 && $now['mon'] == 2 && !$time->format('L'))
		{
			$leap_year_birthdays = ' OR u.user_birthday ' . $this->db->sql_like_expression(sprintf('%2d-%2d-', 29, 2) . $this->db->get_any_char());
		}

		return $leap_year_birthdays;
	}

	/**
	 * @param string $user_birthday
	 * @param int $year
	 * @return string
	 */
	private function get_user_age($user_birthday, $year)
	{
		$birthday_year = (int) substr($user_birthday, -4);
		return ($birthday_year) ? max(0, $year - $birthday_year) : '';
	}
}
