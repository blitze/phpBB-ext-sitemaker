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
	'LIST_ARROW'			=> 'Arrow list marker',
	'LIST_CIRCLE'			=> 'Circle list marker',
	'LIST_DISC'				=> 'Bullet list marker',
	'LIST_SQUARE'			=> 'Square list marker',
	'LIST_NUMBERED'			=> 'Numbered list',
	'LIST_NUMBERED_ALPHABET' => 'Numbered with alphabet',
	'LIST_NUMBERED_NESTED'	=> 'Numbered with subsections',
	'LIST_NUMBERED_ROMAN'	=> 'Numbered with Roman numerals',
	'LIST_NUMBERED_ZERO'	=> 'Numbered with leading zero',
	'LIST_INLINE'			=> 'Inline list',
	'LIST_INLINE_SEP'		=> 'Comma-separated list',
	'LIST_REVERSE'			=> 'Reverse order',
	'LIST_STRIPED'			=> 'Striped list',
	'LIST_STACKED'			=> 'Stacked list',
	'LIST_TRIANGLE'			=> 'Triangle',
	'LIST_HYPHEN'			=> 'Hyphen',
	'LIST_PLUS'				=> 'Plus',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'Kulüp',
	'LIST_DIAMOND'			=> 'Diamond',
	'LIST_HEART'			=> 'Kupa',
	'LIST_STAR'				=> 'Yıldız',
	'LIST_CHECK'			=> 'Check',
	'LIST_SNOWFLAKE'		=> 'Snowflake',
	'LIST_MUSIC'			=> 'Müzik',
	'LIST_AUTOWIDTH'		=> 'Otomatik genişlik',
	'LIST_FIT_CONTENT'		=> 'Fit content',
	'LIST_2COLS'			=> '2 column list',
	'LIST_3COLS'			=> '3 columns list',
	'LIST_4COLS'			=> '4 columns list',
	'LIST_5COLS'			=> '5 columns list',
	'LIST_X_DIVIDER_DOTTED'	=> 'Horizontal dotted divider',
	'LIST_X_DIVIDER_LINE'	=> 'Horizontal line divider',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Vertical dotted divider',
	'LIST_Y_DIVIDER_LINE'	=> 'Vertical line divider',

	'IMAGE_SMALL'			=> 'Küçük Görsel',
	'IMAGE_MEDIUM'			=> 'Orta Görsel',
	'IMAGE_LARGE'			=> 'Büyük Görsel',
	'IMAGE_FULL_WIDTH'		=> 'Full width image',
	'IMAGE_ALIGN_LEFT'		=> 'Float image left',
	'IMAGE_ALIGN_RIGHT'		=> 'Float image right',
	'IMAGE_CIRCLE'			=> 'Circular image',
	'IMAGE_ROUNDED'			=> 'Rounded image',
	'IMAGE_BORDER'			=> 'Bordered image',
	'IMAGE_BORDER_PADDING'	=> 'Image border padding',
	'IMAGE_RATIO_SQUARE'	=> 'Square Image',
	'IMAGE_RATIO_4_BY_3'	=> '4 by 3 image',
	'IMAGE_RATIO_16_BY_9'	=> '16 by 9 image',

	'RESPONSIVE_SHOW'		=> 'Show only on small devices',
	'RESPONSIVE_HIDE'		=> 'Hide on small devices',

	'ALIGN_LEFT'			=> 'Left-aligned text',
	'ALIGN_CENTER'			=> 'Centered text',
	'ALIGN_RIGHT'			=> 'Right-aligned text',
	'NO_PADDING'			=> 'No padding',
	'LABEL'					=> 'Label',
	'BADGE'					=> 'Badge',
	'PRIMARY_COLOR'			=> 'Primary color',
	'SECONDARY_COLOR'		=> 'Secondary color',
	'GRAYSCALE_COLOR'		=> 'Grayscale',
	'INFO_COLOR'			=> 'Info',
	'SUCCESS_COLOR'			=> 'Success',
	'WARNING_COLOR'			=> 'Warning',
	'DANGER_COLOR'			=> 'Danger',
));
