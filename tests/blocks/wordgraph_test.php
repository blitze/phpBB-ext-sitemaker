<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use blitze\sitemaker\blocks\wordgraph;

class wordgraph_test extends blocks_base
{
	/**
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/wordgraph.xml');
	}

	/**
	 * Create the mybookmarks block
	 *
	 * @return \blitze\sitemaker\blocks\mybookmarks
	 */
	protected function get_block()
	{
		global $auth, $db, $phpbb_dispatcher, $request, $user, $phpbb_root_path, $phpEx;

		$config = new \phpbb\config\config(array('load_db_lastread' => true));
		$db = $this->new_dbal();
		$request = $this->getMock('\phpbb\request\request_interface');

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$translator = new \phpbb\language\language($lang_loader);

		$user = new \phpbb\user($translator, '\phpbb\datetime');
		$user->timezone = new \DateTimeZone('UTC');

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
					$ids = array(2 => 2);
				}

				return $ids;
			}));

		$content_visibility = new \phpbb\content_visibility($auth, $config, $phpbb_dispatcher, $db, $user, $phpbb_root_path, $phpEx, 'phpbb_forums', 'phpbb_posts', 'phbb_topics', 'phpbb_users');

		$block = new wordgraph($auth, $content_visibility, $db, $phpbb_root_path, $phpEx);
		$block->set_template($this->ptemplate);

		return $block;
	}

	public function test_block_config()
	{
		$block = $this->get_block();
		$config = $block->get_config(array());

		$expected_keys = array(
			'legend1',
			'show_word_count',
			'max_num_words',
			'max_word_size',
			'min_word_size',
			'exclude_words',
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
					'settings' => array (
						'show_word_count' => 1,
						'max_num_words' => 5,
						'max_word_size' => 25,
						'min_word_size' => 9,
						'exclude_words' => '',
					),
				),
				array(
					'wordgraph' => array(
						array(
							'WORD' => 'Phpbb(1)',
							'WORD_SIZE' => 9,
							'WORD_COLOR' => '0cf',
							'WORD_URL' => 'phpBB/search.php?keywords=Phpbb',
						),
						array(
							'WORD' => 'Rocks(12)',
							'WORD_SIZE' => 25,
							'WORD_COLOR' => 'ec0',
							'WORD_URL' => 'phpBB/search.php?keywords=Rocks',
						),
						array(
							'WORD' => 'Sitemaker(5)',
							'WORD_SIZE' => 14.818181818181818,
							'WORD_COLOR' => '5c9',
							'WORD_URL' => 'phpBB/search.php?keywords=Sitemaker',
						),
					),
				),
			),
			array(
				array(
					'settings' => array (
						'show_word_count' => 0,
						'max_num_words' => 2,
						'max_word_size' => 35,
						'min_word_size' => 7,
						'exclude_words' => 'phpbb, sitemaker, rocks',
					),
				),
				'',
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 * @param array $bdata
	 * @param mixed $expected
	 */
	public function test_block_display(array $bdata, $expected)
	{
		$block = $this->get_block();
		$result = $block->display($bdata);

		$this->assertEquals($expected, $result['content']);
	}
}
