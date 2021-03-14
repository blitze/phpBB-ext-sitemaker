<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2017 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services;

/**
 * @package sitemaker
 */
class filemanager
{
	/** @var \phpbb\filesystem\filesystem */
	protected $filesystem;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $user_dir = false;

	/** @var string */
	protected $upload_dir = 'images/sitemaker_uploads/source/';

	/**
	 * Constructor
	 *
	 * @param \phpbb\filesystem\filesystem	$filesystem			File system
	 * @param \phpbb\user					$user				User object
	 * @param string						$phpbb_root_path	phpBB root path
	 */
	public function __construct(\phpbb\filesystem\filesystem $filesystem, \phpbb\user $user, $phpbb_root_path)
	{
		$this->filesystem = $filesystem;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
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
		// if user is not founder, they must have a directory
		$this->user_dir = ($this->user->data['user_type'] != USER_FOUNDER) ? 'users/' . $this->user->data['username'] . '/' : '';

		$destination = $this->phpbb_root_path . $this->upload_dir . $this->user_dir;

		if (!is_dir($destination))
		{
			$this->filesystem->mkdir($destination, 0755);
		}
	}
}
