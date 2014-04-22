<?php
/**
 *
 * @package phpBB Primetime [English]
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
	'HELP'					=> 'Help',
	'MENU'					=> 'Menu',
	'WELCOME'				=> 'Welcome',
	'BLOCK_TITLE'			=> 'Block Title',
	'JOIN_DATE'				=> 'Join Date',
	'MEMBERS_DATE'			=> 'Date',
	'SESSION_HIDE_ME'		=> 'Hide Me',
	'PT_REQUIRED_FIELDS'	=> '* Required Fields',
	'FIELD_REQUIRED'		=> '“%s” is a required field',
	'FIELD_INVALID'			=> 'The provided value for the field “%s” has an invalid format',
	'FIELD_TOO_SHORT'		=> 'The provided value for the field “%1$s” is too short. The minimum acceptable value is %2$d.',
	'FIELD_TOO_LONG'		=> 'The provided value for the field “%1$s” is too long. The maximum acceptable value is %2$d.',

	'FEATURED_MEMBER'		=> 'Featured Member',
	'RECENT_MEMBER'			=> 'Recent Member',
	'RANDOM_MEMBER'			=> 'Random Member',
	'POSTS_MEMBER'			=> 'Top Poster',
	'LAST_VISITED'			=> 'Last Visited',
	'VIEW_USER_PROFILE'		=> 'All about %s',

	'HOURLY_MEMBER'			=> 'Member of the hour',
	'DAILY_MEMBER'			=> 'Member of the day',
	'WEEKLY_MEMBER'			=> 'Member of the week',
	'MONTHLY_MEMBER'		=> 'Member of the month',
	'FEATURED_MEMBER'		=> 'Featured Member',
	'RECENT_MEMBER'			=> 'Recent Member',
	'RANDOM_MEMBER'			=> 'Random Member',
	'POSTS_MEMBER'			=> 'Top Poster',

	'ALL'					=> 'All',
	'ALL_TIME'				=> 'All Time',
	'TODAY'					=> 'Today',
	'THIS_WEEK'				=> 'This Week',
	'THIS_MONTH'			=> 'This Month',
	'THIS_YEAR'				=> 'This Year',

	'LAST_VISITED'			=> 'Last Visited',
	'RECENT_BOTS'			=> 'Recent Search Engines',
	'RECENT_MEMBERS'		=> 'Recent Members',
	'MOST_TENURED'			=> 'Most Tenured',
	'TOP_POSTERS'			=> 'Top Posters',
	'MY_BOOKMARKS'			=> 'My Bookmarks',
	'NO_BOOKMARKS'			=> 'You have not bookmarked any topics',
	'WHATS_NEW'				=> 'What’s New?',
	'NO_NEW_TOPICS'			=> 'There are no new topics to display',
	'NO_NEW_POSTS'			=> 'There are no new posts to display',

	'QTYPE_RECENT'			=> 'Please welcome our newest member:',
	'QTYPE_POSTS'			=> 'Congratulations to:',
	'FEATURED_MEMBERLIST'	=> 'Featured members list',

	'FORUM_RECENT_TOPICS'			=> 'Recent Forum Topics',
	'FORUM_RECENT_POSTS'			=> 'Recent Forum Posts',
	'FORUM_STICKY_POSTS'			=> 'Recent Sticky Posts',
	'FORUM_ANNOUNCEMENTS'			=> 'Forum Announcements',
	'FORUM_GLOBAL_ANNOUNCEMENTS'	=> 'Global Forum Announcements',
	'TOPIC_LAST_READ'				=> 'Last read %s',
	'TOPICS_LAST_READ'				=> 'Last Read Topics',
));
