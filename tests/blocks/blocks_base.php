<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

abstract class blocks_base extends \phpbb_database_test_case
{
	protected $auth;
	protected $config;
	protected $cache;
	protected $db;
	protected $phpbb_container;
	protected $phpbb_dispatcher;
	protected $request;
	protected $template;
	protected $translator;
	protected $user;
	protected $user_data;
	protected $util;
	protected $phpbb_root_path;
	protected $php_ext;

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
	 * Configure the test environment.
	 *
	 * @return void
	 */
	public function setUp(): void
	{
		global $auth, $cache, $config, $db, $phpbb_dispatcher, $request, $template, $user, $phpbb_root_path, $phpEx, $table_prefix;

		parent::setUp();

		$cache = new \phpbb_mock_cache();
		$db = $this->new_dbal();

		$config = new \phpbb\config\config(array(
			'jab_enable'	=> 1,
			'allow_privmsg'	=> 1,
			'num_posts'		=> 8,
		));

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$this->translator = new \phpbb\language\language($lang_loader);

		$user = new \phpbb\user($this->translator, '\phpbb\datetime');
		$user->optionset('viewavatars', true);
		$user->timezone = new \DateTimeZone('UTC');
		$user->lang['datetime'] = array();
		$user->lang_id = 1;
		$user->host = 'www.example.com';
		$user->page['root_script_path'] = '/phpBB/';
		$user->style['style_path'] = 'prosilver';

		$request = $this->getMockBuilder('\phpbb\request\request')
			->disableOriginalConstructor()
			->getMock();

		$auth = $this->getMockBuilder('\phpbb\auth\auth')
			->disableOriginalConstructor()
			->getMock();
		$auth->expects($this->any())
			->method('acl_get')
			->willReturn(true);

		$temp_data = array();
		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();
		$template->expects($this->any())
			->method('assign_block_vars')
			->will($this->returnCallback(function($block, $data) use (&$temp_data) {
				$temp_data[$block][] = $data;
			}));
		$template->expects($this->any())
			->method('destroy_block_vars')
			->will($this->returnCallback(function() use (&$temp_data) {
				$temp_data = array();
			}));
		$template->expects($this->any())
			->method('alter_block_array')
			->will($this->returnCallback(function($key, $data) use (&$temp_data) {
				$temp_data[$key][] = $data;
			}));
		$template->expects($this->any())
			->method('assign_display')
			->will($this->returnCallback(function() use (&$temp_data) {
				return $temp_data;
			}));

		$this->auth =& $auth;
		$this->cache = $cache;
		$this->config =& $config;
		$this->db =& $db;
		$this->phpbb_dispatcher =& $phpbb_dispatcher;
		$this->request =& $request;
		$this->template =& $template;
		$this->user =& $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;
		$this->config_text	= new \phpbb\config\db_text($this->db, $table_prefix . 'config_text');
		$this->db_tools = $this->getMockBuilder('\phpbb\db\tools\tools')
			->setConstructorArgs([$this->db])
			->getMock();
		$this->log = $this->getMockBuilder('\phpbb\log\log')
			->disableOriginalConstructor()
			->getMock();

		$cp_type_string = new \phpbb\profilefields\type\type_string($request, $template, $user);
		$cp_type_url = new \phpbb\profilefields\type\type_text($request, $template, $user);

		$this->phpbb_container = $phpbb_container = new \phpbb_mock_container_builder();
		$phpbb_container->set('profilefields.type.string', $cp_type_string);
		$phpbb_container->set('profilefields.type.url', $cp_type_url);

		$cp_types_collection = new \phpbb\di\service_collection($phpbb_container);

		$profile_fields = new \phpbb\profilefields\manager(
			$this->auth,
			$this->config_text,
			$this->db,
			$this->db_tools,
			$phpbb_dispatcher,
			$this->translator,
			$this->log,
			$this->request,
			$template,
			$cp_types_collection,
			$user,
			$table_prefix . 'profile_fields',
			$table_prefix . 'profile_fields_data',
			$table_prefix . 'profile_fields_lang',
			$table_prefix . 'profile_lang'
		);

		$path_helper = $this->getMockBuilder('\phpbb\path_helper')
			->disableOriginalConstructor()
			->getMock();
		$path_helper->expects($this->any())
			->method('get_web_root_path')
			->will($this->returnCallback(function() {
				return './';
			}));

		$this->util = new \blitze\sitemaker\services\util($path_helper, $template, $user);

		$this->user_data = new \blitze\sitemaker\services\users\data($this->auth, $this->config, $this->db, $profile_fields, $this->translator, $user, $this->util, $phpbb_root_path, $phpEx);
	}
}
