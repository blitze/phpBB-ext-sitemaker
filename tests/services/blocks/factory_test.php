<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks;

use blitze\sitemaker\services\blocks\factory;

require_once dirname(__FILE__) . '/ext/foo/bar/blocks/foo_block.php';
require_once dirname(__FILE__) . '/ext/foo/bar/blocks/baz_block.php';

class factory_test extends \phpbb_test_case
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

		$this->blocks = array(
			'my.foo.block'	=> new \foo\bar\blocks\foo_block(),
			'my.baz.block'	=> new \foo\bar\blocks\baz_block(),
		);

		$this->user = new \phpbb\user('\phpbb\datetime');

		$this->ptemplate = $this->getMockBuilder('\blitze\sitemaker\services\template')
			->disableOriginalConstructor()
			->getMock();
	}

	/**
	 * Test the constructor
	 */
	public function test_constructor_calls_load_blocks()
	{
		$classname = '\blitze\sitemaker\services\blocks\factory';
		$blocks = array(
			'foo.bar.block'	=> 'my_block'
		);

		$factory = $this->getMockBuilder($classname)
			->disableOriginalConstructor()
			->getMock();

		$factory->expects($this->once())
			->method('register_blocks')
			->with($blocks);

		$reflectedClass = new \ReflectionClass($classname);
		$constructor = $reflectedClass->getConstructor();
		$constructor->invoke($factory, $this->user, $this->ptemplate, $blocks);
	}

	/**
	 * Test the get_block method
	 */
	public function test_get_block()
	{
		$expected = '\foo\bar\blocks\foo_block';

		$factory = new factory($this->user, $this->ptemplate, $this->blocks);

		$block = $factory->get_block('my.foo.block', array());

		$this->assertInstanceOf($expected, $block);
	}

	/**
	 * Test the get_all_blocks method
	 */
	public function test_get_all_blocks()
	{
		$expected = array(
			'my.foo.block'	=> 'MY_FOO_BLOCK',
			'my.baz.block'	=> 'MY_BAZ_BLOCK',
		);

		$factory = new factory($this->user, $this->ptemplate, $this->blocks);

		$this->assertEquals($expected, $factory->get_all_blocks());
	}
}
