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

	'TODAY'					=> 'Today',
	'THIS_WEEK'				=> 'This Week',
	'THIS_MONTH'			=> 'This Month',
	'THIS_YEAR'				=> 'This Year',

	'ROTATE_PAGELOAD'		=> 'Page load',
	'ROTATE_HOURLY'			=> 'Hourly',
	'ROTATE_DAILY'			=> 'Daily',
	'ROTATE_WEEKLY'			=> 'Weekly',
	'ROTATE_MONTHLY'		=> 'Monthly',

	'MEMBERS_DATE'			=> 'Date',
	'LAST_VISITED'			=> 'Last Visited',
	'RECENT_BOTS'			=> 'Recent Search Engines',
	'RECENT_MEMBERS'		=> 'Recent Members',
	'MOST_TENURED'			=> 'Most Tenured',
	'TOP_POSTERS'			=> 'Top Posters',

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