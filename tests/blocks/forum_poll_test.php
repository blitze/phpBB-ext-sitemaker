<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use phpbb\request\request_interface;
use blitze\sitemaker\services\forum\data;
use blitze\sitemaker\blocks\forum_poll;

class forum_poll_test extends blocks_base
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
	protected function get_block($is_registered = false)
	{
		global $auth, $cache, $db, $phpbb_dispatcher, $request, $user, $phpbb_root_path, $phpEx;

		$cache = new \phpbb_mock_cache();
		$config = new \phpbb\config\config(array('cookie_name' => 'phpbb'));
		$db = $this->new_dbal();

		$user = new \phpbb\user('\phpbb\datetime');
		$user->timezone = new \DateTimeZone('UTC');
		$user->lang['datetime'] =  array();
		$user->data = array(
			'user_id'		=> 2,
			'is_registered'	=> $is_registered,
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
		$auth->expects($this->any())
			->method('acl_get')
			->will($this->returnCallback(function() {
				return true;
			}));

		$request = $this->getMock('\phpbb\request\request_interface');
		$request->expects($this->any())
			->method('is_set')
			->with($this->anything())
			->will($this->returnCallback(function($cookie) {
				return ($cookie === 'phpbb_poll_1') ? true : false;
			}));
		$request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnCallback(function($cookie) {
				return ($cookie === 'phpbb_poll_1') ? '1,2' : '';
			}));

		$sitemaker = $this->getMockBuilder('\blitze\sitemaker\services\util')
			->disableOriginalConstructor()
			->getMock();
		$sitemaker->expects($this->any())
			->method('get_form_key')
			->will($this->returnCallback(function($form) {
				return $form . ' token';
			}));

		$content_visibility = new \phpbb\content_visibility($auth, $config, $phpbb_dispatcher, $db, $user, $phpbb_root_path, $phpEx, 'phpbb_forums', 'phpbb_posts', 'phbb_topics', 'phpbb_users');

		$forum = new data($auth, $config, $content_visibility, $db, $user, $phpbb_root_path, $phpEx, 0);

		$block = new forum_poll($auth, $cache, $config, $db, $request, $user, $forum, $sitemaker, $phpbb_root_path, $phpEx);
		$block->set_template($this->ptemplate);

		return $block;
	}

	public function test_block_config()
	{
		$block = $this->get_block();
		$config = $block->get_config(array());

		$expected_keys = array(
			'legend1',
			'user_ids',
			'group_ids',
			'topic_ids',
			'forum_ids',
			'topic_type',
			'order_by',
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
						'topic_type' => array(0),
						'user_ids' => '',
						'group_ids' => array(),
						'topic_ids' => '',
						'forum_ids' => array(),
						'order_by' => 0,
					),
				),
				true,
				array(
					'poll_option' => array(
						array(
							'POLL_OPTION_ID' => '1',
							'POLL_OPTION_CAPTION' => 'Great',
							'POLL_OPTION_RESULT' => '1',
							'POLL_OPTION_PERCENT' => '100%',
							'POLL_OPTION_PERCENT_REL' => '100%',
							'POLL_OPTION_PCT' => 100,
							'POLL_OPTION_WIDTH' => 250,
							'POLL_OPTION_VOTED' => false,
							'POLL_OPTION_MOST_VOTES' => true,
						),
						array(
							'POLL_OPTION_ID' => '2',
							'POLL_OPTION_CAPTION' => 'Terrible',
							'POLL_OPTION_RESULT' => '0',
							'POLL_OPTION_PERCENT' => '0%',
							'POLL_OPTION_PERCENT_REL' => '0%',
							'POLL_OPTION_PCT' => 0,
							'POLL_OPTION_WIDTH' => 0,
							'POLL_OPTION_VOTED' => false,
							'POLL_OPTION_MOST_VOTES' => false,
						),
					),
					'POLL_QUESTION' => 'My First Poll',
					'TOTAL_VOTES' => 1,
					'POLL_LEFT_CAP_IMG' => '<span class="imageset poll_left"></span>',
					'POLL_RIGHT_CAP_IMG' => '<span class="imageset poll_right"></span>',
					'L_MAX_VOTES' => 'You may select <strong>1</strong> option',
					'L_POLL_LENGTH' => '',
					'S_CAN_VOTE' => true,
					'S_DISPLAY_RESULTS' => false,
					'S_IS_MULTI_CHOICE' => false,
					'S_POLL_ACTION' => 'phpBB/viewtopic.php?f=4&amp;t=9',
					'S_FORM_TOKEN' => 'posting token',
					'U_VIEW_RESULTS' => 'phpBB/viewtopic.php?f=4&amp;t=9&amp;view=viewpoll',
				),
			),
			array(
				array(
					'settings' => array(
						'topic_type' => array(0),
						'user_ids' => '2',
						'group_ids' => array(1),
						'topic_ids' => '1',
						'forum_ids' => array(),
						'order_by' => 0,
					),
				),
				false,
				array(
					'poll_option' => array(
						array(
							'POLL_OPTION_ID' => '1',
							'POLL_OPTION_CAPTION' => 'Option 1',
							'POLL_OPTION_RESULT' => '1',
							'POLL_OPTION_PERCENT' => '50%',
							'POLL_OPTION_PERCENT_REL' => '100%',
							'POLL_OPTION_PCT' => 50.0,
							'POLL_OPTION_WIDTH' => 125,
							'POLL_OPTION_VOTED' => true,
							'POLL_OPTION_MOST_VOTES' => true,
						),
						array(
							'POLL_OPTION_ID' => '2',
							'POLL_OPTION_CAPTION' => 'Option 2',
							'POLL_OPTION_RESULT' => '1',
							'POLL_OPTION_PERCENT' => '50%',
							'POLL_OPTION_PERCENT_REL' => '100%',
							'POLL_OPTION_PCT' => 50.0,
							'POLL_OPTION_WIDTH' => 125.0,
							'POLL_OPTION_VOTED' => true,
							'POLL_OPTION_MOST_VOTES' => true,
						),
					),
					'POLL_QUESTION' => 'My Second Poll',
					'TOTAL_VOTES' => 2,
					'POLL_LEFT_CAP_IMG' => '<span class="imageset poll_left"></span>',
					'POLL_RIGHT_CAP_IMG' => '<span class="imageset poll_right"></span>',
					'L_MAX_VOTES' => 'You may select up to <strong>2</strong> options',
					'L_POLL_LENGTH' => '',
					'S_CAN_VOTE' => true,
					'S_DISPLAY_RESULTS' => true,
					'S_IS_MULTI_CHOICE' => true,
					'S_POLL_ACTION' => 'phpBB/viewtopic.php?f=2&amp;t=1',
					'S_FORM_TOKEN' => 'posting token',
					'U_VIEW_RESULTS' => 'phpBB/viewtopic.php?f=2&amp;t=1&amp;view=viewpoll',
				),
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 */
	public function test_block_display($bdata, $is_registered, $expected)
	{
		$block = $this->get_block($is_registered);
		$result = $block->display($bdata);

		$this->assertEquals($expected, $result['content']);
	}
}
