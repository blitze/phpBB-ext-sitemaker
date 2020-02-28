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
	'ICON_ACCESSIBILITY'	=> 'Barrierefreiheit',
	'ICON_BRAND'			=> 'Marke',
	'ICON_CHART'			=> 'Diagramm',
	'ICON_COLOR'			=> 'Farbe',
	'ICON_COLOR_DEFAULT'	=> 'Standardfarbe',
	'ICON_CURRENCY'			=> 'Währung',
	'ICON_DIRECTIONAL'		=> 'Richtung',
	'ICON_FILE_TYPE'		=> 'Dateityp',
	'ICON_FLIP_HORIZONTAL'	=> 'Horizontal drehen',
	'ICON_FLIP_VERTICAL'	=> 'Vertikal umdrehen',
	'ICON_FLOAT'			=> 'Schweben',
	'ICON_FLOAT_LEFT'		=> 'Links',
	'ICON_FLOAT_RIGHT'		=> 'Rechts',
	'ICON_FONT'				=> 'Schriftsymbole',
	'ICON_FORM_CONTROL'		=> 'Formularsteuerung',
	'ICON_GENDER'			=> 'Geschlecht',
	'ICON_HANDS'			=> 'Hände',
	'ICON_IMAGE'			=> 'Bild',
	'ICON_INSERT_UPDATE'	=> 'Einfügen/Update',
	'ICON_MEDICAL'			=> 'Medizinisch',
	'ICON_MISC'				=> 'Sonstiges',
	'ICON_MISC_BORDERED'	=> 'Umrahmt',
	'ICON_MISC_FIXED_WIDTH'	=> 'Feste Breite',
	'ICON_MISC_SPINNING'	=> 'Drehen',
	'ICON_PAYMENT'			=> 'Zahlung',
	'ICON_ROTATION'			=> 'Drehung',
	'ICON_ROTATION_90_DEG'	=> '90°',
	'ICON_ROTATION_180_DEG'	=> '180°',
	'ICON_ROTATION_270_DEG'	=> '270°',
	'ICON_SIZE'				=> 'Größe',
	'ICON_SIZE_DEFAULT'		=> 'Standard',
	'ICON_SIZE_LARGER'		=> 'Größer',
	'ICON_SPINNER'			=> 'Spinner',
	'ICON_TEXT_EDITOR'		=> 'Texteditor',
	'ICON_TRANSPORTATION'	=> 'Transport',
	'ICON_VIDEO_PLAYER'		=> 'Video-Player',
	'ICON_WEB_APPLICATION'	=> 'Webanwendung',

	'NO_ICON'				=> 'Kein Icon',
));
