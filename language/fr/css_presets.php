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
	'LIST_ARROW'			=> 'Marqueur de liste de flèches',
	'LIST_CIRCLE'			=> 'Marqueur de la liste des cercles',
	'LIST_DISC'				=> 'Marqueur de liste de puces',
	'LIST_SQUARE'			=> 'Marqueur de liste carrée',
	'LIST_NUMBERED'			=> 'Liste numérotée',
	'LIST_NUMBERED_ALPHABET' => 'Numéroté avec l\'alphabet',
	'LIST_NUMBERED_NESTED'	=> 'Numéroté avec sous-sections',
	'LIST_NUMBERED_ROMAN'	=> 'Numéroté avec des chiffres romains',
	'LIST_NUMBERED_ZERO'	=> 'Numéroté avec zéro initial',
	'LIST_INLINE'			=> 'Liste en ligne',
	'LIST_INLINE_SEP'		=> 'Liste séparée par des virgules',
	'LIST_REVERSE'			=> 'Inverser l\'ordre',
	'LIST_STRIPED'			=> 'Liste rayée',
	'LIST_STACKED'			=> 'Liste empilée',
	'LIST_TRIANGLE'			=> 'Triangle',
	'LIST_HYPHEN'			=> 'Astuce',
	'LIST_PLUS'				=> 'Plus',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'Club',
	'LIST_DIAMOND'			=> 'Diamant',
	'LIST_HEART'			=> 'Coeur',
	'LIST_STAR'				=> 'Étoiles',
	'LIST_CHECK'			=> 'Contrôler',
	'LIST_SNOWFLAKE'		=> 'Flocon de neige',
	'LIST_MUSIC'			=> 'Musique',
	'LIST_AUTOWIDTH'		=> 'Auto width',
	'LIST_FIT_CONTENT'		=> 'Ajuster le contenu',
	'LIST_2COLS'			=> 'Liste en 2 colonnes',
	'LIST_3COLS'			=> 'Liste 3 colonnes',
	'LIST_4COLS'			=> 'Liste à 4 colonnes',
	'LIST_5COLS'			=> 'Liste à 5 colonnes',
	'LIST_X_DIVIDER_DOTTED'	=> 'Séparateur horizontal à pointillés',
	'LIST_X_DIVIDER_LINE'	=> 'Séparateur de ligne horizontal',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Séparateur vertical à pointillés',
	'LIST_Y_DIVIDER_LINE'	=> 'Séparateur de ligne vertical',

	'IMAGE_SMALL'			=> 'Petite image',
	'IMAGE_MEDIUM'			=> 'Image moyenne',
	'IMAGE_LARGE'			=> 'Grande image',
	'IMAGE_FULL_WIDTH'		=> 'Image en pleine largeur',
	'IMAGE_ALIGN_LEFT'		=> 'Image flottante à gauche',
	'IMAGE_ALIGN_RIGHT'		=> 'Image flottante à droite',
	'IMAGE_CIRCLE'			=> 'Image circulaire',
	'IMAGE_ROUNDED'			=> 'Image arrondie',
	'IMAGE_BORDER'			=> 'Image bordée',
	'IMAGE_BORDER_PADDING'	=> 'Image border padding',
	'IMAGE_RATIO_SQUARE'	=> 'Image carrée',
	'IMAGE_RATIO_4_BY_3'	=> '4 par 3 images',
	'IMAGE_RATIO_16_BY_9'	=> '16 par 9 image',

	'RESPONSIVE_SHOW'		=> 'Afficher uniquement sur les petits appareils',
	'RESPONSIVE_HIDE'		=> 'Cacher sur les petits appareils',

	'ALIGN_LEFT'			=> 'Texte aligné à gauche',
	'ALIGN_CENTER'			=> 'Texte centré',
	'ALIGN_RIGHT'			=> 'Texte aligné à droite',
	'NO_PADDING'			=> 'No padding',
	'LABEL'					=> 'Étiquette',
	'BADGE'					=> 'Insigne',
	'PRIMARY_COLOR'			=> 'Couleur principale',
	'SECONDARY_COLOR'		=> 'Couleur secondaire',
	'GRAYSCALE_COLOR'		=> 'Grayscale',
	'INFO_COLOR'			=> 'Infos',
	'SUCCESS_COLOR'			=> 'Succès',
	'WARNING_COLOR'			=> 'Avertissement',
	'DANGER_COLOR'			=> 'Danger',
));
