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
	 * @param bool $user_is_logged_in
	 * @param string $curr_page
	 * @param integer $call_count
	 * @return \blitze\sitemaker\blocks\login
	 */
	protected function get_block($user_is_logged_in = false, $curr_page = '', $call_count = 0)
	{
		global $phpbb_path_helper;

		$this->user->page = array(
			'page_name'	=> $curr_page,
			'page'		=> $curr_page,
		);
		$this->user->data = array(
			'is_registered' => $user_is_logged_in,
		);

		$phpbb_path_helper =  new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			new \phpbb\filesystem(),
			$this->request,
			$this->phpbb_root_path,
			$this->php_ext
		);

		$member_menu = $this->getMockBuilder('\blitze\sitemaker\blocks\member_menu')
			->disableOriginalConstructor()
			->getMock();
		$member_menu->expects($this->any())
			->method('display')
			->willReturn(array(
				'content' => 'Member Menu',
			));

		$this->phpbb_container->set('blitze.sitemaker.block.member_menu', $member_menu);

		$this->template->expects($this->exactly($call_count))
			->method('assign_var')
			->with(
				$this->equalTo('S_USER_LOGGED_IN'),
				$this->equalTo(true)
			);

		$util = $this->getMockBuilder('\blitze\sitemaker\services\util')
			->disableOriginalConstructor()
			->getMock();
		$util->expects($this->any())
			->method('get_form_key')
			->will($this->returnCallback(function($form) {
				return $form . ' token';
			}));

		$block = new login($this->phpbb_container, $this->template, $this->user, $util, $this->phpbb_root_path, $this->php_ext);
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
				1,
				array(
					'S_SHOW_HIDE_ME' => true,
					'S_AUTOLOGIN_ENABLED' => true,
					'S_FORM_TOKEN' => 'login token',
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
				0,
				array(
					'S_SHOW_HIDE_ME' => false,
					'S_AUTOLOGIN_ENABLED' => false,
					'S_FORM_TOKEN' => 'login token',
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
				0,
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
				0,
				'Member Menu',
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 * @param array $bdata
	 * @param bool $user_is_logged_in
	 * @param string $curr_page
	 * @param mixed $expected
	 */
	public function test_block_display(array $bdata, $user_is_logged_in, $curr_page, $call_count, $expected)
	{
		$block = $this->get_block($user_is_logged_in, $curr_page, $call_count);
		$result = $block->display($bdata);

		$this->assertSame($expected, $result['content']);
	}
}
