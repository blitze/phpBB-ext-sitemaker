<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\menus\action;

require_once dirname(__FILE__) . '/../../../../../../../includes/functions.php';

class base_action extends \phpbb_database_test_case
{
	protected $mapper_factory;

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
		return $this->createXMLDataSet(dirname(__FILE__) . '/../../fixtures/menu.xml');
	}

	/**
	 * Create the menu command
	 */
	protected function get_command($action, $variable_map)
	{
		global $config, $db, $request, $phpbb_dispatcher;

		$table_prefix = 'phpbb_';
		$tables = array(
			'mapper_tables'	=> array(
				'menus'	=> $table_prefix . 'sm_menus',
				'items'	=> $table_prefix . 'sm_menu_items'
			)
		);

		$db = $this->new_dbal();

		$config = $config = new \phpbb\config\config(array());
		set_config(null, null, null, $config);  // remove in 3.2

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$request = $this->getMock('\phpbb\request\request_interface');
		$request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap($variable_map));

		$user = $this->getMock('\phpbb\user', array(), array('\phpbb\datetime'));
		$user->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode('-', func_get_args());
			});

		$this->mapper_factory = new \blitze\sitemaker\model\mapper_factory($config, $db, $tables);

		$action_class = '\\blitze\\sitemaker\\services\\menus\\action\\' . $action;

        return new $action_class($request, $user, $this->mapper_factory);
	}

	protected function get_matching_fields($items, $allowed_fields)
	{
		$data = array();
		foreach ($items as $item)
		{
			$data[] = array_intersect_key($item, $allowed_fields);
		}

		return $data;
	}

	protected function assert_exception_called($command, $expected)
	{
		try
		{
			$this->assertNull($command->execute());
			$this->fail('no exception thrown');
		}
		catch (\Exception $e)
		{
			$this->assertEquals($expected, $e->getMessage());
		}
	}
}
