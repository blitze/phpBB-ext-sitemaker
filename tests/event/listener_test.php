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

class listener_test extends \phpbb_test_case
{
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

		$container = $this->getMock('\Symfony\Component\DependencyInjection\ContainerInterface');

		$container->expects($this->any())
			->method('has')
			->will($this->returnCallback(function($service_name) {
				return ($service_name === 'foo.bar.controller') ? true : false;
			}));

		$controller_helper = $this->getMockBuilder('\phpbb\controller\helper')
			->disableOriginalConstructor()
			->getMock();

		$controller_helper->expects($this->any())
			->method('route')
			->willReturnCallback(function ($route, array $params = array()) {
				return $route . '#' . serialize($params);
			});

		$container->expects($this->any())
			->method('get')
			->will($this->returnCallback(function($service_name) use (&$controller_helper) {
				if ($service_name === 'controller.helper')
				{
					return $controller_helper;
				}
			}));

		return new \blitze\sitemaker\event\listener($container, $language, $phpEx);
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
	 * @return null
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
}
