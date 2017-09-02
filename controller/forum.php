<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\controller;

class forum
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var string phpEx */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth				$auth			Auth object
	 * @param \phpbb\config\config			$config			Config object
	 * @param \phpbb\controller\helper		$helper			Controller Helper object
	 * @param \phpbb\template\template		$template		Template object
	 * @param \phpbb\language\language		$translator		Language object
	 * @param \phpbb\user					$user			User object
	 * @param string						$root_path		phpBB root path
	 * @param string						$php_ext		phpEx
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\language\language $translator, \phpbb\user $user, $root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->helper = $helper;
		$this->template = $template;
		$this->translator = $translator;
		$this->user = $user;
		$this->phpbb_root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function handle()
	{
		/**
		 * This is ugly but the only way I could find
		 * to fix relative paths for forum images
		 */
		global $phpbb_root_path;
		$phpbb_root_path = generate_board_url() . '/';

		// @codeCoverageIgnoreStart
		if (!function_exists('display_forums'))
		{
			include($this->phpbb_root_path . 'includes/functions_display.' . $this->php_ext);
		}
		// @codeCoverageIgnoreEnd

		display_forums('', $this->config['load_moderators']);
		$this->set_mcp_url();

		// restore phpbb_root_path
		$phpbb_root_path = $this->phpbb_root_path;

		$this->template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $this->translator->lang('FORUM'),
			'U_VIEW_FORUM'	=> $this->helper->route('blitze_sitemaker_forum'),
		));

		return $this->helper->render('index_body.html', $this->translator->lang('FORUM_INDEX'));
	}

	/**
	 * @return void
	 */
	protected function set_mcp_url()
	{
		if ($this->auth->acl_get('m_') || $this->auth->acl_getf_global('m_'))
		{
			$this->template->assign_var('U_MCP', append_sid("{$this->phpbb_root_path}mcp.{$this->php_ext}", 'i=main&amp;mode=front', true, $this->user->session_id));
		}
	}
}
