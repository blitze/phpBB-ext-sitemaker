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
	'ACP_SM_SETTINGS'	=> 'Indstillinger',

	'BLOCKS_CLEANUP'			=> 'Blokke Oprydning',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'Følgende elementer blev fundet ikke længere at eksistere eller utilgængelige, og du kan derfor slette alle de blokke, der er knyttet til dem. Vær opmærksom på, at nogle af disse kan være falske positive',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Ugyldige blokke (f.eks. fra afinstallerede udvidelser):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Utilgængelig/ødelagte Sider:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Uninstalled Styles (ids):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Blokke renset sucessfully',

	'FORUM_INDEX_SETTINGS'			=> 'Forum Indeks Indstillinger',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Disse indstillinger gælder kun, når der ikke er defineret nogen startside',

	'HIDE'			=> 'Skjul',
	'HIDE_BIRTHDAY'	=> 'Skjul sektion for fødselsdag',
	'HIDE_LOGIN'	=> 'Skjul login-boks',
	'HIDE_ONLINE'	=> 'Skjul Whos online sektion',

	'LAYOUT_BLOG'		=> 'Blog',
	'LAYOUT_CUSTOM'		=> 'Tilpasset',
	'LAYOUT_HOLYGRAIL'	=> 'Hellig Grå',
	'LAYOUT_PORTAL'		=> 'Portal',
	'LAYOUT_PORTAL_ALT'	=> 'Portal (alt)',
	'LAYOUT_SETTINGS'	=> 'Layout Indstillinger',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Sitemaker blokke slettet for manglende stil med id %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Sitemaker blokke slettet for brudte sider:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Ugyldig Sitemaker blokke slettet:<br />%s',

	'NAVIGATION_SETTINGS'		=> 'Indstillinger For Navigation',

	'SETTINGS_SAVED'			=> 'Dine indstillinger er blevet gemt',
	'SHOW'						=> 'Vis',
	'SHOW_FORUM_NAV'			=> 'Vis \'Forum\' i navigationslinjen?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Når en side er indstillet som startside i stedet for forummets indeks, skal vi vise \'Forum\' i navigationslinjen',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Ja - med ikon:',
]);
