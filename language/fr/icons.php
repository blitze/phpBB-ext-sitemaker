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
	'ICON_ACCESSIBILITY'		=> 'Accessibilité',
	'ICON_ALERT'				=> 'Notification',
	'ICON_ANIMALS'				=> 'Animaux',
	'ICON_ARROWS'				=> 'Flèches',
	'ICON_AUDIO_VIDEO'			=> 'Audio et vidéo',
	'ICON_AUTOMOTIVE'			=> 'Automobile',
	'ICON_AUTUMN'				=> 'Automne',
	'ICON_BEVERAGE'				=> 'Boisson',
	'ICON_BRANDS'				=> 'Marques',
	'ICON_BUILDINGS'			=> 'Bâtiments',
	'ICON_BUSINESS'				=> 'Affaires',
	'ICON_CAMPING'				=> 'Camping',
	'ICON_CHARITY'				=> 'Charité',
	'ICON_CHAT'					=> 'Chat',
	'ICON_CHESS'				=> 'Échecs',
	'ICON_CHILDHOOD'			=> 'Enfance',
	'ICON_CLOTHING'				=> 'Habillement',
	'ICON_CODE'					=> 'Code',
	'ICON_COMMUNICATION'		=> 'Communication',
	'ICON_COMPUTERS'			=> 'Ordinateurs',
	'ICON_CONSTRUCTION'			=> 'Construction',
	'ICON_CURRENCY'				=> 'Devise',
	'ICON_DATE_TIME'			=> 'Date et heure',
	'ICON_DESIGN'				=> 'Conception',
	'ICON_EDITORS'				=> 'Éditeurs',
	'ICON_EDUCATION'			=> 'Éducation',
	'ICON_EMOJI'				=> 'Emoji',
	'ICON_ENERGY'				=> 'Énergie',
	'ICON_FILES'				=> 'Fichiers',
	'ICON_FINANCE'				=> 'Finance',
	'ICON_FITNESS'				=> 'Fitness',
	'ICON_FOOD'					=> 'Alimentation',
	'ICON_FRUIT_VEGETABLE'		=> 'Fruits et légumes',
	'ICON_GAMES'				=> 'Jeux',
	'ICON_GAMING_TABLETOP'		=> 'Jeux Tabletop',
	'ICON_GENDER'				=> 'Genre',
	'ICON_HALLOWEEN'			=> 'Halloween',
	'ICON_HANDS'				=> 'Mains',
	'ICON_HEALTH'				=> 'Santé',
	'ICON_HOLIDAY'				=> 'Vacances',
	'ICON_HOTEL'				=> 'Hôtel',
	'ICON_HOUSEHOLD'			=> 'Travaux domestiques',
	'ICON_IMAGES'				=> 'Images',
	'ICON_INTERFACES'			=> 'Interfaces',
	'ICON_LOGISTICS'			=> 'Logistique',
	'ICON_MAPS'					=> 'Cartes',
	'ICON_MARITIME'				=> 'Maritime',
	'ICON_MARKETING'			=> 'Marketing',
	'ICON_MATHEMATICS'			=> 'Mathématiques',
	'ICON_MEDICAL'				=> 'Médical',
	'ICON_MOVING'				=> 'Déplacement',
	'ICON_MUSIC'				=> 'Musique',
	'ICON_OBJECTS'				=> 'Objets',
	'ICON_PAYMENTS_SHOPPING'	=> 'Paiements et achats',
	'ICON_PHARMACY'				=> 'Pharmacie',
	'ICON_POLITICAL'			=> 'Politique',
	'ICON_RELIGION'				=> 'Religion',
	'ICON_SCIENCE'				=> 'Sciences',
	'ICON_SCIENCE_FICTION'		=> 'Science-fiction',
	'ICON_SECURITY'				=> 'Sécurité',
	'ICON_SHAPES'				=> 'Formes',
	'ICON_SHOPPING'				=> 'Shopping',
	'ICON_SOCIAL'				=> 'Social',
	'ICON_SPINNERS'				=> 'Spinners',
	'ICON_SPORTS'				=> 'Sports',
	'ICON_SPRING'				=> 'Printemps',
	'ICON_STATUS'				=> 'État',
	'ICON_SUMMER'				=> 'Été',
	'ICON_TOGGLE'				=> 'Basculer',
	'ICON_TRAVEL'				=> 'Voyages',
	'ICON_USERS_PEOPLE'			=> 'Personnes',
	'ICON_VEHICLES'				=> 'Véhicules',
	'ICON_WEATHER'				=> 'Météo',
	'ICON_WINTER'				=> 'Hiver',
	'ICON_WRITING'				=> 'Écriture',

	'ICON_COLOR'				=> 'Couleur',
	'ICON_DEFAULT'				=> 'Par défaut',
	'ICON_FLIP_BOTH'			=> 'Inverser les deux',
	'ICON_FLIP_HORIZONTAL'		=> 'Retourner Horizontalement',
	'ICON_FLIP_VERTICAL'		=> 'Retourner Verticalement',
	'ICON_FLOAT'				=> 'Flottant',
	'ICON_FLOAT_LEFT'			=> 'Gauche',
	'ICON_FLOAT_RIGHT'			=> 'Droite',
	'ICON_FONT'					=> 'Icônes de police de caractères',
	'ICON_INSERT_UPDATE'		=> 'Insérer / mettre à jour',
	'ICON_MISC'					=> 'Divers',
	'ICON_MISC_BORDERED'		=> 'Encadré',
	'ICON_MISC_FIXED_WIDTH'		=> 'Largeur fixe',
	'ICON_MISC_PULSE'			=> 'Pulse',
	'ICON_MISC_SPINNING'		=> 'Tourner',
	'ICON_ROTATION'				=> 'Rotation',
	'ICON_ROTATE_90'			=> '90°',
	'ICON_ROTATE_180'			=> '180°',
	'ICON_ROTATE_270'			=> '270°',
	'ICON_SIZE'					=> 'Taille',
	'ICON_SIZE_LG'				=> 'Plus grand',
	'ICON_SIZE_SM'				=> 'Petit',
	'ICON_SIZE_XS'				=> 'Très petit',
	'ICON_SIZE_2X'				=> '2x',
	'ICON_SIZE_3X'				=> '3x',
	'ICON_SIZE_4X'				=> '4x',
	'ICON_SIZE_5X'				=> '5x',
	'ICON_SIZE_6X'				=> '6x',
	'ICON_SIZE_7X'				=> '7x',
	'ICON_SIZE_8X'				=> 'x8',
	'ICON_SIZE_9X'				=> '9x',
	'ICON_SIZE_10X'				=> '10x',

	'NO_ICON'					=> 'Aucune icône',
));
