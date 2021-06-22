<?php

/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2012 Daniel A. (blitze)
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

$lang = array_merge($lang, array(
	'ICON_ACCESSIBILITY'		=> 'Доступность',
	'ICON_ARROWS'				=> 'Стрелки',
	'ICON_BRAND'				=> 'Бренд',
	'ICON_CHART'				=> 'Диаграмма',
	'ICON_CURRENCY'				=> 'Валюта',
	'ICON_DIRECTIONAL'			=> 'Направленный',
	'ICON_FILE_TYPE'			=> 'Тип файла',
	'ICON_FORM_CONTROL'			=> 'Форма управления',
	'ICON_GENDER'				=> 'Гендерная проблематика',
	'ICON_HAND'					=> 'Рука',
	'ICON_MEDICAL'				=> 'Медицинский',
	'ICON_PAYMENT'				=> 'Оплата',
	'ICON_SPINNER'				=> 'Спинер',
	'ICON_TEXT_EDITOR'			=> 'Текстовый редактор',
	'ICON_TRANSPORTATION'		=> 'Транспорт',
	'ICON_VIDEO_PLAYER'			=> 'Видео плеер',
	'ICON_WEB_APPLICATION'		=> 'Веб-приложение',

	'ICON_COLOR'				=> 'Цвет',
	'ICON_DEFAULT'				=> 'По умолчанию',
	'ICON_FLIP_BOTH'			=> 'Отразить оба',
	'ICON_FLIP_HORIZONTAL'		=> 'Отразить по горизонтали',
	'ICON_FLIP_VERTICAL'		=> 'Отразить вертикально',
	'ICON_FLOAT'				=> 'Плавающий',
	'ICON_FLOAT_LEFT'			=> 'Слева',
	'ICON_FLOAT_RIGHT'			=> 'Справа',
	'ICON_FONT'					=> 'Font Icons',
	'ICON_INSERT_UPDATE'		=> 'Insert/Update',
	'ICON_MISC'					=> 'Прочие',
	'ICON_MISC_BORDERED'		=> 'Граница',
	'ICON_MISC_FIXED_WIDTH'		=> 'Фиксированная ширина',
	'ICON_MISC_PULSE'			=> 'Пульс',
	'ICON_MISC_SPINNING'		=> 'Прокрутка',
	'ICON_ROTATION'				=> 'Поворот',
	'ICON_ROTATE_90'			=> '90°',
	'ICON_ROTATE_180'			=> '180°',
	'ICON_ROTATE_270'			=> '270°',
	'ICON_SIZE'					=> 'Размер',
	'ICON_SIZE_LG'				=> 'Большие',
	'ICON_SIZE_SM'				=> 'Маленький',
	'ICON_SIZE_2X'				=> '2x',
	'ICON_SIZE_3X'				=> '3х',
	'ICON_SIZE_4X'				=> '4x',
	'ICON_SIZE_5X'				=> '5x',

	'NO_ICON'					=> 'Без значка',
));
