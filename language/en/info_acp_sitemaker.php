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
	'ACP_MENU'					=> 'Menu',
	'ACP_MENU_MANAGE'			=> 'Menu Management',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Here you can create and manage menus for your site',
	'ADD_BULK_EXPLAIN'			=> 'Add multiple menu items at once.<br /> - Place each item on a separate line<br /> - Use the <strong>Tab</strong> key to indent items to represent parent-child relationships<br /> - Enter item and URL like so: Home|./index.php',
	'ADD_BULK_MENU'				=> 'Bulk Add Menu Items',
	'ADD_MENU'					=> 'Add Menu',
	'ADD_MENU_ITEM'				=> 'Add Menu Item',
	'AJAX_PROCESSING'			=> 'Working',

	'CHANGE_ME'					=> 'Change Me',

	'DELETE_ITEM'				=> 'Delete Item',
	'DELETE_KIDS'				=> 'Delete Branch',
	'DELETE_MENU'				=> 'Delete Menu',
	'DELETE_MENU_CONFIRM'		=> 'Are you sure you want to delete this menu?<br />This will delete the menu and all its items',
	'DELETE_MENU_ITEM'			=> 'Delete Item',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Are you sure you want to delete this menu item?',
	'DELETE_SELECTED'			=> 'Delete Selected',

	'HIDE'						=> 'Hide',

	'ITEM_ACTIVE'				=> 'Active',
	'ITEM_INACTIVE'				=> 'Inactive',
	'ITEM_NAME'					=> 'Item Name',
	'ITEM_NAME_EXPLAIN'			=> 'Set as ’-’ for divider',
	'ITEM_TARGET'				=> 'Item Target',
	'ITEM_URL'					=> 'Item URL',
	'ITEM_URL_EXPLAIN'			=> 'Leave empty for headings',

	'LOADING'					=> 'Loading...',

	'MENU_ITEMS'				=> 'Menu Items',
	'MENU_ITEM_PARENT'			=> 'Parent Item',

	'NO_MENU'					=> 'No menus have been created',
	'NO_MENU_ITEMS'				=> 'No menu items have been created',

	'REBUILD_TREE'				=> 'Rebuild Tree',

	'SAVE_CHANGES'				=> 'Save Changes',
	'SELECT_ALL'				=> 'Select All',
	'SHOW'						=> 'Show',

	'TARGET_BLANK'				=> 'Blank Page',
	'TARGET_PARENT'				=> 'Parent',

	'VISIT_PAGE'				=> 'Visit Page',
));
