<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks;

use blitze\sitemaker\model\mapper_factory;
use blitze\sitemaker\services\blocks\blocks;

require_once dirname(__FILE__) . '/../fixtures/ext/foo/bar/blocks/baz_block.php';
require_once dirname(__FILE__) . '/../fixtures/ext/foo/bar/blocks/empty_block.php';
require_once dirname(__FILE__) . '/../fixtures/ext/foo/bar/blocks/foo_block.php';

class blocks_test extends \phpbb_database_test_case
{
	protected $template;

	/**
	 * Define the extension to be tested.
	 *
	 * @return string[]
	 */
	protected static function setup_extensions()
	{
		return array('blitze/sitemaker');
	}

	/**
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/../fixtures/blocks.xml');
	}

	/**
	 * Create the blocks service
	 *
	 * @param string $default_layout
	 * @return \blitze\sitemaker\services\blocks\blocks
	 */
	protected function get_service($default_layout)
	{
		global $phpbb_root_path, $phpEx;

		$table_prefix = 'phpbb_';
		$tables = array(
			'mapper_tables'	=> array(
				'blocks'	=> $table_prefix . 'sm_blocks',
				'routes'	=> $table_prefix . 'sm_block_routes'
			)
		);

		$db = $this->new_dbal();
		$cache = new \phpbb_mock_cache();
		$config = new \phpbb\config\config(array(
			'sitemaker_default_layout'	=> $default_layout,
		));

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$translator = new \phpbb\language\language($lang_loader);

		$phpbb_container = new \phpbb_mock_container_builder();

		$blocks_collection = new \phpbb\di\service_collection($phpbb_container);

		$blocks_collection->add('my.baz.block');
		$blocks_collection->add('my.empty.block');
		$blocks_collection->add('my.foo.block');

		$phpbb_container->set('my.baz.block', new \foo\bar\blocks\baz_block);
		$phpbb_container->set('my.empty.block', new \foo\bar\blocks\empty_block);
		$phpbb_container->set('my.foo.block', new \foo\bar\blocks\foo_block);

		$ptemplate = $this->getMockBuilder('\blitze\sitemaker\services\template')
			->disableOriginalConstructor()
			->getMock();

		$block_factory = new \blitze\sitemaker\services\blocks\factory($translator, $ptemplate, $blocks_collection);

		$groups = $this->getMockBuilder('\blitze\sitemaker\services\groups')
			->disableOriginalConstructor()
			->getMock();
		$groups->expects($this->once())
			->method('get_users_groups')
			->willReturn(array(2, 3));

		$mapper_factory = new mapper_factory($config, $db, $tables);

		$tpl_data = array();
		$this->template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$this->template->expects($this->any())
			->method('assign_vars')
			->will($this->returnCallback(function($data) use (&$tpl_data) {
				$tpl_data = array_merge($tpl_data, $data);
			}));

		$this->template->expects($this->any())
			->method('assign_block_vars')
			->will($this->returnCallback(function($block, $data) use (&$tpl_data) {
				$tpl_data['blocks'][$block][] = $data;
			}));

		$this->template->expects($this->any())
			->method('assign_display')
			->will($this->returnCallback(function() use (&$tpl_data) {
				return $tpl_data;
			}));

		return new blocks($cache, $config, $this->template, $translator, $block_factory, $groups, $mapper_factory, $phpEx);
	}

