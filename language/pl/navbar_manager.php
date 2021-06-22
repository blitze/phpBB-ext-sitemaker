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
	'ACTIVE_ELEMENT'			=> 'Aktywny element',
	'BORDER'					=> 'Border',
	'BORDER_COLOR'				=> 'Kolor obramowania',
	'BORDER_RADIUS'				=> 'Promień obramowania',
	'BORDER_WIDTH'				=> 'Border Width',
	'BOTTOM'					=> 'Dolny',
	'BOTTOM_LEFT'				=> 'Lewy dolny róg',
	'BOTTOM_RIGHT'				=> 'Prawy dolny róg',
	'CAPITALIZE'				=> 'Kapitalizuj',
	'COLOR'						=> 'Kolor',
	'DIVIDERS'					=> 'Dziewicze',
	'END'						=> 'Koniec',
	'GRADIENT'					=> 'Gradient',
	'HEADERS'					=> 'Nagłówki',
	'HOVER'						=> 'Hover',
	'LEFT'						=> 'W lewo',
	'LOWERCASE'					=> 'Małe litery',
	'MARGIN'					=> 'Margines',
	'NAVBAR'					=> 'Pasek nawigacyjny',
	'NAVBAR_MENU'				=> 'Navbar menu',
	'NAVBAR_DROPDOWN'			=> 'Lista rozwijana',
	'NAVBAR_LOCATION'			=> 'Lokalizacja',
	'NAVBAR_LOCATION_OPTION'	=> 'Lokalizacja #%s',
	'NAVBAR_TOP_MENU'			=> 'Menu górne',
	'NONE'						=> 'Brak',
	'PADDING'					=> 'Padding',
	'RESPONSIVE_TOGGLE'			=> 'Przełącz responsywny',
	'RESPONSIVE_TOGGLE_EXPLAIN'	=> 'Widoczne tylko na małych (mobilnych) ekranach',
	'RIGHT'						=> 'Prawy',
	'SAVE'						=> 'Zapisz',
	'SIZE'						=> 'Rozmiar',
	'START'						=> 'Rozpocznij',
	'TEXT'						=> 'Tekst',
	'TOP'						=> 'Góra',
	'TOP_LEFT'					=> 'Lewy górny',
	'TOP_RIGHT'					=> 'Prawy górny róg',
	'TRANSFORM'					=> 'Przekształć',
	'UPPERCASE'					=> 'Wielkie litery',
));
