<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\acp;

class menu_info
{
	public function module()
	{
		return array(
			'filename'	=> '\blitze\sitemaker\acp\menu_module',
			'title'		=> 'ACP_SITEMAKER',
			'modes'		=> array(
				'menu'		=> array('title' => 'ACP_MENU', 'auth' => 'ext_blitze/sitemaker', 'cat' => array('ACP_SITEMAKER')),
			),
		);
	}
}
