<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
*
*/
class calendar
{
 	protected $show_next = true;
	protected $show_prev = true;
	protected $calendar_cp = false;
	protected $recursive = false;
	protected $calendar_week_start = 0;
	protected $append_url = '';
	protected $mini_cal_url = '';
	protected $date_var = 'date';
	protected $cp_mode_var = 'display';
	protected $cp_options = array();
	protected $days_ary = array();

	/**
	 * Constructor
	 *
	 * @param \phpbb\user                			$user       	User object
	 * @param \primetime\primetime\core\primetime	$primetime		Primetime object
	 * @param \primetime\primetime\core\ptemplate	$ptemplate		Primetime Template object
	 */
    public function __construct(\phpbb\user $user, \primetime\primetime\core\primetime $primetime, \primetime\primetime\core\template $ptemplate)
	{
    	$this->user = $user;
    	$this->primetime = $primetime;
		$this->ptemplate = $ptemplate;

		$this->user->add_lang_ext('primetime/primetime', 'calendar');

		$this->u_action = build_url($use->page['page'], 'date');
	}

/*
$year = 2013;
$month = 5;
$day = 20;
$timestamp = $this->user->create_datetime()
				->setDate($year, $month, $day)
				->setTime(0, 0, 0)
				->getTimestamp();
echo $this->user->format_date($timestamp, $this->user->lang['DATE_FORMAT'], true);
*/

	public function getDayHTML($year = false, $month = false, $day = false, $data = array())
	{
		
	}

	public function getWeekHTML($year = false, $month = false, $day = false, $data = array())
	{
		
	}

	public function getMonthHTML($year = false, $month = false, $day = false, $data = array())
	{
		
	}

	public function getYearHTML($year = false, $month = false, $day = false, $data = array())
	{
		
	}

