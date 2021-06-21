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
	'ALL_TYPES'									=> 'Όλοι Οι Τύποι',
	'ALL_GROUPS'								=> 'Όλες Οι Ομάδες',
	'ARCHIVES'									=> 'Αρχειοθέτηση',
	'AUTO_LOGIN'								=> 'Επιτρέψτε την αυτόματη σύνδεση?',
	'FILE_MANAGER'								=> 'Διαχειριστής Αρχείων',
	'TOPIC_POST_IDS'							=> 'Από Το Θέμα/Ανάρτηση Ids',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Ταυτότητα(εις) θεμάτων/δημοσιεύσεων για την ανάκτηση συνημμένων από, διαχωρισμένων με <strong>κόμματα</strong>(,). Καθορίστε αν αυτή η λίστα είναι για το θέμα ή για το ανάρτηση των παραπάνω ειδήσεων.',
	'TOPIC_POST_IDS_TYPE'						=> 'Τύπος αναγνωριστικών (κατωτέρω)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Συνημμένα',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Γενέθλια',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Προσαρμοσμένο Μπλοκ',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Προτεινόμενο Μέλος',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'Τροφοδοσίες RSS/Atom',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Δημοσκόπηση Φόρουμ',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Θέματα Φόρουμ',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Χάρτες Google',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Δημοφιλή Θέματα',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Σύνδεσμοι',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Πλαίσιο Σύνδεσης',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Μέλη',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Μενού Μελών',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Μενού',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Οι Σελιδοδείκτες Μου',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Πρόσφατα Θέματα',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Στατιστικά',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Εναλλαγή Στυλ',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Τι Είναι Νέο?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Ποιος είναι συνδεδεμένος',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Λέξη',

	// block views
	'BLOCK_VIEW'								=> 'Μπλοκάρισμα Προβολής',
	'BLOCK_VIEW_BASIC'							=> 'Βασικό',
	'BLOCK_VIEW_BOXED'							=> 'Πλαισιωμένο',
	'BLOCK_VIEW_DEFAULT'						=> 'Προεπιλογή',
	'BLOCK_VIEW_SIMPLE'							=> 'Απλό',

	'CACHE_DURATION'							=> 'Διάρκεια κρύπτης',
	'CONTEXT'									=> 'Πλαίσιο',
	'CSS_SCRIPTS'								=> 'CSS Scripts',
	'CUSTOM_PROFILE_FIELDS'						=> 'Πεδία Προσαρμοσμένου Προφίλ',

	'DATE_RANGE'								=> 'Date Range',
	'DISPLAY_PREVIEW'							=> 'Εμφάνιση Προεπισκόπησης?',

	'EDIT_ME'									=> 'Παρακαλώ επεξεργαστείτε με',
	'ENABLE_TOPIC_TRACKING'						=> 'Ενεργοποίηση παρακολούθησης θέματος?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Αν ενεργοποιηθεί, θα αναφέρονται μη αναγνωσμένα θέματα, αλλά τα αποτελέσματα του ταμπλό δεν θα αποθηκεύονται προσωρινά <strong>(Δεν συνιστάται)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Έχετε εισαγάγει πάρα πολλές λέξεις για να εξαιρέσετε. Ο μέγιστος δυνατός αριθμός χαρακτήρων είναι 255, έχετε εισαγάγει %s.',
	'EXCLUDE_WORDS'								=> 'Εξαίρεση λέξεων',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Λίστα των λέξεων που θα θέλατε να αποκλείσετε από τη λέξη, διαχωρισμένες με κόμμα (,). Μέγιστο 255 χαρακτήρες.',
	'EXPANDED'									=> 'Επεκταμένη',
	'EXTENSION_GROUP'							=> 'Ομάδα Επεκτάσεων',

	'FEATURED_MEMBER_IDS'						=> 'Αναγνωριστικά Χρήστη',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Λίστα χωρισμένη με κόμμα των χρηστών στη δυνατότητα (ισχύει μόνο για λειτουργία εμφάνισης Προτεινόμενων Μελών)',
	'FEED_DATA_PREVIEW'							=> 'Δεδομένα Ροής',
	'FEED_ITEM_TEMPLATE'						=> 'Πρότυπο Στοιχείου',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS:</strong><br />
		<ul class="sm-list">
			<li>Access feed data in <strong>item</strong> variable e.g. item.title</li>
			<li>Template must be in <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Twig syntax</a></li>
			<li>Click <strong>Samples</strong> above for sample templates</li>
			<li>Use <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> to get any tag from the feed that we do not provide e.g.<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<li>Use Twig’s json_encode filter to see contents of array e.g. <strong><code>{{ get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Πηγή',
	'FEED_URL_PLACEHOLDER'						=> 'http://example.com/rss',
	'FEED_URLS'									=> 'Url Ροής',
	'FIRST_POST_ONLY'							=> 'Πρώτη Δημοσίευση Μόνο',
	'FIRST_POST_TIME'							=> 'Πρώτη Ώρα Δημοσίευσης',
	'FORUMS_GET_TYPE'							=> 'Λήψη τύπου',
	'FORUMS_MAX_TOPICS'							=> 'Μέγιστα θέματα/δημοσιεύσεις',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Μέγιστος αριθμός χαρακτήρων ανά τίτλο',
	'FREQUENCY'									=> 'Συχνότητα',
	'FULL'										=> 'Πλήρης',
	'FULLSCREEN'								=> 'Πλήρης Οθόνη',

	'GET_TYPE'									=> 'Εμφάνιση Θέματος/Δημοσίευσης?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Χρησιμοποιήστε αυτό το textarea για να εισάγετε περιεχόμενο HTML.</strong><br />Παρακαλώ σημειώστε ότι οποιοδήποτε περιεχόμενο που δημοσιεύτηκε εδώ θα αντικαταστήσει το προσαρμοσμένο περιεχόμενο μπλοκ και ο οπτικός επεξεργαστής μπλοκ δεν θα είναι διαθέσιμος.',
	'HOURS_SHORT'								=> 'ώρες',

	'JS_SCRIPTS'								=> 'Σενάρια JS',

	'LAST_POST_TIME'							=> 'Ώρα Τελευταίας Δημοσίευσης',
	'LAST_READ_TIME'							=> 'Τελευταίος Χρόνος Ανάγνωσης',
	'LIMIT'										=> 'Όριο',
	'LIMIT_FORUMS'								=> 'Αναγνωριστικά Φόρουμ (προαιρετικά)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Εισάγετε κάθε αναγνωριστικό φόρουμ διαχωρισμένο με κόμμα (,). Αν οριστεί, θα εμφανιστούν μόνο θέματα από συγκεκριμένα φόρουμ.',
	'LIMIT_POST_TIME'							=> 'Όριο ανά ώρα δημοσίευσης',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Εάν οριστεί, μόνο τα θέματα που δημοσιεύτηκαν εντός της καθορισμένης περιόδου θα ανακτηθούν',

	'MAX_DEPTH'									=> 'Μέγιστο βάθος',
	'MAX_ITEMS'									=> 'Μέγιστος αριθμός αντικειμένων',
	'MAX_MEMBERS'								=> 'Μεγ. Μέλη',
	'MAX_POSTS'									=> 'Μέγιστος αριθμός δημοσιεύσεων',
	'MAX_TOPICS'								=> 'Μέγιστος αριθμός θεμάτων',
	'MAX_WORDS'									=> 'Μέγιστος αριθμός λέξεων',
	'MANAGE_MENUS'								=> 'Διαχείριση Μενού',
	'MAP_COORDINATES'							=> 'Συντεταγμένες',
	'MAP_COORDINATES_EXPLAIN'					=> 'Εισάγετε συντεταγμένες στο γεωγραφικό πλάτος της φόρμας, γεωγραφικό μήκος',
	'MAP_HEIGHT'								=> 'Ύψος',
	'MAP_LOCATION'								=> 'Τοποθεσία',
	'MAP_TITLE'									=> 'Τίτλος',
	'MAP_VIEW'									=> 'Προβολή',
	'MAP_VIEW_HYBRID'							=> 'Υβριδικό',
	'MAP_VIEW_MAP'								=> 'Χάρτης',
	'MAP_VIEW_SATELITE'							=> 'Δορυφόρος',
	'MAP_VIEW_TERRAIN'							=> 'Terrain',
	'MAP_ZOOM_LEVEL'							=> 'Επίπεδο Εστίασης',
	'MEMBERS_DATE'								=> 'Ημερομηνία',
	'MENU_NO_ITEMS'								=> 'Δεν υπάρχουν ενεργά στοιχεία για εμφάνιση',
	'MINI'										=> 'Μίνι',

	'OR'										=> '<strong>Ή</strong>',
	'ORDER_BY'									=> 'Ταξινόμηση κατά',

	'POLL_FROM_FORUMS'							=> 'Εμφάνιση δημοσκοπήσεων από forums(s)',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Μόνο οι δημοσκοπήσεις από τα επιλεγμένα φόρουμ θα εμφανίζονται εφόσον δεν καθορίζονται θέματα παραπάνω',
	'POLL_FROM_GROUPS'							=> 'Εμφάνιση δημοσκοπήσεων από ομάδες(ες)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Μόνο οι δημοσκοπήσεις από τα μέλη των επιλεγμένων ομάδων θα εμφανίζονται εφόσον κανένας (οι) χρήστης(ες) δεν καθορίζεται παραπάνω',
	'POLL_FROM_TOPICS'							=> 'Εμφάνιση δημοσκοπήσεων από θέματα(α)',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Ταυτότητα των θεμάτων από τα οποία θα ανακτηθούν οι δημοσκοπήσεις, διαχωρισμένα με <strong>κόμματα</strong>(,). Αφήστε κενό για να επιλέξετε οποιοδήποτε θέμα.',
	'POLL_FROM_USERS'							=> 'Εμφάνιση δημοσκοπήσεων από χρήστη(ες)',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Ταυτότητα(εις) των χρηστών των οποίων τις δημοσκοπήσεις θα θέλατε να εμφανίζετε, διαχωρίζονται με <strong>κόμματα</strong>(,). Αφήστε κενό για να επιλέξετε δημοσκοπήσεις από οποιονδήποτε χρήστη.',
	'POSTS_TITLE_LIMIT'							=> 'Μέγιστος αριθμός χαρακτήρων για τον τίτλο δημοσίευσης',
	'PREVIEW_MAX_CHARS'							=> 'Αριθμός χαρακτήρων προς προεπισκόπηση',

	'QUERY_TYPE'								=> 'Λειτουργία Προβολής',

	'ROTATE_DAILY'								=> 'Καθημερινά',
	'ROTATE_HOURLY'								=> 'Ωριαία',
	'ROTATE_MONTHLY'							=> 'Μηνιαία',
	'ROTATE_PAGELOAD'							=> 'Φόρτωση σελίδας',
	'ROTATE_WEEKLY'								=> 'Εβδομαδιαία',

	'SAMPLES'									=> 'Δείγματα',
	'SCRIPTS'									=> 'Σενάρια',
	'SELECT_FORUMS'								=> 'Επιλογή φόρουμ',
	'SELECT_FORUMS_EXPLAIN'						=> 'Επιλέξτε τα φόρουμ από τα οποία θα εμφανίζονται τα θέματα/δημοσιεύσεις. Αφήστε κενό για να επιλέξετε από όλα τα φόρουμ',
	'SELECT_MENU'								=> 'Επιλογή Μενού',
	'SELECT_PROFILE_FIELDS'						=> 'Επιλέξτε πεδία προφίλ',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Θα εμφανιστούν μόνο τα επιλεγμένα πεδία του προφίλ, αν είναι διαθέσιμα.',
	'SHOW_FIRST_POST'							=> 'Πρώτη Δημοσίευση',
	'SHOW_HIDE_ME'								=> 'Να επιτρέπεται η απόκρυψη online κατάστασης?',
	'SHOW_LAST_POST'							=> 'Τελευταία Δημοσίευση',
	'SHOW_MEMBER_MENU'							=> 'Εμφάνιση μενού χρήστη?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Αντικαταστήστε το πλαίσιο σύνδεσης με το μενού χρήστη εάν ο χρήστης είναι συνδεδεμένος',
	'SHOW_WORD_COUNT'							=> 'Εμφάνιση αριθμού λέξεων?',

	'TEMPLATE'									=> 'Πρότυπο',
	'TOPIC_TITLE_LIMIT'							=> 'Μέγιστος αριθμός χαρακτήρων για τον τίτλο του θέματος',
	'TOPIC_TYPE'								=> 'Τύπος Θέματος',
	'TOPIC_TYPE_EXPLAIN'						=> 'Επιλέξτε τους τύπους θεμάτων που θα θέλατε να εμφανίσετε. Αφήστε τα πλαίσια απενεργοποιημένα για να επιλέξετε από όλους τους τύπους θεμάτων',
	'TOPICS_LOOK_BACK'							=> 'Αναζήτηση πίσω',
	'TOPICS_ONLY'								=> 'Θέματα μόνο?',
	'TOPICS_PER_PAGE'							=> 'Ανά σελίδα',

	'WORD_MAX_SIZE'								=> 'Μέγιστο μέγεθος γραμματοσειράς',
	'WORD_MIN_SIZE'								=> 'Ελάχιστο μέγεθος γραμματοσειράς',
));
