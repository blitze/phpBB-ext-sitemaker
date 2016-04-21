<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2016 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\acp;

class settings_info
{
	/**
	 * @return array
	 */
	public function module()
	{
		return array(
			'filename'	=> '\blitze\sitemaker\acp\settings_module',
			'title'		=> 'ACP_SITEMAKER',
			'modes'		=> array(
				'settings'		=> array('title' => 'ACP_SM_SETTINGS', 'auth' => 'ext_blitze/sitemaker && acl_a_sm_settings', 'cat' => array('ACP_SITEMAKER')),
			),
		);
	}
}
