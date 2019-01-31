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

class update_column_width_test extends base_action
{
	public function column_width_test_data()
	{
		return array(
			array(
				1,
				array(),
				array(),
				array(),
			),
			array(
				1,
				array(),
				array(
					array('position', '', false, request_interface::REQUEST, 'sidebar'),
					array('width', '', false, request_interface::REQUEST, '200px'),
				),
				array(
					1 => array('sidebar' => '200px'),
				),
			),
			array(
				1,
				array(
					1 => array('sidebar' => '200px'),
				),
				array(
					array('position', '', false, request_interface::REQUEST, 'sidebar'),
					array('width', '', false, request_interface::REQUEST, '300px'),
				),
				array(
					1	=> array('sidebar' => '300px'),
				),
			),
			array(
				1,
				array(
					1 => array('sidebar' => '200px'),
					2 => array('subcontent' => '20%'),
				),
				array(
					array('position', '', false, request_interface::REQUEST, 'subcontent'),
					array('width', '', false, request_interface::REQUEST, '300px'),
				),
				array(
					1 => array(
						'sidebar' => '200px',
						'subcontent' => '300px',
					),
					2 => array('subcontent' => '20%'),
				),
			),
			array(
				2,
				array(
					1 => array('sidebar' => '200px'),
				),
				array(
					array('position', '', false, request_interface::REQUEST, 'subcontent'),
					array('width', '', false, request_interface::REQUEST, '300px'),
				),
				array(
					1 => array('sidebar' => '200px'),
					2 => array('subcontent' => '300px'),
				),
			),
			array(
				2,
				array(
					1 => array('sidebar' => '200px'),
					2 => array('subcontent' => '300px'),
				),
				array(
					array('position', '', false, request_interface::REQUEST, 'subcontent'),
					array('width', '', false, request_interface::REQUEST, ''),
				),
				array(
					1 => array('sidebar' => '200px'),
				),
			),
			array(
				1,
				array(
					1 => array(
						'sidebar' => '200px',
						'subcontent' => '300px',
					),
					2 => array('subcontent' => '20%'),
				),
				array(
					array('position', '', false, request_interface::REQUEST, 'subcontent'),
					array('width', '', false, request_interface::REQUEST, ''),
				),
				array(
					1 => array('sidebar' => '200px'),
					2 => array('subcontent' => '20%'),
				),
			),
		);
	}

	/**
	 * Test setting column width
	 *
	 * @dataProvider column_width_test_data
	 * @param int $style_id
	 * @param array $config_vars
	 * @param array $variable_map
	 * @param array $expected
	 */
	public function test_column_width($style_id, array $config_vars, array $variable_map, array $expected)
	{
		$command = $this->get_command('update_column_width', $variable_map);
		$this->config->set('sitemaker_column_widths', json_encode($config_vars));

		$command->execute($style_id);

		$this->assertSame($expected, json_decode($this->config['sitemaker_column_widths'], true));
	}
}
