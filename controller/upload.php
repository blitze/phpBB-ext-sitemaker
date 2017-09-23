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

	/** @var \phpbb\language\language */
	protected $language;

	/** @var string */
	protected $phpbb_root_path;

	/** @var array */
	protected $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'svg');

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth					$auth				Auth object
	 * @param \phpbb\files\factory				$files_factory		Files factory object
	 * @param \phpbb\language\language			$language			Language object
	 * @param string							$phpbb_root_path	phpBB root path
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\files\factory $files_factory, \phpbb\language\language $language, $phpbb_root_path)
	{
		$this->auth = $auth;
		$this->files_factory = $files_factory;
		$this->language = $language;
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

		$file = $this->get_file();

		if (sizeof($file->error))
		{
			$file->remove();
			$json_data['message'] = implode('<br />', $file->error);
		}
		else
		{
			$this->set_file_permissions($upload_dir . $file->get('realname'));
			$json_data['location'] = $file->get('realname');
		}

		return new JsonResponse($json_data);
	}

	/**
	 * @param array $allowed_extensions
	 * @return void
	 */
	public function set_allowed_extensions(array $allowed_extensions)
	{
		$this->allowed_extensions = $allowed_extensions;
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
	 * @return \phpbb\files\filespec
	 */
	protected function get_file()
	{
		$upload_dir = $this->phpbb_root_path . 'images/sitemaker_uploads/source/';

		$file = $this->files_factory->get('files.upload')
			->set_disallowed_content(array())
			->set_allowed_extensions($this->allowed_extensions)
			->handle_upload('files.types.form', 'file');

		$this->set_filename($file);
		$file->move_file(str_replace($this->phpbb_root_path, '', $upload_dir), true, true, 0644);

		return $file;
	}

	/**
	 * @param string $file
	 * @return void
	 */
	protected function set_file_permissions($file)
	{
		chmod($file, 0644);
	}
}
