<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks\action;

require_once dirname(__FILE__) . '/../../fixtures/ext/foo/bar/blocks/foo_block.php';
require_once dirname(__FILE__) . '/../../fixtures/ext/foo/bar/blocks/baz_block.php';

class base_action extends \phpbb_database_test_case
{
	protected $config;
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
		return $this->createXMLDataSet(dirname(__FILE__) . '/../../fixtures/blocks.xml');
	}

	/**
	 * Create the block command
	 */
	protected function get_command($action, $variable_map)
	{
		global $db, $request, $template, $phpbb_dispatcher, $phpbb_root_path, $phpEx;

		$table_prefix = 'phpbb_';
		$tables = array(
			'mapper_tables'	=> array(
				'blocks'	=> $table_prefix . 'sm_blocks',
				'routes'	=> $table_prefix . 'sm_block_routes'
			)
		);

		$db = $this->new_dbal();

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$this->config = new \phpbb\config\config(array());

		$request = $this->getMock('\phpbb\request\request_interface');
		$request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap($variable_map));

		$translator = $this->getMock('\phpbb\language\language');
		$translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode('-', func_get_args());
			});

		$blocks_service = $this->getMockBuilder('\blitze\sitemaker\services\blocks\blocks')
			->disableOriginalConstructor()
			->setMethods(null)
			->getMock();

		$ptemplate = $this->getMockBuilder('\blitze\sitemaker\services\template')
			->disableOriginalConstructor()
			->getMock();

		$tpl_data = array();
		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$this->tpl_data =& $tpl_data;
		$template->expects($this->any())
			->method('assign_vars')
			->will($this->returnCallback(function($data) use (&$tpl_data) {
				$tpl_data = array_merge($tpl_data, $data);
			}));

		$template->expects($this->any())
			->method('assign_block_vars')
			->will($this->returnCallback(function($key, $data) use (&$tpl_data) {
				$tpl_data[$key][] = $data;
			}));

		$template->expects($this->any())
			->method('assign_display')
			->will($this->returnCallback(function() use (&$tpl_data) {
				return $tpl_data;
			}));

		$dummy_object = $this->getMockBuilder('\stdClass')
			->setMethods(array('display'))
			->getMock();

		$dummy_object->expects($this->any())
			->method('display')
			->will($this->returnCallback(function($id) {
				return array(
					'title'		=> 'Custom Block',
					'content'	=> 'Custom content id: ' . $id,
				);
			}));

		$groups = $this->getMockBuilder('\blitze\sitemaker\services\groups')
			->disableOriginalConstructor()
			->getMock();

		$cfg_handler = new \blitze\sitemaker\services\blocks\cfg_handler($request, $template, $translator, $groups, $phpbb_root_path, $phpEx);

		$phpbb_container = new \phpbb_mock_container_builder();

		$blocks_collection = new \phpbb\di\service_collection($phpbb_container);

		$blocks_collection->add('my.foo.block');
		$blocks_collection->add('my.baz.block');

		$phpbb_container->set('my.foo.block', new \foo\bar\blocks\foo_block);
		$phpbb_container->set('my.baz.block', new \foo\bar\blocks\baz_block);
		$phpbb_container->set('custom.block.service', $dummy_object);
		$phpbb_container->set('blitze.sitemaker.blocks.cfg_handler', $cfg_handler);

		$block_factory = new \blitze\sitemaker\services\blocks\factory($translator, $ptemplate, $blocks_collection);

		$this->mapper_factory = new \blitze\sitemaker\model\mapper_factory($this->config, $db, $tables);

		$action_class = '\\blitze\\sitemaker\\services\\blocks\\action\\' . $action;

        return new $action_class($this->config, $phpbb_container, $request, $translator, $blocks_service, $block_factory, $this->mapper_factory);
	}
}
