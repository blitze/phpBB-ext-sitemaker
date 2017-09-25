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

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth				$auth				Auth object
	 * @param \phpbb\config\config			$config				Config object
	 * @param \phpbb\template\template		$template			Template object
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\template\template $template)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->template = $template;
	}

	/**
	 * @return bool
	 */
	public function is_enabled()
	{
		return $this->config['sm_filemanager'] && $this->auth->acl_get('u_sm_filemanager');
	}

	/**
	 * @return void
	 */
	public function get_access_key()
	{
		return sha1($this->user->data['user_form_salt'] . 'filemanager');
	}

	/**
	 * @return array
	 */
	public function set_js_vars()
	{
		$this->template->assign_vars(array(
			'UA_FILEMANAGER'	=> $this->is_enabled(),
			'UA_RF_ACCESS_KEY'	=> $this->get_access_key(),
		));
	}
}
