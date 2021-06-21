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
	'LIST_ARROW'			=> 'Znacznik listy strzałek',
	'LIST_CIRCLE'			=> 'Znacznik listy okręgu',
	'LIST_DISC'				=> 'Znacznik listy wypunktowania',
	'LIST_SQUARE'			=> 'Znacznik listy kwadratowej',
	'LIST_NUMBERED'			=> 'Lista numeryczna',
	'LIST_NUMBERED_ALPHABET' => 'Numbered with alphabet',
	'LIST_NUMBERED_NESTED'	=> 'Numbered with subsections',
	'LIST_NUMBERED_ROMAN'	=> 'Numbered with Roman numerals',
	'LIST_NUMBERED_ZERO'	=> 'Numbered with leading zero',
	'LIST_INLINE'			=> 'Lista wtyczek',
	'LIST_INLINE_SEP'		=> 'Lista oddzielona przecinkami',
	'LIST_REVERSE'			=> 'Reverse order',
	'LIST_STRIPED'			=> 'Lista usunięta',
	'LIST_STACKED'			=> 'Lista zbiorcza',
	'LIST_TRIANGLE'			=> 'Triangle',
	'LIST_HYPHEN'			=> 'Hyphen',
	'LIST_PLUS'				=> 'Plus',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'Club',
	'LIST_DIAMOND'			=> 'Diamond',
	'LIST_HEART'			=> 'Heart',
	'LIST_STAR'				=> 'Star',
	'LIST_CHECK'			=> 'Check',
	'LIST_SNOWFLAKE'		=> 'Snowflake',
	'LIST_MUSIC'			=> 'Music',
	'LIST_AUTOWIDTH'		=> 'Automatyczna szerokość',
	'LIST_FIT_CONTENT'		=> 'Dopasuj zawartość',
	'LIST_2COLS'			=> '2 column list',
	'LIST_3COLS'			=> '3 columns list',
	'LIST_4COLS'			=> '4 columns list',
	'LIST_5COLS'			=> '5 columns list',
	'LIST_X_DIVIDER_DOTTED'	=> 'Poziomy rozdzielacz kropkowy',
	'LIST_X_DIVIDER_LINE'	=> 'Rozdzielacz linii poziomej',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Pionowy separator kropkowy',
	'LIST_Y_DIVIDER_LINE'	=> 'Separator linii pionowych',

	'IMAGE_SMALL'			=> 'Mały obraz',
	'IMAGE_MEDIUM'			=> 'Średni obrazek',
	'IMAGE_LARGE'			=> 'Duży obraz',
	'IMAGE_FULL_WIDTH'		=> 'Obraz pełnej szerokości',
	'IMAGE_ALIGN_LEFT'		=> 'Pływający obraz w lewo',
	'IMAGE_ALIGN_RIGHT'		=> 'Pływający obraz w prawo',
	'IMAGE_CIRCLE'			=> 'Obraz okrągły',
	'IMAGE_ROUNDED'			=> 'Zaokrąglony obraz',
	'IMAGE_BORDER'			=> 'Obrazek wytłaczany',
	'IMAGE_BORDER_PADDING'	=> 'Obramowanie obramowania obrazu',
	'IMAGE_RATIO_SQUARE'	=> 'Obraz kwadratowy',
	'IMAGE_RATIO_4_BY_3'	=> '4 by 3 image',
	'IMAGE_RATIO_16_BY_9'	=> '16 by 9 image',

	'RESPONSIVE_SHOW'		=> 'Pokaż tylko na małych urządzeniach',
	'RESPONSIVE_HIDE'		=> 'Ukryj na małych urządzeniach',

	'ALIGN_LEFT'			=> 'Tekst wyrównany do lewej',
	'ALIGN_CENTER'			=> 'Wyśrodkowany tekst',
	'ALIGN_RIGHT'			=> 'Tekst wyrównany prawo',
	'NO_PADDING'			=> 'Brak dopełniania',
	'LABEL'					=> 'Etykieta',
	'BADGE'					=> 'Odznaka',
	'PRIMARY_COLOR'			=> 'Kolor podstawowy',
	'SECONDARY_COLOR'		=> 'Drugorzędny kolor',
	'GRAYSCALE_COLOR'		=> 'Skala szarości',
	'INFO_COLOR'			=> 'Informacje',
	'SUCCESS_COLOR'			=> 'Sukces',
	'WARNING_COLOR'			=> 'Ostrzeżenie',
	'DANGER_COLOR'			=> 'Niebezpieczeństwo',
));
