<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2021 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use Symfony\Component\HttpFoundation\Request;
use blitze\sitemaker\services\date_range;
use blitze\sitemaker\services\forum\data;
use blitze\sitemaker\blocks\hot_topics;

class hot_topics_test extends blocks_base
{
	/**
	 * Configure the test environment.
	 *
	 * @return void
	 */
	public function setUp(): void
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
	 * Create the hot topics block
	 *
	 * @param bool $registered_user
	 * @return \blitze\sitemaker\blocks\hot_topics
	 */
	protected function get_block($registered_user = true)
	{
		global $cache, $symfony_request;

		$symfony_request = new Request();
		$cache = new \phpbb_mock_cache();

		$cache = $this->getMockBuilder('\phpbb\cache\service')
			->disableOriginalConstructor()
			->getMock();

		$cache->expects($this->any())
			->method('obtain_word_list')
			->willReturn(array());

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
		$this->config['hot_threshold'] = 1;

		$this->user->data['user_id'] = 48;
		$this->user->data['user_lastmark'] = strtotime('25 Nov 2015');
		$this->user->data['user_lang'] = 'en';
		$this->user->data['is_registered'] = $registered_user;

		$this->auth->expects($this->any())
			->method('acl_getf')
			->will($this->returnCallback(function ($acl, $test)
			{
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

		$truncator = new \Urodoz\Truncate\TruncateService();

		return new hot_topics($this->auth, $content_visibility, $this->translator, $this->user, $truncator, $date_range, $forum_data, $forum_options, $this->phpbb_root_path, $this->php_ext, $this->config);
	}

	public function test_block_config()
	{
		$block = $this->get_block();
		$config = $block->get_config(array());

		$expected_keys = array(
			'legend1',
			'forum_ids',
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
	 * @return void
	 */
	public function test_block_template()
	{
		$block = $this->get_block();

		$this->assertEquals('@blitze_sitemaker/blocks/forum_topics.html', $block->get_template());
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
				'HOT_TOPICS',
				array(
					array(
						'USERNAME' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=2" class="username">admin</a>',
						'AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',
						'LAST_POSTER' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=2" class="username">admin</a>',
						'LAST_AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',
						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Sticky Topic',
						'TOPIC_PREVIEW' => 'This is a sticky topic',
						'TOPIC_POST_TIME' => '',
						'ATTACH_ICON_IMG' => '<span class="imageset icon_topic_attach" title="Attachment(s)">Attachment(s)</span>',
						'REPLIES' => 1,
						'VIEWS' => 0,
						'S_UNREAD_TOPIC' => true,
						'U_VIEWPROFILE' => 'phpBB/memberlist.php?mode=viewprofile&amp;u=2',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=4&amp;t=2',
						'U_VIEWFORUM' => 'phpBB/viewforum.php?f=4',
						'U_NEW_POST' => 'phpBB/viewtopic.php?f=4&amp;t=2&amp;view=unread#unread',
						'U_LAST_POST' => 'phpBB/viewtopic.php?f=4&amp;t=2&amp;p=6#p6',
					),
					array(
						'USERNAME' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=2" class="username">admin</a>',
						'AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',
						'LAST_POSTER' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=48" class="username">demo</a>',
						'LAST_AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',
						'FORUM_TITLE' => 'Your first forum',
						'TOPIC_TITLE' => 'Welcome to phpBB3',
						'TOPIC_PREVIEW' => 'Welcome topic',
						'TOPIC_POST_TIME' => '',
						'ATTACH_ICON_IMG' => '<span class="imageset icon_topic_attach" title="Attachment(s)">Attachment(s)</span>',
						'REPLIES' => 2,
						'VIEWS' => 0,
						'S_UNREAD_TOPIC' => false,
						'U_VIEWPROFILE' => 'phpBB/memberlist.php?mode=viewprofile&amp;u=2',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=2&amp;t=1',
						'U_VIEWFORUM' => 'phpBB/viewforum.php?f=2',
						'U_NEW_POST' => 'phpBB/viewtopic.php?f=2&amp;t=1&amp;view=unread#unread',
						'U_LAST_POST' => 'phpBB/viewtopic.php?f=2&amp;t=1&amp;p=10#p10',
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
		$this->assertEquals($topicrow, $result['data']['TOPICS']);
	}
}
