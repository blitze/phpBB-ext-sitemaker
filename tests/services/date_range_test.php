<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services;

use blitze\sitemaker\services\date_range;

class date_range_test extends \phpbb_test_case
{
	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\date_range */
	protected $date_range;

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
	public function setUp()
	{
		global $phpbb_dispatcher, $template;

		parent::setUp();

		require_once dirname(__FILE__) . '/../../../../../includes/functions.php';

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$this->user = new \phpbb\user('\phpbb\datetime');
		$this->user->timezone = new \DateTimeZone('UTC');
		$this->user->lang['datetime'] = array();

		// we force current date
		$date = '25 November 2015';

		$this->date_range = new date_range($this->user, $date);
	}

	/**
	 * Data set for test_date_range
	 *
	 * @return array
	 */
	public function date_range_test_data()
	{
		return array(
			array(
				'',
				array(
					'start'	=> 0,
					'stop'	=> 0,
					'date'	=> '',
				),
			),
			array(
				'today',
				array(
					'start'	=> '2015-11-25 00:00',
					'stop'	=> '2015-11-25 23:59',
					'date'	=> '2015-11-25',
				),
			),
			array(
				'week',
				array(
					'start'	=> '2015-11-22 00:00',
					'stop'	=> '2015-11-28 23:59',
					'date'	=> '2015-11-22',
				),
			),
			array(
				'month',
				array(
					'start'	=> '2015-11-01 00:00',
					'stop'	=> '2015-11-30 23:59',
					'date'	=> '2015-11',
				),
			),
			array(
				'year',
				array(
					'start'	=> '2015-01-01 00:00',
					'stop'	=> '2015-12-31 23:59',
					'date'	=> '2015',
				),
			),
		);
	}

	/**
	 * Test the get_date_range method
	 *
	 * @dataProvider date_range_test_data
	 */
	public function test_date_range($range, $expected)
	{
		$data = $this->date_range->get($range);

		if ($data['start'])
		{
			$data['start'] = $this->user->format_date($data['start'], 'Y-m-d H:i', true);
		}

		if ($data['stop'])
		{
			$data['stop'] = $this->user->format_date($data['stop'], 'Y-m-d H:i', true);
		}

		$this->assertSame($expected, $data);
	}
}
