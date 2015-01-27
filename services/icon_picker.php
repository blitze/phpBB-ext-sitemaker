<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\services;

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
	 * @var \primetime\core\services\util
	 */
	protected $primetime;

	/**
	 * Primetime template object
	 * @var \primetime\core\services\template
	 */
	protected $ptemplate;

	/**
	 * Constructor
	 *
	 * @param \phpbb\user                			$user       	User object
	 * @param \primetime\core\services\util			$primetime		Primetime object
	 * @param \primetime\core\services\ptemplate	$ptemplate		Primetime Template object
	 */
	function __construct(\phpbb\user $user, \primetime\core\services\util $primetime, \primetime\core\services\template $ptemplate)
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
		$this->user->add_lang_ext('primetime/core', 'icons');

		$asset_path = $this->primetime->asset_path;
		$this->primetime->add_assets(array(
			'js'        => array(
				'@primetime_core/assets/icons/picker.min.js',
			),
			'css'   => array(
				$asset_path . 'ext/primetime/core/components/fontawesome/css/font-awesome.min.css',
				'@primetime_core/assets/icons/picker.min.css',
			)
		));

		$this->ptemplate->set_style(array("ext/primetime/core/styles"));

		$this->ptemplate->set_filenames(array(
			'icons'	=> 'icon_picker.html')
		);

		return $this->ptemplate->assign_display('icons');
	}
}
