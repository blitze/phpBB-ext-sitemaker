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
	'ACTIVE_ELEMENT'			=> 'Aktivt element',
	'BORDER'					=> 'Border',
	'BORDER_COLOR'				=> 'Färg på ram',
	'BORDER_RADIUS'				=> 'Gräns radie',
	'BORDER_WIDTH'				=> 'Border Width',
	'BOTTOM'					=> 'Botten',
	'BOTTOM_LEFT'				=> 'Nederst till vänster',
	'BOTTOM_RIGHT'				=> 'Nederst till höger',
	'CAPITALIZE'				=> 'Kapitalisera',
	'COLOR'						=> 'Färg',
	'DIVIDERS'					=> 'Delare',
	'END'						=> 'Slut',
	'GRADIENT'					=> 'Gradient',
	'HEADERS'					=> 'Sidhuvuden',
	'HOVER'						=> 'Hover',
	'LEFT'						=> 'Vänster',
	'LOWERCASE'					=> 'Gemener',
	'MARGIN'					=> 'Marginal',
	'NAVBAR'					=> 'Navbar',
	'NAVBAR_MENU'				=> 'Navbar menu',
	'NAVBAR_DROPDOWN'			=> 'Rullgardin',
	'NAVBAR_LOCATION'			=> 'Plats',
	'NAVBAR_LOCATION_OPTION'	=> 'Plats #%s',
	'NAVBAR_TOP_MENU'			=> 'Toppmeny',
	'NONE'						=> 'Ingen',
	'PADDING'					=> 'Padding',
	'RESPONSIVE_TOGGLE'			=> 'Responsiv växling',
	'RESPONSIVE_TOGGLE_EXPLAIN'	=> 'Endast synlig på små (mobila) skärmar',
	'RIGHT'						=> 'Höger',
	'SAVE'						=> 'Spara',
	'SIZE'						=> 'Storlek',
	'START'						=> 'Starta',
	'TEXT'						=> 'Text',
	'TOP'						=> 'Överst',
	'TOP_LEFT'					=> 'Överst till vänster',
	'TOP_RIGHT'					=> 'Överst till höger',
	'TRANSFORM'					=> 'Omvandla',
	'UPPERCASE'					=> 'Versaler',
));
