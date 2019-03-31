<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use phpbb\request\request_interface;
use blitze\sitemaker\blocks\feeds;

require_once dirname(__FILE__) . '/../../vendor/simplepie/simplepie/autoloader.php';

class feeds_test extends blocks_base
{
	/**
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/users.xml');
	}

	/**
	 * Create the feeds block
	 *
	 * @param array $variable_map
	 * @return \blitze\sitemaker\blocks\feeds
	 */
	protected function get_block($variable_map = array())
	{
		$this->request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap($variable_map));

		$this->translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$this->translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode('-', func_get_args());
			});

		$this->feeds = $this->getMockBuilder('\blitze\sitemaker\services\feeds\Feed')
			->getMock();

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

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

		$block = new feeds($this->translator, $this->request, $twig, $this->phpbb_root_path . 'cache/production/');
		$block->set_template($this->ptemplate);

		return $block;
	}

	public function test_block_config()
	{
		$block = $this->get_block();
		$config = $block->get_config(array());

		$expected_keys = array(
			'legend1',
			'feeds',
			'max',
			'cache',
			'template',
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
				false,
				array(
					'feeds'		=> [],
					'max'		=> 3,
					'template'	=> '',
				),
				'',
			),
			array(
				true,
				array(
					'feeds'		=> [],
					'max'		=> 3,
					'template'	=> '',
				),
				'FEED_URL_MISSING',
			),
			array(
				false,
				array(
					'feeds'		=> ['https://www.nasa.gov/rss/dyn/lg_image_of_the_day.rss'],
					'max'		=> 2,
					'template'	=> '<p>{{ item.title </p>',
				),
				'',
			),
			array(
				true,
				array(
					'feeds'		=> ['https://www.nasa.gov/rss/dyn/lg_image_of_the_day.rss'],
					'max'		=> 2,
					'template'	=> '<p>{{ item.title </p>',
				),
				'Unexpected token "operator" of value "/" in "__string_template__b00b7a3c2b740866fc9be8b17037943bfd4084a5bf8ca2daf6f6fe4ad561f493" at line 4.',
			),
			array(
				false,
				array(
					'feeds'		=> ['https://www.nasa.gov/rss/dyn/lg_image_of_the_day.rss'],
					'max'		=> 2,
					'template'	=> '
{% if item.title %}
	Item title {{ loop.index }}
	source: {{ item.feed.title }}
{% endif %}
',
				),
				'<ul class="sm-list">' .
					'<li>' .
						'Item title 1' .
						'source: NASA Image of the Day' .
					'</li>' .
					'<li>' .
						'Item title 2' .
						'source: NASA Image of the Day' .
					'</li>' .
				'</ul>',
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 * @param bool $edit_mode
	 * @param array $config
	 * @param string $expected
	 */
	public function test_block_display($edit_mode, array $config, $expected)
	{
		$block = $this->get_block();

		$result = $block->display(array('settings' => $config), $edit_mode);

		if (version_compare(PHP_VERSION, '5.6.0') < 0 && $edit_mode)
		{
			$this->feeds->expects($this->exactly(0))
				->method('set_feed_url');
			$this->assertEquals('PHP_VERSION_NOT_MET_FOR_BLOCK-5.6.0-' . PHP_VERSION, $result['content']);
		}
		else
		{
			$this->assertEquals($expected, str_replace(array("\n", "\t", "  "), '', $result['content']));
		}
	}

	/**
	 * Data set for test_get_fields
	 *
	 * @return array
	 */
	public function get_feeds_ui_data()
	{
		return array(
			array(
				'',
				array(),
				array(),
			),
			array(
				'<p>{{ item.title }}</p>',
				array('foo.xml', 'bar.rss'),
				array(
					'feeds'		=> array('foo.xml', 'bar.rss'),
					'template'	=> '<p>{{ item.title }}</p>',
				),
			),
		);
	}

	/**
	 * Test saving custom content
	 *
	 * @dataProvider get_feeds_ui_data
	 * @param string $template
	 * @param array $feeds
	 * @param arrau $expected
	 */
	public function test_get_feeds_ui($template, array $feeds, array $expected)
	{
		$block = $this->get_block();
		$result = $block->get_feeds_ui($feeds, $template);

		$this->assertEquals($expected, array_filter($result));
	}

	/**
	 * Data set for test_get_fields
	 *
	 * @return array
	 */
	public function get_fields_data()
	{
		return array(
			array(
				array(
					array('feeds', array(0 => ''), false, request_interface::REQUEST, array()),
				),
				array(
					'fields' => array(
						'items' => array(
							'text' => 'items',
							'displayText' => 'ITEMS',
							'children' => array(),
						),
					),
				),
			),
			array(
				array(
					array('feeds', array(0 => ''), false, request_interface::REQUEST, array('https://www.phpbb.com/community/feed')),
				),
				array(
					'fields' => array(
						'items' => array(
							'text' => 'items',
							'displayText' => 'ITEMS',
							'children' => array(
								'feed' => array(
									'text' => 'feed',
									'displayText' => 'FEED',
									'children' => array(
										'title' => array(
											'text' => 'title',
											'displayText' => 'TITLE',
											'children' => array(),
										),
										'description' => array(
											'text' => 'description',
											'displayText' => 'DESCRIPTION',
											'children' => array(),
										),
										'author' => array(
											'text' => 'author',
											'displayText' => 'AUTHOR',
											'children' => array(
												'name' => array(
													'text' => 'name',
													'displayText' => 'NAME',
													'children' => array(),
												),
											),
										),
										'authors' => array(
											'text' => 'authors',
											'displayText' => 'AUTHORS',
											'children' => array(
												0 => array(
													'text' => '0',
													'displayText' => '0',
													'children' => array(
														'name' => array(
															'text' => 'name',
															'displayText' => 'NAME',
															'children' => array(),
														),
													),
												),
											),
										),
										'permalink' => array(
											'text' => 'permalink',
											'displayText' => 'PERMALINK',
											'children' => array(),
										),
										'link' => array(
											'text' => 'link',
											'displayText' => 'LINK',
											'children' => array(),
										),
										'links' => array(
											'text' => 'links',
											'displayText' => 'LINKS',
											'children' => array(),
										),
									),
								),
								'id' => array(
									'text' => 'id',
									'displayText' => 'ID',
									'children' => array(),
								),
								'title' => array(
									'text' => 'title',
									'displayText' => 'TITLE',
									'children' => array(),
								),
								'description' => array(
									'text' => 'description',
									'displayText' => 'DESCRIPTION',
									'children' => array(),
								),
								'content' => array(
									'text' => 'content',
									'displayText' => 'CONTENT',
									'children' => array(),
								),
								'category' => array(
									'text' => 'category',
									'displayText' => 'CATEGORY',
									'children' => array(
										'label' => array(
											'text' => 'label',
											'displayText' => 'LABEL',
											'children' => array(),
										),
										'scheme' => array(
											'text' => 'scheme',
											'displayText' => 'SCHEME',
											'children' => array(),
										),
										'term' => array(
											'text' => 'term',
											'displayText' => 'TERM',
											'children' => array(),
										),
										'type' => array(
											'text' => 'type',
											'displayText' => 'TYPE',
											'children' => array(),
										),
									),
								),
								'categories' => array(
									'text' => 'categories',
									'displayText' => 'CATEGORIES',
									'children' => array(
										0 => array(
											'text' => '0',
											'displayText' => '0',
											'children' => array(
												'label' => array(
													'text' => 'label',
													'displayText' => 'LABEL',
													'children' => array(),
												),
												'scheme' => array(
													'text' => 'scheme',
													'displayText' => 'SCHEME',
													'children' => array(),
												),
												'term' => array(
													'text' => 'term',
													'displayText' => 'TERM',
													'children' => array(),
												),
												'type' => array(
													'text' => 'type',
													'displayText' => 'TYPE',
													'children' => array(),
												),
											),
										),
									),
								),
								'author' => array(
									'text' => 'author',
									'displayText' => 'AUTHOR',
									'children' => array(
										'name' => array(
											'text' => 'name',
											'displayText' => 'NAME',
											'children' => array(),
										),
									),
								),
								'authors' => array(
									'text' => 'authors',
									'displayText' => 'AUTHORS',
									'children' => array(
										0 => array(
											'text' => '0',
											'displayText' => '0',
											'children' => array(
												'name' => array(
													'text' => 'name',
													'displayText' => 'NAME',
													'children' => array(),
												),
											),
										),
									),
								),
								'date' => array(
									'text' => 'date',
									'displayText' => 'DATE',
									'children' => array(),
								),
								'updated_date' => array(
									'text' => 'updated_date',
									'displayText' => 'UPDATED_DATE',
									'children' => array(),
								),
								'gmdate' => array(
									'text' => 'gmdate',
									'displayText' => 'GMDATE',
									'children' => array(),
								),
								'updated_gmdate' => array(
									'text' => 'updated_gmdate',
									'displayText' => 'UPDATED_GMDATE',
									'children' => array(),
								),
								'permalink' => array(
									'text' => 'permalink',
									'displayText' => 'PERMALINK',
									'children' => array(),
								),
								'link' => array(
									'text' => 'link',
									'displayText' => 'LINK',
									'children' => array(),
								),
								'links' => array(
									'text' => 'links',
									'displayText' => 'LINKS',
									'children' => array(),
								),
								'enclosure' => array(
									'text' => 'enclosure',
									'displayText' => 'ENCLOSURE',
									'children' => array(
										'restrictions' => array(
											'text' => 'restrictions',
											'displayText' => 'RESTRICTIONS',
											'children' => array(
												0 => array(
													'text' => '0',
													'displayText' => '0',
													'children' => array(
														'relationship' => array(
															'text' => 'relationship',
															'displayText' => 'RELATIONSHIP',
															'children' => array(),
														),
														'value' => array(
															'text' => 'value',
															'displayText' => 'VALUE',
															'children' => array(),
														),
													),
												),
											),
										),
									),
								),
								'enclosures' => array(
									'text' => 'enclosures',
									'displayText' => 'ENCLOSURES',
									'children' => array(
										0 => array(
											'text' => '0',
											'displayText' => '0',
											'children' => array(
												'restrictions' => array(
													'text' => 'restrictions',
													'displayText' => 'RESTRICTIONS',
													'children' => array(
														0 => array(
															'text' => '0',
															'displayText' => '0',
															'children' => array(
																'relationship' => array(
																	'text' => 'relationship',
																	'displayText' => 'RELATIONSHIP',
																	'children' => array(),
																),
																'value' => array(
																	'text' => 'value',
																	'displayText' => 'VALUE',
																	'children' => array(),
																),
															),
														),
													),
												),
											),
										),
									),
								),
							),
						),
					),
				),
			),
		);
	}

	/**
	 * Test saving custom content
	 *
	 * @dataProvider get_fields_data
	 * @param array $variable_map
	 * @param array $expected
	 */
	public function test_get_fields(array $variable_map, array $expected)
	{
		$block = $this->get_block($variable_map);

		try
		{
			$result = $block->get_fields();
			$this->assertSame($expected['fields'], $result['fields']);
		}
		catch (\Exception $e)
		{
			$this->feeds->expects($this->exactly(0))
				->method('set_feed_url');

			if (version_compare(PHP_VERSION, '5.6.0') < 0)
			{
				$this->assertEquals('PHP_VERSION_NOT_MET_FOR_BLOCK-5.6.0-' . PHP_VERSION, $e->getMessage());
			}
		}
	}
}
