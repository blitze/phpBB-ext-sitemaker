<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use blitze\sitemaker\blocks\member_menu;

class member_menu_test extends blocks_base
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
	 * Create the member menu block
	 *
	 * @return \blitze\sitemaker\blocks\member_menu
	 */
	protected function get_block($user_data = array())
	{
		global $auth, $phpbb_dispatcher, $phpbb_path_helper, $user, $phpbb_root_path, $phpEx;

		$auth = $this->getMock('\phpbb\auth\auth');
		$auth->expects($this->any())
			->method('acl_get')
			->with($this->stringContains('_'), $this->anything())
			->willReturn(true);

		$request = $this->getMock('\phpbb\request\request');

		$db = $this->new_dbal();

		$user = new \phpbb\user('\phpbb\datetime');
		$user->session_id = 0;
		$user->data = $user_data;

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$phpbb_path_helper =  new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			new \phpbb\filesystem(),
			$request,
			$phpbb_root_path,
			$phpEx
		);

		$block = new member_menu($auth, $db, $user, $phpbb_root_path, $phpEx);
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
				array(
					'user_id'		=> 2,
					'username'		=> 'admin',
					'is_registered' => false,
				),
				'',
			),
			array(
				array(
					'user_id'		=> 48,
					'username'		=> 'demo',
					'is_registered' => true,
				),
				array(
					'USER_AVATAR' => '',
					'USERNAME' => '<span class="username">demo</span>',
					'USERNAME_FULL' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=48" class="username">demo</a>',
					'U_PROFILE' => 'phpBB/memberlist.php?mode=viewprofile&amp;u=48',
					'U_SEARCH_NEW' => 'phpBB/search.php?search_id=newposts',
					'U_SEARCH_SELF' => 'phpBB/search.php?search_id=egosearch',
					'U_PRIVATE_MSG' => 'phpBB/ucp.php?i=pm&amp;folder=inbox',
					'U_LOGOUT' => 'phpBB/ucp.php?mode=logout',
					'U_MCP' => 'phpBB/mcp.php',
					'U_ACP' => 'phpBB/adm/index.php?i=-blitze-sitemaker-acp-dashboard_module',
				),
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 */
	public function test_block_display($user_data, $expected)
	{
		$block = $this->get_block($user_data);
		$result = $block->display(array());

		$this->assertSame($expected, $result['content']);
	}
}
