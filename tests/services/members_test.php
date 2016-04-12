<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services;

use blitze\sitemaker\services\date_range;
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
	 * Create the members service
	 *
	 * @return \blitze\sitemaker\services\members
	 */
	protected function get_service()
	{
		global $auth, $phpbb_dispatcher, $phpbb_root_path, $phpEx;

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

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$lang_loader->set_extension_manager($phpbb_extension_manager);

		$translator = new \phpbb\language\language($lang_loader);
		$translator->set_user_language('en');

		// We do this here so we can ensure that language variables are provided
		$translator->add_lang('common');
		$translator->add_lang('common', 'blitze/sitemaker');

		$user = new \phpbb\user($translator, '\phpbb\datetime');
		$user->timezone = new \DateTimeZone('UTC');

		$db = $this->new_dbal();

		$date_range = new date_range($user, '24 February 2015');

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

		return new members($db, $translator, $user, $date_range, $ptemplate, $phpbb_root_path, $phpEx);
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
					'S_LIST'		=> 'recent',
					'USER_TITLE'	=> 'Username',
					'INFO_TITLE'	=> 'Join Date'
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
					'S_LIST'		=> 'visits',
					'USER_TITLE'	=> 'Username',
					'INFO_TITLE'	=> 'Date'
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
					'S_LIST'		=> 'bots',
					'USER_TITLE'	=> '',
					'INFO_TITLE'	=> ''
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
					'S_LIST'		=> 'tenured',
					'USER_TITLE'	=> 'Username',
					'INFO_TITLE'	=> 'Date'
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
					'S_LIST'		=> 'posts',
					'USER_TITLE'	=> 'Username',
					'INFO_TITLE'	=> 'Posts'
				),
			),
			array(
				array(
					'query_type'	=> 'visits',
					'max_members'	=> 2,
					'date_range'	=> 'month',
				),
				array(
					'member'	=> array(
						array(
							'USERNAME'		=> '<span class="username">member2</span>',
							'USER_AVATAR'	=> '',
							'USER_INFO'		=> '15 Feb 2015',
						),
					),
					'S_LIST'	=> 'visits',
					'USER_TITLE'	=> 'Username',
					'INFO_TITLE'	=> 'Date'
				),
			),
		);
	}

	/**
	 * Test the exits method
	 *
	 * @dataProvider get_list_test_data
	 * @param array $query
	 * @param array $expected
	 */
	public function test_get_list(array $query, array $expected)
	{
		$members = $this->get_service();
		$data = $members->get_list($query);

		$this->assertEquals($expected, $data);
	}
}
