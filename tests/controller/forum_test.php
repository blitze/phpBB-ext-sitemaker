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
		global $phpbb_dispatcher, $phpbb_container, $auth, $config, $db, $request, $symfony_request, $template, $user, $phpbb_root_path, $phpEx;

		$symfony_request = new Request();

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
		$db = $this->new_dbal();
		$config = new \phpbb\config\config(array(
			'force_server_vars' => false,
		));

		$auth = $this->getMockBuilder('\phpbb\auth\auth')
			->disableOriginalConstructor()
			->getMock();
		$auth->expects($this->any())
			->method('acl_get')
			->with($this->stringContains('_'), $this->anything())
			->will($this->returnValueMap($auth_map));

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$translator = new \phpbb\language\language($lang_loader);

		$user = new \phpbb\user($translator, '\phpbb\datetime');
		$user->host = 'www.example.com/';
		$user->page['root_script_path'] = '/phpBB/';
		$user->data['is_registered'] = true;
		$user->data['user_form_salt'] = 'salt';

		$request = $this->getMockBuilder('\phpbb\request\request_interface')
			->disableOriginalConstructor()
			->getMock();

		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();
		$template->expects($this->any())
			->method('assign_var');
		$this->template = &$template;

		$phpbb_container = $this->getMockBuilder('\Symfony\Component\DependencyInjection\ContainerInterface')
			->disableOriginalConstructor()
			->getMock();
		$phpbb_container->expects($this->any())
			->method('get')
			->with('content.visibility')
			->will($this->returnCallback(function () use ($auth, $config, $phpbb_dispatcher, $db, $user, $phpbb_root_path, $phpEx)
			{
				return new \phpbb\content_visibility($auth, $config, $phpbb_dispatcher, $db, $user, $phpbb_root_path, $phpEx, 'phpbb_forums', 'phpbb_posts', 'phbb_topics', 'phpbb_users');
			}));

		$config = new \phpbb\config\config(array());

		$controller_helper = $this->getMockBuilder('\phpbb\controller\helper')
			->disableOriginalConstructor()
			->getMock();
		$controller_helper->expects($this->any())
			->method('render')
			->willReturnCallback(function ($template_file, $page_title = '', $status_code = 200, $display_online_list = false)
			{
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
				array('U_MARK_FORUMS'),
			),
			array(
				array(
					array('m_', 0, true),
				),
				array('U_MCP', 'U_MARK_FORUMS'),
			),
		);
	}

	/**
	 * @dataProvider sample_data
	 *
	 * @param array $auth_map
	 * @param array $expected
	 */
	public function test_mcp_link_is_set(array $auth_map, array $expected)
	{
		$controller = $this->get_controller($auth_map);

		$temp_keys = [];
		$this->template->expects($this->any())
			->method('assign_var')
			->with($this->isType('string'), $this->anything())
			->willReturnCallback(function ($key) use (&$temp_keys)
			{
				$temp_keys[] = $key;
			});

		$controller->handle();

		$this->assertSame($expected, $temp_keys);
	}
}
