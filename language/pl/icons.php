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
	'ICON_ACCESSIBILITY'		=> 'Dostępność',
	'ICON_ARROWS'				=> 'Strzały',
	'ICON_BRAND'				=> 'Marka',
	'ICON_CHART'				=> 'Wykres',
	'ICON_CURRENCY'				=> 'Waluta',
	'ICON_DIRECTIONAL'			=> 'Kierunek',
	'ICON_FILE_TYPE'			=> 'Typ pliku',
	'ICON_FORM_CONTROL'			=> 'Kontrola formularza',
	'ICON_GENDER'				=> 'Płeć',
	'ICON_HAND'					=> 'Dłoń',
	'ICON_MEDICAL'				=> 'Medyczny',
	'ICON_PAYMENT'				=> 'Płatność',
	'ICON_SPINNER'				=> 'Spinner',
	'ICON_TEXT_EDITOR'			=> 'Edytor tekstu',
	'ICON_TRANSPORTATION'		=> 'Transport',
	'ICON_VIDEO_PLAYER'			=> 'Odtwarzacz wideo',
	'ICON_WEB_APPLICATION'		=> 'Aplikacja internetowa',

	'ICON_COLOR'				=> 'Kolor',
	'ICON_DEFAULT'				=> 'Domyślny',
	'ICON_FLIP_BOTH'			=> 'Odwróć oba',
	'ICON_FLIP_HORIZONTAL'		=> 'Odwróć w poziomie',
	'ICON_FLIP_VERTICAL'		=> 'Odwróć w pionie',
	'ICON_FLOAT'				=> 'Pływające',
	'ICON_FLOAT_LEFT'			=> 'Lewy',
	'ICON_FLOAT_RIGHT'			=> 'Prawy',
	'ICON_FONT'					=> 'Ikony czcionek',
	'ICON_INSERT_UPDATE'		=> 'Wstaw/aktualizacja',
	'ICON_MISC'					=> 'Różne',
	'ICON_MISC_BORDERED'		=> 'Pożyczki',
	'ICON_MISC_FIXED_WIDTH'		=> 'Stała szerokość',
	'ICON_MISC_PULSE'			=> 'Puls',
	'ICON_MISC_SPINNING'		=> 'Przycinanie',
	'ICON_ROTATION'				=> 'Obrót',
	'ICON_ROTATE_90'			=> '90°',
	'ICON_ROTATE_180'			=> '180°',
	'ICON_ROTATE_270'			=> '270°',
	'ICON_SIZE'					=> 'Rozmiar',
	'ICON_SIZE_LG'				=> 'Większy',
	'ICON_SIZE_SM'				=> 'Mały',
	'ICON_SIZE_2X'				=> '2 x',
	'ICON_SIZE_3X'				=> '3x',
	'ICON_SIZE_4X'				=> '4 x',
	'ICON_SIZE_5X'				=> '5 x',

	'NO_ICON'					=> 'Brak ikony',
));
