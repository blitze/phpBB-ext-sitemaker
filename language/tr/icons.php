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
	'ICON_ALERT'				=> 'Uyarı',
	'ICON_ANIMALS'				=> 'Hayvanlar',
	'ICON_ARROWS'				=> 'Oklar',
	'ICON_AUDIO_VIDEO'			=> 'Ses & Video',
	'ICON_AUTOMOTIVE'			=> 'Otomotiv',
	'ICON_AUTUMN'				=> 'Sonbahar',
	'ICON_BEVERAGE'				=> 'İçecek',
	'ICON_BRANDS'				=> 'Markalar',
	'ICON_BUILDINGS'			=> 'Binalar',
	'ICON_BUSINESS'				=> 'İş',
	'ICON_CAMPING'				=> 'Kampçılık',
	'ICON_CHARITY'				=> 'Bağış',
	'ICON_CHAT'					=> 'Sohbet',
	'ICON_CHESS'				=> 'Satranç',
	'ICON_CHILDHOOD'			=> 'Çocukluk',
	'ICON_CLOTHING'				=> 'Giyim',
	'ICON_CODE'					=> 'Kod',
	'ICON_COMMUNICATION'		=> 'İletişim',
	'ICON_COMPUTERS'			=> 'Bilgisayarlar',
	'ICON_CONSTRUCTION'			=> 'Yapı',
	'ICON_CURRENCY'				=> 'Para birimi',
	'ICON_DATE_TIME'			=> 'Tarih & Zaman',
	'ICON_DESIGN'				=> 'Tasarım',
	'ICON_EDITORS'				=> 'Editörler',
	'ICON_EDUCATION'			=> 'Eğitim',
	'ICON_EMOJI'				=> 'İfade',
	'ICON_ENERGY'				=> 'Enerji',
	'ICON_FILES'				=> 'Dosyalar',
	'ICON_FINANCE'				=> 'Finans',
	'ICON_FITNESS'				=> 'Fitness',
	'ICON_FOOD'					=> 'Yiyecek',
	'ICON_FRUIT_VEGETABLE'		=> 'Meyveler & Sebzeler',
	'ICON_GAMES'				=> 'Oyunlar',
	'ICON_GAMING_TABLETOP'		=> 'Masaüstü Oyunları',
	'ICON_GENDER'				=> 'Cinsiyet',
	'ICON_HALLOWEEN'			=> 'Cadılar Bayramı',
	'ICON_HANDS'				=> 'Hands',
	'ICON_HEALTH'				=> 'Sağlık',
	'ICON_HOLIDAY'				=> 'Tatil',
	'ICON_HOTEL'				=> 'Otel',
	'ICON_HOUSEHOLD'			=> 'Ev halkı',
	'ICON_IMAGES'				=> 'Görseller',
	'ICON_INTERFACES'			=> 'Arabirimler',
	'ICON_LOGISTICS'			=> 'Lojistik',
	'ICON_MAPS'					=> 'Haritalar',
	'ICON_MARITIME'				=> 'Deniz',
	'ICON_MARKETING'			=> 'Pazarlama',
	'ICON_MATHEMATICS'			=> 'Matematik',
	'ICON_MEDICAL'				=> 'Medikal',
	'ICON_MOVING'				=> 'Taşınıyor',
	'ICON_MUSIC'				=> 'Müzik',
	'ICON_OBJECTS'				=> 'Nesneler',
	'ICON_PAYMENTS_SHOPPING'	=> 'Ödemeler & Alışveriş',
	'ICON_PHARMACY'				=> 'Eczane',
	'ICON_POLITICAL'			=> 'Siyasi',
	'ICON_RELIGION'				=> 'Din',
	'ICON_SCIENCE'				=> 'Bilim',
	'ICON_SCIENCE_FICTION'		=> 'Bilim Kurgu',
	'ICON_SECURITY'				=> 'Güvenlik',
	'ICON_SHAPES'				=> 'Shapes',
	'ICON_SHOPPING'				=> 'Shopping',
	'ICON_SOCIAL'				=> 'Social',
	'ICON_SPINNERS'				=> 'Spinners',
	'ICON_SPORTS'				=> 'Sports',
	'ICON_SPRING'				=> 'Spring',
	'ICON_STATUS'				=> 'Status',
	'ICON_SUMMER'				=> 'Summer',
	'ICON_TOGGLE'				=> 'Toggle',
	'ICON_TRAVEL'				=> 'Travel',
	'ICON_USERS_PEOPLE'			=> 'Users & People',
	'ICON_VEHICLES'				=> 'Vehicles',
	'ICON_WEATHER'				=> 'Weather',
	'ICON_WINTER'				=> 'Winter',
	'ICON_WRITING'				=> 'Writing',

	'ICON_COLOR'				=> 'Renk',
	'ICON_DEFAULT'				=> 'Default',
	'ICON_FLIP_BOTH'			=> 'Flip Both',
	'ICON_FLIP_HORIZONTAL'		=> 'Yatay Çevir',
	'ICON_FLIP_VERTICAL'		=> 'Dikey Çevir',
	'ICON_FLOAT'				=> 'Float',
	'ICON_FLOAT_LEFT'			=> 'Sol',
	'ICON_FLOAT_RIGHT'			=> 'Sağ',
	'ICON_FONT'					=> 'Yazı tipi Simgeleri',
	'ICON_INSERT_UPDATE'		=> 'Ekle/Güncelle',
	'ICON_MISC'					=> 'Çeşitli',
	'ICON_MISC_BORDERED'		=> 'Kenar',
	'ICON_MISC_FIXED_WIDTH'		=> 'Sabit genişlik',
	'ICON_MISC_PULSE'			=> 'Pulse',
	'ICON_MISC_SPINNING'		=> 'Spinning',
	'ICON_ROTATION'				=> 'Döndür',
	'ICON_ROTATE_90'			=> '90°',
	'ICON_ROTATE_180'			=> '180°',
	'ICON_ROTATE_270'			=> '270°',
	'ICON_SIZE'					=> 'Boyut',
	'ICON_SIZE_LG'				=> 'Larger',
	'ICON_SIZE_SM'				=> 'Small',
	'ICON_SIZE_XS'				=> 'Extra Small',
	'ICON_SIZE_2X'				=> '2x',
	'ICON_SIZE_3X'				=> '3x',
	'ICON_SIZE_4X'				=> '4x',
	'ICON_SIZE_5X'				=> '5x',
	'ICON_SIZE_6X'				=> '6x',
	'ICON_SIZE_7X'				=> '7x',
	'ICON_SIZE_8X'				=> '8x',
	'ICON_SIZE_9X'				=> '9x',
	'ICON_SIZE_10X'				=> '10x',

	'NO_ICON'					=> 'Simge Yok',
));
