<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks;

use blitze\sitemaker\services\blocks\cfg_fields;

class cfg_fields_test extends \phpbb_database_test_case
{
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
		return $this->createXMLDataSet(dirname(__FILE__) . '/../fixtures/users.xml');
	}

	protected function get_service()
	{
		global $db, $request, $template, $phpbb_dispatcher, $phpbb_root_path, $phpEx;

		$db = $this->new_dbal();

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$request = $this->getMock('\phpbb\request\request_interface');

		$user = $this->getMockBuilder('\phpbb\user')
			->disableOriginalConstructor()
			->getMock();

		$user->expects($this->any())
			->method('lang')
			->will($this->returnCallback(function($string) {
				return $string;
			}));

		$tpl_data = array();
		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$this->tpl_data =& $tpl_data;
		$template->expects($this->any())
			->method('assign_vars')
			->will($this->returnCallback(function($data) use (&$tpl_data) {
				$tpl_data = array_merge($tpl_data, $data);
			}));

		$template->expects($this->any())
			->method('assign_block_vars')
			->will($this->returnCallback(function($key, $data) use (&$tpl_data) {
				$tpl_data[$key][] = $data;
			}));

		$template->expects($this->any())
			->method('assign_display')
			->will($this->returnCallback(function() use (&$tpl_data) {
				return $tpl_data;
			}));

		return new cfg_fields($db, $request, $template, $user, $phpbb_root_path, $phpEx);
	}

	/**
	 * Call protected/private method of a class.
	 *
	 * @param object &$object		Instantiated object that we will run method on.
	 * @param string $methodName	Method name to call
	 * @param array  $parameters	Array of parameters to pass into method.
	 *
	 * @return mixed Method return.
	 */
	public function invokeMethod(&$object, $methodName, array $parameters = array())
	{
		$reflection = new \ReflectionClass(get_class($object));
		$method = $reflection->getMethod($methodName);
		$method->setAccessible(true);

		return $method->invokeArgs($object, $parameters);
	}

	/**
	 * Data set for test_add_block_admin_lang
	 *
	 * @return array
	 */
	public function build_multi_select_test_data()
	{
		return array(
			array(
				array(),
				'',
				'topic_ids',
				'<select id="topic_ids" name="config[topic_ids][]" multiple="multiple"></select>'
			),
			array(
				array(
					'option1'	=> 'Option #1',
					'option2'	=> 'Option #2',
					'option3'	=> 'Option #3',
				),
				"option1\noption2",
				'topic_ids',
				'<select id="topic_ids" name="config[topic_ids][]" multiple="multiple">' .
				'<option value="option1" selected="selected">Option #1</option>' .
				'<option value="option2" selected="selected">Option #2</option>' .
				'<option value="option3">Option #3</option>' .
				'</select>'
			),
		);
	}

	/**
	 * Test the build_multi_select method
	 *
	 * @dataProvider build_multi_select_test_data
	 */
	public function test_build_multi_select($option_ary, $selected_items, $key, $expected)
	{
		$cfg_fields = $this->get_service();
		$html = $cfg_fields->build_multi_select($option_ary, $selected_items, $key);

		$this->assertEquals($expected, $html);
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
				'<div class="topic_ids-checkbox" id="topic_ids-col-0"></div>'
			),
			array(
				array(
					'option1'	=> 'Option #1',
					'option2'	=> 'Option #2',
					'option3'	=> 'Option #3',
				),
				'',
				'topic_ids',
				'<div class="topic_ids-checkbox" id="topic_ids-col-0">' .
				'<label><input type="checkbox" name="config[topic_ids][]" id="topic_ids" value="option1" accesskey="topic_ids" class="checkbox" /> Option #1</label><br />' .
				'<label><input type="checkbox" name="config[topic_ids][]" value="option2" accesskey="topic_ids" class="checkbox" /> Option #2</label><br />' .
				'<label><input type="checkbox" name="config[topic_ids][]" value="option3" accesskey="topic_ids" class="checkbox" /> Option #3</label><br />' .
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
				'',
				'content_type',
				'<div class="grid__col grid__col--1-of-2 content_type-checkbox" id="content_type-col-news">' .
				'<label><input type="checkbox" name="config[content_type][]" id="content_type" value="news_field1" accesskey="content_type" class="checkbox" /> News Label 1</label><br />' .
				'<label><input type="checkbox" name="config[content_type][]" value="news_field2" accesskey="content_type" class="checkbox" /> News Label 2</label><br />' .
				'</div>' .
				'<div class="grid__col grid__col--1-of-2 content_type-checkbox" id="content_type-col-articles">' .
				'<label><input type="checkbox" name="config[content_type][]" value="article_field1" accesskey="content_type" class="checkbox" /> Article Label 1</label><br />' .
				'<label><input type="checkbox" name="config[content_type][]" value="article_field2" accesskey="content_type" class="checkbox" /> Article Label 2</label><br />' .
				'</div>'
			),
		);
	}

	/**
	 * Test the build_checkbox method
	 *
	 * @dataProvider build_checkbox_test_data
	 */
	public function test_build_checkbox($option_ary, $selected_items, $key, $expected)
	{
		$cfg_fields = $this->get_service();
		$html = $cfg_fields->build_checkbox($option_ary, $selected_items, $key);

		$this->assertEquals($expected, $html);
	}

	/**
	 * Data set for test_build_hidden
	 *
	 * @return array
	 */
	public function build_hidden_test_data()
	{
		return array(
			array(
				1,
				'hide_me',
				'<input type="hidden" name="config[hide_me]" value="1" />'
			),
		);
	}

	/**
	 * Test the build_hidden method
	 *
	 * @dataProvider build_hidden_test_data
	 */
	public function test_build_hidden($value, $key, $expected)
	{
		$cfg_fields = $this->get_service();
		$html = $cfg_fields->build_hidden($value, $key);

		$this->assertEquals($expected, $html);
	}
}
