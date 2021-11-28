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
	'EXCEPTION_FIELD_MISSING'		=> 'Gerekli alan eksik',
	'EXCEPTION_INVALID_ACTION'		=> 'Faliyet mevcut değil',
	'EXCEPTION_INVALID_ARGUMENT'	=> '"%1$s" için geçersiz bağımsız değişken belirtildi. Neden: %2$s',
	'EXCEPTION_INVALID_DATA_TYPE'	=> 'Sağlanan değer, beklenmeyen bir veri türünde',
	'EXCEPTION_INVALID_ENTITY'		=> 'Sağlanan varlık, beklenmeyen bir varlık sınıfına ait',
	'EXCEPTION_INVALID_PROPERTY'	=> 'İstenilen özellik mevcut değil',
	'EXCEPTION_OUT_OF_BOUNDS'		=> 'İstenilen `%1$s` mevcut değil',
	'EXCEPTION_SERVICE_NOT_FOUND'	=> 'İstenilen servis mevcut değil',
	'EXCEPTION_UNEXPECTED_VALUE'	=> 'İstenen `%1$s` eylemi gerçekleştirilemedi. Neden: %2$s',
));
