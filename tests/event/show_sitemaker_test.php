<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\event;

use Symfony\Component\EventDispatcher\EventDispatcher;

class show_sitemaker_test extends listener_base
{
	/**
	 * @return null
	 */
	public function show_sitemaker_test_data()
	{
		return array(
			array(
				false,
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
				true,
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
					'SM_SHOW_FORUM_NAV'			=> true,
				),
			),
			array(
				false,
				false,
				array(
					'sm_hide_birthday' => false,
					'sm_hide_login' => false,
					'sm_hide_online' => false,
					'sm_show_forum_nav' => false,
					'sitemaker_startpage_controller' => 'some_controller',
				),
				array(
					'S_USER_LOGGED_IN'			=> false,
					'S_DISPLAY_ONLINE_LIST'		=> false,
					'S_DISPLAY_BIRTHDAY_LIST'	=> false,
				),
			),
			array(
				false,
				true,
				array(
					'sm_hide_birthday' => true,
					'sm_hide_login' => false,
					'sm_hide_online' => true,
					'sm_show_forum_nav' => true,
					'sitemaker_startpage_controller' => 'some_controller',
				),
				array(
					'S_USER_LOGGED_IN'			=> true,
					'S_DISPLAY_ONLINE_LIST'		=> false,
					'S_DISPLAY_BIRTHDAY_LIST'	=> false,
				),
			),
		);
	}

	/**
	 * @dataProvider show_sitemaker_test_data
	 * @param bool $is_startpage
	 * @param bool $user_is_logged_in
	 * @param array $config_data
	 * @param array $expected
	 */
	public function test_show_sitemaker($is_startpage, $user_is_logged_in, array $config_data, array $expected)
	{
		$listener = $this->get_listener();

		foreach ($config_data as $key => $value)
		{
			$this->config->set($key, $value);
		}

		// http://stackoverflow.com/questions/18558183/phpunit-mockbuilder-set-mock-object-internal-property
		$reflection = new \ReflectionClass($listener);
		$reflection_property = $reflection->getProperty('is_startpage');
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($listener, $is_startpage);

		$this->blocks->expects($this->once())
			->method('show');

		$this->util->expects($this->once())
			->method('set_assets');

		$this->user->data['is_registered'] = $user_is_logged_in;

		$count = ($is_startpage) ? 1 : 0;

		$tpl_data = array();
		$this->template->expects($this->exactly($count))
			->method('destroy_block_vars')
			->with('navlinks');

		$this->template->expects($this->exactly($count))
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
}