	/**
	 * Data set for test_blocks_display
	 *
	 * @return array
	 */
	public function blocks_display_test_data()
	{
		return array(
			array(
				'index.php',
				'',
				false,
				'',
				array (
					0 => true,
					1 => true,
					2 => false,
				),
				array(
					'route_id' => 1,
					'ext_name' => '',
					'route' => 'index.php',
					'style' => 1,
					'hide_blocks' => false,
					'has_blocks' => true,
					'ex_positions' => array('bottom'),
					'is_sub_route' => false,
				),
				array(
					'positions' => array(
						'sidebar' => array(
							array(
								'bid' => 1,
								'name' => 'my.baz.block',
								'view' => 'simple',
							),
						),
					),
				),
			),
			array(
				'index.php',
				'',
				true,
				'',
				array (
					0 => true,
					1 => true,
					2 => true,
				),
				array(
					'route_id' => 1,
					'ext_name' => '',
					'route' => 'index.php',
					'style' => 1,
					'hide_blocks' => false,
					'has_blocks' => true,
					'ex_positions' => array('bottom'),
					'is_sub_route' => false,
				),
				array(
					'positions' => array(
						'sidebar' => array(
							array(
								'bid' => 1,
								'name' => 'my.baz.block',
								'content' => 'I love myself',
								'view' => 'simple',
							),
						),
						'top' => array(
							array(
								'bid' => 4,
								'name' => 'my.empty.block',
								'content' => 'BLOCK_NO_DATA',
								'view' => '',
							),
						),
					),
				),
			),
			array(
				'app.php/foo/test/',
				'',
				false,
				'',
				array (
					0 => true,
					1 => false,
					2 => true,
				),
				array(
					'route_id' => 2,
					'ext_name' => 'foo/bar',
					'route' => 'app.php/foo/test/',
					'style' => 1,
					'hide_blocks' => false,
					'has_blocks' => true,
					'ex_positions' => array(),
					'is_sub_route' => false,
				),
				array(
					'positions' => array(
						'sidebar' => array(
							array(
								'bid' => 5,
								'name' => 'my.baz.block',
								'view' => 'basic',
							),
						),
					),
				),
			),
			// route has no blocks and hiding blocks for bottom position, no default layout, not in edit_mode
			array(
				'search.php',
				'',
				false,
				'',
				array (
					0 => true,
					1 => true,
					2 => false,
				),
				array(
					'route_id' => 0,	// no route to inherit from
					'ext_name' => '',
					'route' => 'search.php',
					'style' => 1,
					'hide_blocks' => false,
					'has_blocks' => false,
					'ex_positions' => array('bottom'),
					'is_sub_route' => false,
				),
				array(),
			),
			// route has no blocks, and hiding blocks for bottom position, default route set with blocks on other positions
			array(
				'search.php',
				'',
				false,
				'index.php',
				array (
					0 => true,
					1 => true,
					2 => false,
				),
				array(
					'route_id' => 1,	// route id of default route (index.php), there4 showing blocks from index.php
					'ext_name' => '',
					'route' => 'search.php',
					'style' => 1,
					'hide_blocks' => false,
					'has_blocks' => false,
					'ex_positions' => array('bottom'),
					'is_sub_route' => false,
				),
				array(
					'positions' => array(
						'sidebar' => array(
							array(
								'bid' => 1,
								'name' => 'my.baz.block',
								'view' => 'simple',
							),
						),
					),
				),
			),
			// route has no blocks, and hiding blocks for bottom position, default route is set with blocks on bottom position
			array(
				'search.php',
				'',
				false,
				'faq.php',
				array (
					0 => true,
					1 => true,
					2 => false,
				),
				array(
					'route_id' => 0,
					'ext_name' => '',
					'route' => 'search.php',
					'style' => 1,
					'hide_blocks' => false,
					'has_blocks' => false,
					'ex_positions' => array('bottom'),
					'is_sub_route' => false,
				),
				array(),
			),
			// route has no blocks, and hiding blocks for bottom position, we are in edit mode
			array(
				'search.php',
				'',
				true,
				'index.php',
				array (
					0 => true,
					1 => true,
					2 => true,
				),
				array(
					'route_id' => 4,	// always own route_id in edit mode
					'ext_name' => '',
					'route' => 'search.php',
					'style' => 1,
					'hide_blocks' => false,
					'has_blocks' => false,
					'ex_positions' => array('bottom'),
					'is_sub_route' => false,
				),
				array(),
			),
		);
	}

	/**
	 * Test the show method
	 *
	 * @dataProvider blocks_display_test_data
	 * @param string $current_page
	 * @param string $page_dir
	 * @param bool $edit_mode
	 * @param string $default_layout
	 * @param array $display_modes
	 * @param array $expected_route_info
	 * @param array $expected_data
	 */
	public function test_blocks_display($current_page, $page_dir, $edit_mode, $default_layout, array $display_modes, array $expected_route_info, array $expected_data)
	{
		$block = $this->get_service($default_layout);

		$route_info = $block->get_route_info($current_page, $page_dir, 1, $edit_mode);
		$block->display($edit_mode, $route_info, 1, $display_modes);
		$result = $this->template->assign_display('blocks');

		unset($route_info['blocks']);
		$this->assertEquals($expected_route_info, $route_info);
		$this->assertArrayContainsArray($expected_data, $result);
	}

	protected function assertArrayContainsArray($needle, $haystack)
	{
		foreach ($needle as $key => $val)
		{
			$this->assertArrayHasKey($key, $haystack);

			if (is_array($val))
			{
				$this->assertArrayContainsArray($val, $haystack[$key]);
			}
			else
			{
				$this->assertEquals($val, $haystack[$key]);
			}
		}
	}
}
