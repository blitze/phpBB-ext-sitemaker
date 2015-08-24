<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services;

use blitze\sitemaker\services\url_checker;

class url_checker_test extends \phpbb_test_case
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
	 * Data set for test_add_assets
	 *
	 * @return array
	 */
	public function exits_test_data()
	{
		return array(
			array('', false, false),
			array('', true, false),
			array('http://www.google.com', true, true),
			array('http://www.google.com', false, true),
			array('http://www.random-site.com/sitemaker', true, false),
			array('http://www.random-site.com/sitemaker', false, false),
		);
	}

	/**
	 * Test the exits method
	 *
	 * @dataProvider exits_test_data
	 */
	public function test_exits($url, $curl, $expected)
	{
		$url_checker = new url_checker();
		$this->assertEquals($expected, $url_checker->exists($url, $curl));
	} 
}
