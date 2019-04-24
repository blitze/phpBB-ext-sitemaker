<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks\config\fields;

use blitze\sitemaker\services\blocks\config\fields\multi_input;
use blitze\sitemaker\services\template;

class multi_input_test extends \phpbb_test_case
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
	 * @return \blitze\sitemaker\services\blocks\config\fields\multi_select
	 */
	protected function get_service()
	{
		global $phpbb_root_path, $phpEx;

		$translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode('-', func_get_args());
			});

		$user = new \phpbb\user($translator, '\phpbb\datetime');

		$config = new \phpbb\config\config(array());

		$request = $this->getMock('\phpbb\request\request_interface');

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

		return new multi_input($ptemplate);
	}

    /**
     */
	public function test_name()
	{
		$cfg_fields = $this->get_service();
		$this->assertEquals('multi_input', $cfg_fields->get_name());
	}

	/**
	 * Data set for test_build_multi_select
	 *
	 * @return array
	 */
	public function build_multi_input_test_data()
	{
		return array(
			array(
				false,
				[],
				'',
				'<div class="sm-multi-input-ui">' .
					'<div class="sm-multi-input-list">' .
						'<div class="sm-multi-input-item">' .
							'<input type="text" name="config[foo][]" value="" />' .
							'<button class="sm-multi-input-delete"><i class="fa fa-times" aria-hidden="true"></i></button>' .
						'</div>' .
					'</div>' .
					'<button class="sm-multi-input-add pull-right"><i class="fa fa-plus" aria-hidden="true"></i></button>' .
				'</div>',
			),
			array(
				true,
				['https://google.com', 'some-site.com'],
				'MY_FOO_INPUT',
				'<div class="sm-multi-input-ui sortable">' .
					'<label><strong>MY_FOO_INPUT</strong></label>' .
					'<div class="sm-multi-input-list">' .
						'<div class="sm-multi-input-item">' .
							'<span><i class="fa fa-bars" aria-hidden="true"></i></span>' .
							'<input type="text" name="config[foo][]" value="https://google.com" />' .
							'<button class="sm-multi-input-delete"><i class="fa fa-times" aria-hidden="true"></i></button>' .
						'</div>' .
						'<div class="sm-multi-input-item">' .
							'<span><i class="fa fa-bars" aria-hidden="true"></i></span>' .
							'<input type="text" name="config[foo][]" value="some-site.com" />' .
							'<button class="sm-multi-input-delete"><i class="fa fa-times" aria-hidden="true"></i></button>' .
						'</div>' .
						'<div class="sm-multi-input-item">' .
							'<span><i class="fa fa-bars" aria-hidden="true"></i></span>' .
							'<input type="text" name="config[foo][]" value="" />' .
							'<button class="sm-multi-input-delete"><i class="fa fa-times" aria-hidden="true"></i></button>' .
						'</div>' .
					'</div>' .
					'<button class="sm-multi-input-add pull-right"><i class="fa fa-plus" aria-hidden="true"></i></button>' .
				'</div>',
			),
		);
	}

	/**
	 * Test the build_multi_input method
	 *
	 * @dataProvider build_multi_input_test_data
	 * @param bool $sortable
	 * @param array $values
	 * @param string $label
	 * @param string $expected
	 */
	public function test_build_multi_input($sortable, array $values, $label, $expected)
	{
		$cfg_fields = $this->get_service();
		$html = $cfg_fields->build_multi_input('foo', $sortable, $values, $label);

		$this->assertEquals($expected, preg_replace('/\s{2,}/', '', $html));
	}
}
