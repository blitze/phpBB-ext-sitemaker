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
		global $phpbb_dispatcher, $template;

		parent::setUp();

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$template_context = $this->getMockBuilder('phpbb\template\context')
			->getMock();
		$template_context->expects($this->any())
			->method('get_root_ref')
			->will($this->returnCallback(function() {
				return array('S_FORM_TOKEN' => '12345');
			}));

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

		$path_helper = $this->getMockBuilder('\phpbb\path_helper')
			->disableOriginalConstructor()
			->getMock();
		$path_helper->expects($this->any())
			->method('get_web_root_path')
			->will($this->returnCallback(function() {
				return './';
			}));

		$this->util = new util($path_helper, $template, $template_context);
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
					'js'	=> array('my/file1.js', 'my/file2.js'),
					'css'	=> array('my/file1.css'),
				),
				array(
					'js'	=> array('my/new_file.js', 'my/file1.js'),
				),
				array(
					'js'	=> array('my/file1.js', 'my/file2.js', 'my/new_file.js', 'my/file1.js'),
					'css'	=> array('my/file1.css')
				),
			),
		);
	}

	/**
	 * Test the add_assets method
	 *
	 * @dataProvider add_assets_test_data
	 * @param array $current_scripts
	 * @param array $add_scripts
	 * @param array $expected
	 */
	public function test_add_assets(array $current_scripts, array $add_scripts, array $expected)
	{
		$reflection = new \ReflectionClass($this->util);
		$reflection_property = $reflection->getProperty('scripts');
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($this->util, $current_scripts);

		$this->util->add_assets($add_scripts);

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
					'js'	=> array(),
					'css'	=> array()
				),
				array(),
			),
			array(
				array(
					'js' => array(
						0	=> 'my/file1.js',
						1	=> 'my/file2.js',
						2	=> 'my/file1.js',
						100	=> 'my/file4.js',
						4	=> 'my/file3.js'),
					'css' => array(),
				),
				array(
					'js'	=> array(
						array('UA_FILE' => 'my/file1.js'),
						array('UA_FILE' => 'my/file2.js'),
						array('UA_FILE' => 'my/file3.js'),
						array('UA_FILE' => 'my/file4.js'),
					),
				),
			),
		);
	}

	/**
	 * Test the set_assets method
	 *
	 * @dataProvider set_assets_test_data
	 * @param array $scripts
	 * @param array $expected
	 */
	public function test_set_assets(array $scripts, array $expected)
	{
		$reflection = new \ReflectionClass($this->util);
		$reflection_property = $reflection->getProperty('scripts');
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($this->util, $scripts);

		$this->tpl_data = array();
		$this->util->set_assets();

		$this->assertSame($this->tpl_data, $expected);
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
