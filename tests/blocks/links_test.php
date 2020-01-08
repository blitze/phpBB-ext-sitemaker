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
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/links.xml');
	}

	/**
	 * Create the menu block
	 *
	 * @param array $page_data
	 * @return \blitze\sitemaker\blocks\menu
	 */
	protected function get_block($page_data = array())
	{
		global $symfony_request;

		$symfony_request = new Request();

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

		$tree = new display($this->db, $this->user, $tables['mapper_tables']['items'], 'item_id');

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
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
		$template_context = new \phpbb\template\context();
		$template_loader = new \phpbb\template\twig\loader(new \phpbb\filesystem\filesystem(), '');
		$twig = new \phpbb\template\twig\environment(
			$this->config,
			$filesystem,
			$path_helper,
			$cache_path,
			null,
			$template_loader,
			$phpbb_dispatcher,
			array(
				'cache'			=> false,
				'debug'			=> false,
				'auto_reload'	=> true,
				'autoescape'	=> false,
			)
		);

		$ptemplate = new template($path_helper, $this->config, $template_context, $twig, $cache_path, $this->user, array(new \phpbb\template\twig\extension($template_context, $twig, $this->user)));
		$twig->setLexer(new \phpbb\template\twig\lexer($twig));

		$ptemplate->set_custom_style('all', $this->phpbb_root_path . 'ext/blitze/sitemaker/styles/all');

		$navigation = new navigation($this->cache, $mapper_factory, $tree, $this->php_ext);

		$block = new links($this->translator, $navigation);
		$block->set_template($ptemplate);

		return $block;
	}

	/**
	 * @return void
	 */
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
						'<a href="http://www.example.com/phpBB/app.php/page/item-1"><i class="fa-fw" aria-hidden="true"></i>Item 1</a>' .
						'<ul class="sm-list fa-ul">' .
							'<li>' .
								'<a href="http://www.example.com/phpBB/app.php/page/item-2"><i class="fa-fw" aria-hidden="true"></i>Item 2</a>' .
								'<ul class="sm-list fa-ul">' .
									'<li>' .
										'<a href="http://www.example.com/phpBB/app.php/page/item-3"><i class="fa-fw" aria-hidden="true"></i>Item 3</a>' .
									'</li>' .
								'</ul>' .
							'</li>' .
						'</ul>' .
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
