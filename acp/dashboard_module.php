<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\base\acp;

class dashboard_module
{
	var $u_action;

	function main($id, $mode)
	{
		global $config, $db, $phpbb_container, $request, $template, $user, $phpbb_root_path, $phpEx;

		$primetime = $phpbb_container->get('primetime.base.util');

		$asset_path = $primetime->asset_path;
		$primetime->add_assets(array(
			'js'        => array(
				'//ajax.googleapis.com/ajax/libs/jqueryui/' . JQUI_VERSION . '/jquery-ui.min.js',
				$asset_path . 'ext/primetime/base/components/jquery-knob/js/jquery.knob.min.js',
				$asset_path . 'ext/primetime/base/components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.js',
				$asset_path . 'ext/primetime/base/components/jquery-rss/dist/jquery.rss.min.js',
				$asset_path . 'ext/primetime/base/components/jquery.sparkline/index.min.js',
				'@primetime_base/assets/adm/dashboard.min.js',
			),
			'css'   => array(
				'//ajax.googleapis.com/ajax/libs/jqueryui/' . JQUI_VERSION . '/themes/smoothness/jquery-ui.css',
				$asset_path . 'ext/primetime/base/components/fontawesome/css/font-awesome.min.css',
				$asset_path . 'ext/primetime/base/components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
				'@primetime_base/assets/adm/dashboard.min.css',
			)
		));

		$time = $user->create_datetime();
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
			$js_weekdays[] = "$count: '" . $user->format_date(strtotime("- $i days"), 'l M j', true) . "'";
			$count++;
		}
		$template->assign_var('UA_WEEKDAYS', join(', ', $js_weekdays));

		$lookback = $now[0] - (6 * 24 * 3600);
		$boarddays = ($now[0] - $config['board_startdate']) / 86400;

		$this->user_stats($weekdays, $lookback, $boarddays);
		$this->topic_stats($weekdays, $lookback, $boarddays);
		$this->post_stats($weekdays, $lookback, $boarddays);
		$this->file_stats($weekdays, $lookback, $boarddays);
		$this->user_contributions();

		// Set up the page
		$this->tpl_name = 'acp_dashboard';
		$this->page_title = 'PRIMETIME_DASHBOARD';
	}

	public function user_stats($users_count, $lookback, $boarddays)
	{
		global $config, $db, $template, $user;

		$total_users	= $config['num_users'];
		$users_per_day	= sprintf('%.2f', $total_users / $boarddays);
		$users_per_day	= ($users_per_day > $total_users) ? $total_users : $users_per_day;

		$sql = 'SELECT user_regdate
			FROM ' . USERS_TABLE . '
			WHERE user_type IN (' . USER_NORMAL . ',' . USER_FOUNDER . ')
				AND user_regdate > ' . $lookback . '
			ORDER BY user_regdate DESC';
		$result = $db->sql_query($sql);

		while($row = $db->sql_fetchrow($result))
		{
			$day = $user->format_date($row['user_regdate'], 'w', true);
			$users_count[$day]++;
		}
		$db->sql_freeresult($result);

		$template->assign_vars(array(
			'TOTAL_USERS'		=> $total_users,
			'USERS_PER_DAY'		=> $users_per_day,
			'CHART_USERS'		=> join(',', $users_count)
		));
	}

	public function topic_stats($topics_count, $lookback, $boarddays)
	{
		global $config, $db, $template, $user;

		$total_topics	= $config['num_topics'];
		$topics_per_day	= sprintf('%.2f', $total_topics / $boarddays);
		$topics_per_day	= ($topics_per_day > $total_topics) ? $total_topics : $topics_per_day;

		$sql = 'SELECT topic_time 
			FROM ' . TOPICS_TABLE . '
			WHERE topic_visibility = ' . ITEM_APPROVED . '
				AND topic_time > ' . $lookback;
		$result = $db->sql_query($sql);

		while($row = $db->sql_fetchrow($result))
		{
			$day = $user->format_date($row['topic_time'], 'w', true);
			$topics_count[$day]++;
		}
		$db->sql_freeresult($result);

		$template->assign_vars(array(
			'TOTAL_TOPICS'		=> $total_topics,
			'TOPICS_PER_DAY'	=> $topics_per_day,
			'CHART_TOPICS'		=> join(',', $topics_count)
		));
	}

	public function post_stats($posts_count, $lookback, $boarddays)
	{
		global $config, $db, $template, $user;

		$total_posts	= $config['num_posts'] - $config['num_topics'];
		$posts_per_day	= sprintf('%.2f', $total_posts / $boarddays);
		$posts_per_day	= ($posts_per_day > $total_posts) ? $total_posts : $posts_per_day;

		$sql = 'SELECT p.post_time 
			FROM ' . POSTS_TABLE . ' p, ' . TOPICS_TABLE . ' t
			WHERE p.post_id <> t.topic_first_post_id
				AND p.topic_id = t.topic_id
				AND p.post_visibility  = ' . ITEM_APPROVED . '
				AND p.post_time > ' . $lookback;
		$result = $db->sql_query($sql);

		while($row = $db->sql_fetchrow($result))
		{
			$day = $user->format_date($row['post_time'], 'w', true);
			$posts_count[$day]++;
		}
		$db->sql_freeresult($result);

		$template->assign_vars(array(
			'TOTAL_POSTS'	=> $total_posts,
			'POSTS_PER_DAY'	=> $posts_per_day,
			'CHART_POSTS'	=> join(',', $posts_count)
		));
	}

	public function file_stats($file_count, $lookback, $boarddays)
	{
		global $config, $db, $template, $user;

		$total_files	= $config['num_files'];
		$files_per_day	= sprintf('%.2f', $total_files / $boarddays);
		$files_per_day	= ($files_per_day > $total_files) ? $total_files : $files_per_day;

		$sql = 'SELECT filetime
			FROM ' . ATTACHMENTS_TABLE  . '
			WHERE is_orphan = 0
				AND filetime > ' . $lookback;
		$result = $db->sql_query($sql);

		while($row = $db->sql_fetchrow($result))
		{
			$day = $user->format_date($row['filetime'], 'w', true);
			$file_count[$day]++;
		}
		$db->sql_freeresult($result);

		$template->assign_vars(array(
			'TOTAL_FILES'	=> $total_files,
			'FILES_PER_DAY'	=> $files_per_day,
			'CHART_FILES'	=> join(',', $file_count)
		));
	}

	public function user_contributions()
	{
		global $config, $db, $template, $user;

		// percent users involved
		$sql = 'SELECT COUNT(*) AS posters FROM ' . USERS_TABLE . ' WHERE user_posts <> 0';
		$result = $db->sql_query($sql);
		$posters = $db->sql_fetchfield('posters');
		$db->sql_freeresult();

		$template->assign_var('PERCENT_CONTRIB', sprintf('%.1f', ($posters / $config['num_users']) * 100));
	}
}
