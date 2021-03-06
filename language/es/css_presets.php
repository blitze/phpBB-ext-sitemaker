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
	'LIST_ARROW'			=> 'Marcador de lista de flechas',
	'LIST_CIRCLE'			=> 'Marcador de lista de círculos',
	'LIST_DISC'				=> 'Marcador de lista de balas',
	'LIST_SQUARE'			=> 'Marcador de lista cuadrada',
	'LIST_NUMBERED'			=> 'Lista numerada',
	'LIST_NUMBERED_ALPHABET' => 'Numerado con alfabeto',
	'LIST_NUMBERED_NESTED'	=> 'Numerado con subsecciones',
	'LIST_NUMBERED_ROMAN'	=> 'Numerado con números romanos',
	'LIST_NUMBERED_ZERO'	=> 'Numerado con cero inicial',
	'LIST_INLINE'			=> 'Lista en línea',
	'LIST_INLINE_SEP'		=> 'Lista separada por comas',
	'LIST_REVERSE'			=> 'Orden inversa',
	'LIST_STRIPED'			=> 'Lista de rayas',
	'LIST_STACKED'			=> 'Lista apilada',
	'LIST_TRIANGLE'			=> 'Triángulo',
	'LIST_HYPHEN'			=> 'Hifeno',
	'LIST_PLUS'				=> 'Plus',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'Club',
	'LIST_DIAMOND'			=> 'Diamante',
	'LIST_HEART'			=> 'Corazón',
	'LIST_STAR'				=> 'Estrella',
	'LIST_CHECK'			=> 'Comprobar',
	'LIST_SNOWFLAKE'		=> 'Copo de nieve',
	'LIST_MUSIC'			=> 'Música',
	'LIST_AUTOWIDTH'		=> 'Auto width',
	'LIST_FIT_CONTENT'		=> 'Ajustar contenido',
	'LIST_2COLS'			=> 'Lista de 2 columnas',
	'LIST_3COLS'			=> 'Lista de 3 columnas',
	'LIST_4COLS'			=> 'Lista de 4 columnas',
	'LIST_5COLS'			=> 'Lista de 5 columnas',
	'LIST_X_DIVIDER_DOTTED'	=> 'Divisor de puntos horizontal',
	'LIST_X_DIVIDER_LINE'	=> 'Divisor de línea horizontal',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Divisor de puntos verticales',
	'LIST_Y_DIVIDER_LINE'	=> 'Divisor de línea vertical',

	'IMAGE_SMALL'			=> 'Imagen pequeña',
	'IMAGE_MEDIUM'			=> 'Imagen media',
	'IMAGE_LARGE'			=> 'Imagen grande',
	'IMAGE_FULL_WIDTH'		=> 'Imagen de ancho completo',
	'IMAGE_ALIGN_LEFT'		=> 'Imagen float izquierda',
	'IMAGE_ALIGN_RIGHT'		=> 'Imagen float derecha',
	'IMAGE_CIRCLE'			=> 'Imagen circular',
	'IMAGE_ROUNDED'			=> 'Imagen redondeada',
	'IMAGE_BORDER'			=> 'Imagen bordeada',
	'IMAGE_BORDER_PADDING'	=> 'Image border padding',
	'IMAGE_RATIO_SQUARE'	=> 'Imagen cuadrada',
	'IMAGE_RATIO_4_BY_3'	=> '4 por 3 imágenes',
	'IMAGE_RATIO_16_BY_9'	=> '16 por 9 imágenes',

	'RESPONSIVE_SHOW'		=> 'Mostrar sólo en dispositivos pequeños',
	'RESPONSIVE_HIDE'		=> 'Ocultar en dispositivos pequeños',

	'ALIGN_LEFT'			=> 'Texto alineado izquierdo',
	'ALIGN_CENTER'			=> 'Texto centrado',
	'ALIGN_RIGHT'			=> 'Texto alineado derecho',
	'NO_PADDING'			=> 'No padding',
	'LABEL'					=> 'Etiqueta',
	'BADGE'					=> 'Insignia',
	'PRIMARY_COLOR'			=> 'Color principal',
	'SECONDARY_COLOR'		=> 'Color secundario',
	'GRAYSCALE_COLOR'		=> 'Grayscale',
	'INFO_COLOR'			=> 'Info',
	'SUCCESS_COLOR'			=> 'Éxito',
	'WARNING_COLOR'			=> 'Advertencia',
	'DANGER_COLOR'			=> 'Peligro',
));
