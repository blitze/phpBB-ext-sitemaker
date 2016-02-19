<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use blitze\sitemaker\blocks\login;

class login_test extends blocks_base
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
	 * Create the login block
	 *
	 * @return \blitze\sitemaker\blocks\login
	 */
	protected function get_block($user_is_logged_in = false, $curr_page = '')
	{
		global $user, $phpbb_dispatcher, $phpbb_path_helper, $request, $phpbb_root_path, $phpEx;

		$user = new \phpbb\user('\phpbb\datetime');
		$user->page = array(
			'page_name'	=> $curr_page,
			'page'		=> $curr_page,
		);
		$user->data = array(
			'is_registered' => $user_is_logged_in,
		);

		$request = $this->getMock('\phpbb\request\request');

		$phpbb_path_helper =  new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			new \phpbb\filesystem(),
			$request,
			$phpbb_root_path,
			$phpEx
		);

		$member_menu = $this->getMockBuilder('\blitze\sitemaker\blocks\member_menu')
			->disableOriginalConstructor()
			->getMock();
		$member_menu->expects($this->any())
			->method('display')
			->willReturn(array(
				'content' => 'Member Menu',
			));

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$phpbb_container = new \phpbb_mock_container_builder();
		$phpbb_container->set('blitze.sitemaker.block.member_menu', $member_menu);

		$block = new login($phpbb_container, $user, $phpbb_root_path, $phpEx);
		$block->set_template($this->ptemplate);

		return $block;
	}

	public function test_block_config()
	{
		$block = $this->get_block();
		$config = $block->get_config(array());

		$expected_keys = array(
			'legend1',
			'show_hide_me',
			'allow_autologin',
			'show_member_menu',
		);

		$this->assertEquals($expected_keys, array_keys($config));
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
					'settings' => array(
						'show_hide_me' => 1,
						'allow_autologin' => 1,
						'show_member_menu' => false,
					),
				),
				false,
				'index.php',
				array(
					'S_SHOW_HIDE_ME' => true,
					'S_AUTOLOGIN_ENABLED' => true,
					'S_LOGIN_ACTION' => 'phpBB/ucp.php?mode=login',
					'U_REGISTER' => 'phpBB/ucp.php?mode=register',
					'U_SEND_PASSWORD' => 'phpBB/ucp.php?mode=sendpassword',
					'U_REDIRECT' => 'phpBB/index.php',
				),
			),
			array(
				array(
					'settings' => array(
						'show_hide_me' => 0,
						'allow_autologin' => 0,
						'show_member_menu' => true,
					),
				),
				false,
				'app.php/page/about',
				array(
					'S_SHOW_HIDE_ME' => false,
					'S_AUTOLOGIN_ENABLED' => false,
					'S_LOGIN_ACTION' => 'phpBB/ucp.php?mode=login',
					'U_REGISTER' => 'phpBB/ucp.php?mode=register',
					'U_SEND_PASSWORD' => 'phpBB/ucp.php?mode=sendpassword',
					'U_REDIRECT' => 'phpBB/app.php/page/about',
				),
			),
			array(
				array(
					'settings' => array(
						'show_hide_me' => 1,
						'allow_autologin' => 1,
						'show_member_menu' => false,
					),
				),
				true,
				'index.php',
				'',
			),
			array(
				array(
					'settings' => array(
						'show_hide_me' => 1,
						'allow_autologin' => 1,
						'show_member_menu' => true,
					),
				),
				true,
				'index.php',
				'Member Menu',
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 */
	public function test_block_display($bdata, $user_is_logged_in, $curr_page, $expected)
	{
		$block = $this->get_block($user_is_logged_in, $curr_page);
		$result = $block->display($bdata);

		$this->assertSame($expected, $result['content']);
	}
}