	function build_calendar($mode, $year = false, $month = false, $day = false, $data)
	{
		if ($this->calendar_cp !== true)
		{
			$tpl = "calendar_$mode.html";
			cms_set_template_path($this->template, 'calendar', $tpl);

			$this->template->set_filenames(array(
				'body'	=> $tpl)
			);
		}

		if ($this->recursive !== true)
		{
			$this->u_action .= (strpos($this->u_action, '?') === false) ? '?' : '&amp;';
		}

		list($curr_day, $curr_month, $curr_year) = explode('/', gmdate('j/n/Y', time() + $user->timezone + $user->dst));

		$year	= ($year) ? $year : $curr_year;
		$month	= ($month) ? $month : $curr_month;
		$day	= ($day) ? $day : $curr_day;
		$today	= "$curr_year-$curr_month-$curr_day";

		if ("$curr_year-$curr_month" != "$year-$month")
		{
			$this->show_next = true;
			$this->show_prev = true;
		}

		$u_date = $u_month = $u_day = $this->u_action;
		if ($this->calendar_cp)
		{
			$u_day .= $this->cp_mode_var . '=day&amp;';
			$u_month .= $this->cp_mode_var . '=month&amp;';
			$u_date .= $this->cp_mode_var . "=$mode&amp;";
		}

		$u_day .= $this->date_var . '=';
		$u_month .= $this->date_var . '=';
		$u_date .= $this->date_var . '=';

		if ($this->mini_cal_url)
		{
			$this->mini_cal_url .= ((strpos($this->mini_cal_url, '?') === false) ? '?' : '&amp;') . 'date=';
		}

		$data = $this->prepare_data($data, $mode);

		switch ($mode)
		{
			case 'day':

				$d = "$year-$month-$day";
				$unix_time = mktime(0, 0, 0, $month, $day, $year);

				for ($i = 0; $i < 48; $i++)
				{
					$this->template->assign_block_vars('cal_day', array(
						'TIME'	=> date('h:i a', $unix_time))
					);
	
					$t = date($d . '/H:i', $unix_time);
					if (isset($data[$t]))
					{
						$tdata = $data[$t];
						foreach ($tdata as $row)
						{
							$this->template->assign_block_vars('cal_day.events', array(
								'TITLE'		=> $row['title'],
								'U_LINK'	=> $row['url'])
							);
						}
					}

					$unix_time = strtotime("+30 minutes",  $unix_time);
				}
	
				$unix_time = mktime(12, 0, 0, $month, $day, $year);
				$next_day = date("Y-n-j", $unix_time + 86400);
				$prev_day = date("Y-n-j", $unix_time - 86400);
	
				$this->template->assign_vars(array(
					'DAY'			=> $user->format_date($unix_time, 'l F d, Y'),
					'U_NEXT_DAY'	=> $u_date . $next_day . $this->append_url,
					'U_PREV_DAY'	=> $u_date . $prev_day . $this->append_url)
				);
	
				if ("$curr_year-$curr_month" == "$year-$month")
				{
					if ($curr_day == $day || $curr_day == ($day - 1))
					{
						$this->template->assign_var('L_PREV_DAY', $user->lang['datetime']['YESTERDAY']);
					}
	
					if ($curr_day == $day || $curr_day == ($day + 1))
					{
						$this->template->assign_var('L_NEXT_DAY', $user->lang['datetime']['TOMORROW']);
					}
				}

			break;

			case 'week':

				$unix_start = mktime(12, 0, 0, $month, $day, $year);
				$date = getdate($unix_start);
	
				// We need to work out what date to start at so that the first appears in the correct column
				$offset = $this->calendar_week_start - $date['wday'];
				while ($offset > 1)
				{
					$offset -= 7;
				}
	
				$total_days = $offset + 7;
				for ($i = $offset; $i < $total_days; $i++)
				{
					$unix_time = $unix_start + 86400 * $i;
					$tdate = date('Y-n-j', $unix_time);
	
					$this->template->assign_block_vars('week_days', array(
						'DAY'	=> $user->format_date($unix_time, 'M d'),
						'L_DAY'	=> $user->format_date($unix_time, 'l'),
						'U_DAY'	=> $u_day . $tdate)
					);
				}

				$unix_time = mktime(0, 0, 0, $month, $day, $year);
				for ($i = 0; $i < 24; $i++)
				{
					$this->template->assign_block_vars('cal_time', array(
						'TIME'	=> date('h:i a', $unix_time + ($i * 3600)))
					);

					for ($j = $offset; $j < $total_days; $j++)
					{
						$t = date("Y-n-j/$i", $unix_start + 86400 * $j);
						$this->template->assign_block_vars('cal_time.cal_days', array());

						if (isset($data[$t]))
						{
							$tdata = $data[$t];
							foreach ($tdata as $row)
							{
								$this->template->assign_block_vars('cal_time.cal_days.events', array(
									'TITLE'		=> $row['title'],
									'U_LINK'	=> $row['url'])
								);
							}
						}
					}
				}
	
				$to_year = date('Y', $unix_time);
				$format = ($year != $to_year) ? 'M d, Y' : 'M d';
				$unix_start += 86400 * $offset;
	
				$from_day = $user->format_date($unix_start, $format);
				$to_day = $user->format_date($unix_time, 'M d, Y');
	
				$next_week = $user->format_date($unix_start + 604799, 'Y-n-j');
				$last_week = $user->format_date($unix_start - 604799, 'Y-n-j');
	
				$this->template->assign_vars(array(
					'WEEK_DAYS'		=> sprintf($user->lang['WEEK_OF'], $from_day, $to_day),
					'U_NEXT_WEEK'	=> $u_date . $next_week,
					'U_PREV_WEEK'	=> $u_date . $last_week)
				);

			break;

			case 'mini':
			case 'month':

				$unix_start = mktime(12, 0, 0, $month, 1, $year);

				$this_month = "$year-$month";
				$next_month = date("Y-n", strtotime("+1 month",  $unix_start));
				$last_month = date("Y-n", strtotime("-1 month",  $unix_start));
				$next_year = date("Y-n", strtotime("+1 year",  $unix_start));
				$last_year = date("Y-n", strtotime("-1 year",  $unix_start));

				$tpl_ary = array(
					'S_LINKED'			=> ($this->mini_cal_url || $mode == 'month') ? true : false,
					'S_MONTH'			=> $user->format_date($unix_start, 'F Y'),
					'U_MONTH'			=> (($this->calendar_cp !== true && $this->mini_cal_url) ? $this->mini_cal_url : (($this->recursive) ? $u_month : $u_date)) . $this_month,
					'U_NEXT_MONTH'		=> $u_date . $next_month . $this->append_url,
					'U_LAST_MONTH'		=> $u_date . $last_month . $this->append_url,
					'U_NEXT_YEAR'		=> $u_date . $next_year . $this->append_url,
					'U_LAST_YEAR'		=> $u_date . $last_year . $this->append_url,
				);

				if ($this->recursive)
				{
					$this->template->assign_block_vars('cal_year', $tpl_ary);
					$handle = 'cal_year.cal_mini';
				}
				else
				{
					$this->template->assign_vars($tpl_ary);
					$handle = 'cal_' . $mode;
				}

				// We need to work out what date to start at so that the first appears in the correct column
				$date = getdate($unix_start);
				$offset = $this->calendar_week_start + 1 - $date['wday'];
				while ($offset > 1)
				{
					$offset -= 7;
				}

				$days_in_month = date('t', $unix_start);
				while ($offset <= $days_in_month)
				{
					// this doesn't do anything, just a place holder
					$this->template->assign_block_vars($handle, array());
	
					for ($i = 0; $i < 7; $i++)
					{
						$tagged = false;
						$u_link = $preview = $break = '';
						$day = ($offset > 0 && $offset <= $days_in_month) ? $offset : '';
						$tdate = "$year-$month-$day";

						if (isset($data[$tdate]))
						{
							if ($mode == 'month')
							{
								$tagged = true;
								$u_link = ($this->calendar_cp === true) ? $u_day . $tdate : (($this->mini_cal_url) ? $this->mini_cal_url . $tdate : '');
							}
							else
							{
								$tagged = true;
								$preview = $data[$tdate];
								$u_link = ($this->mini_cal_url) ? $this->mini_cal_url . $tdate : '';
							}
						}

						$this->template->assign_block_vars($handle . '.week', array(
							'S_TAGGED'	=> $tagged,
							'S_TODAY'	=> ($tdate == $today) ? true : false,
							'PREVIEW'	=> $preview,
							'CURR_DAY'	=> $day,
							'U_LINK'	=> $u_link)
						);

						if ($mode == 'month' && $tagged)
						{
							$mdata = $data[$tdate];
							foreach ($mdata as $row)
							{
								$this->template->assign_block_vars($handle . '.week.events', array(
									'TITLE'		=> $row['title'],
									'U_LINK'	=> $row['url'])
								);
							}
						}
	
						$offset++;
					}	
				}

				$handle = '';
				$type = 'full';

				if ($mode == 'mini')
				{
					$type = 'mini';
					$handle = ($this->recursive) ? 'cal_year.' : '';
				}

				$this->template->assign_vars($tpl_ary);

				for ($i = 0; $i < 7; $i++)
				{
					$day = $this->days_ary[($this->calendar_week_start + $i) % 7];
					$this->template->assign_block_vars($handle . 'cal_days', array('WEEKDAY' =>  $user->lang['datetime_' . $type][$day]));
				}

			break;

			case 'year':

				$this->recursive = true;

				for ($i = 1; $i < 13; $i++)
				{
					$this->build_calendar('mini', $year, $i, false, $data);
				}

				$this->template->assign_vars(array(
					'YEAR'			=> $year,
					'U_NEXT_YEAR'	=> $u_date . ($year + 1),
					'U_LAST_YEAR'	=> $u_date . ($year - 1))
				);

			break;
		}

		if ($this->calendar_cp !== true)
		{
			$this->template->assign_vars(array(
				'S_SHOW_NEXT'	=> $this->show_next,
				'S_SHOW_PREV'	=> $this->show_prev)
			);

			return $this->template->assign_display('body');
		}
	}

