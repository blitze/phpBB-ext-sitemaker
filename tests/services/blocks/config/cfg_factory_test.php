<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks\config;

use blitze\sitemaker\services\blocks\config\cfg_factory;

class cfg_factory_test extends \phpbb_test_case
{
	protected $cfg_fields;

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
		global $phpbb_container;

		parent::setUp();

		$translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();

		$phpbb_container = new \phpbb_mock_container_builder();

		$this->cfg_fields = new \phpbb\di\service_collection($phpbb_container);

		$this->cfg_fields->add('my.foo.field');

		$phpbb_container->set('my.foo.field', new \blitze\sitemaker\services\blocks\config\fields\custom($translator));
	}

	/**
	 * Test the constructor
	 */
	public function test_constructor_calls_register_field()
	{
		$cfg_factory = $this->getMockBuilder('\blitze\sitemaker\services\blocks\config\cfg_factory')
			 ->setMethods(array('register_fields'))
			 ->disableOriginalConstructor()
			 ->getMock();
		$cfg_factory->expects($this->once())
			 ->method('register_fields')
			 ->with($this->cfg_fields);

		$cfg_factory->__construct($this->cfg_fields);
	}

	/**
	 * Test the get_block method
	 */
	public function test_get_cfg_field()
	{
		$expected = '\blitze\sitemaker\services\blocks\config\fields\custom';

		$factory = new cfg_factory($this->cfg_fields);

		$cfg_field = $factory->get('custom');

		$this->assertInstanceOf($expected, $cfg_field);
		$this->assertEquals('custom', $cfg_field->get_name());

		$this->assertEquals(false, $factory->get('foo_field'));
	}
}
