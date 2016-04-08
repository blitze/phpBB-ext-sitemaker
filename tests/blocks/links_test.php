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
use blitze\sitemaker\blocks\links;

class links_test extends blocks_base
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
			'style_name' => 'prosilver',
			'style_path' => 'prosilver',
		);

		$mapper_factory = new mapper_factory($this->config, $this->db, $tables);

		$tree = new display($this->db, $this->template, $this->user, $tables['mapper_tables']['items'], 'item_id');

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

		$cache_path = $this->phpbb_root_path . 'cache/twig';
		$template_context = new \phpbb\template\context();
		$template_loader = new \phpbb\template\twig\loader(new \phpbb\filesystem\filesystem(), '');
		$twig = new \phpbb\template\twig\environment(
			$this->config,
			$filesystem,
			$path_helper,
			$this->phpbb_container,
			$cache_path,
			null,
			$template_loader,
			array(
				'cache'			=> false,
				'debug'			=> false,
				'auto_reload'	=> true,
				'autoescape'	=> false,
			)
		);
		$ptemplate = new template($path_helper, $this->config, $template_context, $twig, $cache_path, $this->user, array(new \phpbb\template\twig\extension($template_context, $this->user)));
		$this->phpbb_container->set('template.twig.lexer', new \phpbb\template\twig\lexer($twig));

		$ptemplate->set_custom_style('prosilver', $this->phpbb_root_path . 'ext/blitze/sitemaker/styles/prosilver');

		$block = new links($this->cache, $this->config, $this->translator, $mapper_factory, $tree);
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
				array(
					'settings' => array(
						'menu_id' => 0,
					),
				),
				false,
				'',
			),
			array(
				array(
					'settings' => array(
						'menu_id' => 0,
					),
				),
				true,
				'SELECT_MENU',
			),
			array(
				array(
					'settings' => array(
						'menu_id' => 2,
					),
				),
				false,
				'',
			),
			array(
				array(
					'settings' => array(
						'menu_id' => 2,
					),
				),
				true,
				'MENU_NO_ITEMS',
			),
			array(
				array(
					'settings' => array(
						'menu_id' => 1,
					),
				),
				false,
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
									'<li>' .
										'<a href="http://www.example.com/phpBB/app.php/page/USA"><i class="fa-fw"></i>USA</a>' .
										'<ul class="sm-list fa-ul">' .
											'<li>' .
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
					'</li>' .
					'<li>' .
						'<a href="http://www.example.com/phpBB/app.php/page/about"><i class="fa-fw"></i>About Us</a>' .
					'</li>' .
				'</ul>',
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 * @param array $bdata
	 * @param bool $editing
	 * @param mixed $expected
	 */
	public function test_block_display(array $bdata, $editing, $expected)
	{
		$block = $this->get_block();
		$result = $block->display($bdata, $editing);

		$this->assertEquals($expected, str_replace(array("\n", "\t", "  "), '', $result['content']));
	}
}
