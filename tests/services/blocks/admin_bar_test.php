<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks;

use Symfony\Component\HttpFoundation\Request;
use blitze\sitemaker\services\blocks\admin_bar;

require_once dirname(__FILE__) . '/../fixtures/ext/foo/bar/foo_bar_controller.php';

class admin_bar_test extends \phpbb_database_test_case
{
	protected $phpbb_container;

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
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/../fixtures/blocks.xml');
	}

	/**
	 * Create the admin_bar service
	 *
	 * @param array $config_data
	 * @param string $page
	 * @param string $user_lang
	 * @param string $controller
	 * @param string $params
	 * @return \blitze\sitemaker\services\blocks\admin_bar
	 */
	protected function get_service(array $config_data = array(), $page = 'index.php', $user_lang = 'en', $controller = '', $params = '')
	{
		global $config, $db, $request, $phpbb_dispatcher, $phpbb_extension_manager, $phpbb_path_helper, $symfony_request, $user, $phpbb_root_path, $phpEx;

		$table_prefix = 'phpbb_';
		$tables = array(
			'mapper_tables'	=> array(
				'blocks'	=> $table_prefix . 'sm_blocks',
				'routes'	=> $table_prefix . 'sm_block_routes'
			)
		);

		$lang_mapping = array(
			'fr' => 'fr_FR',
		);

		$auth = $this->getMockBuilder('\phpbb\auth\auth')
			->disableOriginalConstructor()
			->getMock();

		$db = $this->new_dbal();

		$config_data['force_server_vars'] = false;
		$config = new \phpbb\config\config($config_data);

		$request = $this->getMockBuilder('\phpbb\request\request_interface')
			->disableOriginalConstructor()
			->getMock();

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$controller_helper = $this->getMockBuilder('\phpbb\controller\helper')
			->disableOriginalConstructor()
			->getMock();
		$controller_helper->expects($this->any())
			->method('route')
			->willReturnCallback(function ($route, $params)
			{
				return $route . '-' . implode('/', $params);
			});

		$phpbb_path_helper =  new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			new \phpbb\filesystem(),
			$request,
			$phpbb_root_path,
			$phpEx
		);

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$translator = new \phpbb\language\language($lang_loader);

		$user = new \phpbb\user($translator, '\phpbb\datetime');
		$user->timezone = new \DateTimeZone('UTC');
		$user->host = 'my-site.com';
		$user->page['page'] = $page;
		$user->page['root_script_path'] = '/phpBB/';
		$user->data['user_lang'] = $user_lang;

		$auto_lang = $this->getMockBuilder('\blitze\sitemaker\services\auto_lang')
			->disableOriginalConstructor()
			->getMock();

		$blocks_factory = $this->getMockBuilder('\blitze\sitemaker\services\blocks\factory')
			->disableOriginalConstructor()
			->getMock();

		$blocks_factory->expects($this->any())
			->method('get_all_blocks')
			->will($this->returnValue(array(
				'blitze.sitemaker.block.birthday'	=> 'BLITZE_SITEMAKER_BLOCK_BIRTHDAY',
				'blitze.sitemaker.block.custom'		=> 'BLITZE_SITEMAKER_BLOCK_CUSTOM',
				'blitze.sitemaker.block.members'	=> 'BLITZE_SITEMAKER_BLOCK_MEMBERS',
			)));

		$filesystem = new \phpbb\filesystem\filesystem();

		$mapper_factory = new \blitze\sitemaker\model\mapper_factory($config, $db, $tables);

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
					'ext_path'		=> 'ext/blitze/sitemaker/tests/services/fixtures/ext/foo/bar/',
				),
			),
			$phpbb_container
		);

		$symfony_request = new Request();
		$symfony_request->attributes->set('_controller', $controller);
		$symfony_request->attributes->set('_route_params', array('route' => $params));
		$symfony_request->attributes->set('route', $params);

		$phpbb_container->set('ext.manager', $phpbb_extension_manager);
		$phpbb_container->set('symfony_request', $symfony_request);
		$phpbb_container->set('blitze.sitemaker.auto_lang', $auto_lang);
		$phpbb_container->set('blitze.sitemaker.blocks.factory', $blocks_factory);
		$phpbb_container->set('blitze.sitemaker.mapper.factory', $mapper_factory);
		$phpbb_container->set('foo.bar.controller', new \foo\bar\foo_bar_controller());

		$icons = $this->getMockBuilder('\blitze\sitemaker\services\icons\picker')
			->disableOriginalConstructor()
			->getMock();

		$this->util = $this->getMockBuilder('\blitze\sitemaker\services\util')
			->disableOriginalConstructor()
			->getMock();

		$tpl_data = array();
		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$this->tpl_data = &$tpl_data;
		$template->expects($this->any())
			->method('assign_vars')
			->will($this->returnCallback(function ($data) use (&$tpl_data)
			{
				$tpl_data = $data;
			}));

		$template->expects($this->any())
			->method('assign_block_vars')
			->will($this->returnCallback(function ($key, $data) use (&$tpl_data)
			{
				$tpl_data[$key][] = $data;
			}));

		$template->expects($this->any())
			->method('get_user_style')
			->willReturn(['prosilver']);

		return new admin_bar($config, $controller_helper, $phpbb_container, $phpbb_dispatcher, $template, $translator, $user, $icons, $this->util, $lang_mapping);
	}

	/**
	 * Data set for test_show_admin_bar
	 *
	 * @return array
	 */
	public function show_admin_bar_test_data()
	{
		return array(
			array(
				'fr',
				array(
					'route_id' => 1,
					'ext_name' => '',
					'route' => 'index.php',
					'style' => 1,
					'hide_blocks' => 0,
					'has_blocks' => 1,
					'ex_positions' => array(),
				),
				array(
					'default_lang'				=> 'en',
					'enable_mod_rewrite'		=> false,
					'sitemaker_default_layout'	=> ''
				),
				array(
					'S_EDIT_MODE' => true,
					'S_ROUTE_OPS' => '<option value="">Select</option><option value="app.php/foo/test/">app.php/foo/test/</option><option value="app.php/forum">app.php/forum</option><option value="faq.php">faq.php</option><option value="foo.php">foo.php</option><option value="index.php" selected="selected">index.php</option><option value="search.php">search.php</option><option value="viewforum.php?f=1">viewforum.php?f=1</option>',
					'S_HIDE_BLOCKS' => 0,
					'S_EX_POSITIONS' => '',
					'S_STYLE_OPTIONS' => '<option value="1" selected="selected">prosilver</option>',
					'S_STARTPAGE' => false,
					'ICON_PICKER' => null,
					'SM_USER_LANG' => 'fr',
					'TINYMCE_LANG' => 'fr_FR',
				),
			),
			array(
				'pt_br',
				array(
					'route_id' => 2,
					'ext_name' => '',
					'route' => 'index.php',
					'style' => 1,
					'hide_blocks' => 0,
					'has_blocks' => 1,
					'ex_positions' => array('panel', 'top'),
				),
				array(
					'default_lang'				=> 'en',
					'enable_mod_rewrite'		=> false,
					'sitemaker_default_layout'	=> ''
				),
				array(
					'S_EDIT_MODE' => true,
					'S_ROUTE_OPS' => '<option value="">Select</option><option value="app.php/foo/test/">app.php/foo/test/</option><option value="app.php/forum">app.php/forum</option><option value="faq.php">faq.php</option><option value="foo.php">foo.php</option><option value="index.php" selected="selected">index.php</option><option value="search.php">search.php</option><option value="viewforum.php?f=1">viewforum.php?f=1</option>',
					'S_HIDE_BLOCKS' => 0,
					'S_EX_POSITIONS' => 'panel, top',
					'S_STYLE_OPTIONS' => '<option value="1" selected="selected">prosilver</option>',
					'S_STARTPAGE' => false,
					'ICON_PICKER' => null,
					'SM_USER_LANG' => 'pt_br',
					'TINYMCE_LANG' => 'pt_BR',
				),
			),
		);
	}

	/**
	 * Test the show method
	 *
	 * @dataProvider show_admin_bar_test_data
	 * @param string $user_lang
	 * @param array $route_info
	 * @param array $config
	 * @param array $expected
	 */
	public function test_show_admin_bar($user_lang, array $route_info, array $config, array $expected)
	{
		$admin_bar = $this->get_service($config, 'index.php', $user_lang);

		// assert set_assets() method is called
		$this->util->expects($this->once())
			->method('add_assets');

		$admin_bar->show($route_info);

		$this->assertSame($expected, $this->tpl_data);
	}

	/**
	 * Data set for test_set_javascript_data
	 *
	 * @return array
	 */
	public function set_javascript_data_test_data()
	{
		return array(
			array(
				'index.php',
				1,
				array(
					'default_lang'				=> 'en',
					'enable_mod_rewrite'		=> false,
					'sitemaker_default_layout'	=> '',
				),
				array(
					'S_IS_DEFAULT' => false,
					'BLOCK_ACTIONS' => array(
						'add_block' => 'blitze_sitemaker_blocks_admin-add_block',
						'copy_route' => 'blitze_sitemaker_blocks_admin-copy_route',
						'edit_block' => 'blitze_sitemaker_blocks_admin-edit_block',
						'handle_custom_action' => 'blitze_sitemaker_blocks_admin-handle_custom_action',
						'save_block' => 'blitze_sitemaker_blocks_admin-save_block',
						'save_blocks' => 'blitze_sitemaker_blocks_admin-save_blocks',
						'set_default_route' => 'blitze_sitemaker_blocks_admin-set_default_route',
						'set_route_prefs' => 'blitze_sitemaker_blocks_admin-set_route_prefs',
						'set_startpage' => 'blitze_sitemaker_blocks_admin-set_startpage',
						'update_block' => 'blitze_sitemaker_blocks_admin-update_block',
						'update_column_width' => 'blitze_sitemaker_blocks_admin-update_column_width',
					),
					'PAGE_URL' => 'phpBB/index.php?',
					'UA_BOARD_URL' => 'http://my-site.com/phpBB',
					'UA_ROUTE' => 'index.php',
					'UA_STYLE_ID' => 1,
					'UA_SCRIPT_PATH' => '/phpBB/',
					'UA_MODREWRITE' => false,
					'UA_WEB_ROOT_PATH' => null,
					'UA_UPLOAD_URL' => 'blitze_sitemaker_image_upload-',
					'UA_NAVBAR_MANAGER' => 'blitze_sitemaker_navbar_manager-prosilver',
					'U_VIEW_DEFAULT' => false,
				),
			),
			array(
				'index.php',
				1,
				array(
					'default_lang'				=> 'en',
					'enable_mod_rewrite'		=> true,
					'sitemaker_default_layout'	=> 'faq.php',
				),
				array(
					'S_IS_DEFAULT' => false,
					'BLOCK_ACTIONS' => array(
						'add_block' => 'blitze_sitemaker_blocks_admin-add_block',
						'copy_route' => 'blitze_sitemaker_blocks_admin-copy_route',
						'edit_block' => 'blitze_sitemaker_blocks_admin-edit_block',
						'handle_custom_action' => 'blitze_sitemaker_blocks_admin-handle_custom_action',
						'save_block' => 'blitze_sitemaker_blocks_admin-save_block',
						'save_blocks' => 'blitze_sitemaker_blocks_admin-save_blocks',
						'set_default_route' => 'blitze_sitemaker_blocks_admin-set_default_route',
						'set_route_prefs' => 'blitze_sitemaker_blocks_admin-set_route_prefs',
						'set_startpage' => 'blitze_sitemaker_blocks_admin-set_startpage',
						'update_block' => 'blitze_sitemaker_blocks_admin-update_block',
						'update_column_width' => 'blitze_sitemaker_blocks_admin-update_column_width',
					),
					'PAGE_URL' => 'phpBB/index.php?',
					'UA_BOARD_URL' => 'http://my-site.com/phpBB',
					'UA_ROUTE' => 'index.php',
					'UA_STYLE_ID' => 1,
					'UA_SCRIPT_PATH' => '/phpBB/',
					'UA_MODREWRITE' => true,
					'UA_WEB_ROOT_PATH' => null,
					'UA_UPLOAD_URL' => 'blitze_sitemaker_image_upload-',
					'UA_NAVBAR_MANAGER' => 'blitze_sitemaker_navbar_manager-prosilver',
					'U_VIEW_DEFAULT' => 'http://my-site.com/phpBB/faq.php',
				),
			),
			array(
				'index.php',
				1,
				array(
					'default_lang'				=> 'en',
					'enable_mod_rewrite'		=> true,
					'sitemaker_default_layout'	=> 'index.php:1',
				),
				array(
					'S_IS_DEFAULT' => true,
					'BLOCK_ACTIONS' => array(
						'add_block' => 'blitze_sitemaker_blocks_admin-add_block',
						'copy_route' => 'blitze_sitemaker_blocks_admin-copy_route',
						'edit_block' => 'blitze_sitemaker_blocks_admin-edit_block',
						'handle_custom_action' => 'blitze_sitemaker_blocks_admin-handle_custom_action',
						'save_block' => 'blitze_sitemaker_blocks_admin-save_block',
						'save_blocks' => 'blitze_sitemaker_blocks_admin-save_blocks',
						'set_default_route' => 'blitze_sitemaker_blocks_admin-set_default_route',
						'set_route_prefs' => 'blitze_sitemaker_blocks_admin-set_route_prefs',
						'set_startpage' => 'blitze_sitemaker_blocks_admin-set_startpage',
						'update_block' => 'blitze_sitemaker_blocks_admin-update_block',
						'update_column_width' => 'blitze_sitemaker_blocks_admin-update_column_width',
					),
					'PAGE_URL' => 'phpBB/index.php?',
					'UA_BOARD_URL' => 'http://my-site.com/phpBB',
					'UA_ROUTE' => 'index.php',
					'UA_STYLE_ID' => 1,
					'UA_SCRIPT_PATH' => '/phpBB/',
					'UA_MODREWRITE' => true,
					'UA_WEB_ROOT_PATH' => null,
					'UA_UPLOAD_URL' => 'blitze_sitemaker_image_upload-',
					'UA_NAVBAR_MANAGER' => 'blitze_sitemaker_navbar_manager-prosilver',
					'U_VIEW_DEFAULT' => 'http://my-site.com/phpBB/index.php',
				),
			),
			array(
				'index.php',
				1,
				array(
					'default_lang'				=> 'en',
					'enable_mod_rewrite'		=> true,
					'sitemaker_default_layout'	=> 'index.php:2',
				),
				array(
					'S_IS_DEFAULT' => false,
					'BLOCK_ACTIONS' => array(
						'add_block' => 'blitze_sitemaker_blocks_admin-add_block',
						'copy_route' => 'blitze_sitemaker_blocks_admin-copy_route',
						'edit_block' => 'blitze_sitemaker_blocks_admin-edit_block',
						'handle_custom_action' => 'blitze_sitemaker_blocks_admin-handle_custom_action',
						'save_block' => 'blitze_sitemaker_blocks_admin-save_block',
						'save_blocks' => 'blitze_sitemaker_blocks_admin-save_blocks',
						'set_default_route' => 'blitze_sitemaker_blocks_admin-set_default_route',
						'set_route_prefs' => 'blitze_sitemaker_blocks_admin-set_route_prefs',
						'set_startpage' => 'blitze_sitemaker_blocks_admin-set_startpage',
						'update_block' => 'blitze_sitemaker_blocks_admin-update_block',
						'update_column_width' => 'blitze_sitemaker_blocks_admin-update_column_width',
					),
					'PAGE_URL' => 'phpBB/index.php?',
					'UA_BOARD_URL' => 'http://my-site.com/phpBB',
					'UA_ROUTE' => 'index.php',
					'UA_STYLE_ID' => 1,
					'UA_SCRIPT_PATH' => '/phpBB/',
					'UA_MODREWRITE' => true,
					'UA_WEB_ROOT_PATH' => null,
					'UA_UPLOAD_URL' => 'blitze_sitemaker_image_upload-',
					'UA_NAVBAR_MANAGER' => 'blitze_sitemaker_navbar_manager-prosilver',
					'U_VIEW_DEFAULT' => 'http://my-site.com/phpBB/index.php?style=2',
				),
			),
		);
	}

	/**
	 * Test the set_javascript_data method
	 *
	 * @dataProvider set_javascript_data_test_data
	 * @param string $route
	 * @param int $style_id
	 * @param array $config
	 * @param array $expected
	 */
	public function test_set_javascript_data($route, $style_id, array $config, array $expected)
	{
		$admin_bar = $this->get_service($config, $route);
		$admin_bar->set_javascript_data($route, $style_id);

		$this->assertSame($expected, $this->tpl_data);
	}

	/**
	 * Test the get_available_blocks method
	 */
	public function test_get_available_blocks()
	{
		$expected = array(
			array(
				'NAME'		=> 'BLITZE_SITEMAKER_BLOCK_BIRTHDAY',
				'SERVICE'	=> 'blitze.sitemaker.block.birthday',
			),
			array(
				'NAME'		=> 'BLITZE_SITEMAKER_BLOCK_CUSTOM',
				'SERVICE'	=> 'blitze.sitemaker.block.custom',
			),
			array(
				'NAME'		=> 'BLITZE_SITEMAKER_BLOCK_MEMBERS',
				'SERVICE'	=> 'blitze.sitemaker.block.members',
			),
		);

		$admin_bar = $this->get_service();
		$admin_bar->get_available_blocks();

		$this->assertSame($expected, $this->tpl_data['block']);
	}

	/**
	 * Data set for test_get_startpage_options
	 *
	 * @return array
	 */
	public function get_startpage_options_test_data()
	{
		return array(
			array(
				'index.php',
				'',
				'',
				array(
					'default_lang'						=> 'en',
					'sitemaker_startpage_controller'	=> '',
					'sitemaker_startpage_method'		=> '',
					'sitemaker_startpage_params'		=> ''
				),
				array()
			),
			array(
				'app.php/foo/bar',
				'foo.bar.controller:handle',
				'',
				array(
					'default_lang'						=> 'en',
					'sitemaker_startpage_controller'	=> '',
					'sitemaker_startpage_method'		=> '',
					'sitemaker_startpage_params'		=> ''
				),
				array(
					'CONTROLLER_NAME'	=> 'foo.bar.controller',
					'CONTROLLER_METHOD'	=> 'handle',
					'CONTROLLER_PARAMS'	=> '',
					'S_IS_STARTPAGE'	=> false,
					'UA_EXTENSION'		=> 'foo/bar',
				)
			),
			array(
				'app.php/foo/bar/test',
				'foo.bar.controller:handle',
				'test',
				array(
					'default_lang'						=> 'en',
					'sitemaker_startpage_controller'	=> 'foo.bar.controller',
					'sitemaker_startpage_method'		=> 'handle',
					'sitemaker_startpage_params'		=> 'test'
				),
				array(
					'CONTROLLER_NAME'	=> 'foo.bar.controller',
					'CONTROLLER_METHOD'	=> 'handle',
					'CONTROLLER_PARAMS'	=> 'test',
					'S_IS_STARTPAGE'	=> true,
					'UA_EXTENSION'		=> 'foo/bar',
				)
			),
		);
	}

	/**
	 * Test the get_startpage_options method
	 *
	 * @dataProvider get_startpage_options_test_data
	 * @param string $page
	 * @param string $controller
	 * @param string $params
	 * @param array $config
	 * @param array $expected
	 */
	public function test_get_startpage_options($page, $controller, $params, array $config, array $expected)
	{
		$admin_bar = $this->get_service($config, $page, 'en', $controller, $params);

		$admin_bar->get_startpage_options();

		$this->assertSame($expected, $this->tpl_data);
	}

	/**
	 * Data set for test_get_route_options
	 *
	 * @return array
	 */
	public function get_route_options_test_data()
	{
		return array(
			array(
				'index.php',
				'<option value="">Select</option><option value="app.php/foo/test/">app.php/foo/test/</option><option value="app.php/forum">app.php/forum</option><option value="faq.php">faq.php</option><option value="foo.php">foo.php</option><option value="index.php" selected="selected">index.php</option><option value="search.php">search.php</option><option value="viewforum.php?f=1">viewforum.php?f=1</option>',
			),
			array(
				'app.php/foo/test/',
				'<option value="">Select</option><option value="app.php/foo/test/" selected="selected">app.php/foo/test/</option><option value="app.php/forum">app.php/forum</option><option value="faq.php">faq.php</option><option value="foo.php">foo.php</option><option value="index.php">index.php</option><option value="search.php">search.php</option><option value="viewforum.php?f=1">viewforum.php?f=1</option>',
			),
		);
	}

	/**
	 * Test the get_route_options method
	 *
	 * @dataProvider get_route_options_test_data
	 * @param string $route
	 * @param string $expected
	 */
	public function test_get_route_options($route, $expected)
	{
		$admin_bar = $this->get_service();

		$options = $admin_bar->get_route_options($route);

		$this->assertSame($expected, $options);
	}
}
