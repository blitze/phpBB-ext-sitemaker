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
	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \blitze\sitemaker\services\util */
	protected $sitemaker;

	/** @var \blitze\sitemaker\services\template */
	protected $ptemplate;

	/**
	 * Constructor
	 *
	 * @param \phpbb\language\language     			$translator     Language object
	 * @param \blitze\sitemaker\services\util		$sitemaker		Sitemaker object
	 * @param \blitze\sitemaker\services\ptemplate	$ptemplate		Sitemaker Template object
	 */
	public function __construct(\phpbb\language\language $translator, \blitze\sitemaker\services\util $sitemaker, \blitze\sitemaker\services\template $ptemplate)
	{
		$this->translator = $translator;
		$this->sitemaker = $sitemaker;
		$this->ptemplate = $ptemplate;
	}

	/**
	 * Load icon picker
	 */
	public function picker()
	{
		$this->translator->add_lang('icons', 'blitze/sitemaker');

		$this->sitemaker->add_assets(array(
			'js'	=> array(
				'@blitze_sitemaker/assets/icons/picker.min.js',
			),
			'css'	=> array(
				'@blitze_sitemaker/vendor/fontawesome/css/font-awesome.min.css',
				'@blitze_sitemaker/assets/icons/picker.min.css',
			)
		));

		$this->ptemplate->set_style(array('ext/blitze/sitemaker/styles', 'styles'));

		$this->ptemplate->set_filenames(array(
			'icons'	=> 'icon_picker.html'
		));

		return $this->ptemplate->assign_display('icons');
	}
}
