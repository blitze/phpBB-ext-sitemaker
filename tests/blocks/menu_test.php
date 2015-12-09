<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use blitze\sitemaker\model\mapper_factory;
use blitze\sitemaker\services\menus\display;
use blitze\sitemaker\blocks\menu;

class menu_test extends blocks_base
{
	/**
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/menu.xml');
	}

	/**
	 * Create the menu block
	 *
	 * @return \blitze\sitemaker\blocks\menu
	 */
	protected function get_block()
	{
		global $phpbb_dispatcher, $request, $user;

		$table_prefix = 'phpbb_';
		$tables = array(
			'mapper_tables'	=> array(
				'menus'	=> $table_prefix . 'sm_menus',
				'items'	=> $table_prefix . 'sm_menu_items'
			)
		);

		$db = $this->new_dbal();
		$request = $this->getMock('\phpbb\request\request_interface');

		$cache = new \phpbb_mock_cache();
		$config = new \phpbb\config\config(array());
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
		$user = new \phpbb\user('\phpbb\datetime');

		$mapper_factory = new mapper_factory($config, $db, $tables);

		$tree = new display($db, $user, $tables['mapper_tables']['items'], 'item_id');

		$block = new menu($cache, $config, $user, $mapper_factory, $tree);
		$block->set_template($this->ptemplate);

		return $block;
	}

	public function test_block_config()
	{
		$block = $this->get_block();
		$config = $block->get_config(array());

		$expected_keys = array(
			'legend1',
			'menu_id',
			'expanded',
			'max_depth',
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
					'settings' => array(
						'menu_id' => 0,
						'expanded' => 0,
						'max_depth' => 3,
					),
				),
				false,
				'',
			),
			array(
				array(
					'settings' => array(
						'menu_id' => 0,
						'expanded' => 0,
						'max_depth' => 3,
					),
				),
				true,
				'SELECT_MENU',
			),
			array(
				array(
					'settings' => array(
						'menu_id' => 2,
						'expanded' => 0,
						'max_depth' => 3,
					),
				),
				false,
				'',
			),
			array(
				array(
					'settings' => array(
						'menu_id' => 2,
						'expanded' => 0,
						'max_depth' => 3,
					),
				),
				true,
				'MENU_NO_ITEMS',
			),
			array(
				array(
					'settings' => array(
						'menu_id' => 1,
						'expanded' => 0,
						'max_depth' => 3,
					),
				),
				false,
				3,
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 */
	public function test_block_display($bdata, $editing, $expected)
	{
		$block = $this->get_block();
		$result = $block->display($bdata, $editing);

		$this->assertSame($expected, is_array($result['content']) ? sizeof($result['content']['tree']) : $result['content']);
	}
}
