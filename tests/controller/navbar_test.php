<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2020 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\controller;

class navbar_test extends \phpbb_test_case
{
	/**
	 * Define the extensions to be tested
	 *
	 * @return array vendor/name of extension(s) to test
	 */
	static protected function setup_extensions()
	{
		return array('blitze/sitemaker');
	}

	/**
	 * Create the navbar controller
	 *
	 * @param string $css
	 * @param string $last_modified
	 * @param bool $ajax_request
	 * @param bool $authorized
	 * @return \blitze\sitemaker\controller\navbar
	 */
	protected function get_controller($css = '', $last_modified = '', $ajax_request = true, $authorized = true)
	{
		global $phpbb_dispatcher, $symfony_request;

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
		$browser_last_modified = 'Thu, 31 Dec 2020 17:05:13 GMT';

		$headerBag = $this->getMockBuilder('\Symfony\Component\HttpFoundation\HeaderBag')
			->disableOriginalConstructor()
			->getMock();
		$headerBag->expects($this->any())
			->method('get')
			->with('If-Modified-Since')
			->willReturn($browser_last_modified);

		$symfony_request = $this->getMockBuilder('\phpbb\symfony_request')
			->disableOriginalConstructor()
			->getMock();
		$symfony_request->expects($this->any())
			->method('isMethodCacheable')
			->willReturn(true);
		$symfony_request->expects($this->any())
			->method('isXmlHttpRequest')
			->willReturn($ajax_request);
		$symfony_request->expects($this->any())
			->method('getEtags')
			->willReturn(['"prosilver-' . strtotime($browser_last_modified) . '"']);
		$symfony_request->headers = $headerBag;

		$auth = $this->getMockBuilder('\phpbb\auth\auth')
			->disableOriginalConstructor()
			->getMock();
		$auth->expects($this->any())
			->method('acl_get')
			->with($this->stringContains('_'), $this->anything())
			->will($this->returnValueMap(array(
				array('a_sm_manage_blocks', 0, $authorized),
			)));

		$translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function ()
			{
				return implode('-', func_get_args());
			});

		$navbar = $this->getMockBuilder('\blitze\sitemaker\services\navbar')
			->disableOriginalConstructor()
			->getMock();
		$navbar->expects($this->any())
			->method('get_last_modified')
			->willReturn($last_modified ? strtotime($last_modified) : 0);
		$navbar->expects($this->any())
			->method('get_css')
			->willReturnCallback(function () use ($css)
			{
				return "@import url('navbar.min.css');{$css}";
			});

		return new \blitze\sitemaker\controller\navbar($auth, $symfony_request, $translator, $navbar);
	}

	/**
	 * @return array
	 */
	public function css_test_data()
	{
		return array(
			array(
				'silverlight',
				'',
				'',
				200,
				"@import url('navbar.min.css');",
			),
			array(
				'prosilver',
				'Thu, 31 Dec 2020 17:05:13 GMT',
				'.sm-menu{font-size: 13;}',
				304,
				'',
			),
			array(
				'prosilver',
				'01/01/2021',
				'.sm-menu{font-size: 13;}',
				200,
				"@import url('navbar.min.css');.sm-menu{font-size: 13;}",
			),
		);
	}

	/**
	 * @dataProvider css_test_data
	 * @param string $style
	 * @param string $last_modified
	 * @param string $css
	 * @param int $status_code
	 * @param string $expected
	 */
	public function test_css($style, $last_modified, $css, $status_code, $expected)
	{
		$controller = $this->get_controller($css, $last_modified);
		$response = $controller->css($style);

		$this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
		$this->assertEquals($status_code, $response->getStatusCode());
		$this->assertSame($expected, $response->getContent());
	}

	/**
	 * @return array
	 */
	public function save_test_data()
	{
		return array(
			array(
				false,
				true,
				401,
				'{"message":"NOT_AUTHORISED"}',
			),
			array(
				true,
				false,
				401,
				'{"message":"NOT_AUTHORISED"}',
			),
			array(
				true,
				true,
				200,
				'{"message":""}',
			),
		);
	}
	/**
	 * @dataProvider save_test_data
	 * @param bool $ajax_request
	 * @param bool $authorized
	 * @param int $status_code
	 * @param string $expected
	 */
	public function test_save($ajax_request, $authorized, $status_code, $expected)
	{
		$controller = $this->get_controller('', '', $ajax_request, $authorized);

		$response = $controller->save('prosilver');

		$this->assertEquals($status_code, $response->getStatusCode());
		$this->assertSame($expected, $response->getContent());
	}
}
