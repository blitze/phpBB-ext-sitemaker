<?php

/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
//
$lang = array_merge($lang, array(
	'LIST_ARROW'			=> 'Značka seznamu šípů',
	'LIST_CIRCLE'			=> 'Značka seznamu kruhů',
	'LIST_DISC'				=> 'Značka seznamu odrážek',
	'LIST_SQUARE'			=> 'Čtvereční značka seznamu',
	'LIST_NUMBERED'			=> 'Číslovaný seznam',
	'LIST_NUMBERED_ALPHABET' => 'Číslování s abecedou',
	'LIST_NUMBERED_NESTED'	=> 'Číslování s pododdíly',
	'LIST_NUMBERED_ROMAN'	=> 'Číslování římskými číslicemi',
	'LIST_NUMBERED_ZERO'	=> 'Číslování s nulou předních bodů',
	'LIST_INLINE'			=> 'Vložený seznam',
	'LIST_INLINE_SEP'		=> 'Seznam oddělených čárkami',
	'LIST_REVERSE'			=> 'Obrácené pořadí',
	'LIST_STRIPED'			=> 'Seznam proužků',
	'LIST_STACKED'			=> 'Skládaný seznam',
	'LIST_TRIANGLE'			=> 'Trojúhelník',
	'LIST_HYPHEN'			=> 'Hyphen',
	'LIST_PLUS'				=> 'Plus',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'Klub',
	'LIST_DIAMOND'			=> 'Diamantový',
	'LIST_HEART'			=> 'Srdeční',
	'LIST_STAR'				=> 'Hvězda',
	'LIST_CHECK'			=> 'Zkontrolovat',
	'LIST_SNOWFLAKE'		=> 'Sněhové vločky',
	'LIST_MUSIC'			=> 'Hudba',
	'LIST_AUTOWIDTH'		=> 'Auto width',
	'LIST_FIT_CONTENT'		=> 'Přizpůsobit obsah',
	'LIST_2COLS'			=> '2 seznam sloupců',
	'LIST_3COLS'			=> '3 seznam sloupců',
	'LIST_4COLS'			=> '4 seznam sloupců',
	'LIST_5COLS'			=> '5 seznam sloupců',
	'LIST_X_DIVIDER_DOTTED'	=> 'Horizontální oddělovač vytečkovaných',
	'LIST_X_DIVIDER_LINE'	=> 'Oddělovač vodorovné čáry',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Svislý tečkovaný dělič',
	'LIST_Y_DIVIDER_LINE'	=> 'Svislé oddělovače čáry',

	'IMAGE_SMALL'			=> 'Malý obrázek',
	'IMAGE_MEDIUM'			=> 'Střední obrázek',
	'IMAGE_LARGE'			=> 'Velký obrázek',
	'IMAGE_FULL_WIDTH'		=> 'Obrázek na celou šířku',
	'IMAGE_ALIGN_LEFT'		=> 'Plovoucí obrázek vlevo',
	'IMAGE_ALIGN_RIGHT'		=> 'Plovoucí obrázek vpravo',
	'IMAGE_CIRCLE'			=> 'Kruhový obraz',
	'IMAGE_ROUNDED'			=> 'Zaoblený obrázek',
	'IMAGE_BORDER'			=> 'Blokovaný obrázek',
	'IMAGE_BORDER_PADDING'	=> 'Image border padding',
	'IMAGE_RATIO_SQUARE'	=> 'Čtvereční obrázek',
	'IMAGE_RATIO_4_BY_3'	=> '4 podle 3 obrázku',
	'IMAGE_RATIO_16_BY_9'	=> '16 podle 9 snímků',

	'RESPONSIVE_SHOW'		=> 'Zobrazit pouze na malých zařízeních',
	'RESPONSIVE_HIDE'		=> 'Skrýt na malých zařízeních',

	'ALIGN_LEFT'			=> 'Text zarovnaný vlevo',
	'ALIGN_CENTER'			=> 'Zadaný text',
	'ALIGN_RIGHT'			=> 'Text zarovnaný vpravo',
	'NO_PADDING'			=> 'No padding',
	'LABEL'					=> 'Popisek',
	'BADGE'					=> 'Odznak',
	'PRIMARY_COLOR'			=> 'Hlavní barva',
	'SECONDARY_COLOR'		=> 'Sekundární barva',
	'GRAYSCALE_COLOR'		=> 'Grayscale',
	'INFO_COLOR'			=> 'Info',
	'SUCCESS_COLOR'			=> 'Úspěšně',
	'WARNING_COLOR'			=> 'Varování',
	'DANGER_COLOR'			=> 'Nebezpečí',
));
