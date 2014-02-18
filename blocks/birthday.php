<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\blocks;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * Birthday Block
 */
class birthday extends \primetime\primetime\core\blocks\driver\block
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
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver		$db     	Database connection
	 * @param \phpbb\template\template		$user		User object
	 */
	public function __construct(\phpbb\db\driver\driver $db, \phpbb\user $user)
	{
		$this->db = $db;
		$this->user = $user;
	}

	public function display($bdata, $edit_mode = false)
	{
		$block = '';
		$time = $this->user->create_datetime();
		$now = phpbb_gmgetdate($time->getTimestamp() + $time->getOffset());
	
		// Display birthdays of 29th february on 28th february in non-leap-years
		$leap_year_birthdays = '';
		if ($now['mday'] == 28 && $now['mon'] == 2 && !$time->format('L'))
		{
			$leap_year_birthdays = " OR u.user_birthday LIKE '" . $this->db->sql_escape(sprintf('%2d-%2d-', 29, 2)) . "%'";
		}

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
			$birthday_username	= get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']);
			$birthday_year		= (int) substr($row['user_birthday'], -4);
			$birthday_age		= ($birthday_year) ? max(0, $now['year'] - $birthday_year) : '';

			$this->ptemplate->assign_block_vars('birthday', array(
				'USERNAME'		=> $birthday_username,
				'USER_AGE'		=> $birthday_age,
			));
		}
		$this->db->sql_freeresult($result);

		if (!empty($row) || $edit_mode !== false)
		{
			$block = $this->ptemplate->render_view('primetime/primetime', 'blocks/birthday.html', 'birthday_block');
		}

		return array(
			'title'		=> 'BIRTHDAYS',
			'content'	=> $block,
		);
	}
}
