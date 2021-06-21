<?php
/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
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
	'ACP_MENU'					=> 'القائمة',
	'ACP_MENU_MANAGE'			=> 'إدارة القائمة',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'هنا يمكنك إنشاء وإدارة القوائم لموقعك',
	'ADD_BULK_MENU'				=> 'إضافة مجموعة عناصر القائمة',
	'ADD_BULK_MENU_EXPLAIN'		=> 'إضافة عناصر قائمة متعددة في وقت واحد.<br /> - ضع كل عنصر على سطر منفصل<br /> - استخدم مفتاح <strong>علامة التبويب</strong> لتمثيل العلاقات بين الوالد والطفل<br /> - أدخل العنصر و عنوان URL مثل هذا: Home<unk> index.php',
	'ADD_MENU'					=> 'إضافة قائمة',
	'ADD_MENU_ITEM'				=> 'إضافة عنصر قائمة',
	'ADD_ITEM'					=> 'إضافة عنصر جديد',
	'AJAX_PROCESSING'			=> 'العمل',

	'CHANGE_ME'					=> 'غيّر لي',

	'DELETE_ITEM'				=> 'حذف العنصر',
	'DELETE_KIDS'				=> 'حذف الفرع',
	'DELETE_MENU'				=> 'حذف القائمة',
	'DELETE_MENU_CONFIRM'		=> 'هل أنت متأكد من أنك تريد حذف هذه القائمة؟<br />سيؤدي هذا إلى حذف القائمة وجميع عناصرها',
	'DELETE_MENU_ITEM'			=> 'حذف العنصر',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'هل أنت متأكد من أنك تريد حذف عنصر القائمة هذا؟',
	'DELETE_SELECTED'			=> 'حذف المحدد',

	'EDIT_ITEM'					=> 'تعديل العنصر',

	'ITEM_ACTIVE'				=> 'نشط',
	'ITEM_INACTIVE'				=> 'غير نشط',
	'ITEM_PARENT'				=> 'الأصل',
	'ITEM_TITLE'				=> 'عنوان العنصر',
	'ITEM_TITLE_EXPLAIN'		=> 'تعيين كـ "للفارق',
	'ITEM_TARGET'				=> 'Item Target',
	'ITEM_URL'					=> 'رابط العنصر',
	'ITEM_URL_EXPLAIN'			=> '- اتركه فارغاً للعناوين<br />- المواقع الخارجية يجب أن تبدأ بـ http(s)://, ftp://, //, إلخ',

	'MENU_ITEMS'				=> 'عناصر القائمة',

	'NO_MENU_ITEMS'				=> 'لم يتم إنشاء أي عناصر قائمة',
	'NO_PARENT'					=> 'لا يوجد والد',

	'PROCESSING_ERROR'			=> 'خطأ في المعالجة',

	'REBUILD_TREE'				=> 'إعادة بناء الشجرة',
	'REQUIRED'					=> 'مطلوب',
	'REQUIRED_FIELDS'			=> '* الحقول المطلوبة',

	'SAVE_CHANGES'				=> 'حفظ التغييرات',
	'SAVE'						=> 'حفظ',
	'SELECT_ALL'				=> 'حدد الكل',

	'TARGET_BLANK'				=> 'صفحة فارغة',
	'TARGET_PARENT'				=> 'الأصل',

	'UNSAVED_CHANGES'			=> 'لديك تغييرات غير محفوظة',

	'VISIT_PAGE'				=> 'زيارة الصفحة',
));
