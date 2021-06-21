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
	'LIST_CIRCLE'			=> 'Cirkel lijst markering',
	'LIST_DISC'				=> 'Kogellijst markering',
	'LIST_SQUARE'			=> 'Vierkante lijst marker',
	'LIST_NUMBERED'			=> 'Genummerde lijst',
	'LIST_NUMBERED_ALPHABET' => 'Numbered with alphabet',
	'LIST_NUMBERED_NESTED'	=> 'Numbered with subsections',
	'LIST_NUMBERED_ROMAN'	=> 'Numbered with Roman numerals',
	'LIST_NUMBERED_ZERO'	=> 'Numbered with leading zero',
	'LIST_INLINE'			=> 'Inline lijst',
	'LIST_INLINE_SEP'		=> 'Komma-gescheiden lijst',
	'LIST_REVERSE'			=> 'Reverse order',
	'LIST_STRIPED'			=> 'Gestreepte lijst',
	'LIST_STACKED'			=> 'Gestapelde lijst',
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
	'LIST_AUTOWIDTH'		=> 'Automatische breedte',
	'LIST_FIT_CONTENT'		=> 'Inhoud aanpassen',
	'LIST_2COLS'			=> '2 column list',
	'LIST_3COLS'			=> '3 columns list',
	'LIST_4COLS'			=> '4 columns list',
	'LIST_5COLS'			=> '5 columns list',
	'LIST_X_DIVIDER_DOTTED'	=> 'Horizontale gedoseerde divider',
	'LIST_X_DIVIDER_LINE'	=> 'Horizontale lijndivider',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Verticaal gedoopte provider',
	'LIST_Y_DIVIDER_LINE'	=> 'Verticale lijndivider',

	'IMAGE_SMALL'			=> 'Kleine afbeelding',
	'IMAGE_MEDIUM'			=> 'Middelgrote afbeelding',
	'IMAGE_LARGE'			=> 'Grote afbeelding',
	'IMAGE_FULL_WIDTH'		=> 'Volledige breedte afbeelding',
	'IMAGE_ALIGN_LEFT'		=> 'Zwevende afbeelding links',
	'IMAGE_ALIGN_RIGHT'		=> 'Float afbeelding rechts',
	'IMAGE_CIRCLE'			=> 'Circulaire afbeelding',
	'IMAGE_ROUNDED'			=> 'Afgeronde afbeelding',
	'IMAGE_BORDER'			=> 'Geordende afbeelding',
	'IMAGE_BORDER_PADDING'	=> 'Afbeelding rand opvulling',
	'IMAGE_RATIO_SQUARE'	=> 'Vierkante afbeelding',
	'IMAGE_RATIO_4_BY_3'	=> '4 by 3 image',
	'IMAGE_RATIO_16_BY_9'	=> '16 by 9 image',

	'RESPONSIVE_SHOW'		=> 'Toon alleen op kleine apparaten',
	'RESPONSIVE_HIDE'		=> 'Verberg op kleine apparaten',

	'ALIGN_LEFT'			=> 'Linker-uitgelijnde tekst',
	'ALIGN_CENTER'			=> 'Gecentreerde tekst',
	'ALIGN_RIGHT'			=> 'Rechts uitgelijnde tekst',
	'NO_PADDING'			=> 'Geen opvulling',
	'LABEL'					=> 'Label',
	'BADGE'					=> 'Badge',
	'PRIMARY_COLOR'			=> 'Primaire kleur',
	'SECONDARY_COLOR'		=> 'Secundaire kleur',
	'GRAYSCALE_COLOR'		=> 'Grijswaarden',
	'INFO_COLOR'			=> 'Info',
	'SUCCESS_COLOR'			=> 'Succes',
	'WARNING_COLOR'			=> 'Waarschuwing',
	'DANGER_COLOR'			=> 'Gevaar',
));
