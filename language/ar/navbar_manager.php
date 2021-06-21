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
	'ACTIVE_ELEMENT'			=> 'العنصر النشط',
	'BORDER'					=> 'Border',
	'BORDER_COLOR'				=> 'لون الحدود',
	'BORDER_RADIUS'				=> 'نصف قطر الحدود',
	'BORDER_WIDTH'				=> 'Border Width',
	'BOTTOM'					=> 'أسفل',
	'BOTTOM_LEFT'				=> 'أسفل اليسار',
	'BOTTOM_RIGHT'				=> 'أسفل اليمين',
	'CAPITALIZE'				=> 'رسملة',
	'COLOR'						=> 'اللون',
	'DIVIDERS'					=> 'الأرباح',
	'END'						=> 'نهاية',
	'GRADIENT'					=> 'متدرج',
	'HEADERS'					=> 'الترويسات',
	'HOVER'						=> 'Hover',
	'LEFT'						=> 'اليسار',
	'LOWERCASE'					=> 'أقل حروف',
	'MARGIN'					=> 'هامش',
	'NAVBAR'					=> 'شريط التنقل',
	'NAVBAR_MENU'				=> 'Navbar menu',
	'NAVBAR_DROPDOWN'			=> 'منسدلة',
	'NAVBAR_LOCATION'			=> 'الموقع',
	'NAVBAR_LOCATION_OPTION'	=> 'الموقع #%s',
	'NAVBAR_TOP_MENU'			=> 'القائمة العليا',
	'NONE'						=> 'لا',
	'PADDING'					=> 'Padding',
	'RESPONSIVE_TOGGLE'			=> 'تبديل الاستجابة',
	'RESPONSIVE_TOGGLE_EXPLAIN'	=> 'قابل للعرض فقط على الشاشات الصغيرة (الجوال)',
	'RIGHT'						=> 'يمين',
	'SAVE'						=> 'حفظ',
	'SIZE'						=> 'الحجم',
	'START'						=> 'ابدأ',
	'TEXT'						=> 'نص',
	'TOP'						=> 'أعلى',
	'TOP_LEFT'					=> 'أعلى اليسار',
	'TOP_RIGHT'					=> 'أعلى اليمين',
	'TRANSFORM'					=> 'تحويل',
	'UPPERCASE'					=> 'الحروف',
));
