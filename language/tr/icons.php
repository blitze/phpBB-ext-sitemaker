<?php

/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2012 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ICON_ACCESSIBILITY'		=> 'Erişilebilirlik',
	'ICON_ARROWS'				=> 'Oklar',
	'ICON_BRAND'				=> 'Marka',
	'ICON_CHART'				=> 'Grafik',
	'ICON_CURRENCY'				=> 'Para birimi',
	'ICON_DIRECTIONAL'			=> 'Yönlü',
	'ICON_FILE_TYPE'			=> 'Dosya Türü',
	'ICON_FORM_CONTROL'			=> 'Form Denetimi',
	'ICON_GENDER'				=> 'Cinsiyet',
	'ICON_HAND'					=> 'El',
	'ICON_MEDICAL'				=> 'Medikal',
	'ICON_PAYMENT'				=> 'Ödeme',
	'ICON_SPINNER'				=> 'Çevirici',
	'ICON_TEXT_EDITOR'			=> 'Metin Düzenleyici',
	'ICON_TRANSPORTATION'		=> 'Taşıma',
	'ICON_VIDEO_PLAYER'			=> 'Video Oynatıcı',
	'ICON_WEB_APPLICATION'		=> 'Web Uygulaması',

	'ICON_COLOR'				=> 'Renk',
	'ICON_DEFAULT'				=> 'Varsayılan',
	'ICON_FLIP_BOTH'			=> 'İkisini de Çevir',
	'ICON_FLIP_HORIZONTAL'		=> 'Yatay Çevir',
	'ICON_FLIP_VERTICAL'		=> 'Dikey Çevir',
	'ICON_FLOAT'				=> 'Yüzdür',
	'ICON_FLOAT_LEFT'			=> 'Sol',
	'ICON_FLOAT_RIGHT'			=> 'Sağ',
	'ICON_FONT'					=> 'Yazı tipi Simgeleri',
	'ICON_INSERT_UPDATE'		=> 'Ekle/Güncelle',
	'ICON_MISC'					=> 'Çeşitli',
	'ICON_MISC_BORDERED'		=> 'Kenarlıklı',
	'ICON_MISC_FIXED_WIDTH'		=> 'Sabit Genişlik',
	'ICON_MISC_PULSE'			=> 'Nabız',
	'ICON_MISC_SPINNING'		=> 'Döndürme',
	'ICON_ROTATION'				=> 'Döndür',
	'ICON_ROTATE_90'			=> '90°',
	'ICON_ROTATE_180'			=> '180°',
	'ICON_ROTATE_270'			=> '270°',
	'ICON_SIZE'					=> 'Boyut',
	'ICON_SIZE_LG'				=> 'Daha Geniş',
	'ICON_SIZE_SM'				=> 'Küçük',
	'ICON_SIZE_2X'				=> '2x',
	'ICON_SIZE_3X'				=> '3x',
	'ICON_SIZE_4X'				=> '4x',
	'ICON_SIZE_5X'				=> '5x',

	'NO_ICON'					=> 'Simge Yok',
));
