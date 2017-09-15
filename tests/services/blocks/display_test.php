<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks;

use phpbb\request\request_interface;
use blitze\sitemaker\services\blocks\display;

require_once dirname(__FILE__) . '../../../../../../../includes/functions.php';
require_once dirname(__FILE__) . '/../fixtures/ext/foo/bar/foo_bar_controller.php';
require_once dirname(__FILE__) . '/../fixtures/ext/foo/bar/blocks/baz_block.php';
require_once dirname(__FILE__) . '/../fixtures/ext/foo/bar/blocks/foo_block.php';

class display_test extends \phpbb_database_test_case
{
	protected $template;

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
		return $this->createXMLDataSet(dirname(__FILE__) . '/../fixtures/routes.xml');
	}

	/**
	 * Create the blocks display service
	 *
	 * @param array $auth_map
	 * @param array $variable_map
	 * @param array $page_data
	 * @param mixed $config_text_data
	 * @param bool $show_admin_bar
	 * @return \blitze\sitemaker\services\blocks\display
	 */
	protected function get_service(array $auth_map, array $variable_map, array $page_data, $config_text_data, $show_admin_bar)
	{
		global $db, $request, $phpbb_path_helper, $phpbb_dispatcher, $phpbb_root_path, $phpEx;

		$table_prefix = 'phpbb_';
		$tables = array(
			'mapper_tables'	=> array(
				'blocks'	=> $table_prefix . 'sm_blocks',
				'routes'	=> $table_prefix . 'sm_block_routes'
			)
		);

		$auth = $this->getMock('\phpbb\auth\auth');
		$auth->expects($this->any())
			->method('acl_get')
			->with($this->stringContains('_'), $this->anything())
			->will($this->returnValueMap($auth_map));

		$db = $this->new_dbal();

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$translator = new \phpbb\language\language($lang_loader);

		$user = new \phpbb\user($translator, '\phpbb\datetime');
		$user->data['user_style'] = 1;
		$user->page = $page_data;

		$cache = new \phpbb_mock_cache();
		$db = $this->new_dbal();

		$config = new \phpbb\config\config(array(
			'default_style' => 1,
			'cookie_name' => 'test',
			'override_user_style' => true,
		    'sitemaker_default_layout' => 'index.php',
		));

		$config_text = new \phpbb\config\db_text($db, 'phpbb_config_text');

		$config_text->set('sm_layout_prefs', json_encode(array(
			1 => $config_text_data
		)));

		$request = $this->getMock('\phpbb\request\request_interface');
		$request->expects($this->any())
			->method('is_set')
			->will($this->returnCallback(function($var) use ($variable_map) {
				return (!empty($variable_map[0]) && $variable_map[0][0] === $var) ? true : false;
			}));
		$request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap($variable_map));

		$this->db = $db = $this->new_dbal();
		$this->config_text = new \phpbb\config\db_text($this->db, 'phpbb_config_text');

		$tpl_data = array();
		$this->template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();
		$this->template->expects($this->any())
			->method('assign_vars')
			->will($this->returnCallback(function($data) use (&$tpl_data) {
				$tpl_data = array_merge($tpl_data, $data);
			}));
		$this->template->expects($this->any())
			->method('assign_block_vars')
			->will($this->returnCallback(function($block, $data) use (&$tpl_data) {
				$tpl_data['blocks'][$block][] = $data;
			}));
		$this->template->expects($this->any())
			->method('assign_display')
			->will($this->returnCallback(function() use (&$tpl_data) {
				return $tpl_data;
			}));

		$admin_bar = $this->getMockBuilder('\blitze\sitemaker\services\blocks\admin_bar')
			->disableOriginalConstructor()
			->getMock();
		$admin_bar->expects($this->exactly((int) $show_admin_bar))
			->method('show');

		$ptemplate = $this->getMockBuilder('\blitze\sitemaker\services\template')
			->disableOriginalConstructor()
			->getMock();

		$groups = $this->getMockBuilder('\blitze\sitemaker\services\groups')
			->disableOriginalConstructor()
			->getMock();
		$groups->expects($this->any())
			->method('get_users_groups')
			->willReturn(array(2, 3));

		$phpbb_container = new \phpbb_mock_container_builder();
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$phpbb_container->set('my.baz.block', new \foo\bar\blocks\baz_block);
		$phpbb_container->set('my.empty.block', new \foo\bar\blocks\empty_block);
		$phpbb_container->set('my.foo.block', new \foo\bar\blocks\foo_block);

		$blocks_collection = new \phpbb\di\service_collection($phpbb_container);

		$blocks_collection->add('my.baz.block');
		$blocks_collection->add('my.empty.block');
		$blocks_collection->add('my.foo.block');

		$block_factory = new \blitze\sitemaker\services\blocks\factory($translator, $ptemplate, $blocks_collection);
		$mapper_factory = new \blitze\sitemaker\model\mapper_factory($config, $db, $tables);
		$blocks = new \blitze\sitemaker\services\blocks\blocks($cache, $config, $phpbb_dispatcher, $this->template, $translator, $block_factory, $groups, $mapper_factory, $phpEx);

		$phpbb_container->set('blitze.sitemaker.blocks', $blocks);
		$phpbb_container->set('blitze.sitemaker.blocks.admin_bar', $admin_bar);
		$phpbb_container->set('foo.bar.controller', new \foo\bar\foo_bar_controller());

		$phpbb_path_helper =  new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			new \phpbb\filesystem(),
			$request,
			$phpbb_root_path,
			$phpEx
		);

		return new display($auth, $config, $config_text, $phpbb_container, $request, $this->template, $user);
	}

	/**
	 * Data set for test_show_admin_bar
	 *
	 * @return array
	 */
	public function show_blocks_test_data()
	{
		return array(
			array(
				array(
					array('a_sm_manage_blocks', 0, true),
				),
				array(),
				array(
					'page_dir' => 'adm',
					'page_name' => 'index.php',
					'query_string' => '',
				),
				'',
				false,
				array(),
				array(),
			),
			array(
				array(
					array('a_sm_manage_blocks', 0, true),
				),
				array(),
				array(
					'page_dir' => '',
					'page_name' => 'ucp.php',
					'query_string' => 'i=177',
				),
				'',
				false,
				array(),
				array(),
			),
			array(
				array(
					array('a_sm_manage_blocks', 0, false),
				),
				array(
					array('edit_mode', false, false, request_interface::REQUEST, true),
				),
				array(
					'page_dir' => '',
					'page_name' => 'index.php',
					'query_string' => '',
				),
				array(
					'layout' => './../ext/blitze/sitemaker/styles/all/template/layouts/portal/'
				),
				false,
				array(
					'S_SITEMAKER' => true,
					'S_LAYOUT' => 'portal',
					'U_EDIT_MODE' => '',
				),
				array(1),
			),
			array(
				array(
					array('a_sm_manage_blocks', 0, true),
				),
				array(
					array('edit_mode', false, false, request_interface::REQUEST, false),
				),
				array(
					'page_dir' => '',
					'page_name' => 'index.php',
					'query_string' => '',
				),
				array(
					'layout' => './../ext/blitze/sitemaker/styles/all/template/layouts/portal_alt/'
				),
				false,
				array(
					'S_SITEMAKER' => true,
					'S_LAYOUT' => 'portal_alt',
					'U_EDIT_MODE' => 'http://phpBB/?edit_mode=1',
				),
				array(1),
			),
			array(
				array(
					array('a_sm_manage_blocks', 0, true),
				),
				array(
					array('edit_mode', false, false, request_interface::REQUEST, true),
					array('test_sm_edit_mode', false, false, request_interface::COOKIE, false),
				),
				array(
					'page_dir' => '',
					'page_name' => 'index.php',
					'query_string' => 'edit_mode=1',
				),
				array(
					'layout' => './../ext/blitze/sitemaker/styles/all/template/layouts/portal/'
				),
				true,
				array(
					'S_SITEMAKER' => true,
					'S_LAYOUT' => 'portal',
					'U_EDIT_MODE' => 'http://phpBB/?edit_mode=0',
				),
				array(1),
			),
			array(
				array(
					array('a_sm_manage_blocks', 0, true),
				),
				array(
					array('style', 0, false, request_interface::REQUEST, 2),
					array('edit_mode', false, false, request_interface::REQUEST, false),
					array('test_sm_edit_mode', false, false, request_interface::COOKIE, true),
				),
				array(
					'page_dir' => '',
					'page_name' => 'faq.php',
					'query_string' => '',
				),
				'',
				true,
				array(
					'S_SITEMAKER' => true,
					'S_LAYOUT' => 'portal',
					'U_EDIT_MODE' => 'http://phpBB/?edit_mode=0',
				),
				array(),
			),
			array(
				array(
					array('a_sm_manage_blocks', 0, false),
				),
				array(
					array('style', 0, false, request_interface::REQUEST, 2),
					array('edit_mode', false, false, request_interface::REQUEST, false),
					array('test_sm_edit_mode', false, false, request_interface::COOKIE, false),
				),
				array(
					'page_dir' => '',
					'page_name' => 'faq.php',
					'query_string' => '',
				),
				'',
				false,
				array(
					'S_SITEMAKER' => true,
					'S_LAYOUT' => 'portal',
					'U_EDIT_MODE' => '',
				),
				array(5),
			),
			// has own blocks, but block id #4 is set to only display on sub-route
			// and should therefore not show here
			array(
				array(
					array('a_sm_manage_blocks', 0, false),
				),
				array(
					array('edit_mode', false, false, request_interface::REQUEST, false),
				),
				array(
					'page_dir' => '',
					'page_name' => 'app.php/articles',
					'query_string' => '',
				),
				'',
				false,
				array(
					'S_SITEMAKER' => true,
					'S_LAYOUT' => 'portal',
					'U_EDIT_MODE' => '',
				),
				array(2, 3),
			),
			// sub route: does not have own blocks and therefore should inherit from parent
			// parent route has block (id #4) that should only display on child route and
			// a block (id #2) set to display always
			array(
				array(
					array('a_sm_manage_blocks', 0, false),
				),
				array(
					array('edit_mode', false, false, request_interface::REQUEST, false),
				),
				array(
					'page_dir' => '',
					'page_name' => 'app.php/articles/1234/my-first-post',
					'query_string' => '',
				),
				'',
				false,
				array(
					'S_SITEMAKER' => true,
					'S_LAYOUT' => 'portal',
					'U_EDIT_MODE' => '',
				),
				array(2, 4),
			),
			// in edit_mode, we do not inherit any blocks
			array(
				array(
					array('a_sm_manage_blocks', 0, true),
				),
				array(
					array('edit_mode', false, false, request_interface::REQUEST, true),
					array('test_sm_edit_mode', false, false, request_interface::COOKIE, true),
				),
				array(
					'page_dir' => '',
					'page_name' => 'app.php/articles/1234/my-first-post',
					'query_string' => '',
				),
				'',
				true,
				array(
					'S_SITEMAKER' => true,
					'S_LAYOUT' => 'portal',
					'U_EDIT_MODE' => 'http://phpBB/?edit_mode=0',
				),
				array(),
			),
			// local directory with own blocks (3): block id # 8 is set to only display on child directory and should not show here
			array(
				array(
					array('a_sm_manage_blocks', 0, false),
				),
				array(
					array('edit_mode', false, false, request_interface::REQUEST, false),
				),
				array(
					'page_dir' => 'test-dir',
					'page_name' => 'index.php',
					'query_string' => '',
				),
				'',
				false,
				array(
					'S_SITEMAKER' => true,
					'S_LAYOUT' => 'portal',
					'U_EDIT_MODE' => '',
				),
				array(6, 7),
			),
			// sub-directory with no blocks should inherit from parent directory/index.php if it (parent) has own blocks
			// in this case, parent directory is test-dir and has block # 6 showing always, #8 showing only on child directory (this directory), and #7 showing only on parent directory
			array(
				array(
					array('a_sm_manage_blocks', 0, false),
				),
				array(
					array('edit_mode', false, false, request_interface::REQUEST, false),
				),
				array(
					'page_dir' => 'test-dir/sub-dir',
					'page_name' => 'index.php',
					'query_string' => '',
				),
				'',
				false,
				array(
					'S_SITEMAKER' => true,
					'S_LAYOUT' => 'portal',
					'U_EDIT_MODE' => '',
				),
				array(6, 8),
			),
			array(
				array(
					array('a_sm_manage_blocks', 0, false),
				),
				array(
					array('edit_mode', false, false, request_interface::REQUEST, false),
				),
				array(
					'page_dir' => 'test-dir/sub-dir',
					'page_name' => 'test.php',
					'query_string' => '',
				),
				'',
				false,
				array(
					'S_SITEMAKER' => true,
					'S_LAYOUT' => 'portal',
					'U_EDIT_MODE' => '',
				),
				array(6, 8),
			),
			// parent directory has no blocks, so child directory gets blocks from default route
			array(
				array(
					array('a_sm_manage_blocks', 0, false),
				),
				array(
					array('edit_mode', false, false, request_interface::REQUEST, false),
				),
				array(
					'page_dir' => 'dir-no-blocks/sub-dir',
					'page_name' => 'index.php',
					'query_string' => '',
				),
				'',
				false,
				array(
					'S_SITEMAKER' => true,
					'S_LAYOUT' => 'portal',
					'U_EDIT_MODE' => '',
				),
				array(1),
			),
			array(
				array(
					array('a_sm_manage_blocks', 0, false),
				),
				array(
					array('edit_mode', false, false, request_interface::REQUEST, false),
				),
				array(
					'page_dir' => '',
					'page_name' => 'viewforum.php',
					'query_string' => 'f=2',
				),
				'',
				false,
				array(
					'S_SITEMAKER' => true,
					'S_LAYOUT' => 'portal',
					'U_EDIT_MODE' => '',
				),
				array(),
			),
			array(
				array(
					array('a_sm_manage_blocks', 0, false),
				),
				array(
					array('edit_mode', false, false, request_interface::REQUEST, false),
				),
				array(
					'page_dir' => '',
					'page_name' => 'viewtopic.php',
					'query_string' => 'f=2&t=1',
				),
				'',
				false,
				array(
					'S_SITEMAKER' => true,
					'S_LAYOUT' => 'portal',
					'U_EDIT_MODE' => '',
				),
				array(9),
			),
			// sub-directory with no blocks should inherit from parent directory/index.php if it (parent) has own blocks
			// in this case, parent directory is test-dir and has blocks, but this route is set to not display any blocks
			array(
				array(
					array('a_sm_manage_blocks', 0, false),
				),
				array(
					array('edit_mode', false, false, request_interface::REQUEST, false),
				),
				array(
					'page_dir' => 'test-dir/bar',
					'page_name' => 'index.php',
					'query_string' => '',
				),
				'',
				false,
				array(
					'S_SITEMAKER' => true,
					'S_LAYOUT' => 'portal',
					'U_EDIT_MODE' => '',
				),
				array(),
			),
			// page has own blocks, we are not in edit mode, and it is set to hide all blocks
			array(
				array(
					array('a_sm_manage_blocks', 0, false),
				),
				array(
					array('edit_mode', false, false, request_interface::REQUEST, true),
				),
				array(
					'page_dir' => '',
					'page_name' => 'baz.php',
					'query_string' => '',
				),
				'',
				false,
				array(
					'S_SITEMAKER' => true,
					'S_LAYOUT' => 'portal',
					'U_EDIT_MODE' => '',
				),
				array(),
			),
			// page has own blocks, we are in edit mode, and it is set to hide all blocks
			array(
				array(
					array('a_sm_manage_blocks', 0, true),
				),
				array(
					array('edit_mode', false, false, request_interface::REQUEST, true),
					array('test_sm_edit_mode', false, false, request_interface::COOKIE, false),
				),
				array(
					'page_dir' => '',
					'page_name' => 'baz.php',
					'query_string' => 'edit_mode=1',
				),
				'',
				true,
				array(
					'S_SITEMAKER' => true,
					'S_LAYOUT' => 'portal',
					'U_EDIT_MODE' => 'http://phpBB/?edit_mode=0',
				),
				array(10),
			),
		);
	}

	/**
	 * Test the show method
	 *
	 * @dataProvider show_blocks_test_data
	 * @param array $auth_map
	 * @param array $variable_map
	 * @param array $page_data
	 * @param mixed $config_text
	 * @param bool $show_admin_bar
	 * @param array $expected_vars
	 * @param array $expected_block_ids
	 */
	public function test_show_blocks(array $auth_map, array $variable_map, array $page_data, $config_text_data, $show_admin_bar, array $expected_vars, array $expected_block_ids)
	{
		$display = $this->get_service($auth_map, $variable_map, $page_data, $config_text_data, $show_admin_bar);
		$display->show();

		$result = $this->template->assign_display('page');

		$this->assertEquals($expected_vars, $this->get_tested_vars($result));
		$this->assertEquals($expected_block_ids, $this->get_block_ids($result));
	}

	/**
	 * @param array $result
	 * @return array
	 */
	private function get_tested_vars(array $result)
	{
		$vars = array();
		if (sizeof($result))
		{
			$vars = array_intersect_key($result, array(
				'S_SITEMAKER'	=> '',
				'S_LAYOUT'		=> '',
				'U_EDIT_MODE'	=> '',
			));
		}
		return $vars;
	}

	/**
	 * @param array $result
	 * @return array
	 */
	private function get_block_ids(array $result)
	{
		$block_ids = array();
		if (isset($result['positions']))
		{
			foreach ($result['positions'] as $pos => $blocks)
			{
				foreach ($blocks as $block)
				{
					$block_ids[] = $block['bid'];
				}
			}
		}
		return $block_ids;
	}
}
