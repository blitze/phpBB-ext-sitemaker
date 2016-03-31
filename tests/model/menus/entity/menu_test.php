<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\model\menus\entity;

use blitze\sitemaker\model\menus\entity\menu;

class menu_test extends \phpbb_test_case
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
	 * Test exception on required fields
	 */
	public function test_required_fields()
	{
		$required_fields = array('menu_name');
		$data = array(
			'menu_name'	=> 'menu 1',
		);

		foreach ($required_fields as $field)
		{
			$test_data = $data;
			unset($test_data[$field]);

			$entity = new menu($test_data);

			try
			{
				$entity->to_db();
				$this->fail('no exception thrown');
			}
			catch (\blitze\sitemaker\exception\invalid_argument $e)
			{
				$this->assertEquals("EXCEPTION_INVALID_ARGUMENT $field FIELD_MISSING", $e->get_message($this->user));
			}
		}
	}

	function test_id_only_set_once()
	{
		$menu = new menu(array());

		$id = 10;
		$menu->set_menu_id($id);
		$this->assertEquals($id, $menu->get_menu_id());

		$another_id = 20;
		$this->assertNotEquals($id, $another_id);

		$menu->set_menu_id($another_id);
		$this->assertEquals($id, $menu->get_menu_id());
	}

	/**
	 * Data set for test_accessors_and_mutators
	 *
	 * @return array
	 */
	public function accessors_and_mutators_test_data()
	{
		return array(
			array('menu_name', '', 'menu 1', 'Menu 1', 'my menu', 'My Menu'),
		);
	}

	/**
	 * Test entity accessor and mutator
	 *
	 * @dataProvider accessors_and_mutators_test_data
	 */
	public function test_accessors_and_mutators($property, $default, $value1, $expect1, $value2, $expect2)
	{
		$mutator = 'set_' . $property;
		$accessor = 'get_' . $property;

		$menu = new menu(array());

		$this->assertSame($default, $menu->$accessor());

		$result = $menu->$mutator($value1);
		$this->assertSame($expect1, $menu->$accessor());
		$this->assertInstanceOf('\blitze\sitemaker\model\menus\entity\menu', $result);

		$menu->$mutator($value2);
		$this->assertNotSame($expect1, $menu->$accessor());
		$this->assertSame($expect2, $menu->$accessor());
	}

	function test_bad_get_set_exceptions()
	{
		$menu = new menu(array());

		try
		{
			$this->assertNull($menu->get_foo());
			$this->fail('no exception thrown');
		}
		catch (\blitze\sitemaker\exception\invalid_argument $e)
		{
			$this->assertEquals('EXCEPTION_INVALID_ARGUMENT foo INVALID_PROPERTY', $e->get_message($this->user));
		}

		try
		{
			$this->assertNull($menu->set_foo('bar'));
			$this->fail('no exception thrown');
		}
		catch (\blitze\sitemaker\exception\invalid_argument $e)
		{
			$this->assertEquals('EXCEPTION_INVALID_ARGUMENT foo INVALID_PROPERTY', $e->get_message($this->user));
		}

		try
		{
			$this->assertNull($menu->set_items(new \StdClass));
			$this->fail('no exception thrown');
		}
		catch (\blitze\sitemaker\exception\invalid_argument $e)
		{
			$this->assertEquals('EXCEPTION_INVALID_ARGUMENT items INVALID_DATA_TYPE', $e->get_message($this->user));
		}
	}

	function test_to_array()
	{
		$menu = new menu(array(
			'menu_id'	=> 1,
			'menu_name'	=> 'menu 1',
		));

		$to_array_expected = array(
			'menu_id'	=> 1,
			'menu_name'	=> 'Menu 1',
			'items'		=> array(),
		);

		$to_db_expected = array(
			'menu_name'	=> 'Menu 1',
		);

		$this->assertSame($to_array_expected, $menu->to_array());
		$this->assertSame($to_db_expected, $menu->to_db());
	}
}
