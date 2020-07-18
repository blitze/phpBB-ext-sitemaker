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
	'LIST_FLAT'				=> 'Liste plate',
	'LIST_ARROW'			=> 'Liste à puces Flèche',
	'LIST_CIRCLE'			=> 'Liste à puces Cercle',
	'LIST_DISC'				=> 'Liste à puces Point',
	'LIST_SQUARE'			=> 'Liste à puces Carré',
	'LIST_NUMBERED'			=> 'Liste numérotée',
	'LIST_INLINE'			=> 'Liste en ligne',
	'LIST_INLINE_SEP'		=> 'Liste CSV (séparée par des virgules)',
	'LIST_HOVER'			=> 'Surligner au survol',
	'LIST_STRIPED'			=> 'Liste à rayures (Striped-List)',
	'LIST_STACKED'			=> 'Liste empilée (Stacked-List)',
	'LIST_AUTOWIDTH'		=> 'Largeur automatique',
	'LIST_FIT_CONTENT'		=> 'Contenu adapté',
	'LIST_2COLS'			=> 'liste 2 colonnes',
	'LIST_3COLS'			=> 'liste 3 colonnes',
	'LIST_4COLS'			=> 'liste 4 colonnes',
	'LIST_5COLS'			=> 'liste 5 colonnes',
	'LIST_X_DIVIDER_DOTTED'	=> 'Séparateur Horizontal Pointillé',
	'LIST_X_DIVIDER_LINE'	=> 'Séparateur Horizontal Ligne',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Séparateur Vertical Pointillé',
	'LIST_Y_DIVIDER_LINE'	=> 'Séparateur Vertical Ligne',

	'IMAGE_SMALL'			=> 'Petite image',
	'IMAGE_MEDIUM'			=> 'Image moyenne',
	'IMAGE_LARGE'			=> 'Grande image',
	'IMAGE_FULL_WIDTH'		=> 'Image pleine largeur',
	'IMAGE_ALIGN_LEFT'		=> 'Image flottante gauche',
	'IMAGE_ALIGN_RIGHT'		=> 'Image flottante droite',
	'IMAGE_CIRCLE'			=> 'Image circulaire',
	'IMAGE_ROUNDED'			=> 'Image arrondie',
	'IMAGE_BORDER'			=> 'Image encadrée',
	'IMAGE_BORDER_PADDING'	=> 'Espacemment bordure d\'image',
	'IMAGE_RATIO_SQUARE'	=> 'Image carrée',
	'IMAGE_RATIO_4_BY_3'	=> 'Image 4/3',
	'IMAGE_RATIO_16_BY_9'	=> 'Image 16/9',

	'RESPONSIVE_SHOW'		=> 'Afficher uniquement sur les petits appareils (ex. Smartphone)',
	'RESPONSIVE_HIDE'		=> 'Masquer sur les petits appareils (ex. Smartphone)',

	'ALIGN_LEFT'			=> 'Texte aligné à gauche',
	'ALIGN_CENTER'			=> 'Texte centré',
	'ALIGN_RIGHT'			=> 'Texte aligné à droite',
	'NO_PADDING'			=> 'Aucun espacement (padding)',
	'LABEL'					=> 'Etiquette',
	'BADGE'					=> 'Badge',
	'PRIMARY_COLOR'			=> 'Couleur Principale',
	'SECONDARY_COLOR'		=> 'Couleur Secondaire',
	'GRAYSCALE_COLOR'		=> 'Niveau de gris',
	'INFO_COLOR'			=> 'Infos',
	'SUCCESS_COLOR'			=> 'Succès',
	'WARNING_COLOR'			=> 'Avertissement',
	'DANGER_COLOR'			=> 'Danger',
));
