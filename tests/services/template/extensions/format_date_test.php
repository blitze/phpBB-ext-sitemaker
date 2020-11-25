<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\template\extensions;

class format_date_test extends \phpbb_test_case
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
	 * Create the template service
	 *
	 * @return \blitze\sitemaker\services\template
	 */
	public function get_template()
	{
		global $phpbb_dispatcher, $phpbb_root_path, $phpEx;

		$config = new \phpbb\config\config(array());

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$lang = new \phpbb\language\language($lang_loader);

		$user = new \phpbb\user($lang, '\phpbb\datetime');
		$user->timezone = new \DateTimeZone('UTC');
		$user->date_format = 'D M d, Y g:i a';

		$filesystem = new \phpbb\filesystem\filesystem();

		$request = $this->getMockBuilder('\phpbb\request\request_interface')
			->disableOriginalConstructor()
			->getMock();

		$path_helper =  new \phpbb\path_helper(
			new \phpbb\symfony_request(
				new \phpbb_mock_request()
			),
			$filesystem,
			$request,
			$phpbb_root_path,
			$phpEx
		);

		$container = new \phpbb_mock_container_builder();
		$context = new \phpbb\template\context();
		$cache_path = $phpbb_root_path . 'cache/twig';
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
		$template_loader = new \phpbb\template\twig\loader($filesystem, '');
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
		$twig_extensions = array(new \blitze\sitemaker\services\template\extensions\format_date($user));

		$template = new \phpbb\template\twig\twig($path_helper, $config, $context, $twig, $cache_path, $user, $twig_extensions);
		$twig->setLexer(new \phpbb\template\twig\lexer($twig));
		$template->set_custom_style('tests', __DIR__ . '/templates');

		return $template;
	}

	public function test_format_date_filter()
	{
		$template = $this->get_template();

		$template->set_filenames(array('test' => 'format_date.html'));

		$template->assign_vars(array(
			'TOPIC_TIME' => 1557417743
		));

		$result = $template->assign_display('test', '', true);
		$expected = 'Thu May 09, 2019 4:02 pm May 09, 2019';

		$this->assertEquals($expected, $result);
	}
}
