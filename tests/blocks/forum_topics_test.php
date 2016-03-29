<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use blitze\sitemaker\services\date_range;
use blitze\sitemaker\services\forum\data;
use blitze\sitemaker\blocks\forum_topics;

class forum_topics_test extends blocks_base
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
	 * Configure the test environment.
	 *
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();
		
		require_once dirname(__FILE__) . '/../../vendor/nickvergessen/phpbb-tool-trimmessage/src/Nickvergessen/TrimMessage/TrimMessage.php';
	}

	/**
	 * Create the forum topics block
	 *
	 * @param bool $registered_user
	 * @return \blitze\sitemaker\blocks\forum_topics
	 */
	protected function get_block($registered_user = true)
	{
		global $auth, $cache, $db, $phpbb_dispatcher, $request, $user, $phpbb_root_path, $phpEx;

		$cache = new \phpbb_mock_cache();
		$config = new \phpbb\config\config(array(
			'load_db_lastread' => true,
			'load_anon_lastread' => true,
		));
		$db = $this->new_dbal();
		$request = $this->getMock('\phpbb\request\request_interface');

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$translator = new \phpbb\language\language($lang_loader);

		$user = new \phpbb\user($translator, '\phpbb\datetime');
		$user->timezone = new \DateTimeZone('UTC');
		$user->data = array(
			'user_id'		=> 48,
			'user_lastmark'	=> strtotime('25 Nov 2015'),
			'user_lang'		=> 'en',
			'is_registered'	=> $registered_user,
		);

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$auth = $this->getMockBuilder('\phpbb\auth\auth')
			->disableOriginalConstructor()
			->getMock();
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

		$content_visibility = new \phpbb\content_visibility($auth, $config, $phpbb_dispatcher, $db, $user, $phpbb_root_path, $phpEx, 'phpbb_forums', 'phpbb_posts', 'phbb_topics', 'phpbb_users');

		$date_range = new date_range($user, '24 November 2015');

		$forum_data = new data($auth, $config, $content_visibility, $db, $translator, $user, $phpbb_root_path, $phpEx, 0);

		$forum_options = $this->getMockBuilder('\blitze\sitemaker\services\forum\options')
			->disableOriginalConstructor()
			->getMock();

		$block = new forum_topics($auth, $content_visibility, $translator, $user, $date_range, $forum_data, $forum_options, $phpbb_root_path, $phpEx);
		$block->set_template($this->ptemplate);

		return $block;
	}

	public function test_block_config()
	{
		$block = $this->get_block();
		$config = $block->get_config(array());

		$expected_keys = array(
			'legend1',
			'forum_ids',
			'topic_type',
			'max_topics',
			'date_range',
			'order_by',
			'legend2',
			'enable_tracking',
			'topic_title_limit',
			'template',
			'display_preview',
			'preview_max_chars'
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
						'forum_ids'			=> array(),
						'topic_type'		=> array(),
						'max_topics'		=> 2,
						'date_range'		=> '',
						'order_by'			=> 0,
						'enable_tracking'	=> 1,
						'topic_title_limit'	=> 25,
						'template'			=> 'titles',
						'display_preview'	=> 'first',
						'preview_max_chars'	=> 125,
					),
				),
				true,
				'FORUM_RECENT_TOPICS',
				array(
					array(
						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Topic with poll',
						'TOPIC_AUTHOR' => '<span class="username">admin</span>',
						'TOPIC_PREVIEW' => 'This topic has a poll',
						'TOPIC_POST_TIME' => '',
						'ATTACH_ICON_IMG' => '',
						'REPLIES' => 0,
						'VIEWS' => '0',
						'S_UNREAD_TOPIC' => true,
						'U_VIEWFORUM' => 'phpBB/viewforum.php?f=4',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=4&amp;t=9',
						'U_NEW_POST' => 'phpBB/viewtopic.php?f=4&amp;t=9&amp;view=unread#unread',
						'U_LAST_POST' => 'phpBB/viewtopic.php?f=4&amp;t=9&amp;p=12#p12',
					),
					array(
						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Global Topic',
						'TOPIC_AUTHOR' => '<span class="username">admin</span>',
						'TOPIC_PREVIEW' => 'This is a global topic',
						'TOPIC_POST_TIME' => '',
						'ATTACH_ICON_IMG' => '',
						'REPLIES' => 0,
						'VIEWS' => '0',
						'S_UNREAD_TOPIC' => false,
						'U_VIEWFORUM' => 'phpBB/viewforum.php?f=4',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=4&amp;t=4',
						'U_NEW_POST' => 'phpBB/viewtopic.php?f=4&amp;t=4&amp;view=unread#unread',
						'U_LAST_POST' => 'phpBB/viewtopic.php?f=4&amp;t=4&amp;p=4#p4',
					),
				),
			),
			array(
				array(
					'settings' => array(
						'forum_ids'			=> array(4, 5),
						'topic_type'		=> array(),
						'max_topics'		=> 1,
						'date_range'		=> '',
						'order_by'			=> 1,
						'enable_tracking'	=> 1,
						'topic_title_limit'	=> 10,
						'template'			=> 'context',
						'display_preview'	=> 'last',
						'preview_max_chars'	=> 20,
					),
				),
				true,
				'FORUM_RECENT_TOPICS',
				array(
					array(
						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Topic w...',
						'TOPIC_AUTHOR' => '<span class="username">admin</span>',
						'TOPIC_PREVIEW' => 'This topic has a poll',
						'TOPIC_POST_TIME' => '',
						'ATTACH_ICON_IMG' => '',
						'REPLIES' => 0,
						'VIEWS' => '0',
						'S_UNREAD_TOPIC' => true,
						'U_VIEWFORUM' => 'phpBB/viewforum.php?f=4',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=4&amp;t=9',
						'U_NEW_POST' => 'phpBB/viewtopic.php?f=4&amp;t=9&amp;view=unread#unread',
						'U_LAST_POST' => 'phpBB/viewtopic.php?f=4&amp;t=9&amp;p=12#p12',
					),
				),
			),
			array(
				array(
					'settings' => array(
						'forum_ids'			=> array(),
						'topic_type'		=> array(3),
						'max_topics'		=> 1,
						'date_range'		=> '',
						'order_by'			=> 2,
						'enable_tracking'	=> 1,
						'topic_title_limit'	=> 25,
						'template'			=> 'mini',
						'display_preview'	=> 'first',
						'preview_max_chars'	=> 125,
					),
				),
				true,
				'TOPICS_LAST_READ',
				array(
					array(
						'TOPIC_PREVIEW' => 'This is a global topic',
						'S_UNREAD_TOPIC' => false,
						'TOPIC_AUTHOR' => '<span class="username">admin</span>',
						'TOPIC_POST_TIME' => '',
						'ATTACH_ICON_IMG' => '',
						'REPLIES' => 0,
						'VIEWS' => '0',
						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Global Topic',
						'U_VIEWFORUM' => 'phpBB/viewforum.php?f=4',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=4&amp;t=4',
						'U_NEW_POST' => 'phpBB/viewtopic.php?f=4&amp;t=4&amp;view=unread#unread',
						'U_LAST_POST' => 'phpBB/viewtopic.php?f=4&amp;t=4&amp;p=4#p4',
					),
				),
			),
			array(
				array(
					'settings' => array(
						'forum_ids'			=> array(),
						'topic_type'		=> array(),
						'max_topics'		=> 1,
						'date_range'		=> 'today',
						'order_by'			=> 0,
						'enable_tracking'	=> 0,
						'topic_title_limit'	=> 25,
						'template'			=> 'titles',
						'display_preview'	=> '',
						'preview_max_chars'	=> 125,
					),
				),
				true,
				'FORUM_RECENT_TOPICS',
				array(
					array(
						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Global Topic',
						'TOPIC_AUTHOR' => '<span class="username">admin</span>',
						'TOPIC_PREVIEW' => '',
						'TOPIC_POST_TIME' => '',
						'ATTACH_ICON_IMG' => '',
						'REPLIES' => 0,
						'VIEWS' => '0',
						'S_UNREAD_TOPIC' => false,
						'U_VIEWFORUM' => 'phpBB/viewforum.php?f=4',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=4&amp;t=4',
						'U_NEW_POST' => 'phpBB/viewtopic.php?f=4&amp;t=4&amp;view=unread#unread',
						'U_LAST_POST' => 'phpBB/viewtopic.php?f=4&amp;t=4&amp;p=4#p4',
					),
				),
			),
			array(
				array(
					'settings' => array(
						'forum_ids'			=> array(),
						'topic_type'		=> array(),
						'max_topics'		=> 1,
						'date_range'		=> 'today',
						'order_by'			=> 0,
						'enable_tracking'	=> 1,
						'topic_title_limit'	=> 25,
						'template'			=> 'titles',
						'display_preview'	=> '',
						'preview_max_chars'	=> 125,
					),
				),
				false,
				'FORUM_RECENT_TOPICS',
				array(
					array(
						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Global Topic',
						'TOPIC_AUTHOR' => '<span class="username">admin</span>',
						'TOPIC_PREVIEW' => '',
						'TOPIC_POST_TIME' => '',
						'ATTACH_ICON_IMG' => '',
						'REPLIES' => 0,
						'VIEWS' => '0',
						'S_UNREAD_TOPIC' => false,
						'U_VIEWFORUM' => 'phpBB/viewforum.php?f=4',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=4&amp;t=4',
						'U_NEW_POST' => 'phpBB/viewtopic.php?f=4&amp;t=4&amp;view=unread#unread',
						'U_LAST_POST' => 'phpBB/viewtopic.php?f=4&amp;t=4&amp;p=4#p4',
					),
				),
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 * @param array $bdata
	 * @param bool $registered_user
	 * @param string $title
	 * @param mixed $topicrow
	 */
	public function test_block_display(array $bdata, $registered_user, $title, $topicrow)
	{
		$block = $this->get_block($registered_user);
		$result = $block->display($bdata);

		$this->assertEquals($title, $result['title']);
		$this->assertEquals($topicrow, $result['content']['topicrow']);
	}
}
