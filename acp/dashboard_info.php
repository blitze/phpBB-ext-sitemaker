<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\base\acp;

class dashboard_info
{
	function module()
	{
		return array(
			'filename'	=> '\primetime\base\acp\dashboard_module',
			'title'		=> 'ACP_PRIMETIME_DASHBOARD',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'dashboard'		=> array('title' => 'PRIMETIME_DASHBOARD', 'auth' => 'ext_primetime/base', 'cat' => array('ACP_CAT_CMS')),
			),
		);
	}
}
