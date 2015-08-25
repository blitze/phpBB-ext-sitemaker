<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\controller;

use phpbb\request\request_interface;
use Symfony\Component\HttpFoundation\Response;
use blitze\sitemaker\controller\menu_admin;
use blitze\sitemaker\services\menu\builder;
use blitze\sitemaker\services\util;

class menu_admin_test extends \phpbb_database_test_case
{
	protected $manager;

	/**
	* Define the extensions to be tested
	*
	* @return array vendor/name of extension(s) to test
	*/
	static protected function setup_extensions()
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
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/user.xml');
	}

	/**
	 * Create the menu admin controller
	 *
	 * @return \blitze\sitemaker\controller\menu_admin
	 */
	protected function get_controller($variable_map)
	{
		global $phpbb_dispatcher, $request, $phpbb_root_path, $phpEx;

		$db = $this->new_dbal();
		$config = new \phpbb\config\config(array());
		$cache = new \phpbb\cache\service(new \phpbb\cache\driver\null, $config, $db, $phpbb_root_path, $phpEx);
		$user = $this->getMock('\phpbb\user', array(), array('\phpbb\datetime'));

		$request = $this->getMock('\phpbb\request\request_interface');
		$request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap($variable_map));

		$path_helper = $this->getMockBuilder('\phpbb\path_helper')
			->disableOriginalConstructor()
			->getMock();

		$template_context = $this->getMockBuilder('phpbb\template\context')
			->getMock();

		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$util = new util($path_helper, $template, $template_context, $user);

		$tree_manager = new builder($cache, $db, $util, 'phpbb_sm_menus', 'phpbb_sm_menu_items', 'item_id');

		return  new menu_admin($request, $user, $template, $tree_manager, 'phpbb_sm_menus');
	}

	/**
	 * @return array
	 */
	public function sample_data()
	{
		return array(

			// add Menu
			array(
				'add_menu',
				0,
				array(),
				array(
					'id'		=> 1,
					'title'		=> 'Menu 1',
					'errors'	=> '',
				),
				200
			),

			// add sing Menu Item
			array(
				'add',
				0,
				array(
					array('menu_id', 0, false, request_interface::REQUEST, 1),
				),
				array(
					'menu_id'		=> 1,
					'item_title'	=> '',
					'left_id'		=> 1,
					'right_id'		=> 2,
					'parent_id'		=> 0,
					'depth'			=> 0,
					'item_id'		=> 1,
					'errors'		=> '',
				),
				200
			)
		);
	}

	/**
	 * @dataProvider sample_data
	 *
	 * @param string $action
	 * @param int $item_id
	 * @param array $variable_map
	 * @param string $content
	 * @param int $status_code
	 */
	public function test_controller($action, $item_id, $variable_map, $content, $status_code)
	{
		$controller = $this->get_controller($variable_map);
		$response = $controller->handle($action, $item_id);

		$this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
		$this->assertSame($content, json_decode($response->getContent(), true));
		$this->assertEquals($status_code, $response->getStatusCode());
	}
}
