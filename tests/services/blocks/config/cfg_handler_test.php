<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks\config;

use phpbb\request\request_interface;
use blitze\sitemaker\services\blocks\config\cfg_handler;

require_once dirname(__FILE__) . '/../../fixtures/ext/foo/bar/foo.php';

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

	/**
	 * @param array $variable_map
	 * @return \blitze\sitemaker\services\blocks\config\cfg_handler
	 */
	protected function get_service($variable_map = array())
	{
		global $request, $template, $phpbb_container, $phpbb_dispatcher, $user, $phpbb_root_path, $phpEx;

		$request = $this->getMockBuilder('\phpbb\request\request_interface')
			->disableOriginalConstructor()
			->getMock();
		$request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap($variable_map));

		$phpbb_container = new \phpbb_mock_container_builder();

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$phpbb_extension_manager = new \phpbb_mock_extension_manager(
			$phpbb_root_path,
			array(
				'blitze/sitemaker' => array(
					'ext_name'		=> 'blitze/sitemaker',
					'ext_active'	=> '1',
					'ext_path'		=> 'ext/blitze/sitemaker/',
				),
			),
			$phpbb_container
		);

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$lang_loader->set_extension_manager($phpbb_extension_manager);

		$translator = new \phpbb\language\language($lang_loader);
		$translator->set_user_language('en');

		// We do this here so we can ensure that language variables are provided
		$translator->add_lang('acp/common');
		$translator->add_lang('blocks_admin', 'blitze/sitemaker');

		$user = new \phpbb\user($translator, '\phpbb\datetime');

		$tpl_data = array();
		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$this->tpl_data = &$tpl_data;
		$template->expects($this->any())
			->method('assign_vars')
			->will($this->returnCallback(function ($data) use (&$tpl_data)
			{
				$tpl_data = array_merge($tpl_data, $data);
			}));

		$template->expects($this->any())
			->method('assign_block_vars')
			->will($this->returnCallback(function ($key, $data) use (&$tpl_data)
			{
				$tpl_data[$key][] = $data;
			}));

		$template->expects($this->any())
			->method('assign_display')
			->will($this->returnCallback(function () use (&$tpl_data)
			{
				return $tpl_data;
			}));

		$cfg_fields_collection = new \phpbb\di\service_collection($phpbb_container);

		$cfg_fields_collection->add('cfg.checkbox.field');
		$cfg_fields_collection->add('cfg.code_editor.field');
		$cfg_fields_collection->add('cfg.custom.field');
		$cfg_fields_collection->add('cfg.hidden.field');
		$cfg_fields_collection->add('cfg.multi_input.field');
		$cfg_fields_collection->add('cfg.multi_select.field');
		$cfg_fields_collection->add('cfg.radio.field');
		$cfg_fields_collection->add('cfg.select.field');

		$phpbb_container->set('cfg.checkbox.field', new \blitze\sitemaker\services\blocks\config\fields\checkbox($translator));
		$phpbb_container->set('cfg.code_editor.field', new \blitze\sitemaker\services\blocks\config\fields\code_editor($translator));
		$phpbb_container->set('cfg.custom.field', new \blitze\sitemaker\services\blocks\config\fields\custom($translator));
		$phpbb_container->set('cfg.hidden.field', new \blitze\sitemaker\services\blocks\config\fields\hidden($translator));
		$phpbb_container->set('cfg.multi_input.field', new \blitze\sitemaker\services\blocks\config\fields\multi_input($translator));
		$phpbb_container->set('cfg.multi_select.field', new \blitze\sitemaker\services\blocks\config\fields\multi_select($translator));
		$phpbb_container->set('cfg.radio.field', new \blitze\sitemaker\services\blocks\config\fields\radio($translator));
		$phpbb_container->set('cfg.select.field', new \blitze\sitemaker\services\blocks\config\fields\select($translator));

		$cfg_factory = new \blitze\sitemaker\services\blocks\config\cfg_factory($cfg_fields_collection);

		$groups = $this->getMockBuilder('\blitze\sitemaker\services\groups')
			->disableOriginalConstructor()
			->getMock();

		return new cfg_handler($request, $template, $translator, $cfg_factory, $groups, $phpbb_root_path, $phpEx);
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
					'APPEND' => '',
					'TEMPLATE' => '@blitze_sitemaker/cfg_fields/checkbox.html',
					'TPL_DATA' => array(
						'field' => 'my_var',
						'selected' => ['option1', 'option3'],
						'columns' => array(
							array(
								'option1' => 'Option 1',
								'option2' => 'Option 2',
								'option3' => 'Option 3',
							),
						),
						'class' => '',
						'sortable' => 0,
					),
					'KEY' => 'my_var',
					'TITLE' => 'MY_SETTING',
					'S_EXPLAIN' => '',
					'TITLE_EXPLAIN' => '',
				),
			),
			array(
				array('option1', 'option2'),
				array('lang' => 'MY_SETTING', 'validate' => 'string', 'type' => 'multi_select', 'options' => $options, 'explain' => true, 'default' => array(), 'append' => 'YEARS'),
				array(
					'APPEND' => 'YEARS',
					'TEMPLATE' => '@blitze_sitemaker/cfg_fields/multi_select.html',
					'TPL_DATA' => array(
						'field' => 'my_var',
						'options' => array(
							'option1' => 'Option 1',
							'option2' => 'Option 2',
							'option3' => 'Option 3',
						),
						'selected' => array(
							0 => 'option1',
							1 => 'option2',
						),
					),
					'KEY' => 'my_var',
					'TITLE' => 'MY_SETTING',
					'S_EXPLAIN' => true,
					'TITLE_EXPLAIN' => 'MY_SETTING_EXPLAIN',
				),
			),
			array(
				'option1',
				array('lang' => 'MY_SETTING', 'validate' => 'string', 'type' => 'radio', 'options' => $options, 'explain' => false, 'default' => ''),
				array(
					'APPEND' => '',
					'TEMPLATE' => '@blitze_sitemaker/cfg_fields/radio.html',
					'TPL_DATA' => array(
						'field' => 'my_var',
						'options' => array(
							'option1' => 'Option 1',
							'option2' => 'Option 2',
							'option3' => 'Option 3',
						),
						'selected' => 'option1',
					),
					'KEY' => 'my_var',
					'TITLE' => 'MY_SETTING',
					'S_EXPLAIN' => false,
					'TITLE_EXPLAIN' => '',
				),
			),
			array(
				'option2',
				array('lang' => 'MY_SETTING', 'validate' => 'string', 'type' => 'select', 'options' => $options, 'explain' => false, 'default' => ''),
				array(
					'APPEND' => '',
					'TEMPLATE' => '@blitze_sitemaker/cfg_fields/select.html',
					'TPL_DATA' => array(
						'field' => 'my_var',
						'selected' => array(
							0 => 'option2',
						),
						'options' => array(
							'option1' => 'Option 1',
							'option2' => 'Option 2',
							'option3' => 'Option 3',
						),
						'size' => 1,
						'multi_select' => false,
						'togglable_key' => '',
					),
					'KEY' => 'my_var',
					'TITLE' => 'MY_SETTING',
					'S_EXPLAIN' => false,
					'TITLE_EXPLAIN' => '',
				),
			),
			array(
				'option2',
				array('lang' => 'MY_SETTING', 'validate' => 'string', 'type' => 'select:1:1', 'options' => $options, 'explain' => false, 'default' => ''),
				array(
					'APPEND' => '',
					'TEMPLATE' => '@blitze_sitemaker/cfg_fields/select.html',
					'TPL_DATA' => array(
						'field' => 'my_var',
						'selected' => array(
							0 => 'option2',
						),
						'options' => array(
							'option1' => 'Option 1',
							'option2' => 'Option 2',
							'option3' => 'Option 3',
						),
						'size' => 1,
						'multi_select' => 'option2',
						'togglable_key' => '',
					),
					'KEY' => 'my_var',
					'TITLE' => 'MY_SETTING',
					'S_EXPLAIN' => false,
					'TITLE_EXPLAIN' => '',
				),
			),
			array(
				'option2',
				array('lang' => 'MY_SETTING', 'validate' => 'string', 'type' => 'select:5:0:test', 'options' => $options, 'explain' => false, 'default' => ''),
				array(
					'APPEND' => '',
					'TEMPLATE' => '@blitze_sitemaker/cfg_fields/select.html',
					'TPL_DATA' => array(
						'field' => 'my_var',
						'selected' => array(
							0 => 'option2',
						),
						'options' => array(
							'option1' => 'Option 1',
							'option2' => 'Option 2',
							'option3' => 'Option 3',
						),
						'size' => 5,
						'multi_select' => false,
						'togglable_key' => 'test',
					),
					'KEY' => 'my_var',
					'TITLE' => 'MY_SETTING',
					'S_EXPLAIN' => false,
					'TITLE_EXPLAIN' => '',
				),
			),
			array(
				array('option1', 'option2'),
				array('lang' => 'MY_SETTING', 'validate' => 'string', 'type' => 'select:1:1:foo', 'options' => $options, 'explain' => false, 'default' => ''),
				array(
					'APPEND' => '',
					'TEMPLATE' => '@blitze_sitemaker/cfg_fields/select.html',
					'TPL_DATA' => array(
						'field' => 'my_var',
						'selected' => array(
							0 => 'option1',
							1 => 'option2',
						),
						'options' => array(
							'option1' => 'Option 1',
							'option2' => 'Option 2',
							'option3' => 'Option 3',
						),
						'size' => 1,
						'multi_select' => array(
							0 => 'option1',
							1 => 'option2',
						),
						'togglable_key' => 'foo',
					),
					'KEY' => 'my_var',
					'TITLE' => 'MY_SETTING',
					'S_EXPLAIN' => false,
					'TITLE_EXPLAIN' => '',
				),
			),
			array(
				1,
				array('lang' => 'MY_SETTING', 'validate' => 'int:0:20', 'type' => 'hidden', 'default' => 0),
				array(
					'APPEND' => '',
					'CONTENT' => '',
					'KEY' => 'my_var',
					'TITLE' => 'MY_SETTING',
					'S_EXPLAIN' => false,
					'TITLE_EXPLAIN' => '',
				),
			),
			array(
				'foo foo',
				array('lang' => 'MY_SETTING', 'validate' => 'string', 'type' => 'custom', 'function' => 'foo', 'explain' => false, 'default' => ''),
				array(
					'APPEND' => '',
					'CONTENT' => '<div>Hello foo foo</div>',
					'KEY' => 'my_var',
					'TITLE' => 'MY_SETTING',
					'S_EXPLAIN' => false,
					'TITLE_EXPLAIN' => '',
				),
			),
			array(
				'option2',
				array('lang' => 'MY_SETTING', 'validate' => 'string', 'type' => 'select:1:toggable', 'object' => $this, 'method' => 'create_test_options', 'options' => $options, 'explain' => false, 'default' => ''),
				array(
					'APPEND' => '',
					'CONTENT' => '<select id="my_var" name="config[my_var]" data-togglable-settings="true">' .
						'<option value="option1" data-toggle-setting="#test-option1">Option 1</option>' .
						'<option value="option2" selected="selected" data-toggle-setting="#test-option2">Option 2</option>' .
						'<option value="option3" data-toggle-setting="#test-option3">Option 3</option>' .
						'</select>',
					'KEY' => 'my_var',
					'TITLE' => 'MY_SETTING',
					'S_EXPLAIN' => false,
					'TITLE_EXPLAIN' => '',
				),
			),
			array(
				'option2',
				array('lang' => '', 'validate' => 'string', 'type' => 'code_editor', 'params' => [['height' => 200, 'allow-full-screen' => true], 'MY_TITLE'], 'default' => '', 'explain' => true, 'lang_explain' => 'CODE_EDITOR'),
				array(
					'APPEND' => '',
					'TEMPLATE' => '@blitze_sitemaker/cfg_fields/code_editor.html',
					'TPL_DATA' => array(
						'key' => 'my_var',
						'value' => 'option2',
						'label' => 'MY_TITLE',
						'explain' => 'CODE_EDITOR',
						'attributes' => ' data-height="200" data-allow-full-screen="1"',
						'fullscreen' => true,
					),
					'KEY' => 'my_var',
					'TITLE' => '',
					'S_EXPLAIN' => true,
					'TITLE_EXPLAIN' => 'CODE_EDITOR',
				),
			),
			array(
				'option2',
				array('lang' => 'MY_SETTING', 'type' => 'multi_input:1:1', 'default' => []),
				array(
					'APPEND' => '',
					'TEMPLATE' => '@blitze_sitemaker/cfg_fields/multi_input.html',
					'TPL_DATA' => array(
						'field' => 'my_var',
						'values' => array(
							0 => 'option2',
						),
						'sortable' => '1',
						'label' => 'MY_SETTING',
					),
					'KEY' => 'my_var',
					'TITLE' => '',
					'S_EXPLAIN' => false,
					'TITLE_EXPLAIN' => '',
				),
			),
		);
	}

	/**
	 * Test the build_multi_select method
	 *
	 * @dataProvider get_edit_form_test_data
	 * @param mixed $db_value
	 * @param array $default_settings
	 * @param array $expected
	 */
	public function test_get_edit_form($db_value, array $default_settings, array $expected)
	{
		$block_data = array(
			'bid'			=> 1,
			'status'		=> 1,
			'type'			=> '',
			'view'			=> '',
			'hide_title'	=> false,
			'class'			=> '',
			'permission'	=> [],
			'settings'		=> array(
				'my_var'		=> $db_value,
			),
		);

		$default_settings = array(
			'legend1'	=> 'SETTINGS',
			'my_var'	=> $default_settings,
		);

		$expected = array_merge(
			array(
				array(
					'S_LEGEND'	=> 'legend1',
					'LEGEND'	=> 'Settings',
				)
			),
			array($expected)
		);

		$cfg_fields = $this->get_service();
		$result = $cfg_fields->get_edit_form($block_data, $default_settings);

		$this->assertEquals($expected, $result['cfg_fields']);
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
					array('config', array('' => array(0 => '')), true, request_interface::REQUEST, array(
						'my_var' => array('option2', 'option4'),
					)),
					array('config', array('' => ''), true, request_interface::REQUEST, array()),
				),
				array('my_var' => array('lang' => 'SELECT_OPTION', 'validate' => 'string', 'type' => 'multi_select', 'options' => $options, 'default' => array(), 'explain' => false)),
				array('my_var' => array('option2', 'option4')),
			),
			array(
				array(
					array('config', array('' => array(0 => '')), true, request_interface::REQUEST, array()),
					array('config', array('' => ''), true, request_interface::REQUEST, array(
						'other_var' => 'option3',
					)),
				),
				array('other_var' => array('lang' => 'MY_SETTING', 'validate' => 'string', 'type' => 'select', 'options' => $options, 'explain' => false, 'default' => '')),
				array('other_var' => 'option3'),
			),
			array(
				array(
					array('config', array('' => array(0 => '')), true, request_interface::REQUEST, array()),
					array('config', array('' => ''), true, request_interface::REQUEST, array(
						'foo_var' => 200,
					)),
				),
				array('foo_var' => array('lang' => 'MAX_TOPICS', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'explain' => false, 'default' => 10)),
				'The provided value for the setting “Maximum number of topics” is too high. The maximum acceptable value is 20.',
			),
			// special case for custom block
			array(
				array(
					array('config', array('' => array(0 => '')), true, request_interface::REQUEST, array()),
					array('config', array('' => ''), true, request_interface::REQUEST, array(
						'source' => '%3Cscript%3Ealert(\'yes\');%3C/script%3E',
					)),
				),
				array('source' => array('lang' => '', 'type' => 'code', 'default' => '', 'explain' => true, 'lang_explain' => 'SOURCE_EXPLAIN')),
				array('source' => '<script>alert(\'yes\');</script>'),
			),
		);
	}

	/**
	 * Test the get_submitted_settings method
	 *
	 * @dataProvider get_submitted_settings_test_data
	 * @param array $variable_map
	 * @param array $default_settings
	 * @param mixed $expected
	 */
	public function test_get_submitted_settings(array $variable_map, array $default_settings, $expected)
	{
		$cfg_fields = $this->get_service($variable_map);

		try
		{
			$data = $cfg_fields->get_submitted_settings($default_settings);
			if (is_array($expected))
			{
				$this->assertSame($expected, $data);
			}
			else
			{
				$this->fail('no exception thrown');
			}
		}
		catch (\Exception $e)
		{
			$this->assertEquals($expected, $e->getMessage());
		}
	}

	/**
	 * @param array $options
	 * @param string $current
	 * @return string
	 */
	public function create_test_options(array $options, $current)
	{
		$html = '';
		foreach ($options as $value => $title)
		{
			$selected = ($current == $value) ? ' selected="selected"' : '';
			$html .= '<option value="' . $value . '"' . $selected . ' data-toggle-setting="#test-' . $value . '">' . $title . '</option>';
		}

		return $html;
	}
}
