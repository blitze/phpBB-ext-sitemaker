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
	'ACTIVE_ELEMENT'			=> 'Aktivní prvek',
	'BORDER'					=> 'Border',
	'BORDER_COLOR'				=> 'Barva ohraničení',
	'BORDER_RADIUS'				=> 'Poloměr ohraničení',
	'BORDER_WIDTH'				=> 'Border Width',
	'BOTTOM'					=> 'Spodní',
	'BOTTOM_LEFT'				=> 'Vlevo dole',
	'BOTTOM_RIGHT'				=> 'Vpravo dole',
	'CAPITALIZE'				=> 'Kapitalizovat',
	'COLOR'						=> 'Barva',
	'DIVIDERS'					=> 'Děliče',
	'END'						=> 'Ukončit',
	'GRADIENT'					=> 'Sklon',
	'HEADERS'					=> 'Záhlaví',
	'HOVER'						=> 'Hover',
	'LEFT'						=> 'Vlevo',
	'LOWERCASE'					=> 'Malá písmena',
	'MARGIN'					=> 'Okraj',
	'NAVBAR'					=> 'Navigační panel',
	'NAVBAR_MENU'				=> 'Navbar menu',
	'NAVBAR_DROPDOWN'			=> 'Rozbalovací nabídka',
	'NAVBAR_LOCATION'			=> 'Poloha',
	'NAVBAR_LOCATION_OPTION'	=> 'Poloha č.%s',
	'NAVBAR_TOP_MENU'			=> 'Horní nabídka',
	'NONE'						=> 'Nic',
	'PADDING'					=> 'Padding',
	'RESPONSIVE_TOGGLE'			=> 'Responzivní přepínač',
	'RESPONSIVE_TOGGLE_EXPLAIN'	=> 'Viditelné pouze na malých (mobilních) obrazovkách',
	'RIGHT'						=> 'Vpravo',
	'SAVE'						=> 'Uložit',
	'SIZE'						=> 'Velikost',
	'START'						=> 'Začít',
	'TEXT'						=> 'Text',
	'TOP'						=> 'Nahoře',
	'TOP_LEFT'					=> 'Vlevo nahoře',
	'TOP_RIGHT'					=> 'Vpravo nahoře',
	'TRANSFORM'					=> 'Transformovat',
	'UPPERCASE'					=> 'Velká písmena',
));
