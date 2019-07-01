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
	 * @return \blitze\sitemaker\ext
	 */
	public function get_ext($required_phpbb_version)
	{
		$config = new \phpbb\config\config(['version' => '3.2.7']);

		$translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function () {
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
			->willReturnCallback(function($name) use ($required_phpbb_version) {
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

		$container->set('user', $this->user);
		$container->set('config', $config);
		$container->set('ext.manager', $ext_manager);

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
				false,
				'<br>PHPBB_VERSION_UNMET-3.2.8',
			),
			array(
				'>=3.2.8,<3.3.0@dev',
				false,
				'<br>PHPBB_VERSION_UNMET->=3.2.8,<3.3.0@dev',
			),
			array(
				'>=3.2.7,<3.3.0@dev',
				true,
				'',
			),
		);
	}

	/**
	 * @dataProvider ext_test_data
	 * @param string $required_phpbb_version
	 * @param bool $expected_result
	 * @param string $expect_message
	 * @return void
	 */
	public function test_is_enableable($required_phpbb_version, $expected_result, $expected_message)
	{
		$ext = $this->get_ext($required_phpbb_version);
		$result = $ext->is_enableable();

		$this->assertEquals($expected_result, $result);
		$this->assertEquals($expected_message, $this->user->lang['EXTENSION_NOT_ENABLEABLE']);
	}
}
