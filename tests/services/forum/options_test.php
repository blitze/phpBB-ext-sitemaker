<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\forum;

use blitze\sitemaker\services\forum\options;

class options_test extends \phpbb_database_test_case
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
		return $this->createXMLDataSet(dirname(__FILE__) . '/../fixtures/forum.xml');
	}

	/**
	 * Configure the test environment.
	 *
	 * @return void
	 */
	public function setUp()
	{
		global $auth, $db, $phpbb_dispatcher, $phpbb_root_path, $phpEx;

		parent::setUp();

		$auth = $this->getMock('\phpbb\auth\auth');

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$db = $this->new_dbal();

		$this->forum_options = new options($phpbb_root_path, $phpEx);
	}

	public function test_get_all()
	{
		$expected = array(
			'' => 'ALL',
			1 => 'Forum 1',
			2 => 'Forum 2',
		);

		$result = $this->forum_options->get_all();

		$this->assertSame($expected, $result);
	}
}
