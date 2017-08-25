<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\controller;

use blitze\sitemaker\controller\forum;

class forum_test extends \phpbb_database_test_case
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
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/forum.xml');
	}

	/**
	 * Create the blocks admin controller
	 *
	 * @param array $auth_map
	 * @return \blitze\sitemaker\controller\forum
	 */
	protected function get_controller(array $auth_map = array())
	{
		global $phpbb_dispatcher, $phpbb_container, $auth, $db, $request, $template, $user, $phpbb_root_path, $phpEx;

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
		$db = $this->new_dbal();
		$auth = $this->getMock('\phpbb\auth\auth');
		$config = new \phpbb\config\config(array());

		$auth->expects($this->any())
			->method('acl_get')
			->with($this->stringContains('_'), $this->anything())
			->will($this->returnValueMap($auth_map));

		$request = $this->getMock('\phpbb\request\request_interface');

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$translator = new \phpbb\language\language($lang_loader);

		$user = new \phpbb\user($translator, '\phpbb\datetime');

		$request = $this->getMock('\phpbb\request\request_interface');

		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();
		$this->template = &$template;

		$phpbb_container = $this->getMock('\Symfony\Component\DependencyInjection\ContainerInterface');
		$phpbb_container->expects($this->any())
			->method('get')
			->with('content.visibility')
			->will($this->returnCallback(function() use ($auth, $config, $phpbb_dispatcher, $db, $user, $phpbb_root_path, $phpEx) {
				return new \phpbb\content_visibility($auth, $config, $phpbb_dispatcher, $db, $user, $phpbb_root_path, $phpEx, 'phpbb_forums', 'phpbb_posts', 'phbb_topics', 'phpbb_users');
			}));

		$config = new \phpbb\config\config(array());

		$controller_helper = $this->getMockBuilder('\phpbb\controller\helper')
			->disableOriginalConstructor()
			->getMock();
		$controller_helper->expects($this->any())
			->method('render')
			->willReturnCallback(function($template_file, $page_title = '', $status_code = 200, $display_online_list = false) {
				return new \Symfony\Component\HttpFoundation\Response($template_file, $status_code);
			});

		return  new forum($auth, $config, $controller_helper, $template, $translator, $user, $phpbb_root_path, $phpEx);
	}

	/**
	 * Test the controller response under normal conditions.
	 */
	public function test_controller()
	{
		$controller = $this->get_controller();
		$response = $controller->handle();

		$this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
		$this->assertEquals(200, $response->getStatusCode());
	}

	/**
	 * @return array
	 */
	public function sample_data()
	{
		return array(
			array(
				array(
					array('m_', 0, false),
				),
				0
			),
			array(
				array(
					array('m_', 0, true),
				),
				1
			),
		);
	}

	/**
	 * @dataProvider sample_data
	 *
	 * @param array $auth_map
	 * @param int $expected_call_count
	 */
	public function test_mcp_link_is_set(array $auth_map, $expected_call_count)
	{
		$controller = $this->get_controller($auth_map);

		$this->template->expects($this->exactly($expected_call_count))
			->method('assign_var')
			->with('U_MCP', $this->anything());

		$controller->handle();
	}
}
