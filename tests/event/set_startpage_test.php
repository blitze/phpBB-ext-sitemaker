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

class set_startpage_test extends listener_base
{
	/**
	 * @return null
	 */
	public function set_startpage_test_data()
	{
		return array(
			array('index.php', '', '', '', ''),
			array('index.php', 'foo.baz.controller', 'no_exists', 'fails', ''),
			array('index.php', 'foo.bar.controller', 'no_exists', 'test', ''),
			array('index.php', 'foo.bar.controller', 'handle', 'test', 'Viewing page: test'),
			array('faq.php', 'foo.bar.controller', 'handle', 'faq', ''),
		);
	}

	/**
	 * @dataProvider set_startpage_test_data
	 */
	public function test_set_startpage($current_page, $controller_service, $controller_method, $controller_params, $expected)
	{
		$listener = $this->get_listener();

		if ($expected)
		{
			$listener->expects($this->once())
				->method('exit_handler');
		}

		$this->config['sitemaker_startpage_controller'] = $controller_service;
		$this->config['sitemaker_startpage_method'] = $controller_method;
		$this->config['sitemaker_startpage_params'] = $controller_params;

		$this->user->page['page_name'] = $current_page;

		$dispatcher = new EventDispatcher();
		$dispatcher->addListener('core.display_forums_modify_sql', array($listener, 'set_startpage'));
		$dispatcher->dispatch('core.display_forums_modify_sql');

		$this->expectOutputString($expected);
	}
}
