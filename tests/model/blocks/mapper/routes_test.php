<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\model\blocks\mapper;

class routes_test extends base_mapper
{
	/**
	 * Test the load method
	 */
	public function test_load()
	{
		$block_mapper = $this->get_mapper('blocks');
		$route_mapper = $this->get_mapper('routes');

		$condition = array(
			array('route_id', '=', 1),
			array('style', '=', 1),
		);

		$route = $route_mapper->load($condition);
		$blocks_collection = $block_mapper->find($condition);

		$this->assertInstanceOf('\blitze\sitemaker\model\blocks\entity\route', $route);
		$this->assertEquals('index.php', $route->get_route());
		$this->assertEquals($blocks_collection->count(), $route->get_blocks()->count());
	}

	/**
	 * Test the find method
	 */
	public function test_find()
	{
		$mapper = $this->get_mapper('routes');

		// it should return all routes if no condition is specified
		$collection = $mapper->find();
		$this->assertEquals(3, $collection->count());

		// it should return 2 entities in the collection
		$collection = $mapper->find(array('style', '=', 1));

		$this->assertInstanceOf('\blitze\sitemaker\model\blocks\collections\routes', $collection);
		$this->assertEquals(2, $collection->count());

		$collection = $mapper->find(array('ext_name', '=', 'phpbb/pages'));
		$this->assertEquals(0, $collection->count());
	}

	/**
	 * Test adding new entity
	 */
	public function test_save_no_id_provided()
	{
		$mapper = $this->get_mapper('routes');

		$route = $mapper->create_entity(array(
			'ext_name'	=> 'phpbb/pages',
			'route'		=> 'app.php/pages/about',
			'style'		=> 1,
		));

		$result = $mapper->save($route);

		$this->assertInstanceOf('\blitze\sitemaker\model\blocks\entity\route', $result);
		$this->assertEquals(4, $result->get_route_id());
	}

	/**
	 * Test updating an existing entity
	 */
	public function test_save_with_id_provided()
	{
		$mapper = $this->get_mapper('routes');

		$route = $mapper->load(array('route_id', '=', 2));
		$this->assertEquals('app.php/foo/test/', $route->get_route());

		$route->set_route('app.php/foo/updated/');
		$mapper->save($route);

		$route = $mapper->load(array('route_id', '=', 2));
		$this->assertEquals(2, $route->get_route_id());
		$this->assertEquals('app.php/foo/updated/', $route->get_route());
	}

	/**
	 * Test delete an entity
	 */
	public function test_delete_entity()
	{
		$block_mapper = $this->get_mapper('blocks');
		$route_mapper = $this->get_mapper('routes');

		$condition = array(
			array('route_id', '=', 1),
			array('style', '=', 1),
		);

		$route = $route_mapper->load($condition);
		$route_id = $route->get_route_id();

		$blocks_collection = $block_mapper->find($condition);
		$this->assertGreaterThan(0, $blocks_collection->count());

		$route_mapper->delete($route);

		// it should no longer exist
		$this->assertNull($route_mapper->load($condition));

		// it's blocks should no longer exist
		$this->assertEquals(0, $block_mapper->find($condition)->count());
	}

	/**
	 * Test delete by condition
	 */
	public function test_delete_by_condition()
	{
		$mapper = $this->get_mapper('routes');

		$condition = array('style', '=', 1);

		$collection = $mapper->find($condition);
		$this->assertEquals(2, $collection->count());

		$mapper->delete($condition);

		$collection = $mapper->find($condition);
		$this->assertEquals(0, $collection->count());
	}
}
