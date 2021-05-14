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
	 * @param bool $writable
	 * @param int $user_type
	 * @param string $filename
	 * @param string $upload_dir
	 * @return \blitze\sitemaker\controller\upload
	 */
	protected function get_controller($writable, $user_type, $filename, $upload_dir)
	{
		global $phpbb_root_path, $phpEx;

		$call_count = (int) $writable;

		$config = new \phpbb\config\config(array());

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
			->willReturnCallback(function ($prop) use (&$filename)
			{
				return $prop === 'filename' ? '/path/' . $filename : $filename;
			});
		$filespec->expects($this->exactly($call_count))
			->method('clean_filename')
			->with($clean_filename_mode, $clean_filename_prefix)
			->willReturnCallback(function ($clean_filename_mode, $clean_filename_prefix) use (&$filename)
			{
				$filename = $clean_filename_prefix . ($clean_filename_mode == 'unique' ? 'unique.jpg' : $filename);
			});
		$filespec->expects($this->exactly($call_count))
			->method('move_file')
			->with($upload_dir, true);
		$filespec->error = pathinfo($filename, PATHINFO_EXTENSION) !== 'jpg' ? array('ERROR_MESSAGE') : array();

		$filesystem = $this->getMockBuilder('\phpbb\filesystem\filesystem')
			->getMock();

		if (!$writable)
		{
			$filesystem->expects($this->any())
				->method('mkdir')
				->will($this->throwException(new \Exception('FILESYSTEM_CANNOT_CREATE_DIRECTORY')));
		}

		$upload = $this->getMockBuilder('\phpbb\files\upload')
			->disableOriginalConstructor()
			->getMock();
		$upload->expects($this->exactly($call_count))
			->method('handle_upload')
			->with('files.types.form', 'file')
			->willReturnCallback(function () use ($filespec)
			{
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

		$user = new \phpbb\user($language, '\phpbb\datetime');
		$user->data['user_id'] = 48;
		$user->data['username'] = 'demo';
		$user->data['user_type'] = $user_type;

		$controller_helper = $this->getMockBuilder('\phpbb\controller\helper')
			->disableOriginalConstructor()
			->getMock();
		$controller_helper->expects($this->any())
			->method('route')
			->with('blitze_sitemaker_file', $this->arrayHasKey('file'), false, '')
			->willReturnCallback(function ($route, $params)
			{
				return '/phpbb/phpBB/app.php/sitemaker/file/' . $params['file'];
			});

		$filemanager = new \blitze\sitemaker\services\filemanager($filesystem, $user, $phpbb_root_path);

		$controller = new upload($files_factory, $controller_helper, $language, $filemanager);
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
				true,
				USER_NORMAL,
				'test.tif',
				'images/sitemaker_uploads/source/users/demo',
				'{"location":"","message":"ERROR_MESSAGE"}',
			),
			array(
				true,
				USER_NORMAL,
				'test.jpg',
				'images/sitemaker_uploads/source/users/demo',
				'{"location":"\/phpbb\/phpBB\/app.php\/sitemaker\/file\/users\/demo\/test.jpg","message":""}',
			),
			array(
				true,
				USER_FOUNDER,
				'blobid01.jpg',
				'images/sitemaker_uploads/source',
				'{"location":"\/phpbb\/phpBB\/app.php\/sitemaker\/file\/sm_unique.jpg","message":""}',
			),
			array(
				false,
				USER_NORMAL,
				'blobid01.jpg',
				'images/sitemaker_uploads/source',
				'{"location":"","message":"FILESYSTEM_CANNOT_CREATE_DIRECTORY"}',
			),
		);
	}

	/**
	 * @dataProvider sample_data
	 *
	 * @param bool $writable
	 * @param int $user_type
	 * @param string $filename
	 * @param string $upload_dir
	 * @param string $expected_json
	 */
	public function test_controller($writable, $user_type, $filename, $upload_dir, $expected_json)
	{
		$controller = $this->get_controller($writable, $user_type, $filename, $upload_dir);
		$response = $controller->handle();

		$this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
		$this->assertSame($expected_json, $response->getContent());
	}
}
