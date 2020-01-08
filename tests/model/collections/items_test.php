<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\model\collections;

class items_test extends \phpbb_test_case
{
	protected $translator;

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
	 * Configure the test environment.
	 *
	 * @return void
	 */
	public function setUp()
	{
		global $request;

		parent::setUp();

		$request = $this->getMockBuilder('\phpbb\request\request_interface')
			->disableOriginalConstructor()
			->getMock();

		$this->translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$this->translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode('-', func_get_args());
			});
	}

	/**
	 * Test that required fields start with a null
	 */
	function test_collection()
	{
		$collection = new \blitze\sitemaker\model\collections\items;

		$this->assertFalse($collection->valid());

		for ($i = 0; $i < 3; $i++)
		{
			$collection[$i] = new \blitze\sitemaker\model\entity\item(array('item_id' => $i + 1));
		}

		$this->assertTrue($collection->valid());
		$this->assertEquals(3, $collection->count());

		$this->assertEquals(1, $collection->current()->get_item_id());
		$this->assertEquals(2, $collection->next()->get_item_id());

		$collection->rewind();
		$this->assertEquals(0, $collection->key());

		$this->assertTrue($collection->offsetExists(1));

		$item = $collection->offsetGet(1);
		$this->assertEquals(2, $item->get_item_id());

		$collection->offsetUnset($item);
		$this->assertNull($collection->offsetGet(1));

		$collection->offsetUnset(0);
		$this->assertNull($collection->offsetGet(0));

		$items = $collection->get_entities();
		$this->assertEquals(1, sizeof($items));

		$collection->clear();
		$this->assertFalse($collection->valid());
	}

	function test_adding_invalid_entity()
	{
		$collection = new \blitze\sitemaker\model\collections\blocks;

		$invalid_object = new \stdClass;

		try
		{
			$collection[] = $invalid_object;
			$this->fail('no exception thrown');
		}
		catch (\blitze\sitemaker\exception\invalid_argument $e)
		{
			$this->assertEquals('EXCEPTION_INVALID_ARGUMENT-entity-INVALID_ENTITY', $e->get_message($this->translator));
		}
	}
}
