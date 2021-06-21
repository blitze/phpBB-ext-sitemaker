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
	'BORDER_COLOR'				=> 'Farge for kantlinje',
	'BORDER_RADIUS'				=> 'Ramme radius',
	'BORDER_WIDTH'				=> 'Border Width',
	'BOTTOM'					=> 'Bunn',
	'BOTTOM_LEFT'				=> 'Nederst til venstre',
	'BOTTOM_RIGHT'				=> 'Nederst til høyre',
	'CAPITALIZE'				=> 'Kapitalisere',
	'COLOR'						=> 'Farge',
	'DIVIDERS'					=> 'Skilletegn',
	'END'						=> 'Slutt',
	'GRADIENT'					=> 'Gradert',
	'HEADERS'					=> 'Overskrifter',
	'HOVER'						=> 'Hover',
	'LEFT'						=> 'Venstre',
	'LOWERCASE'					=> 'Små bokstaver',
	'MARGIN'					=> 'Marg',
	'NAVBAR'					=> 'Navigasjonsfelt',
	'NAVBAR_MENU'				=> 'Navbar menu',
	'NAVBAR_DROPDOWN'			=> 'Rullegardin',
	'NAVBAR_LOCATION'			=> 'Sted',
	'NAVBAR_LOCATION_OPTION'	=> 'Plassering #%s',
	'NAVBAR_TOP_MENU'			=> 'Øverste meny',
	'NONE'						=> 'Ingen',
	'PADDING'					=> 'Padding',
	'RESPONSIVE_TOGGLE'			=> 'Responsiv veksler',
	'RESPONSIVE_TOGGLE_EXPLAIN'	=> 'Bare synlige på små (mobil) skjermer',
	'RIGHT'						=> 'Høyre',
	'SAVE'						=> 'Lagre',
	'SIZE'						=> 'Størrelse',
	'START'						=> 'Begynn',
	'TEXT'						=> 'Tekst',
	'TOP'						=> 'Topp',
	'TOP_LEFT'					=> 'Øverst til venstre',
	'TOP_RIGHT'					=> 'Øverst til høyre',
	'TRANSFORM'					=> 'Transformere',
	'UPPERCASE'					=> 'Store bokstaver',
));
