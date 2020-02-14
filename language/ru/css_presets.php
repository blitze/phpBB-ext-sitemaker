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
//
$lang = array_merge($lang, array(
	'LIST_FLAT'				=> 'Плоский список',
	'LIST_ARROW'			=> 'Список со стрелкой',
	'LIST_CIRCLE'			=> 'Маркер с точкам',
	'LIST_DISC'				=> 'Метка списка маркеров',
	'LIST_SQUARE'			=> 'Список с квадратными скобками',
	'LIST_NUMBERED'			=> 'Нумерованный список',
	'LIST_INLINE'			=> 'Список в строку',
	'LIST_INLINE_SEP'		=> 'Список через запятую',
	'LIST_HOVER'			=> 'Выделенный при наведении',
	'LIST_STRIPED'			=> 'Полосатый список',
	'LIST_STACKED'			=> 'Сложенный список',
	'LIST_AUTOWIDTH'		=> 'Авто ширина',
	'LIST_FIT_CONTENT'		=> 'Подогнать содержимое',
	'LIST_2COLS'			=> 'Список 2-х столбцов',
	'LIST_3COLS'			=> 'Список 3-х столбцов',
	'LIST_4COLS'			=> 'Список 4-х столбцов',
	'LIST_5COLS'			=> 'Список 5-и столбцов',
	'LIST_X_DIVIDER_DOTTED'	=> 'Горизонтальный точечный разделитель',
	'LIST_X_DIVIDER_LINE'	=> 'Горизонтальный разделитель линией',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Вертикальный пунктирный разделитель',
	'LIST_Y_DIVIDER_LINE'	=> 'Вертикальный разделитель линией',

	'IMAGE_SMALL'			=> 'Маленькое изображение',
	'IMAGE_MEDIUM'			=> 'Среднее изображение',
	'IMAGE_LARGE'			=> 'Большое изображение',
	'IMAGE_FULL_WIDTH'		=> 'Изображение с полной шириной',
	'IMAGE_ALIGN_LEFT'		=> 'Выравнивание изображение слева',
	'IMAGE_ALIGN_RIGHT'		=> 'Выравнивание изображения справа',
	'IMAGE_CIRCLE'			=> 'Круглое изображение',
	'IMAGE_ROUNDED'			=> 'Округленное изображение',
	'IMAGE_BORDER'			=> 'Обрамленное изображение',
	'IMAGE_BORDER_PADDING'	=> 'Обрамленное изображение с отступом',
	'IMAGE_RATIO_SQUARE'	=> 'Квадратное изображение',
	'IMAGE_RATIO_4_BY_3'	=> 'Изображение 4 на 3',
	'IMAGE_RATIO_16_BY_9'	=> 'Изображение 16 на 9',

	'RESPONSIVE_SHOW'		=> 'Показывать только на устройствах с небольшим экраном',
	'RESPONSIVE_HIDE'		=> 'Скрыть устройствах с небольшим экраном',

	'ALIGN_LEFT'			=> 'Текст по левому краю ',
	'ALIGN_CENTER'			=> 'Текст по центру',
	'ALIGN_RIGHT'			=> 'текст по правому краю',
	'NO_PADDING'			=> 'Без отступа',
	'LABEL'					=> 'Метка',
	'BADGE'					=> 'Знак',
	'PRIMARY_COLOR'			=> 'Основной цвет',
	'SECONDARY_COLOR'		=> 'Вторичный цвет',
	'GRAYSCALE_COLOR'		=> 'Оттенки серого',
	'INFO_COLOR'			=> 'Info',
	'SUCCESS_COLOR'			=> 'Успешно',
	'WARNING_COLOR'			=> 'Внимание',
	'DANGER_COLOR'			=> 'Опасно',
));
