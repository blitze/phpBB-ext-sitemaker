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
	'LIST_CIRCLE'			=> 'Cirkel liste markør',
	'LIST_DISC'				=> 'Kugleliste markør',
	'LIST_SQUARE'			=> 'Kvadrat liste markør',
	'LIST_NUMBERED'			=> 'Nummereret liste',
	'LIST_NUMBERED_ALPHABET' => 'Nummereret med alfabet',
	'LIST_NUMBERED_NESTED'	=> 'Nummereret med underafsnit',
	'LIST_NUMBERED_ROMAN'	=> 'Nummereret med romertal',
	'LIST_NUMBERED_ZERO'	=> 'Nummereret med førende nul',
	'LIST_INLINE'			=> 'Inline liste',
	'LIST_INLINE_SEP'		=> 'Kommasepareret liste',
	'LIST_REVERSE'			=> 'Omvendt ordre',
	'LIST_STRIPED'			=> 'Stribet liste',
	'LIST_STACKED'			=> 'Stablet liste',
	'LIST_TRIANGLE'			=> 'Trekant',
	'LIST_HYPHEN'			=> 'Hyphen',
	'LIST_PLUS'				=> 'Plus',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'Klub',
	'LIST_DIAMOND'			=> 'Diamant',
	'LIST_HEART'			=> 'Hjerte',
	'LIST_STAR'				=> 'Stjerne',
	'LIST_CHECK'			=> 'Tjek',
	'LIST_SNOWFLAKE'		=> 'Snefnug',
	'LIST_MUSIC'			=> 'Musik',
	'LIST_AUTOWIDTH'		=> 'Auto width',
	'LIST_FIT_CONTENT'		=> 'Tilpas indhold',
	'LIST_2COLS'			=> '2 kolonneliste',
	'LIST_3COLS'			=> '3 kolonner liste',
	'LIST_4COLS'			=> '4 kolonner liste',
	'LIST_5COLS'			=> '5 kolonner liste',
	'LIST_X_DIVIDER_DOTTED'	=> 'Vandret punkteret skillevæg',
	'LIST_X_DIVIDER_LINE'	=> 'Vandret linjeskillevæg',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Lodret punkteret skillevæg',
	'LIST_Y_DIVIDER_LINE'	=> 'Lodret linjedeler',

	'IMAGE_SMALL'			=> 'Lille billede',
	'IMAGE_MEDIUM'			=> 'Mellem billede',
	'IMAGE_LARGE'			=> 'Stort billede',
	'IMAGE_FULL_WIDTH'		=> 'Fuld bredde billede',
	'IMAGE_ALIGN_LEFT'		=> 'Flydende billede til venstre',
	'IMAGE_ALIGN_RIGHT'		=> 'Flydende billede højre',
	'IMAGE_CIRCLE'			=> 'Cirkulært billede',
	'IMAGE_ROUNDED'			=> 'Afrundet billede',
	'IMAGE_BORDER'			=> 'Kant billede',
	'IMAGE_BORDER_PADDING'	=> 'Image border padding',
	'IMAGE_RATIO_SQUARE'	=> 'Firkantet Billede',
	'IMAGE_RATIO_4_BY_3'	=> '4 efter 3 billede',
	'IMAGE_RATIO_16_BY_9'	=> '16 af 9 billede',

	'RESPONSIVE_SHOW'		=> 'Vis kun på små enheder',
	'RESPONSIVE_HIDE'		=> 'Skjul på små enheder',

	'ALIGN_LEFT'			=> 'Venstrejusteret tekst',
	'ALIGN_CENTER'			=> 'Centreret tekst',
	'ALIGN_RIGHT'			=> 'Højrejusteret tekst',
	'NO_PADDING'			=> 'No padding',
	'LABEL'					=> 'Etiket',
	'BADGE'					=> 'Mærke',
	'PRIMARY_COLOR'			=> 'Primær farve',
	'SECONDARY_COLOR'		=> 'Sekundær farve',
	'GRAYSCALE_COLOR'		=> 'Grayscale',
	'INFO_COLOR'			=> 'Info',
	'SUCCESS_COLOR'			=> 'Succes',
	'WARNING_COLOR'			=> 'Advarsel',
	'DANGER_COLOR'			=> 'Fare',
));
