<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* Primetime icons - Font-awesome
*/
class icon_picker
{
	/**
	 * Template object
	 * @var \primetime\primetime\core\blocks\template
	 */
	protected $template;

	/**
	 * User object
	 * @var \phpbb\user
	 */
	protected $user;

	/**
	 * Primetime object
	 * @var \primetime\primetime\core\primetime
	 */
	protected $primetime;

	/**
	 * Constructor
	 *
	 * @param \phpbb\template\template				$template		Template object
	 * @param \phpbb\user                			$user       	User object
	 * @param \primetime\primetime\core\primetime	$primetime		Primetime object
	 */
    function __construct(\primetime\primetime\core\blocks\template $template, \phpbb\user $user, \primetime\primetime\core\primetime $primetime)
	{
		$this->template = $template;
    	$this->primetime = $primetime;
    	$this->user = $user;
	}

	/**
	 * 
	 */
    public function get()
	{
		return array();
	}

	public function picker()
	{
        $this->user->add_lang_ext('primetime/primetime', 'icons');

		$asset_path = $this->primetime->asset_path;
		$this->primetime->add_assets(array(
            'js'        => array(
                $asset_path . 'ext/primetime/primetime/assets/icons/picker.js',
            ),
            'css'   => array(
                $asset_path . 'ext/primetime/primetime/assets/font-awesome/css/font-awesome.min.css',
                $asset_path . 'ext/primetime/primetime/assets/icons/picker.css',
            )
		));

		$this->template->set_style(array("ext/primetime/primetime/styles"));

		$this->template->set_filenames(array(
			'icons'	=> 'icon_picker.html')
		);

		return $this->template->assign_display('icons');
	}
}
