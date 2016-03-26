<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use blitze\sitemaker\blocks\style_switcher;

class style_switcher_test extends blocks_base
{
	/**
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/styles.xml');
	}

	/**
	 * Create the stats block
	 *
	 * @param int $calls
	 * @return \blitze\sitemaker\blocks\stats
	 */
	protected function get_block($calls = 0)
	{
		global $db, $phpbb_dispatcher, $phpbb_path_helper, $request, $user, $phpbb_root_path, $phpEx;

		$db = $this->new_dbal();

		$user = new \phpbb\user('\phpbb\datetime');
		$user->page = array(
			'page_name'	=> 'index.php',
			'page'		=> 'index.php',
		);

		$request = $this->getMock('\phpbb\request\request');

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$phpbb_path_helper =  new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			new \phpbb\filesystem(),
			$request,
			$phpbb_root_path,
			$phpEx
		);

		$block_display = $this->getMockBuilder('\blitze\sitemaker\services\blocks\display')
			->disableOriginalConstructor()
			->getMock();
		$block_display->expects($this->exactly($calls))
			->method('get_style_id')
			->willReturn(1);

		$block = new style_switcher($block_display);
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
		$expected = array(
			'CURRENT_PAGE' => 'phpBB/index.php?',
			'S_STYLE_OPTIONS' => '<option value="3">inactive</option><option value="1" selected="selected">prosilver</option><option value="2">sitemaker</option>',
		);

		$block = $this->get_block(1);
		$result = $block->display(array());

		$this->assertSame($expected, $result['content']);
	}
}
