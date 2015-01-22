<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\base\blocks;

/**
 * Featured Member Block
 */
class member_menu extends \primetime\base\services\blocks\driver\block
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $phpbb_root_path = null;

	/** @var string */
	protected $php_ext = null;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth					$auth				Permission object
	 * @param \phpbb\db\driver\driver_interface	$db					Database connection
	 * @param \phpbb\user						$user				User object
	 * @param string							$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string							$php_ext			php file extension
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\db\driver\driver_interface $db, \phpbb\user $user, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->db = $db;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;

		if (!function_exists('get_user_rank'))
		{
			include($this->phpbb_root_path . 'includes/functions_display.' . $this->php_ext);
		}
	}

	public function display($bdata, $edit_mode = false)
	{
		if ($this->user->data['is_registered'])
		{
			$this->ptemplate->assign_vars(array(
				'USER_AVATAR'	=> phpbb_get_user_avatar($this->user->data),
				'USERNAME'		=> get_username_string('no_profile', $this->user->data['user_id'], $this->user->data['username'], $this->user->data['user_colour']),
				'USERNAME_FULL' => get_username_string('full', $this->user->data['user_id'], $this->user->data['username'], $this->user->data['user_colour']),

				'U_PROFILE'		=> append_sid($this->phpbb_root_path . 'memberlist.' . $this->php_ext, 'mode=viewprofile&amp;u=' . $this->user->data['user_id']),
				'U_SEARCH_NEW'	=> append_sid($this->phpbb_root_path . 'search.' . $this->php_ext, 'search_id=newposts'),
				'U_SEARCH_SELF'	=> append_sid($this->phpbb_root_path . 'search.' . $this->php_ext, 'search_id=egosearch'),
				'U_PRIVATE_MSG'	=> append_sid($this->phpbb_root_path . 'ucp.' . $this->php_ext, 'i=pm&amp;folder=inbox'),
				'U_LOGOUT'		=> append_sid($this->phpbb_root_path . 'ucp.' . $this->php_ext, 'mode=logout', true, $this->user->session_id),
				'U_MCP' 		=> ($this->auth->acl_get('m_')) ? append_sid($this->phpbb_root_path . 'mcp.' . $this->php_ext, false, true, $this->user->session_id) : '',
				'U_ACP'			=> ($this->auth->acl_get('a_')) ? append_sid($this->phpbb_root_path . 'adm/index.' . $this->php_ext, 'i=-primetime-primetime-acp-dashboard_module', true, $this->user->session_id) : '')
			);

			return array(
				'title'		=> $this->user->lang['WELCOME'],
				'content'	=> $this->ptemplate->render_view('primetime/base', 'blocks/member_menu.html', 'member_menu_block'),
			);
		}
	}
}
