<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\menus;

use blitze\sitemaker\services\menus\display;

class display_test extends \phpbb_database_test_case
{
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
		return $this->createXMLDataSet(dirname(__FILE__) . '/../fixtures/menu.xml');
	}

	/**
	 * Create the members service
	 *
	 * @return \blitze\sitemaker\services\menus\display
	 */
	protected function get_service($current_page)
	{
		global $phpbb_dispatcher, $phpEx;

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$lang = new \phpbb\language\language($lang_loader);
		$user = new \phpbb\user($lang, '\phpbb\datetime');
		$user->page = $current_page;

		$db = $this->new_dbal();

		$menu_items_table = 'phpbb_sm_menu_items';
		$primary_key = 'item_id';

		return new display($db, $user, $menu_items_table, $primary_key);
	}

	/**
	 * Data set for test_display_navlist
	 * @return array
	 */
	public function display_navlist_test_data()
	{
		return array(
			array(
				array(
					'page_name'		=> 'index.php',
					'page_dir'		=> '',
					'query_string'	=> '',
				),
				array(
					'expanded'		=> true,
					'max_depth'		=> 0,
				),
				array(
					1 => array(
						'item_id'		=> 1,
						'item_title'	=> 'Item 1',
						'item_url'		=> '/index.php',
						'url_path'		=> '/',
						'url_query'		=> array(),
						'parent_id'		=> 0,
						'left_id'		=> 1,
						'right_id'		=> 4,
						'depth'			=> 0,
					),
					2 => array(
						'item_id'		=> 2,
						'item_title'	=> 'Item 2',
						'item_url'		=> '/viewtopic.php?f=1&t=2',
						'url_path'		=> '/viewtopic.php',
						'url_query'		=> array('f=1', 'amp;t=2'),
						'parent_id'		=> 1,
						'left_id'		=> 2,
						'right_id'		=> 3,
						'depth'			=> 1,
					),
					3 => array(
						'item_id'		=> 3,
						'item_title'	=> 'Item 3',
						'item_url'		=> '/app.php/forum',
						'url_path'		=> '/app.php/forum',
						'url_query'		=> array(),
						'parent_id'		=> 0,
						'left_id'		=> 5,
						'right_id'		=> 6,
						'depth'			=> 0,
					),
				),
				array(
					'tree' => array(
						1 => array(
							'ITEM_ID' => 1,
							'ITEM_TITLE' => 'Item 1',
							'ITEM_URL' => '/index.php',
							'URL_PATH' => '/',
							'URL_QUERY' => [],
							'PARENT_ID' => 0,
							'LEFT_ID' => 1,
							'RIGHT_ID' => 4,
							'DEPTH' => 0,
							'IS_CURRENT' => true,
							'IS_PARENT' => false,
							'FULL_URL' => NULL,
							'NUM_KIDS' => 1,
						),
						2	=> array(
							'ITEM_ID' => 2,
							'ITEM_TITLE' => 'Item 2',
							'ITEM_URL' => '/viewtopic.php?f=1&t=2',
							'URL_PATH' => '/viewtopic.php',
							'URL_QUERY' => ['f=1', 'amp;t=2'],
							'PARENT_ID' => 1,
							'LEFT_ID' => 2,
							'RIGHT_ID' => 3,
							'DEPTH' => 1,
							'IS_CURRENT' => false,
							'IS_PARENT' => false,
							'FULL_URL' => NULL,
							'NUM_KIDS' => 0,
						),
						3	=> array(
							'ITEM_ID' => 3,
							'ITEM_TITLE' => 'Item 3',
							'ITEM_URL' => '/app.php/forum',
							'URL_PATH' => '/app.php/forum',
							'URL_QUERY' => [],
							'PARENT_ID' => 0,
							'LEFT_ID' => 5,
							'RIGHT_ID' => 6,
							'DEPTH' => 0,
							'IS_CURRENT' => false,
							'IS_PARENT' => false,
							'FULL_URL' => NULL,
							'NUM_KIDS' => 0,
						),
					),
					'min_depth' => 0,
				),
				array(
					array(
						'DEPTH'			=> 0,
						'NUM_KIDS'		=> 1,
						'IS_CURRENT'	=> true,
						'ITEM_ID'		=> 1,
					),
					array(
						'DEPTH'			=> 1,
						'NUM_KIDS'		=> 0,
						'IS_CURRENT'	=> false,
						'ITEM_ID'		=> 2,
					),
					array(
						'DEPTH'			=> 0,
						'NUM_KIDS'		=> 0,
						'IS_CURRENT'	=> false,
						'ITEM_ID'		=> 3,
					),
				),
			),
			array(
				array(
					'page_name'		=> 'app.php/forum',
					'page_dir'		=> '',
					'query_string'	=> '',
				),
				array(
					'expanded'		=> false,
					'max_depth'		=> 1,
				),
				array(
					1 => array(
						'item_id'		=> 1,
						'item_title'	=> 'Item 1',
						'item_url'		=> '/index.php',
						'url_path'		=> '/',
						'url_query'		=> array(),
						'parent_id'		=> 0,
						'left_id'		=> 1,
						'right_id'		=> 6,
						'depth'			=> 0,
					),
					2 => array(
						'item_id'		=> 2,
						'item_title'	=> 'Item 2',
						'item_url'		=> '/viewtopic.php?f=1&t=2',
						'url_path'		=> '/viewtopic.php',
						'url_query'		=> array('f=1', 'amp;t=2'),
						'parent_id'		=> 1,
						'left_id'		=> 2,
						'right_id'		=> 5,
						'depth'			=> 1,
					),
					3 => array(
						'item_id'		=> 3,
						'item_title'	=> 'Item 3',
						'item_url'		=> '/app.php/forum',
						'url_path'		=> '/app.php/forum',
						'url_query'		=> array(),
						'parent_id'		=> 2,
						'left_id'		=> 3,
						'right_id'		=> 4,
						'depth'			=> 2,
					),
				),
				array(
					'tree' => array(
						2	=> array(
							'ITEM_ID' => 2,
							'ITEM_TITLE' => 'Item 2',
							'ITEM_URL' => '/viewtopic.php?f=1&t=2',
							'URL_PATH' => '/viewtopic.php',
							'URL_QUERY' => ['f=1', 'amp;t=2'],
							'PARENT_ID' => 1,
							'LEFT_ID' => 2,
							'RIGHT_ID' => 5,
							'DEPTH' => 1,
							'IS_CURRENT' => false,
							'IS_PARENT' => true,
							'FULL_URL' => NULL,
							'NUM_KIDS' => 1,
						),
						3	=> array(
							'ITEM_ID' => 3,
							'ITEM_TITLE' => 'Item 3',
							'ITEM_URL' => '/app.php/forum',
							'URL_PATH' => '/app.php/forum',
							'URL_QUERY' => [],
							'PARENT_ID' => 2,
							'LEFT_ID' => 3,
							'RIGHT_ID' => 4,
							'DEPTH' => 2,
							'IS_CURRENT' => true,
							'IS_PARENT' => false,
							'FULL_URL' => NULL,
							'NUM_KIDS' => 0,
						),
					),
					'min_depth'	=> 1,
				),
			),
		);
	}

	/**
	 * Test display navlist
	 *
	 * @dataProvider display_navlist_test_data
	 * @param array $current_page
	 * @param array $params
	 * @param array $data
	 * @param array $expected
	 */
	public function test_display_navlist(array $current_page, array $params, array $data, array $expected)
	{
		$tree = $this->get_service($current_page);

		$data = array(
			'items'	=> $data,
			'paths'	=> array(
				1 => '/index.php',
				2 => '/viewtopic.php',
				3 => '/app.php/forum',
			),
		);

		$tree->set_params($params);
		$result = $tree->display_navlist($data);

		$this->assertEquals($expected, $result);
	}
}
