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
	'ADD_BLOCK_EXPLAIN'						=> '*Drag and Drop blocks',
	'AJAX_ERROR'							=> 'Oops! There was an error processing your request. Please try again.',
	'AJAX_LOADING'							=> 'Loading...',
	'AJAX_PROCESSING'						=> 'Working...',
	'ALL'									=> 'All',
	'ALLOW_WORD_COUNT'						=> 'Enable word counter',
	'ALLOW_WORD_COUNT_EXPLAIN'				=> 'Allow display the total number of words after each word, e.g. <samp>phpBB(33)</samp>',
	'AUTO_LOGIN'							=> 'Allow auto login?',

	'BACKGROUND'							=> 'Background',
	'BLOCKS'								=> 'Blocks',
	'BLOCKS_COPY_FROM'						=> 'Copy Blocks',
	'BLOCK_ACTIVE'							=> 'Active',
	'BLOCK_CLASS'							=> 'CSS Class',
	'BLOCK_DESIGN'							=> 'Appearance',
	'BLOCK_DISPLAY_TYPE'					=> 'Display',
	'BLOCK_HIDE_CONTAINER'					=> 'Hide block container?',
	'BLOCK_HIDE_TITLE'						=> 'Hide block title?',
	'BLOCK_INACTIVE'						=> 'Inactive',
	'BLOCK_NOT_FOUND'						=> 'Oops! The requested block service was not found',
	'BLOCK_NO_DATA'							=> 'No data to display',
	'BLOCK_NO_ID'							=> 'Oops! Missing block id',
	'BLOCK_PERMISSION'						=> 'Viewable by',
	'BLOCK_SHOW_ALWAYS'						=> 'Always',
	'BLOCK_SHOW_LANDING_ONLY'				=> 'Landing Only',
	'BLOCK_SHOW_SUBPAGE_ONLY'				=> 'Sub-page Only',
	'BLOCK_STATUS'							=> 'Status',
	'BLOCK_UPDATED'							=> 'Block settings successfully updated',

	'CANCEL'								=> 'Cancel',
	'CLEAR'									=> 'Clear',
	'CONTEXT'								=> 'Context',
	'COPY'									=> 'Copy',
	'COPY_BLOCKS'							=> 'Copy Blocks?',
	'COPY_BLOCKS_CONFIRM'					=> 'Are you sure that you’d like to copy blocks from another page?<br /><br />This will delete all existing blocks and their settings for this page and replace them with the blocks from the selected page.',
	'CUSTOM_PROFILE_FIELDS'					=> 'Custom Profile Fields',

	'DATE_RANGE'							=> 'Date Range',
	'DEFAULT_LAYOUT_EXPLAIN'				=> 'If set, all site pages for which you have not specified blocks will inherit the blocks from the default layout. You may, however, override the default layout for particular pages using the options to the right below.',
	'DELETE'								=> 'Delete',
	'DELETE_ALL_BLOCKS'						=> 'Delete All Blocks',
	'DELETE_ALL_BLOCKS_CONFIRM'				=> 'Are you sure that you’d like to delete all blocks for this page?',
	'DELETE_BLOCK'							=> 'Delete Block',
	'DELETE_BLOCK_CONFIRM'					=> 'Are you sure you want to delete this block?<br /><br /><br /><strong>Note:</strong> You will have to save the layout changes to make this permanent.',
	'DISPLAY_PREVIEW'						=> 'Display Preview?',

	'EDIT'									=> 'Edit',
	'EDIT_BLOCK'							=> 'Edit Block',
	'EDIT_ME'								=> 'Please edit me',
	'ENABLE_TOPIC_TRACKING'					=> 'Enable topic tracking?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'			=> 'If enabled, unread topics will be indicated but the block results will not be cached <strong>(Not recommended)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'				=> 'You have entered too many words to exclude. The maximum number of characters possible is 255, you have entered %s.',
	'EXCLUDE_WORDS'							=> 'Exclude words',
	'EXCLUDE_WORDS_EXPLAIN'					=> 'List the words you’d like to exclude from the wordgraph separated by a comma (,). Maximum 255 characters.',
	'EXIT_EDIT_MODE'						=> 'Exit Edit Mode',
	'EXPANDED'								=> 'Expanded',

	'FEATURED_MEMBER_IDS'					=> 'User IDs',
	'FEATURED_MEMBER_IDS_EXPLAIN'			=> 'Comma separated list of users to feature (Only applies to Featured Member display mode)',
	'FIELD_INVALID'							=> 'The provided value for the field “%s” has an invalid format',
	'FIELD_REQUIRED'						=> '“%s” is a required field',
	'FIELD_TOO_LONG'						=> 'The provided value for the field “%1$s” is too long. The maximum acceptable value is %2$d.',
	'FIELD_TOO_SHORT'						=> 'The provided value for the field “%1$s” is too short. The minimum acceptable value is %2$d.',
	'FIRST_POST_TIME'						=> 'First Post Time',
	'FORUMS_GET_TYPE'						=> 'Get type',
	'FORUMS_MAX_TOPICS'						=> 'Maximum topics/posts',
	'FORUMS_TITLE_MAX_CHARS'				=> 'Maximum characters per title',
	'FREQUENCY'								=> 'Frequency',
	'FULL'									=> 'Full',

	'GET_TYPE'								=> 'Display Topic/Post?',

	'HIDE_ALL_BLOCKS'						=> 'Do not show blocks on this page',
	'HIDE_BLOCK_POSITIONS'					=> 'Do not show blocks for the following block positions',

	'IMAGES'								=> 'Images',

	'LAST_POST_TIME'						=> 'Last Post Time',
	'LAST_READ_TIME'						=> 'Last Read Time',
	'LAYOUT'								=> 'Layout',
	'LAYOUT_SAVED'							=> 'Layout successfully saved!',
	'LAYOUT_SETTINGS'						=> 'Layout Settings',
	'LEAVE_CONFIRM'							=> 'You have some unsaved changes to this page. Please save your work before moving on',
	'LIMIT_FORUMS'							=> 'Forum Ids (optional)',
	'LIMIT_FORUMS_EXPLAIN'					=> 'Enter each forum id separated by a comma (,). If set, only topics from specified forums will be displayed.',
	'LIMIT_POST_TIME'						=> 'Limit by Post time',
	'LIMIT_POST_TIME_EXPLAIN'				=> 'If set, only topics posted within the specified period will be retrieved',
	'LISTS'									=> 'Lists',

	'MAKE_DEFAULT_LAYOUT'					=> 'Set As Default Layout',
	'MAX_DEPTH'								=> 'Maximum depth',
	'MAX_MEMBERS'							=> 'Max. Members',
	'MAX_POSTS'								=> 'Maximum number of posts',
	'MAX_TOPICS'							=> 'Maximum number of topics',
	'MEMBERS_DATE'							=> 'Date',
	'MINI'									=> 'Mini',

	'NONE'									=> 'None',

	'OR'									=> '<strong>OR</strong>',
	'ORDER_BY'								=> 'Order by',

	'PIXEL'									=> 'px',
	'POLL_FROM_FORUMS'						=> 'Display polls from forums(s)',
	'POLL_FROM_FORUMS_EXPLAIN'				=> 'Only polls from the selected forums will be displayed as long as no topics are specified above',
	'POLL_FROM_GROUPS'						=> 'Display polls from groups(s)',
	'POLL_FROM_GROUPS_EXPLAIN'				=> 'Only polls from members of the selected groups will be displayed as long as no user(s) is/are specified above',
	'POLL_FROM_TOPICS'						=> 'Display polls from topic(s)',
	'POLL_FROM_TOPICS_EXPLAIN'				=> 'Id(s) of topics to retrieve polls from, separated by <strong>commas</strong>(,). Leave blank to select any topic.',
	'POLL_FROM_USERS'						=> 'Display polls from user(s)',
	'POLL_FROM_USERS_EXPLAIN'				=> 'Id(s) of user(s) whose polls you’d like to display, separated by <strong>commas</strong>(,). Leave blank to select polls from any user.',
	'POSTS'									=> 'Posts',
	'POSTS_TITLE_LIMIT'						=> 'Maximum # of characters for post title',
	'POST_ANNOUNCEMENT'						=> 'Announcement',
	'POST_GLOBAL'							=> 'Global',
	'POST_NORMAL'							=> 'Normal',
	'POST_STICKY'							=> 'Sticky',
	'PREVIEW_MAX_CHARS'						=> 'Number of characters to preview',
	'PRIMETIME_CORE_BLOCK_BIRTHDAY'			=> 'Birthday',
	'PRIMETIME_CORE_BLOCK_CUSTOM'			=> 'Custom Block',
	'PRIMETIME_CORE_BLOCK_FEATURED_MEMBER'	=> 'Featured Member',
	'PRIMETIME_CORE_BLOCK_FORUM_POLL'		=> 'Forum Poll',
	'PRIMETIME_CORE_BLOCK_FORUM_TOPICS'		=> 'Forum Topics',
	'PRIMETIME_CORE_BLOCK_LOGIN'			=> 'Login Box',
	'PRIMETIME_CORE_BLOCK_MEMBERS'			=> 'Members',
	'PRIMETIME_CORE_BLOCK_MEMBER_MENU'		=> 'Member Menu',
	'PRIMETIME_CORE_BLOCK_MENU'				=> 'Menu',
	'PRIMETIME_CORE_BLOCK_MYBOOKMARKS'		=> 'My Bookmarks',
	'PRIMETIME_CORE_BLOCK_STATS'			=> 'Statistics',
	'PRIMETIME_CORE_BLOCK_WHATS_NEW'		=> 'What’s New?',
	'PRIMETIME_CORE_BLOCK_WHOIS'			=> 'Who is online',
	'PRIMETIME_CORE_BLOCK_WORDGRAPH'		=> 'Wordgraph',
	'PT_REQUIRED_FIELDS'					=> '* Required Fields',

	'QUERY_TYPE'							=> 'Display Mode',

	'RANDOM'								=> 'Random',
	'REMOVE_DEFAULT_LAYOUT'					=> 'Remove As Default Layout',
	'REMOVE_STARTPAGE'						=> 'Remove As Start Page',
	'ROTATE_DAILY'							=> 'Daily',
	'ROTATE_HOURLY'							=> 'Hourly',
	'ROTATE_MONTHLY'						=> 'Monthly',
	'ROTATE_PAGELOAD'						=> 'Page load',
	'ROTATE_WEEKLY'							=> 'Weekly',
	'ROUTE_HIDDEN_BLOCKS'					=> 'Blocks are being hidden for this page',
	'ROUTE_HIDDEN_POSITIONS'				=> 'Blocks are being hidden for the following positions',
	'ROUTE_UPDATED'							=> 'Page settings successfully updated',

	'SAVE_CHANGES'							=> 'Save Changes',
	'SAVE_SETTINGS'							=> 'Save Settings',
	'SELECT_FORUMS'							=> 'Select forums',
	'SELECT_FORUMS_EXPLAIN'					=> 'Select the forums from which to display topics/posts. Leave blank to select from all forums',
	'SELECT_ICON'							=> 'Select an Icon',
	'SELECT_MENU'							=> 'Select Menu',
	'SELECT_PROFILE_FIELDS'					=> 'Select profile fields',
	'SELECT_PROFILE_FIELDS_EXPLAIN'			=> 'Only the selected profile fields will be displayed, if available.',
	'SETTINGS'								=> 'Settings',
	'SETTING_TOO_BIG'						=> 'The provided value for the setting “%1$s” is too high. The maximum acceptable value is %2$d.',
	'SETTING_TOO_LONG'						=> 'The provided value for the setting “%1$s” is too long. The maximum acceptable length is %2$d.',
	'SETTING_TOO_LOW'						=> 'The provided value for the setting “%1$s” is too low. The minimum acceptable value is %2$d.',
	'SETTING_TOO_SHORT'						=> 'The provided value for the setting “%1$s” is too short. The minimum acceptable length is %2$d.',
	'SET_STARTPAGE'							=> 'Set As Start Page',
	'SHOW_FIRST_POST'						=> 'Yes - First Post',
	'SHOW_HIDE_ME'							=> 'Allow hide online status?',
	'SHOW_LAST_POST'						=> 'Yes - Last Post',
	'SHOW_MEMBER_MENU'						=> 'Show user menu?',
	'SHOW_MEMBER_MENU_EXPLAIN'				=> 'Replace login box with user menu if user is logged in',

	'TEMPLATE'								=> 'Template',
	'TITLES'								=> 'Titles',
	'TOGGLE'								=> 'Toggle',
	'TOPICS'								=> 'Topics',
	'TOPICS_ONLY'							=> 'Topics only?',
	'TOPIC_TITLE_LIMIT'						=> 'Maximum # of characters for topic title',
	'TOPIC_TYPE'							=> 'Topic Type',
	'TOPIC_TYPE_EXPLAIN'					=> 'Select the topic types you’d like to display. Leave the boxes unchecked to select from all topic types',

	'UPDATE_SIMILAR'						=> 'Update blocks with similar settings',

	'VIEW_DEFAULT_LAYOUT'					=> 'View/Edit Default Layout',
	'VISIT_PAGE'							=> 'Visit Page',

	'WORDS'									=> 'Words',
	'WORD_MAX_SIZE'							=> 'Maximum font size',
	'WORD_MAX_SIZE_EXPLAIN'					=> 'Set maximum value of font size for words in wordgraph.',
	'WORD_MIN_SIZE'							=> 'Minimum font size',
	'WORD_MIN_SIZE_EXPLAIN'					=> 'Set minimum value of font size for words in wordgraph.',
	'WORD_NUMBER'							=> 'Number of words',
	'WORD_NUMBER_EXPLAIN'					=> 'Select the number of words to display in wordgraph. A higher number could make server load slower in wordgraph page.',
));
