<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\model\menus\mapper;

class base_mapper extends \phpbb_database_test_case
{
	protected $config;

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
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/menu.xml');
	}

	public function setUp()
	{
		parent::setUp();

		global $config;

		$config = $this->config = new \phpbb\config\config(array(
			'force_server_vars' => false,
			'sitemaker.table_lock.menu_items_table' => 0
		));
	}

	/**
	 * Create the blocks mapper
	 */
	protected function get_mapper($type)
	{
		global $db, $request, $user;

		$table_prefix = 'phpbb_';
		$collection_class = '\\blitze\\sitemaker\\model\\menus\\collections\\' . $type;
		$mapper_class = '\\blitze\\sitemaker\\model\\menus\\mapper\\' . $type;
		$tables = array(
			'mapper_tables'	=> array(
				'menus'	=> $table_prefix . 'sm_menus',
				'items'	=> $table_prefix . 'sm_menu_items'
			)
		);

		$db = $this->new_dbal();

		$request = $this->getMock('\phpbb\request\request_interface');

		$user = $this->getMockBuilder('\phpbb\user')
			->disableOriginalConstructor()
			->getMock();
		$user->host = 'www.example.com';
		$user->page['root_script_path'] = '/phpBB/';

		$mapper_factory = new \blitze\sitemaker\model\mapper_factory($this->config, $db, $tables);
		$collection = new $collection_class;

		return new $mapper_class($db, $collection, $mapper_factory, $tables['mapper_tables'][$type], $this->config);
	}
}
