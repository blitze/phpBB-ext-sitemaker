<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\event;

class load_permission_language_test extends listener_base
{
	/**
	 * Data set for test_add_permissions
	 *
	 * @return array
	 */
	public function load_permission_language_test_data()
	{
		return array(
			array(
				array(),
				array(
					'a_sm_settings' => array('lang' => 'ACL_A_SM_SETTINGS', 'cat' => 'misc'),
					'a_sm_manage_blocks' => array('lang' => 'ACL_A_SM_MANAGE_BLOCKS', 'cat' => 'misc'),
					'a_sm_manage_menus' => array('lang' => 'ACL_A_SM_MANAGE_MENUS', 'cat' => 'misc'),
				),
			),
			array(
				array(
					'a_foo' => array('lang' => 'ACL_A_FOO', 'cat' => 'misc'),
				),
				array(
					'a_foo' => array('lang' => 'ACL_A_FOO', 'cat' => 'misc'),
					'a_sm_settings' => array('lang' => 'ACL_A_SM_SETTINGS', 'cat' => 'misc'),
					'a_sm_manage_blocks' => array('lang' => 'ACL_A_SM_MANAGE_BLOCKS', 'cat' => 'misc'),
					'a_sm_manage_menus' => array('lang' => 'ACL_A_SM_MANAGE_MENUS', 'cat' => 'misc'),
				),
			),
		);
	}

	/**
	 * Test the load_permission_language event
	 *
	 * @dataProvider load_permission_language_test_data
	 * @param array $permisions_data
	 * @param array $expected_permissions
	 */
	public function test_load_permission_language(array $permisions_data, array $expected_permissions)
	{
		$data = new \phpbb\event\data(array(
			'permissions'	=> $permisions_data,
		));

		$listener = $this->get_listener();
		$listener->load_permission_language($data);

		$this->assertSame($data['permissions'], $expected_permissions);
	}
}
