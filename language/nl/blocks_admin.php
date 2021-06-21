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
	'ARCHIVES'									=> 'Archieven',
	'AUTO_LOGIN'								=> 'Automatisch inloggen toestaan?',
	'FILE_MANAGER'								=> 'Bestandsbeheer',
	'TOPIC_POST_IDS'							=> 'Van onderwerp/post Ids',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(s) van topics/posts om bijlagen op te halen, gescheiden door <strong>komma\'s</strong>(,). Geef aan of deze lijst voor topic of ids hierboven is.',
	'TOPIC_POST_IDS_TYPE'						=> 'Type ID\'s (hieronder)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Bijlagen',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Verjaardag',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Eigen blok',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Aanbevolen lid',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'RSS/Atom Feeds',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Forumpoll',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Forumonderwerpen',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Google Maps',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Populaire onderwerpen',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Links',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Inlogbox',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Deelnemers',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Lid menu',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Menu',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Mijn bladwijzers',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Recente Onderwerpen',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Statistieken',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Stijl wisselaar',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Wat is er nieuw?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Wie is online',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Wordgrafiek',

	// block views
	'BLOCK_VIEW'								=> 'Blok Weergave',
	'BLOCK_VIEW_BASIC'							=> 'Basis',
	'BLOCK_VIEW_BOXED'							=> 'Geboekt',
	'BLOCK_VIEW_DEFAULT'						=> 'Standaard',
	'BLOCK_VIEW_SIMPLE'							=> 'Eenvoudig',

	'CACHE_DURATION'							=> 'Cacheduur',
	'CONTEXT'									=> 'Context',
	'CSS_SCRIPTS'								=> 'CSS-scripts',
	'CUSTOM_PROFILE_FIELDS'						=> 'Aangepaste profielvelden',

	'DATE_RANGE'								=> 'Datumbereik',
	'DISPLAY_PREVIEW'							=> 'Toon voorbeeld?',

	'EDIT_ME'									=> 'Bewerk mij alstublieft',
	'ENABLE_TOPIC_TRACKING'						=> 'Onderwerp bijhouden inschakelen?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Indien ingeschakeld, zullen ongelezen topics worden aangegeven, maar de blokresultaten zullen niet gecached worden <strong>(Niet aanbevolen)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Je hebt te veel woorden ingevoerd om uit te sluiten. Het maximum aantal tekens dat mogelijk is is 255, je hebt %s ingevoerd.',
	'EXCLUDE_WORDS'								=> 'Woorden uitsluiten',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Lijst van de woorden die u wilt uitsluiten van de woordgrafiek gescheiden door een komma (,). Maximaal 255 tekens.',
	'EXPANDED'									=> 'Uitgebreid',
	'EXTENSION_GROUP'							=> 'Extensiegroep',

	'FEATURED_MEMBER_IDS'						=> 'Gebruikers-IDs',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Door komma\'s gescheiden lijst van gebruikers voor functies (is alleen van toepassing op Uitgelichte leden weergavemodus)',
	'FEED_DATA_PREVIEW'							=> 'Feed Data',
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
	'FEED_URLS'									=> 'Feed-URLs',
	'FIRST_POST_ONLY'							=> 'Alleen eerste post',
	'FIRST_POST_TIME'							=> 'Eerste Post tijd',
	'FORUMS_GET_TYPE'							=> 'Type ophalen',
	'FORUMS_MAX_TOPICS'							=> 'Maximum topics/berichten',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Maximum tekens per titel',
	'FREQUENCY'									=> 'Frequentie',
	'FULL'										=> 'Volledig',
	'FULLSCREEN'								=> 'Volledig scherm',

	'GET_TYPE'									=> 'Toon discussie/Post?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Gebruik deze textarea om rauwe HTML-inhoud in te voeren.</strong><br />Houd er rekening mee dat alle hier geplaatste inhoud de aangepaste blokinhoud overschrijft en dat de visuele block-editor niet beschikbaar is.',
	'HOURS_SHORT'								=> 'uur',

	'JS_SCRIPTS'								=> 'JS Scripts',

	'LAST_POST_TIME'							=> 'Laatste Post tijd',
	'LAST_READ_TIME'							=> 'Laatst gelezen tijd',
	'LIMIT'										=> 'Limiet',
	'LIMIT_FORUMS'								=> 'Forum-Ids (optioneel)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Voer elke forumid in gescheiden door een komma (,). Indien ingesteld, worden alleen onderwerpen van de opgegeven forums weergegeven.',
	'LIMIT_POST_TIME'							=> 'Beperken op tijd',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Indien ingesteld, zullen alleen onderwerpen geplaatst binnen de opgegeven periode worden opgehaald',

	'MAX_DEPTH'									=> 'Maximale diepte',
	'MAX_ITEMS'									=> 'Maximum aantal items',
	'MAX_MEMBERS'								=> 'Max. leden',
	'MAX_POSTS'									=> 'Maximaal aantal berichten',
	'MAX_TOPICS'								=> 'Maximaal aantal topics',
	'MAX_WORDS'									=> 'Maximum aantal woorden',
	'MANAGE_MENUS'								=> 'Menu\'s beheren',
	'MAP_COORDINATES'							=> 'Coördinaten',
	'MAP_COORDINATES_EXPLAIN'					=> 'Voer coördinaten in de vorm breedtegraad, lengtegraad',
	'MAP_HEIGHT'								=> 'Hoogte',
	'MAP_LOCATION'								=> 'Locatie',
	'MAP_TITLE'									=> 'Titel',
	'MAP_VIEW'									=> 'Weergave',
	'MAP_VIEW_HYBRID'							=> 'Hybride',
	'MAP_VIEW_MAP'								=> 'Kaart',
	'MAP_VIEW_SATELITE'							=> 'ateliet',
	'MAP_VIEW_TERRAIN'							=> 'Terrein',
	'MAP_ZOOM_LEVEL'							=> 'Zoomniveau',
	'MEMBERS_DATE'								=> 'Datum',
	'MENU_NO_ITEMS'								=> 'Geen actieve items om weer te geven',
	'MINI'										=> 'Mini',

	'OR'										=> '<strong>OF</strong>',
	'ORDER_BY'									=> 'Sorteer op',

	'POLL_FROM_FORUMS'							=> 'Toon polls van forums(s)',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Alleen opiniepeilingen van de geselecteerde forums zullen worden weergegeven zolang hierboven geen topics worden opgegeven',
	'POLL_FROM_GROUPS'							=> 'Toon polls van groep(en)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Alleen opiniepeilingen van leden van de geselecteerde groepen worden weergegeven zolang geen gebruiker(s) zijn/hierboven zijn opgegeven',
	'POLL_FROM_TOPICS'							=> 'Toon polls van topic(s)',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(s) van topics om polls op te halen, gescheiden door <strong>komma\'s</strong>(,). Laat leeg om een willekeurig onderwerp te selecteren.',
	'POLL_FROM_USERS'							=> 'Toon polls van gebruiker(s)',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id(s) van gebruiker(s) wier polls u wilt weergeven, gescheiden door <strong>komma\'s</strong>(,). Laat leeg om polls te selecteren van elke gebruiker.',
	'POSTS_TITLE_LIMIT'							=> 'Maximaal aantal karakters voor titel van bericht',
	'PREVIEW_MAX_CHARS'							=> 'Aantal tekens om te bekijken',

	'QUERY_TYPE'								=> 'Weergavemodus',

	'ROTATE_DAILY'								=> 'Dagelijks',
	'ROTATE_HOURLY'								=> 'Per uur',
	'ROTATE_MONTHLY'							=> 'Maandelijks',
	'ROTATE_PAGELOAD'							=> 'Paginabelasting',
	'ROTATE_WEEKLY'								=> 'Wekelijks',

	'SAMPLES'									=> 'Voorbeelden',
	'SCRIPTS'									=> 'Scripts',
	'SELECT_FORUMS'								=> 'Selecteer forums',
	'SELECT_FORUMS_EXPLAIN'						=> 'Selecteer de forums waaruit topics/berichten getoond moeten worden. Laat leeg om te selecteren in alle forums',
	'SELECT_MENU'								=> 'Selecteer menu',
	'SELECT_PROFILE_FIELDS'						=> 'Selecteer profielvelden',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Alleen de geselecteerde profielvelden worden weergegeven, indien beschikbaar.',
	'SHOW_FIRST_POST'							=> 'Eerste bericht',
	'SHOW_HIDE_ME'								=> 'Verbergen online status toestaan?',
	'SHOW_LAST_POST'							=> 'Laatste post',
	'SHOW_MEMBER_MENU'							=> 'Toon gebruikersmenu?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Vervang login box als de gebruiker is ingelogd',
	'SHOW_WORD_COUNT'							=> 'Woordteller tonen?',

	'TEMPLATE'									=> 'Sjabloon',
	'TOPIC_TITLE_LIMIT'							=> 'Maximaal aantal karakters voor topictitel',
	'TOPIC_TYPE'								=> 'Onderwerp type',
	'TOPIC_TYPE_EXPLAIN'						=> 'Selecteer de topictypes die u wilt weergeven. Laat de vakken niet aangevinkt zijn om te selecteren uit alle toptypes',
	'TOPICS_LOOK_BACK'							=> 'Terugkijken',
	'TOPICS_ONLY'								=> 'Alleen onderwerpen?',
	'TOPICS_PER_PAGE'							=> 'Per pagina',

	'WORD_MAX_SIZE'								=> 'Maximale lettergrootte',
	'WORD_MIN_SIZE'								=> 'Minimale lettergrootte',
));
