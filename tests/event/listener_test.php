<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\event;

use phpbb\event\data;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\EventDispatcher\EventDispatcher;
use phpbb\request\request_interface;

class listener_test extends \phpbb_database_test_case
{
	protected $navbar;

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
	 * Create the listener object
	 *
	 * @return \blitze\sitemaker\event\listener
	 */
	protected function get_listener()
	{
		global $phpbb_root_path, $phpEx;

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$language = new \phpbb\language\language($lang_loader);

		$container = $this->getMockBuilder('\Symfony\Component\DependencyInjection\ContainerInterface')
			->disableOriginalConstructor()
			->getMock();

		$container->expects($this->any())
			->method('has')
			->will($this->returnCallback(function ($service_name)
			{
				return ($service_name === 'foo.bar.controller') ? true : false;
			}));

		$controller_helper = $this->getMockBuilder('\phpbb\controller\helper')
			->disableOriginalConstructor()
			->getMock();

		$controller_helper->expects($this->any())
			->method('route')
			->willReturnCallback(function ($route, array $params = array())
			{
				return $route . '#' . serialize($params);
			});

		$this->navbar = $this->getMockBuilder('\blitze\sitemaker\services\navbar')
			->disableOriginalConstructor()
			->getMock();

		return new \blitze\sitemaker\event\listener($controller_helper, $language, $this->navbar, $phpEx);
	}

	/**
	 * Test the event listener is constructed correctly
	 */
	public function test_construct()
	{
		$listener = $this->get_listener();
		$this->assertInstanceOf('\Symfony\Component\EventDispatcher\EventSubscriberInterface', $listener);
	}

	/**
	 * Test the event listener is subscribing events
	 */
	public function test_getSubscribedEvents()
	{
		$listeners = array(
			'core.user_setup',
			'core.permissions',
			'core.viewonline_overwrite_location',
			'core.acp_styles_action_before',
		);

		$this->assertEquals($listeners, array_keys(\blitze\sitemaker\event\listener::getSubscribedEvents()));
	}

	/**
	 * @return array
	 */
	public function load_common_language_test_data()
	{
		return array(
			array(
				array(),
				array(
					array(
						'ext_name' => 'blitze/sitemaker',
						'lang_set' => 'common',
					),
				),
			),
			array(
				array(
					array(
						'ext_name' => 'phpbb/pages',
						'lang_set' => 'pages_common',
					),
				),
				array(
					array(
						'ext_name' => 'phpbb/pages',
						'lang_set' => 'pages_common',
					),
					array(
						'ext_name' => 'blitze/sitemaker',
						'lang_set' => 'common',
					),
				),
			),
		);
	}

	/**
	 * @dataProvider load_common_language_test_data
	 *
	 * @param array $lang_set_ext
	 * @param array $expected_contains
	 */
	public function test_load_common_language(array $lang_set_ext, array $expected_contains)
	{
		$listener = $this->get_listener();

		$dispatcher = new EventDispatcher();
		$dispatcher->addListener('core.user_setup', array($listener, 'load_common_language'));

		$event_data = array('lang_set_ext');
		$event = new data(compact($event_data));
		$dispatcher->dispatch('core.user_setup', $event);

		$lang_set_ext = $event->get_data_filtered($event_data);
		$lang_set_ext = $lang_set_ext['lang_set_ext'];

		foreach ($expected_contains as $expected)
		{
			$this->assertContains($expected, $lang_set_ext);
		}
	}

	/**
	 * Data set for test_add_permissions
	 *
	 * @return array
	 */
	public function load_permission_language_test_data()
	{
		return array(
			array(
				array(),
				array(
					'a_sm_settings' => array('lang' => 'ACL_A_SM_SETTINGS', 'cat' => 'misc'),
					'a_sm_manage_blocks' => array('lang' => 'ACL_A_SM_MANAGE_BLOCKS', 'cat' => 'misc'),
					'a_sm_manage_menus' => array('lang' => 'ACL_A_SM_MANAGE_MENUS', 'cat' => 'misc'),
					'a_sm_filemanager' => array('lang' => 'ACL_A_SM_FILEMANAGER', 'cat' => 'misc'),
					'u_sm_filemanager' => array('lang' => 'ACL_U_SM_FILEMANAGER', 'cat' => 'misc'),
				),
			),
			array(
				array(
					'a_foo' => array('lang' => 'ACL_A_FOO', 'cat' => 'misc'),
				),
				array(
					'a_foo' => array('lang' => 'ACL_A_FOO', 'cat' => 'misc'),
					'a_sm_settings' => array('lang' => 'ACL_A_SM_SETTINGS', 'cat' => 'misc'),
					'a_sm_manage_blocks' => array('lang' => 'ACL_A_SM_MANAGE_BLOCKS', 'cat' => 'misc'),
					'a_sm_manage_menus' => array('lang' => 'ACL_A_SM_MANAGE_MENUS', 'cat' => 'misc'),
					'a_sm_filemanager' => array('lang' => 'ACL_A_SM_FILEMANAGER', 'cat' => 'misc'),
					'u_sm_filemanager' => array('lang' => 'ACL_U_SM_FILEMANAGER', 'cat' => 'misc'),
				),
			),
		);
	}

