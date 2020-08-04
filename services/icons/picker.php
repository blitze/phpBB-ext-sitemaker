<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\icons;

use Symfony\Component\Yaml\Yaml;

/**
 * Sitemaker icons
 */
class picker
{
	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \blitze\sitemaker\services\util */
	protected $util;

	/** @var \blitze\sitemaker\services\template */
	protected $ptemplate;

	/** @var string */
	protected $icon_categories_yml;

	/**
	 * Constructor
	 *
	 * @param \phpbb\language\language     			$translator     		Language object
	 * @param \blitze\sitemaker\services\util		$util					Sitemaker utility object
	 * @param \blitze\sitemaker\services\template	$ptemplate				Sitemaker Template object
	 * @param string								$icon_categories_yml	YAML file containing fontawesome icon categories
	 */
	public function __construct(\phpbb\language\language $translator, \blitze\sitemaker\services\util $util, \blitze\sitemaker\services\template $ptemplate, $icon_categories_yml)
	{
		$this->translator          = $translator;
		$this->util                = $util;
		$this->ptemplate           = $ptemplate;
		$this->icon_categories_yml = $icon_categories_yml;
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

		$icons_tpl = 'fontawesome4';
		if (phpbb_version_compare(PHPBB_VERSION, '3.3.1', '>='))
		{
			$icons_tpl = 'fontawesome5';
			$categories = Yaml::parseFile($this->icon_categories_yml);

			$this->ptemplate->assign_var('categories', $categories);
		}

		$this->ptemplate->assign_var('icons_tpl', $icons_tpl);

		$this->ptemplate->set_filenames(array(
			'icons'	=> 'icons/picker.html'
		));

		return $this->ptemplate->assign_display('icons');
	}
}
