<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use blitze\sitemaker\services\poll;
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
	 * @param bool $is_registered
	 * @return \blitze\sitemaker\blocks\forum_topics
	 */
	protected function get_block($is_registered = false)
	{
		$this->config['cookie_name'] = 'phpbb';

		$this->user->data = array(
			'user_id'		=> 2,
			'is_registered'	=> $is_registered,
		);

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

		$this->request->expects($this->any())
			->method('is_set')
			->with($this->anything())
			->will($this->returnCallback(function($cookie) {
				return ($cookie === 'phpbb_poll_1') ? true : false;
			}));
		$this->request->expects($this->any())
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

		$content_visibility = new \phpbb\content_visibility($this->auth, $this->config, $this->phpbb_dispatcher, $this->db, $this->user, $this->phpbb_root_path, $this->php_ext, 'phpbb_forums', 'phpbb_posts', 'phbb_topics', 'phpbb_users');

		$forum_data = new data($this->auth, $this->config, $content_visibility, $this->db, $this->user, $this->user_data, 0);

		$forum_options = $this->getMockBuilder('\blitze\sitemaker\services\forum\options')
			->disableOriginalConstructor()
			->getMock();

		$groups = $this->getMockBuilder('\blitze\sitemaker\services\groups')
			->disableOriginalConstructor()
			->getMock();

		$poll = new poll($this->auth, $this->config, $this->db, $this->request, $this->translator, $this->user, $sitemaker, $this->phpbb_root_path, $this->php_ext);

		return new forum_poll($this->db, $forum_data, $forum_options, $groups, $poll);
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
	 * @return void
	 */
	public function test_block_template()
	{
		$block = $this->get_block();

		$this->assertEquals('@blitze_sitemaker/blocks/forum_poll.html', $block->get_template());
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
						'forum_ids' => array(54),
						'order_by' => 0,
					),
				),
				false,
				[],
			),
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
					'POLL_OPTIONS' => array(
						array(
							'POLL_OPTION_ID' => '1',
							'POLL_OPTION_CAPTION' => 'Great',
							'POLL_OPTION_RESULT' => '1',
							'POLL_OPTION_PERCENT' => '100%',
							'POLL_OPTION_PERCENT_REL' => '100%',
							'POLL_OPTION_PCT' => 100.0,
							'POLL_OPTION_WIDTH' => 250.0,
							'POLL_OPTION_VOTED' => true,
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
					'MAX_VOTES' => 'You may select <strong>1</strong> option',
					'POLL_LENGTH' => '',
					'S_CAN_VOTE' => false,
					'S_DISPLAY_RESULTS' => true,
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
					'POLL_OPTIONS' => array(
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
					'MAX_VOTES' => 'You may select up to <strong>2</strong> options',
					'POLL_LENGTH' => '',
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
	 * @param array $bdata
	 * @param bool $is_registered
	 * @param mixed $expected
	 */
	public function test_block_display(array $bdata, $is_registered, $expected)
	{
		$block = $this->get_block($is_registered);
		$result = $block->display($bdata);

		$this->assertEquals($expected, $result['data']);
	}
}
