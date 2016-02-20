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
use blitze\sitemaker\blocks\custom;

class custom_test extends blocks_base
{
	/**
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/custom.xml');
	}

	/**
	 * Create the custom block
	 *
	 * @return \blitze\sitemaker\blocks\custom
	 */
	protected function get_block($variable_map = array())
	{
		global $cache, $db, $phpbb_dispatcher, $request, $user;

		$cache = new \phpbb_mock_cache();
		$config = new \phpbb\config\config(array());
		$db = $this->new_dbal();

		$request = $this->getMock('\phpbb\request\request_interface');
		$request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap($variable_map));

		$user = new \phpbb\user('\phpbb\datetime');

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$block = new custom($cache, $db, $request, $user, 'phpbb_sm_cblocks');
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
	 * Data set for test_block_display
	 *
	 * @return array
	 */
	public function block_test_data()
	{
		return array(
			array(
				array(
					'bid' => 3, // record does not exist in cblocks table
				),
				false,
				'',
			),
			array(
				array(
					'bid' => 3, // record does not exist in cblocks table
				),
				true,
				'<div id="block-editor-3" class="editable editable-block" data-service="blitze.sitemaker.block.custom" data-method="save" data-raw=""></div>',
			),
			array(
				array(
					'bid' => 1,
				),
				false,
				'<p>my <strong>custom</strong> content<br></p>',
			),
			array(
				array(
					'bid' => 1,
				),
				true,
				'<div id="block-editor-1" class="editable editable-block" data-service="blitze.sitemaker.block.custom" data-method="save" data-raw="my custom content"><p>my <strong>custom</strong> content<br></p></div>',
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 */
	public function test_block_display($bdata, $edit_mode, $expected)
	{
		$block = $this->get_block();
		$result = $block->display($bdata, $edit_mode);

		$this->assertEquals($expected, $result['content']);
	}

	/**
	 * Data set for test_block_display
	 *
	 * @return array
	 */
	public function block_test_save_data()
	{
		return array(
			array(
				1,
				array(
					array('content', '', true, request_interface::REQUEST, ''),
				),
				array(
					'id' => 1,
					'content' => '',
					'callback' => 'previewCustomBlock',
				),
			),
			array(
				1,
				array(
					array('content', '', true, request_interface::REQUEST, '<p>my <em>updated</em> content<br></p>'),
				),
				array(
					'id' => 1,
					'content' => '<p>my <em>updated</em> content<br></p>',
					'callback' => 'previewCustomBlock',
				),
			),
			array(
				2,
				array(
					array('content', '', true, request_interface::REQUEST, '<p>my new content</p>'),
				),
				array(
					'id' => 2,
					'content' => '<p>my new content</p>',
					'callback' => 'previewCustomBlock',
				),
			),
		);
	}

	/**
	 * Test saving custom content
	 *
	 * @dataProvider block_test_save_data
	 */
	public function test_save_custom_content($block_id, $variable_map, $expected)
	{
		$block = $this->get_block($variable_map);
		$result = $block->save($block_id);

		$this->assertEquals($expected, $result);
	}
}
