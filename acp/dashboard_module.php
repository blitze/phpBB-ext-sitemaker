<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\acp;

class dashboard_module
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\util */
	protected $sitemaker;

	/** @var string */
	protected $tpl_name;

	/** @var string */
	protected $page_title;

	/** @var string */
	protected $u_action;

	public function __construct()
	{
		global $config, $db, $phpbb_container, $template, $user;

		$this->config = $config;
		$this->db = $db;
		$this->template = $template;
		$this->user = $user;
		$this->sitemaker = $phpbb_container->get('blitze.sitemaker.util');
	}

	public function main()
	{
		$asset_path = $this->sitemaker->asset_path;
		$this->sitemaker->add_assets(array(
			'js'	=> array(
				'//ajax.googleapis.com/ajax/libs/jqueryui/' . JQUI_VERSION . '/jquery-ui.min.js',
				$asset_path . 'ext/blitze/sitemaker/components/jquery-knob/js/jquery.knob.min.js',
				$asset_path . 'ext/blitze/sitemaker/components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.js',
				$asset_path . 'ext/blitze/sitemaker/components/moment/moment.min.js',
				$asset_path . 'ext/blitze/sitemaker/components/jquery-rss/dist/jquery.rss.min.js',
				$asset_path . 'ext/blitze/sitemaker/components/jquery.sparkline/index.min.js',
				'@blitze_sitemaker/assets/adm/dashboard.min.js',
			),
			'css'   => array(
				'//ajax.googleapis.com/ajax/libs/jqueryui/' . JQUI_VERSION . '/themes/smoothness/jquery-ui.css',
				$asset_path . 'ext/blitze/sitemaker/components/fontawesome/css/font-awesome.min.css',
				$asset_path . 'ext/blitze/sitemaker/components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
				'@blitze_sitemaker/assets/adm/dashboard.min.css',
			)
		));

		$time = $this->user->create_datetime();
		$now = phpbb_gmgetdate($time->getTimestamp() + $time->getOffset());
		$wday = $now['wday'];

		$weekdays = array();
		while ($wday >= 0)
		{
			$weekdays[$wday] = 0;
			$wday--;
		}

		for ($i = 6, $size = sizeof($weekdays); $i >= $size; $i--)
		{
			$weekdays[$i] = 0;
		}

		$weekdays = array_reverse($weekdays, true);

		$count = 0;
		$js_weekdays = array();
		for ($i = 6; $i >= 0; $i--)
		{
			$js_weekdays[] = "$count: '" . $this->user->format_date(strtotime("- $i days"), 'l M j', true) . "'";
			$count++;
		}
		$this->template->assign_var('UA_WEEKDAYS', join(', ', $js_weekdays));

		$lookback = $now[0] - (6 * 24 * 3600);
		$boarddays = ($now[0] - $this->config['board_startdate']) / 86400;

		$this->get_stats('users', $weekdays, $lookback, $boarddays);
		$this->get_stats('topics', $weekdays, $lookback, $boarddays);
		$this->get_stats('posts', $weekdays, $lookback, $boarddays);
		$this->get_stats('files', $weekdays, $lookback, $boarddays);
		$this->user_contributions();

		// Set up the page
		$this->tpl_name = 'acp_dashboard';
		$this->page_title = 'SITEMAKER_DASHBOARD';
	}

	/**
	 * Get stats
	 *
	 * @param string	$stat		Kind of stat to get: users/topics/posts/files
	 * @param array		$weekdays	Array of weekdays
	 * @param int		$lookback	Lookback period
	 * @param int		$boarddays	Age of board
	 */
	public function get_stats($stat, $weekdays, $lookback, $boarddays)
	{
		$sql = '';
		$total = $this->config['num_' . $stat];
		$per_day = sprintf('%.2f', $total / $boarddays);
		$per_day = ($per_day > $total) ? $total : $per_day;

		switch ($stat)
		{
			case 'users':
			$sql = 'SELECT user_regdate AS time_field
					FROM ' . USERS_TABLE . '
					WHERE user_type IN (' . USER_NORMAL . ',' . USER_FOUNDER . ')
						AND user_regdate > ' . $lookback . '
					ORDER BY user_regdate DESC';
			break;

			case 'topics':
			$sql = 'SELECT topic_time AS time_field
					FROM ' . TOPICS_TABLE . '
					WHERE topic_visibility = ' . ITEM_APPROVED . '
						AND topic_time > ' . $lookback;
			break;

			case 'posts':
			$sql = 'SELECT p.post_time AS time_field
					FROM ' . POSTS_TABLE . ' p, ' . TOPICS_TABLE . ' t
					WHERE p.post_id <> t.topic_first_post_id
						AND p.topic_id = t.topic_id
						AND p.post_visibility  = ' . ITEM_APPROVED . '
						AND p.post_time > ' . $lookback;
			break;

			case 'files':
			$sql = 'SELECT filetime AS time_field
					FROM ' . ATTACHMENTS_TABLE  . '
					WHERE is_orphan = 0
						AND filetime > ' . $lookback;
			break;
		}

		if ($sql)
		{
			$result = $this->db->sql_query($sql);

			while ($row = $this->db->sql_fetchrow($result))
			{
				$day = $this->user->format_date($row['time_field'], 'w', true);
				$weekdays[$day]++;
			}
			$this->db->sql_freeresult($result);
		}

		$data =  array(
			$stat . '_total'	=> $total,
			$stat . '_per_day'	=> $per_day,
			$stat . '_chart'	=> join(',', $weekdays),
		);

		$this->template->assign_vars(array_change_key_case($data, CASE_UPPER));
	}

	/**
	 * Get user engagement stats
	 */
	public function user_contributions()
	{
		// percent users involved
		$sql = 'SELECT COUNT(*) AS posters FROM ' . USERS_TABLE . ' WHERE user_posts <> 0';
		$result = $this->db->sql_query($sql);
		$posters = $this->db->sql_fetchfield('posters');
		$this->db->sql_freeresult($result);

		$this->template->assign_var('PERCENT_CONTRIB', sprintf('%.1f', ($posters / $this->config['num_users']) * 100));
	}
}
