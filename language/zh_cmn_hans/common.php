<?php

/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

/**
 * DO NOT CHANGE
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ALL_TIME'						=> '全部时间',

	'BLOCK_TITLE'					=> '块标题',

	'CHANGE_ME'						=> '更改我',

	'DAILY_MEMBER'					=> '当天的成员',

	'FEATURED_MEMBER'				=> '精选成员',
	'FEATURED_MEMBERLIST'			=> '精选成员列表',
	'FEEDS'							=> '订阅源',
	'FORUM_ANNOUNCEMENTS'			=> '论坛公告',
	'FORUM_GLOBAL_ANNOUNCEMENTS'	=> '全球论坛公告',
	'FORUM_RECENT_POSTS'			=> '最近的论坛帖子',
	'FORUM_RECENT_TOPICS'			=> '最近的论坛主题',
	'FORUM_STICKY_POSTS'			=> '最近置顶帖子',

	'HELP'							=> '帮助',
	'HOURLY_MEMBER'					=> '小时成员',

	'GOOGLE_MAP'					=> '谷歌地图',

	'JOIN_DATE'						=> '加入日期',

	'LAST_POST_BY_AUTHOR'			=> '最后一个帖子由',
	'LAST_VISITED'					=> '上次访问',
	'LINKS'							=> '链接',

	'MCP_SITEMAKER_CONTENT'			=> '目录',
	'MEMBERS_DATE'					=> '日期',
	'MENU'							=> '菜单',
	'MONTHLY_MEMBER'				=> '月份成员',
	'MOST_TENURED'					=> '最有效的',
	'MY_BOOKMARKS'					=> '我的书签',

	'NO_BOOKMARKED_TOPICS'			=> '您还没有给任何主题添加书签',
	'NO_NEW_TOPICS'					=> '没有要显示的新主题',

	'POLL'							=> '投票',
	'POPULAR_TOPICS'				=> '热门主题',
	'POSTS_MEMBER'					=> '顶级海报',
	'PROCESSING'					=> '正在处理...',

	'QTYPE_POSTS'					=> '恭喜：',
	'QTYPE_RECENT'					=> '请欢迎我们的最新成员：',

	'RECENT_BOTS'					=> '最近的搜索引擎',
	'RECENT_MEMBER'					=> '最近的成员',
	'RECENT_MEMBERS'				=> '最近成员',

	'SESSION_HIDE_ME'				=> '隐藏我',
	'SM_NAVIGATION'					=> '导航栏',
	'SM_TOGGLE_DROPDOWN'			=> '切换下拉列表',
	'STYLE_SWITCHER'				=> '样式切换器',

	'THIS_MONTH'					=> '本月',
	'THIS_WEEK'						=> '本周',
	'THIS_YEAR'						=> '本年',
	'TODAY'							=> '今日：',
	'TOPICS_LAST_READ'				=> '最后阅读主题',
	'TOPIC_LAST_READ'				=> '最后读取 %s',
	'TOP_POSTERS'					=> '热门海报',

	'UCP_SITEMAKER_CONTENT'			=> '我的',

	'VIEW_DETAILS'					=> '查看详情',
	'VIEW_USER_PROFILE'				=> '全部关于 %s',

	'WEEKLY_MEMBER'					=> '每周成员',
	'WELCOME'						=> '欢迎使用',
	'WHATS_NEW'						=> '有什么新内容？',
	'WORDGRAPH'						=> '单词图',
));
