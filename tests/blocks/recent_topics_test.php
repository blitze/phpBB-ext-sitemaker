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

class recent_topics_test extends blocks_base
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
	 * Create the recent topics block
	 *
	 * @param bool $registered_user
	 * @param int $look_back
	 * @return \blitze\sitemaker\blocks\recent_topics
	 */
	protected function get_block($registered_user = true, $look_back = 0)
	{
		global $cache, $phpbb_path_helper, $symfony_request;

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

		$this->user->page = array(
			'page_name'	=> 'index.php',
			'page'		=> 'index.php',
		);

		$phpbb_path_helper =  new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			new \phpbb\filesystem(),
			$this->request,
			$this->phpbb_root_path,
			$this->php
		);

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

		$pagination = $this->getMockBuilder('\phpbb\pagination')
			->disableOriginalConstructor()
			->getMock();

		$this->template->expects($this->any())
			->method('retrieve_var')
			->with('T_ICONS_PATH')
			->willReturn('icon_path');

		$recent_topics = $this->getMockBuilder('\blitze\sitemaker\blocks\recent_topics')
			->setConstructorArgs([
				$this->auth,
				$content_visibility,
				$this->translator,
				$this->user,
				$truncator,
				$date_range,
				$forum_data,
				$forum_options,
				$this->phpbb_root_path,
				$this->php_ext,
				$cache,
				$this->request,
				$pagination,
				$this->template
			])
			->setMethods(['get_time_limit'])
			->getMock();
		$recent_topics->expects($this->any())
			->method('get_time_limit')
			->willReturn(strtotime('5 December 2015') - ($look_back * 24 * 3600));

		return $recent_topics;
	}

	public function test_block_config()
	{
		$block = $this->get_block();
		$config = $block->get_config(array());

		$expected_keys = array(
			'legend1',
			'forum_ids',
			'topic_type',
			'per_page',
			'look_back',
			'order_by',
			'legend2',
			'enable_tracking',
			'topic_title_limit',
			'preview_chars',
			'last_post',
		);

		$this->assertEquals($expected_keys, array_keys($config));
	}

	/**
	 * @return void
	 */
	public function test_block_template()
	{
		$block = $this->get_block();

		$this->assertEquals('@blitze_sitemaker/blocks/recent_topics.html', $block->get_template());
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
						'per_page'			=> 2,
						'look_back'			=> 1,
						'order_by'			=> 0,
						'enable_tracking'	=> 1,
						'topic_title_limit'	=> 25,
						'preview_chars'		=> 125,
						'last_post'			=> 0,
					),
				),
				true,
				null,
			),
			array(
				array(
					'settings' => array(
						'forum_ids'			=> array(),
						'topic_type'		=> array(),
						'per_page'			=> 2,
						'look_back'			=> 7,
						'order_by'			=> 0,
						'enable_tracking'	=> 1,
						'topic_title_limit'	=> 25,
						'preview_chars'		=> 125,
						'last_post'			=> 0,
					),
				),
				true,
				array(
					array(
						'USERNAME' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=48" class="username">demo</a>',
						'AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',
						'LAST_POSTER' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=48" class="username">demo</a>',
						'LAST_AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',
						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Topic with poll',
						'TOPIC_PREVIEW' => '',
						'TOPIC_POST_TIME' => '',
						'ATTACH_ICON_IMG' => '',
						'REPLIES' => 0,
						'VIEWS' => 0,
						'S_UNREAD_TOPIC' => true,
						'U_VIEWPROFILE' => 'phpBB/memberlist.php?mode=viewprofile&amp;u=48',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=4&amp;t=9',
						'U_VIEWFORUM' => 'phpBB/viewforum.php?f=4',
						'U_NEW_POST' => 'phpBB/viewtopic.php?f=4&amp;t=9&amp;view=unread#unread',
						'U_LAST_POST' => 'phpBB/viewtopic.php?f=4&amp;t=9&amp;p=12#p12',
						'S_HAS_POLL' => true,
						'S_TOPIC_ICONS' => true,
						'TOPIC_IMG_STYLE' => 'topic_unread_hot',
						'TOPIC_FOLDER_IMG' => '<span class="imageset topic_unread_hot" title="Unread posts">Unread posts</span>',
						'TOPIC_FOLDER_IMG_ALT' => 'Unread posts',
						'TOPIC_TYPE_CLASS' => '',
						'TOPIC_TIME_RFC3339' => '2015-11-29T20:18:19+00:00',
						'LAST_POST_TIME_RFC3339' => '2015-11-29T20:18:19+00:00',
						'LAST_POST_TIME' => '',
					),
				),
			),
			array(
				array(
					'settings' => array(
						'forum_ids'			=> array(),
						'topic_type'		=> array(),
						'per_page'			=> 2,
						'look_back'			=> 30,
						'order_by'			=> 0,
						'enable_tracking'	=> 1,
						'topic_title_limit'	=> 25,
						'preview_chars'		=> 125,
						'last_post'			=> 0,
					),
				),
				false,
				array(
					array(
						'USERNAME' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=48" class="username">demo</a>',
						'AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',
						'LAST_POSTER' => '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=48" class="username">demo</a>',
						'LAST_AVATAR' => '<img src="./styles/prosilver/theme/images/no_avatar.gif" alt="" />',
						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Topic with poll',
						'TOPIC_PREVIEW' => '',
						'TOPIC_POST_TIME' => '',
						'ATTACH_ICON_IMG' => '',
						'REPLIES' => 0,
						'VIEWS' => 0,
						'S_UNREAD_TOPIC' => true,
						'U_VIEWPROFILE' => 'phpBB/memberlist.php?mode=viewprofile&amp;u=48',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=4&amp;t=9',
						'U_VIEWFORUM' => 'phpBB/viewforum.php?f=4',
						'U_NEW_POST' => 'phpBB/viewtopic.php?f=4&amp;t=9&amp;view=unread#unread',
						'U_LAST_POST' => 'phpBB/viewtopic.php?f=4&amp;t=9&amp;p=12#p12',
						'S_HAS_POLL' => true,
						'S_TOPIC_ICONS' => true,
						'TOPIC_IMG_STYLE' => 'topic_unread_hot',
						'TOPIC_FOLDER_IMG' => '<span class="imageset topic_unread_hot" title="Unread posts">Unread posts</span>',
						'TOPIC_FOLDER_IMG_ALT' => 'Unread posts',
						'TOPIC_TYPE_CLASS' => '',
						'TOPIC_TIME_RFC3339' => '2015-11-29T20:18:19+00:00',
						'LAST_POST_TIME_RFC3339' => '2015-11-29T20:18:19+00:00',
						'LAST_POST_TIME' => '',
					),
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
						'U_VIEWPROFILE' => 'phpBB/memberlist.php?mode=viewprofile&amp;u=2',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=4&amp;t=4',
						'U_VIEWFORUM' => 'phpBB/viewforum.php?f=4',
						'U_NEW_POST' => 'phpBB/viewtopic.php?f=4&amp;t=4&amp;view=unread#unread',
						'U_LAST_POST' => 'phpBB/viewtopic.php?f=4&amp;t=4&amp;p=4#p4',
						'S_HAS_POLL' => false,
						'S_TOPIC_ICONS' => true,
						'TOPIC_IMG_STYLE' => 'global_unread',
						'TOPIC_FOLDER_IMG' => '<span class="imageset global_unread" title="Unread posts">Unread posts</span>',
						'TOPIC_FOLDER_IMG_ALT' => 'Unread posts',
						'TOPIC_TYPE_CLASS' => ' global-announce',
						'TOPIC_TIME_RFC3339' => '2015-11-24T23:07:04+00:00',
						'LAST_POST_TIME_RFC3339' => '2015-11-24T23:07:04+00:00',
						'LAST_POST_TIME' => '',
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
	 * @param mixed $topicrow
	 */
	public function test_block_display(array $bdata, $registered_user, $topicrow)
	{
		$block = $this->get_block($registered_user, $bdata['settings']['look_back']);
		$result = $block->display($bdata);

		$this->assertEquals($topicrow, $result['data']['TOPICS']);
	}
}
