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
	'LIST_ARROW'			=> 'Δείκτης λίστας βελών',
	'LIST_CIRCLE'			=> 'Δείκτης λίστας κύκλων',
	'LIST_DISC'				=> 'Σημάδι λίστας κουκκίδων',
	'LIST_SQUARE'			=> 'Σημάδι τετράγωνης λίστας',
	'LIST_NUMBERED'			=> 'Αριθμημένη λίστα',
	'LIST_NUMBERED_ALPHABET' => 'Αριθμημένο με αλφάβητο',
	'LIST_NUMBERED_NESTED'	=> 'Αριθμημένη με υποενότητες',
	'LIST_NUMBERED_ROMAN'	=> 'Αριθμημένα με λατινικούς αριθμούς',
	'LIST_NUMBERED_ZERO'	=> 'Αριθμημένα με μηδενικό προβάδισμα',
	'LIST_INLINE'			=> 'Ενσωματωμένη λίστα',
	'LIST_INLINE_SEP'		=> 'Λίστα χωρισμένη με κόμματα',
	'LIST_REVERSE'			=> 'Αντίστροφη σειρά',
	'LIST_STRIPED'			=> 'Ριγέ λίστα',
	'LIST_STACKED'			=> 'Συσσωρευμένη λίστα',
	'LIST_TRIANGLE'			=> 'Τρίγωνο',
	'LIST_HYPHEN'			=> 'Υφαίνη',
	'LIST_PLUS'				=> 'Συν',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'Λέσχη',
	'LIST_DIAMOND'			=> 'Διαμάντι',
	'LIST_HEART'			=> 'Καρδιά',
	'LIST_STAR'				=> 'Αστέρι',
	'LIST_CHECK'			=> 'Έλεγχος',
	'LIST_SNOWFLAKE'		=> 'Νιφάδα Χιονιού',
	'LIST_MUSIC'			=> 'Μουσική',
	'LIST_AUTOWIDTH'		=> 'Auto width',
	'LIST_FIT_CONTENT'		=> 'Προσαρμογή περιεχομένου',
	'LIST_2COLS'			=> '2 λίστα στηλών',
	'LIST_3COLS'			=> '3 στήλες',
	'LIST_4COLS'			=> '4 στήλες λίστα',
	'LIST_5COLS'			=> '5 στήλες',
	'LIST_X_DIVIDER_DOTTED'	=> 'Οριζόντια διακεκομμένη διαχωριστική γραμμή',
	'LIST_X_DIVIDER_LINE'	=> 'Διαχωριστικό οριζόντιας γραμμής',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Κάθετη διαχωριστική γραμμή',
	'LIST_Y_DIVIDER_LINE'	=> 'Διαχωριστικό κατακόρυφης γραμμής',

	'IMAGE_SMALL'			=> 'Μικρή εικόνα',
	'IMAGE_MEDIUM'			=> 'Μεσαία εικόνα',
	'IMAGE_LARGE'			=> 'Μεγάλη εικόνα',
	'IMAGE_FULL_WIDTH'		=> 'Εικόνα πλήρους πλάτους',
	'IMAGE_ALIGN_LEFT'		=> 'Απόρριψη επιπλέουσας εικόνας',
	'IMAGE_ALIGN_RIGHT'		=> 'Πλωτή εικόνα δεξιά',
	'IMAGE_CIRCLE'			=> 'Κυκλική εικόνα',
	'IMAGE_ROUNDED'			=> 'Στρογγυλεμένη εικόνα',
	'IMAGE_BORDER'			=> 'Bordered εικόνα',
	'IMAGE_BORDER_PADDING'	=> 'Image border padding',
	'IMAGE_RATIO_SQUARE'	=> 'Τετράγωνη Εικόνα',
	'IMAGE_RATIO_4_BY_3'	=> '4 με 3 εικόνες',
	'IMAGE_RATIO_16_BY_9'	=> '16 από 9 εικόνες',

	'RESPONSIVE_SHOW'		=> 'Εμφάνιση μόνο σε μικρές συσκευές',
	'RESPONSIVE_HIDE'		=> 'Απόκρυψη σε μικρές συσκευές',

	'ALIGN_LEFT'			=> 'Αριστερό-ευθυγραμμισμένο κείμενο',
	'ALIGN_CENTER'			=> 'Κεντραρισμένο κείμενο',
	'ALIGN_RIGHT'			=> 'Δεξιά-ευθυγραμμισμένο κείμενο',
	'NO_PADDING'			=> 'No padding',
	'LABEL'					=> 'Ετικέτα',
	'BADGE'					=> 'Σήμα',
	'PRIMARY_COLOR'			=> 'Κύριο χρώμα',
	'SECONDARY_COLOR'		=> 'Δευτερεύον χρώμα',
	'GRAYSCALE_COLOR'		=> 'Grayscale',
	'INFO_COLOR'			=> 'Πληροφορίες',
	'SUCCESS_COLOR'			=> 'Επιτυχία',
	'WARNING_COLOR'			=> 'Προειδοποίηση',
	'DANGER_COLOR'			=> 'Κίνδυνος',
));
