<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2021 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\controller;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use phpbb\exception\http_exception;

class file
{
	/** @var \blitze\sitemaker\services\filemanager */
	protected $filemanager;

	/** @var string */
	protected $phpbb_root_path;

	/**
	 * Constructor
	 *
	 * @param \blitze\sitemaker\services\filemanager		$filemanager		Filemanager object
	 * @param string										$phpbb_root_path	phpBB root path
	 */
	public function __construct(\blitze\sitemaker\services\filemanager $filemanager, $phpbb_root_path)
	{
		$this->filemanager = $filemanager;
		$this->phpbb_root_path = $phpbb_root_path;
	}

	/**
	 * @param string $file
	 * @return BinaryFileResponse
	 */
	public function handle($file)
	{
		$upload_path = $this->filemanager->get_upload_destination();
		$file = $this->phpbb_root_path . $upload_path . $file;

		if (!file_exists($file))
		{
			throw new http_exception(404, 'URL_NOT_FOUND');
		}

		return new BinaryFileResponse($file, 200);
	}
}
