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
	protected function get_controller($auth_map, $variable_map, $action, $call_count, $ajax_request = true)
	{
		global $phpbb_dispatcher;

		$auth = $this->getMock('\phpbb\auth\auth');

		$auth->expects($this->any())
			->method('acl_get')
			->with($this->stringContains('_'), $this->anything())
			->will($this->returnValueMap($auth_map));

		$request = $this->getMock('\phpbb\request\request_interface');

		$request->expects($this->any())
			->method('is_ajax')
			->will($this->returnValue($ajax_request));

		$request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap($variable_map));

		$user = $this->getMock('\phpbb\user', array(), array('\phpbb\datetime'));

		$user->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode(' ', func_get_args());
			});

		$dummy_object = $this->getMockBuilder('\stdClass')
			->setMethods(array('execute'))
			->getMock();

		$dummy_object->expects($this->exactly($call_count))
			->method('execute')
			->with($this->equalTo(1))
			->will($this->returnCallback(function() use (&$dummy_object) {
				return array(
					'message' => 'Action: ' . $dummy_object->action,
				);
			}));

		$this->action_handler = $this->getMockBuilder('\blitze\sitemaker\services\blocks\action_handler')
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

		return new blocks_admin($auth, $request, $user, $this->action_handler);
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
					array('style', 0, false, request_interface::REQUEST, 1),
				),
				'add_block',
				0,
				401,
				'{"id":"","title":"","content":"","message":"NOT_AUTHORISED","errors":""}'
			),

			// No style provided
			array(
				array(
					array('a_manage_blocks', 0, true),
				),
				array(
					array('style', 0, false, request_interface::REQUEST, 0),
				),
				'add_block',
				0,
				200,
				'{"id":"","title":"","content":"","message":"","errors":""}'
			),

			// Authorized, Style provided, action requested
			array(
				array(
					array('a_manage_blocks', 0, true),
				),
				array(
					array('style', 0, false, request_interface::REQUEST, 1),
				),
				'add_block',
				1,
				200,
				'{"id":"","title":"","content":"","message":"Action: add_block","errors":""}'
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
	public function test_controller($auth_map, $variable_map, $action, $call_count, $status_code, $expected)
	{
		$controller = $this->get_controller($auth_map, $variable_map, $action, $call_count);
		$response = $controller->handle($action);

		$this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
		$this->assertEquals($status_code, $response->getStatusCode());
		$this->assertSame($expected,$response->getContent());
	}
}
