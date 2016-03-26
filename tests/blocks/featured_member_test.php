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
use blitze\sitemaker\services\profilefields;

class featured_member_test extends blocks_base
{
	protected $db;

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
		global $auth, $cache, $db, $phpbb_dispatcher, $request, $user, $phpbb_root_path, $phpEx;

		$auth = $this->getMock('\phpbb\auth\auth');
		$cache_interface = new \phpbb_mock_cache();
		$this->db = $db = $this->new_dbal();
		$request = $this->getMock('\phpbb\request\request');
		$template = $this->getMock('\phpbb\template\template');

		$config = new \phpbb\config\config(array('num_posts' => 8));
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$user = $this->getMock('\phpbb\user', array(), array('\phpbb\datetime'));
		$user->timezone = new \DateTimeZone('UTC');
		$user->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode(' ', func_get_args());
			});
		$user->expects($this->any())
			->method('get_iso_lang_id')
			->willReturn(1);
		$user->lang['datetime'] =  array(
			'TODAY'		=> 'Today',
			'TOMORROW'	=> 'Tomorrow',
			'YESTERDAY'	=> 'Yesterday',
		);

		$cp_type_string = new \phpbb\profilefields\type\type_string($request, $template, $user);
		$cp_type_url = new \phpbb\profilefields\type\type_text($request, $template, $user);

		$phpbb_container = new \phpbb_mock_container_builder();
		$phpbb_container->set('profilefields.type.string', $cp_type_string);
		$phpbb_container->set('profilefields.type.url', $cp_type_url);

		$cp_types_collection = new \phpbb\di\service_collection($phpbb_container);

		$cpf_manager = new \phpbb\profilefields\manager($auth, $db, $phpbb_dispatcher, $request, $template, $cp_types_collection, $user, 'phpbb_profile_fields', 'phpbb_profile_lang', 'phpbb_profile_fields_data');

		$profilefields = new profilefields($db, $cpf_manager, $user, $phpbb_root_path, $phpEx);

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

		$block = new featured_member($cache_interface, $config, $db, $user, $profilefields, $phpbb_root_path, $phpEx, 'phpbb_sm_blocks', 0);
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
						'show_cpf' => array(),
						'last_changed' => 0,
						'current_user' => 0,
					),
				),
				'RECENT_MEMBER',
				array(
					'QTYPE_EXPLAIN' => 'QTYPE_RECENT',
					'USERNAME' => 'demo',
					'POSTS_PCT' => 'POST_PCT',
					'L_VIEW_PROFILE' => 'VIEW_USER_PROFILE',
					'POSTS' => '1',
					'U_SEARCH_USER' => 'phpBB/search.php?author_id=48&amp;sr=posts',
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
					'USERNAME' => 'admin',
					'POSTS_PCT' => 'POST_PCT',
					'L_VIEW_PROFILE' => 'VIEW_USER_PROFILE',
					'POSTS' => '7',
					'RANK_TITLE' => 'Site Admin',
					'U_SEARCH_USER' => 'phpBB/search.php?author_id=2&amp;sr=posts',
					'PROFILE_PHPBB_WEBSITE_IDENT' => 'phpbb_website',
					'PROFILE_PHPBB_WEBSITE_VALUE' => '<!-- l --><a class="postlink-local" href="http://www.my-website.com"><!-- w --><a class="postlink" href="http://www.my-website.com">www.my-website.com</a><!-- w --></a><!-- l -->',
					'PROFILE_PHPBB_WEBSITE_VALUE_RAW' => 'http://www.my-website.com',
					'PROFILE_PHPBB_WEBSITE_TYPE' => 'profilefields.type.url',
					'PROFILE_PHPBB_WEBSITE_NAME' => 'WEBSITE',
					'S_PROFILE_PHPBB_WEBSITE' => true,
					'custom_fields' => array(
						array(
							'PROFILE_FIELD_IDENT' => 'phpbb_website',
							'PROFILE_FIELD_VALUE_RAW' => 'http://www.my-website.com',
							'PROFILE_FIELD_CONTACT' => '',
							'PROFILE_FIELD_DESC' => '',
							'PROFILE_FIELD_TYPE' => 'profilefields.type.url',
							'PROFILE_FIELD_NAME' => 'WEBSITE',
							'PROFILE_FIELD_EXPLAIN' => '',
							'S_PROFILE_CONTACT' => '0',
							'S_PROFILE_PHPBB_WEBSITE' => true,
							'PROFILE_FIELD_VALUE' => '<!-- l --><a class="postlink-local" href="http://www.my-website.com"><!-- w --><a class="postlink" href="http://www.my-website.com">www.my-website.com</a><!-- w --></a><!-- l -->',
						),
					),
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
					'USERNAME' => 'admin',
					'POSTS_PCT' => 'POST_PCT',
					'L_VIEW_PROFILE' => 'VIEW_USER_PROFILE',
					'POSTS' => '7',
					'U_SEARCH_USER' => 'phpBB/search.php?author_id=2&amp;sr=posts',
					'RANK_TITLE' => 'Site Admin',
					'TITLE_EXPLAIN' => 'HOURLY_MEMBER',
				),
				2,
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
					'USERNAME' => 'admin',
					'POSTS_PCT' => 'POST_PCT',
					'L_VIEW_PROFILE' => 'VIEW_USER_PROFILE',
					'POSTS' => '7',
					'U_SEARCH_USER' => 'phpBB/search.php?author_id=2&amp;sr=posts',
					'RANK_TITLE' => 'Site Admin',
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
					'USERNAME' => 'demo',
					'POSTS_PCT' => 'POST_PCT',
					'L_VIEW_PROFILE' => 'VIEW_USER_PROFILE',
					'POSTS' => '1',
					'U_SEARCH_USER' => 'phpBB/search.php?author_id=48&amp;sr=posts',
					'TITLE_EXPLAIN' => 'HOURLY_MEMBER',
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
					'USERNAME' => 'admin',
					'POSTS_PCT' => 'POST_PCT',
					'L_VIEW_PROFILE' => 'VIEW_USER_PROFILE',
					'POSTS' => '7',
					'U_SEARCH_USER' => 'phpBB/search.php?author_id=2&amp;sr=posts',
					'RANK_TITLE' => 'Site Admin',
					'TITLE_EXPLAIN' => 'HOURLY_MEMBER',
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
		$block = $this->get_block();
		$result = $block->display($bdata);

		$this->assertEquals($title, $result['title']);
		$this->assertEquals($user_data, array_filter($result['content']));

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
					'POSTS_PCT' => 'POST_PCT',
					'L_VIEW_PROFILE' => 'VIEW_USER_PROFILE',
					'POSTS' => '1',
					'U_SEARCH_USER' => 'phpBB/search.php?author_id=48&amp;sr=posts',
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
					'USERNAME' => 'demo',
					'POSTS_PCT' => 'POST_PCT',
					'L_VIEW_PROFILE' => 'VIEW_USER_PROFILE',
					'POSTS' => '1',
					'U_SEARCH_USER' => 'phpBB/search.php?author_id=48&amp;sr=posts',
					'TITLE_EXPLAIN' => 'HOURLY_MEMBER',
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
