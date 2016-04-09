<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use blitze\sitemaker\blocks\featured_member;

class featured_member_test extends blocks_base
{
	/**
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/featured_member.xml');
	}

	/**
	 * Create the forum topics block
	 *
	 * @return \blitze\sitemaker\blocks\forum_topics
	 */
	protected function get_block()
	{
		global $cache;

		$cache = $this->getMockBuilder('\phpbb\cache\service')
			->disableOriginalConstructor()
			->getMock();
		$cache->expects($this->any())
			->method('obtain_ranks')
			->willReturn(array(
				'special' => array(
					1 => array(
						'rank_id' => 1,
						'rank_title' => 'Site Admin',
						'rank_special' => 1,
						'rank_image' => '',
					),
				),
			));

		$this->config['allow_privmsg'] = 1;
		$this->config['num_posts'] = 8;
		$this->config['jab_enable'] = 1;
		$this->config['allow_privmsg'] = 1;

		$this->auth->expects($this->any())
			->method('acl_get_list')
			->willReturn(array(
				array(
					'u_readpm' => array(2),
				),
			));

		$block = new featured_member($this->cache, $this->db, $this->translator, $this->user_data, 'phpbb_sm_blocks', 0);
		$block->set_template($this->ptemplate);

		return $block;
	}

	public function test_block_config()
	{
		$block = $this->get_block();
		$config = $block->get_config(array());

		$expected_keys = array(
			'legend1',
			'qtype',
			'rotation',
			'userlist',
			'legend2',
			'show_cpf',
			'last_changed',
			'current_user',
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
						'qtype' => 'recent',
						'rotation' => 'pageload',
						'userlist' => '',
						'show_cpf' => array('phpbb_location', 'phpbb_website'),
						'last_changed' => 0,
						'current_user' => 0,
					),
				),
				'RECENT_MEMBER',
				array(
					'QTYPE_EXPLAIN' => 'QTYPE_RECENT',
					'TITLE_EXPLAIN' => '',
					'contact_field' => array(
						'email' => array(
							'ID' => 'email',
							'NAME' => 'Send email',
							'U_CONTACT' => 'mailto:',
						),
					),
					'profile_field' => array(),
					'AVATAR' => '',
					'USERNAME' => 'demo',
					'USERNAME_FULL' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=48" class="username">demo</a>',
					'JOINED' => '25 Nov 2015',
					'VISITED' => '05 Dec 2015',
					'POSTS' => '1',
					'POSTS_PCT' => '12.50% of all posts',
					'CONTACT_USER' => 'Contact demo',
					'U_SEARCH_POSTS' => 'phpBB/search.php?author_id=48&amp;sr=posts',
					'U_VIEWPROFILE' => 'phpBB/memberlist.php?mode=viewprofile&amp;u=48',
					'RANK_TITLE' => '',
					'RANK_IMAGE' => '',
					'RANK_IMAGE_SRC' => '',
				),
				0,
			),
			array(
				array(
					'settings' => array(
						'qtype' => 'posts',
						'rotation' => 'hourly',
						'userlist' => '',
						'show_cpf' => array('phpbb_location', 'phpbb_website'),
						'last_changed' => 0,
						'current_user' => 0,
					),
				),
				'POSTS_MEMBER',
				array(
					'QTYPE_EXPLAIN' => 'QTYPE_POSTS',
					'TITLE_EXPLAIN' => 'HOURLY_MEMBER',
					'contact_field' => array(
						'pm' => array(
							'ID' => 'pm',
							'NAME' => 'Send private message',
							'U_CONTACT' => 'phpBB/ucp.php?i=pm&amp;mode=compose&amp;u=2',
						),
						'email' => array(
							'ID' => 'email',
							'NAME' => 'Send email',
							'U_CONTACT' => 'mailto:',
						),
						'jabber' => array(
							'ID' => 'jabber',
							'NAME' => 'Jabber',
							'U_CONTACT' => 'phpBB/memberlist.php?mode=contact&amp;action=jabber&amp;u=2',
						),
						'phpbb_website' => array(
							'ID' => 'phpbb_website',
							'NAME' => 'Website',
							'U_CONTACT' => 'http://www.my-website.com',
						),
					),
					'profile_field' => array(
						'phpbb_location' => array(
							'PROFILE_FIELD_IDENT' => 'phpbb_location',
							'PROFILE_FIELD_VALUE' => 'testing',
							'PROFILE_FIELD_VALUE_RAW' => 'testing',
							'PROFILE_FIELD_CONTACT' => '',
							'PROFILE_FIELD_DESC' => '',
							'PROFILE_FIELD_TYPE' => 'profilefields.type.string',
							'PROFILE_FIELD_NAME' => 'Location',
							'PROFILE_FIELD_EXPLAIN' => '',
							'S_PROFILE_CONTACT' => '0',
							'S_PROFILE_PHPBB_LOCATION' => true,
						),
					),
					'AVATAR' => '',
					'USERNAME' => 'admin',
					'USERNAME_FULL' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=2" class="username">admin</a>',
					'JOINED' => '24 Nov 2015',
					'VISITED' => '05 Dec 2015',
					'POSTS' => '7',
					'POSTS_PCT' => '87.50% of all posts',
					'CONTACT_USER' => 'Contact admin',
					'U_SEARCH_POSTS' => 'phpBB/search.php?author_id=2&amp;sr=posts',
					'U_VIEWPROFILE' => 'phpBB/memberlist.php?mode=viewprofile&amp;u=2',
					'RANK_TITLE' => 'Site Admin',
					'RANK_IMAGE' => '',
					'RANK_IMAGE_SRC' => '',
				),
				0,
			),
			array(
				array(
					'settings' => array(
						'qtype' => 'featured',
						'rotation' => 'hourly',
						'userlist' => '2',
						'show_cpf' => array(),
						'last_changed' => strtotime('-30 minutes'),
						'current_user' => 2,
					),
				),
				'FEATURED_MEMBER',
				array(
					'QTYPE_EXPLAIN' => '',
					'TITLE_EXPLAIN' => 'HOURLY_MEMBER',
					'contact_field' => array(
						'pm' => array(
							'ID' => 'pm',
							'NAME' => 'Send private message',
							'U_CONTACT' => 'phpBB/ucp.php?i=pm&amp;mode=compose&amp;u=2',
						),
						'email' => array(
							'ID' => 'email',
							'NAME' => 'Send email',
							'U_CONTACT' => 'mailto:',
						),
						'jabber' => array(
							'ID' => 'jabber',
							'NAME' => 'Jabber',
							'U_CONTACT' => 'phpBB/memberlist.php?mode=contact&amp;action=jabber&amp;u=2',
						),
					),
					'profile_field' => array(),
					'AVATAR' => '',
					'USERNAME' => 'admin',
					'USERNAME_FULL' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=2" class="username">admin</a>',
					'JOINED' => '24 Nov 2015',
					'VISITED' => '05 Dec 2015',
					'POSTS' => '7',
					'POSTS_PCT' => '87.50% of all posts',
					'CONTACT_USER' => 'Contact admin',
					'U_SEARCH_POSTS' => 'phpBB/search.php?author_id=2&amp;sr=posts',
					'U_VIEWPROFILE' => 'phpBB/memberlist.php?mode=viewprofile&amp;u=2',
					'RANK_TITLE' => 'Site Admin',
					'RANK_IMAGE' => '',
					'RANK_IMAGE_SRC' => '',
				),
				null, // no update to db
			),
			array(
				array(
					'settings' => array(
						'qtype' => 'featured',
						'rotation' => 'pageload',
						'userlist' => '2,48',
						'show_cpf' => array(),
						'last_changed' => 0,
						'current_user' => 0,
					),
				),
				'FEATURED_MEMBER',
				array(
					'QTYPE_EXPLAIN' => '',
					'TITLE_EXPLAIN' => '',
					'contact_field' => array(
						'pm' => array(
							'ID' => 'pm',
							'NAME' => 'Send private message',
							'U_CONTACT' => 'phpBB/ucp.php?i=pm&amp;mode=compose&amp;u=2',
						),
						'email' => array(
							'ID' => 'email',
							'NAME' => 'Send email',
							'U_CONTACT' => 'mailto:',
						),
						'jabber' => array(
							'ID' => 'jabber',
							'NAME' => 'Jabber',
							'U_CONTACT' => 'phpBB/memberlist.php?mode=contact&amp;action=jabber&amp;u=2',
						),
					),
					'profile_field' => array(),
					'AVATAR' => '',
					'USERNAME' => 'admin',
					'USERNAME_FULL' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=2" class="username">admin</a>',
					'JOINED' => '24 Nov 2015',
					'VISITED' => '05 Dec 2015',
					'POSTS' => '7',
					'POSTS_PCT' => '87.50% of all posts',
					'CONTACT_USER' => 'Contact admin',
					'U_SEARCH_POSTS' => 'phpBB/search.php?author_id=2&amp;sr=posts',
					'U_VIEWPROFILE' => 'phpBB/memberlist.php?mode=viewprofile&amp;u=2',
					'RANK_TITLE' => 'Site Admin',
					'RANK_IMAGE' => '',
					'RANK_IMAGE_SRC' => '',
				),
				2,
			),
			array(
				array(
					'settings' => array(
						'qtype' => 'featured',
						'rotation' => 'hourly',
						'userlist' => '2,48',
						'show_cpf' => array(),
						'last_changed' => strtotime('-2 hours'),
						'current_user' => 2,
					),
				),
				'FEATURED_MEMBER',
				array(
					'QTYPE_EXPLAIN' => '',
					'TITLE_EXPLAIN' => 'HOURLY_MEMBER',
					'contact_field' => array(
						'email' => array(
							'ID' => 'email',
							'NAME' => 'Send email',
							'U_CONTACT' => 'mailto:',
						),
					),
					'profile_field' => array(),
					'AVATAR' => '',
					'USERNAME' => 'demo',
					'USERNAME_FULL' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=48" class="username">demo</a>',
					'JOINED' => '25 Nov 2015',
					'VISITED' => '05 Dec 2015',
					'POSTS' => '1',
					'POSTS_PCT' => '12.50% of all posts',
					'CONTACT_USER' => 'Contact demo',
					'U_SEARCH_POSTS' => 'phpBB/search.php?author_id=48&amp;sr=posts',
					'U_VIEWPROFILE' => 'phpBB/memberlist.php?mode=viewprofile&amp;u=48',
					'RANK_TITLE' => '',
					'RANK_IMAGE' => '',
					'RANK_IMAGE_SRC' => '',
				),
				48,
			),
			array(
				array(
					'settings' => array(
						'qtype' => 'featured',
						'rotation' => 'hourly',
						'userlist' => '2,48',
						'show_cpf' => array(),
						'last_changed' => strtotime('-2 hours'),
						'current_user' => 48,
					),
				),
				'FEATURED_MEMBER',
				array(
					'QTYPE_EXPLAIN' => '',
					'TITLE_EXPLAIN' => 'HOURLY_MEMBER',
					'contact_field' => array(
						'pm' => array(
							'ID' => 'pm',
							'NAME' => 'Send private message',
							'U_CONTACT' => 'phpBB/ucp.php?i=pm&amp;mode=compose&amp;u=2',
						),
						'email' => array(
							'ID' => 'email',
							'NAME' => 'Send email',
							'U_CONTACT' => 'mailto:',
						),
						'jabber' => array(
							'ID' => 'jabber',
							'NAME' => 'Jabber',
							'U_CONTACT' => 'phpBB/memberlist.php?mode=contact&amp;action=jabber&amp;u=2',
						),
					),
					'profile_field' => array(),
					'AVATAR' => '',
					'USERNAME' => 'admin',
					'USERNAME_FULL' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=2" class="username">admin</a>',
					'JOINED' => '24 Nov 2015',
					'VISITED' => '05 Dec 2015',
					'POSTS' => '7',
					'POSTS_PCT' => '87.50% of all posts',
					'CONTACT_USER' => 'Contact admin',
					'U_SEARCH_POSTS' => 'phpBB/search.php?author_id=2&amp;sr=posts',
					'U_VIEWPROFILE' => 'phpBB/memberlist.php?mode=viewprofile&amp;u=2',
					'RANK_TITLE' => 'Site Admin',
					'RANK_IMAGE' => '',
					'RANK_IMAGE_SRC' => '',
				),
				2,
			),
		);
	}

	/**
	 * Test block display
	 * @dataProvider block_test_data
	 * @param array $bdata
	 * @param string $title
	 * @param array $user_data
	 * @param mixed $current_user
	 */
	public function test_block_display(array $bdata, $title, array $user_data, $current_user)
	{
		$bdata['bid'] = 1;

		$block = $this->get_block();
		$result = $block->display($bdata);

		$this->assertEquals($title, $result['title']);
		$this->assertEquals($user_data, $result['content']);

		$this->db->sql_query('SELECT settings FROM phpbb_sm_blocks WHERE bid = 1');
		$settings = json_decode($this->db->sql_fetchfield('settings'), true);
		$this->db->sql_freeresult();

		$this->assertEquals($current_user, $settings['current_user']);
	}

	/**
	 * Data set for test_invalid_user_in_userlist
	 *
	 * @return array
	 */
	public function invalid_user_test_data()
	{
		return array(
			array(
				array(
					'settings' => array(
						'qtype' => 'featured',
						'rotation' => 'pageload',
						'userlist' => '1,3,48',
						'show_cpf' => array(),
						'last_changed' => 0,
						'current_user' => 0,
					),
				),
				array(
					'USERNAME' => 'demo',
					'USERNAME_FULL' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=48" class="username">demo</a>',
					'JOINED' => '25 Nov 2015',
					'VISITED' => '05 Dec 2015',
					'POSTS' => '1',
					'POSTS_PCT' => '12.50% of all posts',
					'CONTACT_USER' => 'Contact demo',
					'U_SEARCH_POSTS' => 'phpBB/search.php?author_id=48&amp;sr=posts',
					'U_VIEWPROFILE' => 'phpBB/memberlist.php?mode=viewprofile&amp;u=48',
					'contact_field' => array(
						'email' => array(
							'ID' => 'email',
							'NAME' => 'Send email',
							'U_CONTACT' => 'mailto:',
						),
					),
				),
				48,
			),
			array(
				array(
					'settings' => array(
						'qtype' => 'featured',
						'rotation' => 'hourly',
						'userlist' => '48,2,1,3',
						'show_cpf' => array(),
						'last_changed' => strtotime('-2 hours'),
						'current_user' => 2,
					),
				),
				array(
					'TITLE_EXPLAIN' => 'HOURLY_MEMBER',
					'USERNAME' => 'demo',
					'USERNAME_FULL' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=48" class="username">demo</a>',
					'JOINED' => '25 Nov 2015',
					'VISITED' => '05 Dec 2015',
					'POSTS' => '1',
					'POSTS_PCT' => '12.50% of all posts',
					'CONTACT_USER' => 'Contact demo',
					'U_SEARCH_POSTS' => 'phpBB/search.php?author_id=48&amp;sr=posts',
					'U_VIEWPROFILE' => 'phpBB/memberlist.php?mode=viewprofile&amp;u=48',
					'contact_field' => array(
						'email' => array(
							'ID' => 'email',
							'NAME' => 'Send email',
							'U_CONTACT' => 'mailto:',
						),
					),
				),
				'48,2',
			),
			array(
				array(
					'settings' => array(
						'qtype' => 'featured',
						'rotation' => 'pageload',
						'userlist' => '58, 59, 60,61,65, 70, 2',
						'show_cpf' => array(),
						'last_changed' => 0,
						'current_user' => 0,
					),
				),
				'',
				'65, 70, 2',
			),
		);
	}

	/**
	 * Test invalid user in userlist for featured user mode
	 *
	 * @dataProvider invalid_user_test_data
	 * @param array $bdata
	 * @param mixed $block_content
	 * @param string $userlist
	 */
	public function test_invalid_user_in_userlist(array $bdata, $block_content, $userlist)
	{
		$bdata['bid'] = 1;

		$block = $this->get_block();
		$result = $block->display($bdata);

		$actual = is_array($result['content']) ? array_filter($result['content']) : $result['content'];
		$this->assertEquals($block_content, $actual);

		$this->db->sql_query('SELECT settings FROM phpbb_sm_blocks WHERE bid = 1');
		$settings = json_decode($this->db->sql_fetchfield('settings'), true);
		$this->db->sql_freeresult();

		$this->assertEquals($userlist, $settings['userlist']);
	}

	/**
	 * Test invalid query type
	 */
	public function test_invalid_qtype()
	{
		$expected = array(
			'title'		=> 'FEATURED_MEMBER',
			'content'	=> '',
		);

		$block = $this->get_block();
		$result = $block->display(array(
			array(
				'settings' => array(
					'qtype' => 'invalid',
					'rotation' => 'pageload',
					'userlist' => '',
					'show_cpf' => array(),
					'last_changed' => 0,
					'current_user' => 0,
				),
			),
		));

		$this->assertEquals($expected, $result);
	}
}
