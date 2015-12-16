<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\acp;

use blitze\sitemaker\acp\menu_info;

class menu_info_test extends \phpbb_test_case
{
	/**
	 * Define the extension to be tested.
	 *
	 * @return string[]
	 */
	protected static function setup_extensions()
	{
		return array('blitze/sitemaker');
	}

	/**
	 * Test the module method
	 */
	public function test_module()
	{
		$module = new menu_info();
		$info = $module->module();

		$expected = array(
			'filename' => '\blitze\sitemaker\acp\menu_module',
			'parent' => array('ACP_SITEMAKER'),
		);

		$result = array(
			'filename' => $info['filename'],
			'parent' => $info['modes']['menu']['cat'],
		);

		$this->assertEquals($expected, $result);
	}
}
