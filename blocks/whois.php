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
* Whois Block
*/
class whois extends \primetime\primetime\core\blocks\driver\block
{
	/**
	* phpBB configuration
	* @var \phpbb\config\config
	*/
	protected $config;

	/**
	* User object
	* @var \phpbb\user
	*/
	protected $user;

	/**
	* Constructor
	*
	* @param \phpbb\config\config	$config		phpBB configuration
	* @param \phpbb\user			$user       User object
	*/
	public function __construct(\phpbb\config\config $config, \phpbb\user $user)
	{
		$this->config = $config;
		$this->user = $user;
	}

	public function display($settings, $edit_mode = false)
	{
		$item = 'forum';
		$item_id = 0;

		$online_users = obtain_users_online($item_id, $item);
		$user_online_strings = obtain_users_online_string($online_users, $item_id, $item);

		$l_online_users = $user_online_strings['l_online_users'];
		$online_userlist = $user_online_strings['online_userlist'];
		$total_online_users = $online_users['total_online'];

		if ($total_online_users > $this->config['record_online_users'])
		{
			set_config('record_online_users', $total_online_users, true);
			set_config('record_online_date', time(), true);
		}

		$l_online_record = $this->user->lang('RECORD_ONLINE_USERS', (int) $this->config['record_online_users'], $this->user->format_date($this->config['record_online_date'], false, true));

		$this->btemplate->assign_vars(array(
			'TOTAL_USERS_ONLINE'	=> $l_online_users,
			'LOGGED_IN_USER_LIST'	=> $online_userlist,
			'RECORD_USERS'			=> $l_online_record,
		));

		return array(
			'title'		=> $this->user->lang['WHO_IS_ONLINE'],
			'content'	=> $this->render_block('primetime/primetime', 'blocks/whois.html', 'whois_block')
		);
	}
}
