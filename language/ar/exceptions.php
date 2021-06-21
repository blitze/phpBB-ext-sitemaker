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

$lang = array_merge($lang, array(
	'EXCEPTION_FIELD_MISSING'		=> 'الحقل المطلوب مفقود',
	'EXCEPTION_INVALID_ACTION'		=> 'الإجراء غير موجود',
	'EXCEPTION_INVALID_ARGUMENT'	=> 'حجة غير صحيحة لـ \'%1$s`. السبب: %2$s',
	'EXCEPTION_INVALID_DATA_TYPE'	=> 'القيمة المقدمة هي نوع غير متوقع من البيانات',
	'EXCEPTION_INVALID_ENTITY'		=> 'الكيان المقدم هو من فئة كيان غير متوقعة',
	'EXCEPTION_INVALID_PROPERTY'	=> 'الممتلكات المطلوبة غير موجودة',
	'EXCEPTION_OUT_OF_BOUNDS'		=> 'المطلوب \'%1$s` غير موجود',
	'EXCEPTION_SERVICE_NOT_FOUND'	=> 'لم يتم العثور على الخدمة المطلوبة',
	'EXCEPTION_UNEXPECTED_VALUE'	=> 'لا يمكن تنفيذ الإجراء المطلوب \'%1$s`. السبب: %2$s',
));
