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
	protected $twig;

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
	 * Create the links block
	 *
	 * @return \blitze\sitemaker\blocks\menu
	 */
	protected function get_block()
	{
		global $symfony_request, $phpbb_admin_path, $phpbb_root_path;

		$symfony_request = new Request();

		$table_prefix = 'phpbb_';
		$tables = array(
			'mapper_tables'	=> array(
				'menus'	=> $table_prefix . 'sm_menus',
				'items'	=> $table_prefix . 'sm_menu_items'
			)
		);

		$loader = new \Twig\Loader\FilesystemLoader($phpbb_root_path . 'styles');
		$loader->addPath($phpbb_root_path . 'ext/blitze/sitemaker/styles/all/template', 'blitze_sitemaker');
		$this->twig = new \Twig\Environment($loader, ['debug' => true]);

		$mapper_factory = new mapper_factory($this->config, $this->db, $tables);

		$tree = new display($this->db, $this->user, $tables['mapper_tables']['items'], 'item_id');

		$navbar = $this->getMockBuilder('\blitze\sitemaker\services\navbar')
			->disableOriginalConstructor()
			->getMock();

		$navigation = new navigation($this->cache, $this->user, $mapper_factory, $navbar, $tree, $phpbb_admin_path, $this->php_ext);

		return new links($this->translator, $navigation);
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
	 * @return void
	 */
	public function test_block_template()
	{
		$block = $this->get_block();

		$this->assertEquals('@blitze_sitemaker/blocks/lists.html', $block->get_template());
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
				'<aside>' .
					'<ul class="sm-list fa-ul">' .
					'<li>' .
					'<a href="http://www.example.com/phpBB/app.php/page/item-1"><i class="fa-fw" aria-hidden="true"></i>Item 1</a>' .
					'<ul class="sm-list fa-ul">' .
					'<li>' .
					'<a href="http://www.example.com/phpBB/app.php/page/item-2"><i class="fa-fw" aria-hidden="true"></i>Item 2</a>' .
					'<ul class="sm-list fa-ul">' .
					'<li><a href="http://www.example.com/phpBB/app.php/page/item-3"><i class="fa-fw" aria-hidden="true"></i>Item 3</a></li>' .
					'</ul>' .
					'</li>' .
					'</ul>' .
					'</li>' .
					'</ul>' .
					'</aside>'
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
