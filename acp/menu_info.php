<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\acp;

class menu_info
{
	public function module()
	{
		return array(
			'filename'	=> '\primetime\core\acp\menu_module',
			'title'		=> 'ACP_MENU_MANAGEMENT',
			'parent'	=> 'ACP_MOD_MANAGEMENT',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'menu'		=> array('title' => 'MENU', 'auth' => 'ext_primetime/core', 'cat' => array('ACP_MENU')),
			),
		);
	}
}
