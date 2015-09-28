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

class menu_admin_test extends \phpbb_database_test_case
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
	 * Create the menu admin controller
	 *
	 * @return \blitze\sitemaker\controller\menu_admin
	 */
	protected function get_controller($action, $call_count, $ajax_request = true, $return_url = false)
	{
		global $phpbb_dispatcher, $request, $phpbb_path_helper, $user, $phpbb_root_path, $phpEx;

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$request = $this->getMock('\phpbb\request\request_interface');

		$request->expects($this->once())
			->method('is_ajax')
			->will($this->returnValue($ajax_request));

		$user = $this->getMock('\phpbb\user', array(), array('\phpbb\datetime'));

		$user->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode(' ', func_get_args());
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

		$dummy_object = $this->getMockBuilder('\stdClass')
			->setMethods(array('execute'))
			->getMock();

		$dummy_object->expects($this->exactly($call_count))
			->method('execute')
			->will($this->returnCallback(function() use (&$dummy_object) {
				return array(
					'message' => 'Action: ' . $dummy_object->action,
				);
			}));

		$this->action_handler = $this->getMockBuilder('\blitze\sitemaker\services\menu\action_handler')
			->disableOriginalConstructor()
			->getMock();

		$this->action_handler->expects($this->exactly($call_count))
			->method('create')
			->with()
			->will($this->returnCallback(function($service) use (&$dummy_object, $action) {
				$dummy_object->action = $action;
				return $dummy_object;
			}));

		$this->action_handler->expects($this->exactly($call_count))
			->method('clear_cache');

		return new menu_admin($request, $user, $this->action_handler, $return_url);
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
				200,
				'{"message":"Action: add_menu"}'
			),
			array(
				'edit_menu',
				1,
				200,
				'{"message":"Action: edit_menu"}'
			),
		);
	}

	/**
	 * @dataProvider sample_data
	 *
	 * @param string $action
	 * @param integer $call_count
	 * @param integer $status_code
	 * @param array $expected
	 */
	public function test_controller($action, $call_count, $status_code, $expected)
	{
		$controller = $this->get_controller($action, $call_count);
		$response = $controller->handle($action);

		$this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
		$this->assertEquals($status_code, $response->getStatusCode());
		$this->assertSame($expected,$response->getContent());
	}

	/**
	 *
	 */
	public function test_request_is_not_ajax()
	{
		$action = 'edit_menu';
		$controller = $this->get_controller($action, 0, false, true);

		$response = $controller->handle($action);

		$this->assertEquals(401, $response->getStatusCode());
	}
}
