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
	 * @param array $auth_map
	 * @param array $variable_map
	 * @param string $action
	 * @param int $action_call_count
	 * @param int $cache_call_count
	 * @param bool $ajax_request
	 * @param bool $return_url
	 * @return \blitze\sitemaker\controller\blocks_admin
	 */
	protected function get_controller(array $auth_map, array $variable_map, $action, $action_call_count, $cache_call_count, $ajax_request = true, $return_url = false)
	{
		global $phpbb_dispatcher, $request, $phpbb_path_helper, $user, $phpbb_root_path, $phpEx;

		$auth = $this->getMock('\phpbb\auth\auth');
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

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
			->with($this->equalTo(1))
			->will($this->returnCallback(function() use (&$dummy_object) {
				if ($dummy_object->action === 'invalid_action')
				{
					throw new \blitze\sitemaker\exception\out_of_bounds(array($dummy_object->action, 'INVALID_REQUEST'));
				}
				return array(
					'message' => 'Action: ' . $dummy_object->action,
				);
			}));

		$auto_lang = $this->getMockBuilder('\blitze\sitemaker\services\auto_lang')
			->disableOriginalConstructor()
			->getMock();

		$auto_lang->expects($this->exactly($action_call_count))
			->method('add')
			->with('blocks_admin');

		$action_handler = $this->getMockBuilder('\blitze\sitemaker\services\blocks\action_handler')
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

		return new blocks_admin($auth, $request, $user, $auto_lang, $action_handler, $return_url);
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
					array('a_sm_manage_blocks', 0, false),
				),
				array(
					array('style', 0, false, request_interface::REQUEST, 1),
				),
				'add_block',
				0,
				0,
				401,
				'{"id":"","title":"","content":"","message":"NOT_AUTHORISED"}'
			),

			// Authorized, action requested
			array(
				array(
					array('a_sm_manage_blocks', 0, true),
				),
				array(
					array('style', 0, false, request_interface::REQUEST, 1),
				),
				'add_block',
				1,
				1,
				200,
				'{"id":"","title":"","content":"","message":"Action: add_block"}'
			),

			// Invalid action
			array(
				array(
					array('a_sm_manage_blocks', 0, true),
				),
				array(
					array('style', 0, false, request_interface::REQUEST, 1),
				),
				'invalid_action',
				1,
				0,
				200,
				'{"id":"","title":"","content":"","message":"EXCEPTION_OUT_OF_BOUNDS invalid_action INVALID_REQUEST"}'
			),
		);
	}

	/**
	 * @dataProvider sample_data
	 *
	 * @param array $auth_map
	 * @param array $variable_map
	 * @param string $action
	 * @param integer $action_call_count
	 * @param integer $cache_call_count
	 * @param integer $status_code
	 * @param array $expected
	 */
	public function test_controller($auth_map, $variable_map, $action, $action_call_count, $cache_call_count, $status_code, $expected)
	{
		$controller = $this->get_controller($auth_map, $variable_map, $action, $action_call_count, $cache_call_count);
		$response = $controller->handle($action);

		$this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
		$this->assertEquals($status_code, $response->getStatusCode());
		$this->assertSame($expected,$response->getContent());
	}

	/**
	 * Test request is not ajax
	 */
	public function test_request_is_not_ajax()
	{
		$action = 'edit_block';
		$auth_map = array(
			array('a_sm_manage_blocks', 0, true),
		);
		$request_map = array(
			array('style', 0, false, request_interface::REQUEST, 1),
		);

		$controller = $this->get_controller($auth_map, $request_map, $action, 0, 0, false, true);

		$response = $controller->handle($action);

		$this->assertEquals(401, $response->getStatusCode());
	}
}
