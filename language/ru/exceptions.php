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
	'EXCEPTION_FIELD_MISSING'		=> 'Отсутствует обязательное поле',
	'EXCEPTION_INVALID_ACTION'		=> 'Действие не существует',
	'EXCEPTION_INVALID_ARGUMENT'	=> 'Указан неверный аргумент для `%1$s`. Причина: %2$s',
	'EXCEPTION_INVALID_DATA_TYPE'	=> 'Предоставленное значение имеет неожиданный тип данных',
	'EXCEPTION_INVALID_ENTITY'		=> 'Предоставленная сущность является неожиданным классом сущности',
	'EXCEPTION_INVALID_PROPERTY'	=> 'Запрошенное свойство не существует',
	'EXCEPTION_OUT_OF_BOUNDS'		=> 'Запрошенный `%1$sне существует',
	'EXCEPTION_SERVICE_NOT_FOUND'	=> 'Запрошенная служба не найдена',
	'EXCEPTION_UNEXPECTED_VALUE'	=> 'Запрашиваемое действие `%1$s` не может быть выполнено. Причина: %2$s',
));
