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
	 * @param bool $authed
	 * @param string $current_page
	 * @param integer $call_count
	 * @return \blitze\sitemaker\blocks\stats
	 */
	protected function get_block($authed = false, $current_page = '', $call_count = 0)
	{
		global $user;

		$this->auth->expects($this->any())
			->method('acl_gets')
			->with($this->stringContains('_'), $this->anything())
			->willReturnCallback(function () use ($authed)
			{
				return ($authed) ? true : false;
			});

		$this->config['record_online_users'] = 3;
		$this->config['record_online_date'] = strtotime('7 December 2015');

		$translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function ($key, $value)
			{
				return $key . ': ' . $value;
			});

		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();
		$template->expects($this->exactly($call_count))
			->method('assign_var')
			->with(
				$this->equalTo('S_DISPLAY_ONLINE_LIST'),
				$this->equalTo(false)
			);
		$template->expects($this->any())
			->method('retrieve_vars')
			->with(array('TOTAL_USERS_ONLINE', 'LOGGED_IN_USER_LIST', 'RECORD_USERS'))
			->willReturnCallback(function () use ($current_page)
			{
				if (strpos($current_page, 'f=') !== false)
				{
					return array(
						'TOTAL_USERS_ONLINE' => 'In total there is 1 user online :: 2 registered, 0 hidden and 0 guests',
						'LOGGED_IN_USER_LIST' => 'Users browsing this forum: demo and 0 guests',
						'RECORD_USERS' => 'Most users ever online was 2 on Tue Nov 24, 2015 4:49 pm',
					);
				}
				return [];
			});

		$user = $this->getMockBuilder('\phpbb\user', array(), array($translator, '\phpbb\datetime'))
			->disableOriginalConstructor()
			->getMock();
		$user->timezone = new \DateTimeZone('UTC');
		$user->expects($this->any())
			->method('lang')
			->willReturnCallback(function ($key, $value)
			{
				return $key . ': ' . $value;
			});
		$user->lang = array(
			'NO_ONLINE_USERS' => 'NO_ONLINE_USERS',
			'REGISTERED_USERS' => 'REGISTERED_USERS',
		);

		return new whois($this->auth, $this->config, $translator, $template, $user, $this->phpbb_root_path, $this->php_ext);
	}

	public function test_block_config()
	{
		$block = $this->get_block();
		$config = $block->get_config(array());

		$this->assertEquals(array(), $config);
	}

	/**
	 * @return void
	 */
	public function test_block_template()
	{
		$block = $this->get_block();

		$this->assertEquals('@blitze_sitemaker/blocks/whois.html', $block->get_template());
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
					'LOGGED_IN_USER_LIST' => 'REGISTERED_USERS NO_ONLINE_USERS',
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
	 * @param bool $authed
	 * @param string $current_page
	 * @param array $expected
	 */
	public function test_block_display($authed, $current_page, array $expected)
	{
		$block = $this->get_block($authed, $current_page, 1);
		$result = $block->display(array());

		$this->assertSame($expected, $result['data']);
	}
}
