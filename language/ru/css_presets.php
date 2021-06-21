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
	'LIST_ARROW'			=> 'Маркер списка стрелок',
	'LIST_CIRCLE'			=> 'Маркер списка круга',
	'LIST_DISC'				=> 'Маркер пулевого списка',
	'LIST_SQUARE'			=> 'Маркер квадратного списка',
	'LIST_NUMBERED'			=> 'Нумерованный список',
	'LIST_NUMBERED_ALPHABET' => 'Нумерация с алфавитом',
	'LIST_NUMBERED_NESTED'	=> 'Нумерация с подразделами',
	'LIST_NUMBERED_ROMAN'	=> 'Нумерация с римскими цифрами',
	'LIST_NUMBERED_ZERO'	=> 'Нумерация с нулевым началом',
	'LIST_INLINE'			=> 'Встроенный список',
	'LIST_INLINE_SEP'		=> 'Список через запятую',
	'LIST_REVERSE'			=> 'Обратный порядок',
	'LIST_STRIPED'			=> 'Полосатый список',
	'LIST_STACKED'			=> 'Список со складами',
	'LIST_TRIANGLE'			=> 'Треугольник',
	'LIST_HYPHEN'			=> 'Дефис',
	'LIST_PLUS'				=> 'Плюс',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'Клуб',
	'LIST_DIAMOND'			=> 'Алмазный',
	'LIST_HEART'			=> 'Сердце',
	'LIST_STAR'				=> 'Звезда',
	'LIST_CHECK'			=> 'Проверить',
	'LIST_SNOWFLAKE'		=> 'Снежинка',
	'LIST_MUSIC'			=> 'Музыка',
	'LIST_AUTOWIDTH'		=> 'Auto width',
	'LIST_FIT_CONTENT'		=> 'Подогнать содержимое',
	'LIST_2COLS'			=> 'Список 2 столбцов',
	'LIST_3COLS'			=> 'Список 3 столбцов',
	'LIST_4COLS'			=> '4 колонки',
	'LIST_5COLS'			=> '5 колонок',
	'LIST_X_DIVIDER_DOTTED'	=> 'Горизонтальный пунктирный разделитель',
	'LIST_X_DIVIDER_LINE'	=> 'Горизонтальный разделитель',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Вертикальный пунктирный разделитель',
	'LIST_Y_DIVIDER_LINE'	=> 'Вертикальный разделитель',

	'IMAGE_SMALL'			=> 'Маленькое изображение',
	'IMAGE_MEDIUM'			=> 'Среднее изображение',
	'IMAGE_LARGE'			=> 'Большое изображение',
	'IMAGE_FULL_WIDTH'		=> 'Полная ширина изображения',
	'IMAGE_ALIGN_LEFT'		=> 'Плавающее изображение слева',
	'IMAGE_ALIGN_RIGHT'		=> 'Плавающее изображение справа',
	'IMAGE_CIRCLE'			=> 'Круговое изображение',
	'IMAGE_ROUNDED'			=> 'Округлённое изображение',
	'IMAGE_BORDER'			=> 'Образец',
	'IMAGE_BORDER_PADDING'	=> 'Image border padding',
	'IMAGE_RATIO_SQUARE'	=> 'Квадратное изображение',
	'IMAGE_RATIO_4_BY_3'	=> '4 на 3 изображения',
	'IMAGE_RATIO_16_BY_9'	=> '16 по 9 изображений',

	'RESPONSIVE_SHOW'		=> 'Показывать только на небольших устройствах',
	'RESPONSIVE_HIDE'		=> 'Скрыть на маленьких устройствах',

	'ALIGN_LEFT'			=> 'Текст по левому краю',
	'ALIGN_CENTER'			=> 'Текст по центру',
	'ALIGN_RIGHT'			=> 'Текст выровненного справа',
	'NO_PADDING'			=> 'No padding',
	'LABEL'					=> 'Метка',
	'BADGE'					=> 'Значок',
	'PRIMARY_COLOR'			=> 'Основной цвет',
	'SECONDARY_COLOR'		=> 'Дополнительный цвет',
	'GRAYSCALE_COLOR'		=> 'Grayscale',
	'INFO_COLOR'			=> 'Инфо',
	'SUCCESS_COLOR'			=> 'Успешно',
	'WARNING_COLOR'			=> 'Предупреждение',
	'DANGER_COLOR'			=> 'Опасность',
));
