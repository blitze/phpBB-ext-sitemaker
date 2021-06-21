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
	'LIST_ARROW'			=> 'Pfeil-Listen-Marker',
	'LIST_CIRCLE'			=> 'Kreis-Listen-Marker',
	'LIST_DISC'				=> 'Aufzählungsmarker',
	'LIST_SQUARE'			=> 'Quadratlistenmarker',
	'LIST_NUMBERED'			=> 'Nummerierte Liste',
	'LIST_NUMBERED_ALPHABET' => 'Alphabetisch nummeriert',
	'LIST_NUMBERED_NESTED'	=> 'Nummeriert mit Unterabschnitten',
	'LIST_NUMBERED_ROMAN'	=> 'Mit römischen Ziffern nummeriert',
	'LIST_NUMBERED_ZERO'	=> 'Nummeriert mit führender Null',
	'LIST_INLINE'			=> 'Inline-Liste',
	'LIST_INLINE_SEP'		=> 'Komma-getrennte Liste',
	'LIST_REVERSE'			=> 'Reihenfolge umkehren',
	'LIST_STRIPED'			=> 'Streifenliste',
	'LIST_STACKED'			=> 'Gestapelte Liste',
	'LIST_TRIANGLE'			=> 'Dreieck',
	'LIST_HYPHEN'			=> 'Bindestrich',
	'LIST_PLUS'				=> 'Plus',
	'LIST_SPADE'			=> 'Spaten',
	'LIST_CLUB'				=> 'Club',
	'LIST_DIAMOND'			=> 'Diamant',
	'LIST_HEART'			=> 'Herz',
	'LIST_STAR'				=> 'Stern',
	'LIST_CHECK'			=> 'Check',
	'LIST_SNOWFLAKE'		=> 'Schneeflocke',
	'LIST_MUSIC'			=> 'Musik',
	'LIST_AUTOWIDTH'		=> 'Automatische Breite',
	'LIST_FIT_CONTENT'		=> 'Inhalt anpassen',
	'LIST_2COLS'			=> '2 column list',
	'LIST_3COLS'			=> '3 columns list',
	'LIST_4COLS'			=> '4 columns list',
	'LIST_5COLS'			=> '5 columns list',
	'LIST_X_DIVIDER_DOTTED'	=> 'Horizontaler gepunkteter Trenner',
	'LIST_X_DIVIDER_LINE'	=> 'Horizontaler Linientrenner',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Vertikaler gepunkteter Trenner',
	'LIST_Y_DIVIDER_LINE'	=> 'Vertikaler Linientrenner',

	'IMAGE_SMALL'			=> 'Kleines Bild',
	'IMAGE_MEDIUM'			=> 'Mittleres Bild',
	'IMAGE_LARGE'			=> 'Großes Bild',
	'IMAGE_FULL_WIDTH'		=> 'Bild mit voller Breite',
	'IMAGE_ALIGN_LEFT'		=> 'Gleitbild links',
	'IMAGE_ALIGN_RIGHT'		=> 'Bild rechts schweben',
	'IMAGE_CIRCLE'			=> 'Kreisbild',
	'IMAGE_ROUNDED'			=> 'Abgerundetes Bild',
	'IMAGE_BORDER'			=> 'Randbild',
	'IMAGE_BORDER_PADDING'	=> 'Bildrahmen',
	'IMAGE_RATIO_SQUARE'	=> 'Quadratisches Bild',
	'IMAGE_RATIO_4_BY_3'	=> '4 by 3 image',
	'IMAGE_RATIO_16_BY_9'	=> '16 by 9 image',

	'RESPONSIVE_SHOW'		=> 'Nur auf kleinen Geräten anzeigen',
	'RESPONSIVE_HIDE'		=> 'Auf kleinen Geräten ausblenden',

	'ALIGN_LEFT'			=> 'Linksbündiger Text',
	'ALIGN_CENTER'			=> 'Zentrierter Text',
	'ALIGN_RIGHT'			=> 'Rechtsbündiger Text',
	'NO_PADDING'			=> 'Kein Polster',
	'LABEL'					=> 'Label',
	'BADGE'					=> 'Abzeichen',
	'PRIMARY_COLOR'			=> 'Primärfarbe',
	'SECONDARY_COLOR'		=> 'Sekundäre Farbe',
	'GRAYSCALE_COLOR'		=> 'Graustufen',
	'INFO_COLOR'			=> 'Info',
	'SUCCESS_COLOR'			=> 'Erfolgreich',
	'WARNING_COLOR'			=> 'Warnung',
	'DANGER_COLOR'			=> 'Gefahr',
));
