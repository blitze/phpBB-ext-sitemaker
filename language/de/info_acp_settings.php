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

	'FILEMANAGER_SETTINGS'						=> 'Dateimanager Einstellungen',
	'FILEMANAGER_STATUS'						=> 'Status',
	'FILEMANAGER_NO_EXIST'						=> 'Sie müssen den Dateimanager installieren, bevor Sie ihn aktivieren können. Installationsanweisungen finden Sie <a href="%s" target="_blank"  rel="noopener noreferrer"><strong>hier</strong></a>',
	'FILEMENAGER_NOT_WRITABLE'					=> 'File manager config folder (root/ResponsiveFilemanager/filemanager/config/) is not writable. Please change the permissions to writable by all (777 or -rwxrwxrwx within your FTP Client)',
	'FILEMANAGER_IMAGE_AUTO_RESIZE'				=> 'Größe der hochgeladenen Bilder automatisch ändern?',
	'FILEMANAGER_IMAGE_AUTO_RESIZE_DIMENSIONS'	=> 'Größe auf bestimmte Dimensionen ändern',
	'FILEMANAGER_IMAGE_AUTO_RESIZING_MODE'		=> 'Automatische Größenänderung',
	'FILEMANAGER_IMAGE_MAX_DIMENSIONS'			=> 'Max. Bildgröße',
	'FILEMANAGER_IMAGE_MAX_MODE'				=> 'Max. Bildgröße Modus',
	'FILEMANAGER_IMAGE_MODE_EXPLAIN'			=> 'Wird verwendet, um die Höhe / Breite zu berechnen, wenn Sie nur Höhe oder Breite angeben, aber nicht beide oben',
	'FILEMANAGER_IMAGE_MODE_AUTO'				=> 'Auto',
	'FILEMANAGER_IMAGE_MODE_CROP'				=> 'Ernte',
	'FILEMANAGER_IMAGE_MODE_EXACT'				=> 'Genaue',
	'FILEMANAGER_IMAGE_MODE_LANDSCAPE'			=> 'Querformat',
	'FILEMANAGER_IMAGE_MODE_PORTRAIT'			=> 'Hochformat',
	'FILEMANAGER_WATERMARK'						=> 'Wasserzeichen',
	'FILEMANAGER_WATERMARK_EXPLAIN'				=> 'URL des Bildes als Wasserzeichen für alle hochgeladenen Bilder',
	'FILEMANAGER_WATERMARK_POSITION'			=> 'Wasserzeichen Position',
	'FILEMANAGER_WATERMARK_POSITION_EXPLAIN'	=> 'Wählen Sie eine vordefinierte Position, an der das Wasserzeichen angezeigt werden soll oder geben Sie die Koordinaten z.B. 50x100 ein',
	'FILEMANAGER_WATERMARK_POSITION_TL'			=> 'Oben links',
	'FILEMANAGER_WATERMARK_POSITION_T'			=> 'Oben',
	'FILEMANAGER_WATERMARK_POSITION_TR'			=> 'Oben rechts',
	'FILEMANAGER_WATERMARK_POSITION_L'			=> 'Links',
	'FILEMANAGER_WATERMARK_POSITION_M'			=> 'Mitte',
	'FILEMANAGER_WATERMARK_POSITION_R'			=> 'Rechts',
	'FILEMANAGER_WATERMARK_POSITION_BL'			=> 'Unten links',
	'FILEMANAGER_WATERMARK_POSITION_B'			=> 'Unten',
	'FILEMANAGER_WATERMARK_POSITION_BR'			=> 'Unten rechts',
	'FILEMANAGER_WATERMARK_POSITION_SUFFIX'		=> 'oder',
	'FILEMANAGER_WATERMARK_PADDING'				=> 'Wasserzeichen Polsterung',
	'FILEMANAGER_WATERMARK_PADDING_EXPLAIN'		=> 'Wenn Sie eine vordefinierte Position verwenden, können Sie die Füllung von den Kanten anpassen. Wenn Sie Koordinaten verwenden, wird dieser Wert ignoriert',

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

	'NAVIGATION_SETTINGS'	=> 'Navigations-Einstellungen',
	'NO_NAVBAR'				=> 'Keine',

	'SELECT_NAVBAR_MENU'		=> 'Hauptnavigationsmenü auswählen',
	'SETTINGS_SAVED'			=> 'Ihre Einstellungen wurden gespeichert',
	'SHOW'						=> 'Anzeigen',
	'SHOW_FORUM_NAV'			=> '\'Forum\' in der Navigationsleiste anzeigen?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Wenn eine Seite als Startseite anstelle des Forum-Index gesetzt ist, sollten wir \'Forum\' in der Navigationsleiste anzeigen',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Ja - mit Symbol:',
]);
