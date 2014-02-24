<?php
/**
*
* @package phpBB Primetime [English]
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
	// Block names
	'PRIMETIME.BLOCK.BIRTHDAY'			=> 'Birthday',
	'PRIMETIME.BLOCK.CUSTOM'			=> 'Custom Block',
	'PRIMETIME.BLOCK.FEATURED_MEMBER'	=> 'Featured Member',
	'PRIMETIME.BLOCK.FORUM_TOPICS'		=> 'Forum Topics',
	'PRIMETIME.BLOCK.LOGIN'				=> 'Login Box',
	'PRIMETIME.BLOCK.MENU'				=> 'Menu',
	'PRIMETIME.BLOCK.MEMBERS'			=> 'Members',
	'PRIMETIME.BLOCK.MEMBER_MENU'		=> 'Member Memu',
	'PRIMETIME.BLOCK.STATS'				=> 'Statistics',
	'PRIMETIME.BLOCK.WHOIS'				=> 'Who is online',

	'ALL'					=> 'All',
	'NONE'					=> 'None',
	'EDIT'					=> 'Edit',
	'CANCEL'				=> 'Cancel',
	'COPY'					=> 'Copy',
	'COPY_BLOCKS'			=> 'Copy Blocks?',
	'DELETE'				=> 'Delete',
	'EDIT_BLOCK'			=> 'Edit Block',
	'DELETE_BLOCK'			=> 'Delete Block',
	'EXIT_EDIT_MODE'		=> 'Exit Edit Mode',
	'SAVE_CHANGES'			=> 'Save Changes',
	'SELECT_ICON'			=> 'Select an Icon',
	'ADD_BLOCK_EXPLAIN'		=> '*Drag and Drop blocks',
	'AJAX_LOADING'			=> 'Loading...',
	'AJAX_PROCESSING'		=> 'Working...',
	'BLOCKS_COPY_FROM'		=> 'Or Copy from',

	'CLEAR'					=> 'Clear',
	'LISTS'					=> 'Lists',
	'BACKGROUND'			=> 'Background',
	'IMAGES'				=> 'Images',
	'BLOCK_ACTIVE'			=> 'Active',
	'BLOCK_INACTIVE'		=> 'Inactive',
	'BLOCK_DESIGN'			=> 'Appearance',
	'BLOCK_CLASS'			=> 'CSS Class',
	'BLOCK_STATUS'			=> 'Status',
	'BLOCK_PERMISSION'		=> 'Viewable by',
	'BLOCK_HIDE_CONTAINER'	=> 'Hide block container?',
	'BLOCK_HIDE_TITLE'		=> 'Hide block title?',
	'BLOCK_NOT_FOUND'		=> 'Oops! The requested block service was not found',
	'BLOCK_NO_ID'			=> 'Oops! Missing block id',
	'BLOCK_NO_DATA'			=> 'No data to display',
	'BLOCK_UPDATED'			=> 'Block settings successfully updated',
	'LAYOUT_SAVED'			=> 'Layout successfully saved!',
	'ROUTE_UPDATED'			=> 'Page settings successfully updated',

	'HIDE_ALL_BLOCKS'		=> 'Do not show blocks on this page',
	'HIDE_BLOCK_POSITIONS'	=> 'Do not show blocks for the following block positions',
	'LAYOUT_SETTINGS'		=> 'Layout Settings',
	'MAKE_DEFAULT_LAYOUT'	=> 'Set As Default Layout',
	'VIEW_DEFAULT_LAYOUT'	=> 'View/Edit Default Layout',
	'REMOVE_DEFAULT_LAYOUT'	=> 'Remove As Default Layout',

	'SETTINGS'				=> 'Settings',
	'EDIT_ME'				=> 'Please edit me',
	'SHOW_HIDE_ME'			=> 'Allow hide online status?',
	'AUTO_LOGIN'			=> 'Allow auto login?',
	'QUERY_TYPE'			=> 'Display Mode',
	'FREQUENCY'				=> 'Frequency',
	'DATE_RANGE'			=> 'Date Range',
	'MAX_MEMBERS'			=> 'Max. Members',
	'FEATURED_MEMBER_IDS'	=> 'User IDs',
	'SHOW_MEMBER_MENU'		=> 'Show user menu?',
	'MEMBERS_DATE'			=> 'Date',

	'ROTATE_PAGELOAD'		=> 'Page load',
	'ROTATE_HOURLY'			=> 'Hourly',
	'ROTATE_DAILY'			=> 'Daily',
	'ROTATE_WEEKLY'			=> 'Weekly',
	'ROTATE_MONTHLY'		=> 'Monthly',

	'MAX_TOPICS'			=> 'Maximum number of topics',
	'MAX_POSTS'				=> 'Maximum number of posts',
	'TOPIC_TITLE_LIMIT'		=> 'Maximum # of characters for topic title',
	'POSTS_TITLE_LIMIT'		=> 'Maximum # of characters for post title',
	'POLL_FROM_USERS'		=> 'Display polls from user(s)',
	'POLL_FROM_GROUPS'		=> 'Display polls from groups(s)',
	'POLL_FROM_TOPICS'		=> 'Display polls from topic(s)',
	'POLL_FROM_FORUMS'		=> 'Display polls from forums(s)',
	'RANDOM'				=> 'Random',
	'LIMIT_POST_TIME'		=> 'Limit by Post time',
	'ORDER_BY'				=> 'Order by',
	'GET_TYPE'				=> 'Display Topic/Post?',
	'DISPLAY_PREVIEW'		=> 'Display Preview?',
	'PREVIEW_MAX_CHARS'		=> 'Number of characters to preview',
	'TEMPLATE'				=> 'Template',
	'SELECT_FORUMS'			=> 'Select forums',
	'LIMIT_FORUMS'			=> 'Forum Ids (optional)',

	'TOPICS'				=> 'Topics',
	'POSTS'					=> 'Posts',
	'FIRST_POST'			=> 'Yes - First Post',
	'LAST_POST'				=> 'Yes - Last Post',
	'FIRST_POST_TIME'		=> 'First Post Time',
	'LAST_POST_TIME'		=> 'Last Post Time',
	'LAST_READ_TIME'		=> 'Last Read Time',
	'TOPIC_TYPE'			=> 'Topic Type',
	'POST_NORMAL'			=> 'Normal',
	'POST_GLOBAL'			=> 'Global',
    'POST_STICKY'			=> 'Sticky',
    'POST_ANNOUNCEMENT'		=> 'Announcement',
	'TITLES'				=> 'Titles',
	'MINI'					=> 'Mini',
	'CONTEXT'				=> 'Context',
	'FULL'					=> 'Full',
	'ALL'					=> 'All',
	'OR'					=> '<strong>OR</strong>',
	'ENABLE_TOPIC_TRACKING'	=> 'Enable topic tracking?',

	'FORUMS_MAX_TOPICS'			=> 'Maximum topics/posts',
	'FORUMS_TITLE_MAX_CHARS'	=> 'Maximum characters per title',
	'FORUMS_GET_TYPE'			=> 'Get type',
	'TOPIC_TYPE_EXPLAIN'		=> 'Select the topic types you’d like to display. Leave the boxes unchecked to select from all topic types',
	'LIMIT_POST_TIME_EXPLAIN'	=> 'If set, only topics posted within the specified period will be retrieved',
	'LIMIT_FORUMS_EXPLAIN'		=> 'Enter each forum id separated by a comma (,). If set, only topics from specified forums will be displayed.',
	'SELECT_FORUMS_EXPLAIN'		=> 'Select the forums from which to display topics/posts. Leave blank to select from all forums',
	'POLL_FROM_USERS_EXPLAIN'	=> 'Id(s) of user(s) whose polls you’d like to display, separated by <strong>commas</strong>(,). Leave blank to select polls from any user.',
	'POLL_FROM_GROUPS_EXPLAIN'	=> 'Only polls from members of the selected groups will be displayed as long as no user(s) is/are specified above',
	'POLL_FROM_TOPICS_EXPLAIN'	=> 'Id(s) of topics to retrieve polls from, separated by <strong>commas</strong>(,). Leave blank to select any topic.',
	'POLL_FROM_FORUMS_EXPLAIN'	=> 'Only polls from the selected forums will be displayed as long as no topics are specified above',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'	=> 'If enabled, unread topics will be indicated but the block results will not be cached <strong>(Not recommended)</strong>',

	'SETTING_TOO_LOW'		=> 'The provided value for the setting “%1$s” is too low. The minimum acceptable value is %2$d.',
	'SETTING_TOO_BIG'		=> 'The provided value for the setting “%1$s” is too high. The maximum acceptable value is %2$d.',
	'SETTING_TOO_LONG'		=> 'The provided value for the setting “%1$s” is too long. The maximum acceptable length is %2$d.',
	'SETTING_TOO_SHORT'		=> 'The provided value for the setting “%1$s” is too short. The minimum acceptable length is %2$d.',

	'AJAX_ERROR'					=> 'Oops! There was an error processing your request. Please try again.',
	'COPY_BLOCKS_CONFIRM'			=> 'Are you sure that want to copy blocks from another page?<br /><br />This will delete all existing blocks and their settings for this page and replace them with the blocks from the selected page.',
	'LEAVE_CONFIRM'					=> 'You have some unsaved changes to this page. Please save your work before moving on',
	'DELETE_BLOCK_CONFIRM'			=> 'Are you sure you want to delete this block?<br /><br /><br /><strong>Note:</strong> You will have to save the layout changes to make this permanent.',
	'DEFAULT_LAYOUT_EXPLAIN'		=> 'If set, all site pages for which you have not specified blocks will inherit the blocks from the default layout. You may, however, override the default layout for particular pages using the options to the right below.',
	'FEATURED_MEMBER_IDS_EXPLAIN'	=> 'Comma separated list of users to feature (Only applies to Featured Member display mode)',
	'SHOW_MEMBER_MENU_EXPLAIN'		=> 'Replace login box with user menu if user is logged in',
));
