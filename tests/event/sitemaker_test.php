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

class sitemaker_test extends \phpbb_database_test_case
{
	protected $cache;
	protected $config;
	protected $template;
	protected $translator;
	protected $user;
	protected $util;
	protected $blocks;
	protected $navigation;

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
	 * @return \blitze\sitemaker\event\sitemaker
	 */
	protected function get_listener()
	{
		global $cache, $phpbb_root_path, $phpEx;

		$this->config = new \phpbb\config\config(array());
		$this->cache = $cache = new \phpbb_mock_cache();

		$this->translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$this->translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode('-', func_get_args());
			});

		$this->user = new \phpbb\user($this->translator, '\phpbb\datetime');

		$this->template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$this->util = $this->getMockBuilder('\blitze\sitemaker\services\util')
			->disableOriginalConstructor()
			->getMock();

		$this->blocks = $this->getMockBuilder('\blitze\sitemaker\services\blocks\display')
			->disableOriginalConstructor()
			->getMock();

		$this->navigation = $this->getMockBuilder('\blitze\sitemaker\services\menus\navigation')
			->disableOriginalConstructor()
			->getMock();

		return new \blitze\sitemaker\event\sitemaker($this->cache, $this->config, $this->template, $this->translator, $this->user, $this->util, $this->blocks, $this->navigation);
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
			'core.page_footer',
			'core.adm_page_footer',
			'core.submit_post_end',
			'core.delete_posts_after',
			'core.display_forums_modify_sql',
		);

		$this->assertEquals($listeners, array_keys(\blitze\sitemaker\event\sitemaker::getSubscribedEvents()));
	}

	/**
	* Test the event listener is constructed correctly
	*/
	public function test_clear_cached_queries()
	{
		$listener = $this->get_listener();

		$dispatcher = new EventDispatcher();
		$dispatcher->addListener('core.submit_post_end', array($listener, 'clear_cached_queries'));
		$dispatcher->dispatch('core.submit_post_end');

		$this->assertTrue(defined('SITEMAKER_FORUM_CHANGED'));
	}

	/**
	 * @return array
	 */
	public function show_sitemaker_test_data()
	{
		return array(
			array(
				false,
				array(
					'sm_hide_birthday' => true,
					'sm_hide_login' => true,
					'sm_hide_online' => true,
					'sm_show_forum_nav' => true,
					'sitemaker_startpage_controller' => '',
				),
				array(
					'S_USER_LOGGED_IN'			=> true,
					'S_DISPLAY_ONLINE_LIST'		=> false,
					'S_DISPLAY_BIRTHDAY_LIST'	=> false,
				),
			),
			array(
				true,
				array(
					'sm_hide_birthday' => true,
					'sm_hide_login' => true,
					'sm_hide_online' => true,
					'sm_show_forum_nav' => true,
					'sm_navbar_menu' => 2,
					'sitemaker_startpage_controller' => '',
				),
				array(
					'S_USER_LOGGED_IN'			=> true,
					'S_DISPLAY_ONLINE_LIST'		=> false,
					'S_DISPLAY_BIRTHDAY_LIST'	=> false,
				),
			),
			array(
				false,
				array(
					'sm_hide_birthday' => false,
					'sm_hide_login' => false,
					'sm_hide_online' => false,
					'sm_show_forum_nav' => false,
					'sm_navbar_menu' => 2,
					'sitemaker_startpage_controller' => 'some_controller',
				),
				array(
					'S_USER_LOGGED_IN'			=> false,
					'S_DISPLAY_ONLINE_LIST'		=> false,
					'S_DISPLAY_BIRTHDAY_LIST'	=> false,
					'L_INDEX'					=> 'HOME',
				),
			),
			array(
				true,
				array(
					'sm_hide_birthday' => true,
					'sm_hide_login' => false,
					'sm_hide_online' => true,
					'sm_show_forum_nav' => true,
					'sm_navbar_menu' => 0,
					'sitemaker_startpage_controller' => 'some_controller',
				),
				array(
					'S_USER_LOGGED_IN'			=> true,
					'S_DISPLAY_ONLINE_LIST'		=> false,
					'S_DISPLAY_BIRTHDAY_LIST'	=> false,
					'L_INDEX'					=> 'HOME',
				),
			),
		);
	}

	/**
	 * @dataProvider show_sitemaker_test_data
	 * @param bool $user_is_logged_in
	 * @param array $config_data
	 * @param array $expected
	 */
	public function test_show_sitemaker($user_is_logged_in, array $config_data, array $expected)
	{
		$listener = $this->get_listener();

		foreach ($config_data as $key => $value)
		{
			$this->config->set($key, $value);
		}

		$this->blocks->expects($this->once())
			->method('show');

		$this->util->expects($this->once())
			->method('set_assets');

		$this->user->data['is_registered'] = $user_is_logged_in;

		$this->navigation->expects($this->exactly($config_data['sm_navbar_menu'] ? 1 : 0))
			->method('build_menu');

		$tpl_data = array();
		$this->template->expects($this->exactly($config_data['sitemaker_startpage_controller'] ? 1 : 0))
			->method('assign_var')
			->will($this->returnCallback(function($key, $value) use (&$tpl_data) {
				$tpl_data[$key] = $value;
			}));

		$this->template->expects($this->exactly(1))
			->method('assign_vars')
			->will($this->returnCallback(function($data) use (&$tpl_data) {
				$tpl_data = array_merge($tpl_data, $data);
			}));

		$this->template->expects($this->any())
			->method('assign_display')
			->will($this->returnCallback(function() use (&$tpl_data) {
				return $tpl_data;
			}));

		$dispatcher = new EventDispatcher();
		$dispatcher->addListener('core.page_footer', array($listener, 'show_sitemaker'));
		$dispatcher->dispatch('core.page_footer');

		$this->assertEquals($expected, $this->template->assign_display('test'));
	}

	/**
	 * @return array
	 */
	public function hide_hidden_forums_test_data()
	{
		return array(
			array('', 'f.hidden_forum <> 1'),
			array('some condition', 'some condition AND f.hidden_forum <> 1'),
		);
	}

	/**
	 * @dataProvider hide_hidden_forums_test_data
	 *
	 * @param string $sql_where
	 * @param string $expected_sql_where
	 */
	public function test_hide_hidden_forums($sql_where, $expected_sql_where)
	{
		$sql_ary = array (
			'SELECT'	=> 'f.*',
			'FROM'		=> array (
				'phpbb_forums' => 'f',
			),
			'LEFT_JOIN'	=> array(),
			'WHERE'		=> $sql_where,
			'ORDER_BY'	=> 'f.left_id',
		);

		$listener = $this->get_listener();

		$dispatcher = new EventDispatcher();
		$dispatcher->addListener('core.display_forums_modify_sql', array($listener, 'hide_hidden_forums'));

		$event_data = array('sql_ary');
		$event = new data(compact($event_data));
		$dispatcher->dispatch('core.display_forums_modify_sql', $event);

		$result = $event['sql_ary'];
		$this->assertEquals($expected_sql_where, $result['WHERE']);
	}
}