	/**
	 * Test the load_permission_language event
	 *
	 * @dataProvider load_permission_language_test_data
	 * @param array $permisions_data
	 * @param array $expected_permissions
	 */
	public function test_load_permission_language(array $permisions_data, array $expected_permissions)
	{
		$data = new \phpbb\event\data(array(
			'permissions'	=> $permisions_data,
		));

		$listener = $this->get_listener();
		$listener->load_permission_language($data);

		$this->assertSame($data['permissions'], $expected_permissions);
	}

	/**
	 * @return array
	 */
	public function add_viewonline_location_test_data()
	{
		global $phpEx;

		return array(
			array(
				array(
					1 => 'index',
				),
				array(),
				array(),
				'$location_url',
				'$location',
				'$location_url',
				'$location',
			),
			array(
				array(
					1 => 'app',
				),
				array(
					'session_page' => 'app.' . $phpEx . '/forum'
				),
				array(),
				'$location_url',
				'$location',
				'blitze_sitemaker_forum#a:0:{}',
				'Board index',
			),
		);
	}

	/**
	 * @dataProvider add_viewonline_location_test_data
	 *
	 * @param array $on_page
	 * @param array $row
	 * @param array $forum_data
	 * @param string $location_url
	 * @param string $location
	 * @param string $expected_location_url
	 * @param string $expected_location
	 */
	public function test_add_viewonline_location(array $on_page, array $row, array $forum_data, $location_url, $location, $expected_location_url, $expected_location)
	{
		$listener = $this->get_listener();

		$dispatcher = new EventDispatcher();
		$dispatcher->addListener('core.viewonline_overwrite_location', array($listener, 'add_viewonline_location'));

		$event_data = array('on_page', 'row', 'location_url', 'location', 'forum_data');
		$event = new data(compact($event_data));
		$dispatcher->dispatch('core.viewonline_overwrite_location', $event);

		$event_data_after = $event->get_data_filtered($event_data);
		foreach ($event_data as $expected)
		{
			$this->assertArrayHasKey($expected, $event_data_after);
		}

		extract($event_data_after);

		$this->assertEquals($expected_location_url, $location_url);
		$this->assertEquals($expected_location, $location);
	}

	/**
	 * @return array
	 */
	public function remove_navbar_css_test_data()
	{
		return array(
			array(
				'install',
				false,
				0
			),
			array(
				'install',
				true,
				0
			),
			array(
				'uninstall',
				false,
				0
			),
			array(
				'uninstall',
				true,
				1
			),
		);
	}

	/**
	 * @dataProvider remove_navbar_css_test_data
	 * @param string $action
	 * @param boolean $confirmed
	 * @param int $expected_count
	 */
	public function test_remove_navbar_css($action, $confirmed, $expected_count)
	{
		global $db, $language, $request, $user;

		$listener = $this->get_listener();

		$user_id = 2;
		$session_id = 'session_id';
		$confirm_key = 'confirm_key';

		$variable_map = array(
			array('confirm', '', true, request_interface::POST, $confirmed ? 'YES' : ''),
			array('confirm_uid', 0, false, request_interface::REQUEST, $user_id),
			array('sess', '', false, request_interface::REQUEST, $session_id),
			array('confirm_key', '', false, request_interface::REQUEST, $confirm_key),
		);

		$db = $this->new_dbal();

		$language = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$language->expects($this->any())
			->method('lang')
			->willReturnCallback(function ()
			{
				return implode('-', func_get_args());
			});

		$request = $this->getMockBuilder('\phpbb\request\request_interface')
			->disableOriginalConstructor()
			->getMock();
		$request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap($variable_map));

		$user = new \phpbb\user($language, '\phpbb\datetime');
		$user->data['user_id'] = $user_id;
		$user->data['user_last_confirm_key'] = $confirm_key;
		$user->session_id = $session_id;

		$this->navbar->expects($this->exactly($expected_count))
			->method('cleanup')
			->with($this->isEmpty());

		$dispatcher = new EventDispatcher();
		$dispatcher->addListener('core.acp_styles_action_before', array($listener, 'remove_navbar_css'));

		$event_data = array('action');
		$event = new data(compact($event_data));
		$dispatcher->dispatch('core.acp_styles_action_before', $event);
	}
}
