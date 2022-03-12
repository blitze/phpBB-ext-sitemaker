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
	'LIST_ARROW'			=> 'Ok liste oluşturucu',
	'LIST_CIRCLE'			=> 'Daire liste oluşturucu',
	'LIST_DISC'				=> 'Mermi liste oluturucu',
	'LIST_SQUARE'			=> 'Kare liste oluşturucu',
	'LIST_NUMBERED'			=> 'Numaralı liste',
	'LIST_NUMBERED_ALPHABET' => 'Alfabe ile numaralandırılmış',
	'LIST_NUMBERED_NESTED'	=> 'Alt bölümlerle numaralandırılmış',
	'LIST_NUMBERED_ROMAN'	=> 'Roma rakamlarıyla numaralandırılmış',
	'LIST_NUMBERED_ZERO'	=> 'Başında sıfır ile numaralandırılmış',
	'LIST_INLINE'			=> 'Satır içi liste',
	'LIST_INLINE_SEP'		=> 'Virgülle ayrılmış liste',
	'LIST_REVERSE'			=> 'Sıralamayı ters çevir',
	'LIST_STRIPED'			=> 'Çizgili liste',
	'LIST_STACKED'			=> 'Yığılmış liste',
	'LIST_TRIANGLE'			=> 'Üçgen',
	'LIST_HYPHEN'			=> 'Tire',
	'LIST_PLUS'				=> 'Artı',
	'LIST_SPADE'			=> 'Maça',
	'LIST_CLUB'				=> 'Kulüp',
	'LIST_DIAMOND'			=> 'Karo',
	'LIST_HEART'			=> 'Kupa',
	'LIST_STAR'				=> 'Yıldız',
	'LIST_CHECK'			=> 'Kontrol et',
	'LIST_SNOWFLAKE'		=> 'Kar tanesi',
	'LIST_MUSIC'			=> 'Müzik',
	'LIST_AUTOWIDTH'		=> 'Otomatik genişlik',
	'LIST_FIT_CONTENT'		=> 'Uygun içerik',
	'LIST_2COLS'			=> '2 sütun liste',
	'LIST_3COLS'			=> '3 sütun liste',
	'LIST_4COLS'			=> '4 sütun liste',
	'LIST_5COLS'			=> '5 sütun liste',
	'LIST_X_DIVIDER_DOTTED'	=> 'Yatay noktalı bölücü',
	'LIST_X_DIVIDER_LINE'	=> 'Yatay çizgi bölücü',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Dikey noktaalı bölücü',
	'LIST_Y_DIVIDER_LINE'	=> 'Dikey çizgi bölücü',

	'IMAGE_SMALL'			=> 'Küçük Görsel',
	'IMAGE_MEDIUM'			=> 'Orta Görsel',
	'IMAGE_LARGE'			=> 'Büyük Görsel',
	'IMAGE_FULL_WIDTH'		=> 'Tam genişlik resim',
	'IMAGE_ALIGN_LEFT'		=> 'Resmi sola yüzdür',
	'IMAGE_ALIGN_RIGHT'		=> 'Resmi sağa yüzdür',
	'IMAGE_CIRCLE'			=> 'Dairesel resim',
	'IMAGE_ROUNDED'			=> 'Yuvarlatılmış resim',
	'IMAGE_BORDER'			=> 'Kenarlıklı resim',
	'IMAGE_BORDER_PADDING'	=> 'Görüntü kenarlığı dolgusu',
	'IMAGE_RATIO_SQUARE'	=> 'Kare Resim',
	'IMAGE_RATIO_4_BY_3'	=> '4\'e 3 resim',
	'IMAGE_RATIO_16_BY_9'	=> '16\'ya 9 resim',

	'RESPONSIVE_SHOW'		=> 'Sadece küçük (mobil) cihazlarda göster',
	'RESPONSIVE_HIDE'		=> 'Mobil cihazlarda gizle',

	'ALIGN_LEFT'			=> 'Sola hizalı metin',
	'ALIGN_CENTER'			=> 'Ortalı metin',
	'ALIGN_RIGHT'			=> 'Sağa hizalı metin',
	'NO_PADDING'			=> 'Dolgu yok',
	'LABEL'					=> 'Etiket',
	'BADGE'					=> 'Rozet',
	'PRIMARY_COLOR'			=> 'Birincil renk',
	'SECONDARY_COLOR'		=> 'İkincil renk',
	'GRAYSCALE_COLOR'		=> 'Gri tonlama',
	'INFO_COLOR'			=> 'Bilgi',
	'SUCCESS_COLOR'			=> 'Başarılı',
	'WARNING_COLOR'			=> 'Uyarı',
	'DANGER_COLOR'			=> 'Tehlike',
));
