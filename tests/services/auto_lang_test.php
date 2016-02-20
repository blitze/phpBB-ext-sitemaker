<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services;

use blitze\sitemaker\services\auto_lang;

class auto_lang_test extends \phpbb_test_case
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
	 * Test the add_block_admin_lang method
	 *
	 * @dataProvider add_block_admin_lang_test_data
	 */
	public function test_add_block_admin_lang($user_lang, $default_lang, $expected)
	{
		global $phpbb_extension_manager, $user, $phpEx;

		$config = new \phpbb\config\config(array('default_lang' => $default_lang));

		$lang_list = array();

		$user = $this->getMockBuilder('\phpbb\user')
			->disableOriginalConstructor()
			->getMock();
		$user->lang_name = $user_lang;

		$translator = $this->getMock('\phpbb\language\language');
		$translator->expects($this->any())
			->method('add_lang')
			->will($this->returnCallback(function($lang_file, $ext_name) use (&$lang_list) {
				$lang_list[$ext_name] = $lang_file;
			}));

		$phpbb_extension_manager = new \phpbb_mock_extension_manager(
			dirname(__FILE__) . '/fixtures/',
			array(
				'foo/bar' => array(
					'ext_name'		=> 'foo/bar',
					'ext_active'	=> '1',
					'ext_path'		=> 'ext/foo/bar/',
				),
			));

		$auto_lang = new auto_lang($config, $phpbb_extension_manager, $translator, $user, $phpEx);
		$auto_lang->add('blocks_admin');

		$this->assertSame($expected, $lang_list);
	}

	/**
	 * Data set for test_add_block_admin_lang
	 *
	 * @return array
	 */
	public function add_block_admin_lang_test_data()
	{
		return array(
			array(
				'en',
				'en',
				array(
					'foo/bar'	=> 'ext/foo/bar/language/en/blocks_admin.php',
				)
			),
			array(
				'en',
				'it',
				array(
					'foo/bar'	=> 'ext/foo/bar/language/en/blocks_admin.php',
				)
			),
			array(
				'fr',
				'it',
				array(
					'foo/bar'	=> 'ext/foo/bar/language/fr/blocks_admin.php',
				)
			),
			array(
				'it',
				'it',
				array(
					'foo/bar'	=> 'ext/foo/bar/language/en/blocks_admin.php',
				)
			),
		);
	}
}
