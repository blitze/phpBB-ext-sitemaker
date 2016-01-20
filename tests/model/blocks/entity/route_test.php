<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\model\blocks\entity;

use blitze\sitemaker\model\blocks\entity\route;

class route_test extends \phpbb_test_case
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
	 * Test exception on required fields
	 */
	public function test_required_fields()
	{
		$required_fields = array('route', 'style');
		$data = array(
			'route'		=> 'index.php',
			'style'		=> 1,
		);

		foreach ($required_fields as $field)
		{
			$test_data = $data;
			unset($test_data[$field]);

			$entity = new route($test_data);

			try
			{
				$entity->to_db();
				$this->fail('no exception thrown');
			}
			catch (\blitze\sitemaker\exception\invalid_argument $e)
			{
				$this->assertEquals($field, $e->getMessage());
			}
		}
	}

	function test_id_only_set_once()
	{
		$route = new route(array());

		$id = 10;
		$route->set_route_id($id);
		$this->assertEquals($id, $route->get_route_id());

		$another_id = 20;
		$this->assertNotEquals($id, $another_id);

		$route->set_route_id($another_id);
		$this->assertEquals($id, $route->get_route_id());
	}

	/**
	 * Data set for test_accessors_and_mutators
	 *
	 * @return array
	 */
	public function accessors_and_mutators_test_data()
	{
		return array(
			array('ext_name', '', 'some string', 'some string', 'another string', 'another string'),
			array('route', '', 'some string', 'some string', 'another string', 'another string'),
			array('style', 0, 1, 1, 2, 2),
			array('hide_blocks', false, 1, true, false, false),
			array('has_blocks', false, 0, false, true, true),
			array('ex_positions', array(), array(), array(), array('sidebar', 'top'), array('sidebar', 'top')),
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

		$route = new route(array());

		$this->assertSame($default, $route->$accessor());

		$result = $route->$mutator($value1);
		$this->assertSame($expect1, $route->$accessor());
		$this->assertInstanceOf('\blitze\sitemaker\model\blocks\entity\route', $result);

		$route->$mutator($value2);
		$this->assertNotSame($expect1, $route->$accessor());
		$this->assertSame($expect2, $route->$accessor());
	}

	function test_bad_get_set_exceptions()
	{
		$route = new route(array());

		try
		{
			$this->assertNull($route->get_foo());
			$this->fail('no exception thrown');
		}
		catch (\blitze\sitemaker\exception\unexpected_value $e)
		{
			$this->assertEquals('get_foo', $e->getMessage());
		}

		try
		{
			$this->assertNull($route->set_foo('bar'));
			$this->fail('no exception thrown');
		}
		catch (\blitze\sitemaker\exception\unexpected_value $e)
		{
			$this->assertEquals('set_foo', $e->getMessage());
		}

		try
		{
			$this->assertNull($route->set_blocks(new \StdClass));
			$this->fail('no exception thrown');
		}
		catch (\blitze\sitemaker\exception\unexpected_value $e)
		{
			$this->assertEquals('blocks', $e->getMessage());
		}
	}

	function test_cloning_entity()
	{
		$route = new route(array(
			'route_id' => 3,
		));

		$this->assertEquals(3, $route->get_route_id());

		$copy = clone $route;
		$this->assertNull($copy->get_route_id());
	}

	function test_to_array()
	{
		$route = new route(array(
			'route_id'	=> 1,
			'ext_name'	=> 'phpbb/pages',
			'route'		=> 'page/about_us',
			'style'		=> 1,
			'ex_positions'	=> array('subcontent', 'top'),
		));

		$to_array_expected = array(
			'route_id'	=> 1,
			'ext_name'	=> 'phpbb/pages',
			'route'		=> 'page/about_us',
			'style'		=> 1,
			'hide_blocks'	=> false,
			'has_blocks'	=> false,
			'ex_positions'	=> array('subcontent', 'top'),
			'blocks'		=> array(),
		);

		$to_db_expected = array(
			'ext_name'	=> 'phpbb/pages',
			'route'		=> 'page/about_us',
			'style'		=> 1,
			'hide_blocks'	=> false,
			'has_blocks'	=> false,
			'ex_positions'	=> 'subcontent,top',
		);

		$this->assertSame($to_array_expected, $route->to_array());
		$this->assertSame($to_db_expected, $route->to_db());
	}
}
