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

class add_viewonline_location_test extends listener_base
{
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
				'FORUM_INDEX',
			),
		);
	}

	/**
	 * @dataProvider add_viewonline_location_test_data
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
