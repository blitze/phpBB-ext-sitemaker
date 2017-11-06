<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services;

use blitze\sitemaker\services\util;

class util_test extends \phpbb_test_case
{
	/** @var array */
	protected $tpl_data;
	protected $util;

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
		global $phpbb_dispatcher, $request, $template, $user;

		parent::setUp();

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$request = $this->getMock('\phpbb\request\request_interface');

		$user = $this->getMockBuilder('\phpbb\user')
			->disableOriginalConstructor()
			->getMock();
		$user->host = 'www.example.com';
		$user->page['root_script_path'] = '/phpBB/';
		$user->style['style_path'] = 'prosilver';

		$temp_data = array();
		$this->tpl_data = &$temp_data;
		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();
		$template->expects($this->any())
			->method('assign_block_vars')
			->will($this->returnCallback(function($key, $data) use (&$temp_data) {
				$temp_data[$key][] = $data;
			}));
		$template->expects($this->any())
			->method('assign_vars')
			->will($this->returnCallback(function($data) use (&$temp_data) {
				$temp_data['.'][] = $data;
			}));
		$template->expects($this->any())
			->method('assign_var')
			->will($this->returnCallback(function($key, $data) use (&$temp_data) {
				$temp_data[$key] = $data;
			}));
		$template->expects($this->any())
			->method('retrieve_var')
			->will($this->returnCallback(function() {
				return '12345';
			}));

		$path_helper = $this->getMockBuilder('\phpbb\path_helper')
			->disableOriginalConstructor()
			->getMock();
		$path_helper->expects($this->any())
			->method('get_web_root_path')
			->will($this->returnCallback(function() {
				return './';
			}));

		$this->util = new util($path_helper, $template, $user);
	}

	/**
	 * Data set for test_add_assets
	 *
	 * @return array
	 */
	public function add_assets_test_data()
	{
		return array(
			array(
				array(
					'js'	=> array(),
					'css'	=> array()
				),
				array(),
				array(
					'js'	=> array(),
					'css'	=> array()
				),
			),
			array(
				array(
					'js'	=> array('my/file1.js' => 0, 'my/file2.js' => 1),
					'css'	=> array('my/file1.css' => 0),
				),
				array(
					'js'	=> array('my/new_file.js', 100 => 'my/file1.js'),
				),
				array(
					'js'	=> array('my/file1.js' => 100, 'my/file2.js' => 1, 'my/new_file.js' => 0),
					'css'	=> array('my/file1.css' => 0),
				),
			),
		);
	}

	/**
	 * Test the add_assets method
	 *
	 * @dataProvider add_assets_test_data
	 * @param array $current_assets
	 * @param array $add_assets
	 * @param array $expected
	 */
	public function test_add_assets(array $current_assets, array $add_assets, array $expected)
	{
		$reflection = new \ReflectionClass($this->util);
		$reflection_property = $reflection->getProperty('assets');
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($this->util, $current_assets);

		$this->util->add_assets($add_assets);

		$this->assertSame($reflection_property->getValue($this->util), $expected);
	}

	/**
	 * Data set for test_add_assets
	 *
	 * @return array
	 */
	public function set_assets_test_data()
	{
		return array(
			array(
				array(
					'css'	=> array(),
					'js'	=> array(),
				),
				array(
					'css'	=> array(),
					'js'	=> array(),
				),
			),
			array(
				array(
					'css' => array(),
					'js' => array(
						'my/file1.js' => 2,
						'my/file2.js' => 1,
						'my/file4.js' => 100,
						'my/file3.js' => 4,
					),
				),
				array(
					'css'	=> array(),
					'js'	=> array(
						'my/file2.js',
						'my/file1.js',
						'my/file3.js',
						'my/file4.js',
					),
				),
			),
		);
	}

	/**
	 * Test the set_assets method
	 *
	 * @dataProvider set_assets_test_data
	 * @param array $assets
	 * @param array $expected
	 */
	public function test_set_assets(array $assets, array $expected)
	{
		$reflection = new \ReflectionClass($this->util);
		$reflection_property = $reflection->getProperty('assets');
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($this->util, $assets);

		$this->tpl_data = array();
		$this->util->set_assets();

		$this->assertSame($this->tpl_data['assets'], $expected);
	}

	/**
	 * Test the get_form_key method
	 */
	public function test_get_form_key()
	{
		$form_key = $this->util->get_form_key('test_form');
		$this->assertEquals($form_key, '12345');
	}
}
