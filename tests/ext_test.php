<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2017 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests;

class ext_test extends \phpbb_test_case
{
	protected $ext;

	/**
	 * Configure the test environment.
	 *
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();

		$this->config = new \phpbb\config\config(array());

		$container = new \phpbb_mock_container_builder();
		$container->set('config', $this->config);

		$finder = $this->getMockBuilder('\phpbb\finder')
			->disableOriginalConstructor()
			->getMock();

		$migrator = $this->getMockBuilder('\phpbb\db\migrator')
			->disableOriginalConstructor()
			->getMock();

		$this->ext = new \blitze\sitemaker\ext($container, $finder, $migrator, 'some_ext', 'some_path');
	}

	/**
	 * @return array
	 */
	public function ext_test_data()
	{
		return array(
			array('3.2.0', false),
			array('3.2.1', true),
		);
	}

	/**
	 * @dataProvider ext_test_data
	 * @return void
	 */
	public function test_is_enableable($phpbb_version, $expected)
	{
		$this->config->set('version', $phpbb_version);

		$this->assertEquals($expected, $this->ext->is_enableable());
	}
}