	function build_calendar_cp($mode, $year = false, $month = false, $day = false, $data)
	{
		global $user;

		$user->add_mod_lang(array('calendar' => 'calendar'));

		$this->template = new template();

		cms_set_template_path($this->template, 'calendar', 'calendar_cp.html');

		$this->template->set_filenames(array(
			'body'	=> 'calendar_cp.html')
		);

		foreach ($this->cp_options as $option)
		{
			$this->template->assign_block_vars('cal_menu', array(
				'S_ACTIVE'	=> ($option == $mode) ? true : false,
				'OPTION'	=> $user->lang[strtoupper($option)],
				'U_OPTION'	=> append_sid($this->u_action, $this->cp_mode_var . '=' . $option))
			);
		}

		$this->calendar_cp = true;
		$this->template->assign_var('S_MODE_FILE', "calendar_$mode.html");

		$this->build_calendar($mode, $year, $month, $day, $data);

		return $this->template->assign_display('body');
	}

	function prepare_data($data, $mode)
	{
		global $user;

		$return = array();
		$format = 'Y-n-j';
		$data = array_filter($data);

		switch ($mode)
		{
			case 'day':

				foreach ($data as $timestamp => $row)
				{
					$time = $user->format_date($timestamp, 'Y-n-j/H:');
					$time .= ($user->format_date($timestamp, 'i') < 30) ? '00' : '30';
					$return[$time][] = $row;
				}

			break;

			case 'mini':

				foreach ($data as $timestamp => $row)
				{
					$date = $user->format_date($timestamp, 'Y-n-j');
					$return[$date][] = '&bull; ' . $row;
				}

				$data = $return;
				$return = array();

				foreach ($data as $date => $row)
				{
					$return[$date] = join("\n", $row);
				}

			break;

			case 'week':
				$format = 'Y-n-j/G';
			// no break here

			default:

				foreach ($data as $timestamp => $row)
				{
					$date = $user->format_date($timestamp, $format);
					$return[$date][] = $row;
				}

			break;
		}

		return $return;
	}

