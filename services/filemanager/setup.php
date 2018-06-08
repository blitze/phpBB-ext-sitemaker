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
class setup extends settings
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\filesystem\filesystem */
	protected $filesystem;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $config_path;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $user_dir = false;

	/** @var string */
	protected $thumbs_dir = 'images/sitemaker_uploads/thumbs/';

	/** @var string */
	protected $upload_dir = 'images/sitemaker_uploads/source/';

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth				$auth				Auth object
	 * @param \phpbb\config\config			$config				Config object
	 * @param \phpbb\filesystem\filesystem	$filesystem			File system
	 * @param \phpbb\user					$user				User object
	 * @param string						$config_path		path to filemanager config file
	 * @param string						$phpbb_root_path	phpBB root path
	 * @param string						$php_ext			phpEx
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\filesystem\filesystem $filesystem, \phpbb\user $user, $config_path, $phpbb_root_path, $php_ext)
	{
		parent::__construct($filesystem, $config_path, $php_ext);

		$this->auth = $auth;
		$this->config = $config;
		$this->filesystem = $filesystem;
		$this->user = $user;
		$this->config_path = $config_path;
		$this->phpbb_root_path = $phpbb_root_path;
	}

	/**
	 * @return bool
	 */
	public function is_enabled()
	{
		return is_dir($this->config_path) && $this->config['sm_filemanager'] && $this->auth->acl_get('u_sm_filemanager');
	}

	/**
	 * @return string
	 */
	public function get_access_key()
	{
		return sha1($this->user->data['user_form_salt'] . 'filemanager');
	}

	/**
	 * @return string
	 */
	public function get_upload_dir()
	{
		return $this->upload_dir;
	}

	/**
	 * @return string
	 */
	public function get_thumbs_dir()
	{
		return $this->thumbs_dir;
	}

	/**
	 * @return string
	 */
	public function get_upload_destination()
	{
		return $this->upload_dir . $this->get_user_dir();
	}

	/**
	 * @return string
	 */
	public function get_user_dir()
	{
		if (!$this->user_dir)
		{
			$this->set_user_dir();
		}

		return $this->user_dir;
	}

	/**
	 * @return string
	 */
	protected function set_user_dir()
	{
		// if user does not have root access, they must have a directory
		$this->user_dir = (!$this->auth->acl_get('a_sm_filemanager')) ? 'users/' . $this->user->data['username'] . '/' : '';

		$destination = $this->phpbb_root_path . $this->upload_dir . $this->user_dir;

		if (!is_dir($destination))
		{
			$this->filesystem->mkdir($destination, 0755);
		}
	}
}
