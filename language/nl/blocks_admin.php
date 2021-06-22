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
	'ALL_TYPES'									=> 'Alle typen',
	'ALL_GROUPS'								=> 'Alle groepen',
	'ARCHIVES'									=> 'Archief',
	'AUTO_LOGIN'								=> 'Automatisch inloggen toestaan?',
	'FILE_MANAGER'								=> 'Bestands Beheer',
	'TOPIC_POST_IDS'							=> 'Van onderwerp/Post Ids',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(s) van topics/berichten om bijlagen op te halen, gescheiden door <strong>komma\'s</strong>(,). Geef aan of deze lijst is voor een topic of post id\'s hierboven.',
	'TOPIC_POST_IDS_TYPE'						=> 'Type ID\'s (hieronder)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Bijlagen',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Verjaardag',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Aangepaste blok',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Aanbevolen Lid',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'RSS/Atom Feeds',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Forum poll',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Forum Onderwerpen',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Google Maps',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Populaire onderwerpen',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Koppelingen',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Login Box',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'leden',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Lid Menu',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Menu',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Bladwijzers',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Recente Onderwerpen',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Statistieken',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Stijl schakelaar',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Wat is nieuw?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Wie is online',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Wordgraph',

	// block views
	'BLOCK_VIEW'								=> 'Blok weergave',
	'BLOCK_VIEW_BASIC'							=> 'Eenvoudig',
	'BLOCK_VIEW_BOXED'							=> 'Geboxed',
	'BLOCK_VIEW_DEFAULT'						=> 'Standaard',
	'BLOCK_VIEW_SIMPLE'							=> 'Eenvoudig',

	'CACHE_DURATION'							=> 'Cache duur',
	'CONTEXT'									=> 'Context',
	'CSS_SCRIPTS'								=> 'CSS Scripts',
	'CUSTOM_PROFILE_FIELDS'						=> 'Aangepaste profielvelden',

	'DATE_RANGE'								=> 'Date Range',
	'DISPLAY_PREVIEW'							=> 'Voorbeeld weergeven?',

	'EDIT_ME'									=> 'Bewerk me alsjeblieft',
	'ENABLE_TOPIC_TRACKING'						=> 'Topic tracking inschakelen?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Indien ingeschakeld, worden ongelezen onderwerpen aangeduid, maar de blokresultaten worden niet gecached <strong>(Niet aanbevolen)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Je hebt te veel woorden ingevoerd om uit te sluiten. Het maximum aantal tekens is 255, je hebt %s ingevoerd.',
	'EXCLUDE_WORDS'								=> 'Woorden uitsluiten',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Vermeld de woorden die je wilt uitsluiten van de woordenlijst, gescheiden door een komma (,). Maximaal 255 tekens.',
	'EXPANDED'									=> 'Uitgebreid',
	'EXTENSION_GROUP'							=> 'Extensie groep',

	'FEATURED_MEMBER_IDS'						=> 'Gebruiker IDs',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Kommagescheiden lijst van te gebruiken gebruikers (alleen van toepassing op Aanbevolen Leden weergavemodus)',
	'FEED_DATA_PREVIEW'							=> 'Feed gegevens',
	'FEED_ITEM_TEMPLATE'						=> 'Item sjabloon',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS:</strong><br />
		<ul class="sm-list">
			<li>Access feed data in <strong>item</strong> variable e.g. item.title</li>
			<li>Template must be in <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Twig syntax</a></li>
			<li>Click <strong>Samples</strong> above for sample templates</li>
			<li>Use <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> to get any tag from the feed that we do not provide e.g.<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<li>Use Twig’s json_encode filter to see contents of array e.g. <strong><code>{{ get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Bron',
	'FEED_URL_PLACEHOLDER'						=> 'http://voorbeeld.com/rss',
	'FEED_URLS'									=> 'Feed URL\'s',
	'FIRST_POST_ONLY'							=> 'Eerste bericht alleen',
	'FIRST_POST_TIME'							=> 'Eerste Post Tijd',
	'FORUMS_GET_TYPE'							=> 'Soort ophalen',
	'FORUMS_MAX_TOPICS'							=> 'Maximum aantal onderwerpen/berichten',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Maximaal aantal tekens per titel',
	'FREQUENCY'									=> 'Frequentie',
	'FULL'										=> 'Volledig',
	'FULLSCREEN'								=> 'Volledig scherm',

	'GET_TYPE'									=> 'Toon onderwerp/Post?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Gebruik deze tekst om onbewerkte HTML-inhoud in te voeren.</strong><br />Houd er rekening mee dat alle hier geplaatste inhoud de aangepaste blokinhoud overschrijft en dat de visuele blokeditor niet beschikbaar is.',
	'HOURS_SHORT'								=> 'Uren',

	'JS_SCRIPTS'								=> 'JS Scripts',

	'LAST_POST_TIME'							=> 'Laatste Post Tijd',
	'LAST_READ_TIME'							=> 'Laatst Gelezen Tijd',
	'LIMIT'										=> 'Limiet',
	'LIMIT_FORUMS'								=> 'Forum Ids (optioneel)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Voer elk forum-id in, gescheiden door een komma (,). Indien ingesteld, worden alleen onderwerpen van de opgegeven forums weergegeven.',
	'LIMIT_POST_TIME'							=> 'Beperken op tijd Post',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Indien actief zullen alleen topics die binnen de opgegeven periode zijn geplaatst worden opgehaald',

	'MAX_DEPTH'									=> 'Maximale diepte',
	'MAX_ITEMS'									=> 'Maximum aantal items',
	'MAX_MEMBERS'								=> 'Max. aantal leden',
	'MAX_POSTS'									=> 'Maximum aantal berichten',
	'MAX_TOPICS'								=> 'Maximum aantal onderwerpen',
	'MAX_WORDS'									=> 'Maximum aantal woorden',
	'MANAGE_MENUS'								=> 'Menu\'s beheren',
	'MAP_COORDINATES'							=> 'Coördinaten',
	'MAP_COORDINATES_EXPLAIN'					=> 'Voer coördinaten in de vorm breedtegraad, lengtegraad',
	'MAP_HEIGHT'								=> 'Højde',
	'MAP_LOCATION'								=> 'Locatie',
	'MAP_TITLE'									=> 'Aanspreektitel',
	'MAP_VIEW'									=> 'Bekijken',
	'MAP_VIEW_HYBRID'							=> 'Hybride',
	'MAP_VIEW_MAP'								=> 'Kaart',
	'MAP_VIEW_SATELITE'							=> 'Sateliet',
	'MAP_VIEW_TERRAIN'							=> 'Terrain',
	'MAP_ZOOM_LEVEL'							=> 'Zoom niveau',
	'MEMBERS_DATE'								=> 'Datum:',
	'MENU_NO_ITEMS'								=> 'Geen actieve items om weer te geven',
	'MINI'										=> 'Mini',

	'OR'										=> '<strong>OF</strong>',
	'ORDER_BY'									=> 'Sorteer op',

	'POLL_FROM_FORUMS'							=> 'Toon polls van forum(s)',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Alleen enquêtes van de geselecteerde forums worden weergegeven zolang er geen onderwerpen hierboven zijn gespecificeerd',
	'POLL_FROM_GROUPS'							=> 'Toon polls van groep(en)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Alleen opiniepeilingen van deelnemers van de geselecteerde groepen worden weergegeven zolang er geen gebruiker(s) zijn/zijn opgegeven hierboven',
	'POLL_FROM_TOPICS'							=> 'Toon polls van topic(s)',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(s) van topics om polls op te halen, gescheiden door <strong>komma\'s</strong>(,). Laat leeg om een onderwerp te selecteren.',
	'POLL_FROM_USERS'							=> 'Toon polls van gebruiker(s)',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id(s) van gebruiker(s) waarvan je polls wil weergeven, gescheiden door <strong>komma\'s</strong>(,). Laat leeg om polls van elke gebruiker te selecteren.',
	'POSTS_TITLE_LIMIT'							=> 'Maximaal aantal tekens voor post titel',
	'PREVIEW_MAX_CHARS'							=> 'Aantal voorvertoning tekens',

	'QUERY_TYPE'								=> 'Toon modus',

	'ROTATE_DAILY'								=> 'Dagelijks',
	'ROTATE_HOURLY'								=> 'Per uur',
	'ROTATE_MONTHLY'							=> 'maandelijks',
	'ROTATE_PAGELOAD'							=> 'Pagina laden',
	'ROTATE_WEEKLY'								=> 'wekelijks',

	'SAMPLES'									=> 'Voorbeelden',
	'SCRIPTS'									=> 'Scripts',
	'SELECT_FORUMS'								=> 'Selecteer forums',
	'SELECT_FORUMS_EXPLAIN'						=> 'Selecteer het forum waar onderwerpen en berichten getoond worden. Laat leeg om alle forums te selecteren',
	'SELECT_MENU'								=> 'Selecteer menu',
	'SELECT_PROFILE_FIELDS'						=> 'Profielvelden selecteren',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Alleen de geselecteerde profielvelden worden weergegeven, indien beschikbaar.',
	'SHOW_FIRST_POST'							=> 'Eerste bericht',
	'SHOW_HIDE_ME'								=> 'Verberg online status toestaan?',
	'SHOW_LAST_POST'							=> 'Laatste bericht',
	'SHOW_MEMBER_MENU'							=> 'Gebruikersmenu tonen?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Vervang inlogveld met gebruikersmenu als de gebruiker is ingelogd',
	'SHOW_WORD_COUNT'							=> 'Aantal woorden tonen?',

	'TEMPLATE'									=> 'Sjabloon',
	'TOPIC_TITLE_LIMIT'							=> 'Maximaal aantal tekens voor onderwerp titel',
	'TOPIC_TYPE'								=> 'Onderwerp type',
	'TOPIC_TYPE_EXPLAIN'						=> 'Selecteer de topictypes die u wilt weergeven. Laat de vakjes niet aangevinkt om alle topictypen te selecteren',
	'TOPICS_LOOK_BACK'							=> 'Terugkijken',
	'TOPICS_ONLY'								=> 'Alleen onderwerpen?',
	'TOPICS_PER_PAGE'							=> 'Per pagina',

	'WORD_MAX_SIZE'								=> 'Maximale lettergrootte',
	'WORD_MIN_SIZE'								=> 'Minimale lettergrootte',
));
