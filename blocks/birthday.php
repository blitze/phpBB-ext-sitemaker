<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

/**
 * Birthday Block
 */
class birthday extends \blitze\sitemaker\services\blocks\driver\block
{
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\driver\driver_interface	$cache		Cache driver interface
	 * @param \phpbb\db\driver\driver_interface		$db     	Database connection
	 * @param \phpbb\template\template				$user		User object
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\db\driver\driver_interface $db, \phpbb\user $user)
	{
		$this->cache = $cache;
		$this->db = $db;
		$this->user = $user;
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $bdata, $edit_mode = false)
	{
		if (($content = $this->cache->get('pt_block_data_' . $bdata['bid'])) === false)
		{
			$content = '';
			if ($this->_find_birthday_users())
			{
				$content = $this->ptemplate->render_view('blitze/sitemaker', 'blocks/birthday.html', 'birthday_block');

				// we only check birthdays every hour, may make this an admin choice
				$this->cache->put('pt_block_data_' . $bdata['bid'], $content, 3600);
			}
		}

		return array(
			'title'		=> 'BIRTHDAYS',
			'content'	=> $content,
		);
	}

	/**
	 * @return bool
	 */
	private function _find_birthday_users()
	{
		$time = $this->user->create_datetime();
		$now = phpbb_gmgetdate($time->getTimestamp() + $time->getOffset());

		$leap_year_birthdays = $this->_adjust_leap_year($now, $time);

		$sql = 'SELECT u.user_id, u.username, u.user_colour, u.user_birthday 
				FROM ' . USERS_TABLE . ' u
				LEFT JOIN ' . BANLIST_TABLE . " b ON (u.user_id = b.ban_userid)
				WHERE (b.ban_id IS NULL
					OR b.ban_exclude = 1)
					AND (u.user_birthday LIKE '" . $this->db->sql_escape(sprintf('%2d-%2d-', $now['mday'], $now['mon'])) . "%' $leap_year_birthdays)
					AND u.user_type IN (" . USER_NORMAL . ', ' . USER_FOUNDER . ')';
		$result = $this->db->sql_query($sql);

		while ($row = $this->db->sql_fetchrow($result))
		{
			$this->ptemplate->assign_block_vars('birthday', array(
				'USERNAME'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
				'USER_AGE'		=> $this->_get_user_age($row['user_birthday'], $now['year']),
			));
		}
		$this->db->sql_freeresult($result);

		return (bool) $row;
	}

	/**
	 * Display birthdays of 29th february on 28th february in non-leap-years
	 *
	 * @param array $now
	 * @param \phpbb\datetime $time
	 * @return string
	 */
	private function _adjust_leap_year(array $now, \phpbb\datetime $time)
	{
		$leap_year_birthdays = '';
		if ($now['mday'] == 28 && $now['mon'] == 2 && !$time->format('L'))
		{
			$leap_year_birthdays = " OR u.user_birthday LIKE '" . $this->db->sql_escape(sprintf('%2d-%2d-', 29, 2)) . "%'";
		}

		return $leap_year_birthdays;
	}

	/**
	 * @param string $user_birthday
	 * @param int $year
	 * @return string
	 */
	private function _get_user_age($user_birthday, $year)
	{
		$birthday_year = (int) substr($user_birthday, -4);
		return ($birthday_year) ? max(0, $year - $birthday_year) : '';
	}
}
