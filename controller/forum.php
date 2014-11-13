<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\controller;

class forum
{
	/** @var \phpbb\config\db */
	protected $config;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpBB root path */
	protected $root_path;

	/** @var string phpEx */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\db				$config			Config object
	 * @param \phpbb\controller\helper		$helper			Controller Helper object
	 * @param \phpbb\template\template		$template		Template object
	 * @param \phpbb\user					$user			User object
	 * @param string						$root_path		phpBB root path
	 * @param string						$php_ext		phpEx
	 */
	public function __construct(\phpbb\config\db $config, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\user $user, $root_path, $php_ext)
	{
		$this->config = $config;
		$this->helper = $helper;
		$this->template = $template;
		$this->user = $user;
		$this->phpbb_root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	public function handle()
	{
		include($this->phpbb_root_path . 'includes/functions_display.' . $this->php_ext);

		display_forums('', $this->config['load_moderators']);

		$this->template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $this->user->lang['FORUM'],
			'U_VIEW_FORUM'	=> $this->helper->route('primetime_forum')
		));

		return $this->helper->render('index_body.html', $this->user->lang['FORUM_INDEX']);
	}
}
