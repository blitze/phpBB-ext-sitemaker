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
	'ACP_MENU'					=> 'Menü',
	'ACP_MENU_MANAGE'			=> 'Menü-Management',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Hier können Sie Menüs für Ihre Website erstellen und verwalten',
	'ADD_BULK_MENU'				=> 'Mengeneinträge hinzufügen',
	'ADD_BULK_MENU_EXPLAIN'		=> 'Mehrere Menüpunkte auf einmal hinzufügen.<br /> - Platzieren Sie jedes Element in einer separaten Zeile<br /> - Verwenden Sie den <strong>Tab</strong> Schlüssel zum Einrücken von Einrückungen, um Eltern-Kind-Beziehungen zu repräsentieren<br /> - Geben Sie Element und URL wie folgt ein|index.php',
	'ADD_MENU'					=> 'Menü hinzufügen',
	'ADD_MENU_ITEM'				=> 'Menüpunkt hinzufügen',
	'ADD_ITEM'					=> 'Neues Element',
	'AJAX_PROCESSING'			=> 'Arbeiten',

	'CHANGE_ME'					=> 'Ändere mich',

	'DELETE_ITEM'				=> 'Element löschen',
	'DELETE_KIDS'				=> 'Zweig löschen',
	'DELETE_MENU'				=> 'Menü löschen',
	'DELETE_MENU_CONFIRM'		=> 'Sind Sie sicher, dass Sie dieses Menü löschen möchten?<br />Dadurch wird das Menü und alle darin enthaltenen Elemente gelöscht',
	'DELETE_MENU_ITEM'			=> 'Element löschen',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Sind Sie sicher, dass Sie diesen Menüpunkt löschen möchten?',
	'DELETE_SELECTED'			=> 'Ausgewählte löschen',

	'EDIT_ITEM'					=> 'Element bearbeiten',

	'ITEM_ACTIVE'				=> 'Aktiv',
	'ITEM_INACTIVE'				=> 'Inaktiv',
	'ITEM_PARENT'				=> 'Elternteil',
	'ITEM_TITLE'				=> 'Artikeltitel',
	'ITEM_TITLE_EXPLAIN'		=> 'Als \'-\' für Trenner festlegen',
	'ITEM_TARGET'				=> 'Objektziel',
	'ITEM_URL'					=> 'Artikel-URL',
	'ITEM_URL_EXPLAIN'			=> '- Leer lassen für Überschriften<br />- Externe Seiten müssen mit http(s)://, ftp://, //, etc beginnen',

	'MENU_ITEMS'				=> 'Menüpunkte',

	'NO_MENU_ITEMS'				=> 'Es wurden keine Menüpunkte erstellt',
	'NO_PARENT'					=> 'Kein Elternteil',

	'PROCESSING_ERROR'			=> 'Verarbeitungsfehler',

	'REBUILD_TREE'				=> 'Baum neu aufbauen',
	'REQUIRED'					=> 'Erforderlich',
	'REQUIRED_FIELDS'			=> '* Benötigte Felder',

	'SAVE_CHANGES'				=> 'Änderungen speichern',
	'SAVE'						=> 'Speichern',
	'SELECT_ALL'				=> 'Alles auswählen',

	'TARGET_BLANK'				=> 'Leere Seite',
	'TARGET_PARENT'				=> 'Elternteil',

	'UNSAVED_CHANGES'			=> 'Sie haben ungespeicherte Änderungen',

	'VISIT_PAGE'				=> 'Seite besuchen',
));
