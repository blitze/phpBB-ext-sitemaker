<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use Symfony\Component\HttpFoundation\Request;
use blitze\sitemaker\model\mapper_factory;
use blitze\sitemaker\services\template;
use blitze\sitemaker\services\menus\display;
use blitze\sitemaker\services\menus\navigation;
use blitze\sitemaker\blocks\links;

class links_test extends blocks_base
{
	/**
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/links.xml');
	}

	/**
	 * Create the menu block
	 *
	 * @param array $page_data
	 * @return \blitze\sitemaker\blocks\menu
	 */
	protected function get_block($page_data = array())
	{
		global $symfony_request;

		$symfony_request = new Request();

		$table_prefix = 'phpbb_';
		$tables = array(
			'mapper_tables'	=> array(
				'menus'	=> $table_prefix . 'sm_menus',
				'items'	=> $table_prefix . 'sm_menu_items'
			)
		);

		$this->user->host = 'www.example.com';
		$this->user->page = $page_data;
		$this->user->page['root_script_path'] = '/phpBB/';
		$this->user->style = array(
			'style_name' => 'prosilver',
			'style_path' => 'prosilver',
		);

		$mapper_factory = new mapper_factory($this->config, $this->db, $tables);

		$tree = new display($this->db, $this->user, $tables['mapper_tables']['items'], 'item_id');

		$navigation = new navigation($this->cache, $mapper_factory, $tree, $this->php_ext);

		return new links($this->translator, $navigation);
	}

	/**
	 * @return void
	 */
	public function test_block_config()
	{
		$block = $this->get_block();
		$config = $block->get_config(array());

		$expected_keys = array(
			'legend1',
			'menu_id',
		);

		$this->assertEquals($expected_keys, array_keys($config));
	}

	/**
	 * @return void
	 */
	public function test_block_template()
	{
		$block = $this->get_block();

		$this->assertEquals('@blitze_sitemaker/blocks/links.html', $block->get_template());
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
						'menu_id' => 0,
					),
				),
				false,
				'',
			),
			array(
				array(
					'settings' => array(
						'menu_id' => 0,
					),
				),
				true,
				'SELECT_MENU',
			),
			array(
				array(
					'settings' => array(
						'menu_id' => 2,
					),
				),
				false,
				'',
			),
			array(
				array(
					'settings' => array(
						'menu_id' => 2,
					),
				),
				true,
				'MENU_NO_ITEMS',
			),
			array(
				array(
					'settings' => array(
						'menu_id' => 1,
					),
				),
				false,
				array(
					'tree' => array(
						array(
							'PREV_DEPTH' => 0,
							'THIS_DEPTH' => 0,
							'NUM_KIDS' => 2,
							'CLOSE' => array(),
							'ITEM_ID' => 1,
							'MENU_ID' => 1,
							'PARENT_ID' => 0,
							'ITEM_TITLE' => 'Item 1',
							'ITEM_URL' => '/app.php/page/item-1',
							'ITEM_ICON' => '',
							'ITEM_TARGET' => 0,
							'LEFT_ID' => 1,
							'RIGHT_ID' => 6,
							'ITEM_PARENTS' => '',
							'DEPTH' => 0,
							'FULL_URL' => 'http://www.example.com/phpBB/app.php/page/item-1',
							'BOARD_URL' => 'http://www.example.com/phpBB',
							'MOD_REWRITE_ENABLED' => '',
							'HOST' => '',
							'URL_PATH' => '/app.php/page/item-1',
							'URL_QUERY' => array(),
							'IS_NAVIGABLE' => true,
							'IS_EXPANDABLE' => true,
						),
						array(
							'PREV_DEPTH' => 0,
							'THIS_DEPTH' => 1,
							'NUM_KIDS' => 1,
							'CLOSE' => [''],
							'ITEM_ID' => 2,
							'MENU_ID' => 1,
							'PARENT_ID' => 1,
							'ITEM_TITLE' => 'Item 2',
							'ITEM_URL' => '/app.php/page/item-2',
							'ITEM_ICON' => '',
							'ITEM_TARGET' => 0,
							'LEFT_ID' => 2,
							'RIGHT_ID' => 5,
							'ITEM_PARENTS' => '',
							'DEPTH' => 1,
							'FULL_URL' => 'http://www.example.com/phpBB/app.php/page/item-2',
							'BOARD_URL' => 'http://www.example.com/phpBB',
							'MOD_REWRITE_ENABLED' => '',
							'HOST' => '',
							'URL_PATH' => '/app.php/page/item-2',
							'URL_QUERY' => array(),
							'IS_NAVIGABLE' => true,
							'IS_EXPANDABLE' => true,
						),
						array(
							'PREV_DEPTH' => 1,
							'THIS_DEPTH' => 2,
							'NUM_KIDS' => 0,
							'CLOSE' => [''],
							'ITEM_ID' => 3,
							'MENU_ID' => 1,
							'PARENT_ID' => 2,
							'ITEM_TITLE' => 'Item 3',
							'ITEM_URL' => '/app.php/page/item-3',
							'ITEM_ICON' => '',
							'ITEM_TARGET' => 0,
							'LEFT_ID' => 3,
							'RIGHT_ID' => 4,
							'ITEM_PARENTS' => '',
							'DEPTH' => 2,
							'FULL_URL' => 'http://www.example.com/phpBB/app.php/page/item-3',
							'BOARD_URL' => 'http://www.example.com/phpBB',
							'MOD_REWRITE_ENABLED' => '',
							'HOST' => '',
							'URL_PATH' => '/app.php/page/item-3',
							'URL_QUERY' => array(),
							'IS_NAVIGABLE' => true,
							'IS_EXPANDABLE' => true,
						),
					),
					'close' => ['', ''],
				),
				'status' => 1,
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 * @param array $bdata
	 * @param bool $editing
	 * @param mixed $expected
	 */
	public function test_block_display(array $bdata, $editing, $expected)
	{
		$block = $this->get_block();
		$result = $block->display($bdata, $editing);

		$this->assertEquals($expected, is_array($expected) ? $result['data'] : $result['content']);
	}
}
