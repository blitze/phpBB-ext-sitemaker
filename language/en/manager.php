<?php
/**
*
* @package blocks
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

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
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
	
	'SHOW_HIDE_ME'			=> 'Allow hide online status?',
	'AUTO_LOGIN'			=> 'Allow auto login?',

	'AJAX_ERROR'				=> 'Oops! There was an error processing your request. Please try again.',
	'COPY_BLOCKS_CONFIRM'		=> 'Are you sure that want to copy blocks from another page?<br /><br />This will delete all existing blocks and their settings for this page and replace them with the blocks from the selected page.',
	'LEAVE_CONFIRM'				=> 'You have some unsaved changes to this page. Please save your work before moving on',
	'DELETE_BLOCK_CONFIRM'		=> 'Are you sure you want to delete this block?<br /><br /><br /><strong>Note:</strong> You will have to save the layout changes to make this permanent.',
	'DEFAULT_LAYOUT_EXPLAIN'	=> 'If set, all site pages for which you have not specified blocks will inherit the blocks from the default layout. You may, however, override the default layout for particular pages using the options to the right below.',
));