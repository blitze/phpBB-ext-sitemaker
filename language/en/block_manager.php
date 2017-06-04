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
	'ADD_BLOCK_EXPLAIN'							=> '*Drag and Drop blocks',
	'AJAX_ERROR'								=> 'Oops! There was an error processing your request. Please try again.',
	'AJAX_LOADING'								=> 'Loading...',
	'AJAX_PROCESSING'							=> 'Working...',

	'BACKGROUND'								=> 'Background',
	'BLOCKS'									=> 'Blocks',
	'BLOCKS_COPY_FROM'							=> 'Copy Blocks',
	'BLOCK_ACTIVE'								=> 'Active',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Show on child routes only',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Hide on child routes',
	'BLOCK_CLASS'								=> 'CSS Class',
	'BLOCK_DESIGN'								=> 'Appearance',
	'BLOCK_DISPLAY_TYPE'						=> 'Display',
	'BLOCK_HIDE_TITLE'							=> 'Hide block title?',
	'BLOCK_INACTIVE'							=> 'Inactive',
	'BLOCK_NOT_FOUND'							=> 'Oops! The requested block service was not found',
	'BLOCK_NO_DATA'								=> 'No data to display',
	'BLOCK_NO_ID'								=> 'Oops! Missing block id',
	'BLOCK_PERMISSION'							=> 'Viewable by',
	'BLOCK_SHOW_ALWAYS'							=> 'Always',
	'BLOCK_STATUS'								=> 'Status',
	'BLOCK_UPDATED'								=> 'Block settings successfully updated',

	'CANCEL'									=> 'Cancel',
	'CHILD_ROUTE'								=> 'Child',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/my-article',
	'CLEAR'										=> 'Clear',
	'COPY'										=> 'Copy',
	'COPY_BLOCKS'								=> 'Copy Blocks?',
	'COPY_BLOCKS_CONFIRM'						=> 'Are you sure that you’d like to copy blocks from another page?<br /><br />This will delete all existing blocks and their settings for this page and replace them with the blocks from the selected page.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'If set, all site pages for which you have not specified blocks will inherit the blocks from the default layout. You may, however, override the default layout for particular pages using the options to the right below.',
	'DELETE'									=> 'Delete',
	'DELETE_ALL_BLOCKS'							=> 'Delete All Blocks',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'Are you sure that you’d like to delete all blocks for this page?',
	'DELETE_BLOCK'								=> 'Delete Block',
	'DELETE_BLOCK_CONFIRM'						=> 'Are you sure you want to delete this block?<br /><br /><br /><strong>Note:</strong> You will have to save the layout changes to make this permanent.',

	'EDIT'										=> 'Edit',
	'EDIT_BLOCK'								=> 'Edit Block',
	'EXIT_EDIT_MODE'							=> 'Exit Edit Mode',

	'FIELD_INVALID'								=> 'The provided value for the field “%s” has an invalid format',
	'FIELD_REQUIRED'							=> '“%s” is a required field',
	'FIELD_TOO_LONG'							=> 'The provided value for the field “%1$s” is too long. The maximum acceptable value is %2$d.',
	'FIELD_TOO_SHORT'							=> 'The provided value for the field “%1$s” is too short. The minimum acceptable value is %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'Do not show blocks on this page',
	'HIDE_BLOCK_POSITIONS'						=> 'Do not show blocks for the following block positions.<br />Use <strong>CTRL + click</strong> to deselect or select multiple positions',

	'IMAGES'									=> 'Images',

	'LAYOUT'									=> 'Layout',
	'LAYOUT_SAVED'								=> 'Layout successfully saved!',
	'LAYOUT_SETTINGS'							=> 'Layout Settings',
	'LEAVE_CONFIRM'								=> 'You have some unsaved changes to this page. Please save your work before moving on',
	'LISTS'										=> 'Lists',

	'MAKE_DEFAULT_LAYOUT'						=> 'Set As Default Layout',

	'OR'										=> '<strong>OR</strong>',

	'PARENT_ROUTE'								=> 'Parent',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/articles',

	'REDO'										=> 'Redo',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Remove As Default Layout',
	'REMOVE_STARTPAGE'							=> 'Remove Start Page',
	'ROUTE_HIDDEN_BLOCKS'						=> 'Blocks are being hidden for this page',
	'ROUTE_HIDDEN_POSITIONS'					=> 'Blocks are being hidden for the following positions',
	'ROUTE_UPDATED'								=> 'Page settings successfully updated',

	'SAVE_CHANGES'								=> 'Save Changes',
	'SAVE_SETTINGS'								=> 'Save Settings',
	'SELECT_ICON'								=> 'Select an Icon',
	'SETTINGS'									=> 'Settings',
	'SETTING_TOO_BIG'							=> 'The provided value for the setting “%1$s” is too high. The maximum acceptable value is %2$d.',
	'SETTING_TOO_LONG'							=> 'The provided value for the setting “%1$s” is too long. The maximum acceptable length is %2$d.',
	'SETTING_TOO_LOW'							=> 'The provided value for the setting “%1$s” is too low. The minimum acceptable value is %2$d.',
	'SETTING_TOO_SHORT'							=> 'The provided value for the setting “%1$s” is too short. The minimum acceptable length is %2$d.',
	'SET_STARTPAGE'								=> 'Set As Start Page',

	'TITLES'									=> 'Titles',
	'TOGGLE'									=> 'Toggle',

	'UNDO'										=> 'Undo',
	'UPDATE_SIMILAR'							=> 'Update blocks with similar settings',

	'VIEW_DEFAULT_LAYOUT'						=> 'View/Edit Default Layout',
	'VISIT_PAGE'								=> 'Visit Page',
));
