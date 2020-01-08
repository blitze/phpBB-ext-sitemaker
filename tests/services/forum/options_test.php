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
	protected $forum_options;

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
	public function setUp(): void
	{
		global $auth, $db, $phpbb_dispatcher, $phpbb_root_path, $phpEx;

		parent::setUp();

		$auth = $this->getMockBuilder('\phpbb\auth\auth')
			->disableOriginalConstructor()
			->getMock();

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$db = $this->new_dbal();

		$this->forum_options = new options($phpbb_root_path, $phpEx);
	}

	/**
	 * @return void
	 */
	public function test_get_all()
	{
		$expected = array(
			'' => 'ALL_FORUMS',
			1 => 'Forum 1',
			2 => 'Forum 2',
		);

		$result = $this->forum_options->get_all();

		$this->assertSame($expected, $result);
	}

	/**
	 * @return void
	 */
	public function test_get_topic_types()
	{
		$expected = array(
			POST_NORMAL     => 'POST_NORMAL',
			POST_STICKY     => 'POST_STICKY',
			POST_ANNOUNCE   => 'POST_ANNOUNCEMENT',
			POST_GLOBAL     => 'POST_GLOBAL',
		);

		$result = $this->forum_options->get_topic_types();

		$this->assertSame($expected, $result);
	}
}
