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
	protected $ptemplate;
	protected $tpl_data;

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
		global $phpbb_dispatcher;

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$lang = new \phpbb\language\language($lang_loader);
		$user = new \phpbb\user($lang, '\phpbb\datetime');
		$user->page = $current_page;

		$this->ptemplate = $this->getMockBuilder('\blitze\sitemaker\services\template')
			->disableOriginalConstructor()
			->getMock();

		$tpl_data = array();
		$this->tpl_data = &$tpl_data;

		$this->ptemplate->expects($this->any())
			->method('assign_block_vars')
			->will($this->returnCallback(function($key, $data) use (&$tpl_data) {
				$tpl_data[$key][] = $data;
			}));

		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$db = $this->new_dbal();

		$menu_items_table = 'phpbb_sm_menu_items';
		$primary_key = 'item_id';

		return new display($db, $template, $user, $menu_items_table, $primary_key);
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
					'query_string'	=> '',
				),
				array(
					'expanded'		=> true,
					'max_depth'		=> 0,
				),
				array(
					array(
						'item_id'		=> 1,
						'item_title'	=> 'Item 1',
						'item_url'		=> 'index.php',
						'url_path'		=> 'index.php',
						'url_query'		=> array(),
						'parent_id'		=> 0,
						'left_id'		=> 1,
						'right_id'		=> 4,
						'depth'			=> 0,
					),
					array(
						'item_id'		=> 2,
						'item_title'	=> 'Item 2',
						'item_url'		=> 'viewtopic.php?f=1&t=2',
						'url_path'		=> 'viewtopic.php',
						'url_query'		=> array('f=1', 'amp;t=2'),
						'parent_id'		=> 1,
						'left_id'		=> 2,
						'right_id'		=> 3,
						'depth'			=> 1,
					),
					array(
						'item_id'		=> 3,
						'item_title'	=> 'Item 3',
						'item_url'		=> 'app.php/forum',
						'url_path'		=> 'app.php/forum',
						'url_query'		=> array(),
						'parent_id'		=> 0,
						'left_id'		=> 5,
						'right_id'		=> 6,
						'depth'			=> 0,
					),
				),
				array(
					array(
						'PREV_DEPTH'	=> 0,
						'THIS_DEPTH'	=> 0,
						'NUM_KIDS'		=> 1,
						'IS_CURRENT'	=> true,
						'ITEM_ID'		=> 1,
					),
					array(
						'PREV_DEPTH'	=> 0,
						'THIS_DEPTH'	=> 1,
						'NUM_KIDS'		=> 0,
						'IS_CURRENT'	=> false,
						'ITEM_ID'		=> 2,
					),
					array(
						'PREV_DEPTH'	=> 1,
						'THIS_DEPTH'	=> 0,
						'NUM_KIDS'		=> 0,
						'IS_CURRENT'	=> false,
						'ITEM_ID'		=> 3,
					),
				),
			),
			array(
				array(
					'page_name'		=> 'app.php/forum',
					'query_string'	=> '',
				),
				array(
					'expanded'		=> false,
					'max_depth'		=> 1,
				),
				array(
					array(
						'item_id'		=> 1,
						'item_title'	=> 'Item 1',
						'item_url'		=> 'index.php',
						'url_path'		=> 'index.php',
						'url_query'		=> array(),
						'parent_id'		=> 0,
						'left_id'		=> 1,
						'right_id'		=> 6,
						'depth'			=> 0,
					),
					array(
						'item_id'		=> 2,
						'item_title'	=> 'Item 2',
						'item_url'		=> 'viewtopic.php?f=1&t=2',
						'url_path'		=> 'viewtopic.php',
						'url_query'		=> array('f=1', 'amp;t=2'),
						'parent_id'		=> 1,
						'left_id'		=> 2,
						'right_id'		=> 5,
						'depth'			=> 1,
					),
					array(
						'item_id'		=> 3,
						'item_title'	=> 'Item 3',
						'item_url'		=> 'app.php/forum',
						'url_path'		=> 'app.php/forum',
						'url_query'		=> array(),
						'parent_id'		=> 0,
						'left_id'		=> 3,
						'right_id'		=> 4,
						'depth'			=> 2,
					),
				),
				array(
					array(
						'PREV_DEPTH'	=> 1,
						'THIS_DEPTH'	=> 1,
						'NUM_KIDS'		=> 1,
						'IS_CURRENT'	=> false,
						'ITEM_ID'		=> 2,
					),
					array(
						'PREV_DEPTH'	=> 1,
						'THIS_DEPTH'	=> 0,
						'NUM_KIDS'		=> 0,
						'IS_CURRENT'	=> true,
						'ITEM_ID'		=> 3,
					),
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

		$tree->set_params($params);
		$tree->display_navlist($data, $this->ptemplate);

		$this->assertEquals($expected, $this->get_items_under_test($expected[0]));
	}

	protected function get_items_under_test($tpl)
	{
		$actual = array();
		foreach ($this->tpl_data['tree'] as $row)
		{
			$actual[] = array_intersect_key($row, $tpl);
		}

		return $actual;
	}
}
