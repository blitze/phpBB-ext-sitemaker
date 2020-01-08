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
	 * Create the blocks admin controller
	 *
	 * @param array $auth_map
	 * @param array $variable_map
	 * @param string $action
	 * @param int $action_call_count
	 * @param bool $ajax_request
	 * @return \blitze\sitemaker\controller\blocks_admin
	 */
	protected function get_controller(array $auth_map, array $variable_map, $action, $action_call_count, $ajax_request = true)
	{
		global $config, $phpbb_dispatcher, $symfony_request, $request, $phpbb_path_helper, $user, $phpbb_root_path, $phpEx;

		$cache = new \phpbb_mock_cache();
		$phpbb_container = new \phpbb_mock_container_builder();
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$symfony_request = new Request();

		$config = new \phpbb\config\config(array(
			'force_server_vars' => false
		));

		$auth = $this->getMockBuilder('\phpbb\auth\auth')
			->disableOriginalConstructor()
			->getMock();
		$auth->expects($this->any())
			->method('acl_get')
			->with($this->stringContains('_'), $this->anything())
			->will($this->returnValueMap($auth_map));

		$request = $this->getMockBuilder('\phpbb\request\request_interface')
			->disableOriginalConstructor()
			->getMock();

		$request->expects($this->any())
			->method('is_ajax')
			->will($this->returnValue($ajax_request));

		$request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap($variable_map));

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

		$auto_lang = $this->getMockBuilder('\blitze\sitemaker\services\auto_lang')
			->disableOriginalConstructor()
			->getMock();

		$auto_lang->expects($this->exactly($action_call_count))
			->method('add')
			->with('blocks_admin');

		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$block_factory = $this->getMockBuilder('\blitze\sitemaker\services\blocks\factory')
			->disableOriginalConstructor()
			->getMock();

		$groups = $this->getMockBuilder('\blitze\sitemaker\services\groups')
			->disableOriginalConstructor()
			->getMock();

		$mapper = $this->getMockBuilder('\blitze\sitemaker\model\mapper_factory')
			->disableOriginalConstructor()
			->getMock();

		$blocks = new \blitze\sitemaker\services\blocks\blocks($cache, $config, $phpbb_dispatcher, $template, $translator, $block_factory, $groups, $mapper, $phpEx);

		$action_handler = new \blitze\sitemaker\services\blocks\action_handler($config, $phpbb_container, $request, $translator, $blocks, $block_factory, $mapper);

		return new blocks_admin($auth, $request, $translator, $auto_lang, $action_handler, true);
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
				'set_startpage',
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
				'set_startpage',
				1,
				200,
				'{"id":"","title":"","content":"","message":""}'
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
				200,
					'{"id":"","title":"","content":"","message":"EXCEPTION_UNEXPECTED_VALUE-invalid_action-INVALID_ACTION"}'
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
	 * @param integer $status_code
	 * @param array $expected
	 */
	public function test_controller($auth_map, $variable_map, $action, $action_call_count, $status_code, $expected)
	{
		$controller = $this->get_controller($auth_map, $variable_map, $action, $action_call_count);
		$response = $controller->handle($action);

		$this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
		$this->assertEquals($status_code, $response->getStatusCode());
		$this->assertSame($expected, $response->getContent());
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

		$controller = $this->get_controller($auth_map, $request_map, $action, 0, false, true);

		$response = $controller->handle($action);

		$this->assertEquals(401, $response->getStatusCode());
		$this->assertSame('{"id":"","title":"","content":"","message":"NOT_AUTHORISED"}', $response->getContent());
	}
}
