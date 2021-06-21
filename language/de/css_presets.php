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
	'LIST_ARROW'			=> 'Pfeil-Listenmarker',
	'LIST_CIRCLE'			=> 'Kreisliste Marker',
	'LIST_DISC'				=> 'Kugellistenmarker',
	'LIST_SQUARE'			=> 'Quadratlistenmarker',
	'LIST_NUMBERED'			=> 'Nummerierte Liste',
	'LIST_NUMBERED_ALPHABET' => 'Mit Alphabet nummeriert',
	'LIST_NUMBERED_NESTED'	=> 'Nummeriert mit Unterabschnitten',
	'LIST_NUMBERED_ROMAN'	=> 'Mit römischen Ziffern nummeriert',
	'LIST_NUMBERED_ZERO'	=> 'Nummeriert mit führender Null',
	'LIST_INLINE'			=> 'Inline-Liste',
	'LIST_INLINE_SEP'		=> 'Komma-getrennte Liste',
	'LIST_REVERSE'			=> 'Reihenfolge umkehren',
	'LIST_STRIPED'			=> 'Liste gestreift',
	'LIST_STACKED'			=> 'Stapelliste',
	'LIST_TRIANGLE'			=> 'Dreieck',
	'LIST_HYPHEN'			=> 'Hyphen',
	'LIST_PLUS'				=> 'Plus',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'Klub',
	'LIST_DIAMOND'			=> 'Diamant',
	'LIST_HEART'			=> 'Herz',
	'LIST_STAR'				=> 'Stern',
	'LIST_CHECK'			=> 'Prüfen',
	'LIST_SNOWFLAKE'		=> 'Schneeflocken',
	'LIST_MUSIC'			=> 'Musik',
	'LIST_AUTOWIDTH'		=> 'Auto width',
	'LIST_FIT_CONTENT'		=> 'Inhalt anpassen',
	'LIST_2COLS'			=> '2-spaltige Liste',
	'LIST_3COLS'			=> '3-Spalten Liste',
	'LIST_4COLS'			=> '4-Spalten Liste',
	'LIST_5COLS'			=> '5-Spalten Liste',
	'LIST_X_DIVIDER_DOTTED'	=> 'Horizontal gepunkteter Trenner',
	'LIST_X_DIVIDER_LINE'	=> 'Horizontale Linientrennung',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Vertikaler gepunkteter Trenner',
	'LIST_Y_DIVIDER_LINE'	=> 'Vertikale Linientrennung',

	'IMAGE_SMALL'			=> 'Kleines Bild',
	'IMAGE_MEDIUM'			=> 'Mittleres Bild',
	'IMAGE_LARGE'			=> 'Großes Bild',
	'IMAGE_FULL_WIDTH'		=> 'Bild in voller Breite',
	'IMAGE_ALIGN_LEFT'		=> 'Schwebendes Bild links',
	'IMAGE_ALIGN_RIGHT'		=> 'Schwebendes Bild rechts',
	'IMAGE_CIRCLE'			=> 'Kreisbild',
	'IMAGE_ROUNDED'			=> 'Abgerundete Bild',
	'IMAGE_BORDER'			=> 'Gesperrtes Bild',
	'IMAGE_BORDER_PADDING'	=> 'Image border padding',
	'IMAGE_RATIO_SQUARE'	=> 'Quadratisches Bild',
	'IMAGE_RATIO_4_BY_3'	=> '4 x 3 Bild',
	'IMAGE_RATIO_16_BY_9'	=> '16 von 9 Bild',

	'RESPONSIVE_SHOW'		=> 'Nur auf kleinen Geräten anzeigen',
	'RESPONSIVE_HIDE'		=> 'Auf kleinen Geräten ausblenden',

	'ALIGN_LEFT'			=> 'Linksgerichteter Text',
	'ALIGN_CENTER'			=> 'Zentrierter Text',
	'ALIGN_RIGHT'			=> 'Rechtsgerichteter Text',
	'NO_PADDING'			=> 'No padding',
	'LABEL'					=> 'Label',
	'BADGE'					=> 'Abzeichen',
	'PRIMARY_COLOR'			=> 'Primäre Farbe',
	'SECONDARY_COLOR'		=> 'Sekundärfarbe',
	'GRAYSCALE_COLOR'		=> 'Grayscale',
	'INFO_COLOR'			=> 'Info',
	'SUCCESS_COLOR'			=> 'Erfolg',
	'WARNING_COLOR'			=> 'Warnung',
	'DANGER_COLOR'			=> 'Gefahr',
));
