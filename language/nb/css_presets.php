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
	'LIST_ARROW'			=> 'Pil liste markør',
	'LIST_CIRCLE'			=> 'Sirkel liste markør',
	'LIST_DISC'				=> 'Punktliste markør',
	'LIST_SQUARE'			=> 'Kvadrat liste markør',
	'LIST_NUMBERED'			=> 'Nummerert liste',
	'LIST_NUMBERED_ALPHABET' => 'Nummerert med alfabetisk',
	'LIST_NUMBERED_NESTED'	=> 'Nummerert med underseksjoner',
	'LIST_NUMBERED_ROMAN'	=> 'Nummerert med Romeriske tall',
	'LIST_NUMBERED_ZERO'	=> 'Nummerert med ledende null',
	'LIST_INLINE'			=> 'Innebygd liste',
	'LIST_INLINE_SEP'		=> 'Kommaseparert liste',
	'LIST_REVERSE'			=> 'Motsatt rekkefølge',
	'LIST_STRIPED'			=> 'Stripet liste',
	'LIST_STACKED'			=> 'Stablet liste',
	'LIST_TRIANGLE'			=> 'Trekant',
	'LIST_HYPHEN'			=> 'Bindestrek',
	'LIST_PLUS'				=> 'Pluss',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'Klubb',
	'LIST_DIAMOND'			=> 'Diamant',
	'LIST_HEART'			=> 'Hjerte',
	'LIST_STAR'				=> 'Stjerne',
	'LIST_CHECK'			=> 'Sjekk',
	'LIST_SNOWFLAKE'		=> 'Snøfnugg',
	'LIST_MUSIC'			=> 'Musikk',
	'LIST_AUTOWIDTH'		=> 'Auto width',
	'LIST_FIT_CONTENT'		=> 'Tilpass innhold',
	'LIST_2COLS'			=> '2 kolonneliste',
	'LIST_3COLS'			=> 'Liste over tre kolonner',
	'LIST_4COLS'			=> '4 kolonner liste',
	'LIST_5COLS'			=> '5 kolonner liste',
	'LIST_X_DIVIDER_DOTTED'	=> 'Horisontal stiftet divider',
	'LIST_X_DIVIDER_LINE'	=> 'Horisontal linje divider',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Vertikal stiplet divider',
	'LIST_Y_DIVIDER_LINE'	=> 'Loddrett linjedimmer',

	'IMAGE_SMALL'			=> 'Lite bilde',
	'IMAGE_MEDIUM'			=> 'Middels bilde',
	'IMAGE_LARGE'			=> 'Stort bilde',
	'IMAGE_FULL_WIDTH'		=> 'Fullt bredde bilde',
	'IMAGE_ALIGN_LEFT'		=> 'Flytende bilde til venstre',
	'IMAGE_ALIGN_RIGHT'		=> 'Justert bilde høyre',
	'IMAGE_CIRCLE'			=> 'Sirkulært bilde',
	'IMAGE_ROUNDED'			=> 'Avrundet bilde',
	'IMAGE_BORDER'			=> 'Kantet bilde',
	'IMAGE_BORDER_PADDING'	=> 'Image border padding',
	'IMAGE_RATIO_SQUARE'	=> 'Kvadratisk bilde',
	'IMAGE_RATIO_4_BY_3'	=> '4 med 3 bilder',
	'IMAGE_RATIO_16_BY_9'	=> '16 på 9 bilde',

	'RESPONSIVE_SHOW'		=> 'Vis bare på små enheter',
	'RESPONSIVE_HIDE'		=> 'Skjul på små enheter',

	'ALIGN_LEFT'			=> 'Venstrejustert tekst',
	'ALIGN_CENTER'			=> 'Sentrert tekst',
	'ALIGN_RIGHT'			=> 'Høyrejustert tekst',
	'NO_PADDING'			=> 'No padding',
	'LABEL'					=> 'Etikett',
	'BADGE'					=> 'App-symbol',
	'PRIMARY_COLOR'			=> 'Primær farge',
	'SECONDARY_COLOR'		=> 'Sekundær farge',
	'GRAYSCALE_COLOR'		=> 'Grayscale',
	'INFO_COLOR'			=> 'Informasjon',
	'SUCCESS_COLOR'			=> 'Vellykket',
	'WARNING_COLOR'			=> 'Advarsel',
	'DANGER_COLOR'			=> 'Fare',
));
