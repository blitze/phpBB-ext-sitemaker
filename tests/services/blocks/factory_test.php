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

require_once dirname(__FILE__) . '/../fixtures/ext/foo/bar/blocks/foo_block.php';
require_once dirname(__FILE__) . '/../fixtures/ext/foo/bar/blocks/baz_block.php';

class factory_test extends \phpbb_test_case
{
	protected $user;
	protected $blocks;
	protected $ptemplate;

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

		$phpbb_container = new \phpbb_mock_container_builder();

		$this->blocks = new \phpbb\di\service_collection($phpbb_container);

		$this->blocks->add('my.foo.block');
		$this->blocks->add('my.baz.block');

		$foo_block = new \foo\bar\blocks\foo_block;
		$baz_block = new \foo\bar\blocks\baz_block;

		$foo_block->set_name('my.foo.block');
		$baz_block->set_name('my.baz.block');

		$phpbb_container->set('my.foo.block', $foo_block);
		$phpbb_container->set('my.baz.block', $baz_block);

		$this->user = $this->getMock('\phpbb\user', array(), array('\phpbb\datetime'));

		$this->user->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return ucwords(strtolower(str_replace('_', ' ', implode(' ', func_get_args()))));
			});

		$this->ptemplate = $this->getMockBuilder('\blitze\sitemaker\services\template')
			->disableOriginalConstructor()
			->getMock();
	}

	/**
	 * Test the constructor
	 */
	public function test_constructor_calls_register_blocks()
	{
		$classname = '\blitze\sitemaker\services\blocks\factory';

		$factory = $this->getMockBuilder($classname)
			->disableOriginalConstructor()
			->getMock();

		$factory->expects($this->once())
			->method('register_blocks')
			->with($this->blocks);

		$reflectedClass = new \ReflectionClass($classname);
		$constructor = $reflectedClass->getConstructor();
		$constructor->invoke($factory, $this->user, $this->ptemplate, $this->blocks);
	}

	/**
	 * Test the get_block method
	 */
	public function test_get_block()
	{
		$expected = '\foo\bar\blocks\foo_block';

		$factory = new factory($this->user, $this->ptemplate, $this->blocks);

		$block = $factory->get_block('my.foo.block');

		$this->assertInstanceOf($expected, $block);
		$this->assertEquals('my.foo.block', $block->get_name());
	}

	/**
	 * Test the get_all_blocks method
	 */
	public function test_get_all_blocks()
	{
		$expected = array(
			'my.foo.block'	=> 'My Foo Block',
			'my.baz.block'	=> 'My Baz Block',
		);

		$factory = new factory($this->user, $this->ptemplate, $this->blocks);

		$this->assertEquals($expected, $factory->get_all_blocks());
	}
}
