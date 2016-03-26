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
use blitze\sitemaker\services\forum\data;

class member_menu_test extends blocks_base
{
	/**
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/forum.xml');
	}

	/**
	 * Create the member menu block
	 *
	 * @param array $user_data
	 * @return \blitze\sitemaker\blocks\member_menu
	 */
	protected function get_block($user_data = array())
	{
		global $auth, $phpbb_dispatcher, $phpbb_path_helper, $user, $phpbb_root_path, $phpEx;

		$config = new \phpbb\config\config(array('load_db_lastread' => true));
		$db = $this->new_dbal();
		$request = $this->getMock('\phpbb\request\request');

		$user = new \phpbb\user('\phpbb\datetime');
		$user->timezone = new \DateTimeZone('UTC');
		$user->lang['datetime'] =  array();
		$user->data = $user_data;

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$auth = $this->getMock('\phpbb\auth\auth');
		$auth->expects($this->any())
			->method('acl_get')
			->with($this->stringContains('_'), $this->anything())
			->willReturn(true);
		$auth->expects($this->any())
			->method('acl_getf')
			->will($this->returnCallback(function($acl, $test) {
				$ids = array();
				if ($acl == '!f_read' && $test)
				{
					$ids = array(5 => 5);
				}

				return $ids;
			}));

		$phpbb_path_helper =  new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			new \phpbb\filesystem(),
			$request,
			$phpbb_root_path,
			$phpEx
		);

		$content_visibility = new \phpbb\content_visibility($auth, $config, $phpbb_dispatcher, $db, $user, $phpbb_root_path, $phpEx, 'phpbb_forums', 'phpbb_posts', 'phbb_topics', 'phpbb_users');

		$forum_data = new data($auth, $config, $content_visibility, $db, $user, $phpbb_root_path, $phpEx, 0);

		$block = new member_menu($auth, $user, $forum_data, $phpbb_root_path, $phpEx);
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
					'user_id'		=> 1,
					'username'		=> 'anonymous',
					'is_registered' => false,
					'user_lastvisit' => 0,
					'user_posts'	=> 0,
				),
				'',
			),
			array(
				array(
					'user_id'		=> 48,
					'username'		=> 'demo',
					'is_registered' => true,
					'user_lastvisit' => strtotime('24 November 2015'),
					'user_posts'	=> 5,
				),
				array(
					'USER_AVATAR' => '',
					'USERNAME' => '<span class="username">demo</span>',
					'USERNAME_FULL' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=48" class="username">demo</a>',
					'USER_POSTS' => 5,
					'NEW_POSTS' => 8,
					'U_PROFILE' => 'phpBB/memberlist.php?mode=viewprofile&amp;u=48',
					'U_SEARCH_NEW' => 'phpBB/search.php?search_id=newposts',
					'U_SEARCH_SELF' => 'phpBB/search.php?search_id=egosearch',
					'U_PRIVATE_MSG' => 'phpBB/ucp.php?i=pm&amp;folder=inbox',
					'U_LOGOUT' => 'phpBB/ucp.php?mode=logout',
					'U_MCP' => 'phpBB/mcp.php',
					'U_ACP' => 'phpBB/adm/index.php?i=-blitze-sitemaker-acp-menu_module',
				),
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 * @param array $user_data
	 * @param mixed $expected
	 */
	public function test_block_display(array $user_data, $expected)
	{
		$block = $this->get_block($user_data);
		$result = $block->display(array());

		$this->assertSame($expected, $result['content']);
	}
}
