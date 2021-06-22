<?php
/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
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
	'ACP_MENU'					=> 'Μενού',
	'ACP_MENU_MANAGE'			=> 'Διαχείριση Μενού',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Εδώ μπορείτε να δημιουργήσετε και να διαχειριστείτε μενού για την ιστοσελίδα σας',
	'ADD_BULK_MENU'				=> 'Μαζική Προσθήκη Στοιχείων Μενού',
	'ADD_BULK_MENU_EXPLAIN'		=> 'Προσθήκη πολλαπλών στοιχείων μενού ταυτόχρονα.<br /> - Τοποθέτησε κάθε αντικείμενο σε ξεχωριστή γραμμή<br /> - Χρησιμοποίησε το κλειδί <strong>Tab</strong> για να εσοχές για να αναπαραστάσεις σχέσεις γονέας-παιδιού<br /> - Εισαγάγε στοιχείο και URL όπως αυτά: Homet/index.php',
	'ADD_MENU'					=> 'Προσθήκη Μενού',
	'ADD_MENU_ITEM'				=> 'Προσθήκη Στοιχείου Μενού',
	'ADD_ITEM'					=> 'Προσθήκη Νέου Στοιχείου',
	'AJAX_PROCESSING'			=> 'Εργασία',

	'CHANGE_ME'					=> 'Αλλαγή Μου',

	'DELETE_ITEM'				=> 'Διαγραφή Αντικειμένου',
	'DELETE_KIDS'				=> 'Διαγραφή Κλάδου',
	'DELETE_MENU'				=> 'Διαγραφή Μενού',
	'DELETE_MENU_CONFIRM'		=> 'Είστε βέβαιοι ότι θέλετε να διαγράψετε αυτό το μενού?<br />Αυτό θα διαγράψει το μενού και όλα τα στοιχεία του',
	'DELETE_MENU_ITEM'			=> 'Διαγραφή Αντικειμένου',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Είστε βέβαιοι ότι θέλετε να διαγράψετε αυτό το στοιχείο μενού?',
	'DELETE_SELECTED'			=> 'Διαγραφή Επιλεγμένων',

	'EDIT_ITEM'					=> 'Επεξεργασία Αντικειμένου',

	'ITEM_ACTIVE'				=> 'Ενεργό',
	'ITEM_INACTIVE'				=> 'Ανενεργό',
	'ITEM_PARENT'				=> 'Γονικός',
	'ITEM_TITLE'				=> 'Τίτλος Στοιχείου',
	'ITEM_TITLE_EXPLAIN'		=> 'Ορισμός ως ’-’ για διαχωριστικό',
	'ITEM_TARGET'				=> 'Item Target',
	'ITEM_URL'					=> 'Url Στοιχείου',
	'ITEM_URL_EXPLAIN'			=> '- Αφήστε κενό για τις επικεφαλίδες<br />- Οι εξωτερικές ιστοσελίδες πρέπει να ξεκινούν με http(s)://, ftp://, //, κλπ',

	'MENU_ITEMS'				=> 'Στοιχεία Μενού',

	'NO_MENU_ITEMS'				=> 'Δεν έχουν δημιουργηθεί στοιχεία μενού',
	'NO_PARENT'					=> 'Χωρίς Γονικό',

	'PROCESSING_ERROR'			=> 'Σφάλμα επεξεργασίας',

	'REBUILD_TREE'				=> 'Αναδόμηση Δέντρου',
	'REQUIRED'					=> 'Απαιτείται',
	'REQUIRED_FIELDS'			=> '* Υποχρεωτικά πεδία',

	'SAVE_CHANGES'				=> 'Αποθήκευση Αλλαγών',
	'SAVE'						=> 'Αποθήκευση',
	'SELECT_ALL'				=> 'Επιλογή Όλων',

	'TARGET_BLANK'				=> 'Κενή Σελίδα',
	'TARGET_PARENT'				=> 'Γονικός',

	'UNSAVED_CHANGES'			=> 'Έχετε μη αποθηκευμένες αλλαγές',

	'VISIT_PAGE'				=> 'Επισκεφθείτε Τη Σελίδα',
));
