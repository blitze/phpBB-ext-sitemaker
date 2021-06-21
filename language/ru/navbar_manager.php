<?php

/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
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
	'ACTIVE_ELEMENT'			=> 'Активный элемент',
	'BORDER'					=> 'Border',
	'BORDER_COLOR'				=> 'Цвет рамки',
	'BORDER_RADIUS'				=> 'Радиус границы',
	'BORDER_WIDTH'				=> 'Border Width',
	'BOTTOM'					=> 'Внизу',
	'BOTTOM_LEFT'				=> 'Внизу слева',
	'BOTTOM_RIGHT'				=> 'Внизу справа',
	'CAPITALIZE'				=> 'Капитализация',
	'COLOR'						=> 'Цвет',
	'DIVIDERS'					=> 'Разделители',
	'END'						=> 'Конец',
	'GRADIENT'					=> 'Градиент',
	'HEADERS'					=> 'Заголовки',
	'HOVER'						=> 'Hover',
	'LEFT'						=> 'Слева',
	'LOWERCASE'					=> 'Строчные буквы',
	'MARGIN'					=> 'Граница',
	'NAVBAR'					=> 'Панель навигации',
	'NAVBAR_MENU'				=> 'Navbar menu',
	'NAVBAR_DROPDOWN'			=> 'Выпадающий список',
	'NAVBAR_LOCATION'			=> 'Местоположение',
	'NAVBAR_LOCATION_OPTION'	=> 'Местоположение #%s',
	'NAVBAR_TOP_MENU'			=> 'Верхнее меню',
	'NONE'						=> 'Нет',
	'PADDING'					=> 'Padding',
	'RESPONSIVE_TOGGLE'			=> 'Адаптивное переключение',
	'RESPONSIVE_TOGGLE_EXPLAIN'	=> 'Видимо только на небольших (мобильных) экранах',
	'RIGHT'						=> 'Справа',
	'SAVE'						=> 'Сохранить',
	'SIZE'						=> 'Размер',
	'START'						=> 'Начать',
	'TEXT'						=> 'Текст',
	'TOP'						=> 'Сверху',
	'TOP_LEFT'					=> 'Вверху слева',
	'TOP_RIGHT'					=> 'Верхний правый',
	'TRANSFORM'					=> 'Преобразовать',
	'UPPERCASE'					=> 'Прописные',
));
