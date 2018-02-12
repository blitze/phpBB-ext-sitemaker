<?php
/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
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
	'ACP_SITEMAKER'				=> 'SiteMaker',
	'ACP_SM_SETTINGS'			=> 'Settings',
	'ACP_MENU'					=> 'Menu',
	'ACP_MENU_MANAGE'			=> 'Menu Management',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Here you can create and manage menus for your site',
	'ADD_BULK_EXPLAIN'			=> 'Add multiple menu items at once.<br /> - Place each item on a separate line<br /> - Use the <strong>Tab</strong> key to indent items to represent parent-child relationships<br /> - Enter item and URL like so: Home|index.php',
	'ADD_BULK_MENU'				=> 'Bulk Add Menu Items',
	'ADD_MENU'					=> 'Add Menu',
	'ADD_MENU_ITEM'				=> 'Add Menu Item',
	'ADD_ITEM'					=> 'Add New Item',
	'AJAX_PROCESSING'			=> 'Working',

	'CHANGE_ME'					=> 'Change Me',

	'DELETE_ITEM'				=> 'Delete Item',
	'DELETE_KIDS'				=> 'Delete Branch',
	'DELETE_MENU'				=> 'Delete Menu',
	'DELETE_MENU_CONFIRM'		=> 'Are you sure you want to delete this menu?<br />This will delete the menu and all its items',
	'DELETE_MENU_ITEM'			=> 'Delete Item',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Are you sure you want to delete this menu item?',
	'DELETE_SELECTED'			=> 'Delete Selected',

	'EDIT_ITEM'					=> 'Edit Item',

	'FILEMANAGER_SETTINGS'						=> 'File Manager Settings',
	'FILEMANAGER_STATUS'						=> 'Status',
	'FILEMANAGER_NO_EXIST'						=> 'You will need to install the File Manager before you can enable it. Installation instructions are found <a href="https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/docs/en/filemanager.md" target="_blank"  rel="noopener noreferrer"><strong>here</strong></a>',
	'FILEMANAGER_IMAGE_AUTO_RESIZE'				=> 'Automatically resize uploaded images?',
	'FILEMANAGER_IMAGE_AUTO_RESIZE_DIMENSIONS'	=> 'Resize to specified dimensions',
	'FILEMANAGER_IMAGE_AUTO_RESIZING_MODE'		=> 'Auto resizing mode',
	'FILEMANAGER_IMAGE_MAX_DIMENSIONS'			=> 'Max. image size',
	'FILEMANAGER_IMAGE_MAX_MODE'				=> 'Max. image size mode',
	'FILEMANAGER_IMAGE_MODE_EXPLAIN'			=> 'Used to calculate the height/width if you only provide height or width but not both above',
	'FILEMANAGER_IMAGE_MODE_AUTO'				=> 'Auto',
	'FILEMANAGER_IMAGE_MODE_CROP'				=> 'Crop',
	'FILEMANAGER_IMAGE_MODE_EXACT'				=> 'Exact',
	'FILEMANAGER_IMAGE_MODE_LANDSCAPE'			=> 'Landscape',
	'FILEMANAGER_IMAGE_MODE_PORTRAIT'			=> 'Portrait',
	'FILEMANAGER_WATERMARK'						=> 'Watermark',
	'FILEMANAGER_WATERMARK_EXPLAIN'				=> 'URL of image to use as watermark on all uploaded images',
	'FILEMANAGER_WATERMARK_POSITION'			=> 'Watermark position',
	'FILEMANAGER_WATERMARK_POSITION_EXPLAIN'	=> 'Select a pre-determined position where the watermark should appear or enter the coordinates e.g. 50x100',
	'FILEMANAGER_WATERMARK_POSITION_TL'			=> 'Top Left',
	'FILEMANAGER_WATERMARK_POSITION_T'			=> 'Top',
	'FILEMANAGER_WATERMARK_POSITION_TR'			=> 'Top Right',
	'FILEMANAGER_WATERMARK_POSITION_L'			=> 'Left',
	'FILEMANAGER_WATERMARK_POSITION_M'			=> 'Middle',
	'FILEMANAGER_WATERMARK_POSITION_R'			=> 'Right',
	'FILEMANAGER_WATERMARK_POSITION_BL'			=> 'Bottom Left',
	'FILEMANAGER_WATERMARK_POSITION_B'			=> 'Bottom',
	'FILEMANAGER_WATERMARK_POSITION_BR'			=> 'Bottom Right',
	'FILEMANAGER_WATERMARK_POSITION_SUFFIX'	=> 'or',
	'FILEMANAGER_WATERMARK_PADDING'				=> 'Watermark padding',
	'FILEMANAGER_WATERMARK_PADDING_EXPLAIN'		=> 'If using a pre-determined position you can adjust the padding from the edges. If using co-ordinates, this value is ignored',
	'FILEMANAGER_AVIARY_API_KEY'				=> 'Aviary Image editor API key',
	'FILEMANAGER_AVIARY_API_KEY_EXPLAIN'		=> 'Subscribe to creativesdk.adobe.com to get a free api key at <a href="https://creativesdk.adobe.com/myapps.html" target="_blank"><strong>My Apps</strong></a>.<br />Without a valid API key, you will not be able to save your edited images',

	'FORUM_INDEX_SETTINGS'			=> 'Forum Index Settings',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'These settings only apply when there is no startpage defined',

	'HIDE'						=> 'Hide',
	'HIDE_BIRTHDAY'				=> 'Hide Birthday section',
	'HIDE_LOGIN'				=> 'Hide login box',
	'HIDE_ONLINE'				=> 'Hide Whos online section',

	'ITEM_ACTIVE'				=> 'Active',
	'ITEM_INACTIVE'				=> 'Inactive',
	'ITEM_TITLE'				=> 'Item Title',
	'ITEM_TITLE_EXPLAIN'		=> 'Set as ’-’ for divider',
	'ITEM_TARGET'				=> 'Item Target',
	'ITEM_URL'					=> 'Item URL',
	'ITEM_URL_EXPLAIN'			=> '- Leave empty for headings<br />- External sites must begin with http(s)://, ftp://, //, etc',

	'LAYOUT_BLOG'				=> 'Blog',
	'LAYOUT_HOLYGRAIL'			=> 'Holy Grail',
	'LAYOUT_PORTAL'				=> 'Portal',
	'LAYOUT_PORTAL_ALT'			=> 'Portal (alt)',
	'LAYOUT_SETTINGS'			=> 'Layout Settings',
	'LOADING'					=> 'Loading...',

	'MENU_ITEMS'				=> 'Menu Items',
	'MENU_ITEM_PARENT'			=> 'Parent Item',

	'NAVIGATION_SETTINGS'		=> 'Navigation Settings',
	'NO_MENU'					=> 'No menus have been created',
	'NO_MENU_ITEMS'				=> 'No menu items have been created',
	'NO_NAVBAR'					=> 'None',
	'NO_PARENT'					=> 'No Parent',

	'PROCESSING_ERROR'			=> 'Processing error',

	'REBUILD_TREE'				=> 'Rebuild Tree',
	'REQUIRED'					=> 'Required',
	'REQUIRED_FIELDS'			=> '* Required fields',

	'SAVE_CHANGES'				=> 'Save Changes',
	'SAVE'						=> 'Save',
	'SELECT_ALL'				=> 'Select All',
	'SELECT_NAVBAR_MENU'		=> 'Select main navigation menu',
	'SETTINGS_SAVED'			=> 'Your settings have been saved',
	'SHOW'						=> 'Show',
	'SHOW_FORUM_NAV'			=> 'Show ’Forum’ in navigation bar?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'When a page is set as startpage instead of the forum index, should we display ’Forum’ in navigation bar',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Yes - with icon:',

	'TARGET_BLANK'				=> 'Blank Page',
	'TARGET_PARENT'				=> 'Parent',

	'UNSAVED_CHANGES'			=> 'You have unsaved changes',

	'VISIT_PAGE'				=> 'Visit Page',
));
