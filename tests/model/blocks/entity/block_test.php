<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\model\blocks\entity;

use blitze\sitemaker\model\blocks\entity\block;

class block_test extends \phpbb_test_case
{
	protected $trans;

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
	 * Test exception on required fields
	 */
	public function test_required_fields()
	{
		$required_fields = array('name', 'route_id', 'position', 'style');
		$data = array(
			'name'		=> 'blitze.sitemaker.block.whois',
			'route_id'	=> '2',
			'position'	=> 'sidebar',
			'style'		=> 1,
		);

		foreach ($required_fields as $field)
		{
			$test_data = $data;
			unset($test_data[$field]);

			$entity = new block($test_data);

			try
			{
				$entity->to_db();
				$this->fail('no exception thrown');
			}
			catch (\blitze\sitemaker\exception\invalid_argument $e)
			{
				$this->assertEquals("EXCEPTION_INVALID_ARGUMENT-{$field}-FIELD_MISSING", $e->get_message($this->translator));
			}
		}
	}

	function test_id_only_set_once()
	{
		$block = new block(array());

		$id = 10;
		$block->set_bid($id);
		$this->assertEquals($id, $block->get_bid());

		$another_id = 20;
		$this->assertNotEquals($id, $another_id);

		$block->set_bid($another_id);
		$this->assertEquals($id, $block->get_bid());
	}

	/**
	 * Data set for test_accessors_and_mutators
	 *
	 * @return array
	 */
	public function accessors_and_mutators_test_data()
	{
		return array(
			array('icon', '', 'fa', 'fa', 'fa fa-check', 'fa fa-check'),
			array('name', '', 'some string', 'some string', 'another string', 'another string'),
			array('title', '', 'some title', 'Some title', 'my block', 'My block'),
			array('route_id', 0, 1, 1, 2, 2),
			array('position', '', 'sidebar', 'sidebar', 'bottom', 'bottom'),
			array('weight', 0, 1, 1, 2, 2),
			array('style', 0, 1, 1, 2, 2),
			array('permission', array(), '', array(), array(1, 4), array(1, 4)),
			array('class', '', '', '', 'bg1', ' bg1'),
			array('status', true, 0, false, true, true),
			array('type', 0, 1, 1, 2, 2),
			array('hide_title', false, 1, true, false, false),
			array('hash', '', 'some string', 'some string', 'another string', 'another string'),
			array('settings', array(), array(), array(), array('my_setting' => 2), array('my_setting' => 2)),
			array('view', '', 'some view', 'some view', 'another view', 'another view'),
		);
	}

	/**
	 * Test entity accessor and mutator
	 *
	 * @dataProvider accessors_and_mutators_test_data
	 * @param $property
	 * @param $default
	 * @param $value1
	 * @param $expect1
	 * @param $value2
	 * @param $expect2
	 */
	public function test_accessors_and_mutators($property, $default, $value1, $expect1, $value2, $expect2)
	{
		$mutator = 'set_' . $property;
		$accessor = 'get_' . $property;

		$block = new block(array());

		$this->assertSame($default, $block->$accessor());

		$result = $block->$mutator($value1);
		$this->assertSame($expect1, $block->$accessor());
		$this->assertInstanceOf('\blitze\sitemaker\model\blocks\entity\block', $result);

		$block->$mutator($value2);
		$this->assertNotSame($expect1, $block->$accessor());
		$this->assertSame($expect2, $block->$accessor());
	}

	/**
	 *
	 */
	function test_bad_get_set_exceptions()
	{
		$block = new block(array());

		try
		{
			$this->assertNull($block->get_foo());
			$this->fail('no exception thrown');
		}
		catch (\blitze\sitemaker\exception\invalid_argument $e)
		{
			$this->assertEquals('EXCEPTION_INVALID_ARGUMENT-foo-INVALID_PROPERTY', $e->get_message($this->translator));
		}

		try
		{
			$this->assertNull($block->set_foo('bar'));
			$this->fail('no exception thrown');
		}
		catch (\blitze\sitemaker\exception\invalid_argument $e)
		{
			$this->assertEquals('EXCEPTION_INVALID_ARGUMENT-foo-INVALID_PROPERTY', $e->get_message($this->translator));
		}
	}

	/**
	 *
	 */
	function test_cloning_entity()
	{
		$block = new block(array(
			'bid' => 2,
		));

		$this->assertEquals(2, $block->get_bid());

		$copy = clone $block;
		$this->assertNull($copy->get_bid());
	}

	/**
	 *
	 */
	function test_to_array()
	{
		$block = new block(array(
			'bid'		=> 1,
			'route_id'	=> 1,
			'style'		=> 1,
			'name'		=> 'blitze.sitemaker.block.birthday',
			'title'		=> 'my block',
			'position'	=> 'sidebar',
			'permission'	=> array(1, 4),
			'settings'		=> array('my_setting' => 2),
		));

		$to_array_expected = array(
			'bid'			=> 1,
			'icon'			=> '',
			'name'			=> 'blitze.sitemaker.block.birthday',
			'title'			=> 'My block',
			'route_id'		=> 1,
			'position'		=> 'sidebar',
			'weight'		=> 0,
			'style'			=> 1,
			'permission'	=> array(1, 4),
			'class'			=> '',
			'status'		=> true,
			'type'			=> 0,
			'hide_title'	=> false,
			'hash'			=> 'dc47ce9ed8e1807a1701f68bf5a1849c',
			'settings'		=> array('my_setting' => 2),
			'view'			=> '',
		);

		$to_db_expected = array(
			'icon'			=> '',
			'name'			=> 'blitze.sitemaker.block.birthday',
			'title'			=> 'My block',
			'route_id'		=> 1,
			'position'		=> 'sidebar',
			'weight'		=> 0,
			'style'			=> 1,
			'permission'	=> '1,4',
			'class'			=> '',
			'status'		=> true,
			'type'			=> 0,
			'hide_title'	=> false,
			'hash'			=> 'dc47ce9ed8e1807a1701f68bf5a1849c',
			'settings'		=> '{"my_setting":2}',
			'view'			=> '',
		);

		$this->assertSame($to_array_expected, $block->to_array());
		$this->assertSame($to_db_expected, $block->to_db());
	}
}
