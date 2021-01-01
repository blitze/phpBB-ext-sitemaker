<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2020 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services;

use phpbb\request\request_interface;

class navbar_test extends \phpbb_database_test_case
{
	protected $template;

	/**
	 * Define the extension to be tested.
	 *
	 * @return string[]
	 */
	protected static function setup_extensions()
	{
		return array('blitze/sitemaker');
	}

	/**
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/navbar.xml');
	}

	/**
	 * Create the navbar service
	 *
	 * @param array $config_data
	 * @param mixed $config_text_data
	 * @param array $variable_map
	 * @return \blitze\sitemaker\services\navbar
	 */
	protected function get_service(array $config_data = [], array $variable_map = [])
	{
		global $db, $request, $phpbb_dispatcher;

		$db = $this->new_dbal();

		$this->config = new \phpbb\config\config($config_data);

		$this->config_text = new \phpbb\config\db_text($db, 'phpbb_config_text');

		// $config_text->set('sm_layout_prefs', json_encode(array(
		// 	1 => $config_text_data
		// )));

		$request = $this->getMockBuilder('\phpbb\request\request_interface')
			->disableOriginalConstructor()
			->getMock();
		$request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap($variable_map));

		$this->db = $db = $this->new_dbal();
		$this->config_text = new \phpbb\config\db_text($this->db, 'phpbb_config_text');

