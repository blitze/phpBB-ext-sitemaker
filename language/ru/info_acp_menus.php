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
	'ACP_MENU_MANAGE'			=> 'Управление Меню',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Здесь вы можете создавать и редактировать меню',
	'ADD_BULK_MENU'				=> 'Массовое добавление элементов меню',
	'ADD_BULK_MENU_EXPLAIN'		=> 'Добавление нескольких элементов меню.<br /> - Разместите каждый элемент на отдельной строке<br /> - Используйте клавишу табуляции (<strong>Tab</strong>) для задания иерархии <br /> - Укажите элемент и адрес URL следующим образом: Home|index.php',
	'ADD_MENU'					=> 'Добавить меню',
	'ADD_MENU_ITEM'				=> 'Добавить элемент меню',
	'ADD_ITEM'					=> 'Добавить новый элемент',
	'AJAX_PROCESSING'			=> 'Идет обработка',

	'CHANGE_ME'					=> 'Измени меня',

	'DELETE_ITEM'				=> 'Удалить элемент',
	'DELETE_KIDS'				=> 'Удалить ветку',
	'DELETE_MENU'				=> 'Удалить меню',
	'DELETE_MENU_CONFIRM'		=> 'Вы уверены, что хотите удалить это меню?<br />Это удалит меню и все его элементы',
	'DELETE_MENU_ITEM'			=> 'Удалить элемент',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Вы уверены, что хотите удалить этот элемент меню?',
	'DELETE_SELECTED'			=> 'Удалить выбранное',

	'EDIT_ITEM'					=> 'Изменить элемент',

	'ITEM_ACTIVE'				=> 'Активный',
	'ITEM_INACTIVE'				=> 'Неактивный',
	'ITEM_PARENT'				=> 'Родительский',
	'ITEM_TITLE'				=> 'Заголовок элемента',
	'ITEM_TITLE_EXPLAIN'		=> 'Установить как ’-’ для разделителя',
	'ITEM_TARGET'				=> 'Цель элемента',
	'ITEM_URL'					=> 'Ссылка URL элемента',
	'ITEM_URL_EXPLAIN'			=> '- Оставьте пустым для заголовков<br />- Внешние сайты должны начинаться с http(s)://, ftp://, ...',

	'MENU_ITEMS'				=> 'Элементы меню',

	'NO_MENU_ITEMS'				=> 'Отсутствуют созданные элементы меню',
	'NO_PARENT'					=> 'Отсутствует родительский',

	'PROCESSING_ERROR'			=> 'Ошибка обработки',

	'REBUILD_TREE'				=> 'Перестроить структуру',
	'REQUIRED'					=> 'Обязательный',
	'REQUIRED_FIELDS'			=> '* Обязательные поля',

	'SAVE_CHANGES'				=> 'Сохранить изменения',
	'SAVE'						=> 'Сохранить',
	'SELECT_ALL'				=> 'Выбрать все',

	'TARGET_BLANK'				=> 'Чистая',
	'TARGET_PARENT'				=> 'Родительский',

	'UNSAVED_CHANGES'			=> 'Остались несохраненные изменения',

	'VISIT_PAGE'				=> 'Посетить страницу',
));
