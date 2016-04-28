<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\tree;

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
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/tree.xml');
	}

	/**
	 * Create the tree display service
	 *
	 * @param string $sql_where
	 * @return \blitze\sitemaker\services\tree\display
	 */
	protected function get_service($sql_where = '')
	{
		return $this->getMockBuilder('\blitze\sitemaker\services\tree\display')
			->setConstructorArgs(array($this->new_dbal(), 'phpbb_sm_menu_items', 'item_id', $sql_where))
			->setMethods(null)
			->getMock();
	}

	/**
	 * Test get_node_info
	 */
	public function test_get_node_info()
	{
		$expected = array(
			'item_id' => '2',
			'menu_id' => '1',
			'parent_id' => '1',
			'item_title' => 'Item 2',
			'item_url' => '',
			'item_icon' => '',
			'item_target' => '0',
			'left_id' => '2',
			'right_id' => '5',
			'depth' => '1',
			'item_parents' => '',
		);

		$tree = $this->get_service();
		$this->assertEquals($expected, $tree->get_node_info(2));
	}

	/**
	 * Data set for test_is_ancestor
	 *
	 * @return array
	 */
	public function is_ancestor_test_data()
	{
		return array(
			array(3, 4, false),
			array(3, 2, true),
			array(3, 1, true),
			array(2, 3, false),
			array(2, 2, false),
		);
	}

	/**
	 * Test item is ancestor of subject
	 *
	 * @depends test_get_node_info
	 * @dataProvider is_ancestor_test_data
	 * @param int $object_id
	 * @param int $subject_id
	 * @param bool $expected
	 */
	public function test_is_ancestor($object_id, $subject_id, $expected)
	{
		$tree = $this->get_service();
		$object = $tree->get_node_info($object_id);
		$subject = $tree->get_node_info($subject_id);

		$this->assertEquals($expected, $tree->is_ancestor($object, $subject));
	}

	/**
	 * Data set for test_get_tree_data
	 *
	 * @return array
	 */
	public function get_tree_data_test_data()
	{
		return array(
			array(
				0,
				0,
				'<option value="1" selected="selected>&#x251c;&#x2500; Item 1</option>' .
				'<option value="2">&nbsp;&nbsp;&nbsp;&nbsp;&#x251c;&#x2500; Item 2</option>' .
				'<option value="3" selected="selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#x251c;&#x2500; Item 3</option>' .
				'<option value="4">&#x251c;&#x2500; Item 4</option>',
			),
			array(
				1,
				0,
				'<option value="2">&#x251c;&#x2500; Item 2</option>' .
				'<option value="3" selected="selected>&nbsp;&nbsp;&nbsp;&nbsp;&#x251c;&#x2500; Item 3</option>',
			),
			array(
				1,
				1,
				'<option value="2">&#x251c;&#x2500; Item 2</option>' .
				'<option value="3" selected="selected>&nbsp;&nbsp;&nbsp;&nbsp;&#x251c;&#x2500; Item 3</option>',
			),
		);
	}

	/**
	 * Test item is ancestor of subject
	 *
	 * @dataProvider get_tree_data_test_data
	 * @param int $start
	 * @param int $max_depth
	 * @param bool $expected
	 */
	public function test_get_tree_data($start, $max_depth, $expected)
	{
		$tree = $this->get_service();

		$sql_array = array(
			'WHERE' => array('i.menu_id = 1')
		);

		$data = $tree->get_tree_data($start, $max_depth, $sql_array);

		$selected = array(1, 3);
		$result = $tree->display_options($data, 'item_title', $selected);

		$this->assertEquals($expected, $result);
	}
}
