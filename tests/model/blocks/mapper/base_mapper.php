<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\model\blocks\mapper;

class base_mapper extends \phpbb_database_test_case
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
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/blocks.xml');
	}

	/**
	 * Create the blocks mapper
	 *
	 * @param string $mapper
	 * @return mixed
	 */
	protected function get_mapper($mapper)
	{
		global $db;

		$table_prefix = 'phpbb_';
		$collection_class = '\\blitze\\sitemaker\\model\\blocks\\collections\\' . $mapper;
		$mapper_class = '\\blitze\\sitemaker\\model\\blocks\\mapper\\' . $mapper;
		$tables = array(
			'mapper_tables'	=> array(
				'blocks'	=> $table_prefix . 'sm_blocks',
				'routes'	=> $table_prefix . 'sm_block_routes'
			)
		);

		$db = $this->new_dbal();

		$config = new \phpbb\config\config(array());
		$mapper_factory = new \blitze\sitemaker\model\mapper_factory($config, $db, $tables);
		$collection = new $collection_class;

		return new $mapper_class($db, $collection, $mapper_factory, $tables['mapper_tables'][$mapper]);
	}
}
