<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2017 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\filemanager;

/**
* @package sitemaker
*/
class setup
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $config_path;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth				$auth				Auth object
	 * @param \phpbb\config\config			$config				Config object
	 * @param \phpbb\template\template		$template			Template object
	 * @param \phpbb\user					$user				User object
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\template\template $template, \phpbb\user $user, $config_path)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->template = $template;
		$this->user = $user;
		$this->config_path = $config_path;
	}

	/**
	 * @return bool
	 */
	public function is_enabled()
	{
		return is_dir($this->config_path) && $this->config['sm_filemanager'] && $this->auth->acl_get('u_sm_filemanager');
	}

	/**
	 * @return void
	 */
	public function get_access_key()
	{
		return sha1($this->user->data['user_form_salt'] . 'filemanager');
	}
}
