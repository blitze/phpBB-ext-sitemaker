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
	'ICON_ACCESSIBILITY'	=> 'Accessibilité',
	'ICON_BRAND'			=> 'Marque',
	'ICON_CHART'			=> 'Graphiques',
	'ICON_COLOR'			=> 'Couleur',
	'ICON_COLOR_DEFAULT'	=> 'Couleur par défaut',
	'ICON_CURRENCY'			=> 'Devise',
	'ICON_DIRECTIONAL'		=> 'Directionnel',
	'ICON_FILE_TYPE'		=> 'Type de fichier',
	'ICON_FLIP_HORIZONTAL'	=> 'Retourner Horizontalement',
	'ICON_FLIP_VERTICAL'	=> 'Retourner Verticalement',
	'ICON_FLOAT'			=> 'Flottant',
	'ICON_FLOAT_LEFT'		=> 'Gauche',
	'ICON_FLOAT_RIGHT'		=> 'Droite',
	'ICON_FONT'				=> 'Icônes de police de caractères',
	'ICON_FORM_CONTROL'		=> 'Contrôle de formulaire',
	'ICON_GENDER'			=> 'Genre',
	'ICON_HANDS'			=> 'Mains',
	'ICON_IMAGE'			=> 'Image',
	'ICON_INSERT_UPDATE'	=> 'Insérer / mettre à jour',
	'ICON_MEDICAL'			=> 'Médical',
	'ICON_MISC'				=> 'Divers',
	'ICON_MISC_BORDERED'	=> 'Encadré',
	'ICON_MISC_FIXED_WIDTH'	=> 'Largeur fixe',
	'ICON_MISC_SPINNING'	=> 'Tourner',
	'ICON_PAYMENT'			=> 'Paiement',
	'ICON_ROTATION'			=> 'Rotation',
	'ICON_ROTATION_90_DEG'	=> '90°',
	'ICON_ROTATION_180_DEG'	=> '180°',
	'ICON_ROTATION_270_DEG'	=> '270°',
	'ICON_SIZE'				=> 'Taille',
	'ICON_SIZE_DEFAULT'		=> 'Défaut',
	'ICON_SIZE_LARGER'		=> 'Plus grand',
	'ICON_SPINNER'			=> 'Spineur',
	'ICON_TEXT_EDITOR'		=> 'Éditeur de texte',
	'ICON_TRANSPORTATION'	=> 'Transports',
	'ICON_VIDEO_PLAYER'		=> 'Lecteur vidéo',
	'ICON_WEB_APPLICATION'	=> 'Application Web',

	'NO_ICON'				=> 'Aucune icône',
));
