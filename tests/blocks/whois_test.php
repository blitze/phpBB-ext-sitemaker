<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use blitze\sitemaker\blocks\whois;

class whois_test extends blocks_base
{
	/**
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/users.xml');
	}

	/**
	 * Create the stats block
	 *
	 * @return \blitze\sitemaker\blocks\stats
	 */
	protected function get_block($authed = false, $current_page = '')
	{
		global $auth, $db, $phpbb_dispatcher, $user, $phpbb_root_path, $phpEx;

		$db = $this->new_dbal();

		$auth = $this->getMock('\phpbb\auth\auth');
		$auth->expects($this->any())
			->method('acl_gets')
			->with($this->stringContains('_'), $this->anything())
			->willReturnCallback(function () use ($authed) {
				return ($authed) ? true : false;
			});

		$config = new \phpbb\config\config(array(
			'record_online_users' => 3,
			'record_online_date' => strtotime('7 December 2015'),
		));

		$context = $this->getMockBuilder('\phpbb\template\context')
			->disableOriginalConstructor()
			->getMock();
		$context->expects($this->any())
			->method('get_data_ref')
			->willReturnCallback(function () use ($current_page) {
				$data = array();
				if (strpos($current_page, 'f=') !== false)
				{
					$data = array(
						'.' => array(
							array(
								'TOTAL_USERS_ONLINE' => 'In total there is 1 user online :: 2 registered, 0 hidden and 0 guests',
								'LOGGED_IN_USER_LIST' => 'Users browsing this forum: demo and 0 guests',
								'RECORD_USERS' => 'Most users ever online was 2 on Tue Nov 24, 2015 4:49 pm',
							),
						),
					);
				}
				return $data;
			});

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$user = $this->getMock('\phpbb\user', array(), array('\phpbb\datetime'));

		$translator = $this->getMock('\phpbb\language\language');
		$translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function ($key, $value) {
				return $key . ': ' . $value;
			});

		$block = new whois($auth, $config, $context, $translator, $user, $phpbb_root_path, $phpEx);
		$block->set_template($this->ptemplate);

		return $block;
	}

	public function test_block_config()
	{
		$block = $this->get_block();
		$config = $block->get_config(array());

		$this->assertEquals(array(), $config);
	}

	/**
	 * Data set for test_block_display
	 *
	 * @return array
	 */
	public function block_test_data()
	{
		return array(
			array(
				false,
				'index.php',
				array(
					'TOTAL_USERS_ONLINE' => 'ONLINE_USERS_TOTAL: 0',
					'LOGGED_IN_USER_LIST' => ' ',
					'RECORD_USERS' => 'RECORD_ONLINE_USERS: 3',
					'U_VIEWONLINE' => '',
				),
			),
			array(
				true,
				'viewtopic.php?f=2&t=1',
				array(
					'TOTAL_USERS_ONLINE' => 'In total there is 1 user online :: 2 registered, 0 hidden and 0 guests',
					'LOGGED_IN_USER_LIST' => 'Users browsing this forum: demo and 0 guests',
					'RECORD_USERS' => 'Most users ever online was 2 on Tue Nov 24, 2015 4:49 pm',
					'U_VIEWONLINE' => 'phpBB/viewonline.php',
				),
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 */
	public function test_block_display($authed, $current_page, $expected)
	{
		$block = $this->get_block($authed, $current_page);
		$result = $block->display(array());

		$this->assertSame($expected, $result['content']);
	}
}
