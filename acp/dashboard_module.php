<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\acp;

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

	/** @var \primetime\core\util */
	protected $primetime;

	/** @var string */
	var $tpl_name;

	/** @var string */
	var $page_title;

	/** @var string */
	var $u_action;

	public function __construct()
	{
		global $config, $db, $phpbb_container, $template, $user;

		$this->config = $config;
		$this->db = $db;
		$this->template = $template;
		$this->user = $user;
		$this->primetime = $phpbb_container->get('primetime.core.util');
	}

	public function main($id, $mode)
	{
		$asset_path = $this->primetime->asset_path;
		$this->primetime->add_assets(array(
			'js'        => array(
				'//ajax.googleapis.com/ajax/libs/jqueryui/' . JQUI_VERSION . '/jquery-ui.min.js',
				$asset_path . 'ext/primetime/core/components/jquery-knob/js/jquery.knob.min.js',
				$asset_path . 'ext/primetime/core/components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.js',
				$asset_path . 'ext/primetime/core/components/jquery-rss/dist/jquery.rss.min.js',
				$asset_path . 'ext/primetime/core/components/jquery.sparkline/index.min.js',
				'@primetime_core/assets/adm/dashboard.min.js',
			),
			'css'   => array(
				'//ajax.googleapis.com/ajax/libs/jqueryui/' . JQUI_VERSION . '/themes/smoothness/jquery-ui.css',
				$asset_path . 'ext/primetime/core/components/fontawesome/css/font-awesome.min.css',
				$asset_path . 'ext/primetime/core/components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
				'@primetime_core/assets/adm/dashboard.min.css',
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

		$this->user_stats($weekdays, $lookback, $boarddays);
		$this->topic_stats($weekdays, $lookback, $boarddays);
		$this->post_stats($weekdays, $lookback, $boarddays);
		$this->file_stats($weekdays, $lookback, $boarddays);
		$this->user_contributions();

		// Set up the page
		$this->tpl_name = 'acp_dashboard';
		$this->page_title = 'PRIMETIME_DASHBOARD';
	}

	/**
	 * Get user stats
	 */
	public function user_stats($users_count, $lookback, $boarddays)
	{
		$total_users	= $this->config['num_users'];
		$users_per_day	= sprintf('%.2f', $total_users / $boarddays);
		$users_per_day	= ($users_per_day > $total_users) ? $total_users : $users_per_day;

		$sql = 'SELECT user_regdate
			FROM ' . USERS_TABLE . '
			WHERE user_type IN (' . USER_NORMAL . ',' . USER_FOUNDER . ')
				AND user_regdate > ' . $lookback . '
			ORDER BY user_regdate DESC';
		$result = $this->db->sql_query($sql);

		while($row = $this->db->sql_fetchrow($result))
		{
			$day = $this->user->format_date($row['user_regdate'], 'w', true);
			$users_count[$day]++;
		}
		$this->db->sql_freeresult($result);

		$this->template->assign_vars(array(
			'TOTAL_USERS'		=> $total_users,
			'USERS_PER_DAY'		=> $users_per_day,
			'CHART_USERS'		=> join(',', $users_count)
		));
	}

	/**
	 * Get topic stats
	 */
	public function topic_stats($topics_count, $lookback, $boarddays)
	{
		$total_topics	= $this->config['num_topics'];
		$topics_per_day	= sprintf('%.2f', $total_topics / $boarddays);
		$topics_per_day	= ($topics_per_day > $total_topics) ? $total_topics : $topics_per_day;

		$sql = 'SELECT topic_time 
			FROM ' . TOPICS_TABLE . '
			WHERE topic_visibility = ' . ITEM_APPROVED . '
				AND topic_time > ' . $lookback;
		$result = $this->db->sql_query($sql);

		while($row = $this->db->sql_fetchrow($result))
		{
			$day = $this->user->format_date($row['topic_time'], 'w', true);
			$topics_count[$day]++;
		}
		$this->db->sql_freeresult($result);

		$this->template->assign_vars(array(
			'TOTAL_TOPICS'		=> $total_topics,
			'TOPICS_PER_DAY'	=> $topics_per_day,
			'CHART_TOPICS'		=> join(',', $topics_count)
		));
	}


	/**
	 * Get post stats
	 */
	public function post_stats($posts_count, $lookback, $boarddays)
	{
		$total_posts	= $this->config['num_posts'] - $this->config['num_topics'];
		$posts_per_day	= sprintf('%.2f', $total_posts / $boarddays);
		$posts_per_day	= ($posts_per_day > $total_posts) ? $total_posts : $posts_per_day;

		$sql = 'SELECT p.post_time 
			FROM ' . POSTS_TABLE . ' p, ' . TOPICS_TABLE . ' t
			WHERE p.post_id <> t.topic_first_post_id
				AND p.topic_id = t.topic_id
				AND p.post_visibility  = ' . ITEM_APPROVED . '
				AND p.post_time > ' . $lookback;
		$result = $this->db->sql_query($sql);

		while($row = $this->db->sql_fetchrow($result))
		{
			$day = $this->user->format_date($row['post_time'], 'w', true);
			$posts_count[$day]++;
		}
		$this->db->sql_freeresult($result);

		$this->template->assign_vars(array(
			'TOTAL_POSTS'	=> $total_posts,
			'POSTS_PER_DAY'	=> $posts_per_day,
			'CHART_POSTS'	=> join(',', $posts_count)
		));
	}

	/**
	 * Get file stats
	 */
	public function file_stats($file_count, $lookback, $boarddays)
	{
		$total_files	= $this->config['num_files'];
		$files_per_day	= sprintf('%.2f', $total_files / $boarddays);
		$files_per_day	= ($files_per_day > $total_files) ? $total_files : $files_per_day;

		$sql = 'SELECT filetime
			FROM ' . ATTACHMENTS_TABLE  . '
			WHERE is_orphan = 0
				AND filetime > ' . $lookback;
		$result = $this->db->sql_query($sql);

		while($row = $this->db->sql_fetchrow($result))
		{
			$day = $this->user->format_date($row['filetime'], 'w', true);
			$file_count[$day]++;
		}
		$this->db->sql_freeresult($result);

		$this->template->assign_vars(array(
			'TOTAL_FILES'	=> $total_files,
			'FILES_PER_DAY'	=> $files_per_day,
			'CHART_FILES'	=> join(',', $file_count)
		));
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
		$this->db->sql_freeresult();

		$this->template->assign_var('PERCENT_CONTRIB', sprintf('%.1f', ($posters / $this->config['num_users']) * 100));
	}
}
