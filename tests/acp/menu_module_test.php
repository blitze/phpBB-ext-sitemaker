<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\acp;

use phpbb\request\request_interface;
use blitze\sitemaker\acp\menu_module;

require_once dirname(__FILE__) . '../../../../../../includes/functions_admin.php';

class menu_module_test extends \phpbb_database_test_case
{
	protected $template;

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
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/menu.xml');
	}

	/**
	 * Get the menu_module object
	 *
	 * @param string $user_lang
	 * @param array $variable_map
	 * @return \blitze\sitemaker\acp\menu_module
	 */
	public function get_module($user_lang, array $variable_map)
	{
		global $phpbb_container, $phpbb_dispatcher, $db, $request, $template, $user;

		$table_prefix = 'phpbb_';
		$tables = array(
			'mapper_tables'	=> array(
				'menus'	=> $table_prefix . 'sm_menus',
				'items'	=> $table_prefix . 'sm_menu_items'
			)
		);

		$db = $this->new_dbal();
		$config = new \phpbb\config\config(array());
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$controller_helper = $this->getMockBuilder('\phpbb\controller\helper')
			->disableOriginalConstructor()
			->getMock();
		$controller_helper->expects($this->exactly(2))
			->method('route')
			->willReturnCallback(function($route) {
				if ($route === 'blitze_sitemaker_menus_admin')
				{
					return 'phpBB/app.php/menu/admin';
				}
				else if ($route === 'blitze_sitemaker_forum')
				{
					return 'app.php/forum';
				}
			});

		$language = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$language->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode('-', func_get_args());
			});

		$user = new \phpbb\user($language, '\phpbb\datetime');
		$user->data['user_lang'] = $user_lang;
		$user->data['session_id'] = 'session_id';
		$user->page['root_script_path'] = '/phpBB/';

		$request = $this->getMockBuilder('\phpbb\request\request_interface')
			->disableOriginalConstructor()
			->getMock();
		$request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap($variable_map));

		$tpl_data = array();
		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		// make sure we've set template file
		$template->expects($this->any())
			->method('assign_vars')
			->will($this->returnCallback(function($data) use (&$tpl_data) {
				$tpl_data = array_merge($tpl_data, $data);
			}));
		$template->expects($this->any())
			->method('assign_var')
			->will($this->returnCallback(function($key, $data) use (&$tpl_data) {
				$tpl_data[$key] = $data;
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

		$mapper_factory = new \blitze\sitemaker\model\mapper_factory($config, $db, $tables);

		$icons = $this->getMockBuilder('\blitze\sitemaker\services\icons\picker')
			->disableOriginalConstructor()
			->getMock();

		$phpbb_container = new \phpbb_mock_container_builder();
		$phpbb_container->set('controller.helper', $controller_helper);
		$phpbb_container->set('language', $language);
		$phpbb_container->set('blitze.sitemaker.mapper.factory', $mapper_factory);
		$phpbb_container->set('blitze.sitemaker.icons.picker', $icons);

		return new menu_module();
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
				'en',
				array(
					array('menu_id', 0, false, request_interface::REQUEST, 0),
				),
				array(
					'groups' => array(
						array(
							'ID' => 1,
							'NAME' => 'Menu 1',
							'S_ACTIVE' => true,
						),
						array(
							'ID' => 2,
							'NAME' => 'Menu 2',
							'S_ACTIVE' => false,
						),
					),
					'S_MENU' => true,
					'GROUP_ID' => 1,
					'ICON_PICKER' => NULL,
					'SM_USER_LANG' => 'en',
					'SCRIPT_PATH' => '/phpBB/',
					'T_PATH' => 'phpBB/',
					'SESSION_ID' => 'session_id',
					'UA_AJAX_URL' => 'phpBB/app.php/menu/admin/',
					'bulk_options' => array(
						'FORUMS' => "FORUM|app.php/forum\n\tForum 1|viewforum.php?f=1\n\t\tForum 2|viewforum.php?f=2",
					),
				),
			),
			array(
				'fr',
				array(
					array('menu_id', 0, false, request_interface::REQUEST, 2),
				),
				array(
					'groups' => array(
						array(
							'ID' => 1,
							'NAME' => 'Menu 1',
							'S_ACTIVE' => false,
						),
						array(
							'ID' => 2,
							'NAME' => 'Menu 2',
							'S_ACTIVE' => true,
						),
					),
					'S_MENU' => true,
					'GROUP_ID' => 2,
					'ICON_PICKER' => NULL,
					'SM_USER_LANG' => 'fr',
					'SCRIPT_PATH' => '/phpBB/',
					'T_PATH' => 'phpBB/',
					'SESSION_ID' => 'session_id',
					'UA_AJAX_URL' => 'phpBB/app.php/menu/admin/',
					'bulk_options' => array(
						'FORUMS' => "FORUM|app.php/forum\n\tForum 1|viewforum.php?f=1\n\t\tForum 2|viewforum.php?f=2",
					),
				),
			),
		);
	}

	/**
	 * Test the main method
	 *
	 * @dataProvider module_test_data
	 * @param string $user_lang
	 * @param array $variable_map
	 * @param array $expected
	 */
	public function test_module($user_lang, array $variable_map, array $expected)
	{
		$module = $this->get_module($user_lang, $variable_map);
		$module->main();

		$result = $this->template->assign_display('menu');

		$this->assertEquals($expected, $result);
	}
}
