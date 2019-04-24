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
use blitze\sitemaker\services\template;

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

		$request = $this->getMock('\phpbb\request\request_interface');
		$request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap($variable_map));

		$phpbb_container = new \phpbb_mock_container_builder();

		$phpbb_extension_manager = new \phpbb_mock_extension_manager(
			$phpbb_root_path,
			array(
				'blitze/sitemaker' => array(
					'ext_name'		=> 'blitze/sitemaker',
					'ext_active'	=> '1',
					'ext_path'		=> 'ext/blitze/sitemaker/',
				),
			),
			$phpbb_container);

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$lang_loader->set_extension_manager($phpbb_extension_manager);

		$translator = new \phpbb\language\language($lang_loader);
		$translator->set_user_language('en');

		// We do this here so we can ensure that language variables are provided
		$translator->add_lang('acp/common');
		$translator->add_lang('blocks_admin', 'blitze/sitemaker');

		$user = new \phpbb\user($translator, '\phpbb\datetime');

		$config = new \phpbb\config\config(array());

		$filesystem = new \phpbb\filesystem\filesystem();

		$path_helper = new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			$filesystem,
			$request,
			$phpbb_root_path,
			$php_ext
		);

		$cache_path = $phpbb_root_path . 'cache/twig';
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
		$template_context = new \phpbb\template\context();
		$template_loader = new \phpbb\template\twig\loader(new \phpbb\filesystem\filesystem(), '');
		$twig = new \phpbb\template\twig\environment(
			$config,
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

		$ptemplate = new template($path_helper, $config, $template_context, $twig, $cache_path, $user, array(new \phpbb\template\twig\extension($template_context, $user)));
		$twig->setLexer(new \phpbb\template\twig\lexer($twig));

		$ptemplate->set_custom_style('all', $phpbb_root_path . 'ext/blitze/sitemaker/styles/all');

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
		$phpbb_container->set('cfg.custom.field', new \blitze\sitemaker\services\blocks\config\fields\custom());
		$phpbb_container->set('cfg.hidden.field', new \blitze\sitemaker\services\blocks\config\fields\hidden());
		$phpbb_container->set('cfg.multi_input.field', new \blitze\sitemaker\services\blocks\config\fields\multi_input($ptemplate));
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
					'KEY'			=> 'my_var',
					'TITLE'			=> 'MY_SETTING',
					'S_EXPLAIN'		=> false,
					'TITLE_EXPLAIN'	=> '',
					'CONTENT'		=> '<div class="my_var-checkbox" id="my_var-col-0">' .
						'<label><input type="checkbox" name="config[my_var][0]" value="option1" checked="checked" class="checkbox" /> Option 1</label><br />' .
						'<label><input type="checkbox" name="config[my_var][1]" value="option2" class="checkbox" /> Option 2</label><br />' .
						'<label><input type="checkbox" name="config[my_var][2]" value="option3" checked="checked" class="checkbox" /> Option 3</label><br />' .
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
				'option1',
				array('lang' => 'MY_SETTING', 'validate' => 'string', 'type' => 'radio', 'options' => $options, 'explain' => false, 'default' => ''),
				array(
					'KEY'			=> 'my_var',
					'TITLE'			=> 'MY_SETTING',
					'S_EXPLAIN'		=> false,
					'TITLE_EXPLAIN'	=> '',
					'CONTENT'		=> '<label><input type="radio" name="config[my_var]" value="option1" checked="checked" class="radio" /> Option 1</label><br />' .
						'<label><input type="radio" name="config[my_var]" value="option2" class="radio" /> Option 2</label><br />' .
						'<label><input type="radio" name="config[my_var]" value="option3" class="radio" /> Option 3</label><br />',
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
				'option2',
				array('lang' => 'MY_SETTING', 'validate' => 'string', 'type' => 'select:1:1', 'options' => $options, 'explain' => false, 'default' => ''),
				array(
					'KEY'			=> 'my_var',
					'TITLE'			=> 'MY_SETTING',
					'S_EXPLAIN'		=> false,
					'TITLE_EXPLAIN'	=> '',
					'CONTENT'		=> '<select id="my_var" name="config[my_var][]" multiple="multiple">' .
							'<option value="option1">Option 1</option>' .
							'<option value="option2" selected="selected">Option 2</option>' .
							'<option value="option3">Option 3</option>' .
						'</select>',
				),
			),
			array(
				'option2',
				array('lang' => 'MY_SETTING', 'validate' => 'string', 'type' => 'select:5:0:test', 'options' => $options, 'explain' => false, 'default' => ''),
				array(
					'KEY'			=> 'my_var',
					'TITLE'			=> 'MY_SETTING',
					'S_EXPLAIN'		=> false,
					'TITLE_EXPLAIN'	=> '',
					'CONTENT'		=> '<select id="my_var" name="config[my_var]" size="5" data-togglable-settings="true">' .
							'<option value="option1" data-toggle-setting="#test-option1">Option 1</option>' .
							'<option value="option2" selected="selected" data-toggle-setting="#test-option2">Option 2</option>' .
							'<option value="option3" data-toggle-setting="#test-option3">Option 3</option>' .
						'</select>',
				),
			),
			array(
				array('option1', 'option2'),
				array('lang' => 'MY_SETTING', 'validate' => 'string', 'type' => 'select:1:1:foo', 'options' => $options, 'explain' => false, 'default' => ''),
				array(
					'KEY'			=> 'my_var',
					'TITLE'			=> 'MY_SETTING',
					'S_EXPLAIN'		=> false,
					'TITLE_EXPLAIN'	=> '',
					'CONTENT'		=> '<select id="my_var" name="config[my_var][]" multiple="multiple" data-togglable-settings="true">' .
							'<option value="option1" selected="selected" data-toggle-setting="#foo-option1">Option 1</option>' .
							'<option value="option2" selected="selected" data-toggle-setting="#foo-option2">Option 2</option>' .
							'<option value="option3" data-toggle-setting="#foo-option3">Option 3</option>' .
						'</select>',
				),
			),
			array(
				1,
				array('lang' => 'MY_SETTING', 'validate' => 'int:0:20', 'type' => 'hidden', 'default' => 0),
				array(
					'KEY'			=> 'my_var',
					'TITLE'			=> 'MY_SETTING',
					'S_EXPLAIN'		=> false,
					'TITLE_EXPLAIN'	=> '',
					'CONTENT'		=> '',
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
			array(
				'option2',
				array('lang' => 'MY_SETTING', 'validate' => 'string', 'type' => 'select:1:toggable', 'object' => $this, 'method' => 'create_test_options', 'options' => $options, 'explain' => false, 'default' => ''),
				array(
					'KEY'			=> 'my_var',
					'TITLE'			=> 'MY_SETTING',
					'S_EXPLAIN'		=> false,
					'TITLE_EXPLAIN'	=> '',
					'CONTENT'		=> '<select id="my_var" name="config[my_var]" data-togglable-settings="true">' .
						'<option value="option1" data-toggle-setting="#test-option1">Option 1</option>' .
						'<option value="option2" selected="selected" data-toggle-setting="#test-option2">Option 2</option>' .
						'<option value="option3" data-toggle-setting="#test-option3">Option 3</option>' .
						'</select>',
				),
			),
			array(
				'option2',
				array('lang' => '', 'validate' => 'string', 'type' => 'code_editor', 'params' => [['height' => 200, 'allow-full-screen' => true], 'MY_TITLE'], 'default' => '', 'explain' => true, 'lang_explain' => 'CODE_EDITOR'),
				array(
					'KEY'			=> 'my_var',
					'TITLE'			=> '',
					'S_EXPLAIN'		=> true,
					'TITLE_EXPLAIN'	=> 'CODE_EDITOR',
					'CONTENT'		=> '<label for="my_var"><strong>MY_TITLE</strong></label>' .
						'<span>CODE_EDITOR</span>' .
						'<textarea id="my_var-editor" class="code-editor" name="config[my_var]" data-height="200" data-allow-full-screen="1">option2</textarea>' .
						'<div class="align-right">' .
							'<button class="my_var-editor-button CodeMirror-button" data-action="undo" title="UNDO"><i class="fa fa-undo" aria-hidden="true"></i></button>' .
							'<button class="my_var-editor-button CodeMirror-button" data-action="redo" title="REDO"><i class="fa fa-repeat" aria-hidden="true"></i></button>' .
							'<button class="my_var-editor-button CodeMirror-button" data-action="clear" title="CLEAR"><i class="fa fa-ban" aria-hidden="true"></i></button>' .
							'<button class="my_var-editor-button CodeMirror-button" data-action="fullscreen" title="Fullscreen"><i class="fa fa-window-restore" aria-hidden="true"></i></button>' .
						'</div>',
				),
			),
			array(
				'option2',
				array('lang' => 'MY_SETTING', 'type' => 'multi_input:1:1', 'default' => []),
				array(
					'KEY'			=> 'my_var',
					'TITLE'			=> '',
					'S_EXPLAIN'		=> false,
					'TITLE_EXPLAIN'	=> '',
					'CONTENT'		=> '<div class="sm-multi-input-ui sortable">' .
						'<label><strong>MY_SETTING</strong></label>' .
						'<div class="sm-multi-input-list">' .
							'<div class="sm-multi-input-item">' .
								'<span><i class="fa fa-bars" aria-hidden="true"></i></span>' .
								'<input type="text" name="config[my_var][]" value="option2" />' .
								'<button class="sm-multi-input-delete"><i class="fa fa-times" aria-hidden="true"></i></button>' .
    						'</div>' .
                            '<div class="sm-multi-input-item">' .
                            	'<span><i class="fa fa-bars" aria-hidden="true"></i></span>' .
                            	'<input type="text" name="config[my_var][]" value="" />' .
                            	'<button class="sm-multi-input-delete"><i class="fa fa-times" aria-hidden="true"></i></button>' .
                            '</div>' .
                        '</div>' .
                        '<button class="sm-multi-input-add pull-right"><i class="fa fa-plus" aria-hidden="true"></i></button>' .
                    '</div>',
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
				'LEGEND'	=> 'Settings',
			)),
			array($expected)
		);

		$cfg_fields = $this->get_service();
		$html = $cfg_fields->get_edit_form($block_data, $default_settings);

		foreach ($html['options'] as &$option)
		{
			if (isset($option['CONTENT']))
			{
				$option['CONTENT'] = preg_replace('/\s{2,}/', '', $option['CONTENT']);
			}
		}

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
			$this->assertEquals($expected,$e->getMessage());
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
