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
	public function setUp(): void
	{
		global $request, $phpbb_container, $phpbb_dispatcher, $user;

		parent::setUp();

		$phpbb_container = new \phpbb_mock_container_builder();

		$request = $this->getMockBuilder('\phpbb\request\request')
			->disableOriginalConstructor()
			->getMock();

		$this->translator = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$this->translator->expects($this->any())
			->method('lang')
			->willReturnCallback(function ()
			{
				return implode('-', func_get_args());
			});

		$user = new \phpbb\user($this->translator, '\phpbb\datetime');

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
	}
}
