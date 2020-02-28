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
	'ICON_ACCESSIBILITY'	=> 'Toegankelijk',
	'ICON_BRAND'			=> 'Merk',
	'ICON_CHART'			=> 'Grafiek',
	'ICON_COLOR'			=> 'Kleur',
	'ICON_COLOR_DEFAULT'	=> 'Standaardkleur',
	'ICON_CURRENCY'			=> 'Valuta',
	'ICON_DIRECTIONAL'		=> 'Richting',
	'ICON_FILE_TYPE'		=> 'Bestandstype',
	'ICON_FLIP_HORIZONTAL'	=> 'Horizontaal spiegelen',
	'ICON_FLIP_VERTICAL'	=> 'Verticaal spiegelen',
	'ICON_FLOAT'			=> 'Zwevend',
	'ICON_FLOAT_LEFT'		=> 'Links',
	'ICON_FLOAT_RIGHT'		=> 'Rechts',
	'ICON_FONT'				=> 'Lettertypepictogrammen',
	'ICON_FORM_CONTROL'		=> 'Formuliercontrole',
	'ICON_GENDER'			=> 'Geslacht',
	'ICON_HANDS'			=> 'Handen',
	'ICON_IMAGE'			=> 'Afbeelding',
	'ICON_INSERT_UPDATE'	=> 'Invoegen/bijwerken',
	'ICON_MEDICAL'			=> 'Medisch',
	'ICON_MISC'				=> 'Divers',
	'ICON_MISC_BORDERED'	=> 'Geordend',
	'ICON_MISC_FIXED_WIDTH'	=> 'Vaste breedte',
	'ICON_MISC_SPINNING'	=> 'Spinning',
	'ICON_PAYMENT'			=> 'Betaling',
	'ICON_ROTATION'			=> 'Rotatie',
	'ICON_ROTATION_90_DEG'	=> '90°',
	'ICON_ROTATION_180_DEG'	=> '180°',
	'ICON_ROTATION_270_DEG'	=> '270°',
	'ICON_SIZE'				=> 'Grootte',
	'ICON_SIZE_DEFAULT'		=> 'Standaard',
	'ICON_SIZE_LARGER'		=> 'Groter',
	'ICON_SPINNER'			=> 'Spinner',
	'ICON_TEXT_EDITOR'		=> 'Tekst Editor',
	'ICON_TRANSPORTATION'	=> 'Vervoer',
	'ICON_VIDEO_PLAYER'		=> 'Videospeler',
	'ICON_WEB_APPLICATION'	=> 'Webtoepassing',

	'NO_ICON'				=> 'Geen icoon',
));
