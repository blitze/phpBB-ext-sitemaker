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

$lang = array_merge($lang, array(
	'ACTIVE_ELEMENT'			=> 'Active Element',
	'BORDER'					=> 'Border',
	'BORDER_COLOR'				=> 'Border Color',
	'BORDER_RADIUS'				=> 'Border Radius',
	'BORDER_WIDTH'				=> 'Border Width',
	'BOTTOM'					=> 'Bottom',
	'BOTTOM_LEFT'				=> 'Bottom Left',
	'BOTTOM_RIGHT'				=> 'Bottom Right',
	'CAPITALIZE'				=> 'Capitalize',
	'COLOR'						=> 'Color',
	'DIVIDERS'					=> 'Dividers',
	'END'						=> 'End',
	'GRADIENT'					=> 'Gradient',
	'HEADERS'					=> 'Headers',
	'HOVER'						=> 'Hover',
	'LEFT'						=> 'Left',
	'LOWERCASE'					=> 'Lowercase',
	'MARGIN'					=> 'Margin',
	'NAVBAR'					=> 'Navbar',
	'NAVBAR_MENU'				=> 'Navbar menu',
	'NAVBAR_DROPDOWN'			=> 'Dropdown',
	'NAVBAR_LOCATION'			=> 'Ubicación',
	'NAVBAR_LOCATION_OPTION'	=> 'Location #%s',
	'NAVBAR_TOP_MENU'			=> 'Top Menu',
	'NONE'						=> 'None',
	'PADDING'					=> 'Padding',
	'RESPONSIVE_TOGGLE'			=> 'Responsive Toggle',
	'RESPONSIVE_TOGGLE_EXPLAIN'	=> 'Only viewable on small (mobile) screens',
	'RIGHT'						=> 'Right',
	'SAVE'						=> 'Save',
	'SIZE'						=> 'Size',
	'START'						=> 'Start',
	'TEXT'						=> 'Text',
	'TOP'						=> 'Top',
	'TOP_LEFT'					=> 'Top Left',
	'TOP_RIGHT'					=> 'Top Right',
	'TRANSFORM'					=> 'Transform',
	'UPPERCASE'					=> 'Uppercase',
));
