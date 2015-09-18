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
	/** @var \phpbb\user */
	protected $user;

	/** @var array */
	protected $tpl_data;

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

		require_once dirname(__FILE__) . '/../../../../../includes/functions.php';

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$this->user = new \phpbb\user('\phpbb\datetime');
		$this->user->timezone = new \DateTimeZone('UTC');
		$this->user->lang['datetime'] = array();

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

		$this->util = new util($path_helper, $template, $template_context, $this->user);
	}

	/**
	 * Test the add_assets method
	 *
	 * @dataProvider add_assets_test_data
	 */
	public function test_add_assets($current_scripts, $add_scripts, $expected)
	{
		$reflection = new \ReflectionClass($this->util);
		$reflection_property = $reflection->getProperty('scripts');
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($this->util, $current_scripts);

		$this->util->add_assets($add_scripts);

		$this->assertSame($reflection_property->getValue($this->util), $expected);
	}

	/**
	 * Test the set_assets method
	 *
	 * @dataProvider set_assets_test_data
	 */
	public function test_set_assets($scripts, $expected)
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

	/**
	 * Test the get_date_range method
	 *
	 * @dataProvider get_date_range_test_data
	 */
	public function test_get_date_range($range, $expected)
	{
		$data = $this->util->get_date_range($range);

		if ($data['start'])
		{
			$data['start'] = $this->user->format_date($data['start'], 'Y-m-d H:i', true);
		}

		if ($data['stop'])
		{
			$data['stop'] = $this->user->format_date($data['stop'], 'Y-m-d H:i', true);
		}

		$this->assertSame($expected, $data);
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
	 * Data set for test_get_date_range
	 *
	 * @return array
	 */
	public function get_date_range_test_data()
	{
		$week_start = (gmdate('D') !== 'Sun') ? strtotime('last sunday') : time();

		return array(
			array(
				'',
				array(
					'start'	=> 0,
					'stop'	=> 0,
					'date'	=> '',
				),
			),
			array(
				'today',
				array(
					'start'	=> gmdate('Y-m-d') . ' 00:00',
					'stop'	=> gmdate('Y-m-d') . ' 23:59',
					'date'	=> gmdate('Y-m-d'),
				),
			),
			array(
				'week',
				array(
					'start'	=> gmdate('Y-m-d', $week_start) . ' 00:00',
					'stop'	=> gmdate('Y-m-d', $week_start + 518400) . ' 23:59',
					'date'	=> gmdate('Y-m-d', $week_start),
				),
			),
			array(
				'month',
				array(
					'start'	=> gmdate('Y-m') . '-01 00:00',
					'stop'	=> gmdate('Y-m-t') . ' 23:59',
					'date'	=> gmdate('Y-m'),
				),
			),
			array(
				'year',
				array(
					'start'	=> gmdate('Y', strtotime('this year')) . '-01-01 00:00',
					'stop'	=> gmdate('Y', strtotime('this year')) . '-12-31 23:59',
					'date'	=> gmdate('Y', strtotime('this year')),
				),
			),
		);
	}
}
