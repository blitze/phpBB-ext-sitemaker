<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\acp;

class dashboard_info
{
	public function module()
	{
		return array(
			'filename'	=> '\blitze\sitemaker\acp\dashboard_module',
			'title'		=> 'ACP_SITEMAKER_DASHBOARD',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'dashboard'		=> array('title' => 'SITEMAKER_DASHBOARD', 'auth' => 'ext_blitze/sitemaker', 'cat' => array('ACP_CAT_CMS')),
			),
		);
	}
}
