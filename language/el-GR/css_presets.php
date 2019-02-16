<?php
/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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

/*
* These are errors which can be triggered by sending invalid data to the
* boardrules extension API.
*
* These errors will never show to a user unless they are either modifying
* the core boardrules extension code OR unless they are writing an extension
* which makes calls to this extension.
*
* Translators: Feel free to not translate these language strings
*/
$lang = array_merge($lang, array(
	'LIST_FLAT'				=> 'Flat list',
	'LIST_ARROW'			=> 'Arrow list marker',
	'LIST_CIRCLE'			=> 'Circle list marker',
	'LIST_DISC'				=> 'Bullet list marker',
	'LIST_SQUARE'			=> 'Square list marker',
	'LIST_NUMBERED'			=> 'Numbered list',
	'LIST_INLINE'			=> 'Inline list',
	'LIST_INLINE_SEP'		=> 'Comma-separated list',
	'LIST_HOVER'			=> 'Highlight on hover',
	'LIST_STRIPED'			=> 'Striped list',
	'LIST_STACKED'			=> 'Stacked list',
	'LIST_AUTOWIDTH'		=> 'Auto width',
	'LIST_2COLS'			=> '2 column list',
	'LIST_3COLS'			=> '3 columns list',
	'LIST_4COLS'			=> '4 columns list',
	'LIST_5COLS'			=> '5 columns list',
	'LIST_X_DIVIDER_DOTTED'	=> 'Horizontal dotted divider',
	'LIST_X_DIVIDER_LINE'	=> 'Horizontal line divider',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Vertical dotted divider',
	'LIST_Y_DIVIDER_LINE'	=> 'Vertical line divider',

	'IMAGE_SMALL'			=> 'Small image',
	'IMAGE_MEDIUM'			=> 'Medium image',
	'IMAGE_LARGE'			=> 'Large image',
	'IMAGE_FULL_WIDTH'		=> 'Full width image',
	'IMAGE_ALIGN_LEFT'		=> 'Float image left',
	'IMAGE_ALIGN_RIGHT'		=> 'Float image right',
	'IMAGE_CIRCLE'			=> 'Circular image',
	'IMAGE_BORDER'			=> 'Bordered image',
	'IMAGE_BORDER_PADDING'	=> 'Image border padding',

	'RESPONSIVE_SHOW'		=> 'Show only on small devices',
	'RESPONSIVE_HIDE'		=> 'Hide on small devices',

	'ALIGN_LEFT'			=> 'Left-aligned text',
	'ALIGN_CENTER'			=> 'Centered text',
	'ALIGN_RIGHT'			=> 'Right-aligned text',
	'NO_PADDING'			=> 'No padding',
	'LABEL'					=> 'Label',
	'BADGE'					=> 'Badge',
	'PRIMARY_COLOR'			=> 'Primary color',
	'SECONDARY_COLOR'		=> 'Secondary color',
	'GRAYSCALE_COLOR'		=> 'Grayscale',
	'INFO_COLOR'			=> 'Info',
	'SUCCESS_COLOR'			=> 'Success',
	'WARNING_COLOR'			=> 'Warning',
	'DANGER_COLOR'			=> 'Danger',
));
