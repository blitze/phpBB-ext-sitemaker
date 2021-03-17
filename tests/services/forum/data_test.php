<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2021 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\forum;

class data_test extends \phpbb_database_test_case
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
     * @return \blitze\sitemaker\services\forum\data
     */
    public function get_service()
    {
        global $auth, $db, $phpbb_dispatcher, $phpbb_root_path, $phpEx;

        $auth = $this->getMockBuilder('\phpbb\auth\auth')
            ->disableOriginalConstructor()
            ->getMock();

        $auth->expects($this->any())
            ->method('acl_getf')
            ->willReturn(array(4 => 4));

        $phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
        $db = $this->new_dbal();
        $config = new \phpbb\config\config([]);

        $user = $this->createMock('\phpbb\user');
        $user_data = $this->createMock('\blitze\sitemaker\services\users\data');

        $content_visibility = new \phpbb\content_visibility($auth, $config, $phpbb_dispatcher, $db, $user, $phpbb_root_path, $phpEx, 'phpbb_forums', 'phpbb_posts', 'phbb_topics', 'phpbb_users');

        return new \blitze\sitemaker\services\forum\data($auth, $config, $content_visibility, $db, $user, $user_data, 0);
    }

    public function test_empty_topic_data()
    {
        $forum_data = $this->get_service();

        $forum_data->query(false)
            ->fetch_forum(20)
            ->build();

        $topics_data = $forum_data->get_topic_data(1);
        $post_data = $forum_data->get_post_data('last');

        $this->assertEquals([], $topics_data);
        $this->assertEquals([], $post_data);
    }
}
