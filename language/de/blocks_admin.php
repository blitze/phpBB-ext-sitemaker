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
	'ALL_TYPES'									=> 'Alle Typen',
	'ALL_GROUPS'								=> 'Alle Gruppen',
	'ARCHIVES'									=> 'Archive',
	'AUTO_LOGIN'								=> 'Automatische Anmeldung erlauben?',
	'FILE_MANAGER'								=> 'Datei-Manager',
	'TOPIC_POST_IDS'							=> 'Von Themen/Beitrags-Ids',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(s) von Themen/Beiträgen, von denen Anhänge abgerufen werden sollen, getrennt durch <strong>Kommas</strong>(,). Geben Sie an, ob diese Liste für Themen- oder Post-IDs oben ist.',
	'TOPIC_POST_IDS_TYPE'						=> 'Typ der IDs (unten)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Anhänge',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Geburtstag',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Eigener Block',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Empfohlenes Mitglied',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'RSS/Atom-Feeds',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Umfrage im Forum',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Forenthemen',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Google Maps',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Beliebte Themen',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Links',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Login-Box',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Mitglieder',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Mitgliedermenü',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Menü',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Meine Lesezeichen',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Aktuelle Themen',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Statistiken',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Stil-Umschalter',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Was ist Neu?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Wer ist online',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Wordgraph',

	// block views
	'BLOCK_VIEW'								=> 'Blockansicht',
	'BLOCK_VIEW_BASIC'							=> 'Einfache',
	'BLOCK_VIEW_BOXED'							=> 'Kisten',
	'BLOCK_VIEW_DEFAULT'						=> 'Standard',
	'BLOCK_VIEW_SIMPLE'							=> 'Einfach',

	'CACHE_DURATION'							=> 'Cache-Dauer',
	'CONTEXT'									=> 'Kontext',
	'CSS_SCRIPTS'								=> 'CSS Scripts',
	'CUSTOM_PROFILE_FIELDS'						=> 'Benutzerdefinierte Profilfelder',

	'DATE_RANGE'								=> 'Date Range',
	'DISPLAY_PREVIEW'							=> 'Vorschau anzeigen?',

	'EDIT_ME'									=> 'Bitte bearbeiten',
	'ENABLE_TOPIC_TRACKING'						=> 'Themen-Tracking aktivieren?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Wenn aktiviert, werden ungelesene Themen angezeigt, aber die Blockergebnisse werden nicht zwischengespeichert <strong>(Nicht empfohlen)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Sie haben zu viele Wörter eingegeben, um sie auszuschließen. Die maximal mögliche Anzahl an Zeichen ist 255, Sie haben %s eingegeben.',
	'EXCLUDE_WORDS'								=> 'Wörter ausschließen',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Listet die Wörter auf, die Sie aus dem durch Komma (,) getrennten Wortbild ausschließen möchten. Maximal 255 Zeichen.',
	'EXPANDED'									=> 'Erweitert',
	'EXTENSION_GROUP'							=> 'Erweiterungsgruppe',

	'FEATURED_MEMBER_IDS'						=> 'Benutzer-IDs',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Kommagetrennte Liste der zu aktivierenden Benutzer (gilt nur für den Modus Empfohlene Mitgliederanzeige)',
	'FEED_DATA_PREVIEW'							=> 'Feed-Daten',
	'FEED_ITEM_TEMPLATE'						=> 'Artikelvorlage',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS:</strong><br />
		<ul class="sm-list">
			<li>Zugriffsdaten in <strong>Artikel</strong> Variable e. . itle</li>
			<li>Template muss in <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Twig Syntax</a></li>
			<li>Klicken Sie auf <strong>Beispiele</strong> oben für Beispielvorlagen</li>
			<li>Verwenden Sie <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> , um einen Tag aus dem Feed zu erhalten, den wir nicht zur Verfügung stellen. .<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<li>Verwenden Sie Twigs json_encode Filter, um den Inhalt des Arrays zu sehen. . <strong><code>{{ get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Quelle',
	'FEED_URL_PLACEHOLDER'						=> 'http://example.com/rss',
	'FEED_URLS'									=> 'Feed URLs',
	'FIRST_POST_ONLY'							=> 'Nur erster Beitrag',
	'FIRST_POST_TIME'							=> 'Erster Beitrag',
	'FORUMS_GET_TYPE'							=> 'Typ abrufen',
	'FORUMS_MAX_TOPICS'							=> 'Maximale Themen/Beiträge',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Maximale Zeichen pro Titel',
	'FREQUENCY'									=> 'Frequenz',
	'FULL'										=> 'Voll',
	'FULLSCREEN'								=> 'Vollbild',

	'GET_TYPE'									=> 'Thema/Beitrag anzeigen?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Benutzen Sie diesen Textbereich, um den HTML-Inhalt in Rohform einzugeben.</strong><br />Bitte beachten Sie, dass alle hier geposteten Inhalte den benutzerdefinierten Blockinhalt überschreiben und der visuelle Blockeditor nicht verfügbar sein wird.',
	'HOURS_SHORT'								=> 'std',

	'JS_SCRIPTS'								=> 'JS-Skripte',

	'LAST_POST_TIME'							=> 'Letzte Beitragszeit',
	'LAST_READ_TIME'							=> 'Letzte Lese-Zeit',
	'LIMIT'										=> 'Limit',
	'LIMIT_FORUMS'								=> 'Forum-Ids (optional)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Geben Sie jede Forum-Id durch ein Komma (,) getrennt ein. Wenn gesetzt, werden nur Themen aus bestimmten Foren angezeigt.',
	'LIMIT_POST_TIME'							=> 'Limit nach Beitragszeit',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Wenn gesetzt, werden nur Themen, die innerhalb des angegebenen Zeitraums gepostet werden abgerufen',

	'MAX_DEPTH'									=> 'Maximale Tiefe',
	'MAX_ITEMS'									=> 'Maximale Anzahl von Artikeln',
	'MAX_MEMBERS'								=> 'Max. Mitglieder',
	'MAX_POSTS'									=> 'Maximale Anzahl von Beiträgen',
	'MAX_TOPICS'								=> 'Maximale Anzahl von Themen',
	'MAX_WORDS'									=> 'Maximale Anzahl Wörter',
	'MANAGE_MENUS'								=> 'Menüs verwalten',
	'MAP_COORDINATES'							=> 'Koordinaten',
	'MAP_COORDINATES_EXPLAIN'					=> 'Geben Sie die Koordinaten im Format Breite, Längengrad ein',
	'MAP_HEIGHT'								=> 'Höhe',
	'MAP_LOCATION'								=> 'Standort',
	'MAP_TITLE'									=> 'Titel',
	'MAP_VIEW'									=> 'Ansicht',
	'MAP_VIEW_HYBRID'							=> 'Hybrid',
	'MAP_VIEW_MAP'								=> 'Karte',
	'MAP_VIEW_SATELITE'							=> 'Satelite',
	'MAP_VIEW_TERRAIN'							=> 'Terrain',
	'MAP_ZOOM_LEVEL'							=> 'Zoomstufe',
	'MEMBERS_DATE'								=> 'Datum',
	'MENU_NO_ITEMS'								=> 'Keine aktiven Elemente zum Anzeigen',
	'MINI'										=> 'Mini',

	'OR'										=> '<strong>ODER</strong>',
	'ORDER_BY'									=> 'Sortieren nach',

	'POLL_FROM_FORUMS'							=> 'Umfragen von Foren(n) anzeigen',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Nur Umfragen aus den ausgewählten Foren werden angezeigt, solange keine Themen oben angegeben werden',
	'POLL_FROM_GROUPS'							=> 'Umfragen von Gruppe(n) anzeigen',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Nur Umfragen von Mitgliedern der ausgewählten Gruppen werden angezeigt, solange keine Benutzer oben angegeben sind',
	'POLL_FROM_TOPICS'							=> 'Umfragen von Theme(n) anzeigen',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(s) von Themen, von denen Umfragen abgerufen werden sollen, getrennt durch <strong>Kommas</strong>(,). Leer lassen um ein Thema auszuwählen.',
	'POLL_FROM_USERS'							=> 'Umfragen von Benutzer anzeigen',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id(e) der Benutzer, deren Umfragen Sie anzeigen möchten, getrennt durch <strong>Kommas</strong>(,). Lassen Sie leer, um Umfragen von jedem Benutzer auszuwählen.',
	'POSTS_TITLE_LIMIT'							=> 'Maximale Anzahl der Zeichen für den Beitragstitel',
	'PREVIEW_MAX_CHARS'							=> 'Anzahl der Zeichen für die Vorschau',

	'QUERY_TYPE'								=> 'Anzeigemodus',

	'ROTATE_DAILY'								=> 'Täglich',
	'ROTATE_HOURLY'								=> 'Stunden',
	'ROTATE_MONTHLY'							=> 'Monatlich',
	'ROTATE_PAGELOAD'							=> 'Seitenlade',
	'ROTATE_WEEKLY'								=> 'Wöchentlich',

	'SAMPLES'									=> 'Muster',
	'SCRIPTS'									=> 'Skripte',
	'SELECT_FORUMS'								=> 'Foren auswählen',
	'SELECT_FORUMS_EXPLAIN'						=> 'Wählen Sie die Foren aus, aus denen Themen und Beiträge angezeigt werden sollen. Lassen Sie leer, um aus allen Foren auszuwählen',
	'SELECT_MENU'								=> 'Menü auswählen',
	'SELECT_PROFILE_FIELDS'						=> 'Profilfelder auswählen',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Wenn vorhanden, werden nur die ausgewählten Profilfelder angezeigt.',
	'SHOW_FIRST_POST'							=> 'Erster Beitrag',
	'SHOW_HIDE_ME'								=> 'Online-Status ausblenden?',
	'SHOW_LAST_POST'							=> 'Letzter Beitrag',
	'SHOW_MEMBER_MENU'							=> 'Benutzermenü anzeigen?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Ersetzen Sie die Login-Box durch das Benutzer-Menü, wenn der Benutzer angemeldet ist',
	'SHOW_WORD_COUNT'							=> 'Wortzahl anzeigen?',

	'TEMPLATE'									=> 'Vorlage',
	'TOPIC_TITLE_LIMIT'							=> 'Maximale Anzahl der Zeichen für Titel des Themas',
	'TOPIC_TYPE'								=> 'Thementyp',
	'TOPIC_TYPE_EXPLAIN'						=> 'Wählen Sie die Thementypen aus, die angezeigt werden sollen. Lassen Sie die Kästchen deaktiviert, um von allen Thementypen auszuwählen',
	'TOPICS_LOOK_BACK'							=> 'Rückblick',
	'TOPICS_ONLY'								=> 'Nur Themen?',
	'TOPICS_PER_PAGE'							=> 'Pro Seite',

	'WORD_MAX_SIZE'								=> 'Maximale Schriftgröße',
	'WORD_MIN_SIZE'								=> 'Minimale Schriftgröße',
));
