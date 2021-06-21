<?php
/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2019 Daniel A. (blitze)
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

/*
* These are errors which can be triggered by sending invalid data to the
* boardrules extension API.
*
* These errors will never show to a user unless they are either modifying
* the core boardrules extension code OR unless they are writing an extension
* which makes calls to this extension.
*
* Translators: Feel free to not translate these language strings
*/
$lang = array_merge($lang, array(
	'AUTHOR'			=> 'مؤلف',
	'AUTHORS'			=> 'المؤلفون (المصفوفة)',
	'BITRATE'			=> 'معدل البيتا',
	'CAPTIONS'			=> 'التسميات',
	'CATEGORIES'		=> 'الفئات (المصفوفة)',
	'CATEGORY'			=> 'الفئة',
	'CHANNELS'			=> 'القنوات',
	'CONTENT'			=> 'محتوى',
	'CONTRIBUTOR'		=> 'المساهم',
	'CONTRIBUTORS'		=> 'المساهمون (صفيفة)',
	'COPYRIGHT'			=> 'حقوق التأليف',
	'CREDITS'			=> 'أرصدة',
	'DATE'				=> 'تاريخ',
	'DESCRIPTION'		=> 'الوصف',
	'DURATION'			=> 'مدة',
	'ENCLOSURE'			=> 'ضميمة',
	'ENCLOSURES'		=> 'الضميمات (صفيفة)',
	'EXPRESSION'		=> 'التعبير',
	'FEED'				=> 'تغذية',
	'FRAMERATE'			=> 'إطارات',
	'GMDATE'			=> 'تاريخ GGM',
	'HANDLER'			=> 'handler',
	'HASHES'			=> 'التجزئة',
	'HEIGHT'			=> 'الارتفاع',
	'ID'				=> 'id',
	'IMAGE_HEIGHT'		=> 'ارتفاع الصورة',
	'IMAGE_LINK'		=> 'رابط الصورة',
	'IMAGE_TITLE'		=> 'عنوان الصورة',
	'IMAGE_URL'			=> 'رابط الصورة',
	'IMAGE_WIDTH'		=> 'عرض الصورة',
	'ITEMS'				=> 'العناصر',
	'JAVASCRIPT'		=> 'جافا سكريبت',
	'KEYWORDS'			=> 'الكلمات الرئيسية',
	'LABEL'				=> 'تسمية',
	'LANG'				=> 'lang',
	'LATITUDE'			=> 'خط العرض',
	'LENGTH'			=> 'طول',
	'LINK'				=> 'رابط',
	'LINKS'				=> 'الروابط',
	'LONGITUDE'			=> 'طول',
	'MEDIUM'			=> 'متوسطه',
	'NAME'				=> 'اسم',
	'PERMALINK'			=> 'رابط دائم',
	'PLAYER'			=> 'لاعب',
	'RATINGS'			=> 'تقييمات',
	'RELATIONSHIP'		=> 'علاقة',
	'RESTRICTIONS'		=> 'القيود (المصفوفة)',
	'SAMPLINGRATE'		=> 'معدل أخذ العينات',
	'SCHEME'			=> 'مخطط',
	'SOURCE'			=> 'المصدر',
	'TERM'				=> 'المصطلح',
	'THUMBNAILS'		=> 'thumbnails',
	'TITLE'				=> 'العنوان',
	'TYPE'				=> 'نوع',
	'UPDATED_DATE'		=> 'تاريخ التحديث',
	'UPDATED_GMDATE'	=> 'تحديث تاريخ الظهر',
	'VALUE'				=> 'قيمة',
	'WIDTH'				=> 'width',
));
