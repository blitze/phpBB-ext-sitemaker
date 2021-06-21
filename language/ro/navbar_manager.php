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
	'ACTIVE_ELEMENT'			=> 'Element activ',
	'BORDER'					=> 'Border',
	'BORDER_COLOR'				=> 'Culoare chenar',
	'BORDER_RADIUS'				=> 'Raza frontierei',
	'BORDER_WIDTH'				=> 'Border Width',
	'BOTTOM'					=> 'Jos',
	'BOTTOM_LEFT'				=> 'Stânga jos',
	'BOTTOM_RIGHT'				=> 'Dreapta jos',
	'CAPITALIZE'				=> 'Capitalizare',
	'COLOR'						=> 'Culoare',
	'DIVIDERS'					=> 'Divizoare',
	'END'						=> 'Sfârșit',
	'GRADIENT'					=> 'Gradient',
	'HEADERS'					=> 'Antete',
	'HOVER'						=> 'Hover',
	'LEFT'						=> 'Stânga',
	'LOWERCASE'					=> 'Mici',
	'MARGIN'					=> 'Marjă',
	'NAVBAR'					=> 'Navbar',
	'NAVBAR_MENU'				=> 'Navbar menu',
	'NAVBAR_DROPDOWN'			=> 'Renunțare',
	'NAVBAR_LOCATION'			=> 'Locaţie',
	'NAVBAR_LOCATION_OPTION'	=> 'Locaţia #%s',
	'NAVBAR_TOP_MENU'			=> 'Meniul de sus',
	'NONE'						=> 'Niciunul',
	'PADDING'					=> 'Padding',
	'RESPONSIVE_TOGGLE'			=> 'Comutare receptivă',
	'RESPONSIVE_TOGGLE_EXPLAIN'	=> 'Vizibil numai pe ecrane mici (mobile)',
	'RIGHT'						=> 'Dreapta',
	'SAVE'						=> 'Salvează',
	'SIZE'						=> 'Dimensiune',
	'START'						=> 'Pornire',
	'TEXT'						=> 'Text',
	'TOP'						=> 'Sus',
	'TOP_LEFT'					=> 'Stânga sus',
	'TOP_RIGHT'					=> 'Dreapta sus',
	'TRANSFORM'					=> 'Transformare',
	'UPPERCASE'					=> 'Uppercase',
));
