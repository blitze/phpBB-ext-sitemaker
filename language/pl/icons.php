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
	'ICON_ACCESSIBILITY'	=> 'Dostępność',
	'ICON_BRAND'			=> 'Marka',
	'ICON_CHART'			=> 'Wykres',
	'ICON_COLOR'			=> 'Kolor',
	'ICON_COLOR_DEFAULT'	=> 'Domyślny kolor',
	'ICON_CURRENCY'			=> 'Waluta',
	'ICON_DIRECTIONAL'		=> 'Kierunkowy',
	'ICON_FILE_TYPE'		=> 'Typ pliku',
	'ICON_FLIP_HORIZONTAL'	=> 'Odwróć w poziomie',
	'ICON_FLIP_VERTICAL'	=> 'Odwróć w pionie',
	'ICON_FLOAT'			=> 'Pływające',
	'ICON_FLOAT_LEFT'		=> 'Lewy',
	'ICON_FLOAT_RIGHT'		=> 'Prawy',
	'ICON_FONT'				=> 'Ikony czcionek',
	'ICON_FORM_CONTROL'		=> 'Kontrola formularza',
	'ICON_GENDER'			=> 'Płeć',
	'ICON_HANDS'			=> 'Dłonie',
	'ICON_IMAGE'			=> 'Obraz',
	'ICON_INSERT_UPDATE'	=> 'Wstaw/aktualizacja',
	'ICON_MEDICAL'			=> 'Medyczny',
	'ICON_MISC'				=> 'Różne',
	'ICON_MISC_BORDERED'	=> 'Pożyczki',
	'ICON_MISC_FIXED_WIDTH'	=> 'Stała szerokość',
	'ICON_MISC_SPINNING'	=> 'Przycinanie',
	'ICON_PAYMENT'			=> 'Płatność',
	'ICON_ROTATION'			=> 'Obrót',
	'ICON_ROTATION_90_DEG'	=> '90°',
	'ICON_ROTATION_180_DEG'	=> '180°',
	'ICON_ROTATION_270_DEG'	=> '270°',
	'ICON_SIZE'				=> 'Rozmiar',
	'ICON_SIZE_DEFAULT'		=> 'Domyślne',
	'ICON_SIZE_LARGER'		=> 'Większe',
	'ICON_SPINNER'			=> 'Spiner',
	'ICON_TEXT_EDITOR'		=> 'Edytor tekstu',
	'ICON_TRANSPORTATION'	=> 'Transport',
	'ICON_VIDEO_PLAYER'		=> 'Odtwarzacz wideo',
	'ICON_WEB_APPLICATION'	=> 'Aplikacja internetowa',

	'NO_ICON'				=> 'Brak ikony',
));
