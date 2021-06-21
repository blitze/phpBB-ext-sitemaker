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
	'ACTIVE_ELEMENT'			=> 'Elemento ativo',
	'BORDER'					=> 'Border',
	'BORDER_COLOR'				=> 'Cor da Borda',
	'BORDER_RADIUS'				=> 'Raio da borda',
	'BORDER_WIDTH'				=> 'Border Width',
	'BOTTOM'					=> 'Inferior',
	'BOTTOM_LEFT'				=> 'Canto inferior esquerdo',
	'BOTTOM_RIGHT'				=> 'Canto inferior direito',
	'CAPITALIZE'				=> 'Capitalizar',
	'COLOR'						=> 'Cor',
	'DIVIDERS'					=> 'Divisores',
	'END'						=> 'Término',
	'GRADIENT'					=> 'Degradê',
	'HEADERS'					=> 'Cabeçalhos',
	'HOVER'						=> 'Hover',
	'LEFT'						=> 'Esquerda',
	'LOWERCASE'					=> 'Minúsculo',
	'MARGIN'					=> 'Margem',
	'NAVBAR'					=> 'Navbar',
	'NAVBAR_MENU'				=> 'Navbar menu',
	'NAVBAR_DROPDOWN'			=> 'Suspensa',
	'NAVBAR_LOCATION'			=> 'Local:',
	'NAVBAR_LOCATION_OPTION'	=> 'Localização #%s',
	'NAVBAR_TOP_MENU'			=> 'Menu superior',
	'NONE'						=> 'Nenhuma',
	'PADDING'					=> 'Padding',
	'RESPONSIVE_TOGGLE'			=> 'Ligar/desligar responsivo',
	'RESPONSIVE_TOGGLE_EXPLAIN'	=> 'Visível apenas em telas pequenas (móveis)',
	'RIGHT'						=> 'Direita',
	'SAVE'						=> 'Guardar',
	'SIZE'						=> 'Tamanho',
	'START'						=> 'Iniciar',
	'TEXT'						=> 'texto',
	'TOP'						=> 'Superior',
	'TOP_LEFT'					=> 'Superior Esquerdo',
	'TOP_RIGHT'					=> 'Superior Direito',
	'TRANSFORM'					=> 'Transformar',
	'UPPERCASE'					=> 'Maiúscula',
));
