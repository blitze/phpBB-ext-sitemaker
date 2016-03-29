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
	/**
	 * @return array
	 */
	public function module()
	{
		return array(
			'filename'	=> '\blitze\sitemaker\acp\menu_module',
			'title'		=> 'ACP_SITEMAKER',
			'modes'		=> array(
				'menu'		=> array('title' => 'ACP_MENU', 'auth' => 'ext_blitze/sitemaker && acl_a_sm_manage_menus', 'cat' => array('ACP_SITEMAKER')),
			),
		);
	}
}
