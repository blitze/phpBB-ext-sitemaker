<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\blocks;

/**
 * Whois Block
 */
class whois extends \primetime\core\services\blocks\driver\block
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\context */
	protected $context;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth			$auth				Permission object
	 * @param \phpbb\config\config		$config				phpBB configuration
	 * @param \phpbb\template\context	$context    		Template context
	 * @param \phpbb\user				$user				User object
	 * @param string					$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string					$php_ext			php file extension
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\template\context $context, \phpbb\user $user, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->context = $context;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	public function display($settings, $edit_mode = false)
	{
		$data = $this->context->get_data_ref();

		if (!empty($data['.'][0]['TOTAL_USERS_ONLINE']))
		{
			$l_online_users	= $data['.'][0]['TOTAL_USERS_ONLINE'];
			$online_userlist = $data['.'][0]['LOGGED_IN_USER_LIST'];
			$l_online_record = $data['.'][0]['RECORD_USERS'];
		}
		else
		{
			$item_id = 0;
			$item = 'forum';

			$online_users = obtain_users_online($item_id, $item);
			$user_online_strings = obtain_users_online_string($online_users, $item_id, $item);

			$l_online_users = $user_online_strings['l_online_users'];
			$online_userlist = $user_online_strings['online_userlist'];
			$total_online_users = $online_users['total_online'];

			$l_online_record = $this->user->lang('RECORD_ONLINE_USERS', (int) $this->config['record_online_users'], $this->user->format_date($this->config['record_online_date'], false, true));
		}

		$this->ptemplate->assign_vars(array(
			'TOTAL_USERS_ONLINE'	=> $l_online_users,
			'LOGGED_IN_USER_LIST'	=> $online_userlist,
			'RECORD_USERS'			=> $l_online_record,
			'U_VIEWONLINE'			=> ($this->auth->acl_gets('u_viewprofile', 'a_user', 'a_useradd', 'a_userdel')) ? append_sid("{$this->phpbb_root_path}viewonline." . $this->php_ext) : '',
		));
		unset($data);

		return array(
			'title'		=> 'WHO_IS_ONLINE',
			'content'	=> $this->ptemplate->render_view('primetime/core', 'blocks/whois.html', 'whois_block')
		);
	}
}
