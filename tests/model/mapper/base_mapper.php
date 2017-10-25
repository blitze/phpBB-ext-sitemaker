<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\model\mapper;

use Symfony\Component\HttpFoundation\Request;

abstract class base_mapper extends \phpbb_database_test_case
{
	protected $config;
	protected $translator;

	/**
	 * Define the extension to be tested.
	 *
	 * @return string[]
	 */
	protected static function setup_extensions()
	{
		return array('blitze/sitemaker');
	}

	public function setUp()
	{
		global $db, $config, $request, $symfony_request, $user;

		parent::setUp();

		$symfony_request = new Request();

		$config = $this->config = new \phpbb\config\config(array(
			'force_server_vars' => false,
			'sitemaker.table_lock.menu_items_table' => 0
		));

		$request = $this->getMock('\phpbb\request\request_interface');

		$user = $this->getMockBuilder('\phpbb\user')
			->disableOriginalConstructor()
			->getMock();
		$user->host = 'www.example.com';
		$user->page['root_script_path'] = '/phpBB/';
	}

	/**
	 * Create the mapper service
	 *
	 * @param string $type
	 * @return mixed
	 */
	protected function get_mapper($type)
	{
		global $db;

		$this->translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$this->translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode('-', func_get_args());
			});

		$table_prefix = 'phpbb_';
		$collection_class = '\\blitze\\sitemaker\\model\\collections\\' . $type;
		$mapper_class = '\\blitze\\sitemaker\\model\\mapper\\' . $type;
		$tables = array(
			'mapper_tables'	=> array(
				'blocks'	=> $table_prefix . 'sm_blocks',
				'routes'	=> $table_prefix . 'sm_block_routes',
				'menus'		=> $table_prefix . 'sm_menus',
				'items'		=> $table_prefix . 'sm_menu_items',
			)
		);

		$db = $this->new_dbal();

		$mapper_factory = new \blitze\sitemaker\model\mapper_factory($this->config, $db, $tables);
		$collection = new $collection_class;

		return new $mapper_class($db, $collection, $mapper_factory, $tables['mapper_tables'][$type], $this->config);
	}
}
