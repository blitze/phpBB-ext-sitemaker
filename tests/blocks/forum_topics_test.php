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

require_once dirname(__FILE__) . '/../../../../../includes/functions.php';
require_once dirname(__FILE__) . '/../../../../../includes/functions_content.php';
require_once dirname(__FILE__) . '/../../vendor/urodoz/truncate-html/src/TruncateInterface.php';
require_once dirname(__FILE__) . '/../../vendor/urodoz/truncate-html/src/TruncateService.php';

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
	 * Create the forum topics block
	 *
	 * @return \blitze\sitemaker\blocks\forum_topics
	 */
	protected function get_block()
	{
		global $auth, $cache, $db, $phpbb_dispatcher, $request, $user, $phpbb_root_path, $phpEx;

		$cache = new \phpbb_mock_cache();
		$config = new \phpbb\config\config(array('load_db_lastread' => true));
		$db = $this->new_dbal();
		$request = $this->getMock('\phpbb\request\request_interface');

		$user = new \phpbb\user('\phpbb\datetime');
		$user->timezone = new \DateTimeZone('UTC');
		$user->lang['datetime'] =  array();
		$user->data = array(
			'user_id'		=> 48,
			'user_lastmark'	=> strtotime('25 Nov 2015'),
			'user_lang'		=> 'en',
			'is_registered'	=> true,
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

		$forum = new data($auth, $config, $content_visibility, $db, $user, $phpbb_root_path, $phpEx, 0);

		$date_range = new date_range($user, '24 November 2015');

		$block = new forum_topics($auth, $cache, $config, $content_visibility, $user, $date_range, $forum, $phpbb_root_path, $phpEx);
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
				'FORUM_RECENT_TOPICS',
				array(
					array(
						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Topic with poll',
						'TOPIC_AUTHOR' => '<span class="username">admin</span>',
						'TOPIC_PREVIEW' => 'This topic has a poll',
						'S_UNREAD_TOPIC' => true,
						'U_VIEWFORUM' => 'phpBB/viewforum.php?f=4',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=4&amp;t=9',
					),
					array(
						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Global Topic',
						'TOPIC_AUTHOR' => '<span class="username">admin</span>',
						'TOPIC_PREVIEW' => 'This is a global topic',
						'S_UNREAD_TOPIC' => false,
						'U_VIEWFORUM' => 'phpBB/viewforum.php?f=4',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=4&amp;t=4',
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
				'FORUM_RECENT_TOPICS',
				array(
					array(
						'TOPIC_TITLE' => 'Topic with',
						'TOPIC_AUTHOR' => '<span class="username">admin</span>',
						'S_UNREAD_TOPIC' => true,
						'TOPIC_POST_TIME' => '',
						'TOPIC_CONTEXT' => 'This topic has a...',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=4&amp;t=9',
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
				'TOPICS_LAST_READ',
				array(
					array(
						'TOPIC_PREVIEW' => 'This is a global topic',
						'S_UNREAD_TOPIC' => false,
						'TOPIC_AUTHOR' => '<span class="username">admin</span>',
						'U_VIEWFORUM' => 'phpBB/viewforum.php?f=4',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=4&amp;t=4',
						'TOPIC_POST_TIME' => '',
						'ATTACH_ICON_IMG' => '',
						'REPLIES' => -1,
						'VIEWS' => '0',
						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Global Topic',
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
				'FORUM_RECENT_TOPICS',
				array(
					array(
						'TOPIC_PREVIEW' => '',
						'S_UNREAD_TOPIC' => false,
						'TOPIC_AUTHOR' => '<span class="username">admin</span>',
						'U_VIEWFORUM' => 'phpBB/viewforum.php?f=4',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=4&amp;t=4',
						'FORUM_TITLE' => 'Second Forum',
						'TOPIC_TITLE' => 'Global Topic',
					),
				),
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 */
	public function test_block_display($bdata, $title, $topicrow)
	{
		$block = $this->get_block();
		$result = $block->display($bdata);

		$this->assertEquals($title, $result['title']);
		$this->assertEquals($topicrow, $result['content']['topicrow']);
	}
}
