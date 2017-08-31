<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services;

class date_range
{
	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $time;

	/**
	 * Constructor
	 *
	 * @param \phpbb\user		$user		User object
	 * @param string			$time		String in a format accepted by strtotime().
	 */
	public function __construct(\phpbb\user $user, $time = 'now')
	{
		$this->user = $user;
		$this->time = $time;
	}

	/**
	 * @param string $range Date range to get (today, week, month, year)
	 * @return array
	 */
	public function get($range)
	{
		$time = $this->user->create_datetime($this->time);
		$now = phpbb_gmgetdate($time->getTimestamp() + $time->getOffset());

		$method = 'get_' . $range;
		$data = array(
			'start'	=> 0,
			'stop'	=> 0,
			'date'	=> '',
		);

		if (is_callable(array($this, $method)))
		{
			$data = call_user_func_array(array($this, $method), array($now));
		}

		return $data;
	}

	/**
	 * @param array $now
	 * @return array
	 */
	public function get_today(array $now)
	{
		$start = $this->user->create_datetime()
			->setDate($now['year'], $now['mon'], $now['mday'])
			->setTime(0, 0, 0)
			->getTimestamp();

		return array(
			'start'	=> $start,
			'stop'	=> $start + 86399,
			'date'	=> $this->user->format_date($start, 'Y-m-d', true),
		);
	}

	/**
	 * @param array $now
	 * @return array
	 */
	public function get_week(array $now)
	{
		$info = getdate($now[0] - (86400 * $now['wday']));
		$start = $this->user->create_datetime()
			->setDate($info['year'], $info['mon'], $info['mday'])
			->setTime(0, 0, 0)
			->getTimestamp();

		return array(
			'start'	=> $start,
			'stop'	=> $start + 604799,
			'date'	=> $this->user->format_date($start, 'Y-m-d', true),
		);
	}

	/**
	 * @param array $now
	 * @return array
	 */
	public function get_month(array $now)
	{
		$start = $this->user->create_datetime()
			->setDate($now['year'], $now['mon'], 1)
			->setTime(0, 0, 0)
			->getTimestamp();
		$num_days = gmdate('t', $start);

		return array(
			'start'	=> $start,
			'stop'	=> $start + (86400 * $num_days) - 1,
			'date'	=> $this->user->format_date($start, 'Y-m', true),
		);
	}

	/**
	 * @param array $now
	 * @return array
	 */
	public function get_year(array $now)
	{
		$start = $this->user->create_datetime()
			->setDate($now['year'], 1, 1)
			->setTime(0, 0, 0)
			->getTimestamp();
		$leap_year = gmdate('L', $start);
		$num_days = ($leap_year) ? 366 : 365;

		return array(
			'start'	=> $start,
			'stop'	=> $start + (86400 * $num_days) - 1,
			'date'	=> $this->user->format_date($start, 'Y', true),
		);
	}
}
