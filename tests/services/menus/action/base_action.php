<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\menus\action;

class base_action extends \phpbb_database_test_case
{
	protected $translator;
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
	 *
	 * @param string $action
	 * @param array $variable_map
	 * @return mixed
	 */
	protected function get_command($action, array $variable_map)
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

		$config = new \phpbb\config\config(array());

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$request = $this->createMock('\phpbb\request\request_interface');
		$request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap($variable_map));

		$this->translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$this->translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode('-', func_get_args());
			});

		$this->mapper_factory = new \blitze\sitemaker\model\mapper_factory($config, $db, $tables);

		$action_class = '\\blitze\\sitemaker\\services\\menus\\action\\' . $action;

        return new $action_class($request, $this->translator, $this->mapper_factory);
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
		catch (\blitze\sitemaker\exception\base $e)
		{
			$this->assertEquals($expected, $e->get_message($this->translator));
		}
		catch (\Exception $e)
		{
			$this->assertEquals($expected, $e->getMessage());
		}
	}
}
