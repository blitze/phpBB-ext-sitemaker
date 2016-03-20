<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use blitze\sitemaker\model\mapper_factory;
use blitze\sitemaker\services\template;
use blitze\sitemaker\services\menus\display;
use blitze\sitemaker\blocks\menu;

class menu_test extends blocks_base
{
	/**
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/menu.xml');
	}

	/**
	 * Create the menu block
	 *
	 * @return \blitze\sitemaker\blocks\menu
	 */
	protected function get_block($page_data = array())
	{
		global $phpbb_dispatcher, $request, $user, $phpbb_root_path, $phpEx;

		$table_prefix = 'phpbb_';
		$tables = array(
			'mapper_tables'	=> array(
				'menus'	=> $table_prefix . 'sm_menus',
				'items'	=> $table_prefix . 'sm_menu_items'
			)
		);

		$db = $this->new_dbal();
		$request = $this->getMock('\phpbb\request\request_interface');

		$cache = new \phpbb_mock_cache();
		$config = new \phpbb\config\config(array());
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$translator = new \phpbb\language\language($lang_loader);

		$user = new \phpbb\user($translator, '\phpbb\datetime');
		$user->host = 'www.example.com';
		$user->page = $page_data;
		$user->page['root_script_path'] = '/phpBB/';
		$user->style = array (
			'style_name' => 'prosilver',
			'style_path' => 'prosilver',
		);

		$this->template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$temp_data = array();
		$this->template->expects($this->any())
			->method('alter_block_array')
			->will($this->returnCallback(function($key, $data) use (&$temp_data) {
				$temp_data[$key][] = $data;
			}));
		$this->template->expects($this->any())
			->method('assign_display')
			->will($this->returnCallback(function($block) use (&$temp_data) {
				return $temp_data;
			}));

		$mapper_factory = new mapper_factory($config, $db, $tables);

		$tree = new display($db, $this->template, $user, $tables['mapper_tables']['items'], 'item_id');

		$filesystem = new \phpbb\filesystem\filesystem();

		$path_helper = new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			$filesystem,
			$request,
			$phpbb_root_path,
			$phpEx
		);

		$container = new \phpbb_mock_container_builder();
		$cache_path = $phpbb_root_path . 'cache/twig';
		$context = new \phpbb\template\context();
		$loader = new \phpbb\template\twig\loader(new \phpbb\filesystem\filesystem(), '');
		$twig = new \phpbb\template\twig\environment(
			$config,
			$filesystem,
			$path_helper,
			$container,
			$cache_path,
			null,
			$loader,
			array(
				'cache'			=> false,
				'debug'			=> false,
				'auto_reload'	=> true,
				'autoescape'	=> false,
			)
		);
		$ptemplate = new template($path_helper, $config, $context, $twig, $cache_path, $user, array(new \phpbb\template\twig\extension($context, $user)));
		$container->set('template.twig.lexer', new \phpbb\template\twig\lexer($twig));

		$ptemplate->set_custom_style('prosilver', $phpbb_root_path . 'ext/blitze/sitemaker/styles/prosilver');

		$block = new menu($cache, $config, $translator, $mapper_factory, $tree);
		$block->set_template($ptemplate);

