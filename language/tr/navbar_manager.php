<?php

/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
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

$lang = array_merge($lang, array(
	'ACTIVE_ELEMENT'			=> 'Aktif Eleman',
	'BORDER'					=> 'Kenarlık',
	'BORDER_COLOR'				=> 'Kenarlık Rengi',
	'BORDER_RADIUS'				=> 'Kenarlık Yarıçapı',
	'BORDER_WIDTH'				=> 'Kenarlık Genişliği',
	'BOTTOM'					=> 'En Alt',
	'BOTTOM_LEFT'				=> 'Sol Alt',
	'BOTTOM_RIGHT'				=> 'Sağ Alt',
	'CAPITALIZE'				=> 'Büyük Harfe Çevir',
	'COLOR'						=> 'Renk',
	'DIVIDERS'					=> 'Ayırıcılar',
	'END'						=> 'Son',
	'GRADIENT'					=> 'Eğim',
	'HEADERS'					=> 'Başlıklar',
	'HOVER'						=> 'Vurgu',
	'LEFT'						=> 'Sol',
	'LOWERCASE'					=> 'Küçük harf',
	'MARGIN'					=> 'Margin',
	'NAVBAR'					=> 'Gezinti çubuğu',
	'NAVBAR_MENU'				=> 'Gezinti Çubuğu Menüsü',
	'NAVBAR_DROPDOWN'			=> 'Açılır Liste',
	'NAVBAR_LOCATION'			=> 'Konum',
	'NAVBAR_LOCATION_OPTION'	=> 'Konum #%s',
	'NAVBAR_TOP_MENU'			=> 'Üst Menü',
	'NONE'						=> 'Hiçbiri',
	'PADDING'					=> 'Dolgu',
	'RESPONSIVE_TOGGLE'			=> 'Duyarlı Geçiş',
	'RESPONSIVE_TOGGLE_EXPLAIN'	=> 'Sadece küçük (mobil) ekranlarda görüntülenebilir',
	'RIGHT'						=> 'Sağ',
	'SAVE'						=> 'Kaydet',
	'SIZE'						=> 'Boyut',
	'START'						=> 'Başlat',
	'TEXT'						=> 'Metin',
	'TOP'						=> 'Üst',
	'TOP_LEFT'					=> 'Sol Üst',
	'TOP_RIGHT'					=> 'Sağ Üst',
	'TRANSFORM'					=> 'Dönüştür',
	'UPPERCASE'					=> 'Büyük harf',
));
