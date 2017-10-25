<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use Symfony\Component\HttpFoundation\Request;
use blitze\sitemaker\services\date_range;
use blitze\sitemaker\services\forum\data;
use blitze\sitemaker\blocks\forum_topics;

class forum_topics_test extends blocks_base
{
	/**
	 * Configure the test environment.
	 *
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();

		require_once dirname(__FILE__) . '/../../vendor/urodoz/truncate-html/src/TruncateInterface.php';
		require_once dirname(__FILE__) . '/../../vendor/urodoz/truncate-html/src/TruncateService.php';
	}

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
	 * Create the forum topics block
	 *
	 * @param bool $registered_user
	 * @return \blitze\sitemaker\blocks\forum_topics
	 */
	protected function get_block($registered_user = true)
	{
		global $cache, $symfony_request;

		$symfony_request = new Request();

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

		$this->config['load_db_lastread'] = true;
		$this->config['load_anon_lastread'] = true;

		$this->user->data['user_id'] = 48;
		$this->user->data['user_lastmark'] = strtotime('25 Nov 2015');
		$this->user->data['user_lang'] = 'en';
		$this->user->data['is_registered'] = $registered_user;

		$this->auth->expects($this->any())
			->method('acl_getf')
			->will($this->returnCallback(function($acl, $test) {
				$ids = array();
				if ($acl == '!f_read' && $test)
				{
					$ids = array(5 => 5);
				}

				return $ids;
			}));

		$content_visibility = new \phpbb\content_visibility($this->auth, $this->config, $this->phpbb_dispatcher, $this->db, $this->user, $this->phpbb_root_path, $this->php_ext, 'phpbb_forums', 'phpbb_posts', 'phbb_topics', 'phpbb_users');

		$date_range = new date_range($this->user, '24 November 2015');

		$forum_data = new data($this->auth, $this->config, $content_visibility, $this->db, $this->user, $this->user_data, 0);

		$forum_options = $this->getMockBuilder('\blitze\sitemaker\services\forum\options')
			->disableOriginalConstructor()
			->getMock();

		$block = new forum_topics($this->auth, $content_visibility, $this->translator, $this->user, $date_range, $forum_data, $forum_options, $this->phpbb_root_path, $this->php_ext);
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
			'context',
			'preview_chars'
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
						'context'			=> 'first',
						'preview_chars'		=> 125,
					),
				),
				true,
				'FORUM_RECENT_TOPICS',
				array(
					array(
						'USERNAME' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=2" class="username">admin</a>',
						'AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',
						'LAST_POSTER' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=48" class="username">demo</a>',
						'LAST_AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',

						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Topic with poll',
						'TOPIC_PREVIEW' => 'This topic has a poll',
						'TOPIC_POST_TIME' => '',
						'ATTACH_ICON_IMG' => '',
						'REPLIES' => 0,
						'VIEWS' => 0,
						'S_UNREAD_TOPIC' => true,
						'U_VIEWFORUM' => 'phpBB/viewforum.php?f=4',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=4&amp;t=9',
						'U_NEW_POST' => 'phpBB/viewtopic.php?f=4&amp;t=9&amp;view=unread#unread',
						'U_LAST_POST' => 'phpBB/viewtopic.php?f=4&amp;t=9&amp;p=12#p12',
					),
					array(
						'USERNAME' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=2" class="username">admin</a>',
						'AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',
						'LAST_POSTER' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=2" class="username">admin</a>',
						'LAST_AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',

						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Global Topic',
						'TOPIC_PREVIEW' => 'This is a global topic',
						'TOPIC_POST_TIME' => '',
						'ATTACH_ICON_IMG' => '',
						'REPLIES' => 0,
						'VIEWS' => 0,
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
						'context'			=> 'last',
						'preview_chars'		=> 0,
					),
				),
				true,
				'FORUM_RECENT_TOPICS',
				array(
					array(
						'USERNAME' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=48" class="username">demo</a>',
						'AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',
						'LAST_POSTER' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=48" class="username">demo</a>',
						'LAST_AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',

						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Topic w...',
						'TOPIC_PREVIEW' => '',
						'TOPIC_POST_TIME' => '',
						'ATTACH_ICON_IMG' => '',
						'REPLIES' => 0,
						'VIEWS' => 0,
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
						'topic_type'		=> array(POST_ANNOUNCE),
						'max_topics'		=> 1,
						'date_range'		=> '',
						'order_by'			=> 0,
						'enable_tracking'	=> 1,
						'topic_title_limit'	=> 25,
						'template'			=> 'mini',
						'context'			=> 'first',
						'preview_chars'		=> 125,
					),
				),
				true,
				'FORUM_ANNOUNCEMENTS',
				array(
					array(
						'USERNAME' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=2" class="username">admin</a>',
						'AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',
						'LAST_POSTER' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=48" class="username">demo</a>',
						'LAST_AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',

						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Announcement Topic',
						'TOPIC_PREVIEW' => 'This is an announcement',
						'TOPIC_POST_TIME' => '',
						'ATTACH_ICON_IMG' => '',
						'REPLIES' => 0,
						'VIEWS' => 0,
						'S_UNREAD_TOPIC' => false,
						'U_VIEWFORUM' => 'phpBB/viewforum.php?f=4',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=4&amp;t=3',
						'U_NEW_POST' => 'phpBB/viewtopic.php?f=4&amp;t=3&amp;view=unread#unread',
						'U_LAST_POST' => 'phpBB/viewtopic.php?f=4&amp;t=3&amp;p=3#p3',
					),
				),
			),
			array(
				array(
					'settings' => array(
						'forum_ids'			=> array(),
						'topic_type'		=> array(),
						'max_topics'		=> 1,
						'date_range'		=> '',
						'order_by'			=> 0,
						'enable_tracking'	=> 1,
						'topic_title_limit'	=> 25,
						'template'			=> 'context',
						'context'			=> 'first',
						'preview_chars'		=> 10,
					),
				),
				true,
				'FORUM_RECENT_TOPICS',
				array(
					array(
						'USERNAME' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=2" class="username">admin</a>',
						'AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',
						'LAST_POSTER' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=48" class="username">demo</a>',
						'LAST_AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',

						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Topic with poll',
						'TOPIC_PREVIEW' => 'This...',
						'TOPIC_POST_TIME' => '',
						'ATTACH_ICON_IMG' => '',
						'REPLIES' => 0,
						'VIEWS' => 0,
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
						'topic_type'		=> array(POST_STICKY, POST_GLOBAL),
						'max_topics'		=> 1,
						'date_range'		=> 'today',
						'order_by'			=> 0,
						'enable_tracking'	=> 0,
						'topic_title_limit'	=> 25,
						'template'			=> 'titles',
						'context'			=> 'last',
						'preview_chars'		=> 0,
					),
				),
				true,
				'FORUM_RECENT_TOPICS',
				array(
					array(
						'USERNAME' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=2" class="username">admin</a>',
						'AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',
						'LAST_POSTER' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=2" class="username">admin</a>',
						'LAST_AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',

						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Global Topic',
						'TOPIC_PREVIEW' => '',
						'TOPIC_POST_TIME' => '',
						'ATTACH_ICON_IMG' => '',
						'REPLIES' => 0,
						'VIEWS' => 0,
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
						'context'			=> 'last',
						'preview_chars'		=> 0,
					),
				),
				false,
				'FORUM_RECENT_TOPICS',
				array(
					array(
						'USERNAME' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=2" class="username">admin</a>',
						'AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',
						'LAST_POSTER' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=2" class="username">admin</a>',
						'LAST_AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',

						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Global Topic',
						'TOPIC_PREVIEW' => '',
						'TOPIC_POST_TIME' => '',
						'ATTACH_ICON_IMG' => '',
						'REPLIES' => 0,
						'VIEWS' => 0,
						'S_UNREAD_TOPIC' => true,
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
