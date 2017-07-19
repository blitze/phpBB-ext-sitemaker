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
	protected $ptemplate;
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
	public function setUp()
	{
		global $auth, $cache, $config, $db, $phpbb_dispatcher, $request, $template, $user, $phpbb_root_path, $phpEx;

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

		$request = $this->createMock('\phpbb\request\request');

		$auth = $this->createMock('\phpbb\auth\auth');
		$auth->expects($this->any())
			->method('acl_get')
			->willReturn(true);

		$tpl_data = array();
		$this->ptemplate = $this->getMockBuilder('\blitze\sitemaker\services\template')
			->disableOriginalConstructor()
			->getMock();

		$this->ptemplate->expects($this->any())
			->method('assign_vars')
			->will($this->returnCallback(function($data) use (&$tpl_data) {
				$tpl_data = array_merge($tpl_data, $data);
			}));

		$this->ptemplate->expects($this->any())
			->method('assign_block_vars')
			->will($this->returnCallback(function($block, $data) use (&$tpl_data) {
				$tpl_data[$block][] = $data;
			}));

		$this->ptemplate->expects($this->any())
			->method('assign_block_vars_array')
			->will($this->returnCallback(function($block, $data) use (&$tpl_data) {
				$tpl_data[$block] = $data;
			}));

		$this->ptemplate->expects($this->any())
			->method('render_view')
			->will($this->returnCallback(function() use (&$tpl_data) {
				return $tpl_data;
			}));

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

		$cp_type_string = new \phpbb\profilefields\type\type_string($request, $template, $user);
		$cp_type_url = new \phpbb\profilefields\type\type_text($request, $template, $user);

		$this->phpbb_container = $phpbb_container = new \phpbb_mock_container_builder();
		$phpbb_container->set('profilefields.type.string', $cp_type_string);
		$phpbb_container->set('profilefields.type.url', $cp_type_url);

		$cp_types_collection = new \phpbb\di\service_collection($phpbb_container);

		$profile_fields = new \phpbb\profilefields\manager($this->auth, $this->db, $phpbb_dispatcher, $this->request, $template, $cp_types_collection, $user, 'phpbb_profile_fields', 'phpbb_profile_lang', 'phpbb_profile_fields_data');

		$template_context = $this->getMockBuilder('phpbb\template\context')
			->getMock();

		$path_helper = $this->getMockBuilder('\phpbb\path_helper')
			->disableOriginalConstructor()
			->getMock();
		$path_helper->expects($this->any())
			->method('get_web_root_path')
			->will($this->returnCallback(function() {
				return './';
			}));

		$this->util = new \blitze\sitemaker\services\util($path_helper, $template, $template_context, $user);

		$this->user_data = new \blitze\sitemaker\services\users\data($this->auth, $this->config, $this->db, $profile_fields, $this->translator, $user, $this->util, $phpbb_root_path, $phpEx);
	}
}
