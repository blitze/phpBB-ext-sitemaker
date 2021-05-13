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
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/whois.xml');
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
		$this->auth->expects($this->any())
			->method('acl_get')
			->with('u_viewprofile')
			->willReturn($authed);

		$this->config['record_online_users'] = 3;
		$this->config['record_online_date'] = strtotime('7 December 2015');
		$this->config['legend_sort_groupname'] = $authed ? 'group_name' : 'group_legend';

		$group_helper = $this->getMockBuilder('\phpbb\group\helper')
			->disableOriginalConstructor()
			->getMock();
		$group_helper->expects($this->any())
			->method('get_name')
			->willReturnCallback(function ($group_name)
			{
				return $group_name;
			});

		$translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function ()
			{
				return implode(': ', array_filter(func_get_args()));
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
			->with(array('TOTAL_USERS_ONLINE', 'LOGGED_IN_USER_LIST', 'RECORD_USERS', 'LEGEND'))
			->willReturnCallback(function () use ($authed, $current_page)
			{
				if (strpos($current_page, 'f=') !== false)
				{
					$legend = $authed
						? '<a href="#">Administrators</a><a href="#">Moderators</a>'
						: '<span>Administrators</span><span>Moderators</span>';
					return array(
						'TOTAL_USERS_ONLINE' => 'In total there is 1 user online :: 2 registered, 0 hidden and 0 guests',
						'LOGGED_IN_USER_LIST' => 'Users browsing this forum: demo and 0 guests',
						'RECORD_USERS' => 'Most users ever online was 2 on Tue Nov 24, 2015 4:49 pm',
						'LEGEND' => $legend,
					);
				}
				return [];
			});

		$user = $this->getMockBuilder('\phpbb\user', array(), array($translator, '\phpbb\datetime'))
			->disableOriginalConstructor()
			->getMock();
		$user->data['user_id'] = $authed ? 2 : 1;
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

		return new whois($this->auth, $this->config, $this->db, $group_helper, $translator, $template, $user, $this->phpbb_root_path, $this->php_ext);
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
					'LEGEND' => '<a style="color:#AA0000" href="phpBB/memberlist.php?mode=group&amp;g=5">ADMINISTRATORS</a>COMMA_SEPARATOR<span style="color:#9E8DA7">BOTS</span>COMMA_SEPARATOR<a style="color:#00AA00" href="phpBB/memberlist.php?mode=group&amp;g=4">GLOBAL_MODERATORS</a>',
					'U_VIEWONLINE' => '',
				),
			),
			array(
				true,
				'index.php',
				array(
					'TOTAL_USERS_ONLINE' => 'ONLINE_USERS_TOTAL: 0',
					'LOGGED_IN_USER_LIST' => 'REGISTERED_USERS NO_ONLINE_USERS',
					'RECORD_USERS' => 'RECORD_ONLINE_USERS: 3',
					'LEGEND' => '<a style="color:#AA0000" href="phpBB/memberlist.php?mode=group&amp;g=5">ADMINISTRATORS</a>COMMA_SEPARATOR<span style="color:#9E8DA7">BOTS</span>COMMA_SEPARATOR<a style="color:#00AA00" href="phpBB/memberlist.php?mode=group&amp;g=4">GLOBAL_MODERATORS</a>COMMA_SEPARATOR<a style="color:#eee" href="phpBB/memberlist.php?mode=group&amp;g=7">custom</a>',
					'U_VIEWONLINE' => 'phpBB/viewonline.php',
				),
			),
			array(
				true,
				'viewtopic.php?f=2&t=1',
				array(
					'TOTAL_USERS_ONLINE' => 'In total there is 1 user online :: 2 registered, 0 hidden and 0 guests',
					'LOGGED_IN_USER_LIST' => 'Users browsing this forum: demo and 0 guests',
					'RECORD_USERS' => 'Most users ever online was 2 on Tue Nov 24, 2015 4:49 pm',
					'LEGEND' => '<a href="#">Administrators</a><a href="#">Moderators</a>',
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
