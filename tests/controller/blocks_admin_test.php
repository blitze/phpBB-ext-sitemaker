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
use blitze\sitemaker\controller\blocks_admin;
use blitze\sitemaker\services\blocks\manager;

class blocks_admin_test extends \phpbb_database_test_case
{
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
	 * Configure the test environment.
	 *
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();

		require_once dirname(__FILE__) . '/../../../../../includes/functions.php';
	}

	/**
	 * Create the blocks admin controller
	 *
	 * @return \blitze\sitemaker\controller\blocks_admin
	 */
	protected function get_controller($auth_map, $variable_map)
	{
		global $phpbb_dispatcher, $cache, $phpbb_root_path, $phpEx;

		$table_prefix = 'phpbb_';
		$blocks_table = $table_prefix . 'sm_blocks';
		$blocks_config_table = $table_prefix . 'sm_blocks_config';
		$block_routes_table = $table_prefix . 'sm_block_routes';

		$db = $this->new_dbal();
		$user = $this->getMock('\phpbb\user', array(), array('\phpbb\datetime'));
		$config = new \phpbb\config\config(array());
		$cache = new \phpbb\cache\service(new \phpbb\cache\driver\null, $config, $db, $phpbb_root_path, $phpEx);

		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$auth = $this->getMock('\phpbb\auth\auth');
		$auth->expects($this->any())
			->method('acl_get')
			->with($this->stringContains('_'), $this->anything())
			->will($this->returnValueMap($auth_map));

		$request = $this->getMock('\phpbb\request\request_interface');
		$request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap($variable_map));

		$container = $this->getMock('\Symfony\Component\DependencyInjection\ContainerInterface');
		$container->expects($this->any())
			->method('get')
			->with('blitze.sitemaker.blocks.custom')
			->will($this->returnCallback(function() use ($cache, $db, $user, $blocks_table) {
				return new \blitze\sitemaker\blocks\custom($cache, $db, $user, $blocks_table);
			}));

		$path_helper = new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			new \phpbb\filesystem(),
			$request,
			$phpbb_root_path,
			$phpEx
		);

		$sitemaker_template = new \blitze\sitemaker\services\template(
			$path_helper,
			$config,
			$user,
			new \phpbb\template\context,
			new \phpbb_mock_extension_manager($phpbb_root_path)
		);

		$manager = new manager(
			$cache,
			$config,
			$db,
			$container,
			$request,
			$template,
			$user,
			$sitemaker_template,
			$phpbb_root_path,
			$phpEx,
			$blocks_table,
			$blocks_config_table,
			$block_routes_table
		);

		return new blocks_admin($auth, $config, $container, $request, $user, $manager);
	}

	/**
	 * @return array
	 */
	public function sample_data()
	{
		return array(

			// User not authorized
			array(
				array(
					array('a_manage_blocks', 0, false),
				),
				array(
					array('add'),
				),
				array(),
				401,
			),

			// Add stats block
			array(
				array(
					array('a_manage_blocks', 0, true),
				),
				array(
					array('add'),
				),
				array(
					array('id', 0, false, request_interface::REQUEST, 0),
					array('style', 0, false, request_interface::REQUEST, 1),
					array('block', '', false, request_interface::REQUEST, 'blitze.sitemaker.blocks.stats'),
					array('route', '', false, request_interface::REQUEST, 'index.php'),
					array('weight', 0, false, request_interface::REQUEST, 0),
					array('position', '', false, request_interface::REQUEST, 'sidebar'),
				),
				200,
			),

			// Get edit form for stats block
			array(
				array(
					array('a_manage_blocks', 0, true),
				),
				array(
					array('edit'),
				),
				array(
					array('id', 0, false, request_interface::REQUEST, 1),
					array('style', 0, false, request_interface::REQUEST, 1),
				),
				200,
			),

			// Save edit form for stats block
			array(
				array(
					array('a_manage_blocks', 0, true),
				),
				array(
					array('save'),
				),
				array(
					array('id', 0, false, request_interface::REQUEST, 1),
					array('style', 0, false, request_interface::REQUEST, 1),
				),
				200,
			),

			// Add an icon to stats block
			array(
				array(
					array('a_manage_blocks', 0, true),
				),
				array(
					array('update'),
				),
				array(
					array('id', 0, false, request_interface::REQUEST, 1),
					array('style', 0, false, request_interface::REQUEST, 1),
					array('icon', '', false, request_interface::REQUEST, 'fa fa-gear'),
				),
				200,
			),

			// Save layout for index.php
			array(
				array(
					array('a_manage_blocks', 0, true),
				),
				array(
					array('save_layout'),
				),
				array(
					array('id', 0, false, request_interface::REQUEST, 0),
					array('style', 0, false, request_interface::REQUEST, 1),
					array('route', '', false, request_interface::REQUEST, 'index.php'),
				),
				200,
			),

			// Copy blocks from index.php to faq.php
			array(
				array(
					array('a_manage_blocks', 0, true),
				),
				array(
					array('save_layout'),
				),
				array(
					array('id', 0, false, request_interface::REQUEST, 0),
					array('style', 0, false, request_interface::REQUEST, 1),
					array('route', '', false, request_interface::REQUEST, 'faq.php'),
					array('from_route', '', false, request_interface::REQUEST, 'index.php'),
					array('from_style', 0, false, request_interface::REQUEST, 0),
				),
				200,
			),

			// Do not show blocks for the viewtopic.php
			array(
				array(
					array('a_manage_blocks', 0, true),
				),
				array(
					array('layout_settings'),
				),
				array(
					array('id', 0, false, request_interface::REQUEST, 0),
					array('style', 0, false, request_interface::REQUEST, 1),
					array('route', '', false, request_interface::REQUEST, 'viewtopic.php'),
					array('hide_blocks', false, false, request_interface::REQUEST, true),
				),
				200,
			),
		);
	}

	/**
	 * @dataProvider sample_data
	 *
	 * @param array $auth_map
	 * @param array $variable_map
	 * @param int $status_code
	 */
	public function test_controller($auth_map, $action_map, $variable_map, $status_code)
	{
		$controller = $this->get_controller($auth_map, $variable_map);
		$response = $controller->handle($action_map);

		$this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
		$this->assertEquals($status_code, $response->getStatusCode());
	}
}
