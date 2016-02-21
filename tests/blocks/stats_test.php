<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use blitze\sitemaker\blocks\stats;

class stats_test extends blocks_base
{
	/**
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/users.xml');
	}

	/**
	 * Create the stats block
	 *
	 * @return \blitze\sitemaker\blocks\stats
	 */
	protected function get_block($user_data = array())
	{
		global $auth, $phpbb_dispatcher;

		$auth = $this->getMock('\phpbb\auth\auth');
		$auth->expects($this->any())
			->method('acl_get')
			->with($this->stringContains('_'), $this->anything())
			->willReturn(true);

		$config = new \phpbb\config\config(array(
			'num_posts' => 8,
			'num_topics' => 6,
			'num_users' => 2,
			'newest_user_id' => 48,
			'newest_username' => 'demo',
			'newest_user_colour' => 'ccc',
		));

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function ($key, $value) {
				return $key . ': ' . $value;
			});

		$block = new stats($config, $translator);
		$block->set_template($this->ptemplate);

		return $block;
	}

	public function test_block_config()
	{
		$block = $this->get_block();
		$config = $block->get_config(array());

		$this->assertEquals(array(), $config);
	}

	/**
	 * Test block display
	 */
	public function test_block_display()
	{
		$block = $this->get_block();
		$result = $block->display(array());

		$expected = 'TOTAL_POSTS_COUNT: 8<br />' .
			'TOTAL_TOPICS: 6<br />' .
			'TOTAL_USERS: 2<br />' .
			'NEWEST_USER: <a href="phpBB/memberlist.php?mode=viewprofile&amp;u=48" style="color: #ccc;" class="username-coloured">demo</a>';

		$this->assertSame($expected, $result['content']);
	}
}
