<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\model\menus\mapper;

class items_test extends base_mapper
{
	/**
	 * Test the load method
	 */
	public function test_load()
	{
		$mapper = $this->get_mapper('items');

		$item = $mapper->load(array('item_id', '=', 2));

		$this->assertInstanceOf('\blitze\sitemaker\model\menus\entity\item', $item);
		$this->assertEquals('Item 2', $item->get_item_title());
	}

	/**
	 * Test the find method
	 */
	public function test_find()
	{
		$mapper = $this->get_mapper('items');

		// it should return all items if no condition is specified
		$collection = $mapper->find();
		$this->assertEquals(7, $collection->count());

		// it should return 3 entities in the collection
		$collection = $mapper->find(array('menu_id', '=', 1));

		$this->assertInstanceOf('\blitze\sitemaker\model\menus\collections\items', $collection);
		$this->assertEquals(3, $collection->count());

		$collection = $mapper->find(array('item_title', '=', 'some item'));
		$this->assertEquals(0, $collection->count());
	}

	/**
	 * Test adding new entity
	 */
	public function test_save_no_id_provided()
	{
		$mapper = $this->get_mapper('items');

		$item = $mapper->create_entity(array(
			'menu_id'		=> 1,
			'item_title'	=> 'Test',
		));
		$result = $mapper->save($item);

		$this->assertEquals(7, $result->get_left_id());
		$this->assertEquals(8, $result->get_right_id());
	}

	/**
	 * Test updating an existing entity
	 */
	public function test_save_with_id_provided()
	{
		$mapper = $this->get_mapper('items');

		$item = $mapper->load(array('item_id', '=', 2));
		$this->assertEquals('Item 2', $item->get_item_title());

		$item->set_item_title('my title');
		$mapper->save($item);

		$item = $mapper->load(array('item_id', '=', 2));
		$this->assertEquals(2, $item->get_item_id());
		$this->assertEquals('My title', $item->get_item_title());
	}

	/**
	 * Test delete by condition
	 */
	public function test_delete_by_condition()
	{
		$mapper = $this->get_mapper('items');

		$condition = array('menu_id', '=', 1);

		$collection = $mapper->find($condition);
		$this->assertEquals(3, $collection->count());

		$mapper->delete($condition);

		$collection = $mapper->find($condition);
		$this->assertEquals(0, $collection->count());
	}

	/**
	 * Data set for test_add_items
	 *
	 * @return array
	 */
	public function add_items_test_data()
	{
		return array(
			array(
				0,
				"Sample\n    Test Item",
				array(
					array(
						'item_id'		=> 1,
						'item_title'	=> 'Item 1',
						'parent_id'		=> 0,
						'left_id'		=> 1,
						'right_id'		=> 4,
						'depth'			=> 0,
					),
					array(
						'item_id'		=> 2,
						'item_title'	=> 'Item 2',
						'parent_id'		=> 1,
						'left_id'		=> 2,
						'right_id'		=> 3,
						'depth'			=> 1,
					),
					array(
						'item_id'		=> 3,
						'item_title'	=> 'Item 3',
						'parent_id'		=> 0,
						'left_id'		=> 5,
						'right_id'		=> 6,
						'depth'			=> 0,
					),
					array(
						'item_id'		=> 8,
						'item_title'	=> 'Sample',
						'parent_id'		=> 0,
						'left_id'		=> 7,
						'right_id'		=> 10,
						'depth'			=> 0,
					),
					array(
						'item_id'		=> 9,
						'item_title'	=> 'Test Item',
						'parent_id'		=> 8,
						'left_id'		=> 8,
						'right_id'		=> 9,
						'depth'			=> 1,
					),
				),
			),
			array(
				2,
				"Sample\n    Test Item",
				array(
					array(
						'item_id'		=> 1,
						'item_title'	=> 'Item 1',
						'parent_id'		=> 0,
						'left_id'		=> 1,
						'right_id'		=> 8,
						'depth'			=> 0,
					),
					array(
						'item_id'		=> 2,
						'item_title'	=> 'Item 2',
						'parent_id'		=> 1,
						'left_id'		=> 2,
						'right_id'		=> 7,
						'depth'			=> 1,
					),
					array(
						'item_id'		=> 8,
						'item_title'	=> 'Sample',
						'parent_id'		=> 2,
						'left_id'		=> 3,
						'right_id'		=> 6,
						'depth'			=> 2,
					),
					array(
						'item_id'		=> 9,
						'item_title'	=> 'Test Item',
						'parent_id'		=> 8,
						'left_id'		=> 4,
						'right_id'		=> 5,
						'depth'			=> 3,
					),
					array(
						'item_id'		=> 3,
						'item_title'	=> 'Item 3',
						'parent_id'		=> 0,
						'left_id'		=> 9,
						'right_id'		=> 10,
						'depth'			=> 0,
					),
				),
			),
		);
	}

	/**
	 * Test add items
	 * 
	 * @dataProvider add_items_test_data
	 * @param int $parent_id
	 * @param string $string
	 * @param array $expected
	 */
	public function test_add_items($parent_id, $string, array $expected)
	{
		$mapper = $this->get_mapper('items');

		$menu_id = 1;

		$mapper->add_items($menu_id, $parent_id, $string);

		$collection = $mapper->find(array('menu_id', '=', $menu_id));

		$actual = array();
		foreach ($collection as $entity)
		{
			$actual[] = array(
				'item_id'		=> $entity->get_item_id(),
				'item_title'	=> $entity->get_item_title(),
				'parent_id'		=> $entity->get_parent_id(),
				'left_id'		=> $entity->get_left_id(),
				'right_id'		=> $entity->get_right_id(),
				'depth'			=> $entity->get_depth(),
			);
		}
		$this->assertSame($expected, $actual);
	}

	/**
	 * Test update items
	 */
	public function test_update_items()
	{
		$mapper = $this->get_mapper('items');

		$submitted_items = array(
			5 => array('item_id' => 5, 'parent_id' => 0),
			7 => array('item_id' => 7, 'parent_id' => 5),
			6 => array('item_id' => 6, 'parent_id' => 7),
		);

		$expected = array(
			array(
				'item_id'		=> 5,
				'parent_id'		=> 0,
				'left_id'		=> 1,
				'right_id'		=> 6,
				'depth'			=> 0,
			),
			array(
				'item_id'		=> 7,
				'parent_id'		=> 5,
				'left_id'		=> 2,
				'right_id'		=> 5,
				'depth'			=> 1,
			),
			array(
				'item_id'		=> 6,
				'parent_id'		=> 7,
				'left_id'		=> 3,
				'right_id'		=> 4,
				'depth'			=> 2,
			),
		);

		// get current items
		$starting_items = $mapper->find(array('menu_id', '=', 2))->get_entities();

		// Now let's update the tree
		$mapper->update_items(2, $submitted_items);

		// Now let's confirm that items not in the submitted items list were indeed removed
		$removed_items = array_diff_key($starting_items, $submitted_items);
		$collection = $mapper->find(array('item_id', '=', array_keys($removed_items)));
		$this->assertEquals(0, $collection->count());

		// Now let's confirm that the submitted items have the correct left/right ids
		$collection = $mapper->find(array('menu_id', '=', 2));

		$actual = array();
		foreach ($collection as $entity)
		{
			$actual[] = array(
				'item_id'		=> $entity->get_item_id(),
				'parent_id'		=> $entity->get_parent_id(),
				'left_id'		=> $entity->get_left_id(),
				'right_id'		=> $entity->get_right_id(),
				'depth'			=> $entity->get_depth(),
			);
		}
		$this->assertSame($expected, $actual);
	}
}
