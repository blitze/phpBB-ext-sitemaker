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
		$this->config['load_db_lastread'] = true;

		$this->user->data = $user_data;

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

		$content_visibility = new \phpbb\content_visibility($this->auth, $this->config, $this->phpbb_dispatcher, $this->db, $this->user, $phpbb_root_path, $this->php_ext, 'phpbb_forums', 'phpbb_posts', 'phbb_topics', 'phpbb_users');

		$forum_data = new data($this->auth, $this->config, $content_visibility, $this->db, $this->user, $this->user_data, 0);

		return new whats_new($this->translator, $this->user, $forum_data, $this->phpbb_root_path, $this->php_ext);
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
	 * @return void
	 */
	public function test_block_template()
	{
		$block = $this->get_block();

		$this->assertEquals('@blitze_sitemaker/blocks/topiclist.html', $block->get_template());
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
				null,
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

		$this->assertEquals($expected, $result['data']['TOPICS']);
	}
}
