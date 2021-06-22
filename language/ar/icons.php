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
	'ICON_ACCESSIBILITY'		=> 'إمكانية الوصول',
	'ICON_ARROWS'				=> 'الأسهم',
	'ICON_BRAND'				=> 'العلامة',
	'ICON_CHART'				=> 'مخطط',
	'ICON_CURRENCY'				=> 'العملة',
	'ICON_DIRECTIONAL'			=> 'اتجاه',
	'ICON_FILE_TYPE'			=> 'نوع الملف',
	'ICON_FORM_CONTROL'			=> 'التحكم بالاستمارة',
	'ICON_GENDER'				=> 'نوع الجنس',
	'ICON_HAND'					=> 'اليد',
	'ICON_MEDICAL'				=> 'طبي',
	'ICON_PAYMENT'				=> 'الدفع',
	'ICON_SPINNER'				=> 'دباعي',
	'ICON_TEXT_EDITOR'			=> 'محرر النص',
	'ICON_TRANSPORTATION'		=> 'النقل',
	'ICON_VIDEO_PLAYER'			=> 'مشغل الفيديو',
	'ICON_WEB_APPLICATION'		=> 'تطبيق الويب',

	'ICON_COLOR'				=> 'اللون',
	'ICON_DEFAULT'				=> 'الافتراضي',
	'ICON_FLIP_BOTH'			=> 'قلب كليهما',
	'ICON_FLIP_HORIZONTAL'		=> 'قلب أفقي',
	'ICON_FLIP_VERTICAL'		=> 'قلب عمودي',
	'ICON_FLOAT'				=> 'عائم',
	'ICON_FLOAT_LEFT'			=> 'اليسار',
	'ICON_FLOAT_RIGHT'			=> 'يمين',
	'ICON_FONT'					=> 'Font Icons',
	'ICON_INSERT_UPDATE'		=> 'Insert/Update',
	'ICON_MISC'					=> 'متفرقة',
	'ICON_MISC_BORDERED'		=> 'ممنوع',
	'ICON_MISC_FIXED_WIDTH'		=> 'عرض ثابت',
	'ICON_MISC_PULSE'			=> 'نبض',
	'ICON_MISC_SPINNING'		=> 'الدوران',
	'ICON_ROTATION'				=> 'دوران',
	'ICON_ROTATE_90'			=> '90°',
	'ICON_ROTATE_180'			=> '180°',
	'ICON_ROTATE_270'			=> '270°',
	'ICON_SIZE'					=> 'الحجم',
	'ICON_SIZE_LG'				=> 'أكبر',
	'ICON_SIZE_SM'				=> 'صغير',
	'ICON_SIZE_2X'				=> '2x',
	'ICON_SIZE_3X'				=> '3x',
	'ICON_SIZE_4X'				=> '4x',
	'ICON_SIZE_5X'				=> '5x',

	'NO_ICON'					=> 'لا أيقونة',
));
