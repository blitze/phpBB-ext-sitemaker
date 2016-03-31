<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\model\menus\collections;

class menus_test extends \phpbb_test_case
{
	protected $user;

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
		parent::setUp();

		$this->user = $this->getMock('\phpbb\user', array(), array('\phpbb\datetime'));
		$this->user->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode(' ', func_get_args());
			});
	}

	/**
	 * Test that required fields start with a null
	 */
	function test_collection()
	{
		$collection = new \blitze\sitemaker\model\menus\collections\menus;

		$this->assertFalse($collection->valid());

		for ($i = 0; $i < 3; $i++)
		{
			$collection[$i] = new \blitze\sitemaker\model\menus\entity\menu(array('menu_id' => $i + 1));
		}

		$this->assertTrue($collection->valid());
		$this->assertEquals(3, $collection->count());

		$this->assertEquals(1, $collection->current()->get_menu_id());
		$this->assertEquals(2, $collection->next()->get_menu_id());

		$collection->rewind();
		$this->assertEquals(0, $collection->key());

		$this->assertTrue($collection->offsetExists(1));

		$menu = $collection->offsetGet(1);
		$this->assertEquals(2, $menu->get_menu_id());
		$this->assertTrue($collection->offsetUnset($menu));
		$this->assertTrue($collection->offsetUnset(0));
		$this->assertNull($collection->offsetGet(0));

		$menus = $collection->get_entities();
		$this->assertEquals(1, sizeof($menus));

		$collection->clear();
		$this->assertFalse($collection->valid());
	}

	function test_adding_invalid_entity()
	{
		$collection = new \blitze\sitemaker\model\menus\collections\menus;

		$invalid_object = new \stdClass;

		try
		{
			$collection[] = $invalid_object;
			$this->fail('no exception thrown');
		}
		catch (\blitze\sitemaker\exception\invalid_argument $e)
		{
			$this->assertEquals('EXCEPTION_INVALID_ARGUMENT entity INVALID_ENTITY', $e->get_message($this->user));
		}
	}
}
