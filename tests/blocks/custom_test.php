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
	 * @param array $variable_map
	 * @return \blitze\sitemaker\blocks\custom
	 */
	protected function get_block($variable_map = array())
	{
		global $cache, $db, $phpbb_dispatcher, $request, $user;

		$cache = new \phpbb_mock_cache();
		$config = new \phpbb\config\config(array());
		$db = $this->new_dbal();

		set_config(null, null, null, $config);

		$request = $this->getMock('\phpbb\request\request_interface');
		$request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap($variable_map));

		$user = new \phpbb\user('\phpbb\datetime');

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$block = new custom($cache, $db, $request, 'phpbb_sm_cblocks');
		$block->set_template($this->ptemplate);

		return $block;
	}

	public function test_block_config()
	{
		$block = $this->get_block();
		$config = $block->get_config(array());

		$expected_keys = array(
			'legend1',
			'source',
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
					'bid' => 3, // record does not exist in cblocks table
					'status' => 1,
					'settings' => array(
						'source' => '',
					),
				),
				false,
				'',
			),
			array(
				array(
					'bid' => 3, // record does not exist in cblocks table
					'status' => 1,
					'settings' => array(
						'source' => '',
					),
				),
				true,
				'<div id="block-editor-3" class="editable editable-block" data-service="blitze.sitemaker.block.custom" data-method="edit" data-raw="" data-active="1"></div>',
			),
			array(
				array(
					'bid' => 1,
					'status' => 1,
					'settings' => array(
						'source' => '',
					),
				),
				false,
				'<p>my <strong>custom</strong> content<br></p>',
			),
			array(
				array(
					'bid' => 1,
					'status' => 0,
					'settings' => array(
						'source' => '',
					),
				),
				true,
				'<div id="block-editor-1" class="editable editable-block" data-service="blitze.sitemaker.block.custom" data-method="edit" data-raw="my custom content" data-active="0"><p>my <strong>custom</strong> content<br></p></div>',
			),
			array(
				array(
					'bid' => 1,
					'status' => 1,
					'settings' => array(
						'source' => "&lt;script&gt;\nalert('yes');\n&lt;/script&gt;",
					),
				),
				false,
				"<script>\nalert('yes');\n</script>",
			),
			array(
				array(
					'bid' => 1,
					'status' => 0,
					'settings' => array(
						'source' => "&lt;script&gt;\nalert('yes');\n&lt;/script&gt;",
					),
				),
				true,
				"<script>\nalert('yes');\n</script>",
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 * @param array $bdata
	 * @param bool $edit_mode
	 * @param string $expected
	 */
	public function test_block_display(array $bdata, $edit_mode, $expected)
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
				),
			),
		);
	}

	/**
	 * Test saving custom content
	 *
	 * @dataProvider block_test_save_data
	 * @param int $block_id
	 * @param array $variable_map
	 * @param array $expected
	 */
	public function test_save_custom_content($block_id, array $variable_map, array $expected)
	{
		$block = $this->get_block($variable_map);
		$result = $block->edit($block_id);

		$this->assertEquals($expected, $result);
	}
}
