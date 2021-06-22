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
	'ACTIVE_ELEMENT'			=> 'Elemento Attivo',
	'BORDER'					=> 'Border',
	'BORDER_COLOR'				=> 'Colore Del Bordo',
	'BORDER_RADIUS'				=> 'Raggio Bordo',
	'BORDER_WIDTH'				=> 'Border Width',
	'BOTTOM'					=> 'Basso',
	'BOTTOM_LEFT'				=> 'Basso A Sinistra',
	'BOTTOM_RIGHT'				=> 'Basso A Destra',
	'CAPITALIZE'				=> 'Capitalizza',
	'COLOR'						=> 'Colore',
	'DIVIDERS'					=> 'Divisori',
	'END'						=> 'Fine',
	'GRADIENT'					=> 'Gradiente',
	'HEADERS'					=> 'Intestazioni',
	'HOVER'						=> 'Hover',
	'LEFT'						=> 'Sinistra',
	'LOWERCASE'					=> 'Minuscolo',
	'MARGIN'					=> 'Margine',
	'NAVBAR'					=> 'Navbar',
	'NAVBAR_MENU'				=> 'Navbar menu',
	'NAVBAR_DROPDOWN'			=> 'Discesa',
	'NAVBAR_LOCATION'			=> 'Posizione',
	'NAVBAR_LOCATION_OPTION'	=> 'Posizione #%s',
	'NAVBAR_TOP_MENU'			=> 'Menu Superiore',
	'NONE'						=> 'Nessuno',
	'PADDING'					=> 'Padding',
	'RESPONSIVE_TOGGLE'			=> 'Attiva/Disattiva Risposta',
	'RESPONSIVE_TOGGLE_EXPLAIN'	=> 'Visibile solo su schermi piccoli (mobili)',
	'RIGHT'						=> 'Destra',
	'SAVE'						=> 'Salva',
	'SIZE'						=> 'Dimensione',
	'START'						=> 'Inizia',
	'TEXT'						=> 'Testo',
	'TOP'						=> 'Alto',
	'TOP_LEFT'					=> 'In Alto A Sinistra',
	'TOP_RIGHT'					=> 'Alto A Destra',
	'TRANSFORM'					=> 'Trasforma',
	'UPPERCASE'					=> 'Maiuscolo',
));
