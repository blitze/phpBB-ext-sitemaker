<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\acp;

class menu_info
{
	function module()
	{
		return array(
			'filename'	=> '\primetime\primetime\acp\menu_module',
			'title'		=> 'ACP_MENU_MANAGEMENT',
			'parent'	=> 'ACP_MOD_MANAGEMENT',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'menu'		=> array('title' => 'MENU', 'auth' => '', 'cat' => array('ACP_MENU')),
			),
		);
	}
}