		return $block;
	}

	public function test_block_config()
	{
		$block = $this->get_block();
		$config = $block->get_config(array());

		$expected_keys = array(
			'legend1',
			'menu_id',
			'expanded',
			'max_depth',
		);

		$this->assertEquals($expected_keys, array_keys($config));
	}

	/**
	 * Data set for test_block_display
	 *
	 * @return array
	 */
	public function block_test_data()
	{
		return array(
			array(
				array(),
				array(
					'settings' => array(
						'menu_id' => 0,
						'expanded' => 0,
						'max_depth' => 3,
					),
				),
				false,
				'',
				array(),
			),
			array(
				array(),
				array(
					'settings' => array(
						'menu_id' => 0,
						'expanded' => 0,
						'max_depth' => 3,
					),
				),
				true,
				'SELECT_MENU',
				array(),
			),
			array(
				array(),
				array(
					'settings' => array(
						'menu_id' => 2,
						'expanded' => 0,
						'max_depth' => 3,
					),
				),
				false,
				'',
				array(),
			),
			array(
				array(),
				array(
					'settings' => array(
						'menu_id' => 2,
						'expanded' => 0,
						'max_depth' => 3,
					),
				),
				true,
				'MENU_NO_ITEMS',
				array(),
			),
			array(
				array(
					'page_name' => 'faq.php',
					'query_string' => '',
				),
				array(
					'settings' => array(
						'menu_id' => 1,
						'expanded' => 0,
						'max_depth' => 3,
					),
				),
				false,
				'<nav>' .
					'<ul class="sm-list fa-ul">' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/index.php"><i class="fa fa-home fa-fw"></i>Home</a>' .
						'</li>' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/app.php/page/content/"><i class="fa-fw"></i>Content</a>' .
						'</li>' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/app.php/page/about"><i class="fa-fw"></i>About Us</a>' .
						'</li>' .
					'</ul>' .
				'</nav>',
				array(),
			),
			array(
				array(
					'page_name' => 'index.php',
					'query_string' => '',
				),
				array(
					'settings' => array(
						'menu_id' => 1,
						'expanded' => 0,
						'max_depth' => 3,
					),
				),
				false,
				'<nav>' .
					'<ul class="sm-list fa-ul">' .
						'<li class="active">' .
							'<a href="http://www.example.com/phpBB/index.php"><i class="fa fa-home fa-fw"></i>Home</a>' .
						'</li>' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/app.php/page/content/"><i class="fa-fw"></i>Content</a>' .
						'</li>' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/app.php/page/about"><i class="fa-fw"></i>About Us</a>' .
						'</li>' .
					'</ul>' .
				'</nav>',
				array(),
			),
			array(
				array(
					'page_name' => 'app.php/page/USA',
					'query_string' => '',
				),
				array(
					'settings' => array(
						'menu_id' => 1,
						'expanded' => 0,
						'max_depth' => 3,
					),
				),
				false,
				'<nav>' .
					'<ul class="sm-list fa-ul">' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/index.php"><i class="fa fa-home fa-fw"></i>Home</a>' .
						'</li>' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/app.php/page/content/"><i class="fa-fw"></i>Content</a>' .
							'<ul class="sm-list fa-ul">' .
								'<li>' .
									'<a href="http://www.example.com/phpBB/app.php/page/news"><i class="fa-fw"></i>News</a>' .
									'<ul class="sm-list fa-ul">' .
										'<li class="active">' .
											'<a href="http://www.example.com/phpBB/app.php/page/USA"><i class="fa-fw"></i>USA</a>' .
											'<ul class="sm-list fa-ul">' .
												'<li>' .
													'<a href="http://www.example.com/phpBB/viewtopic.php?f=1&t=2"><i class="fa-fw"></i>Business</a>' .
												'</li>' .
											'</ul>' .
										'</li>' .
									'</ul>' .
								'</li>' .
								'<li>' .
									'<a href="http://www.example.com/phpBB/app.php/content/articles" target="_blank" rel="noopener" rel="noreferrer"><i class="fa-fw"></i>Articles</a>' .
								'</li>' .
							'</ul>' .
						'</li>' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/app.php/page/about"><i class="fa-fw"></i>About Us</a>' .
						'</li>' .
					'</ul>' .
				'</nav>',
				array(
					'navlinks' => array(
						array(
							'FORUM_NAME' => 'News',
							'U_VIEW_FORUM' => 'http://www.example.com/phpBB/app.php/page/news',
						),
						array(
							'FORUM_NAME' => 'Content',
							'U_VIEW_FORUM' => 'http://www.example.com/phpBB/app.php/page/content/',
						),
					),
				),
			),
			array(
				array(
					'page_name' => 'viewtopic.php',
					'query_string' => 'f=1&t=2',
				),
				array(
					'settings' => array(
						'menu_id' => 1,
						'expanded' => 0,
						'max_depth' => 3,
					),
				),
				false,
				'<nav>' .
					'<ul class="sm-list fa-ul">' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/app.php/page/news"><i class="fa-fw"></i>News</a>' .
							'<ul class="sm-list fa-ul">' .
								'<li>' .
									'<a href="http://www.example.com/phpBB/app.php/page/USA"><i class="fa-fw"></i>USA</a>' .
									'<ul class="sm-list fa-ul">' .
										'<li class="active">' .
											'<a href="http://www.example.com/phpBB/viewtopic.php?f=1&t=2"><i class="fa-fw"></i>Business</a>' .
											'<ul class="sm-list fa-ul">' .
												'<li>' .
													'<a href="http://www.example.com/phpBB/app.php/page/startups"><i class="fa-fw"></i>Startups</a>' .
												'</li>' .
											'</ul>' .
										'</li>' .
									'</ul>' .
								'</li>' .
							'</ul>' .
						'</li>' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/app.php/content/articles" target="_blank" rel="noopener" rel="noreferrer"><i class="fa-fw"></i>Articles</a>' .
						'</li>' .
					'</ul>' .
				'</nav>',
				array(
					'navlinks' => array(
						array(
							'FORUM_NAME' => 'USA',
							'U_VIEW_FORUM' => 'http://www.example.com/phpBB/app.php/page/USA',
						),
						array(
							'FORUM_NAME' => 'News',
							'U_VIEW_FORUM' => 'http://www.example.com/phpBB/app.php/page/news',
						),
						array(
							'FORUM_NAME' => 'Content',
							'U_VIEW_FORUM' => 'http://www.example.com/phpBB/app.php/page/content/',
						),
					),
				),
			),
			array(
				array(
					'page_name' => 'index.php',
					'query_string' => '',
				),
				array(
					'settings' => array(
						'menu_id' => 1,
						'expanded' => 1,
						'max_depth' => 3,
					),
				),
				false,
				'<nav>' .
					'<ul class="sm-list fa-ul">' .
						'<li class="active">' .
							'<a href="http://www.example.com/phpBB/index.php"><i class="fa fa-home fa-fw"></i>Home</a>' .
						'</li>' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/app.php/page/content/"><i class="fa-fw"></i>Content</a>' .
							'<ul class="sm-list fa-ul">' .
								'<li>' .
									'<a href="http://www.example.com/phpBB/app.php/page/news"><i class="fa-fw"></i>News</a>' .
									'<ul class="sm-list fa-ul">' .
										'<li>' .
											'<a href="http://www.example.com/phpBB/app.php/page/USA"><i class="fa-fw"></i>USA</a>' .
											'<ul class="sm-list fa-ul">' .
												'<li>' .
													'<a href="http://www.example.com/phpBB/viewtopic.php?f=1&t=2"><i class="fa-fw"></i>Business</a>' .
												'</li>' .
											'</ul>' .
										'</li>' .
									'</ul>' .
								'</li>' .
								'<li>' .
									'<a href="http://www.example.com/phpBB/app.php/content/articles" target="_blank" rel="noopener" rel="noreferrer"><i class="fa-fw"></i>Articles</a>' .
								'</li>' .
							'</ul>' .
						'</li>' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/app.php/page/about"><i class="fa-fw"></i>About Us</a>' .
						'</li>' .
					'</ul>' .
				'</nav>',
				array(),
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 */
	public function test_block_display($page_data, $bdata, $editing, $expected_list, $expected_breadcrumb)
	{
		$block = $this->get_block($page_data);
		$result = $block->display($bdata, $editing);

		$this->assertEquals($expected_list, str_replace(array("\n", "\t", "  "), '', $result['content']));
		$this->assertEquals($expected_breadcrumb, $this->template->assign_display('navlinks'));
	}
}
