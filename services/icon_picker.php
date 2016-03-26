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
 * Sitemaker icons
 */
class icon_picker
{
	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\util */
	protected $util;

	/** @var \blitze\sitemaker\services\template */
	protected $ptemplate;

	/**
	 * Constructor
	 *
	 * @param \phpbb\user                         $user       	User object
	 * @param \blitze\sitemaker\services\util     $util		    Sitemaker Utility object
	 * @param \blitze\sitemaker\services\template $ptemplate	Sitemaker Template object
	 */
	public function __construct(\phpbb\user $user, \blitze\sitemaker\services\util $util, \blitze\sitemaker\services\template $ptemplate)
	{
		$this->user = $user;
		$this->util = $util;
		$this->ptemplate = $ptemplate;
	}

	/**
	 * Load icon picker
	 */
	public function picker()
	{
		$this->user->add_lang_ext('blitze/sitemaker', 'icons');

		$this->util->add_assets(array(
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
