<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\icons;

/**
 * Sitemaker icons
 */
class picker
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \blitze\sitemaker\services\util */
	protected $util;

	/** @var \blitze\sitemaker\services\template */
	protected $ptemplate;

	/** @var string */
	protected $categories_file;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config					$config					Config object
	 * @param \phpbb\language\language     			$translator     		Language object
	 * @param \blitze\sitemaker\services\util		$util					Sitemaker utility object
	 * @param \blitze\sitemaker\services\template	$ptemplate				Sitemaker Template object
	 * @param string								$categories_file		Categories file (json)
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\language\language $translator, \blitze\sitemaker\services\util $util, \blitze\sitemaker\services\template $ptemplate, $categories_file)
	{
		$this->config          = $config;
		$this->translator      = $translator;
		$this->util            = $util;
		$this->ptemplate       = $ptemplate;
		$this->categories_file = $categories_file;
	}

	/**
	 * Load icon picker
	 */
	public function picker()
	{
		$this->translator->add_lang('icons', 'blitze/sitemaker');
		$this->ptemplate->set_style(array('ext/blitze/sitemaker/styles', 'styles'));

		$this->util->add_assets(array(
			'css'	=> array_filter(array(
				defined('IN_ADMIN') ? $this->util->get_web_path() . 'assets/css/font-awesome.min.css' : '',
			))
		));

		$this->ptemplate->assign_var('categories', json_decode(file_get_contents($this->categories_file), true));

		$this->ptemplate->set_filenames(array(
			'icons'	=> 'icons/picker.html'
		));

		return $this->ptemplate->assign_display('icons');
	}
}
