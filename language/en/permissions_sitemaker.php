<?php
/**
*
* @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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

// Admin Permissions
$lang = array_merge($lang, array(
	'ACL_A_SM_SETTINGS'			=> 'Can manage Sitemaker settings',
	'ACL_A_SM_MANAGE_BLOCKS'	=> 'Can manage Sitemaker blocks',
	'ACL_A_SM_MANAGE_MENUS'		=> 'Can manage Sitemaker menus',
	'ACL_A_SM_FILEMANAGER'		=> 'Can see/manage other users’ folders in File Manager',
));

// User Permissions
$lang = array_merge($lang, array(
	'ACL_U_SM_FILEMANAGER'		=> 'Can use File Manager',
));
