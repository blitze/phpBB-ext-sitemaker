<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests;

class ext_test extends \phpbb_test_case
{
	/**
	 * @param string $required_phpbb_version
	 * @param bool $image_is_writable
	 * @return \blitze\sitemaker\ext
	 */
	public function get_ext($required_phpbb_version, $image_is_writable)
	{
		global $phpbb_root_path;

		$config = new \phpbb\config\config(['version' => '3.2.7']);

		$translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function ()
			{
				return implode('-', func_get_args());
			});

		$this->user = new \phpbb\user($translator, '\phpbb\datetime');
		$this->user->lang = ['EXTENSION_NOT_ENABLEABLE' => ''];

		$container = new \phpbb_mock_container_builder();

		$ext_manager = $this->getMockBuilder('\phpbb\extension\manager')
			->disableOriginalConstructor()
			->getMock();
		$ext_manager->expects($this->any())
			->method('create_extension_metadata_manager')
			->willReturnCallback(function ($name) use ($required_phpbb_version)
			{
				$metadata_manager = new \phpbb_mock_metadata_manager($name, '');
				$metadata = [
					'name'		=> $name,
					'type'		=> 'phpbb-extension',
					'license'	=> 'GPL2',
					'authors'	=> [['name'	=> 'foo bar']],
					'version'	=> '3.0.0',
					'extra'		=> [
						'soft-require'	=> [
							'phpbb/phpbb'	=> $required_phpbb_version,
						],
					],
				];
				$metadata_manager->set_metadata($metadata);
				return $metadata_manager;
			});

		$filesystem = $this->getMockBuilder('\phpbb\filesystem\filesystem')
			->disableOriginalConstructor()
			->getMock();
		$filesystem->expects($this->any())
			->method('exists')
			->willReturn(false);
		$filesystem->expects($this->any())
			->method('is_writable')
			->willReturn($image_is_writable);

		$container->set('user', $this->user);
		$container->set('config', $config);
		$container->set('ext.manager', $ext_manager);
		$container->set('filesystem', $filesystem);
		$container->setParameter('core.root_path', $phpbb_root_path);

		$finder = $this->getMockBuilder('\phpbb\finder')
			->disableOriginalConstructor()
			->getMock();

		$migrator = $this->getMockBuilder('\phpbb\db\migrator')
			->disableOriginalConstructor()
			->getMock();

		return new \blitze\sitemaker\ext($container, $finder, $migrator, 'some_ext', 'some_path');
	}

	/**
	 * @return array
	 */
	public function ext_test_data()
	{
		return array(
			array(
				'3.2.8',
				true,
				array(
					'EXTENSION_NOT_ENABLEABLE-',
					'PHPBB_VERSION_UNMET-3.2.8',
				),
			),
			array(
				'>=3.2.8,<3.3.0@dev',
				true,
				array(
					'EXTENSION_NOT_ENABLEABLE-',
					'PHPBB_VERSION_UNMET->=3.2.8,<3.3.0@dev',
				),
			),
			array(
				'>=3.2.8,<3.3.0@dev',
				false,
				array(
					'EXTENSION_NOT_ENABLEABLE-',
					'PHPBB_VERSION_UNMET->=3.2.8,<3.3.0@dev',
					'IMAGE_DIRECTORY_NOT_WRITABLE-',
				),
			),
			array(
				'>=3.2.7,<3.3.0@dev',
				false,
				array(
					'EXTENSION_NOT_ENABLEABLE-',
					'IMAGE_DIRECTORY_NOT_WRITABLE->=3.2.7,<3.3.0@dev',
				),
			),
			array(
				'>=3.2.7,<3.3.0@dev',
				true,
				true
			),
			array(
				'>=3.2.0,<3.2.6',
				true,
				array(
					'EXTENSION_NOT_ENABLEABLE-',
					'PHPBB_VERSION_UNMET->=3.2.0,<3.2.6',
				),
			),
		);
	}

	/**
	 * @dataProvider ext_test_data
	 * @param string $required_phpbb_version
	 * @param bool $image_is_writable
	 * @param bool $expected_result
	 * @return void
	 */
	public function test_is_enableable($required_phpbb_version, $image_is_writable, $expected_result)
	{
		$ext = $this->get_ext($required_phpbb_version, $image_is_writable);
		$result = $ext->is_enableable();

		$this->assertEquals($expected_result, $result);
	}
}
