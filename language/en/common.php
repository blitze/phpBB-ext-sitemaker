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
	'MENU'					=> 'Menu',
	'WELCOME'				=> 'Welcome',
	'BLOCK_TITLE'			=> 'Block Title',
	'MEMBERS_DATE'			=> 'Date',

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

	'TODAY'					=> 'Today',
	'THIS_WEEK'				=> 'This Week',
	'THIS_MONTH'			=> 'This Month',
	'THIS_YEAR'				=> 'This Year',

	'LAST_VISITED'			=> 'Last Visited',
	'RECENT_BOTS'			=> 'Recent Search Engines',
	'RECENT_MEMBERS'		=> 'Recent Members',
	'MOST_TENURED'			=> 'Most Tenured',
	'TOP_POSTERS'			=> 'Top Posters',

	'QTYPE_RECENT'			=> 'Please welcome our newest member:',
	'QTYPE_POSTS'			=> 'Congratulations to:',
	'FEATURED_MEMBERLIST'	=> 'Featured members list',
));
