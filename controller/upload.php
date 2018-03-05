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

	/** @var \blitze\sitemaker\services\filemanager\setup */
	protected $filemanager;

	/** @var array */
	protected $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'svg');

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth								$auth				Auth object
	 * @param \phpbb\files\factory							$files_factory		Files factory object
	 * @param \phpbb\language\language						$language			Language object
	 * @param \blitze\sitemaker\services\filemanager\setup	$filemanager		Filemanager object
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\files\factory $files_factory, \phpbb\language\language $language, \blitze\sitemaker\services\filemanager\setup $filemanager)
	{
		$this->auth = $auth;
		$this->files_factory = $files_factory;
		$this->language = $language;
		$this->filemanager = $filemanager;
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

		$destination = $this->filemanager->get_upload_destination();
		$user_dir = $this->filemanager->get_user_dir();

		$this->set_filename($file);
		$file->move_file(rtrim($destination, '/'), true);

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
	 * @param \phpbb\files\filespec $file
	 * @return void
	 */
	protected function set_filename(\phpbb\files\filespec &$file)
	{
		$mode = 'real';
		$prefix = '';

		if (preg_match('/^(blobid|imagetools)\d?/i', (string) $file->get('realname')))
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
