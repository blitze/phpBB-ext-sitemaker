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
	/** @var \phpbb\files\factory */
	protected $files_factory;

	/** @var \phpbb\controller\helper */
	protected $controller;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \blitze\sitemaker\services\filemanager */
	protected $filemanager;

	/** @var array */
	protected $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'svg');

	/**
	 * Constructor
	 *
	 * @param \phpbb\files\factory							$files_factory		Files factory object
	 * @param \phpbb\controller\helper						$controller			Controller helper object
	 * @param \phpbb\language\language						$language			Language object
	 * @param \blitze\sitemaker\services\filemanager		$filemanager		Filemanager object
	 */
	public function __construct(\phpbb\files\factory $files_factory, \phpbb\controller\helper $controller, \phpbb\language\language $language, \blitze\sitemaker\services\filemanager $filemanager)
	{
		$this->files_factory = $files_factory;
		$this->controller = $controller;
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

		try
		{
			$this->handle_upload($json_data);
		}
		catch (\Exception $e)
		{
			$json_data['message'] = $e->getMessage();
		}

		return new JsonResponse($json_data);
	}

	/**
	 * @param array $json_data
	 * @return void
	 */
	protected function handle_upload(array &$json_data)
	{
		$destination = $this->filemanager->get_upload_destination();
		$user_dir = $this->filemanager->get_user_dir();

		$file = $this->files_factory->get('files.upload')
			->set_disallowed_content(array())
			->set_allowed_extensions($this->allowed_extensions)
			->handle_upload('files.types.form', 'file');

		$this->set_filename($file);
		$file->move_file(rtrim($destination, '/'), true);

		if (sizeof($file->error))
		{
			$file->remove();
			$json_data['message'] = implode('<br />', $file->error);
		}
		else
		{
			$json_data['location'] = $this->controller->route('blitze_sitemaker_file', array('file' => $user_dir . $file->get('realname')), false, '');
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
