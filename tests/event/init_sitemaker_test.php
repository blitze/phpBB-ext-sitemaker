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

class init_sitemaker_test extends listener_base
{
	/**
	 * @return null
	 */
	public function init_sitemaker_test_data()
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
	 * @dataProvider init_sitemaker_test_data
	 */
	public function test_init_sitemaker($lang_set_ext, $expected_contains)
	{
		$listener = $this->get_listener();

		$dispatcher = new EventDispatcher();
		$dispatcher->addListener('core.user_setup', array($listener, 'init_sitemaker'));

		$event_data = array('lang_set_ext');
		$event = new data(compact($event_data));
		$dispatcher->dispatch('core.user_setup', $event);

		extract($event->get_data_filtered($event_data));

		foreach ($expected_contains as $expected)
		{
			$this->assertContains($expected, $lang_set_ext);
		}
	}

	/**
	 * Ensure our constants are defined
	 *
	 * @depends test_init_sitemaker
	 */
	public function test_defined_constants()
	{
		$defined_constants = array(
			'FORUMS_ORDER_FIRST_POST',
			'FORUMS_ORDER_LAST_POST',
			'FORUMS_ORDER_LAST_READ',
		);

		foreach ($defined_constants as $constant)
		{
			$this->assertTrue(defined($constant));
		}
	}
}
