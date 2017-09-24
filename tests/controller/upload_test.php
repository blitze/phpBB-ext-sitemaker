<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2017 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\controller;

use blitze\sitemaker\controller\upload;

class upload_test extends \phpbb_test_case
{
	/**
	 * Create the blocks admin controller
	 *
	 * @param array $auth_map
	 * @param string $filename
	 * @param int $call_count
	 * @return \blitze\sitemaker\controller\upload
	 */
	protected function get_controller(array $auth_map, $filename, $call_count)
	{
		global $auth, $phpbb_root_path, $phpEx;

		$auth = $this->getMock('\phpbb\auth\auth');
		$auth->expects($this->any())
			->method('acl_get')
			->with($this->stringContains('_'), $this->anything())
			->will($this->returnValueMap($auth_map));

		$clean_filename_mode = 'real';
		$clean_filename_prefix = '';
		if (preg_match('/^(blobid|imagetools)\d?/i', $filename))
		{
			$clean_filename_mode = 'unique';
			$clean_filename_prefix = 'sm_';
		}

		$filespec = $this->getMockBuilder('\phpbb\files\filespec')
			->disableOriginalConstructor()
			->getMock();
		$filespec->expects($this->any())
			->method('get')
			->willReturnCallback(function($prop) use (&$filename) {
				return $prop === 'filename' ? '/path/' . $filename : $filename;
			});
		$filespec->expects($this->exactly($call_count))
			->method('clean_filename')
			->with($clean_filename_mode, $clean_filename_prefix)
			->willReturnCallback(function($clean_filename_mode, $clean_filename_prefix) use (&$filename) {
				$filename = $clean_filename_prefix . ($clean_filename_mode == 'unique' ? 'unique.jpg' : $filename);
			});
		$filespec->expects($this->exactly($call_count))
			->method('move_file')
			->with('images/sitemaker_uploads/source/', true);
		$filespec->error = pathinfo($filename, PATHINFO_EXTENSION) !== 'jpg' ? array('ERROR_MESSAGE') : array();

		$upload = $this->getMockBuilder('\phpbb\files\upload')
			->disableOriginalConstructor()
			->getMock();
		$upload->expects($this->exactly($call_count))
			->method('handle_upload')
			->with('files.types.form', 'file')
			->willReturnCallback(function() use ($filespec) {
				return $filespec;
			});
		$upload->expects($this->exactly($call_count))
			->method('set_disallowed_content')
			->willReturnSelf();
		$upload->expects($this->exactly($call_count))
			->method('set_allowed_extensions')
			->willReturnSelf();

		$container = new \phpbb_mock_container_builder();
		$container->set('files.filespec', $filespec);
		$container->set('files.upload', $upload);

		$files_factory = new \phpbb\files\factory($container);

		$language = new \phpbb\language\language(new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx));

		$controller = new upload($auth, $files_factory, $language, $phpbb_root_path);
		$controller->set_allowed_extensions(array('jpg'));

		return $controller;
	}

	/**
	 * @return array
	 */
	public function sample_data()
	{
		return array(
			array(
				array(
					array('u_sm_filemanager', 0, false),
				),
				'',
				'{"location":"","message":"You are not authorised to access this area."}',
				0,
				401,
			),
			array(
				array(
					array('u_sm_filemanager', 0, true),
				),
				'test.jpg',
				'{"location":"test.jpg","message":""}',
				1,
				200,
			),
			array(
				array(
					array('u_sm_filemanager', 0, true),
				),
				'blobid01.jpg',
				'{"location":"sm_unique.jpg","message":""}',
				1,
				200,
			),
			array(
				array(
					array('u_sm_filemanager', 0, true),
				),
				'imagetools56.jpg',
				'{"location":"sm_unique.jpg","message":""}',
				1,
				200,
			),
			array(
				array(
					array('u_sm_filemanager', 0, true),
				),
				'test.png',
				'{"location":"","message":"ERROR_MESSAGE"}',
				1,
				200,
			),
		);
	}

	/**
	 * @dataProvider sample_data
	 *
	 * @param array $auth_map
	 * @param string $filename
	 * @param string $expected_json
	 * @param int $call_count
	 * @param int $response_code
	 */
	public function test_controller(array $auth, $filename, $expected_json, $call_count, $response_code)
	{
		$controller = $this->get_controller($auth, $filename, $call_count);
		$response = $controller->handle();

		$this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
		$this->assertEquals($response_code, $response->getStatusCode());
		$this->assertSame($expected_json,$response->getContent());
	}
}
