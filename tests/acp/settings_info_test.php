<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2016 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\acp;

use blitze\sitemaker\acp\settings_info;

class settings_info_test extends \phpbb_test_case
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
		$module = new settings_info();
		$info = $module->module();

		$expected = array(
			'filename' => '\blitze\sitemaker\acp\settings_module',
			'parent' => array('ACP_SITEMAKER'),
		);

		$result = array(
			'filename' => $info['filename'],
			'parent' => $info['modes']['settings']['cat'],
		);

		$this->assertEquals($expected, $result);
	}
}