	function get_datetime_limits($mode, $year, $month, $day)
	{
		global $user, $config;

		list($curr_day, $curr_month, $curr_year) = explode(' ', gmdate('j n Y', time() + $user->timezone + $user->dst));

		$year	= ($year) ? $year : $curr_year;
		$month	= ($month) ? $month : $curr_month;
		$day	= ($day) ? $day : $curr_day;

		switch ($mode)
		{
			case 'day':
				$start = gmmktime(0, 0, 0, $month, $day, $year) - $user->timezone - $user->dst;
				$stop = $start + 86399;
			break;

			case 'week':
				$unix_data = $this->get_week_range($year, $month, $day);
				$start_info = getdate($unix_data['start']);
				$stop_info = getdate($unix_data['end']);
	
				$start = gmmktime(0, 0, 0, $start_info['mon'], $start_info['mday'], $start_info['year']) - $user->timezone - $user->dst;
				$stop = $start + 604799;
			break;

			case 'year':
				$start = gmmktime(0, 0, 0, 1, 1, $year) - $user->timezone - $user->dst;
				$leap_year = gmdate('L', $start);
				$num_days = ($leap_year) ? 366 : 365;
				$stop = $start + (86400 * $num_days) - 1;
			break;

			case 'month':
			default: 
				$start = gmmktime(0, 0, 0, $month, 1, $year) - $user->timezone - $user->dst;
				$num_days = gmdate('t', $start);
				$stop = $start + (86400 * $num_days) - 1;
			break;	
		}

		$data['start'] = $start;
		$data['stop'] = $stop;
	
		return $data;
	}
	
	function get_week_range($year, $month, $day)
	{
		global $user;

		list($curr_day, $curr_month, $curr_year) = explode(' ', gmdate('j n Y', time() + $user->timezone + $user->dst));

		$year	= ($year) ? $year : $curr_year;
		$month	= ($month) ? $month : $curr_month;
		$day	= ($day) ? $day : $curr_day;

		$date = getdate(gmmktime(12, 0, 0, $month, $day, $year) - $user->timezone - $user->dst);
		$offset = $this->calendar_week_start - $date['wday'];

		while ($offset > 1)
		{
			$offset -= 7;
		}

		$unix_start = gmmktime(0, 0, 0, $month, $day + $offset, $year) - $user->timezone - $user->dst;
		$unix_data['start'] = $unix_start;
		$unix_data['end'] = ($unix_start + 604800) - 1;

		return $unix_data;
	}
}
