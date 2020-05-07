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
	'ICON_ACCESSIBILITY'	=> 'Erişilebilirlik',
	'ICON_BRAND'			=> 'Marka',
	'ICON_CHART'			=> 'Çizelge',
	'ICON_COLOR'			=> 'Renk',
	'ICON_COLOR_DEFAULT'	=> 'Varsayılan Renk',
	'ICON_CURRENCY'			=> 'Para birimi',
	'ICON_DIRECTIONAL'		=> 'Directional',
	'ICON_FILE_TYPE'		=> 'Dosya Türü',
	'ICON_FLIP_HORIZONTAL'	=> 'Yatay Çevir',
	'ICON_FLIP_VERTICAL'	=> 'Dikey Çevir',
	'ICON_FLOAT'			=> 'Float',
	'ICON_FLOAT_LEFT'		=> 'Sol',
	'ICON_FLOAT_RIGHT'		=> 'Sağ',
	'ICON_FONT'				=> 'Yazı tipi Simgeleri',
	'ICON_FORM_CONTROL'		=> 'Form Denetimi',
	'ICON_GENDER'			=> 'Cinsiyet',
	'ICON_HANDS'			=> 'Hands',
	'ICON_IMAGE'			=> 'Görüntü',
	'ICON_INSERT_UPDATE'	=> 'Ekle/Güncelle',
	'ICON_MEDICAL'			=> 'Medikal',
	'ICON_MISC'				=> 'Çeşitli',
	'ICON_MISC_BORDERED'	=> 'Kenar',
	'ICON_MISC_FIXED_WIDTH'	=> 'Sabit genişlik',
	'ICON_MISC_SPINNING'	=> 'Spinning',
	'ICON_PAYMENT'			=> 'Ödeme',
	'ICON_ROTATION'			=> 'Döndür',
	'ICON_ROTATION_90_DEG'	=> '90°',
	'ICON_ROTATION_180_DEG'	=> '180°',
	'ICON_ROTATION_270_DEG'	=> '270°',
	'ICON_SIZE'				=> 'Boyut',
	'ICON_SIZE_DEFAULT'		=> 'Varsayılan',
	'ICON_SIZE_LARGER'		=> 'Daha Geniş',
	'ICON_SPINNER'			=> 'Spinner',
	'ICON_TEXT_EDITOR'		=> 'Metin Düzenleyici',
	'ICON_TRANSPORTATION'	=> 'Transportation',
	'ICON_VIDEO_PLAYER'		=> 'Video Oynatıcı',
	'ICON_WEB_APPLICATION'	=> 'Web Uygulaması',

	'NO_ICON'				=> 'Simge Yok',
));
