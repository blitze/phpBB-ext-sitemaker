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
		$this->request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap($variable_map));

		$this->get_test_case_helpers()->set_s9e_services();

		$util = $this->getMockBuilder('\blitze\sitemaker\services\util')
			->disableOriginalConstructor()
			->getMock();

		$assets = array();
		$this->assets =& $assets;
		$util->expects($this->any())
			->method('add_assets')
			->will($this->returnCallback(function($data) use (&$assets) {
				$assets = array_merge($assets, $data);
			}));

		$block = new custom($this->cache, $this->db, $this->request, $util, 'phpbb_sm_cblocks');
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
			'legend2',
			'js_scripts',
			'css_scripts',
		);

		$this->assertEquals($expected_keys, array_keys($config));
	}

	/**
	 * Data set for test_block_display
	 *
	 * @return array
	 */
	public function block_display_test_data()
	{
		return array(
			array(
				array(
					'bid' => 3, // record does not exist in cblocks table
					'status' => 1,
					'settings' => array(
						'source' => '',
						'js_scripts' => array('script1.js', 'script2.js'),
					),
				),
				false,
				array('js' => array('script1.js', 'script2.js')),
				'',
			),
			array(
				array(
					'bid' => 3, // record does not exist in cblocks table
					'status' => 1,
					'settings' => array(
						'source' => '',
						'js_scripts' => array('script1.js', 'script2.js'),
						'css_scripts' => array('style.css'),
					),
				),
				true,
				array(
					'js' => array('script1.js', 'script2.js'),
					'css' => array('style.css'),
				),
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
				array(),
				'<p>My custom content with <span style="font-weight:bold">bbcode</span> and <a href="#">html</a></p>',
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
				array(),
				'<div id="block-editor-1" class="editable editable-block" data-service="blitze.sitemaker.block.custom" data-method="edit" data-raw="&lt;p&gt;My custom content with [b]bbcode[/b] and &lt;a href=&quot;#&quot;&gt;html&lt;/a&gt;&lt;/p&gt;" data-active="0"><p>My custom content with <span style="font-weight:bold">bbcode</span> and <a href="#">html</a></p></div>',
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
				array(),
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
				array(),
				"<script>\nalert('yes');\n</script>",
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_display_test_data
	 * @param array $bdata
	 * @param bool $edit_mode
	 * @param array $expected_assets
	 * @param string $expected_content
	 */
	public function test_block_display(array $bdata, $edit_mode, $expected_assets, $expected_content)
	{
		$block = $this->get_block();
		$result = $block->display($bdata, $edit_mode);

		$this->assertEquals($expected_assets, $this->assets);
		$this->assertEquals($expected_content, $result['content']);
	}

	/**
	 * Data set for test_save_custom_content
	 *
	 * @return array
	 */
	public function save_custom_content_test_data()
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
					array('content', '', true, request_interface::REQUEST, '<p>my new [b]content[/b]</p>'),
				),
				array(
					'id' => 2,
					'content' => '<p>my new <span style="font-weight:bold">content</span></p>',
				),
			),
		);
	}

	/**
	 * Test saving custom content
	 *
	 * @dataProvider save_custom_content_test_data
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
