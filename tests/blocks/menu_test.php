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
	 * @param array $page_data
	 * @return \blitze\sitemaker\blocks\menu
	 */
	protected function get_block($page_data = array())
	{
		$table_prefix = 'phpbb_';
		$tables = array(
			'mapper_tables'	=> array(
				'menus'	=> $table_prefix . 'sm_menus',
				'items'	=> $table_prefix . 'sm_menu_items'
			)
		);

		$this->user->host = 'www.example.com';
		$this->user->page = $page_data;
		$this->user->page['root_script_path'] = '/phpBB/';
		$this->user->style = array (
			'style_name' => 'all',
			'style_path' => 'all',
		);

		$mapper_factory = new mapper_factory($this->config, $this->db, $tables);

		$tree = new display($this->db, $this->template, $this->user, $tables['mapper_tables']['items'], 'item_id', $this->php_ext);

		$filesystem = new \phpbb\filesystem\filesystem();

		$path_helper = new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			$filesystem,
			$this->request,
			$this->phpbb_root_path,
			$this->php_ext
		);

		$cache_path = $phpbb_root_path . 'cache/twig';
		$container = new \phpbb_mock_container_builder();
		$template_context = new \phpbb\template\context();
		$template_loader = new \phpbb\template\twig\loader(new \phpbb\filesystem\filesystem(), '');
		$twig = new \phpbb\template\twig\environment(
			$this->config,
			$filesystem,
			$path_helper,
			$cache_path,
			null,
			$template_loader,
			new \phpbb\event\dispatcher($container),
			array(
				'cache'			=> false,
				'debug'			=> false,
				'auto_reload'	=> true,
				'autoescape'	=> false,
			)
		);

		$ptemplate = new template($path_helper, $this->config, $template_context, $twig, $cache_path, $this->user, array(new \phpbb\template\twig\extension($template_context, $this->user)));
		$twig->setLexer(new \phpbb\template\twig\lexer($twig));

		$ptemplate->set_custom_style('all', $this->phpbb_root_path . 'ext/blitze/sitemaker/styles/all');

		$block = new menu($this->cache, $this->config, $this->translator, $mapper_factory, $tree, $this->php_ext);
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
	 * Data set for test_menu_block_display
	 *
	 * @return array
	 */
	public function menu_block_test_data()
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
					'page_dir' => '',
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
							'<a href="http://www.example.com/phpBB/index.php"><i class="fa fa-home fa-fw" aria-hidden="true"></i>Home</a>' .
						'</li>' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/app.php/page/content/"><i class="fa-fw" aria-hidden="true"></i>Content</a>' .
						'</li>' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/app.php/page/about"><i class="fa-fw" aria-hidden="true"></i>About Us</a>' .
						'</li>' .
					'</ul>' .
				'</nav>',
				array(),
			),
			array(
				array(
					'page_name' => 'index.php',
					'page_dir' => '',
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
							'<a href="http://www.example.com/phpBB/index.php"><i class="fa fa-home fa-fw" aria-hidden="true"></i>Home</a>' .
						'</li>' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/app.php/page/content/"><i class="fa-fw" aria-hidden="true"></i>Content</a>' .
						'</li>' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/app.php/page/about"><i class="fa-fw" aria-hidden="true"></i>About Us</a>' .
						'</li>' .
					'</ul>' .
				'</nav>',
				array(),
			),
			array(
				array(
					'page_name' => 'app.php/page/USA',
					'page_dir' => '',
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
							'<a href="http://www.example.com/phpBB/index.php"><i class="fa fa-home fa-fw" aria-hidden="true"></i>Home</a>' .
						'</li>' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/app.php/page/content/"><i class="fa-fw" aria-hidden="true"></i>Content</a>' .
							'<ul class="sm-list fa-ul">' .
								'<li>' .
									'<a href="http://www.example.com/phpBB/app.php/page/news"><i class="fa-fw" aria-hidden="true"></i>News</a>' .
									'<ul class="sm-list fa-ul">' .
										'<li class="active">' .
											'<a href="http://www.example.com/phpBB/app.php/page/USA"><i class="fa-fw" aria-hidden="true"></i>USA</a>' .
											'<ul class="sm-list fa-ul">' .
												'<li>' .
													'<a href="http://www.example.com/phpBB/viewtopic.php?f=1&t=2"><i class="fa-fw" aria-hidden="true"></i>Business</a>' .
												'</li>' .
											'</ul>' .
										'</li>' .
									'</ul>' .
								'</li>' .
								'<li>' .
									'<a href="http://www.example.com/phpBB/app.php/content/articles" target="_blank" rel="noopener" rel="noreferrer"><i class="fa-fw" aria-hidden="true"></i>Articles</a>' .
								'</li>' .
							'</ul>' .
						'</li>' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/app.php/page/about"><i class="fa-fw" aria-hidden="true"></i>About Us</a>' .
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
					'page_dir' => '',
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
							'<a href="http://www.example.com/phpBB/app.php/page/news"><i class="fa-fw" aria-hidden="true"></i>News</a>' .
							'<ul class="sm-list fa-ul">' .
								'<li>' .
									'<a href="http://www.example.com/phpBB/app.php/page/USA"><i class="fa-fw" aria-hidden="true"></i>USA</a>' .
									'<ul class="sm-list fa-ul">' .
										'<li class="active">' .
											'<a href="http://www.example.com/phpBB/viewtopic.php?f=1&t=2"><i class="fa-fw" aria-hidden="true"></i>Business</a>' .
											'<ul class="sm-list fa-ul">' .
												'<li>' .
													'<a href="http://www.example.com/phpBB/app.php/page/startups"><i class="fa-fw" aria-hidden="true"></i>Startups</a>' .
												'</li>' .
											'</ul>' .
										'</li>' .
									'</ul>' .
								'</li>' .
							'</ul>' .
						'</li>' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/app.php/content/articles" target="_blank" rel="noopener" rel="noreferrer"><i class="fa-fw" aria-hidden="true"></i>Articles</a>' .
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
					'page_dir' => '',
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
							'<a href="http://www.example.com/phpBB/index.php"><i class="fa fa-home fa-fw" aria-hidden="true"></i>Home</a>' .
						'</li>' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/app.php/page/content/"><i class="fa-fw" aria-hidden="true"></i>Content</a>' .
							'<ul class="sm-list fa-ul">' .
								'<li>' .
									'<a href="http://www.example.com/phpBB/app.php/page/news"><i class="fa-fw" aria-hidden="true"></i>News</a>' .
									'<ul class="sm-list fa-ul">' .
										'<li>' .
											'<a href="http://www.example.com/phpBB/app.php/page/USA"><i class="fa-fw" aria-hidden="true"></i>USA</a>' .
											'<ul class="sm-list fa-ul">' .
												'<li>' .
													'<a href="http://www.example.com/phpBB/viewtopic.php?f=1&t=2"><i class="fa-fw" aria-hidden="true"></i>Business</a>' .
												'</li>' .
											'</ul>' .
										'</li>' .
									'</ul>' .
								'</li>' .
								'<li>' .
									'<a href="http://www.example.com/phpBB/app.php/content/articles" target="_blank" rel="noopener" rel="noreferrer"><i class="fa-fw" aria-hidden="true"></i>Articles</a>' .
								'</li>' .
							'</ul>' .
						'</li>' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/app.php/page/about"><i class="fa-fw" aria-hidden="true"></i>About Us</a>' .
						'</li>' .
					'</ul>' .
				'</nav>',
				array(),
			),
			array(
				array(
					'page_name' => 'index.php',
					'page_dir' => '',
					'query_string' => '',
				),
				array(
					'settings' => array(
						'menu_id' => 4,
						'expanded' => 0,
						'max_depth' => 3,
					),
				),
				false,
				'<nav>' .
					'<ul class="sm-list fa-ul">' .
						'<li>' .
							'<a href="http://www.google.com"><i class="fa-fw" aria-hidden="true"></i>Item 1</a>' .
							'<ul class="sm-list fa-ul">' .
								'<li>' .
									'<a href="#"><i class="fa-fw" aria-hidden="true"></i>Item 2</a>' .
								'</li>' .
							'</ul>' .
						'</li>' .
					'</ul>' .
				'</nav>',
				array(),
			),
			array(
				array(
					'page_name' => 'index.php',
					'page_dir' => '',
					'query_string' => '',
				),
				array(
					'settings' => array(
						'menu_id' => 5,
						'expanded' => 0,
						'max_depth' => 3,
					),
				),
				false,
				'<nav>' .
					'<ul class="sm-list fa-ul">' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/faq.php" target="_blank" rel="noopener" rel="noreferrer"><i class="fa-fw" aria-hidden="true"></i>Item 1</a>' .
							'<ul class="sm-list fa-ul">' .
								'<li>' .
									'<a href="#"><i class="fa-fw" aria-hidden="true"></i>Item 2</a>' .
								'</li>' .
							'</ul>' .
						'</li>' .
					'</ul>' .
				'</nav>',
				array(),
			),
			array(
				array(
					'page_name' => 'index.php',
					'page_dir' => '',
					'query_string' => '',
				),
				array(
					'settings' => array(
						'menu_id' => 6,
						'expanded' => 0,
						'max_depth' => 3,
					),
				),
				false,
				'<nav>' .
					'<ul class="sm-list fa-ul">' .
						'<li>' .
							'<a href="http://www.example.com/phpBB/file.zip"><i class="fa-fw" aria-hidden="true"></i>Item 1</a>' .
							'<ul class="sm-list fa-ul">' .
								'<li>' .
									'<a href="#"><i class="fa-fw" aria-hidden="true"></i>Item 2</a>' .
								'</li>' .
							'</ul>' .
						'</li>' .
					'</ul>' .
				'</nav>',
				array(),
			),
		);
	}

	/**
	 * Test menu block display
	 *
	 * @dataProvider menu_block_test_data
	 * @param array $page_data
	 * @param array $bdata
	 * @param bool $editing
	 * @param string $expected_list
	 * @param array $expected_breadcrumb
	 */
	public function test_menu_block_display(array $page_data, array $bdata, $editing, $expected_list, $expected_breadcrumb)
	{
		$block = $this->get_block($page_data);
		$result = $block->display($bdata, $editing);

		$this->assertEquals($expected_list, str_replace(array("\n", "\t", "  "), '', $result['content']));
		$this->assertEquals($expected_breadcrumb, $this->template->assign_display('navlinks'));
	}
}
