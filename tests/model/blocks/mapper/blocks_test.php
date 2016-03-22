<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\model\blocks\mapper;

class blocks_test extends base_mapper
{
	/**
	 * Test the load method
	 */
	public function test_load()
	{
		$mapper = $this->get_mapper('blocks');

		$block = $mapper->load(array('bid', '=', 1));

		$this->assertInstanceOf('\blitze\sitemaker\model\blocks\entity\block', $block);
		$this->assertEquals('blitze.sitemaker.blocks.stats', $block->get_name());
	}

	/**
	 * Test the find method
	 */
	public function test_find()
	{
		$mapper = $this->get_mapper('blocks');

		// it should return all blocks if no condition is specified
		$collection = $mapper->find();
		$this->assertEquals(5, $collection->count());

		// it should return 3 entities in the collection
		$collection = $mapper->find(array(
			array('route_id', '=', 2),
			array('style', '=', 1),
		));

		$this->assertInstanceOf('\blitze\sitemaker\model\blocks\collections\blocks', $collection);
		$this->assertEquals(3, $collection->count());

		$collection = $mapper->find(array('name', '=', 'my block'));
		$this->assertEquals(0, $collection->count());
	}

	/**
	 * Test adding new entity
	 */
	public function test_save_no_id_provided()
	{
		$mapper = $this->get_mapper('blocks');

		$block = $mapper->create_entity(array(
			'name'		=> 'blitze.sitemaker.blocks.whois',
			'position'	=> 'sidebar',
			'route_id'	=> 1,
			'style'		=> 1,
			'weight'	=> 1,
		));

		$result = $mapper->save($block);

		$this->assertInstanceOf('\blitze\sitemaker\model\blocks\entity\block', $result);
		$this->assertEquals(6, $result->get_bid());
	}

	/**
	 * Test updating an existing entity
	 */
	public function test_save_with_id_provided()
	{
		$mapper = $this->get_mapper('blocks');

		$block = $mapper->load(array('bid', '=', 2));
		$this->assertEquals('sidebar', $block->get_position());

		$block->set_position('top');
		$mapper->save($block);

		$block = $mapper->load(array('bid', '=', 2));
		$this->assertEquals(2, $block->get_bid());
		$this->assertEquals('top', $block->get_position());
	}

	/**
	 * Test delete an entity
	 */
	public function test_delete_entity()
	{
		$mapper = $this->get_mapper('blocks');

		$collection = $mapper->find(array(
			array('route_id', '=', 2),
			array('style', '=', 1),
		));

		$block1 = $collection->current();
		$block2 = $collection->next();

		$id1 = $block1->get_bid();
		$id2 = $block2->get_bid();

		$this->assertEquals(1, $block2->get_weight());

		$mapper->delete($block1);

		// it should no longer exist
		$this->assertNull($mapper->load(array('bid', '=', $id1)));

		// other block on same position should move up
		$block2 = $mapper->load(array('bid', '=', $id2));

		$this->assertEquals(0, $block2->get_weight());
	}

	/**
	 * Test delete by condition
	 */
	public function test_delete_by_condition()
	{
		$mapper = $this->get_mapper('blocks');

		$condition = array(
			array('route_id', '=', 2),
			array('style', '=', 1),
		);

		$collection = $mapper->find($condition);
		$this->assertEquals(3, $collection->count());

		$mapper->delete($condition);

		$collection = $mapper->find($condition);
		$this->assertEquals(0, $collection->count());
	}
}
