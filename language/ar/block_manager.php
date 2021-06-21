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
	'ADD_BLOCK_EXPLAIN'							=> '* سحب وإفلات المربعات البرمجية',
	'AJAX_ERROR'								=> 'عفوا! حدث خطأ أثناء معالجة طلبك. الرجاء المحاولة مرة أخرى.',
	'AJAX_LOADING'								=> 'تحميل...',
	'AJAX_PROCESSING'							=> 'يعمل...',

	'BACKGROUND'								=> 'الخلفية',
	'BLOCKS'									=> 'كتل',
	'BLOCKS_COPY_FROM'							=> 'نسخ الكتل البرمجية',
	'BLOCK_ACTIVE'								=> 'نشط',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'إظهار على الطرق الفرعية فقط',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'إخفاء على طرق الأطفال',
	'BLOCK_CLASS'								=> 'فئة CSS',
	'BLOCK_CLASS_EXPLAIN'						=> 'تعديل مظهر الكتلة مع فئات CSS',
	'BLOCK_DESIGN'								=> 'المظهر',
	'BLOCK_DISPLAY_TYPE'						=> 'عرض',
	'BLOCK_HIDE_TITLE'							=> 'إخفاء عنوان الكتلة؟',
	'BLOCK_INACTIVE'							=> 'غير نشط',
	'BLOCK_MISSING_TEMPLATE'					=> 'قالب كتلة مفقود. الرجاء الاتصال بالمطور',
	'BLOCK_NOT_FOUND'							=> 'عفوا! لم يتم العثور على خدمة الكتلة المطلوبة',
	'BLOCK_NO_DATA'								=> 'لا توجد بيانات لعرضها',
	'BLOCK_NO_ID'								=> 'عفوا! معرف الكتلة مفقود',
	'BLOCK_PERMISSION'							=> 'الصلاحية',
	'BLOCK_PERMISSION_ALLOW'					=> 'إظهار إلى',
	'BLOCK_PERMISSION_DENY'						=> 'إخفاء من',
	'BLOCK_PERMISSION_EXPLAIN'					=> 'استخدام CTRL + انقر لتبديل التحديد',
	'BLOCK_SHOW_ALWAYS'							=> 'دائما',
	'BLOCK_STATUS'								=> 'الحالة',
	'BLOCK_UPDATED'								=> 'تم تحديث إعدادات الحظر بنجاح',

	'CANCEL'									=> 'إلغاء',
	'CHILD_ROUTE'								=> 'طفل',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/my-مقالة',
	'CLEAR'										=> 'مسح',
	'COPY'										=> 'نسخ',
	'COPY_BLOCKS'								=> 'نسخ الكتلة؟',
	'COPY_BLOCKS_CONFIRM'						=> 'هل أنت متأكد من أنك ترغب في نسخ الكتل من صفحة أخرى؟<br /><br />سيؤدي هذا إلى حذف جميع الكتل الموجودة وإعدادات هذه الصفحة واستبدالها بالكتل من الصفحة المحددة.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'إذا تم تعيينه، فإن جميع صفحات الموقع التي لم يتم تحديد كتل لها سوف ترث الكتل من التخطيط الافتراضي. ومع ذلك، قد تتخطى التخطيط الافتراضي لصفحات معينة باستخدام الخيارات إلى اليمين.',
	'DELETE'									=> 'حذف',
	'DELETE_ALL_BLOCKS'							=> 'حذف جميع الكتل',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'هل أنت متأكد من أنك ترغب في حذف جميع الكتل البرمجية لهذه الصفحة؟',
	'DELETE_BLOCK'								=> 'حذف الكتلة',
	'DELETE_BLOCK_CONFIRM'						=> 'هل أنت متأكد من أنك تريد حذف هذه الكتلة؟<br /><br /><br /><strong>ملاحظة</strong> يجب عليك حفظ تغييرات التخطيط لجعل هذا دائم.',

	'EDIT'										=> 'تحرير',
	'EDIT_BLOCK'								=> 'تحرير الكتلة',
	'EXIT_EDIT_MODE'							=> 'الخروج من وضع التحرير',

	'FEED_PROBLEMS'								=> 'حدثت مشكلة في معالجة تغذية rss/الذرة المقدمة',
	'FEED_URL_MISSING'							=> 'الرجاء تقديم تغذية واحدة على الأقل / ذرة للبدء',
	'FIELD_INVALID'								=> 'القيمة المقدمة للميدان "%s" صيغة غير صحيحة',
	'FIELD_REQUIRED'							=> '"%s" حقل مطلوب',
	'FIELD_TOO_LONG'							=> 'القيمة المقدمة للحقل "%1$s" طويلة جداً. القيمة القصوى المقبولة هي %2$d.',
	'FIELD_TOO_SHORT'							=> 'القيمة المقدمة للحقل "%1$s" قصيرة جداً. الحد الأدنى من القيمة المقبولة هو %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'لا تظهر الكتل في هذه الصفحة',
	'HIDE_BLOCK_POSITIONS'						=> 'لا تظهر الكتل البرمجية لمواقع الكتلة التالية:',

	'IMAGES'									=> 'الصور',

	'LAYOUT'									=> 'تخطيط',
	'LAYOUT_SAVED'								=> 'تم حفظ التخطيط بنجاح!',
	'LAYOUT_SETTINGS'							=> 'إعدادات التخطيط',
	'LEAVE_CONFIRM'								=> 'لديك بعض التغييرات غير المحفوظة لهذه الصفحة. الرجاء حفظ عملك قبل الانتقال إلى الصفحة',
	'LISTS'										=> 'القوائم',

	'MAKE_DEFAULT_LAYOUT'						=> 'تعيين كتخطيط افتراضي',

	'OR'										=> '<strong>أو</strong>',

	'PARENT_ROUTE'								=> 'الأصل',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/articles',
	'PREDEFINED_CLASSES'						=> 'فصول محددة مسبقاً',

	'REDO'										=> 'إعادة',
	'REMOVE_DEFAULT_LAYOUT'						=> 'إزالة كتخطيط افتراضي',
	'REMOVE_STARTPAGE'							=> 'إزالة صفحة البداية',
	'ROUTE_HIDDEN_BLOCKS'						=> 'يتم إخفاء الكتل لهذه الصفحة',
	'ROUTE_HIDDEN_POSITIONS'					=> 'يتم إخفاء الكتل في المواقع التالية',
	'ROUTE_UPDATED'								=> 'تم تحديث إعدادات الصفحة بنجاح',

	'SAVE_CHANGES'								=> 'حفظ التغييرات',
	'SAVE_SETTINGS'								=> 'حفظ الإعدادات',
	'SELECT_ICON'								=> 'حدد أيقونة',
	'SETTINGS'									=> 'الإعدادات',
	'SETTING_TOO_BIG'							=> 'القيمة المقدمة للإعداد "%1$s" مرتفعة جداً. القيمة القصوى المقبولة هي %2$d.',
	'SETTING_TOO_LONG'							=> 'القيمة المقدمة للإعداد "%1$s" طويلة جداً. الحد الأقصى للطول المقبول هو %2$d.',
	'SETTING_TOO_LOW'							=> 'القيمة المقدمة للإعداد "%1$s" منخفضة جداً. الحد الأدنى من القيمة المقبولة هو %2$d.',
	'SETTING_TOO_SHORT'							=> 'القيمة المقدمة للإعداد "%1$s" قصيرة جداً. الحد الأدنى للطول المقبول هو %2$d.',
	'SET_STARTPAGE'								=> 'تعيين كصفحة بدء',

	'TITLES'									=> 'العناوين',

	'UPDATE_SIMILAR'							=> 'تحديث الكتل البرمجية مع إعدادات مماثلة',
	'UNDO'										=> 'التراجع',

	'VIEW_DEFAULT_LAYOUT'						=> 'عرض/تعديل التخطيط الافتراضي',
	'VISIT_PAGE'								=> 'زيارة الصفحة',
));
