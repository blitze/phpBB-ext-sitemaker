<?php

/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
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

$lang = array_merge($lang, array(
	'ACTIVE_ELEMENT'			=> 'Elemento activo',
	'BORDER'					=> 'Border',
	'BORDER_COLOR'				=> 'Color del borde',
	'BORDER_RADIUS'				=> 'Radio de borde',
	'BORDER_WIDTH'				=> 'Border Width',
	'BOTTOM'					=> 'Abajo',
	'BOTTOM_LEFT'				=> 'Botín izquierdo',
	'BOTTOM_RIGHT'				=> 'Abajo Derecha',
	'CAPITALIZE'				=> 'Capitalizar',
	'COLOR'						=> 'Color',
	'DIVIDERS'					=> 'Dividentes',
	'END'						=> 'Fin',
	'GRADIENT'					=> 'Gradiente',
	'HEADERS'					=> 'Encabezados',
	'HOVER'						=> 'Hover',
	'LEFT'						=> 'Queda',
	'LOWERCASE'					=> 'Minúsculas',
	'MARGIN'					=> 'Margen',
	'NAVBAR'					=> 'Navarra',
	'NAVBAR_MENU'				=> 'Navbar menu',
	'NAVBAR_DROPDOWN'			=> 'Soltar',
	'NAVBAR_LOCATION'			=> 'Ubicación',
	'NAVBAR_LOCATION_OPTION'	=> 'Ubicación #%s',
	'NAVBAR_TOP_MENU'			=> 'Menú superior',
	'NONE'						=> 'Ninguna',
	'PADDING'					=> 'Padding',
	'RESPONSIVE_TOGGLE'			=> 'Alternar con respuesta',
	'RESPONSIVE_TOGGLE_EXPLAIN'	=> 'Sólo se puede ver en pantallas pequeñas (móviles)',
	'RIGHT'						=> 'Derecha',
	'SAVE'						=> 'Guardar',
	'SIZE'						=> 'Tamaño',
	'START'						=> 'Comenzar',
	'TEXT'						=> 'Texto',
	'TOP'						=> 'Subir',
	'TOP_LEFT'					=> 'Arriba izquierda',
	'TOP_RIGHT'					=> 'Arriba Derecha',
	'TRANSFORM'					=> 'Transformar',
	'UPPERCASE'					=> 'Mayúsculas',
));
