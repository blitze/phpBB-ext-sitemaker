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
	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \blitze\sitemaker\services\util */
	protected $util;

	/** @var \blitze\sitemaker\services\template */
	protected $ptemplate;

	/**
	 * Constructor
	 *
	 * @param \phpbb\language\language     			$translator     Language object
	 * @param \blitze\sitemaker\services\util		$util			Sitemaker utility object
	 * @param \blitze\sitemaker\services\template	$ptemplate		Sitemaker Template object
	 */
	public function __construct(\phpbb\language\language $translator, \blitze\sitemaker\services\util $util, \blitze\sitemaker\services\template $ptemplate)
	{
		$this->translator = $translator;
		$this->util = $util;
		$this->ptemplate = $ptemplate;
	}

	/**
	 * Load icon picker
	 */
	public function picker()
	{
		$this->translator->add_lang('icons', 'blitze/sitemaker');

		$this->util->add_assets(array(
			'js'	=> array(
				'@blitze_sitemaker/vendor/jquery-ui/jquery-ui.min.js',
				'@blitze_sitemaker/assets/icons/picker.min.js',
			),
			'css'	=> array_filter(array(
				defined('IN_ADMIN') ? $this->util->get_web_path() . 'assets/css/font-awesome.min.css' : '',
				'@blitze_sitemaker/vendor/jquery-ui/themes/smoothness/jquery-ui.min.css',
				'@blitze_sitemaker/assets/icons/picker.min.css',
			))
		));

		$this->ptemplate->set_style(array('ext/blitze/sitemaker/styles', 'styles'));

		$this->ptemplate->set_filenames(array(
			'icons'	=> 'icon_picker.html'
		));

		return $this->ptemplate->assign_display('icons');
	}
}
