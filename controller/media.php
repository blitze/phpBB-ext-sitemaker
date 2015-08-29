<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\controller;

use Symfony\Component\HttpFoundation\Response;

class media
{
	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/**
	 * Constructor
	 *
	 * @param \phpbb\request\request_interface		$request		Request object
	 * @param string								$root_path		phpBB root path
	 */
	public function __construct(\phpbb\request\request_interface $request, $root_path)
	{
		$this->request = $request;
		$this->phpbb_root_path = $root_path;
	}

	public function handle($folder, $image)
	{
		$file = readfile($this->phpbb_root_path . 'files/blitze_sitemaker/' . $folder . '/' . $image);
		$date = filemtime($file);

		$response = new Response();
		$response->setLastModified($date);

        // Set response as public. Otherwise it will be private by default.
        //$response->setPublic();

        if ($response->isNotModified($this->request))
		{
            return $response;
        }

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$response->headers->set('Content-type', finfo_file($finfo, $image));
		$response->headers->set('Content-Disposition', 'inline; filename="' . $image . '";');
		$response->headers->set('Content-length', filesize($file));

		return $response;
	}
}
