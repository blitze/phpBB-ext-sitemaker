<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2017 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class upload
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\files\factory */
	protected $files_factory;

	/** @var \phpbb\filesystem\filesystem */
	protected $filesystem;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $upload_dir = 'images/sitemaker_uploads/source/';

	/** @var array */
	protected $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'svg');

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth					$auth				Auth object
	 * @param \phpbb\files\factory				$files_factory		Files factory object
	 * @param \phpbb\filesystem\filesystem		$filesystem			File system
	 * @param \phpbb\language\language			$language			Language object
	 * @param \phpbb\user						$user				User object
	 * @param string							$phpbb_root_path	phpBB root path
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\files\factory $files_factory, \phpbb\filesystem\filesystem $filesystem, \phpbb\language\language $language, \phpbb\user $user, $phpbb_root_path)
	{
		$this->auth = $auth;
		$this->files_factory = $files_factory;
		$this->filesystem = $filesystem;
		$this->language = $language;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
	}

	/**
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function handle()
	{
		$json_data = array(
			'location'	=> '',
			'message'   => '',
		);

		if (!$this->auth->acl_get('u_sm_filemanager'))
		{
			$json_data['message'] = $this->language->lang('NOT_AUTHORISED');
			return new JsonResponse($json_data, 401);
		}

		$this->handle_upload($json_data);

		return new JsonResponse($json_data);
	}

	/**
	 * @param array $json_data
	 * @return void
	 */
	protected function handle_upload(array &$json_data)
	{
		$file = $this->files_factory->get('files.upload')
			->set_disallowed_content(array())
			->set_allowed_extensions($this->allowed_extensions)
			->handle_upload('files.types.form', 'file');

		$this->set_filename($file);

		$user_dir = $this->get_user_dir();
		$destination = rtrim($this->upload_dir . $user_dir, '/');
		$file->move_file($destination, true);

		if (sizeof($file->error))
		{
			$file->remove();
			$json_data['message'] = implode('<br />', $file->error);
		}
		else
		{
			$json_data['location'] = $user_dir . $file->get('realname');
		}
	}

	/**
	 * @return string
	 */
	protected function get_user_dir()
	{
		$user_dir = '';

		// if user does not have root access, they must have a directory
		if (!$this->auth->acl_get('a_sm_filemanager'))
		{
			$user_dir = 'users/' . $this->user->data['username'] . '/';

			$destination = $this->phpbb_root_path . $this->upload_dir . $user_dir;

			if (!is_dir($destination))
			{
				$this->filesystem->mkdir($destination, 0755);
			}
		}

		return $user_dir;
	}

	/**
	 * @param \phpbb\files\filespec $file
	 * @return void
	 */
	protected function set_filename(\phpbb\files\filespec &$file)
	{
		$mode = 'real';
		$prefix = '';

		if (preg_match('/^(blobid|imagetools)\d?/i', $file->get('realname')))
		{
			$mode = 'unique';
			$prefix = 'sm_';
		}

		$file->clean_filename($mode, $prefix);
	}

	/**
	 * @param array $allowed_extensions
	 * @return void
	 */
	public function set_allowed_extensions(array $allowed_extensions)
	{
		$this->allowed_extensions = $allowed_extensions;
	}
}
