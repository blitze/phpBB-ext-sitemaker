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
	 * @return \blitze\sitemaker\controller\forum
	 */
	protected function get_controller()
	{
		global $phpbb_dispatcher, $phpbb_container, $auth, $db, $template, $user, $phpbb_root_path, $phpEx;

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
		$db = $this->new_dbal();
		$auth = $this->getMock('\phpbb\auth\auth');
		$config = new \phpbb\config\config(array());
		$user = $this->getMock('\phpbb\user', array(), array('\phpbb\datetime'));

		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$phpbb_container = $this->getMock('\Symfony\Component\DependencyInjection\ContainerInterface');
		$phpbb_container->expects($this->any())
			->method('get')
			->with('content.visibility')
			->will($this->returnCallback(function() use ($auth, $config, $phpbb_dispatcher, $db, $user, $phpbb_root_path, $phpEx) {
				return new \phpbb\content_visibility($auth, $config, $phpbb_dispatcher, $db, $user, $phpbb_root_path, $phpEx, 'phpbb_forums', 'phpbb_posts', 'phbb_topics', 'phpbb_users');
			}));

		$config = new \phpbb\config\config(array());

		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$controller_helper = $this->getMockBuilder('\phpbb\controller\helper')
			->disableOriginalConstructor()
			->getMock();
		$controller_helper->expects($this->any())
			->method('render')
			->willReturnCallback(function($template_file, $page_title = '', $status_code = 200, $display_online_list = false) {
				return new \Symfony\Component\HttpFoundation\Response($template_file, $status_code);
			});

		return  new forum($config, $controller_helper, $template, $user, $phpbb_root_path, $phpEx);
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
}
