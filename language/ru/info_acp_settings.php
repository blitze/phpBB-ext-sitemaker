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
	'ACP_SM_SETTINGS'	=> 'Настройки',

	'BLOCKS_CLEANUP'			=> 'Очистка Блоков',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'Следующие элементы были найдены больше не существует или недоступны, поэтому вы можете удалить все связанные с ними блоки. Имейте в виду, что некоторые из них могут быть ложными',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Недопустимые блоки (например, из удаленных расширений):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Недоступные/сломанные страницы:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Удаленные стили (ids):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Блоки очищены успешно',

	'FORUM_INDEX_SETTINGS'			=> 'Настройки индекса форумов',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Эти настройки применяются только в том случае, если не задано начальной страницы',

	'HIDE'			=> 'Скрыть',
	'HIDE_BIRTHDAY'	=> 'Скрыть раздел "День рождения"',
	'HIDE_LOGIN'	=> 'Скрыть окно входа',
	'HIDE_ONLINE'	=> 'Скрыть все онлайн секции',

	'LAYOUT_BLOG'		=> 'Блог',
	'LAYOUT_CUSTOM'		=> 'Свой',
	'LAYOUT_HOLYGRAIL'	=> 'Святой Грааль',
	'LAYOUT_PORTAL'		=> 'Портал',
	'LAYOUT_PORTAL_ALT'	=> 'Портал (alt)',
	'LAYOUT_SETTINGS'	=> 'Настройки макета',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Блоки сайта удалены для отсутствующего стиля с идентификатором %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Блоки сайта удалены для сломанных страниц:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Удалены недействительные блоки сайта:<br />%s',

	'NAVIGATION_SETTINGS'		=> 'Настройки навигации',

	'SETTINGS_SAVED'			=> 'Ваши настройки были сохранены',
	'SHOW'						=> 'Показать',
	'SHOW_FORUM_NAV'			=> 'Показать «Форум» в панели навигации?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Когда страница установлена как стартовая страница вместо индекса форума, то следует отображать \'Форум\' в панели навигации',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Да - с иконкой:',
]);
