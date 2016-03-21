<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\controller;

/**
 * Because this extension allows the user to define a landing page other than the forum index,
 * we need to provide a way to access the Forum. This controller serves that purpose
 */
class forum
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\controller\helper */
	protected $controller;

	/** @var \phpbb\path_helper */
	protected $path_helper;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config			$config			Config object
	 * @param \phpbb\controller\helper		$controller		Controller Helper object
	 * @param \phpbb\path_helper			$path_helper	Path helper object
	 * @param \phpbb\template\template		$template		Template object
	 * @param \phpbb\user					$user			User object
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\controller\helper $controller, \phpbb\path_helper $path_helper, \phpbb\template\template $template, \phpbb\user $user)
	{
		$this->config = $config;
		$this->controller = $controller;
		$this->path_helper = $path_helper;
		$this->template = $template;
		$this->user = $user;
	}

	public function handle()
	{
		if (!function_exists('display_forums'))
		{
			include($this->path_helper->get_phpbb_root_path() . 'includes/functions_display.' . $this->path_helper->get_php_ext()); // @codeCoverageIgnore
		}

		// Fix image paths
		// This is hacky but it gets the job done.
		global $phpbb_root_path;
		$phpbb_root_path = $this->path_helper->get_web_root_path();

		display_forums('', $this->config['load_moderators']);

		// Restore root path
		$phpbb_root_path = $this->path_helper->get_phpbb_root_path();

		$this->template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $this->user->lang('FORUM'),
			'U_VIEW_FORUM'	=> $this->controller->route('blitze_sitemaker_forum')
		));

		return $this->controller->render('index_body.html', $this->user->lang('FORUM_INDEX'));
	}
}
