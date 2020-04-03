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
	'ICON_ACCESSIBILITY'	=> 'Accesibilidad',
	'ICON_BRAND'			=> 'Marca',
	'ICON_CHART'			=> 'Gráfico',
	'ICON_COLOR'			=> 'Color',
	'ICON_COLOR_DEFAULT'	=> 'Color por defecto',
	'ICON_CURRENCY'			=> 'Moneda',
	'ICON_DIRECTIONAL'		=> 'Direccional',
	'ICON_FILE_TYPE'		=> 'Tipo de archivo',
	'ICON_FLIP_HORIZONTAL'	=> 'Invertir horizontal',
	'ICON_FLIP_VERTICAL'	=> 'Invertir vertical',
	'ICON_FLOAT'			=> 'Flotante',
	'ICON_FLOAT_LEFT'		=> 'Falta',
	'ICON_FLOAT_RIGHT'		=> 'Derecha',
	'ICON_FONT'				=> 'Iconos de fuente',
	'ICON_FORM_CONTROL'		=> 'Control de formularios',
	'ICON_GENDER'			=> 'Género',
	'ICON_HANDS'			=> 'Manos',
	'ICON_IMAGE'			=> 'Imagen',
	'ICON_INSERT_UPDATE'	=> 'Insertar/Actualizar',
	'ICON_MEDICAL'			=> 'Médico',
	'ICON_MISC'				=> 'Misc',
	'ICON_MISC_BORDERED'	=> 'Borde',
	'ICON_MISC_FIXED_WIDTH'	=> 'Ancho fijo',
	'ICON_MISC_SPINNING'	=> 'Giro',
	'ICON_PAYMENT'			=> 'Pago',
	'ICON_ROTATION'			=> 'Rotación',
	'ICON_ROTATION_90_DEG'	=> '90°',
	'ICON_ROTATION_180_DEG'	=> '180°',
	'ICON_ROTATION_270_DEG'	=> '270°',
	'ICON_SIZE'				=> 'Tamaño',
	'ICON_SIZE_DEFAULT'		=> 'Por defecto',
	'ICON_SIZE_LARGER'		=> 'Más grande',
	'ICON_SPINNER'			=> 'Spinner',
	'ICON_TEXT_EDITOR'		=> 'Editor de texto',
	'ICON_TRANSPORTATION'	=> 'Transporte',
	'ICON_VIDEO_PLAYER'		=> 'Reproductor de vídeo',
	'ICON_WEB_APPLICATION'	=> 'Aplicación web',

	'NO_ICON'				=> 'No hay icono',
));
