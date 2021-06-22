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
	'LIST_ARROW'			=> 'Pil lista markör',
	'LIST_CIRCLE'			=> 'Cirkellistans markör',
	'LIST_DISC'				=> 'Punktlistans markör',
	'LIST_SQUARE'			=> 'Kvadrat lista markör',
	'LIST_NUMBERED'			=> 'Numrerad lista',
	'LIST_NUMBERED_ALPHABET' => 'Numrerat med alfabetet',
	'LIST_NUMBERED_NESTED'	=> 'Numrerad med underavdelningar',
	'LIST_NUMBERED_ROMAN'	=> 'Numrerad med romerska siffror',
	'LIST_NUMBERED_ZERO'	=> 'Numrerad med ledande noll',
	'LIST_INLINE'			=> 'Infogad lista',
	'LIST_INLINE_SEP'		=> 'Kommaseparerad lista',
	'LIST_REVERSE'			=> 'Omvänd ordning',
	'LIST_STRIPED'			=> 'Randig lista',
	'LIST_STACKED'			=> 'Staplad lista',
	'LIST_TRIANGLE'			=> 'Triangel',
	'LIST_HYPHEN'			=> 'Hyfen',
	'LIST_PLUS'				=> 'Plus',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'Klubb',
	'LIST_DIAMOND'			=> 'Diamant',
	'LIST_HEART'			=> 'Hjärta',
	'LIST_STAR'				=> 'Stjärna',
	'LIST_CHECK'			=> 'Kontrollera',
	'LIST_SNOWFLAKE'		=> 'Snöflinga',
	'LIST_MUSIC'			=> 'Musik',
	'LIST_AUTOWIDTH'		=> 'Auto width',
	'LIST_FIT_CONTENT'		=> 'Anpassa innehåll',
	'LIST_2COLS'			=> 'Lista med 2 kolumner',
	'LIST_3COLS'			=> '3 kolumner lista',
	'LIST_4COLS'			=> '4 kolumner lista',
	'LIST_5COLS'			=> '5 kolumner lista',
	'LIST_X_DIVIDER_DOTTED'	=> 'Horisontell prickad avdelare',
	'LIST_X_DIVIDER_LINE'	=> 'Horisontell linjedragare',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Vertikal prickad avdelare',
	'LIST_Y_DIVIDER_LINE'	=> 'Vertikal linjedragare',

	'IMAGE_SMALL'			=> 'Liten bild',
	'IMAGE_MEDIUM'			=> 'Medelstor bild',
	'IMAGE_LARGE'			=> 'Stor bild',
	'IMAGE_FULL_WIDTH'		=> 'Full breddbild',
	'IMAGE_ALIGN_LEFT'		=> 'Flytbild till vänster',
	'IMAGE_ALIGN_RIGHT'		=> 'Flytbild till höger',
	'IMAGE_CIRCLE'			=> 'Cirkulär bild',
	'IMAGE_ROUNDED'			=> 'Rundad bild',
	'IMAGE_BORDER'			=> 'Kantad bild',
	'IMAGE_BORDER_PADDING'	=> 'Image border padding',
	'IMAGE_RATIO_SQUARE'	=> 'Kvadrat bild',
	'IMAGE_RATIO_4_BY_3'	=> '4 av 3 bild',
	'IMAGE_RATIO_16_BY_9'	=> '16 av 9 bild',

	'RESPONSIVE_SHOW'		=> 'Visa endast på små enheter',
	'RESPONSIVE_HIDE'		=> 'Dölj på små enheter',

	'ALIGN_LEFT'			=> 'Vänsterjusterad text',
	'ALIGN_CENTER'			=> 'Centrerad text',
	'ALIGN_RIGHT'			=> 'Högerjusterad text',
	'NO_PADDING'			=> 'No padding',
	'LABEL'					=> 'Etikett',
	'BADGE'					=> 'Märke',
	'PRIMARY_COLOR'			=> 'Primär färg',
	'SECONDARY_COLOR'		=> 'Sekundär färg',
	'GRAYSCALE_COLOR'		=> 'Grayscale',
	'INFO_COLOR'			=> 'Information',
	'SUCCESS_COLOR'			=> 'Klart',
	'WARNING_COLOR'			=> 'Varning',
	'DANGER_COLOR'			=> 'Fara',
));
