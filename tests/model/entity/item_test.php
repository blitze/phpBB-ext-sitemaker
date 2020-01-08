<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\model\entity;

use Symfony\Component\HttpFoundation\Request;
use blitze\sitemaker\model\entity\item;

class item_test extends \phpbb_test_case
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
		global $config, $request, $symfony_request, $user;

		parent::setUp();

		$symfony_request = new Request();

		$config = new \phpbb\config\config(array(
			'force_server_vars' => false
		));

		$request = $this->getMockBuilder('\phpbb\request\request_interface')
			->disableOriginalConstructor()
			->getMock();

		$user = $this->getMockBuilder('\phpbb\user')
			->disableOriginalConstructor()
			->getMock();
		$user->host = 'www.example.com';
		$user->page['root_script_path'] = '/phpBB/';

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
		$required_fields = array('menu_id', 'item_title');
		$data = array(
			'menu_id'		=> '2',
			'item_title'	=> 'item 1',
		);

		foreach ($required_fields as $field)
		{
			$test_data = $data;
			unset($test_data[$field]);

			$entity = new item($test_data);

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

	/**
	 *
	 */
	function test_id_only_set_once()
	{
		$item = new item(array());

		$id = 10;
		$item->set_item_id($id);
		$this->assertEquals($id, $item->get_item_id());

		$another_id = 20;
		$this->assertNotEquals($id, $another_id);

		$item->set_item_id($another_id);
		$this->assertEquals($id, $item->get_item_id());
	}

	/**
	 * Data set for test_accessors_and_mutators
	 *
	 * @return array
	 */
	public function accessors_and_mutators_test_data()
	{
		return array(
			array('menu_id', 0, 1, 1, 2, 2),
			array('parent_id', 0, 1, 1, 2, 2),
			array('item_title', '', 'some title', 'Some title', 'another title', 'Another title'),
			array('item_url', '', 'index.php', '/index.php', 'forum', '/forum'),
			array('item_icon', '', 'fa fa-arrow', 'fa fa-arrow ', 'fa fa-check', 'fa fa-check '),
			array('item_target', 0, 1, 1, 0, 0),
			array('left_id', 0, 1, 1, 2, 2),
			array('right_id', 0, 1, 1, 2, 2),
			array('depth', 0, 1, 1, 2, 2),
			array('item_parents', '', 'some string', 'some string', 'other string', 'other string'),
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

		$item = new item(array());

		$this->assertSame($default, $item->$accessor());

		$result = $item->$mutator($value1);
		$this->assertSame($expect1, $item->$accessor());
		$this->assertInstanceOf('\blitze\sitemaker\model\entity\item', $result);

		$item->$mutator($value2);
		$this->assertNotSame($expect1, $item->$accessor());
		$this->assertSame($expect2, $item->$accessor());
	}

	/**
	 *
	 */
	function test_bad_get_set_exceptions()
	{
		$item = new item(array());

		try
		{
			$this->assertNull($item->get_foo());
			$this->fail('no exception thrown');
		}
		catch (\blitze\sitemaker\exception\invalid_argument $e)
		{
			$this->assertEquals('EXCEPTION_INVALID_ARGUMENT-foo-INVALID_PROPERTY', $e->get_message($this->translator));
		}

		try
		{
			$this->assertNull($item->set_foo('bar'));
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
	function test_to_array()
	{
		$item = new item(array(
			'item_id'		=> 1,
			'menu_id'		=> 1,
			'parent_id'		=> 0,
			'item_title'	=> 'item 1',
			'item_url'		=> 'app.php/foo/bar',
			'item_icon'		=> 'fa fa-bookmark',
			'item_target'	=> 1,
			'left_id'		=> 1,
			'right_id'		=> 2,
			'item_parents'	=> '',
			'depth'			=> 0,
		));

		$to_array_expected = array(
			'item_id'		=> 1,
			'menu_id'		=> 1,
			'parent_id'		=> 0,
			'item_title'	=> 'Item 1',
			'item_url'		=> '/app.php/foo/bar',
			'item_icon'		=> 'fa fa-bookmark ',
			'item_target'	=> 1,
			'left_id'		=> 1,
			'right_id'		=> 2,
			'item_parents'	=> '',
			'depth'			=> 0,
			'full_url'		=> 'http://www.example.com/phpBB/app.php/foo/bar',
			'board_url'		=> 'http://www.example.com/phpBB',
			'mod_rewrite_enabled' => false,
		);

		$to_db_expected = array(
			'item_id'		=> 1,
			'menu_id'		=> 1,
			'parent_id'		=> 0,
			'item_title'	=> 'Item 1',
			'item_url'		=> '/app.php/foo/bar',
			'item_icon'		=> 'fa fa-bookmark ',
			'item_target'	=> 1,
			'left_id'		=> 1,
			'right_id'		=> 2,
			'item_parents'	=> '',
			'depth'			=> 0,
		);

		$this->assertSame($to_array_expected, $item->to_array());
		$this->assertSame($to_db_expected, $item->to_db());
	}

	/**
	 * Data set for test_get_full_url
	 *
	 * @return array
	 */
	public function get_full_url_test_data()
	{
		return array(
			array(false, 'index.php', 'http://www.example.com/phpBB/index.php'),
			array(true, 'index.php', 'http://www.example.com/phpBB/index.php'),
			array(false, 'forum', 'http://www.example.com/phpBB/forum'),
			array(true, 'forum', 'http://www.example.com/phpBB/forum'),
			array(false, 'app.php/foo/bar', 'http://www.example.com/phpBB/app.php/foo/bar'),
			array(true, 'app.php/foo/bar', 'http://www.example.com/phpBB/foo/bar'),
			array(false, '/docs/', 'http://www.example.com/phpBB/docs/'),
			array(false, '/docs', 'http://www.example.com/phpBB/docs'),
			array(true, '/docs', 'http://www.example.com/phpBB/docs'),
			array(false, 'http://www.google.com', 'http://www.google.com'),
			array(true, 'http://www.google.com', 'http://www.google.com'),
			array(false, '//google.com', '//google.com'),
		);
	}

	/**
	 * Test get_full_url
	 *
	 * @dataProvider get_full_url_test_data
	 * @param bool $mod_rewrite
	 * @param string $url
	 * @param string $expected
	 */
	function test_get_full_url($mod_rewrite, $url, $expected)
	{
		$item = new item(array('item_url' => $url), $mod_rewrite);
		$this->assertEquals($expected, $item->get_full_url());
	}
}
