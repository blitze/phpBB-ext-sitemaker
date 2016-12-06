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

class copy_route_test extends base_action
{
	/**
	 * Data set for copy_route_test
	 * @return array
	 */
	public function copy_route_test_data()
	{
		return array(
			// copying from existing route to existing route (extension route) with same style_id
			array(
				'app.php/foo/test/',
				'foo/bar',
				'index.php',
				1,
				array(
					'ext_name'		=> 'foo/bar',
					'hide_blocks'	=> false,
					'has_blocks'	=> true,
					'ex_positions'	=> array('bottom'),
				),
				array(
					'sidebar' => array(
						array(
							'name'		=> 'my.baz.block',
							'title'		=> 'I am baz block',
							'position'	=> 'sidebar',
							'style'		=> 1,
							'settings'	=> array(
								'my_setting'	=> 1,
								'other_setting'	=> 0,
							),
							'id'		=> 8,
							'content'	=> 'I love myself',
						),
					),
					'top' => array(
						array(
							'name' => 'my.empty.block',
							'title' => 'I am an empty block',
							'position' => 'top',
							'style' => 1,
							'settings' => array(),
							'id' => 9,
							'content' => 'BLOCK_NO_DATA',
						),
					),
				),
			),
			// copying from existing route with different style_id to existing route
			array(
				'index.php',
				'',
				'faq.php',
				2,
				array(
					'ext_name'		=> '',
					'hide_blocks'	=> false,
					'has_blocks'	=> true,
					'ex_positions'	=> array(),
				),
				array(
					'bottom' => array(
						array(
							'name'		=> 'my.foo.block',
							'title'		=> 'I am foo block',
							'position'	=> 'bottom',
							'style'		=> 1,
							'settings'	=> array(),
							'id'		=> 8,
							'content'	=> 'foo block content',
						),
					),
					'sidebar' => array(
						array(
							'name'		=> 'my.baz.block',
							'title'		=> 'I am baz block',
							'position'	=> 'sidebar',
							'style'		=> 1,
							'settings'	=> array(
								'my_setting'	=> 1,
								'other_setting'	=> 0,
							),
							'id'		=> 9,
							'content'	=> 'I love myself',
						),
					),
				),
			),
			// copying from existing route to new route (not already in db)
			array(
				'viewforum.php?f=2',
				'',
				'faq.php',
				2,
				array(
					'ext_name'		=> '',
					'hide_blocks'	=> false,
					'has_blocks'	=> true,
					'ex_positions'	=> array(),
				),
				array(
					'bottom' => array(
						array(
							'name'		=> 'my.foo.block',
							'title'		=> 'I am foo block',
							'position'	=> 'bottom',
							'style'		=> 1,
							'settings'	=> array(),
							'id'		=> 8,
							'content'	=> 'foo block content',
						),
					),
					'sidebar' => array(
						array(
							'name'		=> 'my.baz.block',
							'title'		=> 'I am baz block',
							'position'	=> 'sidebar',
							'style'		=> 1,
							'settings'	=> array(
								'my_setting'	=> 1,
								'other_setting'	=> 0,
							),
							'id'		=> 9,
							'content'	=> 'I love myself',
						),
					),
				),
			),
			// copying from existing route (extension route) to existing route with same style_id
			array(
				'index.php',
				'',
				'app.php/foo/test/',
				1,
				array(
					'ext_name'		=> '',
					'hide_blocks'	=> false,
					'has_blocks'	=> true,
					'ex_positions'	=> array(),
				),
				array(
					'sidebar' => array(
						array(
							'name'		=> 'my.baz.block',
							'title'		=> 'I am baz block',
							'position'	=> 'sidebar',
							'style'		=> 1,
							'settings'	=> array(
								'my_setting'	=> 1,
								'other_setting'	=> 0,
							),
							'id'		=> 8,
							'content'	=> 'I love myself',
						),
					),
					'subcontent' => array(
						array(
							'name'		=> 'my.foo.block',
							'title'		=> 'I am foo block',
							'position'	=> 'subcontent',
							'style'		=> 1,
							'settings'	=> array(),
							'id'		=> 9,
							'content'	=> 'foo block content',
						),
					),
				),
			),
			// copying from existing route, wrong style_id, to existing route
			array(
				'app.php/foo/test/',
				'foo/bar',
				'faq.php',
				1,
				array(),
				array(),
			),
		);
	}

	/**
	 * Test copy_route
	 *
	 * @dataProvider copy_route_test_data
	 * @param string $current_route
	 * @param string $ext_name
	 * @param string $from_route
	 * @param int $from_style
	 * @param array $expected_route_data
	 * @param array $expected_return_data
	 */
	public function test_copy_route($current_route, $ext_name, $from_route, $from_style, array $expected_route_data, array $expected_return_data)
	{
		$style_id = 1;
		$variable_map = array(
			array('ext', '', false, request_interface::REQUEST, $ext_name),
			array('route', '', false, request_interface::REQUEST, $current_route),
			array('from_route', '', false, request_interface::REQUEST, $from_route),
			array('from_style', $style_id, false, request_interface::REQUEST, $from_style),
		);

		$command = $this->get_command('copy_route', $variable_map);

		$block_mapper = $this->mapper_factory->create('blocks', 'routes');

		$orig_route = $block_mapper->load(array('route', '=', $current_route));

		$result = $command->execute($style_id);

		$new_route = $block_mapper->load(array('route', '=', $current_route));
		$new_block = $new_route->get_blocks()->current();

		if ($orig_route)
		{
			$orig_block = $orig_route->get_blocks()->current();

			// confirm new blocks have same style_id and the blocks now have the new route id
			$this->assertEquals($orig_block->get_style(), $new_block->get_style());
			$this->assertEquals($new_block->get_route_id(), $new_route->get_route_id());

			// confirm new route data has the same route and same style as before copy
			$this->assertEquals($orig_route->get_route(), $new_route->get_route());
			$this->assertEquals($orig_route->get_style(), $new_route->get_style());
		}

		$comp_keys = array_fill_keys(array('id', 'style', 'title', 'content', 'name', 'position', 'settings'), '');

		$actual = array();
		foreach ($result['list'] as $position => $blocks)
		{
			$actual[$position] = array();
			foreach ($blocks as $block)
			{
				$actual[$position][] = array_intersect_key($block, $comp_keys);
			}
		}

		// returned data
		$this->assertEquals($expected_route_data, array_intersect_key($expected_route_data, $result['config']));
		$this->assertEquals($expected_return_data, $actual);
	}

	public function test_copy_route_with_custom_block()
	{
		$style_id = 1;
		$variable_map = array(
			array('route', '', false, request_interface::REQUEST, 'bar.php'),
			array('from_route', '', false, request_interface::REQUEST, 'foo.php'),
			array('from_style', $style_id, false, request_interface::REQUEST, $style_id),
		);

		$command = $this->get_command('copy_route', $variable_map);

		$result = $command->execute($style_id);

		$expected = array(
			array(
				'block_id' => 7,
				'block_content' => 'some content',
			),
			array(
				'block_id' => 8,
				'block_content' => 'some content',
			),
		);

		$result = $this->db->sql_query('SELECT block_id, block_content FROM phpbb_sm_cblocks');

		$actual = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$actual[] = $row;
		}
		$this->db->sql_freeresult();

		$this->assertEquals($expected, $actual);
	}
}
