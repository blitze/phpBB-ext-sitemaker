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
 * Login Block
 */
class login extends \primetime\primetime\core\blocks\driver\block
{
	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $phpbb_root_path;
	
	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\user	$user				User object
	 * @param string 		$phpbb_root_path	Relative path to phpBB root
	 * @param string 		$php_ext			PHP extension (php)
	 */
	public function __construct(\phpbb\user $user, $phpbb_root_path, $php_ext)
	{
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		$this->user = $user;
	}

	public function get_config($data)
	{
		return array(
			'legend1'			=> $this->user->lang['SETTINGS'],
			'show_hide_me'		=> array('lang' => 'SHOW_HIDE_ME', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => 0),
			'allow_autologin'	=> array('lang' => 'AUTO_LOGIN', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => 0),
		);
	}

	public function display($bdata, $edit_mode = false)
	{
		global $config;

		$block = '';
		if (!$this->user->data['is_registered'] || $edit_mode === true)
		{
			$settings = $bdata['settings'];

			$this->ptemplate->assign_vars(array(
				'S_SHOW_HIDE_ME'		=> ($settings['show_hide_me']) ? true : false,
				'S_AUTOLOGIN_ENABLED'   => ($settings['allow_autologin']) ? true : false,
				'S_LOGIN_ACTION'		=> append_sid("{$this->phpbb_root_path}ucp" . $this->php_ext, 'mode=login'),
				
				'U_REGISTER'	=> append_sid("{$this->phpbb_root_path}ucp" . $this->php_ext, 'mode=register'),
				'U_REDIRECT'	=> reapply_sid(htmlspecialchars($this->user->page['root_script_path'] . $this->user->page['page'])))
			);
		
			$block = $this->ptemplate->render_view('primetime/primetime', 'blocks/login.html', 'login_block');
		}

		return array(
			'title'		=> 'LOGIN',
			'content'	=> $block,
		);
	}
}
