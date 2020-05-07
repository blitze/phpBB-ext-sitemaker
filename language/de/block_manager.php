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
	'ADD_BLOCK_EXPLAIN'							=> '*Drag and Drop Blöcke',
	'AJAX_ERROR'								=> 'Hoppla! Es gab einen Fehler bei der Bearbeitung Ihrer Anfrage. Bitte versuchen Sie es erneut.',
	'AJAX_LOADING'								=> 'Wird geladen...',
	'AJAX_PROCESSING'							=> 'Bearbeiten...',

	'BACKGROUND'								=> 'Hintergrund',
	'BLOCKS'									=> 'Blöcke',
	'BLOCKS_COPY_FROM'							=> 'Blöcke kopieren',
	'BLOCK_ACTIVE'								=> 'Aktiv',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Nur auf untergeordneten Routen anzeigen',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Auf untergeordneten Routen ausblenden',
	'BLOCK_CLASS'								=> 'CSS-Klasse',
	'BLOCK_CLASS_EXPLAIN'						=> 'Ändern Sie die Blockansicht mit CSS-Klassen',
	'BLOCK_DESIGN'								=> 'Erscheinung',
	'BLOCK_DISPLAY_TYPE'						=> 'Anzeige',
	'BLOCK_HIDE_TITLE'							=> 'Block-Titel ausblenden?',
	'BLOCK_INACTIVE'							=> 'Inaktiv',
	'BLOCK_NOT_FOUND'							=> 'Hoppla! Der angeforderte Blockdienst wurde nicht gefunden',
	'BLOCK_NO_DATA'								=> 'Keine Daten zum Anzeigen',
	'BLOCK_NO_ID'								=> 'Ups! Fehlende Block-Id',
	'BLOCK_PERMISSION'							=> 'Sichtbar von',
	'BLOCK_SHOW_ALWAYS'							=> 'Immer',
	'BLOCK_STATUS'								=> 'Status',
	'BLOCK_UPDATED'								=> 'Blockeinstellungen erfolgreich aktualisiert',

	'CANCEL'									=> 'Abbrechen',
	'CHILD_ROUTE'								=> 'Kind',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/my-article',
	'CLEAR'										=> 'Leeren',
	'COPY'										=> 'Kopieren',
	'COPY_BLOCKS'								=> 'Blöcke kopieren?',
	'COPY_BLOCKS_CONFIRM'						=> 'Sind Sie sicher, dass Sie Blöcke von einer anderen Seite kopieren möchten?<br /><br />Dies löscht alle vorhandenen Blöcke und deren Einstellungen für diese Seite und ersetzt sie mit den Blöcken der ausgewählten Seite.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'Wenn aktiviert, erben alle Seiten-Seiten, für die Sie keine Blöcke angegeben haben, die Blöcke vom Standardlayout. Sie können jedoch das Standardlayout für bestimmte Seiten mit den Optionen rechts überschreiben.',
	'DELETE'									=> 'Löschen',
	'DELETE_ALL_BLOCKS'							=> 'Alle Blöcke löschen',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'Sind Sie sicher, dass Sie alle Blöcke für diese Seite löschen möchten?',
	'DELETE_BLOCK'								=> 'Block löschen',
	'DELETE_BLOCK_CONFIRM'						=> 'Sind Sie sicher, dass Sie diesen Block löschen möchten?<br /><br /><br /><strong>Hinweis:</strong> Sie müssen die Layoutänderungen speichern, um diese dauerhaft zu machen.',

	'EDIT'										=> 'Editieren',
	'EDIT_BLOCK'								=> 'Block bearbeiten',
	'EXIT_EDIT_MODE'							=> 'Beende Bearbeitungsmodus',

	'FEED_PROBLEMS'								=> 'Es gab ein Problem bei der Verarbeitung des bereitgestellten rss/atom feed(s)',
	'FEED_URL_MISSING'							=> 'Bitte geben Sie mindestens einen RSS-/Atom-Feed an, um zu beginnen',
	'FIELD_INVALID'								=> 'Der angegebene Wert für das Feld “%s” hat ein ungültiges Format',
	'FIELD_REQUIRED'							=> '“%s” ist ein Pflichtfeld',
	'FIELD_TOO_LONG'							=> 'Der angegebene Wert für das Feld “%1$s” ist zu lang. Der maximal zulässige Wert ist %2$d.',
	'FIELD_TOO_SHORT'							=> 'Der angegebene Wert für das Feld “%1$s” ist zu kurz. Der Minimalwert ist %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'Blöcke auf dieser Seite nicht anzeigen',
	'HIDE_BLOCK_POSITIONS'						=> 'Blöcke für die folgenden Blockpositionen nicht anzeigen:',

	'IMAGES'									=> 'Bilder',

	'LAYOUT'									=> 'Absteckung',
	'LAYOUT_SAVED'								=> 'Layout erfolgreich gespeichert!',
	'LAYOUT_SETTINGS'							=> 'Layout-Einstellungen',
	'LEAVE_CONFIRM'								=> 'Sie haben einige ungespeicherte Änderungen an dieser Seite. Bitte speichern Sie Ihre Arbeit, bevor Sie weitermachen',
	'LISTS'										=> 'Listen',

	'MAKE_DEFAULT_LAYOUT'						=> 'Als Standardlayout festlegen',

	'OR'										=> '<strong>ODER</strong>',

	'PARENT_ROUTE'								=> 'Elternteil',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/articles',
	'PREDEFINED_CLASSES'						=> 'Vordefinierte Klassen',

	'REDO'										=> 'Wiederholen',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Als Standardlayout entfernen',
	'REMOVE_STARTPAGE'							=> 'Startseite entfernen',
	'ROUTE_HIDDEN_BLOCKS'						=> 'Blöcke werden für diese Seite ausgeblendet',
	'ROUTE_HIDDEN_POSITIONS'					=> 'Blöcke werden für die folgenden Positionen ausgeblendet',
	'ROUTE_UPDATED'								=> 'Seiteneinstellungen erfolgreich aktualisiert',

	'SAVE_CHANGES'								=> 'Änderungen speichern',
	'SAVE_SETTINGS'								=> 'Einstellungen speichern',
	'SELECT_ICON'								=> 'Symbol auswählen',
	'SETTINGS'									=> 'Einstellungen',
	'SETTING_TOO_BIG'							=> 'Der angegebene Wert für die Einstellung “%1$s” ist zu hoch. Der maximal akzeptable Wert ist %2$d.',
	'SETTING_TOO_LONG'							=> 'Der angegebene Wert für die Einstellung “%1$s” ist zu lang. Die maximal zulässige Länge beträgt %2$d.',
	'SETTING_TOO_LOW'							=> 'Der angegebene Wert für die Einstellung “%1$s” ist zu niedrig. Der Minimalwert ist %2$d.',
	'SETTING_TOO_SHORT'							=> 'Der angegebene Wert für die Einstellung “%1$s” ist zu kurz. Die minimale zulässige Länge beträgt %2$d.',
	'SET_STARTPAGE'								=> 'Als Startseite festlegen',

	'TITLES'									=> 'Titel',

	'UPDATE_SIMILAR'							=> 'Aktualisiere Blöcke mit ähnlichen Einstellungen',
	'UNDO'										=> 'Rückgängig',

	'VIEW_DEFAULT_LAYOUT'						=> 'Standardlayout anzeigen/bearbeiten',
	'VISIT_PAGE'								=> 'Seite besuchen',
));
