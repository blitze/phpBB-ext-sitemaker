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
require_once dirname(__FILE__) . '/../fixtures/ext/foo/bar/blocks/error_block.php';
require_once dirname(__FILE__) . '/../fixtures/ext/foo/bar/blocks/foo_block.php';
require_once dirname(__FILE__) . '/../fixtures/ext/foo/bar/blocks/raz_block.php';
require_once dirname(__FILE__) . '/../fixtures/ext/foo/bar/blocks/no_template_block.php';

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
	protected function get_service($default_layout = '')
	{
		global $db, $phpbb_dispatcher, $phpbb_root_path, $phpEx;

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

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$translator = new \phpbb\language\language($lang_loader);

		$phpbb_container = new \phpbb_mock_container_builder();
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$blocks_collection = new \phpbb\di\service_collection($phpbb_container);

		$blocks_collection->add('my.baz.block');
		$blocks_collection->add('my.empty.block');
		$blocks_collection->add('my.error.block');
		$blocks_collection->add('my.foo.block');
		$blocks_collection->add('my.raz.block');
		$blocks_collection->add('my.no_template.block');

		$phpbb_container->set('my.baz.block', new \foo\bar\blocks\baz_block);
		$phpbb_container->set('my.empty.block', new \foo\bar\blocks\empty_block);
		$phpbb_container->set('my.error.block', new \foo\bar\blocks\error_block);
		$phpbb_container->set('my.foo.block', new \foo\bar\blocks\foo_block);
		$phpbb_container->set('my.raz.block', new \foo\bar\blocks\raz_block);
		$phpbb_container->set('my.no_template.block', new \foo\bar\blocks\no_template_block);

		$block_factory = new \blitze\sitemaker\services\blocks\factory($translator, $blocks_collection);

		$groups = $this->getMockBuilder('\blitze\sitemaker\services\groups')
			->disableOriginalConstructor()
			->getMock();
		$groups->expects($this->any())
			->method('get_users_groups')
			->willReturn(array(2, 3));

		$mapper_factory = new mapper_factory($config, $db, $tables);

		$tpl_data = array();
		$this->template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$this->template->expects($this->any())
			->method('assign_vars')
			->will($this->returnCallback(function ($data) use (&$tpl_data)
			{
				$tpl_data = array_merge($tpl_data, $data);
			}));

		$this->template->expects($this->any())
			->method('assign_block_vars')
			->will($this->returnCallback(function ($block, $data) use (&$tpl_data)
			{
				$tpl_data['blocks'][$block][] = $data;
			}));

		$this->template->expects($this->any())
			->method('assign_display')
			->will($this->returnCallback(function () use (&$tpl_data)
			{
				return $tpl_data;
			}));

		return new blocks($cache, $config, $block_factory, $mapper_factory, $phpEx, $phpbb_dispatcher, $this->template, $translator, $groups);
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
				1,
				'index.php',
				false,
				'',
				array(
					'page_dir' => '',
					'forum' => 0,
				),
				array(
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
				1,
				'index.php',
				true,
				'',
				array(
					'page_dir' => '',
					'forum' => 0,
				),
				array(
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
								'class' => '',
							),
						),
						'top' => array(
							array(
								'bid' => 4,
								'name' => 'my.empty.block',
								'content' => 'BLOCK_NO_DATA',
								'view' => '',
								'class' => ' sm-inactive',
							),
						),
					),
				),
			),
			array(
				1,
				'app.php/foo/test/',
				false,
				'',
				array(
					'page_dir' => '',
					'forum' => 0,
				),
				array(
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
				array(),
			),
			array(
				1,
				'app.php/foo/test/',
				true,
				'',
				array(
					'page_dir' => '',
					'forum' => 0,
				),
				array(
					0 => true,
					1 => true,
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
								'class' => ' sm-inactive',
							),
						),
					),
				),
			),
			// route has no blocks and hiding blocks for bottom position, no default layout, not in edit_mode
			array(
				1,
				'search.php',
				false,
				'',
				array(
					'page_dir' => '',
					'forum' => 0,
				),
				array(
					0 => true,
					1 => true,
					2 => false,
				),
				array(
					'route_id' => 4,	// no route to inherit from
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
				1,
				'search.php',
				false,
				'index.php', // no style id specified, so we use current style. In this case '1'
				array(
					'page_dir' => '',
					'forum' => 0,
				),
				array(
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
								'class' => ''
							),
						),
					),
				),
			),
			// route has no blocks, and hiding blocks for bottom position, default route is set with blocks on bottom position
			array(
				1,
				'search.php',
				false,
				'faq.php:3', // style id specified
				array(
					'page_dir' => '',
					'forum' => 0,
				),
				array(
					0 => true,
					1 => true,
					2 => false,
				),
				array(
					'route_id' => 8,
					'ext_name' => '',
					'route' => 'search.php',
					'style' => 3,
					'hide_blocks' => false,
					'has_blocks' => false,
					'ex_positions' => array('bottom'),
					'is_sub_route' => false,
				),
				array(),
			),
			// #7: route has no blocks, and hiding blocks for bottom position, default route is set with blocks on top position
			array(
				1,
				'search.php',
				false,
				'faq.php:2', // default route has style id that is different from current style
				array(
					'page_dir' => '',
					'forum' => 0,
				),
				array(
					0 => true,
					1 => true,
					2 => false,
				),
				array(
					'route_id' => 3,
					'ext_name' => '',
					'route' => 'search.php',
					'style' => 2,
					'hide_blocks' => false,
					'has_blocks' => false,
					'ex_positions' => array('bottom'),
					'is_sub_route' => false,
				),
				array(
					'positions' => array(
						'top' => array(
							array(
								'bid' => 3,
								'name' => 'my.foo.block',
								'view' => '',
								'class' => ''
							),
						),
					),
				),
			),
			// route has no blocks, and hiding blocks for bottom position, default route is set with blocks on sidebar position
			array(
				1,
				'search.php',
				false,
				'faq.php:1', // style id specified
				array(
					'page_dir' => '',
					'forum' => 0,
				),
				array(
					0 => true,
					1 => true,
					2 => false,
				),
				array(
					'route_id' => 7,
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
								'bid' => 11,
								'name' => 'my.foo.block',
								'view' => '',
								'class' => ''
							),
						),
					),
				),
			),
			// route has no blocks, and hiding blocks for bottom position, we are in edit mode
			array(
				1,
				'search.php',
				true,
				'index.php',
				array(
					'page_dir' => '',
					'forum' => 0,
				),
				array(
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
			// route has own blocks, default route provided. We are on viewforum page - so forum id is present
			array(
				3,
				'viewforum.php?f=1',
				false,
				'index.php',
				array(
					'page_dir' => '',
					'forum' => 1,
				),
				array(
					0 => true,
					1 => true,
					2 => true,
				),
				array(
					'route_id' => 6,
					'ext_name' => '',
					'route' => 'viewforum.php?f=1',
					'style' => 3,
					'hide_blocks' => false,
					'has_blocks' => true,
					'ex_positions' => array(),
					'is_sub_route' => false,
				),
				array(
					'positions' => array(
						'subcontent' => array(
							array(
								'bid' => 10,
								'name' => 'my.foo.block',
								'view' => '',
								'class' => ''
							),
						),
					),
				),
			),
			// route has no blocks, default route is provided but this is a forum page and has a parent forum that has blocks
			array(
				3,
				'viewforum.php?f=3',
				false,
				'index.php',
				array(
					'page_dir' => '',
					'forum' => 3,
				),
				array(
					0 => true,
					1 => true,
					2 => true,
				),
				array(
					'route_id' => 6,
					'ext_name' => '',
					'route' => 'viewforum.php?f=3',
					'style' => 3,
					'hide_blocks' => false,
					'has_blocks' => true,
					'ex_positions' => array(),
					'is_sub_route' => true,
				),
				array(
					'positions' => array(
						'subcontent' => array(
							array(
								'bid' => 10,
								'name' => 'my.foo.block',
								'view' => '',
								'class' => ''
							),
						),
					),
				),
			),
			// route has no blocks, default route is not provided but this is a forum page and has a parent forum of same style that has blocks
			array(
				5,
				'viewforum.php?f=3',
				false,
				'',
				array(
					'page_dir' => '',
					'forum' => 3,
				),
				array(
					0 => true,
					1 => true,
					2 => true,
				),
				array(
					'route_id' => 9,
					'ext_name' => '',
					'route' => 'viewforum.php?f=3',
					'style' => 5,
					'hide_blocks' => false,
					'has_blocks' => true,
					'ex_positions' => array(),
					'is_sub_route' => true,
				),
				array(
					'positions' => array(
						'sidebar' => array(
							array(
								'bid' => 13,
								'name' => 'my.foo.block',
								'view' => '',
								'class' => ''
							),
						),
					),
				),
			),
			// route has no blocks, default route is not provided but this is a forum page and has no parent forum of same style that has blocks
			array(
				2,
				'viewforum.php?f=3',
				false,
				'',
				array(
					'page_dir' => '',
					'forum' => 3,
				),
				array(
					0 => true,
					1 => true,
					2 => true,
				),
				array(
					'route_id' => 0,
					'ext_name' => '',
					'route' => 'viewforum.php?f=3',
					'style' => 2,
					'hide_blocks' => false,
					'has_blocks' => false,
					'ex_positions' => array(),
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
	 * @param int $style_id
	 * @param string $current_page
	 * @param bool $edit_mode
	 * @param string $default_layout
	 * @param array $page_data
	 * @param array $display_modes
	 * @param array $expected_route_info
	 * @param array $expected_data
	 */
	public function test_blocks_display($style_id, $current_page, $edit_mode, $default_layout, array $page_data, array $display_modes, array $expected_route_info, array $expected_data)
	{
		$block = $this->get_service($default_layout);

		$route_info = $block->get_route_info($current_page, $page_data['page_dir'], $page_data['forum'], $style_id, $edit_mode);
		$block->display($edit_mode, $route_info, $display_modes);
		$result = $this->template->assign_display('blocks');

		unset($route_info['blocks']);
		$this->assertEquals($expected_route_info, $route_info);
		$this->assertArrayContainsArray($expected_data, $result);
	}


	/**
	 * Data set for test_user_is_permitted
	 *
	 * @return array
	 */
	public function user_is_permitted_test_data()
	{
		return array(
			array(
				array(
					'type' => 0,
					'groups' => [],
				),
				[],
				true,
			),
			array(
				array(
					'type' => 0,
					'groups' => [],
				),
				[1, 2, 3],
				true,
			),
			array(
				array(
					'type' => 1,
					'groups' => [1, 5],
				),
				[1, 2, 3],
				true,
			),
			array(
				array(
					'type' => 0,
					'groups' => [1, 5],
				),
				[1, 2, 3],
				false,
			),
			array(
				array(
					'type' => 1,
					'groups' => [1, 5],
				),
				[2, 3],
				false,
			),
			array(
				array(
					'type' => 0,
					'groups' => [1, 5],
				),
				[2, 3],
				true,
			),
			array(
				array(
					'type' => 1,
					'groups' => [1, 5],
				),
				[],
				false,
			),
			array(
				array(
					'type' => 0,
					'groups' => [1, 5],
				),
				[],
				true,
			),
		);
	}

	/**
	 * @dataProvider user_is_permitted_test_data
	 * @param array $permission
	 * @param array $user_groups
	 * @param bool $expected
	 */
	public function test_user_is_permitted(array $permission, array $user_groups, $expected)
	{
		$object = $this->getMockBuilder('\blitze\sitemaker\services\blocks\blocks')
			->disableOriginalConstructor()
			->setMethodsExcept(['user_is_permitted'])
			->getMock();
		$reflection = new \ReflectionClass(get_class($object));
		$method = $reflection->getMethod('user_is_permitted');
		$method->setAccessible(true);

		$result = $method->invokeArgs($object, [$permission, $user_groups]);
		$this->assertEquals($expected, $result);
	}

	/**
	 * return array
	 */
	public function render_block_test_data()
	{
		return array(
			array(
				false,
				array(
					'name' => 'my.empty.block',
				),
				[],
			),
			array(
				true,
				array(
					'name' => 'my.empty.block',
				),
				array(
					'title' => 'I am an empty block',
					'class' => ' sm-inactive',
					'content' => 'BLOCK_NO_DATA',
				),
			),
			array(
				false,
				array(
					'name' => 'my.foo.block',
				),
				array(
					'title' => 'I am foo block',
					'class' => '',
					'content' => 'foo block content',
				),
			),
			array(
				true,
				array(
					'name' => 'my.foo.block',
					'title' => 'my custom title',
				),
				array(
					'title' => 'my custom title',
					'class' => '',
					'content' => 'foo block content',
				),
			),
			array(
				false,
				array(
					'name' => 'my.raz.block',
					'settings' => ['show' => true],
				),
				array(
					'title' => 'I am raz block',
					'class' => '',
					'data' => array('loop' => ['row1', 'row2']),
				),
			),
			array(
				false,
				array(
					'name' => 'my.raz.block',
					'title' => 'my custom title',
					'settings' => ['show' => true],
				),
				array(
					'title' => 'my custom title',
					'class' => '',
					'data' => array('loop' => ['row1', 'row2']),
				),
			),
			array(
				false,
				array(
					'name' => 'my.raz.block',
					'title' => 'my custom title',
					'settings' => ['show' => false],
				),
				array(),
			),
			array(
				true,
				array(
					'name' => 'my.raz.block',
					'title' => 'my custom title',
					'settings' => ['show' => false],
				),
				array(
					'title' => 'my custom title',
					'class' => ' sm-inactive',
					'content' => 'BLOCK_NO_DATA',
				),
			),
			array(
				false,
				array(
					'name' => 'my.no_template.block',
				),
				array(),
			),
			array(
				true,
				array(
					'name' => 'my.no_template.block',
				),
				array(
					'class' => ' sm-inactive',
					'content' => 'BLOCK_MISSING_TEMPLATE',
				),
			),
		);
	}

	/**
	 * @dataProvider render_block_test_data
	 * @param bool $edit_mode
	 * @param string $expected
	 */
	public function test_render_block($edit_mode, $bdata, $expected)
	{
		$display_modes = [true, true, true];
		$db_data = $bdata + [
			'bid' => 1,
			'type' => 0,
			'title' => '',
			'class' => '',
			'status' => 1,
			'settings' => [],
			'permission' => ['type' => 0, 'groups' => []],
		];

		$block = $this->get_service();
		$result = $block->render($display_modes, $edit_mode, $db_data, [], 0);

		if (!empty($result))
		{
			$this->assertArrayContainsArray($expected, $result);
		}
		else
		{
			$this->assertEquals($expected, $result);
		}
	}

	/**
	 * return array
	 */
	public function render_block_with_exception_test_data()
	{
		return array(
			array(false, ''),
			array(true, 'Something went wrong'),
		);
	}

	/**
	 * @dataProvider render_block_with_exception_test_data
	 * @param bool $edit_mode
	 * @param string $expected
	 */
	public function test_render_block_with_exception($edit_mode, $expected)
	{
		$display_modes = [true, true, true];
		$db_data = [
			'bid' => 1,
			'type' => 0,
			'name' => 'my.error.block',
			'title' => 'error title',
			'class' => '',
			'permission' => ['type' => 0, 'groups' => []]
		];

		$block = $this->get_service();
		$result = $block->render($display_modes, $edit_mode, $db_data, [], 0);

		$this->assertEquals($expected, !empty($result) ? $result['content'] : '');
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
