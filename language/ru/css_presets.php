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
	'LIST_ARROW'			=> 'Маркер списка стрел',
	'LIST_CIRCLE'			=> 'Маркер круглого списка',
	'LIST_DISC'				=> 'Маркер списка пуль',
	'LIST_SQUARE'			=> 'Маркер списков',
	'LIST_NUMBERED'			=> 'Нумерованный список',
	'LIST_NUMBERED_ALPHABET' => 'Numbered with alphabet',
	'LIST_NUMBERED_NESTED'	=> 'Numbered with subsections',
	'LIST_NUMBERED_ROMAN'	=> 'Numbered with Roman numerals',
	'LIST_NUMBERED_ZERO'	=> 'Numbered with leading zero',
	'LIST_INLINE'			=> 'Внутренний список',
	'LIST_INLINE_SEP'		=> 'Список разделенных запятыми',
	'LIST_REVERSE'			=> 'Reverse order',
	'LIST_STRIPED'			=> 'Полосатый список',
	'LIST_STACKED'			=> 'Сложный список',
	'LIST_TRIANGLE'			=> 'Triangle',
	'LIST_HYPHEN'			=> 'Hyphen',
	'LIST_PLUS'				=> 'Plus',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'Club',
	'LIST_DIAMOND'			=> 'Diamond',
	'LIST_HEART'			=> 'Heart',
	'LIST_STAR'				=> 'Star',
	'LIST_CHECK'			=> 'Check',
	'LIST_SNOWFLAKE'		=> 'Snowflake',
	'LIST_MUSIC'			=> 'Music',
	'LIST_AUTOWIDTH'		=> 'Авто ширина',
	'LIST_FIT_CONTENT'		=> 'Подогнать содержимое',
	'LIST_2COLS'			=> '2 column list',
	'LIST_3COLS'			=> '3 columns list',
	'LIST_4COLS'			=> '4 columns list',
	'LIST_5COLS'			=> '5 columns list',
	'LIST_X_DIVIDER_DOTTED'	=> 'Горизонтальный разделитель',
	'LIST_X_DIVIDER_LINE'	=> 'Разделитель по горизонтали',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Разделитель точек по вертикали',
	'LIST_Y_DIVIDER_LINE'	=> 'Разделитель по вертикали',

	'IMAGE_SMALL'			=> 'Маленькое изображение',
	'IMAGE_MEDIUM'			=> 'Среднее изображение',
	'IMAGE_LARGE'			=> 'Большая картинка',
	'IMAGE_FULL_WIDTH'		=> 'Полная ширина изображения',
	'IMAGE_ALIGN_LEFT'		=> 'Плавающее изображение влево',
	'IMAGE_ALIGN_RIGHT'		=> 'Плавающее изображение вправо',
	'IMAGE_CIRCLE'			=> 'Круговое изображение',
	'IMAGE_ROUNDED'			=> 'Скругленная картинка',
	'IMAGE_BORDER'			=> 'Изображение на границе',
	'IMAGE_BORDER_PADDING'	=> 'Отступ изображения',
	'IMAGE_RATIO_SQUARE'	=> 'Квадратное изображение',
	'IMAGE_RATIO_4_BY_3'	=> '4 by 3 image',
	'IMAGE_RATIO_16_BY_9'	=> '16 by 9 image',

	'RESPONSIVE_SHOW'		=> 'Показывать только на маленьких устройствах',
	'RESPONSIVE_HIDE'		=> 'Скрыть на маленьких устройствах',

	'ALIGN_LEFT'			=> 'Выровненный текст слева',
	'ALIGN_CENTER'			=> 'По центру текста',
	'ALIGN_RIGHT'			=> 'Текст по правому краю',
	'NO_PADDING'			=> 'Нет отступа',
	'LABEL'					=> 'Метка',
	'BADGE'					=> 'Значок',
	'PRIMARY_COLOR'			=> 'Основной цвет',
	'SECONDARY_COLOR'		=> 'Вторичный цвет',
	'GRAYSCALE_COLOR'		=> 'Оттенки серого',
	'INFO_COLOR'			=> 'Сведения',
	'SUCCESS_COLOR'			=> 'Успешно',
	'WARNING_COLOR'			=> 'Предупреждение',
	'DANGER_COLOR'			=> 'Опасность',
));
