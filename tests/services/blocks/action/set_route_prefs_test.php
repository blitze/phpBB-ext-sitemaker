<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks\action;

use phpbb\request\request_interface;

class set_route_prefs_test extends base_action
{
	/**
	 * Data set for test_set_route_prefs
	 * @return array
	 */
	public function set_route_prefs_test_data()
	{
		return array(
			// route exists and has blocks, and prefs do not match default
			array(
				array(
					array('route', '', false, request_interface::REQUEST, 'index.php'),
					array('hide_blocks', false, false, request_interface::REQUEST, true),
					array('ex_positions', array(0 => ''), false, request_interface::REQUEST, array('sidebar', 'subcontent')),
				),
				array(
					'route_id'		=> 1,
					'style'			=> 1,
					'hide_blocks'	=> true,
					'has_blocks'	=> true,
					'ex_positions'	=> array('sidebar', 'subcontent'),
				),
			),
			// route exists and has blocks, and prefs match default
			array(
				array(
					array('route', '', false, request_interface::REQUEST, 'index.php'),
					array('hide_blocks', false, false, request_interface::REQUEST, false),
					array('ex_positions', array(0 => ''), false, request_interface::REQUEST, array()),
				),
				array(
					'route_id'		=> 1,
					'style'			=> 1,
					'hide_blocks'	=> false,
					'has_blocks'	=> true,
					'ex_positions'	=> array(),
				),
			),
			// route exists and does not have blocks, and prefs match default
			array(
				array(
					array('route', '', false, request_interface::REQUEST, 'search.php'),
					array('hide_blocks', false, false, request_interface::REQUEST, false),
					array('ex_positions', array(0 => ''), false, request_interface::REQUEST, array()),
				),
				null,
			),
			// route does not exist and therefore has no blocks, and prefs do not match default
			array(
				array(
					array('route', '', false, request_interface::REQUEST, 'some_page.php'),
					array('hide_blocks', false, false, request_interface::REQUEST, true),
					array('ex_positions', array(0 => ''), false, request_interface::REQUEST, array()),
				),
				array(
					'route_id'		=> 6,
					'style'			=> 1,
					'hide_blocks'	=> true,
					'has_blocks'	=> false,
					'ex_positions'	=> array(),
				),
			),
			// route does not exist and therefore has no blocks, and prefs match default
			array(
				array(
					array('route', '', false, request_interface::REQUEST, 'some_page.php'),
					array('hide_blocks', false, false, request_interface::REQUEST, false),
					array('ex_positions', array(0 => ''), false, request_interface::REQUEST, array()),
				),
				null,
			),
		);
	}

	/**
	 * Test set route preferences
	 * @dataProvider set_route_prefs_test_data
	 * @param array $variable_map
	 * @param array|null $expected
	 */
	public function test_set_route_prefs(array $variable_map, $expected)
	{
		$command = $this->get_command('set_route_prefs', $variable_map);

		$result = $command->execute(1);

		$this->assertEquals('ROUTE_UPDATED', $result['message']);

		$mapper = $this->mapper_factory->create('routes');
		$entity = $mapper->load(array(
			array('route', '=', $variable_map[0][4]),
			array('style', '=', 1),
		));

		if ($entity)
		{
			$this->assertSame($expected, array_intersect_key($entity->to_array(), $expected));
		}
		else
		{
			$this->assertNull($expected);
		}
	}
}
