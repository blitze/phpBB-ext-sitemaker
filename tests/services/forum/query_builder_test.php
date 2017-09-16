<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2017 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\forum;

class query_builder_test extends \phpbb_database_test_case
{
	protected $config;
	protected $query_builder;
	protected $user;

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
		return $this->createXMLDataSet(dirname(__FILE__) . '/../fixtures/users.xml');
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

		$auth->expects($this->any())
			->method('acl_getf')
			->willReturn(array(4 => 4));

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$db = $this->new_dbal();

		$this->config = new \phpbb\config\config(array(
			'load_db_lastread' => true,
		));

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$language = new \phpbb\language\language($lang_loader);

		$this->user = new \phpbb\user($language, '\phpbb\datetime');
		$this->user->data['is_registered'] = true;
		$this->user->timezone = new \DateTimeZone('UTC');

		$content_visibility = new \phpbb\content_visibility($auth, $this->config, $phpbb_dispatcher, $db, $this->user, $phpbb_root_path, $phpEx, 'phpbb_forums', 'phpbb_posts', 'phbb_topics', 'phpbb_users');

		$this->query_builder = $this->getMockBuilder('\blitze\sitemaker\services\forum\query_builder')
			->setConstructorArgs(array($auth, $this->config, $content_visibility, $db, $this->user, 0))
            ->setMethods(array('time'))
            ->getMock();
		$this->query_builder->expects($this->any())
			->method('time')
			->willReturn('000000');
	}

	/**
	 * @return array
	 */
	public function query_builder_test_data()
	{
		return array(
			array(
				true,
				true,
				0,
				0,
				0,
				array(
					'SELECT' => 'f.*, t.*, tt.mark_time, ft.mark_time as forum_mark_time',
					'FROM' => array(
						'phpbb_forums' => 'f',
						'phpbb_topics' => 't',
					),
					'LEFT_JOIN' => array(
						array(
							'FROM' => array(
								'phpbb_topics_track' => 'tt',
							),
							'ON' => 'tt.user_id = 0 AND t.topic_id = tt.topic_id',
						),
						array(
							'FROM' => array(
								'phpbb_forums_track' => 'ft',
							),
							'ON' => 'ft.user_id = 0 AND t.forum_id = ft.forum_id',
						),
					),
					'WHERE' => 't.topic_time <= 000000 AND (t.forum_id <> 4 AND t.topic_visibility = 1) AND f.hidden_forum = 0 AND f.forum_id = t.forum_id AND t.topic_moved_id = 0',
				),
			),
			array(
				true,
				false,
				0,
				0,
				0,
				array(
					'SELECT' => 't.*, tt.mark_time, ft.mark_time as forum_mark_time',
					'FROM' => array(
						'phpbb_forums' => 'f',
						'phpbb_topics' => 't',
					),
					'LEFT_JOIN' => array(
						array(
							'FROM' => array(
								'phpbb_topics_track' => 'tt',
							),
							'ON' => 'tt.user_id = 0 AND t.topic_id = tt.topic_id',
						),
						array(
							'FROM' => array(
								'phpbb_forums_track' => 'ft',
							),
							'ON' => 'ft.user_id = 0 AND t.forum_id = ft.forum_id',
						),
					),
					'WHERE' => 't.topic_time <= 000000 AND (t.forum_id <> 4 AND t.topic_visibility = 1) AND f.hidden_forum = 0 AND f.forum_id = t.forum_id AND t.topic_moved_id = 0',
				),
			),
			array(
				false,
				false,
				0,
				0,
				0,
				array(
					'SELECT' => 't.*',
					'FROM' => array(
						'phpbb_forums' => 'f',
						'phpbb_topics' => 't',
					),
					'LEFT_JOIN' => array(),
					'WHERE' => 't.topic_time <= 000000 AND (t.forum_id <> 4 AND t.topic_visibility = 1) AND f.hidden_forum = 0 AND f.forum_id = t.forum_id AND t.topic_moved_id = 0',
				),
			),
			array(
				false,
				false,
				2,
				4,
				3,
				array(
					'SELECT' => 't.*',
					'FROM' => array(
						'phpbb_forums' => 'f',
						'phpbb_topics' => 't',
					),
					'LEFT_JOIN' => array(),
					'WHERE' => 't.forum_Id = 2 AND t.topic_id = 4 AND t.topic_poster = 3 AND t.topic_time <= 000000 AND (t.forum_id <> 4 AND t.topic_visibility = 1) AND f.hidden_forum = 0 AND f.forum_id = t.forum_id AND t.topic_moved_id = 0',
				),
			),
		);
	}

	/**
	 * @dataProvider query_builder_test_data
	 * @param bool $track_topics
	 * @param bool $get_forum_data
	 * @param mixed $forum_id
	 * @param mixed $topic_id
	 * @param mixed $poster_id
	 * @param array $expected_sql_array
	 * @return void
	 */
	public function test_query_builder($track_topics, $get_forum_data, $forum_id, $topic_id, $poster_id, $expected_sql_array)
	{
		$sql_array = $this->query_builder->query($track_topics, $get_forum_data)
			->fetch_forum($forum_id)
			->fetch_topic($topic_id)
			->fetch_topic_poster($poster_id)
			->build()
			->get_sql_array();
		$sql_array['WHERE'] = preg_replace('/\s+/', ' ', $sql_array['WHERE']);

		$this->assertSame($expected_sql_array, $sql_array);
	}

	/**
	 * @return array
	 */
	public function fetch_watch_status_test_data()
	{
		return array(
			array(
				'topic',
				true,
				false,
				array(
					'SELECT' => 'f.*, t.*',
					'FROM' => array(
						'phpbb_forums' => 'f',
						'phpbb_topics' => 't',
					),
					'LEFT_JOIN' => array(),
					'WHERE' => 't.topic_time <= 000000 AND (t.forum_id <> 4 AND t.topic_visibility = 1) AND f.hidden_forum = 0 AND f.forum_id = t.forum_id AND t.topic_moved_id = 0',
				),
			),
			array(
				'topic',
				false,
				true,
				array(
					'SELECT' => 't.*, ws.notify_status',
					'FROM' => array(
						'phpbb_forums' => 'f',
						'phpbb_topics' => 't',
					),
					'LEFT_JOIN' => array(
						array(
							'FROM' => array(
								'phpbb_topics_watch' => 'ws',
							),
							'ON' => 'ws.topic_id = t.topic_id AND ws.user_id = 0',
						),
					),
					'WHERE' => 't.topic_time <= 000000 AND (t.forum_id <> 4 AND t.topic_visibility = 1) AND f.hidden_forum = 0 AND f.forum_id = t.forum_id AND t.topic_moved_id = 0',
				),
			),
		);
	}

	/**
	 * @dataProvider fetch_watch_status_test_data
	 * @param string $type
	 * @param bool $get_forum_data
	 * @param bool $registered_user
	 * @param array $expected_sql_array
	 * @return void
	 */
	public function test_fetch_watch_status($type, $get_forum_data, $registered_user, $expected_sql_array)
	{
		$this->user->data['is_registered'] = $registered_user;

		$sql_array = $this->query_builder->query(false, $get_forum_data)
			->fetch_watch_status($type)
			->build()
			->get_sql_array();
		$sql_array['WHERE'] = preg_replace('/\s+/', ' ', $sql_array['WHERE']);

		$this->assertSame($expected_sql_array, $sql_array);
	}

	/**
	 * @return array
	 */
	public function fetch_bookmark_status_test_data()
	{
		return array(
			array(
				false,
				false,
				array(
					'SELECT' => 't.*',
					'FROM' => array(
						'phpbb_forums' => 'f',
						'phpbb_topics' => 't',
					),
					'LEFT_JOIN' => array(),
					'WHERE' => 't.topic_time <= 000000 AND (t.forum_id <> 4 AND t.topic_visibility = 1) AND f.hidden_forum = 0 AND f.forum_id = t.forum_id AND t.topic_moved_id = 0',
				),
			),
			array(
				true,
				true,
				array(
					'SELECT' => 't.*, bm.topic_id as bookmarked',
					'FROM' => array(
						'phpbb_forums' => 'f',
						'phpbb_topics' => 't',
					),
					'LEFT_JOIN' => array(
						array(
							'FROM' => array(
								'phpbb_bookmarks' => 'bm',
							),
							'ON' => 'bm.user_id = 3 AND t.topic_id = bm.topic_id',
						),
					),
					'WHERE' => 't.topic_time <= 000000 AND (t.forum_id <> 4 AND t.topic_visibility = 1) AND f.hidden_forum = 0 AND f.forum_id = t.forum_id AND t.topic_moved_id = 0',
				),
			),
		);
	}

	/**
	 * @dataProvider fetch_bookmark_status_test_data
	 * @param bool $allow_bookmarks
	 * @param bool $registered_user
	 * @param array $expected_sql_array
	 * @return void
	 */
	public function test_fetch_bookmark_status($allow_bookmarks, $registered_user, $expected_sql_array)
	{
		$this->config->set('allow_bookmarks', $allow_bookmarks);
		$this->user->data['is_registered'] = $registered_user;
		$this->user->data['user_id'] = 3;

		$sql_array = $this->query_builder->query(false, false)
			->fetch_bookmark_status()
			->build()
			->get_sql_array();
		$sql_array['WHERE'] = preg_replace('/\s+/', ' ', $sql_array['WHERE']);

		$this->assertSame($expected_sql_array, $sql_array);
	}

	/**
	 * @return array
	 */
	public function fetch_custom_test_data()
	{
		return array(
			array(
				array(),
				array(),
				array(
					'SELECT' => 't.*',
					'FROM' => array(
						'phpbb_forums' => 'f',
						'phpbb_topics' => 't',
					),
					'LEFT_JOIN' => array(),
					'WHERE' => 't.topic_time <= 000000 AND (t.forum_id <> 4 AND t.topic_visibility = 1) AND f.hidden_forum = 0 AND f.forum_id = t.forum_id AND t.topic_moved_id = 0',
				),
			),
			array(
				array(
					'SELECT' 	=> array('x.foo'),
					'FROM'		=> array('phpbb_foo_table' => 'x'),
					'WHERE'		=> array("x.foo = 'bar'"),
				),
				array(),
				array(
					'SELECT' => 't.*, x.foo',
					'FROM' => array(
						'phpbb_foo_table' => 'x',
						'phpbb_forums' => 'f',
						'phpbb_topics' => 't',
					),
					'LEFT_JOIN' => array(),
					'WHERE' => 'x.foo = \'bar\' AND t.topic_time <= 000000 AND (t.forum_id <> 4 AND t.topic_visibility = 1) AND f.hidden_forum = 0 AND f.forum_id = t.forum_id AND t.topic_moved_id = 0',
				),
			),
			array(
				array(
					'SELECT' 	=> array('x.foo'),
					'FROM'		=> array('phpbb_foo_table' => 'x'),
					'WHERE'		=> array("x.foo = 'bar'"),
				),
				array('SELECT'),
				array(
					'SELECT' => 'x.foo',
					'FROM' => array(
						'phpbb_foo_table' => 'x',
						'phpbb_forums' => 'f',
						'phpbb_topics' => 't',
					),
					'LEFT_JOIN' => array(),
					'WHERE' => 'x.foo = \'bar\' AND t.topic_time <= 000000 AND (t.forum_id <> 4 AND t.topic_visibility = 1) AND f.hidden_forum = 0 AND f.forum_id = t.forum_id AND t.topic_moved_id = 0',
				),
			),
		);
	}

	/**
	 * @dataProvider fetch_custom_test_data
	 * @param array $sql_array
	 * @param array $overwrite
	 * @param array $expected_sql_array
	 * @return void
	 */
	public function test_fetch_custom(array $sql_array, array $overwrite_keys, $expected_sql_array)
	{
		$sql_array = $this->query_builder->query(false, false)
			->fetch_custom($sql_array, $overwrite_keys)
			->build()
			->get_sql_array();
		$sql_array['WHERE'] = preg_replace('/\s+/', ' ', $sql_array['WHERE']);

		$this->assertSame($expected_sql_array, $sql_array);
	}
}
