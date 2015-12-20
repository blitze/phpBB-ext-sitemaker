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

class save_blocks_test extends base_action
{
	/**
	 * Data set for test_edit_block
	 * @return array
	 */
	public function save_blocks_test_data()
	{
		return array(
			// saving layout after deleting all blocks
			array(
				array(
					array('route', '', false, request_interface::REQUEST, 'faq.php'),
					array('blocks', array(0 => array('' => '')), false, request_interface::REQUEST, array()),
				),
				2,
				null,
				null,
			),
			// saving layout with atleast one block
			array(
				array(
					array('route', '', false, request_interface::REQUEST, 'faq.php'),
					array('blocks', array(0 => array('' => '')), false, request_interface::REQUEST, array(
						6 => array(
							'position'	=> 'top_hor',
							'weight'	=> 0,
						),
					)),
				),
				2,
				array(
					'route_id'		=> 3,
					'style'			=> 2,
					'has_blocks'	=> true,
				),
				array(
					array(
						'bid'		=> 6,
						'position'	=> 'top_hor',
						'weight'	=> 0,
						'style'		=> 2
					),
				),
			),
			// saving layout after rearranging blocks
			array(
				array(
					array('route', '', false, request_interface::REQUEST, 'faq.php'),
					array('blocks', array(0 => array('' => '')), false, request_interface::REQUEST, array(
						3 => array(
							'position'	=> 'sidebar',
							'weight'	=> 1,
						),
						6 => array(
							'position'	=> 'sidebar',
							'weight'	=> 0,
						),
					)),
				),
				2,
				array(
					'route_id'		=> 3,
					'style'			=> 2,
					'has_blocks'	=> true,
				),
				array(
					array(
						'bid'		=> 6,
						'position'	=> 'sidebar',
						'weight'	=> 0,
						'style'		=> 2
					),
					array(
						'bid'		=> 3,
						'position'	=> 'sidebar',
						'weight'	=> 1,
						'style'		=> 2
					),
				),
			),
			// saving layout with atleast one block, but route has no blocks in db
			array(
				array(
					array('route', '', false, request_interface::REQUEST, 'search.php'),
					array('blocks', array(0 => array('' => '')), false, request_interface::REQUEST, array(
						6 => array(
							'position'	=> 'top_hor',
							'weight'	=> 0,
						),
					)),
				),
				1,
				array(
					'route_id'		=> 4,
					'style'			=> 1,
					'has_blocks'	=> false,
				),
				array(),
			),
		);
	}

	/**
	 * Test save blocks
	 *
	 * @dataProvider save_blocks_test_data
	 */
	public function test_save_blocks($variable_map, $style_id, $expected_route, $expected_block)
	{
		$route = $variable_map[0][4];
		$command = $this->get_command('save_blocks', $variable_map);

		$result = $command->execute($style_id);

		$this->assertEquals('LAYOUT_SAVED', $result['message']);

		$mapper = $this->mapper_factory->create('blocks', 'routes');
		$entity = $mapper->load(array('route' => $route));

		if ($entity)
		{
			$route_data = $entity->to_array();
			$blocks = $route_data['blocks'];

			$comp_keys = array_fill_keys(array('bid', 'style', 'position', 'weight'), '');

			$actual_blocks = array();
			foreach ($blocks as $entity)
			{
				$actual_blocks[] = array_intersect_key($entity->to_array(), $comp_keys);
			}

			$this->assertSame($expected_block, $actual_blocks);
			$this->assertSame($expected_route, array_intersect_key($route_data, $expected_route));
		}
		else
		{
			$this->assertNull($expected_route);
			$this->assertNull($expected_block);
		}
	}
}
