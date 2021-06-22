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
	'LIST_ARROW'			=> 'Marcajul listei de săgeţi',
	'LIST_CIRCLE'			=> 'Indicator listă cerc',
	'LIST_DISC'				=> 'Marcajul listei de gloanțe',
	'LIST_SQUARE'			=> 'Marker listă pătrați',
	'LIST_NUMBERED'			=> 'Listă numerotată',
	'LIST_NUMBERED_ALPHABET' => 'Numărat cu alfabet',
	'LIST_NUMBERED_NESTED'	=> 'Numărat cu subsecțiuni',
	'LIST_NUMBERED_ROMAN'	=> 'Numărat cu cifre romane',
	'LIST_NUMBERED_ZERO'	=> 'Numărat cu zero principal',
	'LIST_INLINE'			=> 'Inline Listă',
	'LIST_INLINE_SEP'		=> 'Listă separată prin virgulă',
	'LIST_REVERSE'			=> 'Ordinea inversă',
	'LIST_STRIPED'			=> 'Listă dărâmată',
	'LIST_STACKED'			=> 'Listă Stacked',
	'LIST_TRIANGLE'			=> 'Triunghi',
	'LIST_HYPHEN'			=> 'Umbră',
	'LIST_PLUS'				=> 'Plus',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'Club',
	'LIST_DIAMOND'			=> 'Diamant',
	'LIST_HEART'			=> 'Inimă',
	'LIST_STAR'				=> 'Stea',
	'LIST_CHECK'			=> 'Verifică',
	'LIST_SNOWFLAKE'		=> 'fulg de zăpadă',
	'LIST_MUSIC'			=> 'Muzică',
	'LIST_AUTOWIDTH'		=> 'Auto width',
	'LIST_FIT_CONTENT'		=> 'Potrivire conținut',
	'LIST_2COLS'			=> '2 coloane lista',
	'LIST_3COLS'			=> '3 liste de coloane',
	'LIST_4COLS'			=> 'Lista de 4 coloane',
	'LIST_5COLS'			=> 'Lista de 5 coloane',
	'LIST_X_DIVIDER_DOTTED'	=> 'Divizare punctată orizontală',
	'LIST_X_DIVIDER_LINE'	=> 'Divizare linie orizontală',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Divizor punctat vertical',
	'LIST_Y_DIVIDER_LINE'	=> 'Divizare linie verticală',

	'IMAGE_SMALL'			=> 'Imagine mica',
	'IMAGE_MEDIUM'			=> 'Imagine medie',
	'IMAGE_LARGE'			=> 'Imagine mare',
	'IMAGE_FULL_WIDTH'		=> 'Lățime completă imagine',
	'IMAGE_ALIGN_LEFT'		=> 'Poză plutitoare rămasă',
	'IMAGE_ALIGN_RIGHT'		=> 'Imagine plutitoare dreapta',
	'IMAGE_CIRCLE'			=> 'Imagine circulară',
	'IMAGE_ROUNDED'			=> 'Imagine rotunjită',
	'IMAGE_BORDER'			=> 'Imagine graniță',
	'IMAGE_BORDER_PADDING'	=> 'Image border padding',
	'IMAGE_RATIO_SQUARE'	=> 'Imagine pătrată',
	'IMAGE_RATIO_4_BY_3'	=> '4 după 3 imagini',
	'IMAGE_RATIO_16_BY_9'	=> '16 de la 9 imagini',

	'RESPONSIVE_SHOW'		=> 'Arată numai pe dispozitivele mici',
	'RESPONSIVE_HIDE'		=> 'Ascunde pe dispozitivele mici',

	'ALIGN_LEFT'			=> 'Text aliniat la stânga',
	'ALIGN_CENTER'			=> 'Text centrat',
	'ALIGN_RIGHT'			=> 'Text aliniat la dreapta',
	'NO_PADDING'			=> 'No padding',
	'LABEL'					=> 'Etichetă',
	'BADGE'					=> 'Insignă',
	'PRIMARY_COLOR'			=> 'Culoare primară',
	'SECONDARY_COLOR'		=> 'Culoare secundară',
	'GRAYSCALE_COLOR'		=> 'Grayscale',
	'INFO_COLOR'			=> 'Info',
	'SUCCESS_COLOR'			=> 'Succes',
	'WARNING_COLOR'			=> 'Avertizare',
	'DANGER_COLOR'			=> 'Periculos',
));
