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
	'ICON_ACCESSIBILITY'		=> 'Barrierefreiheit',
	'ICON_ALERT'				=> 'Alarm',
	'ICON_ANIMALS'				=> 'Tiere',
	'ICON_ARROWS'				=> 'Pfeile',
	'ICON_AUDIO_VIDEO'			=> 'Audio & Video',
	'ICON_AUTOMOTIVE'			=> 'Automotive',
	'ICON_AUTUMN'				=> 'Herbst',
	'ICON_BEVERAGE'				=> 'Getränk',
	'ICON_BRANDS'				=> 'Marken',
	'ICON_BUILDINGS'			=> 'Gebäude',
	'ICON_BUSINESS'				=> 'Geschäft',
	'ICON_CAMPING'				=> 'Camping',
	'ICON_CHARITY'				=> 'Spenden',
	'ICON_CHAT'					=> 'Chat',
	'ICON_CHESS'				=> 'Schach',
	'ICON_CHILDHOOD'			=> 'Kindheit',
	'ICON_CLOTHING'				=> 'Kleidung',
	'ICON_CODE'					=> 'Code',
	'ICON_COMMUNICATION'		=> 'Kommunikation',
	'ICON_COMPUTERS'			=> 'Computer',
	'ICON_CONSTRUCTION'			=> 'Konstruktion',
	'ICON_CURRENCY'				=> 'Währung',
	'ICON_DATE_TIME'			=> 'Datum & Uhrzeit',
	'ICON_DESIGN'				=> 'Design',
	'ICON_EDITORS'				=> 'Editor',
	'ICON_EDUCATION'			=> 'Bildung',
	'ICON_EMOJI'				=> 'Emoji',
	'ICON_ENERGY'				=> 'Energie',
	'ICON_FILES'				=> 'Dateien',
	'ICON_FINANCE'				=> 'Finanzen',
	'ICON_FITNESS'				=> 'Fitness',
	'ICON_FOOD'					=> 'Nahrung',
	'ICON_FRUIT_VEGETABLE'		=> 'Obst & Gemüse',
	'ICON_GAMES'				=> 'Spiele',
	'ICON_GAMING_TABLETOP'		=> 'Tabletop Spiele',
	'ICON_GENDER'				=> 'Geschlecht',
	'ICON_HALLOWEEN'			=> 'Halloween',
	'ICON_HANDS'				=> 'Hände',
	'ICON_HEALTH'				=> 'Gesundheit',
	'ICON_HOLIDAY'				=> 'Urlaub',
	'ICON_HOTEL'				=> 'Hotel',
	'ICON_HOUSEHOLD'			=> 'Haushalt',
	'ICON_IMAGES'				=> 'Bilder',
	'ICON_INTERFACES'			=> 'Schnittstellen',
	'ICON_LOGISTICS'			=> 'Logistik',
	'ICON_MAPS'					=> 'Karten',
	'ICON_MARITIME'				=> 'Maritim',
	'ICON_MARKETING'			=> 'Werbung',
	'ICON_MATHEMATICS'			=> 'Mathematik',
	'ICON_MEDICAL'				=> 'Medizinisch',
	'ICON_MOVING'				=> 'Verschieben',
	'ICON_MUSIC'				=> 'Musik',
	'ICON_OBJECTS'				=> 'Objekte',
	'ICON_PAYMENTS_SHOPPING'	=> 'Zahlungen & Einkaufen',
	'ICON_PHARMACY'				=> 'Pharmacie',
	'ICON_POLITICAL'			=> 'Politik',
	'ICON_RELIGION'				=> 'Religion',
	'ICON_SCIENCE'				=> 'Wissenschaft',
	'ICON_SCIENCE_FICTION'		=> 'Science Fiction',
	'ICON_SECURITY'				=> 'Sicherheit',
	'ICON_SHAPES'				=> 'Formen',
	'ICON_SHOPPING'				=> 'Einkaufen',
	'ICON_SOCIAL'				=> 'Soziales',
	'ICON_SPINNERS'				=> 'Spinner',
	'ICON_SPORTS'				=> 'Sport',
	'ICON_SPRING'				=> 'Frühling',
	'ICON_STATUS'				=> 'Status',
	'ICON_SUMMER'				=> 'Sommer',
	'ICON_TOGGLE'				=> 'Umschalten',
	'ICON_TRAVEL'				=> 'Reisen',
	'ICON_USERS_PEOPLE'			=> 'Benutzer & Personen',
	'ICON_VEHICLES'				=> 'Fahrzeuge',
	'ICON_WEATHER'				=> 'Wetter',
	'ICON_WINTER'				=> 'Winter',
	'ICON_WRITING'				=> 'Schreiben',

	'ICON_COLOR'				=> 'Farbe',
	'ICON_DEFAULT'				=> 'Standard',
	'ICON_FLIP_BOTH'			=> 'Flip Both',
	'ICON_FLIP_HORIZONTAL'		=> 'Horizontal drehen',
	'ICON_FLIP_VERTICAL'		=> 'Vertikal umdrehen',
	'ICON_FLOAT'				=> 'Schweben',
	'ICON_FLOAT_LEFT'			=> 'Links',
	'ICON_FLOAT_RIGHT'			=> 'Rechts',
	'ICON_FONT'					=> 'Schriftsymbole',
	'ICON_INSERT_UPDATE'		=> 'Einfügen/Update',
	'ICON_MISC'					=> 'Sonstiges',
	'ICON_MISC_BORDERED'		=> 'Umrahmt',
	'ICON_MISC_FIXED_WIDTH'		=> 'Feste Breite',
	'ICON_MISC_PULSE'			=> 'Pulse',
	'ICON_MISC_SPINNING'		=> 'Drehen',
	'ICON_ROTATION'				=> 'Drehung',
	'ICON_ROTATE_90'			=> '90°',
	'ICON_ROTATE_180'			=> '180°',
	'ICON_ROTATE_270'			=> '270°',
	'ICON_SIZE'					=> 'Größe',
	'ICON_SIZE_LG'				=> 'Größer',
	'ICON_SIZE_SM'				=> 'Klein',
	'ICON_SIZE_XS'				=> 'Sehr klein',
	'ICON_SIZE_2X'				=> '2x',
	'ICON_SIZE_3X'				=> '3x',
	'ICON_SIZE_4X'				=> '4x',
	'ICON_SIZE_5X'				=> '5x',
	'ICON_SIZE_6X'				=> '6x',
	'ICON_SIZE_7X'				=> '7x',
	'ICON_SIZE_8X'				=> '8x',
	'ICON_SIZE_9X'				=> '9x',
	'ICON_SIZE_10X'				=> '10x',

	'NO_ICON'					=> 'Kein Icon',
));
