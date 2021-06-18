<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\model;

use blitze\sitemaker\model\mapper_factory;

class mapper_factory_test extends \phpbb_test_case
{
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
	 * Data set for test_create_mapper
	 *
	 * @return array
	 */
	public function create_mapper_test_data()
	{
		return array(
			array('blocks', '\blitze\sitemaker\model\mapper\blocks'),
			array('routes', '\blitze\sitemaker\model\mapper\routes'),
			array('menus', '\blitze\sitemaker\model\mapper\menus'),
			array('items', '\blitze\sitemaker\model\mapper\items'),
		);
	}

	/**
	 * Test mapper factory
	 *
	 * @dataProvider create_mapper_test_data
	 * @param string $type
	 * @param string $expected_class
	 */
	public function test_create_mapper($type, $expected_class)
	{
		$table_prefix = 'phpbb_';
		$tables = array(
			'mapper_tables'	=> array(
				'blocks'	=> $table_prefix . 'sm_blocks',
				'routes'	=> $table_prefix . 'sm_block_routes',
				'menus'		=> $table_prefix . 'sm_menus',
				'items'		=> $table_prefix . 'sm_menu_items'
			)
		);

		$db = $this->getMockBuilder('\phpbb\db\driver\driver_interface')
			->disableOriginalConstructor()
			->getMock();

		$config = new \phpbb\config\config(array());

		$mapper_factory = new mapper_factory($config, $db, $tables);

		$this->assertInstanceOf($expected_class, $mapper_factory->create( $type));
	}
}
