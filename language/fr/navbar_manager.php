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
	'ACTIVE_ELEMENT'			=> 'Élément actif',
	'BORDER'					=> 'Border',
	'BORDER_COLOR'				=> 'Couleur de bordure',
	'BORDER_RADIUS'				=> 'Rayon de bordure',
	'BORDER_WIDTH'				=> 'Border Width',
	'BOTTOM'					=> 'Bas',
	'BOTTOM_LEFT'				=> 'En bas à gauche',
	'BOTTOM_RIGHT'				=> 'En bas à droite',
	'CAPITALIZE'				=> 'Mettre en majuscule',
	'COLOR'						=> 'Couleur',
	'DIVIDERS'					=> 'Diviseurs',
	'END'						=> 'Fin',
	'GRADIENT'					=> 'Dégradé',
	'HEADERS'					=> 'En-têtes',
	'HOVER'						=> 'Hover',
	'LEFT'						=> 'Gauche',
	'LOWERCASE'					=> 'minuscule',
	'MARGIN'					=> 'Marge',
	'NAVBAR'					=> 'Barre de navigation',
	'NAVBAR_MENU'				=> 'Navbar menu',
	'NAVBAR_DROPDOWN'			=> 'Liste déroulante',
	'NAVBAR_LOCATION'			=> 'Localisation',
	'NAVBAR_LOCATION_OPTION'	=> 'Lieu #%s',
	'NAVBAR_TOP_MENU'			=> 'Menu du haut',
	'NONE'						=> 'Aucun',
	'PADDING'					=> 'Padding',
	'RESPONSIVE_TOGGLE'			=> 'Interrupteur adaptatif',
	'RESPONSIVE_TOGGLE_EXPLAIN'	=> 'Visible uniquement sur les petits écrans (mobiles)',
	'RIGHT'						=> 'Droite',
	'SAVE'						=> 'Enregistrer',
	'SIZE'						=> 'Taille',
	'START'						=> 'Début',
	'TEXT'						=> 'Texte du texte',
	'TOP'						=> 'En haut',
	'TOP_LEFT'					=> 'En haut à gauche',
	'TOP_RIGHT'					=> 'En haut à droite',
	'TRANSFORM'					=> 'Transformation',
	'UPPERCASE'					=> 'Majuscule',
));
