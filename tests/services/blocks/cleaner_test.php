<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks;

use Symfony\Component\HttpFoundation\Request;

class cleaner_test extends \phpbb_database_test_case
{
	protected $block_mapper;
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
		return $this->createXMLDataSet(dirname(__FILE__) . '/../fixtures/cleaner.xml');
	}

	/**
	 * Create Block Cleaner service
	 *
	 * @return \blitze\sitemaker\services\blocks\cleaner
	 */
	protected function get_service()
	{
		global $config, $db, $phpbb_dispatcher, $request, $symfony_request, $user;

		$blocks_table = 'phpbb_sm_blocks';
		$block_routes_table = 'phpbb_sm_block_routes';
		$custom_blocks_table = 'phpbb_sm_cblocks';

		$cache = new \phpbb_mock_cache();
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
		$symfony_request = new Request();

		$db = $this->new_dbal();
		$this->db = &$db;

		$request = $this->getMockBuilder('\phpbb\request\request_interface')
			->disableOriginalConstructor()
			->getMock();

		$this->config = $config = new \phpbb\config\config(array(
			'force_server_vars'			=> false,
			'sitemaker_column_widths'	=> json_encode(array(
				1	=> array(
					'sidebar'		=> '200px',
					'subcontent'	=> '20%',
				),
				2	=> array(
					'sidebar'		=> '300px',
				),
			)),
		));

		$blocks_factory = $this->getMockBuilder('\blitze\sitemaker\services\blocks\factory')
			->disableOriginalConstructor()
			->getMock();

		$blocks_factory->expects($this->any())
			->method('get_block')
			->will($this->returnCallback(function ($service_name)
			{
				return ($service_name === 'blitze.sitemaker.blocks.stats') ? true : false;
			}));

		$tables = array(
			'mapper_tables'	=> array(
				'blocks'	=> $blocks_table,
				'routes'	=> $block_routes_table
			)
		);

		$mapper_factory = new \blitze\sitemaker\model\mapper_factory($this->config, $db, $tables);

		$this->block_mapper = $mapper_factory->create('blocks');

		$log = $this->getMockBuilder('\phpbb\log\log')
			->disableOriginalConstructor()
			->getMock();

		$user = $this->getMockBuilder('\phpbb\user')
			->disableOriginalConstructor()
			->getMock();
		$user->host = 'www.example.com';
		$user->data['user_id'] = 2;
		$user->page['root_script_path'] = '/phpBB/';

		$blocks_manager = new \blitze\sitemaker\services\blocks\manager($cache, $log, $user, $blocks_factory, $mapper_factory);

		$url_checker = $this->getMockBuilder('\blitze\sitemaker\services\url_checker')
			->getMock();

		$url_checker->expects($this->any())
			->method('exists')
			->will($this->returnCallback(function ($url)
			{
				$valid_urls = [
					'http://www.example.com/phpBB/index.php',
					'http://www.example.com/phpBB/faq.php',
					'http://www.example.com/phpBB/app.php/foo/test',
				];
				return in_array($url, $valid_urls) ? true : false;
			}));

		return new \blitze\sitemaker\services\blocks\cleaner($this->config, $db, $blocks_manager, $url_checker, $blocks_table, $custom_blocks_table);
	}

	/**
	 * Test the test method
	 */
	public function test_test()
	{
		$cleaner = $this->get_service();

		$this->assertEquals(2, $this->get_custom_blocks_count());
		$this->assertEquals('', $cleaner->get_orphans());

		$cleaner->test();

		// test run handles orphaned custom blocks data
		$this->assertEquals(1, $this->get_custom_blocks_count());

		$this->assertEquals([
			'styles' => [2],
			'routes' => [
				'http://www.example.com/phpBB/noexist.php',
				'http://www.example.com/phpBB/viewforum.php?f=404',
			],
			'blocks' => ['foo.bar.blocks.noexist'],
		], $cleaner->get_orphans());
	}

	/**
	 * Test the run method
	 */
	public function test_run()
	{
		$cleaner = $this->get_service();

		// We start out with 7 blocks (see fixtures)
		// 6 blocks with style_id = 1 and the other block is of style_id = 2, which does not exist
		$blocks = $this->block_mapper->find();
		$this->assertEquals(7, count($blocks));

		$cleaner->run(['styles', 'routes', 'blocks']);

		$this->assertEquals('', $cleaner->get_orphans());

		// After run cron trask, we should end up with just 3 blocks
		$blocks = $this->block_mapper->find();
		$this->assertEquals(3, count($blocks));

		// confirm we have the expected blocks ids
		$this->assertEquals(array(1, 2, 6), array_keys($blocks->get_entities()));

		// column widths for non-existing style should be gone
		$this->assertEquals(
			array(
				1 => array(
					'sidebar'		=> '200px',
					'subcontent'	=> '20%',
				)
			),
			json_decode($this->config['sitemaker_column_widths'], true)
		);
	}

	/**
	 * @return int
	 */
	protected function get_custom_blocks_count()
	{
		$sql = 'SELECT COUNT(block_id) AS count FROM phpbb_sm_cblocks';
		$result = $this->db->sql_query($sql);

		return (int) $this->db->sql_fetchfield('count');
	}
}
