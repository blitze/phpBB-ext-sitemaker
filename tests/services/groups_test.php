<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services;

use blitze\sitemaker\services\groups;

class groups_test extends \phpbb_database_test_case
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
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/groups.xml');
	}

	protected function get_service($user_id = 0)
	{
		$db = $this->new_dbal();

		$translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode(' ', func_get_args());
			});

		$user = new \phpbb\user($translator, '\phpbb\datetime');
		$user->data['user_id'] = $user_id;

		return new groups($db, $translator, $user);
	}

	/**
	 * Data set for test_get_users_groups
	 *
	 * @return array
	 */
	public function get_users_groups_test_data()
	{
		return array(
			array(
				1,
				array(
					1 => 1,
				),
			),
			array(
				2,
				array(
					2 => 2,
					3 => 3,
				),
			),
			array(
				48,
				array(
					2 => 2,
				),
			),
		);
	}

	/**
	 * Test the get_users_groups method
	 *
	 * @dataProvider get_users_groups_test_data
	 * @param int $user_id
	 * @param array $expected
	 */
	public function test_get_users_groups($user_id, array $expected)
	{
		$groups = $this->get_service($user_id);
		$result = $groups->get_users_groups();

		$this->assertEquals($expected, $result);
	}

	/**
	 * Data set for test_get_data
	 *
	 * @return array
	 */
	public function get_data_test_data()
	{
		return array(
			array(
				'all',
				array(
					'' => 'ALL',
					1 => 'G_GUESTS',
					2 => 'G_REGISTERED',
					3 => 'Some Group',
				),
			),
			array(
				'special',
				array(
					'' => 'ALL',
					1 => 'G_GUESTS',
					2 => 'G_REGISTERED',
				),
			),
		);
	}

	/**
	 * Test the get_data method
	 *
	 * @dataProvider get_data_test_data
	 * @param string $mode
	 * @param array $expected
	 */
	public function test_get_data($mode, array $expected)
	{
		$groups = $this->get_service();
		$result = $groups->get_data($mode);

		$this->assertEquals($expected, $result);
	}

	/**
	 * Data set for test_get_options
	 *
	 * @return array
	 */
	public function get_options_test_data()
	{
		return array(
			array(
				'all',
				array(),
				'<option value="0">ALL</option>' .
				'<option class="sep" value="1">G_GUESTS</option>' .
				'<option class="sep" value="2">G_REGISTERED</option>' .
				'<option value="3">Some Group</option>',
			),
			array(
				'all',
				array(1, 3),
				'<option value="0">ALL</option>' .
				'<option class="sep" value="1" selected="selected">G_GUESTS</option>' .
				'<option class="sep" value="2">G_REGISTERED</option>' .
				'<option value="3" selected="selected">Some Group</option>',
			),
			array(
				'special',
				array(2),
				'<option value="0">ALL</option>' .
				'<option class="sep" value="1">G_GUESTS</option>' .
				'<option class="sep" value="2" selected="selected">G_REGISTERED</option>',
			),
		);
	}

	/**
	 * Test the get_data method
	 *
	 * @dataProvider get_options_test_data
	 * @param string $mode
	 * @param array $selected
	 * @param string $expected
	 */
	public function test_get_options($mode, array $selected, $expected)
	{
		$groups = $this->get_service();
		$result = $groups->get_options($mode, $selected);

		$this->assertEquals($expected, $result);
	}
}
