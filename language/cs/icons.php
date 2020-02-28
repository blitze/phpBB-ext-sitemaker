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
	'ICON_ACCESSIBILITY'	=> 'Usnadnění',
	'ICON_BRAND'			=> 'Značka',
	'ICON_CHART'			=> 'Graf',
	'ICON_COLOR'			=> 'Barva',
	'ICON_COLOR_DEFAULT'	=> 'Výchozí barva',
	'ICON_CURRENCY'			=> 'Měna',
	'ICON_DIRECTIONAL'		=> 'Směr',
	'ICON_FILE_TYPE'		=> 'Typ souboru',
	'ICON_FLIP_HORIZONTAL'	=> 'Překlopit vodorovně',
	'ICON_FLIP_VERTICAL'	=> 'Překlopení svisle',
	'ICON_FLOAT'			=> 'Plovoucí',
	'ICON_FLOAT_LEFT'		=> 'Levý',
	'ICON_FLOAT_RIGHT'		=> 'Pravý',
	'ICON_FONT'				=> 'Ikony písma',
	'ICON_FORM_CONTROL'		=> 'Ovládání formuláře',
	'ICON_GENDER'			=> 'Pohlaví',
	'ICON_HANDS'			=> 'Ruce',
	'ICON_IMAGE'			=> 'Obrázek',
	'ICON_INSERT_UPDATE'	=> 'Vložit/Aktualizovat',
	'ICON_MEDICAL'			=> 'Lékařský',
	'ICON_MISC'				=> 'Různé',
	'ICON_MISC_BORDERED'	=> 'Hranice',
	'ICON_MISC_FIXED_WIDTH'	=> 'Pevná šířka',
	'ICON_MISC_SPINNING'	=> 'Spinování',
	'ICON_PAYMENT'			=> 'Platba',
	'ICON_ROTATION'			=> 'Otáčení',
	'ICON_ROTATION_90_DEG'	=> '90°',
	'ICON_ROTATION_180_DEG'	=> '180°',
	'ICON_ROTATION_270_DEG'	=> '270°',
	'ICON_SIZE'				=> 'Velikost',
	'ICON_SIZE_DEFAULT'		=> 'Výchozí nastavení',
	'ICON_SIZE_LARGER'		=> 'Větší',
	'ICON_SPINNER'			=> 'Spinner',
	'ICON_TEXT_EDITOR'		=> 'Textový editor',
	'ICON_TRANSPORTATION'	=> 'Doprava',
	'ICON_VIDEO_PLAYER'		=> 'Přehrávač videa',
	'ICON_WEB_APPLICATION'	=> 'Webová aplikace',

	'NO_ICON'				=> 'Žádná ikona',
));
