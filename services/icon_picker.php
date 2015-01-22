<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\base\services;

/**
 * Primetime icons - Font-awesome
 */
class icon_picker
{
	/**
	 * User object
	 * @var \phpbb\user
	 */
	protected $user;

	/**
	 * Primetime object
	 * @var \primetime\base\services\util
	 */
	protected $primetime;

	/**
	 * Primetime template object
	 * @var \primetime\base\services\template
	 */
	protected $ptemplate;

	/**
	 * Constructor
	 *
	 * @param \phpbb\user                			$user       	User object
	 * @param \primetime\base\services\util			$primetime		Primetime object
	 * @param \primetime\base\services\ptemplate	$ptemplate		Primetime Template object
	 */
	function __construct(\phpbb\user $user, \primetime\base\services\util $primetime, \primetime\base\services\template $ptemplate)
	{
		$this->user = $user;
		$this->primetime = $primetime;
		$this->ptemplate = $ptemplate;
	}

	/**
	 * Load icon picker
	 */
	public function picker()
	{
		$this->user->add_lang_ext('primetime/base', 'icons');

		$asset_path = $this->primetime->asset_path;
		$this->primetime->add_assets(array(
			'js'        => array(
				'@primetime_base/assets/icons/picker.min.js',
			),
			'css'   => array(
				$asset_path . 'ext/primetime/base/components/fontawesome/css/font-awesome.min.css',
				'@primetime_base/assets/icons/picker.min.css',
			)
		));

		$this->ptemplate->set_style(array("ext/primetime/base/styles"));

		$this->ptemplate->set_filenames(array(
			'icons'	=> 'icon_picker.html')
		);

		return $this->ptemplate->assign_display('icons');
	}
}
