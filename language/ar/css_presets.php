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
	'LIST_ARROW'			=> 'علامة قائمة الأسهم',
	'LIST_CIRCLE'			=> 'علامة قائمة الدوائر',
	'LIST_DISC'				=> 'علامة قائمة الرصاص',
	'LIST_SQUARE'			=> 'علامة قائمة مربعة',
	'LIST_NUMBERED'			=> 'قائمة مرقمة',
	'LIST_NUMBERED_ALPHABET' => 'مرقمة بالأبجدية',
	'LIST_NUMBERED_NESTED'	=> 'مرقمة مع الأقسام الفرعية',
	'LIST_NUMBERED_ROMAN'	=> 'رقمها بالأرقام الرومانية',
	'LIST_NUMBERED_ZERO'	=> 'رقمها مع القيادة صفر',
	'LIST_INLINE'			=> 'قائمة مضمنة',
	'LIST_INLINE_SEP'		=> 'قائمة مفصولة بفاصلة',
	'LIST_REVERSE'			=> 'عكس الترتيب',
	'LIST_STRIPED'			=> 'القائمة المخططة',
	'LIST_STACKED'			=> 'قائمة مكدسة',
	'LIST_TRIANGLE'			=> 'مثلث',
	'LIST_HYPHEN'			=> 'هاتف',
	'LIST_PLUS'				=> 'زائد',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'النادي',
	'LIST_DIAMOND'			=> 'الماس',
	'LIST_HEART'			=> 'قلب',
	'LIST_STAR'				=> 'نجوم',
	'LIST_CHECK'			=> 'تحقق',
	'LIST_SNOWFLAKE'		=> 'ندفة الثلج',
	'LIST_MUSIC'			=> 'الموسيقى',
	'LIST_AUTOWIDTH'		=> 'Auto width',
	'LIST_FIT_CONTENT'		=> 'ملاءمة المحتوى',
	'LIST_2COLS'			=> 'قائمة العمود 2',
	'LIST_3COLS'			=> 'قائمة 3 أعمدة',
	'LIST_4COLS'			=> 'قائمة 4 أعمدة',
	'LIST_5COLS'			=> 'قائمة 5 أعمدة',
	'LIST_X_DIVIDER_DOTTED'	=> 'الفجوة الأفقية المقطوعة',
	'LIST_X_DIVIDER_LINE'	=> 'فاصل الخط الأفقي',
	'LIST_Y_DIVIDER_DOTTED'	=> 'الفاصل العمودي المتقطع',
	'LIST_Y_DIVIDER_LINE'	=> 'فاصل الخط العمودي',

	'IMAGE_SMALL'			=> 'صورة صغيرة',
	'IMAGE_MEDIUM'			=> 'صورة متوسطة',
	'IMAGE_LARGE'			=> 'صورة كبيرة',
	'IMAGE_FULL_WIDTH'		=> 'صورة العرض الكامل',
	'IMAGE_ALIGN_LEFT'		=> 'الصورة العائمة متبقية',
	'IMAGE_ALIGN_RIGHT'		=> 'الصورة العائمة اليمنى',
	'IMAGE_CIRCLE'			=> 'صورة دائرية',
	'IMAGE_ROUNDED'			=> 'صورة مدورة',
	'IMAGE_BORDER'			=> 'صورة مطلوبة',
	'IMAGE_BORDER_PADDING'	=> 'Image border padding',
	'IMAGE_RATIO_SQUARE'	=> 'صورة مربعة',
	'IMAGE_RATIO_4_BY_3'	=> '4 في 3 صورة',
	'IMAGE_RATIO_16_BY_9'	=> '16 في 9 صورة',

	'RESPONSIVE_SHOW'		=> 'إظهار فقط على الأجهزة الصغيرة',
	'RESPONSIVE_HIDE'		=> 'إخفاء على الأجهزة الصغيرة',

	'ALIGN_LEFT'			=> 'نص محافظ لليسار',
	'ALIGN_CENTER'			=> 'النص المحصور',
	'ALIGN_RIGHT'			=> 'النص الموائم لليمين',
	'NO_PADDING'			=> 'No padding',
	'LABEL'					=> 'تسمية',
	'BADGE'					=> 'شارة',
	'PRIMARY_COLOR'			=> 'اللون الأساسي',
	'SECONDARY_COLOR'		=> 'اللون الثانوي',
	'GRAYSCALE_COLOR'		=> 'Grayscale',
	'INFO_COLOR'			=> 'معلومات',
	'SUCCESS_COLOR'			=> 'نجاح',
	'WARNING_COLOR'			=> 'تحذير',
	'DANGER_COLOR'			=> 'خطر',
));
