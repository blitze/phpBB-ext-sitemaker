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

class add_block_test extends base_action
{
	/**
	 * Data set for add_block_test
	 * @return array
	 */
	public function add_block_test_data()
	{
		return array(
			array(
				'index.php',
				array(
					array('block', '', false, request_interface::REQUEST, 'my.foo.block'),
					array('position', '', false, request_interface::REQUEST, 'sidebar'),
					array('weight', 0, false, request_interface::REQUEST, 0),
				),
				array(),
				array(
					'id'		=> 10,
					'route_id'	=> 1,
					'style'		=> 1,
					'title'		=> 'I am foo block',
					'content'	=> 'foo block content',
					'class'		=> '',
					'settings'	=> array(),
					'view'		=> '',
				),
				array(
					'route_id'		=> 1,
					'route'			=> 'index.php',
					'has_blocks'	=> true,
					'style'			=> 1,
					'blocks'		=> array(
						10 => array(
							'name'		=> 'my.foo.block',
							'position'	=> 'sidebar',
							'style'		=> 1,
							'weight'	=> 0,
						),
						1 => array(
							'name'		=> 'my.baz.block',
							'position'	=> 'sidebar',
							'style'		=> 1,
							'weight'	=> 1,
						),
						4 => array(
							'name'		=> 'my.empty.block',
							'position'	=> 'top',
							'style'		=> 1,
							'weight'	=> 0,
						),
					),
				),
			),
			array(
				'viewforum.php?f=1',
				array(
					array('block', '', false, request_interface::REQUEST, 'my.baz.block'),
					array('position', '', false, request_interface::REQUEST, 'sidebar'),
					array('weight', 0, false, request_interface::REQUEST, 1),
				),
				array(
					'view' => 'simple',
				),
				array(
					'id'		=> 10,
					'route_id'	=> 6,
					'style'		=> 1,
					'title'		=> 'I am baz block',
					'content'	=> 'I love myself',
					'class'		=> '',
					'settings'	=> array(
						'my_setting'	=> 1,
						'other_setting'	=> 0,
					),
					'view'		=> 'simple'
				),
				array(
					'route_id'		=> 6,
					'route'			=> 'viewforum.php?f=1',
					'has_blocks'	=> true,
					'style'			=> 1,
					'blocks'		=> array(
						10 => array(
							'name'		=> 'my.baz.block',
							'position'	=> 'sidebar',
							'style'		=> 1,
							'weight'	=> 0,
						),
					),
				),
			),
			array(
				'app.php/foo/foo',
				array(
					array('block', '', false, request_interface::REQUEST, 'my.empty.block'),
					array('position', '', false, request_interface::REQUEST, 'sidebar'),
					array('weight', 0, false, request_interface::REQUEST, 0),
				),
				array(
					'view' => 'basic',
				),
				array(
					'id'		=> 10,
					'route_id'	=> 6,
					'style'		=> 1,
					'title'		=> 'I am an empty block',
					'content'	=> 'BLOCK_NO_DATA',
					'class'		=> ' sm-inactive',
					'settings'	=> array(),
					'view'		=> 'basic'
				),
				array(
					'route_id'		=> 6,
					'route'			=> 'app.php/foo/foo',
					'has_blocks'	=> true,
					'style'			=> 1,
					'blocks'		=> array(
						10 => array(
							'name'		=> 'my.empty.block',
							'position'	=> 'sidebar',
							'style'		=> 1,
							'weight'	=> 0,
						),
					),
				),
			),
			array(
				'search.php',
				array(
					array('block', '', false, request_interface::REQUEST, 'my.foo.block'),
					array('position', '', false, request_interface::REQUEST, 'top'),
					array('weight', 0, false, request_interface::REQUEST, 2),
				),
				array(
					'view' => 'basic',
				),
				array(
					'id'		=> 10,
					'route_id'	=> 4,
					'style'		=> 1,
					'title'		=> 'I am foo block',
					'content'	=> 'foo block content',
					'class'		=> '',
					'settings'	=> array(),
					'view'		=> 'basic'
				),
				array(
					'route_id'		=> 4,
					'route'			=> 'search.php',
					'has_blocks'	=> true,
					'style'			=> 1,
					'blocks'		=> array(
						10 => array(
							'name'		=> 'my.foo.block',
							'position'	=> 'top',
							'style'		=> 1,
							'weight'	=> 0,
						),
					),
				),
			),
			array(
				'index.php',
				array(
					array('block', '', false, request_interface::REQUEST, 'my.raz.block'),
					array('position', '', false, request_interface::REQUEST, 'sidebar'),
					array('weight', 0, false, request_interface::REQUEST, 1),
				),
				array(
					'view' => 'boxed',
				),
				array(
					'id'		=> 10,
					'route_id'	=> 1,
					'style'		=> 1,
					'title'		=> 'I am raz block',
					'content'	=> ['loop' => ['row1', 'row2']],
					'class'		=> '',
					'settings'	=> array('show' => true),
					'view'		=> 'boxed'
				),
				array(
					'route_id'		=> 1,
					'route'			=> 'index.php',
					'has_blocks'	=> true,
					'style'			=> 1,
					'blocks'		=> array(
						1 => array(
							'name'		=> 'my.baz.block',
							'position'	=> 'sidebar',
							'style'		=> 1,
							'weight'	=> 0,
						),
						10 => array(
							'name'		=> 'my.raz.block',
							'position'	=> 'sidebar',
							'style'		=> 1,
							'weight'	=> 1,
						),
						4 => array(
							'name'		=> 'my.empty.block',
							'position'	=> 'top',
							'style'		=> 1,
							'weight'	=> 0,
						),
					),
				),
			),
		);
	}

