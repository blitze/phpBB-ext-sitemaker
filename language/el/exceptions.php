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

$lang = array_merge($lang, array(
	'EXCEPTION_FIELD_MISSING'		=> 'Λείπει το απαιτούμενο πεδίο',
	'EXCEPTION_INVALID_ACTION'		=> 'Η ενέργεια δεν υπάρχει',
	'EXCEPTION_INVALID_ARGUMENT'	=> 'Μη έγκυρο όρισμα που ορίστηκε για το `%1$s`. Λόγος: %2$s',
	'EXCEPTION_INVALID_DATA_TYPE'	=> 'Η παρεχόμενη τιμή είναι ενός μη αναμενόμενου τύπου δεδομένων',
	'EXCEPTION_INVALID_ENTITY'		=> 'Η παρεχόμενη οντότητα είναι απροσδόκητης κατηγορίας οικονομικής οντότητας',
	'EXCEPTION_INVALID_PROPERTY'	=> 'Η ζητούμενη ιδιότητα δεν υπάρχει',
	'EXCEPTION_OUT_OF_BOUNDS'		=> 'Το ζητούμενο `%1$s` δεν υπάρχει',
	'EXCEPTION_SERVICE_NOT_FOUND'	=> 'Η ζητούμενη υπηρεσία δεν βρέθηκε',
	'EXCEPTION_UNEXPECTED_VALUE'	=> 'Δεν ήταν δυνατή η εκτέλεση της ενέργειας `%1$s`. Λόγος: %2$s',
));
