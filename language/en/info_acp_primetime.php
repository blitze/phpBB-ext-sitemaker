<?php
/**
 *
 * @package phpBB Primetime [English]
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
	'ACP_MENU'			=> 'Menu Management',
	'ADD_BULK_MENU'		=> 'Bulk Add Menu Items',
	'ADD_MENU'			=> 'Add Menu',
	'ADD_MENU_ITEM'		=> 'Add Menu Item',
	'AJAX_PROCESSING'	=> 'Working',
	'CHANGE_ME'			=> 'Change Me',
	'GO_TO'				=> 'Go to',
	'ITEM_NAME'			=> 'Item Name',
	'ITEM_URL'			=> 'Item URL',
	'ITEM_TARGET'		=> 'Item Target',
	'ITEM_STATUS'		=> 'Item Status',
	'ITEM_ACTIVE'		=> 'Active',
	'ITEM_INACTIVE'		=> 'Inactive',
	'LOADING'			=> 'Loading...',
	'MENU_ITEMS'		=> 'Menu Items',
	'MENU_ITEM_PARENT'	=> 'Parent Item',
	'NO_MENU'			=> 'No menus have been created',
	'NO_MENU_ITEMS'		=> 'No menu items have been created',
	'TARGET_BLANK'		=> 'Blank Page',
	'TARGET_PARENT'		=> 'Parent',
	'REBUILD_TREE'		=> 'Rebuild Tree',
	'SAVE_CHANGES'		=> 'Save Changes',
	'SELECT_ALL'		=> 'Select All',

	'ACP_CAT_CMS'				=> 'Primetime',
	'ACP_PRIMETIME_EXTENSIONS'	=> 'Extensions',
	'PRIMETIME_DASHBOARD'		=> 'Dashboard',
	'DELETE_SELECTED'			=> 'Delete Selected',
	'DELETE_ITEM'				=> 'Delete Item',
	'DELETE_MENU'				=> 'Delete Menu',
	'DELETE_MENU_ITEM'			=> 'Delete Item',
	'DELETE_MENU_CONFIRM'		=> 'Are you sure you want to delete this menu?<br />This will delete the menu and all its items',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Are you sure you want to delete this menu item?',
	'ADD_BULK_EXPLAIN'			=> 'Add multiple menu items at once.<br /> - Place each item on a separate line<br /> - Use the <strong>Tab</strong> key to indent items to represent parent-child relationships<br /> - Enter item and URL like so: Home|./index.php',
	'ACP_MENU_EXPLAIN'			=> 'Here you can create and manage menus for your site',
));
