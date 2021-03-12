<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use Symfony\Component\HttpFoundation\Request;
use blitze\sitemaker\model\mapper_factory;
use blitze\sitemaker\services\template;
use blitze\sitemaker\services\menus\display;
use blitze\sitemaker\services\menus\navigation;
use blitze\sitemaker\blocks\menu;

class menu_test extends blocks_base
{
	protected $twig;

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
		global $symfony_request, $user, $phpbb_root_path;

		$symfony_request = new Request();

		$table_prefix = 'phpbb_';
		$tables = array(
			'mapper_tables'	=> array(
				'menus'	=> $table_prefix . 'sm_menus',
				'items'	=> $table_prefix . 'sm_menu_items'
			)
		);

		$this->user->page = array_merge($this->user->page, $page_data);
		$this->user->style = array(
			'style_name' => 'all',
			'style_path' => 'all',
		);

		$loader = new \Twig\Loader\FilesystemLoader($phpbb_root_path . 'styles');
		$loader->addPath($phpbb_root_path . 'ext/blitze/sitemaker/styles/all/template', 'blitze_sitemaker');
		$this->twig = new \Twig\Environment($loader, ['debug' => true]);

		$mapper_factory = new mapper_factory($this->config, $this->db, $tables);

		$tree = new display($this->db, $this->user, $tables['mapper_tables']['items'], 'item_id');

		$navbar = $this->getMockBuilder('\blitze\sitemaker\services\navbar')
			->disableOriginalConstructor()
			->getMock();

		$navigation = new navigation($this->cache, $mapper_factory, $navbar, $tree, $this->php_ext);

		return new menu($this->translator, $navigation);
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
	 * @return void
	 */
	public function test_block_template()
	{
		$block = $this->get_block();

		$this->assertEquals('@blitze_sitemaker/blocks/lists.html', $block->get_template());
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
					'</nav>'
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
					'<li><a href="http://www.example.com/phpBB/index.php"><i class="fa fa-home fa-fw" aria-hidden="true"></i>Home</a></li>' .
					'<li>' .
					'<a href="http://www.example.com/phpBB/app.php/page/content/"><i class="fa-fw" aria-hidden="true"></i>Content</a>' .
					'<ul class="sm-list fa-ul">' .
					'<li>' .
					'<a href="http://www.example.com/phpBB/app.php/page/news"><i class="fa-fw" aria-hidden="true"></i>News</a>' .
					'<ul class="sm-list fa-ul">' .
					'<li class="active">' .
					'<a href="http://www.example.com/phpBB/app.php/page/USA"><i class="fa-fw" aria-hidden="true"></i>USA</a>' .
					'<ul class="sm-list fa-ul">' .
					'<li><a href="http://www.example.com/phpBB/viewtopic.php?f=1&amp;t=2"><i class="fa-fw" aria-hidden="true"></i>Business</a></li>' .
					'</ul>' .
					'</li>' .
					'</ul>' .
					'</li>' .
					'<li><a href="http://www.example.com/phpBB/app.php/content/articles" target="_blank" rel="noopener"><i class="fa-fw" aria-hidden="true"></i>Articles</a></li>' .
					'</ul>' .
					'</li>' .
					'<li><a href="http://www.example.com/phpBB/app.php/page/about"><i class="fa-fw" aria-hidden="true"></i>About Us</a></li>' .
					'</ul>' .
					'</nav>',
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
					'<a href="http://www.example.com/phpBB/viewtopic.php?f=1&amp;t=2"><i class="fa-fw" aria-hidden="true"></i>Business</a>' .
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
					'<li><a href="http://www.example.com/phpBB/app.php/content/articles" target="_blank" rel="noopener"><i class="fa-fw" aria-hidden="true"></i>Articles</a></li>' .
					'</ul>' .
					'</nav>',
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
					'<li class="active"><a href="http://www.example.com/phpBB/index.php"><i class="fa fa-home fa-fw" aria-hidden="true"></i>Home</a></li>' .
					'<li>' .
					'<a href="http://www.example.com/phpBB/app.php/page/content/"><i class="fa-fw" aria-hidden="true"></i>Content</a>' .
					'<ul class="sm-list fa-ul">' .
					'<li>' .
					'<a href="http://www.example.com/phpBB/app.php/page/news"><i class="fa-fw" aria-hidden="true"></i>News</a>' .
					'<ul class="sm-list fa-ul">' .
					'<li>' .
					'<a href="http://www.example.com/phpBB/app.php/page/USA"><i class="fa-fw" aria-hidden="true"></i>USA</a>' .
					'<ul class="sm-list fa-ul">' .
					'<li><a href="http://www.example.com/phpBB/viewtopic.php?f=1&amp;t=2"><i class="fa-fw" aria-hidden="true"></i>Business</a></li>' .
					'</ul>' .
					'</li>' .
					'</ul>' .
					'</li>' .
					'<li><a href="http://www.example.com/phpBB/app.php/content/articles" target="_blank" rel="noopener"><i class="fa-fw" aria-hidden="true"></i>Articles</a></li>' .
					'</ul>' .
					'</li>' .
					'<li><a href="http://www.example.com/phpBB/app.php/page/about"><i class="fa-fw" aria-hidden="true"></i>About Us</a></li>' .
					'</ul>' .
					'</nav>',
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
					'<li><a href="#"><i class="fa-fw" aria-hidden="true"></i>Item 2</a></li>' .
					'</ul>' .
					'</li>' .
					'</ul>' .
					'</nav>',
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
					'<a href="http://www.example.com/phpBB/faq.php" target="_blank" rel="noopener"><i class="fa-fw" aria-hidden="true"></i>Item 1</a>' .
					'<ul class="sm-list fa-ul">' .
					'<li><a href="#"><i class="fa-fw" aria-hidden="true"></i>Item 2</a></li>' .
					'</ul>' .
					'</li>' .
					'</ul>' .
					'</nav>',
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
					'<li><a href="#"><i class="fa-fw" aria-hidden="true"></i>Item 2</a></li>' .
					'</ul>' .
					'</li>' .
					'</ul>' .
					'</nav>',
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
	 * @param mixed $expected
	 */
	public function test_menu_block_display(array $page_data, array $bdata, $editing, $expected)
	{
		$block = $this->get_block($page_data);
		$result = $block->display($bdata, $editing);

		if (isset($result['data']))
		{
			$html = $this->twig->render($block->get_template(), $result['data']);
			$content = str_replace(array("\n", "\t", "  "), '', $html);
		}
		else
		{
			$content = $result['content'];
		}

		$this->assertEquals($expected, $content);
	}
}
