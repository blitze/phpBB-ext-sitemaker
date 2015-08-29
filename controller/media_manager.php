<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\controller;

use GuillermoMartinez\Filemanager\Filemanager;

class media_manager
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var string phpEx */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config			$config			Config object
	 * @param \phpbb\controller\helper		$helper			Controller Helper object
	 * @param \phpbb\template\template		$template		Template object
	 * @param \phpbb\user					$user			User object
	 * @param string						$root_path		phpBB root path
	 * @param string						$php_ext		phpEx
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\user $user, $root_path, $php_ext)
	{
		$this->config = $config;
		$this->helper = $helper;
		$this->template = $template;
		$this->user = $user;
		$this->phpbb_root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	public function handle()
	{
		return $this->helper->render('filemanager.html');
	}

	public function get()
	{
		$extra = array(
			// path after of root folder
			// if /var/www/public_html is your document root web server
			// then source= usefiles o filemanager/usefiles
			"source" => "../../../../../files/blitze_sitemaker/source",
			// url domain
			// so that the files and show well http://php-filemanager.rhcloud.com/userfiles/imagen.jpg
			// o http://php-filemanager.rhcloud.com/filemanager/userfiles/imagen.jpg
			"url" => "http://localhost/",
		);

		$f = new Filemanager($extra);
		$f->run();
	}

	public function post()
	{
		$extra = array(
			// path after of root folder
			// if /var/www/public_html is your document root web server
			// then source= usefiles o filemanager/usefiles
			"source" => "github/filemanagertest/laravel/public/userfiles",
			// url domain
			// so that the files and show well http://php-filemanager.rhcloud.com/userfiles/imagen.jpg
			// o http://php-filemanager.rhcloud.com/filemanager/userfiles/imagen.jpg
			"url" => "http://localhost/",
		);

		$f = new Filemanager($extra);
		$f->run();
	}
}
