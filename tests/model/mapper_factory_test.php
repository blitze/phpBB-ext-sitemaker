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
			array('blocks', 'blocks', '\blitze\sitemaker\model\blocks\mapper\blocks'),
			array('blocks', 'routes', '\blitze\sitemaker\model\blocks\mapper\routes'),
			array('menus', 'menus', '\blitze\sitemaker\model\menus\mapper\menus'),
			array('menus', 'items', '\blitze\sitemaker\model\menus\mapper\items'),
		);
	}

	/**
	 * Test mapper factory
	 *
	 * @dataProvider create_mapper_test_data
	 * @param string $mapper
	 * @param string $type
	 * @param string $expected_class
	 */
	public function test_create_mapper($mapper, $type, $expected_class)
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

		$db = $this->getMock('\phpbb\db\driver\driver_interface');
		$config = new \phpbb\config\config(array());

		$mapper_factory = new mapper_factory($config, $db, $tables);

		$this->assertInstanceOf($expected_class, $mapper_factory->create($mapper, $type));
	}
}
