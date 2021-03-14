<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks\config\fields;

use blitze\sitemaker\services\blocks\config\fields\checkbox;

class checkbox_test extends cfg_test_base
{
	/**
	 * @return \blitze\sitemaker\services\blocks\config\fields\checkbox
	 */
	protected function get_service()
	{
		return new checkbox($this->translator);
	}

	/**
	 */
	public function test_name()
	{
		$cfg_fields = $this->get_service();
		$this->assertEquals('checkbox', $cfg_fields->get_name());
	}

	/**
	 */
	public function test_template()
	{
		$cfg_fields = $this->get_service();
		$this->assertEquals('@blitze_sitemaker/cfg_fields/checkbox.html', $cfg_fields->get_template());
	}

	/**
	 * Data set for test_build_checkbox
	 *
	 * @return array
	 */
	public function build_checkbox_test_data()
	{
		return array(
			array(
				array(),
				'',
				'topic_ids',
				'',
				array(
					'field' => 'topic_ids',
					'selected' => [''],
					'columns' => [[]],
					'class' => '',
					'sortable' => '',
				)
			),
			array(
				array(),
				'',
				'topic_ids',
				true,
				array(
					'field' => 'topic_ids',
					'selected' => [''],
					'columns' => [[]],
					'class' => '',
					'sortable' => true,
				)
			),
			array(
				array(
					'option1'	=> 'Option #1',
					'option2'	=> 'Option #2',
					'option3'	=> 'Option #3',
				),
				'option2',
				'topic_ids',
				false,
				array(
					'field' => 'topic_ids',
					'selected' => ['option2'],
					'columns' => array(
						array(
							'option1' => 'Option #1',
							'option2' => 'Option #2',
							'option3' => 'Option #3',
						),
					),
					'class' => '',
					'sortable' => false,
				)
			),
			array(
				array(
					'option1'	=> 'Option #1',
					'option2'	=> 'Option #2',
					'option3'	=> 'Option #3',
				),
				'option2',
				'topic_ids',
				true,
				array(
					'field' => 'topic_ids',
					'selected' => ['option2'],
					'columns' => array(
						array(
							'option1' => 'Option #1',
							'option2' => 'Option #2',
							'option3' => 'Option #3',
						),
					),
					'class' => '',
					'sortable' => true,
				),
			),
			array(
				array(
					'news' => array(
						'news_field1' => 'News Label 1',
						'news_field2' => 'News Label 2',
					),
					'articles' => array(
						'article_field1' => 'Article Label 1',
						'article_field2' => 'Article Label 2',
					),
				),
				['news_field1', 'article_field2'],
				'content_type',
				'',
				array(
					'field' => 'content_type',
					'selected' => ['news_field1', 'article_field2'],
					'columns' => array(
						'news' => array(
							'news_field1' => 'News Label 1',
							'news_field2' => 'News Label 2',
						),
						'articles' => array(
							'article_field1' => 'Article Label 1',
							'article_field2' => 'Article Label 2',
						),
					),
					'class' => 'col ',
					'sortable' => '',
				)
			),
			array(
				array(
					'news' => array(
						'news_field1' => 'News Label 1',
						'news_field2' => 'News Label 2',
					),
					'articles' => array(
						'article_field1' => 'Article Label 1',
						'article_field2' => 'Article Label 2',
					),
				),
				['news_field1', 'article_field2'],
				'content_type',
				true,
				array(
					'field' => 'content_type',
					'selected' => ['news_field1', 'article_field2'],
					'columns' => array(
						'news' => array(
							'news_field1' => 'News Label 1',
							'news_field2' => 'News Label 2',
						),
						'articles' => array(
							'article_field1' => 'Article Label 1',
							'article_field2' => 'Article Label 2',
						),
					),
					'class' => 'col ',
					'sortable' => true,
				),
			),
		);
	}

	/**
	 * Test the build_checkbox method
	 *
	 * @dataProvider build_checkbox_test_data
	 * @param array $option_ary
	 * @param string|array $selected_items
	 * @param string $key
	 * @param bool $sortable
	 * @param array $expected
	 */
	public function test_build_checkbox(array $option_ary, $selected_items, $key, $sortable, array $expected)
	{
		$cfg_fields = $this->get_service();
		$result = $cfg_fields->build_checkbox($option_ary, $selected_items, $key, $sortable);

		$this->assertEquals($expected, $result);
	}
}