		return new \blitze\sitemaker\services\navbar($this->config, $this->config_text, $db, $request);
	}

	/**
	 * Data set for test_get_settings
	 *
	 * @return array
	 */
	public function get_settings_test_data()
	{
		return array(
			array(
				'prosilver',
				array(
					'sm_navbar_menu'		=> 0,
					'sm_navbar_locations'	=> '',
					'sm_last_modified'		=> 0,
				),
				array(
					'menu_id'	=> 0,
					'location'	=> '',
					'last_modified'	=> 0
				),
			),
			array(
				'prosilver',
				array(
					'sm_navbar_menu'		=> 0,
					'sm_navbar_locations'	=> json_encode(['prosilver' => 'location1']),
					'sm_last_modified'		=> strtotime('12/31/2020'),
				),
				array(
					'menu_id'	=> 0,
					'location'	=> '',
					'last_modified'	=> 0
				),
			),
			array(
				'silverlight',
				array(
					'sm_navbar_menu'		=> 1,
					'sm_navbar_locations'	=> json_encode(['prosilver' => 'location1']),
					'sm_last_modified'		=> strtotime('31/12/2020'),
				),
				array(
					'menu_id'	=> 1,
					'location'	=> null,
					'last_modified'	=> strtotime('31/12/2020')
				),
			),
			array(
				'silverlight',
				array(
					'sm_navbar_menu'		=> 1,
					'sm_navbar_locations'	=> json_encode(['prosilver' => 'location1', 'silverlight' => 'location2']),
					'sm_last_modified'		=> strtotime('31/12/2020'),
				),
				array(
					'menu_id'	=> 1,
					'location'	=> 'location2',
					'last_modified'	=> strtotime('31/12/2020')
				),
			),
		);
	}

	/**
	 * Test the get_settings method
	 *
	 * @dataProvider get_settings_test_data
	 * @param string $style
	 * @param array $config_data
	 * @param array $expected_vars
	 */
	public function test_get_settings($style, array $config_data, array $expected)
	{
		$navbar = $this->get_service($config_data);

		$this->assertEquals($expected, $navbar->get_settings($style));
	}

	/**
	 * @return array
	 */
	public function get_css_test_data()
	{
		return array(
			array(
				'xmas',
				"@import url('http://ext/blitze/sitemaker/styles/all/theme/assets/navbar.min.css');",
			),
			array(
				'silverlight',
				"@import url('http://ext/blitze/sitemaker/styles/all/theme/assets/navbar.min.css');.sm-menu{background-color: #123456;}",
			),
			array(
				'prosilver',
				"@import url('http://ext/blitze/sitemaker/styles/all/theme/assets/navbar.min.css');.sm-menu{font-size:11px;}",
			),
		);
	}

	/**
	 * @dataProvider get_css_test_data
	 * @param string $style
	 * @param string $expected
	 */
	public function test_get_css($style, $expected)
	{
		$navbar = $this->get_service();

		$this->assertEquals($expected, $navbar->get_css($style));
	}

	/**
	 * @return array
	 */
	public function save_test_data()
	{
		return array(
			array(
				'prosilver',
				array(
					array('css', '', false, request_interface::REQUEST, '.sm-menu{color: #123;}'),
					array('location', '', false, request_interface::REQUEST, 'location2'),
				),
				array(
					'sm_navbar_css'			=> '.sm-menu{color: #123;}',
					'sm_navbar_locations'	=> array(
						'prosilver'		=> 'location2',
						'silverlight'	=> 'location2',
					),
					'sm_navbar_last_modified' => '12/31/2020',
				),
			),
			array(
				'prosilver',
				array(
					array('css', '', false, request_interface::REQUEST, ''),
					array('location', '', false, request_interface::REQUEST, ''),
				),
				array(
					'sm_navbar_css'			=> '',
					'sm_navbar_locations'	=> array(
						'silverlight'	=> 'location2',
					),
					'sm_navbar_last_modified' => '12/31/2020',
				),
			),
			array(
				'silverlight',
				array(
					array('css', '', false, request_interface::REQUEST, '.sm-menu{background-color: #123;}'),
					array('location', '', false, request_interface::REQUEST, ''),
				),
				array(
					'sm_navbar_css'			=> '.sm-menu{background-color: #123;}',
					'sm_navbar_locations'	=> array(
						'prosilver'		=> 'location1',
					),
					'sm_navbar_last_modified' => '12/31/2020',
				),
			),
		);
	}

	/**
	 * @dataProvider save_test_data
	 * @param string $style
	 * @param array $variable_map
	 * @param array $expected
	 */
	public function test_save($style, array $variable_map, array $expected)
	{
		$config_data = array(
			'sm_navbar_last_modified'	=> 0,
			'sm_navbar_locations'		=> json_encode(array(
				'prosilver'		=> 'location1',
				'silverlight'	=> 'location2',
			)),
		);

		$navbar = $this->get_service($config_data, $variable_map);
		$navbar->save($style, '12/31/2020');

		$this->assertEquals($expected, array(
			'sm_navbar_css' => $this->config_text->get('sm_navbar_' . $style),
			'sm_navbar_locations' => json_decode($this->config['sm_navbar_locations'], true),
			'sm_navbar_last_modified' => date("m/d/Y", $this->config['sm_navbar_last_modified'])
		));
	}

	/**
	 * @return array
	 */
	public function cleanup_test_data()
	{
		return array(
			array(
				false,
				[2 => 'silverlight'],
				array(
					'sm_navbar_locations' => array(
						'prosilver'	=> 'location1',
						'beans'		=> 'location3',
					)
				),
			),
			array(
				false,
				[2 => 'silverlight', 4 => 'beans'],
				array(
					'sm_navbar_locations' => array(
						'prosilver'	=> 'location1',
					),
				),
			),
			array(
				false,
				[],
				array(
					'sm_navbar_locations' => array(
						'prosilver'		=> 'location1',
						'silverlight'	=> 'location2',
						'beans'			=> 'location3',
					),
				),
			),
			array(
				true,
				[],
				array(
					'sm_navbar_locations' => [],
				),
			),
		);
	}

	/**
	 * @dataProvider cleanup_test_data
	 * @param bool $all,
	 * @param array $styles
	 * @param array $expected
	 */
	public function test_cleanup($all, array $styles, array $expected)
	{
		$config_data = array(
			'sm_navbar_last_modified'	=> 0,
			'sm_navbar_locations'		=> json_encode(array(
				'prosilver'		=> 'location1',
				'silverlight'	=> 'location2',
				'beans'			=> 'location3',
			)),
		);

		$variable_map = array(
			array('ids', [0], false, request_interface::REQUEST, array_keys($styles)),
		);

		$navbar = $this->get_service($config_data, $variable_map);
		$navbar->cleanup($all);

		$this->assertEquals($expected, array(
			'sm_navbar_locations'	=> json_decode($this->config['sm_navbar_locations'], true),
		));

		if ($all)
		{
			$styles = ['prosilver', 'silverlight', 'coffee', 'beans'];
		}

		foreach ($styles as $style)
		{
			$this->assertNull($this->config_text->get('sm_navbar_' . $style));
		}
	}
}
