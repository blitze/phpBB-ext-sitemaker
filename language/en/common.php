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

	'LAST_VISITED_ALL'		=> 'Last Visited',
	'RECENT_BOTS_ALL'		=> 'Recent Bots',
	'RECENT_MEMBERS_ALL'	=> 'Newest Members',
	'MOST_TENURED_ALL'		=> 'Most Tenured Members',
	'TOP_POSTERS_ALL'		=> 'Top Posters',

	'LAST_VISITED_TODAY'	=> 'Last Visited Today',
	'RECENT_BOTS_TODAY'		=> 'Today’s Recent Bots',
	'RECENT_MEMBERS_TODAY'	=> 'Today’s Newest Members',
	'TOP_POSTERS_TODAY'		=> 'Today’s Top Posters',

	'LAST_VISITED_THIS_WEEK'	=> 'Last Visited This Week',
	'RECENT_BOTS_THIS_WEEK'		=> 'Recent Bots This week',
	'RECENT_MEMBERS_THIS_WEEK'	=> 'This Week’s Newest Members',
	'TOP_POSTERS_THIS_WEEK'		=> 'This Week’s Top Posters',

	'LAST_VISITED_THIS_MONTH'	=> 'Last Visited This Month',
	'RECENT_BOTS_THIS_MONTH'	=> 'Recent Bots This Month',
	'RECENT_MEMBERS_THIS_MONTH'	=> 'This Month’s Newest Members',
	'TOP_POSTERS_THIS_MONTH'	=> 'This Month’s Top Posters',

	'LAST_VISITED_THIS_YEAR'	=> 'Last Visited This Year',
	'RECENT_BOTS_THIS_YEAR'		=> 'Recent Bots This Year',
	'RECENT_MEMBERS_THIS_YEAR'	=> 'This Year’s Newest Members',
	'TOP_POSTERS_THIS_YEAR'		=> 'This Years’s Top Posters',

	'QTYPE_RECENT'				=> 'Please welcome our newest member:',
	'QTYPE_POSTS'				=> 'Congratulations to:',
	'FEATURED_MEMBERLIST'		=> 'Featured members list',
));
