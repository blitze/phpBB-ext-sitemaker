<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services;

use blitze\sitemaker\services\members;

class members_test extends \phpbb_database_test_case
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
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/members.xml');
	}

	/**
	 * Configure the test environment.
	 *
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();

		require_once dirname(__FILE__) . '/../../../../../includes/functions.php';
		require_once dirname(__FILE__) . '/../../../../../includes/functions_content.php';
	}

	/**
	 * Create the members service
	 *
	 * @return \blitze\sitemaker\services\members
	 */
	protected function get_service()
	{
		global $auth, $phpbb_dispatcher, $phpbb_extension_manager, $phpbb_root_path, $phpEx;

		$auth = $this->getMock('\phpbb\auth\auth');

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$container = new \phpbb_mock_container_builder();
		$phpbb_extension_manager = new \phpbb_mock_extension_manager(
			$phpbb_root_path,
			array(
				'blitze/sitemaker' => array(
					'ext_name'		=> 'blitze/sitemaker',
					'ext_active'	=> '1',
					'ext_path'		=> 'ext/blitze/sitemaker/',
				),
			),
			$container);

		$user = new \phpbb\user('\phpbb\datetime');
		$user->timezone = new \DateTimeZone('UTC');
		$user->data = array('user_lang' => 'en');
		$user->lang['datetime'] =  array();

		// We do this here so we can ensure that language variables are provided
		$user->add_lang('common');
		$user->add_lang_ext('blitze/sitemaker', 'common');

		$db = $this->new_dbal();

		$util = $this->getMockBuilder('\blitze\sitemaker\services\util')
			->disableOriginalConstructor()
			->getMock();

		$tpl_data = array();
		$ptemplate = $this->getMockBuilder('\blitze\sitemaker\services\template')
			->disableOriginalConstructor()
			->getMock();

		// make sure we've set template file
		$ptemplate->expects($this->any())
			->method('assign_vars')
			->will($this->returnCallback(function($data) use (&$tpl_data) {
				$tpl_data = array_merge($tpl_data, $data);
			}));

		// make sure we've set template file
		$ptemplate->expects($this->any())
			->method('assign_block_vars')
			->will($this->returnCallback(function($key, $data) use (&$tpl_data) {
				$tpl_data[$key][] = $data;
			}));

		$ptemplate->expects($this->any())
			->method('render_view')
			->with(
				$this->equalTo('blitze/sitemaker'),
				$this->equalTo('blocks/members.html'),
				$this->equalTo('members_block')
			)
			->will($this->returnCallback(function() use (&$tpl_data) {
				return $tpl_data;
			}));

		return new members($db, $user, $util, $ptemplate, $phpbb_root_path, $phpEx);
	}

	/**
	 * Data set for test_get_list
	 *
	 * @return array
	 */
	public function get_list_test_data()
	{
		return array(
			array(
				array(),
				array(
					'member'	=> array(
						array(
							'USERNAME'		=> '<span class="username">member5</span>',
							'USER_AVATAR'	=> '',
							'USER_INFO'		=> '01 Mar 2015',
						),
						array(
							'USERNAME'		=> '<span class="username">member4</span>',
							'USER_AVATAR'	=> '',
							'USER_INFO'		=> '23 Feb 2015',
						),
						array(
							'USERNAME'		=> '<span class="username">member3</span>',
							'USER_AVATAR'	=> '',
							'USER_INFO'		=> '23 Feb 2015',
						),
						array(
							'USERNAME'		=> '<span class="username">member2</span>',
							'USER_AVATAR'	=> '',
							'USER_INFO'		=> '15 Feb 2015',
						),
						array(
							'USERNAME'		=> '<span class="username">member1</span>',
							'USER_AVATAR'	=> '',
							'USER_INFO'		=> '30 Jan 2015',
						),
					),
					'S_LIST'	=> 'recent',
					'L_USER'	=> 'Username',
					'L_INFO'	=> 'Join Date'
				),
			),
			array(
				array(
					'query_type'	=> 'visits',
					'max_members'	=> 1,
				),
				array(
					'member'	=> array(
						array(
							'USERNAME'		=> '<span class="username">founder</span>',
							'USER_AVATAR'	=> '',
							'USER_INFO'		=> '23 Aug 2015',
						),
					),
					'S_LIST'	=> 'visits',
					'L_USER'	=> 'Username',
					'L_INFO'	=> 'Date'
				),
			),
			array(
				array(
					'query_type'	=> 'bots',
					'max_members'	=> 1,
				),
				array(
					'member'	=> array(
						array(
							'USERNAME'		=> 'bot2',
							'USER_INFO'		=> '',
						),
					),
					'S_LIST'	=> 'bots',
					'L_USER'	=> '',
					'L_INFO'	=> ''
				),
			),
			array(
				array(
					'query_type'	=> 'tenured',
					'max_members'	=> 1,
				),
				array(
					'member'	=> array(
						array(
							'USERNAME'		=> '<span class="username">founder</span>',
							'USER_AVATAR'	=> '',
							'USER_INFO'		=> '05 Jan 2015',
						),
					),
					'S_LIST'	=> 'tenured',
					'L_USER'	=> 'Username',
					'L_INFO'	=> 'Date'
				),
			),
			array(
				array(
					'query_type'	=> 'posts',
					'max_members'	=> 1,
				),
				array(
					'member'	=> array(
						array(
							'USERNAME'		=> '<span class="username">member2</span>',
							'USER_AVATAR'	=> '',
							'USER_INFO'		=> '<a href="phpBB/search.php?author_id=7&amp;sr=posts">1</a>',
						),
					),
					'S_LIST'	=> 'posts',
					'L_USER'	=> 'Username',
					'L_INFO'	=> 'Posts'
				),
			),
		);
	}

	/**
	 * Test the exits method
	 *
	 * @dataProvider get_list_test_data
	 */
	public function test_get_list($query, $expected)
	{
		$members = $this->get_service();
		$data = $members->get_list($query);

		$this->assertEquals($expected, $data);
	}
}
