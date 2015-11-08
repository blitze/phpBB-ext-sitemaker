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
	protected $template;
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

		$user = new \phpbb\user('\phpbb\datetime');
		$user->page = $current_page;

		$this->template = $this->getMockBuilder('\blitze\sitemaker\services\template')
			->disableOriginalConstructor()
			->getMock();

		$tpl_data = array();
		$this->tpl_data = &$tpl_data;

		$this->template->expects($this->any())
			->method('assign_block_vars')
			->will($this->returnCallback(function($key, $data) use (&$tpl_data) {
				$tpl_data[$key][] = $data;
			}));

		$db = $this->new_dbal();

		$menu_items_table = 'phpbb_sm_menu_items';
		$primary_key = 'item_id';

		return new display($db, $user, $menu_items_table, $primary_key);
	}

	/**
	 * Data set for test_display_list
	 * @return array
	 */
	public function display_list_test_data()
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
						'S_PREV_DEPTH'	=> 0,
						'S_THIS_DEPTH'	=> 0,
						'S_NUM_KIDS'	=> 1,
						'S_CURRENT'		=> true,
						'ITEM_ID'		=> 1,
					),
					array(
						'S_PREV_DEPTH'	=> 0,
						'S_THIS_DEPTH'	=> 1,
						'S_NUM_KIDS'	=> 0,
						'S_CURRENT'		=> false,
						'ITEM_ID'		=> 2,
					),
					array(
						'S_PREV_DEPTH'	=> 1,
						'S_THIS_DEPTH'	=> 0,
						'S_NUM_KIDS'	=> 0,
						'S_CURRENT'		=> false,
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
						'S_PREV_DEPTH'	=> 0,
						'S_THIS_DEPTH'	=> 1,
						'S_NUM_KIDS'	=> 1,
						'S_CURRENT'		=> false,
						'ITEM_ID'		=> 2,
					),
					array(
						'S_PREV_DEPTH'	=> 1,
						'S_THIS_DEPTH'	=> 0,
						'S_NUM_KIDS'	=> 0,
						'S_CURRENT'		=> true,
						'ITEM_ID'		=> 3,
					),
				),
			),
		);
	}

	/**
	 * Test display list
	 *
	 * @dataProvider display_list_test_data
	 */
	public function test_display_list($current_page, $params, $data, $expected)
	{
		$tree = $this->get_service($current_page);

		$tree->set_params($params);
		$tree->display_list($data, $this->template);

		$this->assertSame($expected, $this->get_items_under_test($expected[0]));
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
