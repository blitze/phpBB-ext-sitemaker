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
use Symfony\Component\EventDispatcher\EventDispatcher;

class set_startpage_test extends listener_base
{
	/**
	 * @return null
	 */
	public function set_startpage_test_data()
	{
		return array(
			array('index.php', '', '', '', '', '', 'f.hidden_forum <> 1'),
			array('index.php', '', '', '', '', 'some condition', 'some condition AND f.hidden_forum <> 1'),
			array('index.php', 'foo.baz.controller', 'no_exists', 'fails', '', '', 'f.hidden_forum <> 1'),
			array('index.php', 'foo.bar.controller', 'no_exists', 'test', '', 'other condition', 'other condition AND f.hidden_forum <> 1'),
			array('index.php', 'foo.bar.controller', 'handle', 'test', 'Viewing page: test', '', ''),
			array('faq.php', 'foo.bar.controller', 'handle', 'faq', '', 'something', 'something AND f.hidden_forum <> 1'),
		);
	}

	/**
	 * @dataProvider set_startpage_test_data
	 */
	public function test_set_startpage($current_page, $controller_service, $controller_method, $controller_params, $expected_contents, $sql_where, $expected_sql_where)
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

		if ($expected_contents)
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

		$event_data = array('sql_ary');
		$event = new data(compact($event_data));
		$dispatcher->dispatch('core.display_forums_modify_sql', $event);

		$this->expectOutputString($expected_contents);

		if (!$expected_contents)
		{
			$result = $event['sql_ary'];
			$this->assertEquals($expected_sql_where, $result['WHERE']);
		}
	}
}