	/**
	 * Test add block
	 *
	 * @dataProvider add_block_test_data
	 * @param string $route
	 * @param array $variable_map
	 * @param array $config_text
	 * @param array $expected_return
	 * @param array $expected_route_info
	 */
	public function test_add_block($route, array $variable_map, array $config_text, array $expected_return, array $expected_route_info)
	{
		$variable_map[] = array('route', '', false, request_interface::REQUEST, $route);

		$command = $this->get_command('add_block', $variable_map);

		$style_id = 1;

		if (!empty($config_text))
		{
			$data[$style_id] = $config_text;
			$this->config_text->set('sm_layout_prefs', json_encode($data));
		}

		$result = $command->execute($style_id);

		$this->assertEquals($expected_return, array(
			'id'		=> $result['bid'],
			'route_id'	=> $result['route_id'],
			'style'		=> $result['style'],
			'title'		=> $result['title'],
			'content'	=> $result['content'],
			'class'		=> $result['class'],
			'settings'	=> $result['settings'],
			'view'		=> $result['view'],
		));

		$mapper = $this->mapper_factory->create('routes');

		$actual_route_info = [];
		if ($entity = $mapper->load(array('route', '=', $route)))
		{
			$actual_route_info = array(
				'route_id'		=> $entity->get_route_id(),
				'route'			=> $entity->get_route(),
				'has_blocks'	=> $entity->get_has_blocks(),
				'style'			=> $entity->get_style(),
				'blocks'		=> [],
			);

			$collection = $entity->get_blocks();
			foreach ($collection as $entity)
			{
				$actual_route_info['blocks'][$entity->get_bid()] = array(
					'name'		=> $entity->get_name(),
					'position'	=> $entity->get_position(),
					'style'		=> $entity->get_style(),
					'weight'	=> $entity->get_weight(),
				);
			}
		}

		$this->assertSame($expected_route_info, $actual_route_info);
	}

	/**
	 * Test adding non-exitent block
	 */
	public function test_add_invalid_block()
	{
		$variable_map = array(
			array('block', '', false, request_interface::REQUEST, 'my.invalid.block'),
			array('route', '', false, request_interface::REQUEST, 'index.php'),
			array('position', '', false, request_interface::REQUEST, 'sidebar'),
			array('weight', 0, false, request_interface::REQUEST, 0),
		);

		$command = $this->get_command('add_block', $variable_map);

		try
		{
			$this->assertNull($command->execute(1));
			$this->fail('no exception thrown');
		}
		catch (\blitze\sitemaker\exception\base $e)
		{
			$this->assertEquals('EXCEPTION_INVALID_ARGUMENT-my.invalid.block-SERVICE_NOT_FOUND', $e->get_message($this->translator));
		}
	}
}
