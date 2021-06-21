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
	'ACTIVE_ELEMENT'			=> 'Aktive Elemente',
	'BORDER'					=> 'Rand',
	'BORDER_COLOR'				=> 'Rahmenfarbe',
	'BORDER_RADIUS'				=> 'Abgerundete Ecken',
	'BORDER_WIDTH'				=> 'Rahmenbreite',
	'BOTTOM'					=> 'Unten',
	'BOTTOM_LEFT'				=> 'Unten links',
	'BOTTOM_RIGHT'				=> 'Unten rechts',
	'CAPITALIZE'				=> 'Großbuchstaben',
	'COLOR'						=> 'Farbe',
	'DIVIDERS'					=> 'Trenner',
	'END'						=> 'Ende',
	'GRADIENT'					=> 'Farbverlauf',
	'HEADERS'					=> 'Kopfzeilen',
	'HOVER'						=> 'Hover',
	'LEFT'						=> 'Links',
	'LOWERCASE'					=> 'Kleinbuchstaben',
	'MARGIN'					=> 'Rand',
	'NAVBAR'					=> 'Navbar',
	'NAVBAR_MENU'				=> 'Navbar menu',
	'NAVBAR_DROPDOWN'			=> 'Dropdown',
	'NAVBAR_LOCATION'			=> 'Herkunft',
	'NAVBAR_LOCATION_OPTION'	=> 'Speicherort: %s',
	'NAVBAR_TOP_MENU'			=> 'Oberes Menü',
	'NONE'						=> 'Versteckt',
	'PADDING'					=> 'Abstand',
	'RESPONSIVE_TOGGLE'			=> 'Responsive Umschalter',
	'RESPONSIVE_TOGGLE_EXPLAIN'	=> 'Nur auf kleinen (mobilen) Bildschirmen sichtbar',
	'RIGHT'						=> 'Rechts',
	'SAVE'						=> 'Speichern',
	'SIZE'						=> 'Größe',
	'START'						=> 'Anfang',
	'TEXT'						=> 'Text',
	'TOP'						=> 'Oben',
	'TOP_LEFT'					=> 'Oben Links',
	'TOP_RIGHT'					=> 'Oben rechts',
	'TRANSFORM'					=> 'Transformieren',
	'UPPERCASE'					=> 'Großbuchstaben',
));
