<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services;

/**
 * Sitemaker icons - Font-awesome
 */
class icon_picker
{
	/**
	 * User object
	 * @var \phpbb\user
	 */
	protected $user;

	/**
	 * Sitemaker object
	 * @var \blitze\sitemaker\services\util
	 */
	protected $sitemaker;

	/**
	 * Sitemaker template object
	 * @var \blitze\sitemaker\services\template
	 */
	protected $ptemplate;

	/**
	 * Constructor
	 *
	 * @param \phpbb\user                			$user       	User object
	 * @param \blitze\sitemaker\services\util		$sitemaker		Sitemaker object
	 * @param \blitze\sitemaker\services\ptemplate	$ptemplate		Sitemaker Template object
	 */
	public function __construct(\phpbb\user $user, \blitze\sitemaker\services\util $sitemaker, \blitze\sitemaker\services\template $ptemplate)
	{
		$this->user = $user;
		$this->sitemaker = $sitemaker;
		$this->ptemplate = $ptemplate;
	}

	/**
	 * Load icon picker
	 */
	public function picker()
	{
		$this->user->add_lang_ext('blitze/sitemaker', 'icons');

		$this->sitemaker->add_assets(array(
			'js'	=> array(
				'@blitze_sitemaker/assets/icons/picker.min.js',
			),
			'css'	=> array(
				'@blitze_sitemaker/vendor/fontawesome/css/font-awesome.min.css',
				'@blitze_sitemaker/assets/icons/picker.min.css',
			)
		));

		$this->ptemplate->set_style(array("ext/blitze/sitemaker/styles"));

		$this->ptemplate->set_filenames(array(
			'icons'	=> 'icon_picker.html'
		));

		return $this->ptemplate->assign_display('icons');
	}
}
