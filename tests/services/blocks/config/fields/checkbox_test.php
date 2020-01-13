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
		return new checkbox($this->translator, $this->ptemplate);
	}

    /**
     */
	public function test_name()
	{
		$cfg_fields = $this->get_service();
		$this->assertEquals('checkbox', $cfg_fields->get_name());
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
				'<ul class="sm-list topic_ids-checkbox" id="topic_ids-col-0"></ul>'
			),
			array(
				array(),
				'',
				'topic_ids',
				true,
				'<ul class="sm-list topic_ids-checkbox sortable" id="topic_ids-col-0"></ul>'
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
				'<ul class="sm-list topic_ids-checkbox" id="topic_ids-col-0">' .
					'<li><label><input type="checkbox" name="config[topic_ids][]" value="option1" class="checkbox" /> Option #1</label></li>' .
					'<li><label><input type="checkbox" name="config[topic_ids][]" value="option2" checked="checked" class="checkbox" /> Option #2</label></li>' .
					'<li><label><input type="checkbox" name="config[topic_ids][]" value="option3" class="checkbox" /> Option #3</label></li>' .
				'</ul>'
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
				'<ul class="sm-list topic_ids-checkbox sortable" id="topic_ids-col-0">' .
					'<li><label><input type="checkbox" name="config[topic_ids][]" value="option1" class="checkbox" /> Option #1</label></li>' .
					'<li><label><input type="checkbox" name="config[topic_ids][]" value="option2" checked="checked" class="checkbox" /> Option #2</label></li>' .
					'<li><label><input type="checkbox" name="config[topic_ids][]" value="option3" class="checkbox" /> Option #3</label></li>' .
				'</ul>'
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
				'<div class="grid-noBottom_xs-1">' .
					'<ul class="sm-list col content_type-checkbox" id="content_type-col-news">' .
						'<li><label><input type="checkbox" name="config[content_type][]" value="news_field1" checked="checked" class="checkbox" /> News Label 1</label></li>' .
						'<li><label><input type="checkbox" name="config[content_type][]" value="news_field2" class="checkbox" /> News Label 2</label></li>' .
					'</ul>' .
					'<ul class="sm-list col content_type-checkbox" id="content_type-col-articles">' .
						'<li><label><input type="checkbox" name="config[content_type][]" value="article_field1" class="checkbox" /> Article Label 1</label></li>' .
						'<li><label><input type="checkbox" name="config[content_type][]" value="article_field2" checked="checked" class="checkbox" /> Article Label 2</label></li>' .
					'</ul>' .
				'</div>'
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
				'<div class="grid-noBottom_xs-1">' .
					'<ul class="sm-list col content_type-checkbox sortable" id="content_type-col-news">' .
						'<li><label><input type="checkbox" name="config[content_type][]" value="news_field1" checked="checked" class="checkbox" /> News Label 1</label></li>' .
						'<li><label><input type="checkbox" name="config[content_type][]" value="news_field2" class="checkbox" /> News Label 2</label></li>' .
					'</ul>' .
					'<ul class="sm-list col content_type-checkbox sortable" id="content_type-col-articles">' .
						'<li><label><input type="checkbox" name="config[content_type][]" value="article_field1" class="checkbox" /> Article Label 1</label></li>' .
						'<li><label><input type="checkbox" name="config[content_type][]" value="article_field2" checked="checked" class="checkbox" /> Article Label 2</label></li>' .
					'</ul>' .
				'</div>'
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
	 * @param string $expected
	 */
	public function test_build_checkbox(array $option_ary, $selected_items, $key, $sortable, $expected)
	{
		$cfg_fields = $this->get_service();
		$html = $cfg_fields->build_checkbox($option_ary, $selected_items, $key, $sortable);

		$this->assertEquals($expected, $this->clean_output($html));
	}
}
