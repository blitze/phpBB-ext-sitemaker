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
	'AUTO_LOGIN'								=> 'Auto-Login erlauben?',
	'FILE_MANAGER'								=> 'Dateimanager',
	'TOPIC_POST_IDS'							=> 'Von Thema/Beitrags-Ids',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(s) von Themen/Beiträgen zum Abrufen von Anhängen, getrennt durch <strong>Kommas</strong>(,). Legen Sie fest, ob diese Liste für Thema oder Beitrags-IDs oben ist.',
	'TOPIC_POST_IDS_TYPE'						=> 'Art der IDs (unten)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Anhänge',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Geburtstag',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Eigener Block',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Empfohlene Mitglieder',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'RSS/Atom-Feeds',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Forum Umfrage',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Forenthemen',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Google Maps',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Beliebte Themen',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Links',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Login-Box',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Mitglieder',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Mitgliedermenü',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Menü',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Meine Lesezeichen',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Letzte Einträge',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Statistiken',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Stil-Wechsler',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Was ist neu?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Wer ist online',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Wortgraf',

	// block views
	'BLOCK_VIEW'								=> 'Blockansicht',
	'BLOCK_VIEW_BASIC'							=> 'Einfache',
	'BLOCK_VIEW_BOXED'							=> 'Boxen',
	'BLOCK_VIEW_DEFAULT'						=> 'Standard',
	'BLOCK_VIEW_SIMPLE'							=> 'Einfache',

	'CACHE_DURATION'							=> 'Cache-Dauer',
	'CONTEXT'									=> 'Kontext',
	'CSS_SCRIPTS'								=> 'CSS-Skripte',
	'CUSTOM_PROFILE_FIELDS'						=> 'Benutzerdefinierte Profilfelder',

	'DATE_RANGE'								=> 'Datumsbereich',
	'DISPLAY_PREVIEW'							=> 'Vorschau anzeigen?',

	'EDIT_ME'									=> 'Bitte bearbeiten Sie mich',
	'ENABLE_TOPIC_TRACKING'						=> 'Themenverfolgung aktivieren?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Wenn aktiviert, werden ungelesene Themen angezeigt, aber die Blockergebnisse werden nicht zwischengespeichert <strong>(Nicht empfohlen)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Du hast zu viele Wörter eingegeben, um sie auszuschließen. Die maximal mögliche Anzahl von Zeichen ist 255, du hast %s eingegeben.',
	'EXCLUDE_WORDS'								=> 'Wörter ausschließen',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Listet die Wörter auf, die du aus dem Wortschatz ausschließen möchtest, getrennt durch ein Komma (,). Maximal 255 Zeichen.',
	'EXPANDED'									=> 'Erweitert',
	'EXTENSION_GROUP'							=> 'Erweiterungsgruppe',

	'FEATURED_MEMBER_IDS'						=> 'Benutzer-IDs',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Kommaseparierte Liste von Nutzern (gilt nur für den Darstellungsmodus der empfohlenen Mitglieder)',
	'FEED_DATA_PREVIEW'							=> 'Feed-Daten',
	'FEED_ITEM_TEMPLATE'						=> 'Artikelvorlage',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS:</strong><br />
		<ul class="sm-list">
			<li>Zugriff auf Feed-Daten in <strong>Element</strong> Variable e. . itle</li>
			<li>Vorlage muss in <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Twig Syntax</a></li>
			<li>Klicken Sie auf <strong>Beispiele</strong> für Beispielvorlagen</li>
			<li>Benutzen <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> , um einen Tag aus dem Feed zu erhalten, den wir nicht zur Verfügung stellen. .<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<li>Twigs json_encode Filter verwenden, um den Inhalt des Arrays zu sehen. <strong><code>{{ get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Quelle',
	'FEED_URL_PLACEHOLDER'						=> 'http://beispiel.com/rss',
	'FEED_URLS'									=> 'Feed-URLs',
	'FIRST_POST_ONLY'							=> 'Nur erster Beitrag',
	'FIRST_POST_TIME'							=> 'Erste Beitragszeit',
	'FORUMS_GET_TYPE'							=> 'Typ abrufen',
	'FORUMS_MAX_TOPICS'							=> 'Maximale Themen/Beiträge',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Maximale Anzahl Zeichen pro Titel',
	'FREQUENCY'									=> 'Frequenz',
	'FULL'										=> 'Voll',
	'FULLSCREEN'								=> 'Vollbild',

	'GET_TYPE'									=> 'Thema/Beitrag anzeigen?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Benutze diesen Textbereich, um rohen HTML-Inhalt einzugeben.</strong><br />Bitte beachten Sie, dass alle hier geposteten Inhalte den benutzerdefinierten Block-Inhalt überschreiben und der visuelle Block-Editor nicht verfügbar ist.',
	'HOURS_SHORT'								=> 'h',

	'JS_SCRIPTS'								=> 'JS-Skripte',

	'LAST_POST_TIME'							=> 'Letzter Beitrag',
	'LAST_READ_TIME'							=> 'Letzte Lektüre',
	'LIMIT'										=> 'Begrenze',
	'LIMIT_FORUMS'								=> 'Forum-Ids (optional)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Geben Sie jede Forum-Id durch ein Komma (,) getrennt. Wenn gesetzt, werden nur Themen aus bestimmten Foren angezeigt.',
	'LIMIT_POST_TIME'							=> 'Nach Beitragszeit begrenzen',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Wenn gesetzt, werden nur Themen, die innerhalb des angegebenen Zeitraums gepostet wurden, abgerufen',

	'MAX_DEPTH'									=> 'Maximale Tiefe',
	'MAX_ITEMS'									=> 'Maximale Artikelanzahl',
	'MAX_MEMBERS'								=> 'Max. Mitglieder',
	'MAX_POSTS'									=> 'Maximale Anzahl von Beiträgen',
	'MAX_TOPICS'								=> 'Maximale Anzahl von Themen',
	'MAX_WORDS'									=> 'Maximale Anzahl von Wörtern',
	'MANAGE_MENUS'								=> 'Menüs verwalten',
	'MAP_COORDINATES'							=> 'Koordinaten',
	'MAP_COORDINATES_EXPLAIN'					=> 'Koordinaten in Form Breitengrad,Längengrad eingeben',
	'MAP_HEIGHT'								=> 'Höhe',
	'MAP_LOCATION'								=> 'Standort',
	'MAP_TITLE'									=> 'Titel',
	'MAP_VIEW'									=> 'Ansehen',
	'MAP_VIEW_HYBRID'							=> 'Hybrid',
	'MAP_VIEW_MAP'								=> 'Karte',
	'MAP_VIEW_SATELITE'							=> 'Satelite',
	'MAP_VIEW_TERRAIN'							=> 'Gelände',
	'MAP_ZOOM_LEVEL'							=> 'Zoomstufe',
	'MEMBERS_DATE'								=> 'Datum',
	'MENU_NO_ITEMS'								=> 'Keine aktiven Elemente zum Anzeigen',
	'MINI'										=> 'Minisch',

	'OR'										=> '<strong>ODER</strong>',
	'ORDER_BY'									=> 'Sortieren nach',

	'POLL_FROM_FORUMS'							=> 'Umfragen aus Foren(en) anzeigen',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Nur Umfragen aus den ausgewählten Foren werden angezeigt, solange keine Themen oben angegeben sind',
	'POLL_FROM_GROUPS'							=> 'Umfragen aus Gruppe(n) anzeigen',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Nur Umfragen von Mitgliedern der ausgewählten Gruppen werden angezeigt, solange keine Benutzer oben angegeben sind',
	'POLL_FROM_TOPICS'							=> 'Umfragen aus Them(en) anzeigen',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(s) der Themen, von denen Umfragen abgerufen werden sollen, getrennt durch <strong>Kommata</strong>(,). Leer lassen, um ein Thema auszuwählen.',
	'POLL_FROM_USERS'							=> 'Umfragen von Benutzern anzeigen',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id(s) der Benutzer, deren Umfragen Sie anzeigen möchten, getrennt durch <strong>Kommas</strong>(,). Leer lassen, um Umfragen von jedem Benutzer auszuwählen.',
	'POSTS_TITLE_LIMIT'							=> 'Maximale Anzahl von Zeichen für Beitragstitel',
	'PREVIEW_MAX_CHARS'							=> 'Anzahl der Zeichen für die Vorschau',

	'QUERY_TYPE'								=> 'Anzeigemodus',

	'ROTATE_DAILY'								=> 'Täglich',
	'ROTATE_HOURLY'								=> 'Stündlich',
	'ROTATE_MONTHLY'							=> 'Monatlich',
	'ROTATE_PAGELOAD'							=> 'Seitenlast',
	'ROTATE_WEEKLY'								=> 'Wöchentlich',

	'SAMPLES'									=> 'Muster',
	'SCRIPTS'									=> 'Skripte',
	'SELECT_FORUMS'								=> 'Foren auswählen',
	'SELECT_FORUMS_EXPLAIN'						=> 'Wählen Sie die Foren, aus denen Themen/Beiträge angezeigt werden sollen. Leer lassen um aus allen Foren auszuwählen',
	'SELECT_MENU'								=> 'Menü auswählen',
	'SELECT_PROFILE_FIELDS'						=> 'Profilfelder auswählen',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Wenn vorhanden, werden nur die ausgewählten Profilfelder angezeigt.',
	'SHOW_FIRST_POST'							=> 'Erster Beitrag',
	'SHOW_HIDE_ME'								=> 'Ausblenden des Online-Status erlauben?',
	'SHOW_LAST_POST'							=> 'Letzter Beitrag',
	'SHOW_MEMBER_MENU'							=> 'Benutzermenü anzeigen?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Login-Box durch Benutzermenü ersetzen, wenn der Benutzer eingeloggt ist',
	'SHOW_WORD_COUNT'							=> 'Anzahl der Wörter anzeigen?',

	'TEMPLATE'									=> 'Vorlage',
	'TOPIC_TITLE_LIMIT'							=> 'Maximale Anzahl von Zeichen für Titel des Themas',
	'TOPIC_TYPE'								=> 'Thementyp',
	'TOPIC_TYPE_EXPLAIN'						=> 'Wählen Sie die Thementypen, die Sie anzeigen möchten. Lassen Sie die Kästchen unausgewählt, um aus allen Thementypen auszuwählen',
	'TOPICS_LOOK_BACK'							=> 'Rückblick',
	'TOPICS_ONLY'								=> 'Nur Themen?',
	'TOPICS_PER_PAGE'							=> 'Pro Seite',

	'WORD_MAX_SIZE'								=> 'Maximale Schriftgröße',
	'WORD_MIN_SIZE'								=> 'Minimale Schriftgröße',
));
