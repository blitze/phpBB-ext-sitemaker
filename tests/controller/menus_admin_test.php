<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\controller;

use Symfony\Component\HttpFoundation\Request;
use blitze\sitemaker\controller\menus_admin;

class menus_admin_test extends \phpbb_database_test_case
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
	 * Create the menu admin controller
	 *
	 * @param string $action
	 * @param int $action_call_count
	 * @param int $cache_call_count
	 * @param bool $ajax_request
	 * @param bool $authorized
	 * @return \blitze\sitemaker\controller\menus_admin
	 */
	protected function get_controller($action, $action_call_count, $cache_call_count, $ajax_request = true, $authorized = true)
	{
		global $config, $phpbb_dispatcher, $request, $symfony_request, $phpbb_path_helper, $user, $phpbb_root_path, $phpEx;

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$symfony_request = new Request();

		$config = new \phpbb\config\config(array(
			'force_server_vars' => false
		));

		$auth = $this->getMock('\phpbb\auth\auth');
		$auth->expects($this->any())
			->method('acl_get')
			->with($this->stringContains('_'), $this->anything())
			->will($this->returnValueMap(array(
				array('a_sm_manage_menus', 0, $authorized),
			)));

		$request = $this->getMock('\phpbb\request\request_interface');
		$request->expects($this->once())
			->method('is_ajax')
			->will($this->returnValue($ajax_request));

		$translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode('-', func_get_args());
			});

		$user = new \phpbb\user($translator, '\phpbb\datetime');
		$user->host = 'www.example.com';
		$user->page['root_script_path'] = '/phpBB/';

		$phpbb_path_helper =  new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			new \phpbb\filesystem(),
			$request,
			$phpbb_root_path,
			$phpEx
		);

		$dummy_object = $this->getMockBuilder('\stdClass')
			->setMethods(array('execute'))
			->getMock();

		$dummy_object->expects($this->exactly($action_call_count))
			->method('execute')
			->will($this->returnCallback(function() use (&$dummy_object) {
				if ($dummy_object->action === 'no_exists')
				{
					throw new \blitze\sitemaker\exception\unexpected_value(array($dummy_object->action, 'INVALID_ACTION'));
				}
				else if ($dummy_object->action === 'tree_error')
				{
					throw new \RuntimeException('INVALID_PARENT');
				}
				return array(
					'message' => 'Action: ' . $dummy_object->action,
				);
			}));

		$action_handler = $this->getMockBuilder('\blitze\sitemaker\services\menus\action_handler')
			->disableOriginalConstructor()
			->getMock();

		$action_handler->expects($this->exactly($action_call_count))
			->method('create')
			->with()
			->will($this->returnCallback(function() use (&$dummy_object, $action) {
				$dummy_object->action = $action;
				return $dummy_object;
			}));

		$action_handler->expects($this->exactly($cache_call_count))
			->method('clear_cache');

		return new menus_admin($auth, $request, $translator, $action_handler, true);
	}

	/**
	 * @return array
	 */
	public function sample_data()
	{
		return array(
			array(
				'add_menu',
				1,
				1,
				200,
				'{"message":"Action: add_menu"}'
			),
			array(
				'edit_menu',
				1,
				1,
				200,
				'{"message":"Action: edit_menu"}'
			),
			array(
				'no_exists',
				1,
				0,
				200,
				'{"message":"EXCEPTION_UNEXPECTED_VALUE-no_exists-INVALID_ACTION"}'
			),
			array(
				'tree_error',
				1,
				0,
				200,
				'{"message":"INVALID_PARENT"}'
			),
		);
	}

	/**
	 * @dataProvider sample_data
	 * @param string $action
	 * @param int $action_call_count
	 * @param int $cache_call_count
	 * @param int $status_code
	 * @param string $expected
	 * @internal param int $call_count
	 */
	public function test_controller($action, $action_call_count, $cache_call_count, $status_code, $expected)
	{
		$controller = $this->get_controller($action, $action_call_count, $cache_call_count);
		$response = $controller->handle($action);

		$this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
		$this->assertEquals($status_code, $response->getStatusCode());
		$this->assertSame($expected,$response->getContent());
	}

	/**
	 * Test Request must be ajax request
	 */
	public function test_request_is_not_ajax()
	{
		$action = 'edit_menu';

		$controller = $this->get_controller($action, 0, 0, false, true);

		$response = $controller->handle($action);

		$this->assertEquals('http://www.example.com/phpBB', $response);
	}

	/**
	 * Test Request must be ajax request
	 */
	public function test_user_is_not_authorized()
	{
		$action = 'edit_menu';

		$controller = $this->get_controller($action, 0, 0, true, false);

		$response = $controller->handle($action);

		$this->assertEquals('http://www.example.com/phpBB', $response);
	}
}
