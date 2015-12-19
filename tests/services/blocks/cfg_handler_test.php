<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks;

use phpbb\request\request_interface;
use blitze\sitemaker\services\blocks\cfg_handler;

require_once dirname(__FILE__) . '/../fixtures/ext/foo/bar/foo.php';

class cfg_handler_test extends \phpbb_test_case
{
	protected $tpl_data;

	/**
	 * Define the extension to be tested.
	 *
	 * @return string[]
	 */
	protected static function setup_extensions()
	{
		return array('blitze/sitemaker');
	}

	protected function get_service($variable_map = array())
	{
		global $request, $template, $phpbb_dispatcher, $user, $phpbb_root_path, $phpEx;

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$request = $this->getMock('\phpbb\request\request_interface');
		$request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap($variable_map));

		$user = $this->getMock('\phpbb\user', array(), array('\phpbb\datetime'));

		$user->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode(' ', func_get_args());
			});

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

		$groups = $this->getMockBuilder('\blitze\sitemaker\services\groups')
			->disableOriginalConstructor()
			->getMock();

		return new cfg_handler($request, $template, $user, $groups, $phpbb_root_path, $phpEx);
	}

	/**
	 * Data set for test_get_edit_form
	 *
	 * @return array
	 */
	public function get_edit_form_test_data()
	{
		$options = array(
			'option1'   => 'Option 1',
			'option2'   => 'Option 2',
			'option3'   => 'Option 3',
		);

		return array(
			array(
				array('option1', 'option3'),
				array('lang' => 'MY_SETTING', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'explain' => false, 'default' => array()),
				array(
					'KEY'			=> 'my_var',
					'TITLE'			=> 'MY_SETTING',
					'S_EXPLAIN'		=> false,
					'TITLE_EXPLAIN'	=> '',
					'CONTENT'		=> '<div class="my_var-checkbox" id="my_var-col-0">' .
						'<label><input type="checkbox" name="config[my_var][]" value="option1" checked="checked" accesskey="my_var" class="checkbox" /> Option 1</label><br />' .
						'<label><input type="checkbox" name="config[my_var][]" value="option2" accesskey="my_var" class="checkbox" /> Option 2</label><br />' .
						'<label><input type="checkbox" name="config[my_var][]" value="option3" checked="checked" accesskey="my_var" class="checkbox" /> Option 3</label><br />' .
						'</div>',
				),
			),
			array(
				array('option1', 'option2'),
				array('lang' => 'MY_SETTING', 'validate' => 'string', 'type' => 'multi_select', 'options' => $options, 'explain' => true, 'default' => array(), 'append' => 'YEARS'),
				array(
					'KEY'			=> 'my_var',
					'TITLE'			=> 'MY_SETTING',
					'S_EXPLAIN'		=> true,
					'TITLE_EXPLAIN'	=> 'MY_SETTING_EXPLAIN',
					'CONTENT'		=> '<select id="my_var" name="config[my_var][]" multiple="multiple">' .
						'<option value="option1" selected="selected">Option 1</option>' .
						'<option value="option2" selected="selected">Option 2</option>' .
						'<option value="option3">Option 3</option>' .
						'</select>YEARS',
				),
			),
			array(
				'option2',
				array('lang' => 'MY_SETTING', 'validate' => 'string', 'type' => 'select', 'options' => $options, 'explain' => false, 'default' => ''),
				array(
					'KEY'			=> 'my_var',
					'TITLE'			=> 'MY_SETTING',
					'S_EXPLAIN'		=> false,
					'TITLE_EXPLAIN'	=> '',
					'CONTENT'		=> '<select id="my_var" name="config[my_var]">' .
						'<option value="option1">Option 1</option>' .
						'<option value="option2" selected="selected">Option 2</option>' .
						'<option value="option3">Option 3</option>' .
						'</select>',
				),
			),
			array(
				1,
				array('lang' => 'MY_SETTING', 'validate' => 'int:0:20', 'type' => 'hidden', 'default' => 0),
				array(
					'KEY'			=> 'my_var',
					'TITLE'			=> '',
					'S_EXPLAIN'		=> '',
					'TITLE_EXPLAIN'	=> '',
					'CONTENT'		=> '<input type="hidden" name="config[my_var]" value="1" />',
				),
			),
			array(
				'foo foo',
				array('lang' => 'MY_SETTING', 'validate' => 'string', 'type' => 'custom', 'function' => 'foo', 'explain' => false, 'default' => ''),
				array(
					'KEY'			=> 'my_var',
					'TITLE'			=> 'MY_SETTING',
					'S_EXPLAIN'		=> false,
					'TITLE_EXPLAIN'	=> '',
					'CONTENT'		=> '<div>Hello foo foo</div>',
				),
			),
		);
	}

	/**
	 * Test the build_multi_select method
	 *
	 * @dataProvider get_edit_form_test_data
	 */
	public function test_get_edit_form($db_value, $default_settings, $expected)
	{
		$block_data = array(
			'settings'		=> array(
				'my_var'		=> $db_value,
			),
		);

		$default_settings = array(
			'legend1'	=> 'SETTINGS',
			'my_var'	=> $default_settings,
		);

		$expected = array_merge(array(
			array(
				'S_LEGEND'	=> 'legend1',
				'LEGEND'	=> 'SETTINGS',
			)),
			array($expected)
		);

		$cfg_fields = $this->get_service();
		$html = $cfg_fields->get_edit_form($block_data, $default_settings);

		$this->assertSame($expected, $html['options']);
	}

	/**
	 * Data set for test_get_submitted_settings
	 *
	 * @return array
	 */
	public function get_submitted_settings_test_data()
	{
		$options = array(
			'option1'	=> 'Option #1',
			'option2'	=> 'Option #2',
			'option3'	=> 'Option #3',
			'option4'	=> 'Option #4',
		);

		return array(
			array(
				array(
					array('config', array('' => array('' => '')), true, request_interface::REQUEST, array(
						'my_var' => array('option2', 'option4'),
					)),
					array('config', array('' => ''), true, request_interface::REQUEST, array()),
				),
				array('lang' => 'SELECT_OPTION', 'validate' => 'string', 'type' => 'multi_select', 'options' => $options, 'default' => array(), 'explain' => false),
				array('my_var' => array('option2', 'option4')),
			),
			array(
				array(
					array('config', array('' => array('' => '')), true, request_interface::REQUEST, array()),
					array('config', array('' => ''), true, request_interface::REQUEST, array('my_var' => 'option3')),
				),
				array('lang' => 'MY_SETTING', 'validate' => 'string', 'type' => 'select', 'options' => $options, 'explain' => false, 'default' => ''),
				array('my_var' => 'option3'),
			),
			array(
				array(
					array('config', array('' => array('' => '')), true, request_interface::REQUEST, array()),
					array('config', array('' => ''), true, request_interface::REQUEST, array('my_var' => 200)),
				),
				array('lang' => 'MY_SETTING', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'explain' => false, 'default' => 10),
				array('errors' => ''),
			),
		);
	}

	/**
	 * Test the get_submitted_settings method
	 *
	 * @dataProvider get_submitted_settings_test_data
	 */
	public function test_get_submitted_settings($variable_map, $field_settings, $expected)
	{
		$cfg_fields = $this->get_service($variable_map);

		$default_settings = array('my_var' => $field_settings);
		$data = $cfg_fields->get_submitted_settings($default_settings);

		$this->assertSame($expected, $data);
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
				array('option1', 'option2'),
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
				'<label><input type="checkbox" name="config[topic_ids][]" value="option1" accesskey="topic_ids" class="checkbox" /> Option #1</label><br />' .
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
				'<label><input type="checkbox" name="config[content_type][]" value="news_field1" accesskey="content_type" class="checkbox" /> News Label 1</label><br />' .
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
