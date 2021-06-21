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
	'LIST_ARROW'			=> 'Pijl lijst marker',
	'LIST_CIRCLE'			=> 'Cirkellijst marker',
	'LIST_DISC'				=> 'Lijst met opsommingstekens',
	'LIST_SQUARE'			=> 'Vierkante lijst marker',
	'LIST_NUMBERED'			=> 'Genummerde lijst',
	'LIST_NUMBERED_ALPHABET' => 'Genummerd met alfabet',
	'LIST_NUMBERED_NESTED'	=> 'Genummerd met subsecties',
	'LIST_NUMBERED_ROMAN'	=> 'Genummerd met Romeinse getallen',
	'LIST_NUMBERED_ZERO'	=> 'Genummerd met voorloopnul',
	'LIST_INLINE'			=> 'Inline lijst',
	'LIST_INLINE_SEP'		=> 'Kommagescheiden lijst',
	'LIST_REVERSE'			=> 'Omgekeerde volgorde',
	'LIST_STRIPED'			=> 'Gestreepte lijst',
	'LIST_STACKED'			=> 'Gestapelde lijst',
	'LIST_TRIANGLE'			=> 'Driehoek',
	'LIST_HYPHEN'			=> 'Koppelteken',
	'LIST_PLUS'				=> 'Plus',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'Vereniging',
	'LIST_DIAMOND'			=> 'Diamant',
	'LIST_HEART'			=> 'Hart',
	'LIST_STAR'				=> 'Ster',
	'LIST_CHECK'			=> 'Controleer',
	'LIST_SNOWFLAKE'		=> 'Sneeuwvlok',
	'LIST_MUSIC'			=> 'Muziek',
	'LIST_AUTOWIDTH'		=> 'Auto width',
	'LIST_FIT_CONTENT'		=> 'Inhoud passend maken',
	'LIST_2COLS'			=> '2 kolomlijst',
	'LIST_3COLS'			=> '3 kolommen lijst',
	'LIST_4COLS'			=> '4 kolommen lijst',
	'LIST_5COLS'			=> '5 kolommen lijst',
	'LIST_X_DIVIDER_DOTTED'	=> 'Horizontale stippeller',
	'LIST_X_DIVIDER_LINE'	=> 'Horizontale lijn verdeler',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Verticale geschatte verdeler',
	'LIST_Y_DIVIDER_LINE'	=> 'Verticale lijn verdeler',

	'IMAGE_SMALL'			=> 'Kleine afbeelding',
	'IMAGE_MEDIUM'			=> 'Middelgrote afbeelding',
	'IMAGE_LARGE'			=> 'Grote afbeelding',
	'IMAGE_FULL_WIDTH'		=> 'Afbeelding met volledige breedte',
	'IMAGE_ALIGN_LEFT'		=> 'Float afbeelding links',
	'IMAGE_ALIGN_RIGHT'		=> 'Zwevende afbeelding rechts',
	'IMAGE_CIRCLE'			=> 'Circulaire afbeelding',
	'IMAGE_ROUNDED'			=> 'Afgeronde afbeelding',
	'IMAGE_BORDER'			=> 'Geordende afbeelding',
	'IMAGE_BORDER_PADDING'	=> 'Image border padding',
	'IMAGE_RATIO_SQUARE'	=> 'Vierkante afbeelding',
	'IMAGE_RATIO_4_BY_3'	=> '4 bij 3 afbeelding',
	'IMAGE_RATIO_16_BY_9'	=> '16 bij 9 afbeelding',

	'RESPONSIVE_SHOW'		=> 'Toon alleen op kleine apparaten',
	'RESPONSIVE_HIDE'		=> 'Verberg op kleine apparaten',

	'ALIGN_LEFT'			=> 'Tekst met links uitgelijnd',
	'ALIGN_CENTER'			=> 'Gecentreerde tekst',
	'ALIGN_RIGHT'			=> 'Rechts uitgelijnd tekst',
	'NO_PADDING'			=> 'No padding',
	'LABEL'					=> 'Omschrijving',
	'BADGE'					=> 'Badge',
	'PRIMARY_COLOR'			=> 'Primaire kleur',
	'SECONDARY_COLOR'		=> 'Secundaire kleur',
	'GRAYSCALE_COLOR'		=> 'Grayscale',
	'INFO_COLOR'			=> 'Informatie',
	'SUCCESS_COLOR'			=> 'Geslaagd',
	'WARNING_COLOR'			=> 'Waarschuwing',
	'DANGER_COLOR'			=> 'Gevaarlijk',
));
