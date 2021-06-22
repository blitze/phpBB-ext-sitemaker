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
	'LIST_CIRCLE'			=> 'Znacznik listy okrętów',
	'LIST_DISC'				=> 'Znacznik listy wypunktowanej',
	'LIST_SQUARE'			=> 'Znacznik listy kwadratów',
	'LIST_NUMBERED'			=> 'Lista numerowana',
	'LIST_NUMBERED_ALPHABET' => 'Numerowane alfabetem',
	'LIST_NUMBERED_NESTED'	=> 'Numerowane podsekcje',
	'LIST_NUMBERED_ROMAN'	=> 'Numerowane cyframi rzymskimi',
	'LIST_NUMBERED_ZERO'	=> 'Numerowane z wiodącym zera',
	'LIST_INLINE'			=> 'Wbudowana lista',
	'LIST_INLINE_SEP'		=> 'Lista rozdzielona przecinkami',
	'LIST_REVERSE'			=> 'Odwróć kolejność',
	'LIST_STRIPED'			=> 'Lista pasków',
	'LIST_STACKED'			=> 'Złożona lista',
	'LIST_TRIANGLE'			=> 'Trójkąt',
	'LIST_HYPHEN'			=> 'Hyphen',
	'LIST_PLUS'				=> '+ +',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'Klub',
	'LIST_DIAMOND'			=> 'Diament',
	'LIST_HEART'			=> 'Serce',
	'LIST_STAR'				=> 'Gwiazdka',
	'LIST_CHECK'			=> 'Sprawdzanie',
	'LIST_SNOWFLAKE'		=> 'Śnieżka',
	'LIST_MUSIC'			=> 'Muzyka',
	'LIST_AUTOWIDTH'		=> 'Auto width',
	'LIST_FIT_CONTENT'		=> 'Dopasuj zawartość',
	'LIST_2COLS'			=> 'Lista 2 kolumn',
	'LIST_3COLS'			=> 'Lista 3 kolumn',
	'LIST_4COLS'			=> 'Lista 4 kolumn',
	'LIST_5COLS'			=> 'Lista 5 kolumn',
	'LIST_X_DIVIDER_DOTTED'	=> 'Poziomy rozdzielacz kropkowy',
	'LIST_X_DIVIDER_LINE'	=> 'Rozdzielacz linii poziomej',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Pionowy rozdzielacz kropkowy',
	'LIST_Y_DIVIDER_LINE'	=> 'Rozdzielacz linii pionowych',

	'IMAGE_SMALL'			=> 'Mały obraz',
	'IMAGE_MEDIUM'			=> 'Średni obraz',
	'IMAGE_LARGE'			=> 'Duży obraz',
	'IMAGE_FULL_WIDTH'		=> 'Obraz w pełnej szerokości',
	'IMAGE_ALIGN_LEFT'		=> 'Pływający obraz w lewo',
	'IMAGE_ALIGN_RIGHT'		=> 'Pływający obraz po prawej',
	'IMAGE_CIRCLE'			=> 'Obraz okrągły',
	'IMAGE_ROUNDED'			=> 'Zaokrąglony obraz',
	'IMAGE_BORDER'			=> 'Obraz pożyczony',
	'IMAGE_BORDER_PADDING'	=> 'Image border padding',
	'IMAGE_RATIO_SQUARE'	=> 'Obraz kwadratowy',
	'IMAGE_RATIO_4_BY_3'	=> '4 na 3 obrazek',
	'IMAGE_RATIO_16_BY_9'	=> '16 na 9 obrazów',

	'RESPONSIVE_SHOW'		=> 'Pokaż tylko na małych urządzeniach',
	'RESPONSIVE_HIDE'		=> 'Ukryj na małych urządzeniach',

	'ALIGN_LEFT'			=> 'Tekst wyrównany do lewej',
	'ALIGN_CENTER'			=> 'Wyśrodkowany tekst',
	'ALIGN_RIGHT'			=> 'Tekst wyrównany do prawej',
	'NO_PADDING'			=> 'No padding',
	'LABEL'					=> 'Etykieta',
	'BADGE'					=> 'Odznaka',
	'PRIMARY_COLOR'			=> 'Kolor podstawowy',
	'SECONDARY_COLOR'		=> 'Drugorzędny kolor',
	'GRAYSCALE_COLOR'		=> 'Grayscale',
	'INFO_COLOR'			=> 'Informacje',
	'SUCCESS_COLOR'			=> 'Sukces',
	'WARNING_COLOR'			=> 'Ostrzeżenie',
	'DANGER_COLOR'			=> 'Niebezpieczeństwo',
));
