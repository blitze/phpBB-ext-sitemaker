<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks\config\fields;

use blitze\sitemaker\services\template;

abstract class cfg_test_base extends \phpbb_test_case
{
	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \blitze\sitemaker\services\template */
	protected $ptemplate;

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
	 * Configure the test environment.
	 *
	 * @return void
	 */
	public function setUp()
	{
		global $request, $phpbb_container, $phpbb_dispatcher, $user, $phpbb_root_path, $phpEx;

		parent::setUp();

		$request = $this->getMockBuilder('\phpbb\request\request')
			->disableOriginalConstructor()
			->getMock();

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

		$this->translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$this->translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
				return implode('-', func_get_args());
			});

		$user = new \phpbb\user($this->translator, '\phpbb\datetime');

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

		$this->ptemplate = new template($path_helper, $config, $template_context, $twig, $cache_path, $user, array(new \phpbb\template\twig\extension($template_context, $twig, $user)));
		$twig->setLexer(new \phpbb\template\twig\lexer($twig));

		$this->ptemplate->set_custom_style('all', $phpbb_root_path . 'ext/blitze/sitemaker/styles/all');
	}

	/**
	 * @param string $string
	 * @return string
	 */
	protected function clean_output($string)
	{
		return trim(preg_replace('/\s{2,}|\n/', '', $string));
	}
}
