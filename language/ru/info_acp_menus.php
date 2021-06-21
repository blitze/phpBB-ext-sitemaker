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
	'ACP_MENU'					=> 'Меню',
	'ACP_MENU_MANAGE'			=> 'Управление меню',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Здесь вы можете создавать и управлять меню для вашего сайта',
	'ADD_BULK_MENU'				=> 'Массовое добавление пунктов меню',
	'ADD_BULK_MENU_EXPLAIN'		=> 'Добавьте несколько пунктов меню сразу.<br /> - Поместите каждый элемент в отдельную строку<br /> - Используйте клавишу <strong>Tab</strong> для отображения отношений между родителями и детьми<br /> - Введите элемент и URL, как так: Home|index.php',
	'ADD_MENU'					=> 'Добавить меню',
	'ADD_MENU_ITEM'				=> 'Добавить пункт меню',
	'ADD_ITEM'					=> 'Добавить новый элемент',
	'AJAX_PROCESSING'			=> 'Работает',

	'CHANGE_ME'					=> 'Изменить меня',

	'DELETE_ITEM'				=> 'Удалить элемент',
	'DELETE_KIDS'				=> 'Удалить ветку',
	'DELETE_MENU'				=> 'Удалить меню',
	'DELETE_MENU_CONFIRM'		=> 'Вы уверены, что хотите удалить это меню?<br />Это удалит меню и все его пункты',
	'DELETE_MENU_ITEM'			=> 'Удалить элемент',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Вы уверены, что хотите удалить этот пункт меню?',
	'DELETE_SELECTED'			=> 'Удалить выбранное',

	'EDIT_ITEM'					=> 'Изменить элемент',

	'ITEM_ACTIVE'				=> 'Активный',
	'ITEM_INACTIVE'				=> 'Неактивный',
	'ITEM_PARENT'				=> 'Родитель',
	'ITEM_TITLE'				=> 'Название элемента',
	'ITEM_TITLE_EXPLAIN'		=> 'Установить как «-» для разделителя',
	'ITEM_TARGET'				=> 'Цель элемента',
	'ITEM_URL'					=> 'URL элемента',
	'ITEM_URL_EXPLAIN'			=> '- Оставьте пустым для заголовков<br />- Внешние сайты должны начинаться с http(s)://, ftp://, //, и т.д.',

	'MENU_ITEMS'				=> 'Пункты меню',

	'NO_MENU_ITEMS'				=> 'Пункты меню не были созданы',
	'NO_PARENT'					=> 'Нет родителя',

	'PROCESSING_ERROR'			=> 'Ошибка обработки',

	'REBUILD_TREE'				=> 'Восстановить дерево',
	'REQUIRED'					=> 'Требуется',
	'REQUIRED_FIELDS'			=> '* Обязательные поля',

	'SAVE_CHANGES'				=> 'Сохранить изменения',
	'SAVE'						=> 'Сохранить',
	'SELECT_ALL'				=> 'Выделить все',

	'TARGET_BLANK'				=> 'Пустая страница',
	'TARGET_PARENT'				=> 'Родитель',

	'UNSAVED_CHANGES'			=> 'У вас есть несохраненные изменения',

	'VISIT_PAGE'				=> 'Посетить страницу',
));
