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
	'ICON_ACCESSIBILITY'	=> 'Доступность',
	'ICON_BRAND'			=> 'Бренд',
	'ICON_CHART'			=> 'Диаграмма',
	'ICON_COLOR'			=> 'Цвет',
	'ICON_COLOR_DEFAULT'	=> 'Цвет по умолчанию',
	'ICON_CURRENCY'			=> 'Валюта',
	'ICON_DIRECTIONAL'		=> 'Направление',
	'ICON_FILE_TYPE'		=> 'Тип файла',
	'ICON_FLIP_HORIZONTAL'	=> 'Отразить по горизонтали',
	'ICON_FLIP_VERTICAL'	=> 'Отразить по вертикали',
	'ICON_FLOAT'			=> 'Плато',
	'ICON_FLOAT_LEFT'		=> 'Влево',
	'ICON_FLOAT_RIGHT'		=> 'Правый',
	'ICON_FONT'				=> 'Иконки шрифтов',
	'ICON_FORM_CONTROL'		=> 'Управление формами',
	'ICON_GENDER'			=> 'Гендерная проблематика',
	'ICON_HANDS'			=> 'Руки',
	'ICON_IMAGE'			=> 'Изображение',
	'ICON_INSERT_UPDATE'	=> 'Вставить/Обновить',
	'ICON_MEDICAL'			=> 'Медицинская',
	'ICON_MISC'				=> 'Разное',
	'ICON_MISC_BORDERED'	=> 'Рамка',
	'ICON_MISC_FIXED_WIDTH'	=> 'Фиксированная ширина',
	'ICON_MISC_SPINNING'	=> 'Вращение',
	'ICON_PAYMENT'			=> 'Оплата',
	'ICON_ROTATION'			=> 'Поворот',
	'ICON_ROTATION_90_DEG'	=> '90°',
	'ICON_ROTATION_180_DEG'	=> '180°',
	'ICON_ROTATION_270_DEG'	=> '270°',
	'ICON_SIZE'				=> 'Размер',
	'ICON_SIZE_DEFAULT'		=> 'По умолчанию',
	'ICON_SIZE_LARGER'		=> 'Больший',
	'ICON_SPINNER'			=> 'Паук',
	'ICON_TEXT_EDITOR'		=> 'Редактор текста',
	'ICON_TRANSPORTATION'	=> 'Транспорт',
	'ICON_VIDEO_PLAYER'		=> 'Видеоплеер',
	'ICON_WEB_APPLICATION'	=> 'Веб-приложение',

	'NO_ICON'				=> 'Нет значка',
));
