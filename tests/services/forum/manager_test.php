<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\forum;

use blitze\sitemaker\services\forum\manager;

class manager_test extends \phpbb_database_test_case
{
	protected $db;

	/** @var \blitze\sitemaker\services\forum\manager */
	protected $manager;

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
		global $auth, $cache, $config, $db, $phpbb_dispatcher, $phpbb_container, $phpbb_log, $phpbb_root_path, $phpEx;

		parent::setUp();

		$auth = $this->createMock('\phpbb\auth\auth');
		$cache = new \phpbb_mock_cache();
		$config = new \phpbb\config\config(array());
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
		$this->db = $db = $this->new_dbal();

		$phpbb_container = new \phpbb_mock_container_builder();
		$phpbb_container->set('attachment.manager', $this->getMockBuilder('\phpbb\attachment\manager')
			->disableOriginalConstructor()
			->getMock());

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$translator = new \phpbb\language\language($lang_loader);

		$user = new \phpbb\user($translator, '\phpbb\datetime');

		$phpbb_log = new \phpbb\log\log($db, $user, $auth, $phpbb_dispatcher, $phpbb_root_path, 'adm/', $phpEx, LOG_TABLE);

		require_once dirname(__FILE__) . '/../../../../../../includes/functions_admin.php';
		require_once dirname(__FILE__) . '/../../../../../../includes/functions_acp.php';

		$this->manager = new manager($auth, $cache, $config, $db, $translator, $phpbb_root_path, $phpEx);
	}

	public function test_add_forum()
	{
		$forum_data = array('forum_name' => 'my forum');
		$expected = array(
			'forum_name'	=> 'my forum',
			'parent_id'		=> 0,
			'forum_type'	=> 1,
			'hidden_forum'	=> 1,
			'forum_id'		=> 3,
		);

		$errors = $this->manager->add($forum_data, 1);

		$this->assertSame(array(), $errors);
		$this->assertEquals($expected, array_intersect_key($forum_data, $expected));

		// ensure that permissions were copied
		$this->db->sql_query('SELECT auth_role_id FROM ' . ACL_GROUPS_TABLE . ' WHERE forum_id = ' . (int) $forum_data['forum_id']);
		$role_id = $this->db->sql_fetchfield('auth_role_id');

		$this->assertEquals(5, $role_id);
	}

	public function test_remove_forum()
	{
		$this->manager->remove(1);

		// ensure that permissions were copied
		$result = $this->db->sql_query('SELECT * FROM ' . FORUMS_TABLE . ' WHERE forum_id = 1');
		$row = $this->db->sql_fetchrow($result);

		$this->assertFalse($row);
	}
}
