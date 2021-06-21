<?php

/**
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	$lang = [];
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

$lang = array_merge($lang, [
	'ACP_SITEMAKER'		=> 'SiteMaker',
	'ACP_SM_SETTINGS'	=> 'الإعدادات',

	'BLOCKS_CLEANUP'			=> 'تنظيف الكتل',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'تم العثور على العناصر التالية لم تعد موجودة أو لا يمكن الوصول إليها، وبالتالي يمكنك حذف جميع الكتل المرتبطة بها. يرجى ألا يغيب عن البال أن البعض منها قد يكون إيجابياً زائفاً.',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'كتل غير صالحة (على سبيل المثال من ملحقات غير مثبتة):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'الصفحات التي لا يمكن الوصول إليها/المكسورة:',
	'BLOCKS_CLEANUP_STYLES'		=> 'أنماط غير مثبتة (معرفات):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'تم إزالة الكتل بنجاح',

	'FORUM_INDEX_SETTINGS'			=> 'إعدادات فهرس المنتدى',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'تنطبق هذه الإعدادات فقط عندما لا يكون هناك صفحة بدء محددة',

	'HIDE'			=> 'إخفاء',
	'HIDE_BIRTHDAY'	=> 'إخفاء قسم يوم الميلاد',
	'HIDE_LOGIN'	=> 'إخفاء مربع تسجيل الدخول',
	'HIDE_ONLINE'	=> 'إخفاء القسم عبر الإنترنت',

	'LAYOUT_BLOG'		=> 'المدونة',
	'LAYOUT_CUSTOM'		=> 'مخصص',
	'LAYOUT_HOLYGRAIL'	=> 'منظمة الكأس المقدسة',
	'LAYOUT_PORTAL'		=> 'البوابة',
	'LAYOUT_PORTAL_ALT'	=> 'البوابة (بديل)',
	'LAYOUT_SETTINGS'	=> 'إعدادات التخطيط',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'تم حذف كتل Sitemaker للنمط المفقود مع المعرف %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'تم حذف كتل صانع الموقع للصفحات المكسورة:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'تم حذف كتل صانع المواقع غير صالحة:<br />%s',

	'NAVIGATION_SETTINGS'		=> 'إعدادات التنقل',

	'SETTINGS_SAVED'			=> 'تم حفظ الإعدادات الخاصة بك',
	'SHOW'						=> 'إظهار',
	'SHOW_FORUM_NAV'			=> 'إظهار المنتدى في شريط التنقل؟',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'عندما يتم تعيين صفحة كصفحة بدء بدلاً من فهرس المنتدى، ينبغي أن نعرض "المنتدى" في شريط التنقل',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'نعم - مع أيقونة:',
]);
