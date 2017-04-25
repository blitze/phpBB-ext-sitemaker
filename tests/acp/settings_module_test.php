<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\acp;

/**
 * Override trigger_error() in current namespace for testing
 *
 * @return int
 */
function trigger_error()
{
    return false;
}
function check_form_key()
{
    return true;
}

use phpbb\request\request_interface;
use blitze\sitemaker\acp\settings_module;

require_once dirname(__FILE__) . '../../../../../../includes/functions_acp.php';

class settings_module_test extends \phpbb_database_test_case
{
	protected $config;
	protected $config_text;
	protected $template;
	protected $icon_picker;
	protected $util;

	static private $helper;

	static public function setUpBeforeClass()
	{
		global $phpbb_root_path;

		parent::setUpBeforeClass();

		self::$helper = new \phpbb_test_case_helpers(self);

		self::$helper->copy_dir($phpbb_root_path . 'ext/blitze/sitemaker/tests/acp/fixtures/ext/foo/bar', $phpbb_root_path . 'ext/foo/bar');
	}

	static public function tearDownAfterClass()
	{
		global $phpbb_root_path;

		parent::tearDownAfterClass();

		self::$helper->empty_dir($phpbb_root_path . 'ext/foo');
		rmdir($phpbb_root_path . 'ext/foo');
	}

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
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/settings.xml');
	}

	/**
	 * Get the menu_module object
	 *
	 * @param array $variable_map
	 * @param array $db_text
	 * @param bool $submitted
	 * @return \blitze\sitemaker\acp\menu_module
	 */
	public function get_module(array $variable_map, array $db_text = array(), $submitted = false)
	{
		global $phpbb_container, $config, $db, $phpbb_dispatcher, $request, $template, $phpbb_root_path, $phpEx;

		$db = $this->new_dbal();
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$config = new \phpbb\config\config(array(
			'sm_hide_birthday'	=> false,
			'sm_hide_login'		=> false,
			'sm_hide_online'	=> false,
			'sm_show_forum_nav'	=> true,
			'sm_forum_icon'		=> 'fa fa-comments',
		));
		$this->config = &$config;

		$this->config_text = new \phpbb\config\db_text($db, 'phpbb_config_text');
		$this->config_text->set('sm_layout_prefs', json_encode($db_text));

		$request = $this->getMock('\phpbb\request\request_interface');
		$request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap($variable_map));
		$request->expects($this->any())
			->method('is_set_post')
			->willReturn($submitted);

		$translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode('-', func_get_args());
			});

		$tpl_data = array();
		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();
		$template->expects($this->any())
			->method('assign_vars')
			->will($this->returnCallback(function($data) use (&$tpl_data) {
				$tpl_data = array_merge($tpl_data, $data);
			}));
		$template->expects($this->any())
			->method('assign_block_vars')
			->will($this->returnCallback(function($key, $data) use (&$tpl_data) {
				$tpl_data[$key][] = $data;
			}));
		$template->expects($this->any())
			->method('assign_display')
			->will($this->returnCallback(function() use (&$tpl_data) {
				return $tpl_data;
			}));
		$this->template =& $template;

		$phpbb_container = new \phpbb_mock_container_builder();
		$phpbb_extension_manager = new \phpbb_mock_extension_manager(
			$phpbb_root_path,
			array(
				'blitze/sitemaker' => array(
					'ext_name'		=> 'blitze/sitemaker',
					'ext_active'	=> '1',
					'ext_path'		=> 'ext/blitze/sitemaker/',
				),
				'foo/bar' => array(
					'ext_name'		=> 'foo/bar',
					'ext_active'	=> '1',
					'ext_path'		=> 'foo/bar/',
				),
			),
			$phpbb_container);

		$this->icon_picker = $this->getMockBuilder('\blitze\sitemaker\services\icon_picker')
			->disableOriginalConstructor()
			->getMock();

		$this->util = $this->getMockBuilder('\blitze\sitemaker\services\util')
			->disableOriginalConstructor()
			->getMock();

		$phpbb_container->set('config_text', $this->config_text);
		$phpbb_container->set('ext.manager', $phpbb_extension_manager);
		$phpbb_container->set('language', $translator);
		$phpbb_container->set('blitze.sitemaker.icon_picker', $this->icon_picker);
		$phpbb_container->set('blitze.sitemaker.util', $this->util);

		return new settings_module(false);
	}

	/**
	 * Data set for test_block_display
	 *
	 * @return array
	 */
	public function module_test_data()
	{
		return array(
			array(
				array(
					1 => array(
						'layout' => 'phpBB/ext/blitze/sitemaker/styles/all/template/layouts/portal/',
						'view' => 'simple',
					),
				),
				array(
					'forum_icon' => 'fa fa-comments',
					'show_forum_nav' => true,
					'hide_login' => false,
					'hide_online' => false,
					'hide_birthday' => false,
					'styles' => array(
						array(
							'id' => '1',
							'name' => 'prosilver',
							'layout' => 'phpBB/ext/blitze/sitemaker/styles/all/template/layouts/portal/',
							'view' => 'simple',
						),
						array(
							'id' => '2',
							'name' => 'prosilver2',
							'layout' => 'phpBB/ext/blitze/sitemaker/styles/all/template/layouts/portal/',
							'view' => '',
						),
					),
					'layouts' => array(
						'blog' => 'phpBB/ext/blitze/sitemaker/styles/all/template/layouts/blog/',
						'my_layout' => 'phpBB/ext/foo/bar/styles/prosilver/template/layouts/my_layout/',
						'portal' => 'phpBB/ext/blitze/sitemaker/styles/all/template/layouts/portal/',
						'portal_alt' => 'phpBB/ext/blitze/sitemaker/styles/all/template/layouts/portal_alt/',
					),
				),
			),
		);
	}

	/**
	 * Test the main method
	 *
	 * @dataProvider module_test_data
	 * @param array $db_text
	 * @param array $expected
	 */
	public function test_module(array $db_text, array $expected)
	{
		$module = $this->get_module(array(), $db_text);

		$this->util->expects($this->once())
			->method('add_assets');

		$this->icon_picker->expects($this->once())
			->method('picker');

		$module->main();

		$result = $this->template->assign_display('settings');
		unset($result['S_FORM_TOKEN'], $result['u_action'], $result['icon_picker']);

		$this->assertEquals($expected, $result);
	}

	/**
	 * Test save settings
	 */
	public function test_save_settings()
	{
		$layouts = array(
			1 => array (
				'layout' => './../ext/blitze/sitemaker/styles/all/template/layouts/blog/',
				'view' => 'boxed',
			),
			2 => array (
				'layout' => './../ext/foo/bar/styles/prosilver/template/layouts/my_layout/',
				'view' => 'simple',
			),
		);
		$variable_map = array(
			array('hide_login', 0, false, request_interface::REQUEST, 1),
			array('hide_online', 0, false, request_interface::REQUEST, 1),
			array('hide_birthday', 0, false, request_interface::REQUEST, 1),
			array('show_forum_nav', 0, false, request_interface::REQUEST, 1),
			array('forum_icon', '', false, request_interface::REQUEST, 'fa fa-car'),
			array('layouts', array(0 => array('' => '')), false, request_interface::REQUEST, $layouts),
		);

		$module = $this->get_module($variable_map, array(), true);

		$module->main();

		$expected = array(
            'forum_icon'		=> 'fa fa-car',
            'show_forum_nav'	=> 1,
			'hide_login'		=> 1,
			'hide_online'		=> 1,
			'hide_birthday'		=> 1,
			'layout_prefs'		=> $layouts,
		);

		$result = array(
            'forum_icon'		=> $this->config['sm_forum_icon'],
            'show_forum_nav'	=> $this->config['sm_show_forum_nav'],
			'hide_login'		=> $this->config['sm_hide_login'],
			'hide_online'		=> $this->config['sm_hide_online'],
			'hide_birthday'		=> $this->config['sm_hide_birthday'],
			'layout_prefs'		=> json_decode($this->config_text->get('sm_layout_prefs'), true),
		);

		$this->assertEquals($expected, $result);
	}
}
