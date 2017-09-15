<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\event;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\EventDispatcher\EventDispatcher;

class startpage_test extends \phpbb_database_test_case
{
	protected $config;
	protected $template;
	protected $request;
	protected $user;

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
	 * Create the listener object
	 *
	 * @return \blitze\sitemaker\event\listener
	 */
	protected function get_listener()
	{
		global $phpEx;

		$this->config = new \phpbb\config\config(array());

		$this->template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$this->request = $this->getMock('\phpbb\request\request_interface');

		$language = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$language->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode('-', func_get_args());
			});

		$this->user = new \phpbb\user($language, '\phpbb\datetime');

		$container = $this->getMock('\Symfony\Component\DependencyInjection\ContainerInterface');

		$container->expects($this->any())
			->method('has')
			->will($this->returnCallback(function($service_name) {
				return ($service_name === 'foo.bar.controller') ? true : false;
			}));

		$dummy_extension = $this->getMockBuilder('stdClass')
			->setMockClassName('foo_bar_controller')
			->setMethods(array('handle'))
			->getMock();
		$dummy_extension->expects($this->any())
			->method('handle')
			->willReturnCallback(function ($page) {
				return new Response('Viewing page: ' . $page);
			});

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
			->will($this->returnCallback(function($service_name) use (&$controller_helper, &$dummy_extension) {
				switch ($service_name)
				{
					case 'controller.helper':
						return $controller_helper;

					case 'foo.bar.controller':
						return $dummy_extension;
				}
			}));

		return $this->getMockBuilder('\blitze\sitemaker\event\startpage')
            ->setConstructorArgs(array($this->config, $container, $this->request, $this->template, $language, $this->user, $phpEx))
            ->setMethods(array('exit_handler'))
            ->getMock();
	}

	/**
	 * Test the event listener is constructed correctly
	 * @return void
	 */
	public function test_construct()
	{
		$listener = $this->get_listener();
		$this->assertInstanceOf('\Symfony\Component\EventDispatcher\EventSubscriberInterface', $listener);
	}

	/**
	 * Test the event listener is subscribing events
	 * @return void
	 */
	public function test_getSubscribedEvents()
	{
		$listeners = array(
			'core.page_header',
			'core.display_forums_modify_sql',
			'core.page_footer',
		);

		$this->assertEquals($listeners, array_keys(\blitze\sitemaker\event\startpage::getSubscribedEvents()));
	}

	/**
	 * @return array
	 */
	public function add_forum_to_navbar_test_data()
	{
		$forum_name = 'Forum';
		$u_viewforum = 'blitze_sitemaker_forum#a:0:{}';

		return array(
			// no start page
			array(
				'index.php',
				array(),
				array(),
				array(),
			),

			// start page, "Forum" is added to navbar for non-forum pages but not to breadcrump
			array(
				'index.php',
				array(
					'sm_forum_icon' => 'fa fa-comments',
					'sm_show_forum_nav' => true,
					'sitemaker_startpage_controller' => 'foo.bar.controller',
				),
				array(
					'SM_FORUM_ICON' => 'fa fa-comments',
					'SM_SHOW_FORUM_NAV'	=> true,
					'U_SM_VIEWFORUM' => $u_viewforum,
				),
				array(),
			),

			// start page, "Forum" should be added to navbar but user has chosen not to do that
			array(
				'index.php',
				array(
					'sm_forum_icon' => 'fa fa-comments',
					'sm_show_forum_nav' => false,
					'sitemaker_startpage_controller' => 'foo.bar.controller',
				),
				array(
					'SM_FORUM_ICON' => 'fa fa-comments',
					'SM_SHOW_FORUM_NAV'	=> false,
					'U_SM_VIEWFORUM' => $u_viewforum,
				),
				array(),
			),

			// start page, "Forum" is added to breadcrump for forum pages and not to non-forum pages
			array(
				'viewforum.php?f=1',
				array(
					'sm_forum_icon' => 'fa fa-comments',
					'sm_show_forum_nav' => false,
					'sitemaker_startpage_controller' => 'foo.bar.controller',
				),
				array(
					'SM_FORUM_ICON' => 'fa fa-comments',
					'SM_SHOW_FORUM_NAV'	=> false,
					'U_SM_VIEWFORUM' => $u_viewforum,
				),
				array(
					'FORUM_NAME'	=> $forum_name,
					'U_VIEW_FORUM'	=> $u_viewforum,
				),
			),
			// viewtopic
			array(
				'viewtopic.php?f=1&t=1',
				array(
					'sm_forum_icon' => '',
					'sm_show_forum_nav' => false,
					'sitemaker_startpage_controller' => 'foo.bar.controller',
				),
				array(
					'SM_FORUM_ICON' => '',
					'SM_SHOW_FORUM_NAV'	=> false,
					'U_SM_VIEWFORUM' => $u_viewforum,
				),
				array(
					'FORUM_NAME'	=> $forum_name,
					'U_VIEW_FORUM'	=> $u_viewforum,
				),
			),
			// posting
			array(
				'posting.php?f=1',
				array(
					'sm_forum_icon' => 'fa fa-comments-o',
					'sm_show_forum_nav' => true,
					'sitemaker_startpage_controller' => 'foo.bar.controller',
				),
				array(
					'SM_FORUM_ICON' => 'fa fa-comments-o',
					'SM_SHOW_FORUM_NAV'	=> true,
					'U_SM_VIEWFORUM' => $u_viewforum,
				),
				array(
					'FORUM_NAME'	=> $forum_name,
					'U_VIEW_FORUM'	=> $u_viewforum,
				),
			),

			// do not add "Forum" to breadcrump when on forum controller
			array(
				'app.php/forum',
				array(
					'sm_forum_icon' => '',
					'sm_show_forum_nav' => true,
					'sitemaker_startpage_controller' => 'foo.bar.controller',
				),
				array(
					'SM_FORUM_ICON' => '',
					'SM_SHOW_FORUM_NAV'	=> true,
					'U_SM_VIEWFORUM' => $u_viewforum,
				),
				array(),
			),
		);
	}

	/**
	 * @dataProvider add_forum_to_navbar_test_data
	 *
	 * @param string $start_page
	 * @param string $current_page
	 * @param array $navbar
	 * @param array $breadcrump
	 */
	public function test_add_forum_to_navbar($current_page, array $config_data, array $navbar, array $breadcrump)
	{
		$listener = $this->get_listener();

		$this->user->page['page'] = $current_page;

		foreach ($config_data as $key => $value)
		{
			$this->config->set($key, $value);
		}

		$this->request->expects($this->any())
			->method('is_set')
			->with('f')
			->will($this->returnCallback(function() use ($current_page) {
				return (strpos($current_page, 'f=') !== false) ? true : false;
			}));

		// navbar
		$count = (sizeof($navbar)) ? 1 : 0;
		$this->template->expects($this->exactly($count))
			->method('assign_vars')
			->with($this->equalTo($navbar));

		// breadcrump
		$count = (sizeof($breadcrump)) ? 1 : 0;
		$this->template->expects($this->exactly($count))
			->method('alter_block_array')
			->withConsecutive(array('navlinks'), $breadcrump);

		$dispatcher = new EventDispatcher();
		$dispatcher->addListener('core.page_header', array($listener, 'add_forum_to_navbar'));
		$dispatcher->dispatch('core.page_header');
	}

	/**
	 * @return array
	 */
	public function set_startpage_test_data()
	{
		return array(
			array('index.php', '', '', '', ''),
			array('index.php', '', '', '', ''),
			array('index.php', 'foo.baz.controller', 'no_exists', 'fails', ''),
			array('index.php', 'foo.bar.controller', 'no_exists', 'test', ''),
			array('index.php', 'foo.bar.controller', 'handle', 'test', 'Viewing page: test'),
			array('faq.php', 'foo.bar.controller', 'handle', 'faq', ''),
		);
	}

	/**
	 * @dataProvider set_startpage_test_data
	 *
	 * @param string $current_page
	 * @param string $controller_service
	 * @param string $controller_method
	 * @param string $controller_params
	 * @param string $expected_contents
	 */
	public function test_set_startpage($current_page, $controller_service, $controller_method, $controller_params, $expected_contents)
	{
		$listener = $this->get_listener();

		$this->config->set('sitemaker_startpage_controller', $controller_service);
		$this->config->set('sitemaker_startpage_method', $controller_method);
		$this->config->set('sitemaker_startpage_params', $controller_params);

		$this->user->page['page_name'] = $current_page;

		if ($expected_contents)
		{
			$listener->expects($this->once())
				->method('exit_handler');
		}

		$dispatcher = new EventDispatcher();
		$dispatcher->addListener('core.display_forums_modify_sql', array($listener, 'set_startpage'));
		$dispatcher->dispatch('core.display_forums_modify_sql');

		$this->expectOutputString($expected_contents);

		if ($controller_method == 'no_exists')
		{
			$this->assertEquals('', $this->config['sitemaker_startpage_controller']);
			$this->assertEquals('', $this->config['sitemaker_startpage_method']);
			$this->assertEquals('', $this->config['sitemaker_startpage_params']);
		}
	}

	/**
	 * @return array
	 */
	public function cleanup_breadcrumbs_test_data()
	{
		return array(
			array(false, 0),
			array(true, 1),
		);
	}

	/**
	 * @dataProvider cleanup_breadcrumbs_test_data
	 * @param bool $is_startpage
	 * @param int $expected_count
	 */
	public function test_cleanup_breadcrumbs($is_startpage, $expected_count)
	{
		$listener = $this->get_listener();

		$reflection = new \ReflectionClass($listener);
		$reflection_property = $reflection->getProperty('is_startpage');
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($listener, $is_startpage);

		$this->template->expects($this->exactly($expected_count))
			->method('destroy_block_vars')
			->with('navlinks');

		$dispatcher = new EventDispatcher();
		$dispatcher->addListener('core.page_footer', array($listener, 'cleanup_breadcrumbs'));
		$dispatcher->dispatch('core.page_footer');
	}
}
