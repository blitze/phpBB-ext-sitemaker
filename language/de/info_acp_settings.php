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
	'ACP_SM_SETTINGS'	=> 'Einstellungen',

	'BLOCKS_CLEANUP'			=> 'Blöcke bereinigen',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'Die folgenden Elemente sind nicht mehr vorhanden oder nicht mehr erreichbar. Sie können daher alle Blöcke löschen, die mit ihnen verknüpft sind. Bitte bedenken Sie, dass einige von ihnen falsch positiv sein können',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Ungültige Blöcke (z.B. von deinstallierten Erweiterungen):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Nicht erreichbar/defekte Seiten:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Deinstallierte Stile (Ids):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Blöcke erfolgreich bereinigt',

	'FORUM_INDEX_SETTINGS'			=> 'Forum-Index-Einstellungen',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Diese Einstellungen gelten nur, wenn keine Startseite definiert ist',

	'HIDE'			=> 'Verstecke',
	'HIDE_BIRTHDAY'	=> 'Geburtstagsabschnitt ausblenden',
	'HIDE_LOGIN'	=> 'Login-Box ausblenden',
	'HIDE_ONLINE'	=> 'Wer Online-Bereich ausblenden',

	'LAYOUT_BLOG'		=> 'Blog',
	'LAYOUT_CUSTOM'		=> 'Eigene',
	'LAYOUT_HOLYGRAIL'	=> 'Heiliger Gral',
	'LAYOUT_PORTAL'		=> 'Portal',
	'LAYOUT_PORTAL_ALT'	=> 'Portal (alt)',
	'LAYOUT_SETTINGS'	=> 'Layout-Einstellungen',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Sitemaker-Blöcke für fehlenden Stil mit id %s gelöscht',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Sitemaker-Blöcke für kaputte Seiten gelöscht:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Ungültige Sitemaker-Blöcke gelöscht:<br />%s',

	'NAVIGATION_SETTINGS'		=> 'Navigations-Einstellungen',

	'SETTINGS_SAVED'			=> 'Ihre Einstellungen wurden gespeichert',
	'SHOW'						=> 'Anzeigen',
	'SHOW_FORUM_NAV'			=> '\'Forum\' in der Navigationsleiste anzeigen?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Wenn eine Seite als Startseite anstelle des Forum-Index gesetzt ist, sollten wir \'Forum\' in der Navigationsleiste anzeigen',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Ja - mit Symbol:',
]);
