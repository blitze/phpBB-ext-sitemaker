<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use blitze\sitemaker\services\forum\data;
use blitze\sitemaker\blocks\whats_new;

class whats_new_test extends blocks_base
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
	 * Create the mybookmarks block
	 *
	 * @param array $user_data
	 * @return \blitze\sitemaker\blocks\whats_new
	 */
	protected function get_block($user_data = array())
	{
		global $auth, $cache, $db, $phpbb_dispatcher, $request, $user, $phpbb_root_path, $phpEx;

		$cache = new \phpbb_mock_cache();
		$config = new \phpbb\config\config(array('load_db_lastread' => true));
		$db = $this->new_dbal();
		$request = $this->getMock('\phpbb\request\request_interface');

		$user = new \phpbb\user('\phpbb\datetime');
		$user->timezone = new \DateTimeZone('UTC');
		$user->lang['datetime'] =  array();
		$user->data = $user_data;

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

		$block = new whats_new($user, $forum, $phpbb_root_path, $phpEx);
		$block->set_template($this->ptemplate);

		return $block;
	}

	public function test_block_config()
	{
		$block = $this->get_block();
		$config = $block->get_config(array());

		$expected_keys = array(
			'legend1',
			'topics_only',
			'max_topics',
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
						'topics_only' => 0,
						'max_topics' => 2,
					),
				),
				array(
					'user_id' => 0,
					'is_registered' => false,
					'user_lastvisit' => 0,
				),
				'',
			),
			array(
				array(
					'settings' => array(
						'topics_only' => 0,
						'max_topics' => 2,
					),
				),
				array(
					'user_id' => 48,
					'is_registered' => true,
					'user_lastvisit' => strtotime('24 November 2015'),
				),
				array(
					'topicrow' => array(
						array(
							'TOPIC_TITLE' => 'Topic with poll',
							'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=4&amp;t=9',
						),
						array(
							'TOPIC_TITLE' => 'Welcome to phpBB3',
							'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=2&amp;t=1',
						),
					),
				),
			),
			array(
				array(
					'settings' => array(
						'topics_only' => 1,
						'max_topics' => 2,
					),
				),
				array(
					'user_id' => 48,
					'is_registered' => true,
					'user_lastvisit' => strtotime('27 November 2015'),
				),
				array(
					'topicrow' => array(
						array(
							'TOPIC_TITLE' => 'Topic with poll',
							'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=4&amp;t=9',
						),
						array(
							'TOPIC_TITLE' => 'Welcome to phpBB3',
							'U_VIEWTOPIC' => 'phpBB/viewtopic.php?f=2&amp;t=1',
						),
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
	 * @param array $user_data
	 * @param mixed $expected
	 */
	public function test_block_display(array $bdata, array $user_data, $expected)
	{
		$block = $this->get_block($user_data);
		$result = $block->display($bdata);

		$this->assertEquals($expected, $result['content']);
	}
}
