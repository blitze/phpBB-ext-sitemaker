<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\model\menus\mapper;

class menus_test extends base_mapper
{
	/**
	 * Test the load method
	 */
	public function test_load()
	{
		$item_mapper = $this->get_mapper('items');
		$menu_mapper = $this->get_mapper('menus');

		$condition = array('menu_id', '=', 1);

		$menu = $menu_mapper->load($condition);
		$items_collection = $item_mapper->find($condition);

		$this->assertInstanceOf('\blitze\sitemaker\model\menus\entity\menu', $menu);
		$this->assertEquals('Menu 1', $menu->get_menu_name());
		$this->assertEquals($items_collection->count(), $menu->get_items()->count());
	}

	/**
	 * Test the find method
	 */
	public function test_find()
	{
		$mapper = $this->get_mapper('menus');

		// it should return all routes if no condition is specified
		$collection = $mapper->find();
		$this->assertEquals(2, $collection->count());

		// it should return 1 entity in the collection
		$collection = $mapper->find(array('menu_name', '=', 'Menu 2'));

		$this->assertInstanceOf('\blitze\sitemaker\model\menus\collections\menus', $collection);
		$this->assertEquals(1, $collection->count());

		$collection = $mapper->find(array('menu_name', '=', 'my menu'));
		$this->assertEquals(0, $collection->count());
	}

	/**
	 * Test adding new entity
	 */
	public function test_save_no_id_provided()
	{
		$mapper = $this->get_mapper('menus');

		$menu = $mapper->create_entity(array(
			'menu_name'	=> 'menu 3',
		));

		$result = $mapper->save($menu);

		$this->assertInstanceOf('\blitze\sitemaker\model\menus\entity\menu', $result);
		$this->assertEquals(3, $menu->get_menu_id());
	}

	/**
	 * Test updating an existing entity
	 */
	public function test_save_with_id_provided()
	{
		$mapper = $this->get_mapper('menus');

		$menu = $mapper->load(array('menu_id', '=', 1));
		$this->assertEquals('Menu 1', $menu->get_menu_name());

		$menu->set_menu_name('my menu');
		$mapper->save($menu);

		$menu = $mapper->load(array('menu_id', '=', 1));
		$this->assertEquals(1, $menu->get_menu_id());
		$this->assertEquals('My Menu', $menu->get_menu_name());
	}

	/**
	 * Test delete an entity
	 */
	public function test_delete_entity()
	{
		$item_mapper = $this->get_mapper('items');
		$menu_mapper = $this->get_mapper('menus');

		$condition = array('menu_id', '=', 1);

		$menu = $menu_mapper->load($condition);

		$items_collection = $item_mapper->find($condition);
		$this->assertGreaterThan(0, $items_collection->count());

		$menu_mapper->delete($menu);

		// it should no longer exist
		$this->assertNull($menu_mapper->load($condition));

		// it's items should no longer exist
		$this->assertEquals(0, $item_mapper->find($condition)->count());
	}

	/**
	 * Test delete by condition
	 */
	public function test_delete_by_condition()
	{
		$mapper = $this->get_mapper('menus');

		$condition = array('menu_id', '=', 2);

		$collection = $mapper->find($condition);
		$this->assertEquals(1, $collection->count());

		$mapper->delete($condition);

		$collection = $mapper->find($condition);
		$this->assertEquals(0, $collection->count());
	}
}
