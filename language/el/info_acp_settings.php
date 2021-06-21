<?php

/**
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	$lang = [];
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

$lang = array_merge($lang, [
	'ACP_SITEMAKER'		=> 'SiteMaker',
	'ACP_SM_SETTINGS'	=> 'Ρυθμίσεις',

	'BLOCKS_CLEANUP'			=> 'Εκκαθάριση Μπλοκ',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'Βρέθηκαν τα ακόλουθα στοιχεία που δεν υπάρχουν πλέον ή δεν είναι προσβάσιμα και επομένως μπορείτε να διαγράψετε όλα τα μπλοκ που σχετίζονται με αυτά. Παρακαλώ να έχετε κατά νου ότι μερικά από αυτά μπορεί να είναι ψευδώς θετικά',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Μη έγκυροι κύβοι (π.χ. από απεγκατεστημένες επεκτάσεις):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Απροσπέλαση/σπασμένα Σελίδες:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Στυλ Απεγκατάστασης (ids):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Μπλοκ που καθαρίζονται με επιτυχία',

	'FORUM_INDEX_SETTINGS'			=> 'Ρυθμίσεις Ευρετηρίου Φόρουμ',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Αυτές οι ρυθμίσεις ισχύουν μόνο όταν δεν έχει οριστεί αρχική σελίδα',

	'HIDE'			=> 'Απόκρυψη',
	'HIDE_BIRTHDAY'	=> 'Απόκρυψη τμήματος γενεθλίων',
	'HIDE_LOGIN'	=> 'Απόκρυψη πλαισίου σύνδεσης',
	'HIDE_ONLINE'	=> 'Απόκρυψη σε απευθείας σύνδεση ενότητα',

	'LAYOUT_BLOG'		=> 'Ιστολόγιο',
	'LAYOUT_CUSTOM'		=> 'Προσαρμοσμένο',
	'LAYOUT_HOLYGRAIL'	=> 'Ιερό Δισκίο',
	'LAYOUT_PORTAL'		=> 'Πύλη',
	'LAYOUT_PORTAL_ALT'	=> 'Πύλη (εναλλακτική)',
	'LAYOUT_SETTINGS'	=> 'Ρυθμίσεις Διάταξης',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Τα μπλοκ Sitemaker διαγράφονται για το στυλ που λείπει με αναγνωριστικό %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Τα μπλοκ Sitemaker διαγράφηκαν για κατεστραμμένες σελίδες:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Διαγράφηκαν μη έγκυρα μπλοκ Κατασκευαστή:<br />%s',

	'NAVIGATION_SETTINGS'		=> 'Ρυθμίσεις Πλοήγησης',

	'SETTINGS_SAVED'			=> 'Οι ρυθμίσεις σας έχουν αποθηκευτεί',
	'SHOW'						=> 'Εμφάνιση',
	'SHOW_FORUM_NAV'			=> 'Εμφάνιση «Φόρουμ» στη γραμμή πλοήγησης?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Όταν μια σελίδα οριστεί ως αρχική σελίδα αντί για το ευρετήριο φόρουμ, θα πρέπει να εμφανίσουμε το «Φόρουμ» στη γραμμή πλοήγησης',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Ναι - με εικονίδιο:',
]);
