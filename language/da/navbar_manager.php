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
	'ACTIVE_ELEMENT'			=> 'Aktivt Element',
	'BORDER'					=> 'Border',
	'BORDER_COLOR'				=> 'Kant Farve',
	'BORDER_RADIUS'				=> 'Kant Radius',
	'BORDER_WIDTH'				=> 'Border Width',
	'BOTTOM'					=> 'Bund',
	'BOTTOM_LEFT'				=> 'Nederst Til Venstre',
	'BOTTOM_RIGHT'				=> 'Nederst Til Højre',
	'CAPITALIZE'				=> 'Kapitalisér',
	'COLOR'						=> 'Farve',
	'DIVIDERS'					=> 'Dividere',
	'END'						=> 'Slut',
	'GRADIENT'					=> 'Overgang',
	'HEADERS'					=> 'Overskrifter',
	'HOVER'						=> 'Hover',
	'LEFT'						=> 'Venstre',
	'LOWERCASE'					=> 'Små',
	'MARGIN'					=> 'Margen',
	'NAVBAR'					=> 'Navbjælke',
	'NAVBAR_MENU'				=> 'Navbar menu',
	'NAVBAR_DROPDOWN'			=> 'Rulleliste',
	'NAVBAR_LOCATION'			=> 'Placering',
	'NAVBAR_LOCATION_OPTION'	=> 'Placering #%s',
	'NAVBAR_TOP_MENU'			=> 'Top- Menu',
	'NONE'						=> 'Ingen',
	'PADDING'					=> 'Padding',
	'RESPONSIVE_TOGGLE'			=> 'Responsivt Skifte',
	'RESPONSIVE_TOGGLE_EXPLAIN'	=> 'Kan kun ses på små (mobil) skærme',
	'RIGHT'						=> 'Højre',
	'SAVE'						=> 'Gem',
	'SIZE'						=> 'Størrelse',
	'START'						=> 'Start',
	'TEXT'						=> 'Tekst',
	'TOP'						=> 'Øverst',
	'TOP_LEFT'					=> 'Øverst Til Venstre',
	'TOP_RIGHT'					=> 'Øverst Til Højre',
	'TRANSFORM'					=> 'Transformér',
	'UPPERCASE'					=> 'Store',
));
