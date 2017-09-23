<?php
/**
*
* @package phpBB Sitemaker [English]
* @copyright (c) 2012 Daniel A. (blitze)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* @ignore
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
	'ALL_TYPES'									=> 'All Types',
	'ALL_FORUMS'								=> 'All Forums',
	'ALL_GROUPS'								=> 'All Groups',
	'ARCHIVES'									=> 'Archives',
	'AUTO_LOGIN'								=> 'Allow auto login?',
	'FILE_MANAGER'								=> 'File Manager',
	'TOPIC_POST_IDS'							=> 'From Topic/Post Ids',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(s) of topics/posts to retrieve attachments from, separated by <strong>commas</strong>(,). Specify if this list is for topic or post ids above.',
	'TOPIC_POST_IDS_TYPE'						=> 'Type of IDs (below)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Attachments',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Birthday',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Custom Block',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Featured Member',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Forum Poll',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Forum Topics',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Links',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Login Box',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Members',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Member Menu',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Menu',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'My Bookmarks',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Statistics',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Style Switcher',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'What’s New?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Who is online',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Wordgraph',

	// block views
	'BASED_ON'									=> 'Based on',
	'BLOCK_VIEW'								=> 'Block View',
	'BLOCK_VIEW_BASIC'							=> 'Basic',
	'BLOCK_VIEW_BOXED'							=> 'Boxed',
	'BLOCK_VIEW_DEFAULT'						=> 'Default',
	'BLOCK_VIEW_SIMPLE'							=> 'Simple',

	'CONTEXT'									=> 'Context',
	'CUSTOM_PROFILE_FIELDS'						=> 'Custom Profile Fields',

	'DATE_RANGE'								=> 'Date Range',
	'DISPLAY_PREVIEW'							=> 'Display Preview?',

	'EDIT_ME'									=> 'Please edit me',
	'ENABLE_TOPIC_TRACKING'						=> 'Enable topic tracking?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'If enabled, unread topics will be indicated but the block results will not be cached <strong>(Not recommended)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'You have entered too many words to exclude. The maximum number of characters possible is 255, you have entered %s.',
	'EXCLUDE_WORDS'								=> 'Exclude words',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'List the words you’d like to exclude from the wordgraph separated by a comma (,). Maximum 255 characters.',
	'EXPANDED'									=> 'Expanded',
	'EXTENSION_GROUP'							=> 'Extension Group',

	'FEATURED_MEMBER_IDS'						=> 'User IDs',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Comma separated list of users to feature (Only applies to Featured Member display mode)',
	'FIRST_POST_ONLY'							=> 'First Post Only',
	'FIRST_POST_TIME'							=> 'First Post Time',
	'FORUMS_GET_TYPE'							=> 'Get type',
	'FORUMS_MAX_TOPICS'							=> 'Maximum topics/posts',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Maximum characters per title',
	'FREQUENCY'									=> 'Frequency',
	'FULL'										=> 'Full',

	'GET_TYPE'									=> 'Display Topic/Post?',

	'LAST_POST_TIME'							=> 'Last Post Time',
	'LAST_READ_TIME'							=> 'Last Read Time',
	'LIMIT'										=> 'Limit',
	'LIMIT_FORUMS'								=> 'Forum Ids (optional)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Enter each forum id separated by a comma (,). If set, only topics from specified forums will be displayed.',
	'LIMIT_POST_TIME'							=> 'Limit by Post time',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'If set, only topics posted within the specified period will be retrieved',

	'MAX_DEPTH'									=> 'Maximum depth',
	'MAX_MEMBERS'								=> 'Max. Members',
	'MAX_POSTS'									=> 'Maximum number of posts',
	'MAX_TOPICS'								=> 'Maximum number of topics',
	'MAX_WORDS'									=> 'Maximum number of words',
	'MEMBERS_DATE'								=> 'Date',
	'MENU_NO_ITEMS'								=> 'No active items to display',
	'MINI'										=> 'Mini',

	'OR'										=> '<strong>OR</strong>',
	'ORDER_BY'									=> 'Order by',

	'PIXEL'										=> 'px',
	'POLL_FROM_FORUMS'							=> 'Display polls from forums(s)',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Only polls from the selected forums will be displayed as long as no topics are specified above',
	'POLL_FROM_GROUPS'							=> 'Display polls from groups(s)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Only polls from members of the selected groups will be displayed as long as no user(s) is/are specified above',
	'POLL_FROM_TOPICS'							=> 'Display polls from topic(s)',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(s) of topics to retrieve polls from, separated by <strong>commas</strong>(,). Leave blank to select any topic.',
	'POLL_FROM_USERS'							=> 'Display polls from user(s)',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id(s) of user(s) whose polls you’d like to display, separated by <strong>commas</strong>(,). Leave blank to select polls from any user.',
	'POSTS_TITLE_LIMIT'							=> 'Maximum # of characters for post title',
	'PREVIEW_MAX_CHARS'							=> 'Number of characters to preview',

	'QUERY_TYPE'								=> 'Display Mode',

	'ROTATE_DAILY'								=> 'Daily',
	'ROTATE_HOURLY'								=> 'Hourly',
	'ROTATE_MONTHLY'							=> 'Monthly',
	'ROTATE_PAGELOAD'							=> 'Page load',
	'ROTATE_WEEKLY'								=> 'Weekly',

	'SELECT_FORUMS'								=> 'Select forums',
	'SELECT_FORUMS_EXPLAIN'						=> 'Select the forums from which to display topics/posts. Leave blank to select from all forums',
	'SELECT_MENU'								=> 'Select Menu',
	'SELECT_PROFILE_FIELDS'						=> 'Select profile fields',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Only the selected profile fields will be displayed, if available.',
	'SHOW_FIRST_POST'							=> 'First Post',
	'SHOW_HIDE_ME'								=> 'Allow hide online status?',
	'SHOW_LAST_POST'							=> 'Last Post',
	'SHOW_MEMBER_MENU'							=> 'Show user menu?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Replace login box with user menu if user is logged in',
	'SHOW_WORD_COUNT'							=> 'Show word count?',
	'SOURCE'									=> 'Source',
	'SOURCE_EXPLAIN'							=> '<strong>Use this textarea to enter raw HTML content.</strong><br />Please note that any content posted here will override the custom block content and the visual block editor will not be available.',

	'TEMPLATE'									=> 'Template',
	'TOPICS_ONLY'								=> 'Topics only?',
	'TOPIC_TITLE_LIMIT'							=> 'Maximum # of characters for topic title',
	'TOPIC_TYPE'								=> 'Topic Type',
	'TOPIC_TYPE_EXPLAIN'						=> 'Select the topic types you’d like to display. Leave the boxes unchecked to select from all topic types',

	'WORD_MAX_SIZE'								=> 'Maximum font size',
	'WORD_MIN_SIZE'								=> 'Minimum font size',
));
