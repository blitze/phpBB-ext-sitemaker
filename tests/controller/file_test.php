<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2021 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\controller;

class file_test extends \phpbb_test_case
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
	protected function get_controller()
	{
		global $phpbb_root_path;

		$filemanager = $this->getMockBuilder('\blitze\sitemaker\services\filemanager')
			->disableOriginalConstructor()
			->getMock();
		$filemanager->expects($this->once())
			->method('get_upload_destination')
			->willReturn('ext/blitze/sitemaker/tests/controller/fixtures/images/');

		return new \blitze\sitemaker\controller\file($filemanager, $phpbb_root_path);
	}

	/**
	 * @return array
	 */
	public function sample_data()
	{
		return array(
			array(
				'spacer.gif',
				'phpBB/ext/blitze/sitemaker/tests/controller/fixtures/images/spacer.gif',
				'',
				200,
			),
			array(
				'no_exist.gif',
				'',
				'URL_NOT_FOUND',
				404,
			),
		);
	}

	/**
	 * @dataProvider sample_data
	 *
	 * @param string $filename
	 * @param string $expected_file
	 * @param string $message
	 * @param int $status_code
	 */
	public function test_controller($filename, $expected_file, $message, $status_code)
	{
		$controller = $this->get_controller();

		try
		{
			$response = $controller->handle($filename);
			$info = pathinfo($response->getFile());

			$this->assertEquals($expected_file, $info['dirname'] . '/' . $info['basename']);
			$this->assertEquals($status_code, $response->getStatusCode());
		}
		catch (\Exception $e)
		{
			$this->assertEquals($status_code, $e->getStatusCode());
			$this->assertEquals($message, $e->getMessage());
		} 
	}
}
