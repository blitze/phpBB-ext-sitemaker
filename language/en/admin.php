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
	'NOT_AUTHORIZED'		=> 'You are not authorized to perform this action',
));