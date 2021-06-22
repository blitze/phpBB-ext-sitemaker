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
	'ACTIVE_ELEMENT'			=> 'Actief element',
	'BORDER'					=> 'Border',
	'BORDER_COLOR'				=> 'Rand kleur',
	'BORDER_RADIUS'				=> 'Rand Straal',
	'BORDER_WIDTH'				=> 'Border Width',
	'BOTTOM'					=> 'Onderaan',
	'BOTTOM_LEFT'				=> 'Links onder',
	'BOTTOM_RIGHT'				=> 'Rechts onder',
	'CAPITALIZE'				=> 'Kapitaliseren',
	'COLOR'						=> 'Kleur',
	'DIVIDERS'					=> 'Verdelers',
	'END'						=> 'Beëindigen',
	'GRADIENT'					=> 'Kleurovergang',
	'HEADERS'					=> 'Kopteksten',
	'HOVER'						=> 'Hover',
	'LEFT'						=> 'Linkerkant',
	'LOWERCASE'					=> 'Kleinere',
	'MARGIN'					=> 'Marge',
	'NAVBAR'					=> 'Navigatiebalk',
	'NAVBAR_MENU'				=> 'Navbar menu',
	'NAVBAR_DROPDOWN'			=> 'Uitklapmenu',
	'NAVBAR_LOCATION'			=> 'Locatie',
	'NAVBAR_LOCATION_OPTION'	=> 'Locatie #%s',
	'NAVBAR_TOP_MENU'			=> 'Top menu',
	'NONE'						=> 'geen',
	'PADDING'					=> 'Padding',
	'RESPONSIVE_TOGGLE'			=> 'Responsieve schakelaar',
	'RESPONSIVE_TOGGLE_EXPLAIN'	=> 'Alleen zichtbaar op kleine (mobiele) schermen',
	'RIGHT'						=> 'Rechterkant',
	'SAVE'						=> 'Opslaan',
	'SIZE'						=> 'Grootte',
	'START'						=> 'Beginnen',
	'TEXT'						=> 'Tekstveld',
	'TOP'						=> 'Bovenkant',
	'TOP_LEFT'					=> 'Links boven',
	'TOP_RIGHT'					=> 'Rechts boven',
	'TRANSFORM'					=> 'Transformeren',
	'UPPERCASE'					=> 'Hoofdletters',
));
