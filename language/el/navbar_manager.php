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
	'ACTIVE_ELEMENT'			=> 'Ενεργό Στοιχείο',
	'BORDER'					=> 'Border',
	'BORDER_COLOR'				=> 'Χρώμα Περιγράμματος',
	'BORDER_RADIUS'				=> 'Ακτίνα Περιγράμματος',
	'BORDER_WIDTH'				=> 'Border Width',
	'BOTTOM'					=> 'Κάτω',
	'BOTTOM_LEFT'				=> 'Κάτω Αριστερά',
	'BOTTOM_RIGHT'				=> 'Κάτω Δεξιά',
	'CAPITALIZE'				=> 'Κεφαλαιοποίηση',
	'COLOR'						=> 'Χρώμα',
	'DIVIDERS'					=> 'Διαχωριστικά',
	'END'						=> 'Τέλος',
	'GRADIENT'					=> 'Διαβάθμιση',
	'HEADERS'					=> 'Κεφαλίδες',
	'HOVER'						=> 'Hover',
	'LEFT'						=> 'Αριστερά',
	'LOWERCASE'					=> 'Πεζά',
	'MARGIN'					=> 'Περιθώριο',
	'NAVBAR'					=> 'Γραμμή Πλοήγησης',
	'NAVBAR_MENU'				=> 'Navbar menu',
	'NAVBAR_DROPDOWN'			=> 'Αναπτυσσόμενο',
	'NAVBAR_LOCATION'			=> 'Τοποθεσία',
	'NAVBAR_LOCATION_OPTION'	=> 'Τοποθεσία #%s',
	'NAVBAR_TOP_MENU'			=> 'Πάνω Μενού',
	'NONE'						=> 'Κανένα',
	'PADDING'					=> 'Padding',
	'RESPONSIVE_TOGGLE'			=> 'Εναλλαγή Ανταπόκρισης',
	'RESPONSIVE_TOGGLE_EXPLAIN'	=> 'Μόνο ορατό σε μικρές (κινητές) οθόνες',
	'RIGHT'						=> 'Δεξιά',
	'SAVE'						=> 'Αποθήκευση',
	'SIZE'						=> 'Μέγεθος',
	'START'						=> 'Έναρξη',
	'TEXT'						=> 'Κείμενο',
	'TOP'						=> 'Πάνω',
	'TOP_LEFT'					=> 'Πάνω Αριστερά',
	'TOP_RIGHT'					=> 'Πάνω Δεξιά',
	'TRANSFORM'					=> 'Μετασχηματισμός',
	'UPPERCASE'					=> 'Κεφαλαία',
));
