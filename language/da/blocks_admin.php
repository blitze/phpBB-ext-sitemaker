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
	'ALL_TYPES'									=> 'Alle Typer',
	'ALL_GROUPS'								=> 'Alle Grupper',
	'ARCHIVES'									=> 'Arkiver',
	'AUTO_LOGIN'								=> 'Tillad auto login?',
	'FILE_MANAGER'								=> 'Filhåndtering',
	'TOPIC_POST_IDS'							=> 'Fra Emne/Indlæg Ids',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(er) af emner/indlæg for at hente vedhæftede filer fra, adskilt af <strong>kommaer</strong>(,). Angiv, om denne liste er for emne eller indlæg id ovenfor.',
	'TOPIC_POST_IDS_TYPE'						=> 'Type af ID\'er (nedenfor)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Vedhæftninger',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Fødselsdag',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Brugerdefineret Blok',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Fremhævet Medlem',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'RSS/Atom Feeds',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Forum Afstemning',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Forum Emner',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Google Maps',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Populære Emner',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Links',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Log På Boks',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Medlemmer',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Medlems Menu',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Menu',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Mine Bogmærker',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Seneste Emner',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Statistik',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Stil Skifter',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Hvad Er Nyt?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Hvem er online',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Wordgraph',

	// block views
	'BLOCK_VIEW'								=> 'Blokér Visning',
	'BLOCK_VIEW_BASIC'							=> 'Grundlæggende',
	'BLOCK_VIEW_BOXED'							=> 'Boks',
	'BLOCK_VIEW_DEFAULT'						=> 'Standard',
	'BLOCK_VIEW_SIMPLE'							=> 'Simpel',

	'CACHE_DURATION'							=> 'Cache varighed',
	'CONTEXT'									=> 'Kontekst',
	'CSS_SCRIPTS'								=> 'CSS Scripts',
	'CUSTOM_PROFILE_FIELDS'						=> 'Brugerdefinerede Profilfelter',

	'DATE_RANGE'								=> 'Date Range',
	'DISPLAY_PREVIEW'							=> 'Vis Eksempelvisning?',

	'EDIT_ME'									=> 'Rediger mig venligst',
	'ENABLE_TOPIC_TRACKING'						=> 'Aktivér emnesporing?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Hvis aktiveret, vil ulæste emner blive angivet, men blokkens resultater vil ikke blive cachet <strong>(anbefales ikke)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Du har indtastet for mange ord til at ekskludere. Det maksimale antal tegn er 255, du har indtastet %s.',
	'EXCLUDE_WORDS'								=> 'Udeluk ord',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Liste over de ord, du gerne vil udelukke fra ordgrafen adskilt af et komma (,). Maksimum 255 tegn.',
	'EXPANDED'									=> 'Udvidet',
	'EXTENSION_GROUP'							=> 'Udvidelse Gruppe',

	'FEATURED_MEMBER_IDS'						=> 'Bruger IDer',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Kommasepareret liste over brugere til funktion (gælder kun for fremhævede medlems visningstilstand)',
	'FEED_DATA_PREVIEW'							=> 'Feed Data',
	'FEED_ITEM_TEMPLATE'						=> 'Vare Skabelon',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS:</strong><br />
		Række		<ul class="sm-list">
			Rækkevidde			<li>Få adgang til feed-data i <strong>element</strong> variabel e. Emne. itle</li>
			jórna			<li>Skabelon skal være i <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Twig syntaks</a></li>
			jórna			<li>Klik <strong>Prøver</strong> ovenfor for eksempelskabeloner</li>
			jórna			<li>Brug <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> for at få et tag fra det feed, vi ikke leverer. .<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			KAPITEL			<li>Brug Twigs json_encode filter for at se indholdet af array e. . <strong><code>{{ get_item_tags(\'\', \'image\')řjson_encode() }}</code></strong></li>
		ř		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Kilde',
	'FEED_URL_PLACEHOLDER'						=> 'http://example.com/rss',
	'FEED_URLS'									=> 'Feed URL\'er',
	'FIRST_POST_ONLY'							=> 'Kun Første Indlæg',
	'FIRST_POST_TIME'							=> 'Første Indlægstid',
	'FORUMS_GET_TYPE'							=> 'Hent type',
	'FORUMS_MAX_TOPICS'							=> 'Maksimum emner/indlæg',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Maksimum tegn pr. titel',
	'FREQUENCY'									=> 'Frekvens',
	'FULL'										=> 'Fuld',
	'FULLSCREEN'								=> 'Fuldskærm',

	'GET_TYPE'									=> 'Vis Emne/Indlæg?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Brug dette textarea til at indtaste råt HTML-indhold.</strong><br />Bemærk venligst, at alt indhold der er publiceret her, vil tilsidesætte det brugerdefinerede blokindhold og den visuelle blokredigering vil ikke være tilgængelig.',
	'HOURS_SHORT'								=> 'timer',

	'JS_SCRIPTS'								=> 'JS Scripts',

	'LAST_POST_TIME'							=> 'Sidste Indlægstid',
	'LAST_READ_TIME'							=> 'Sidste Læste Tid',
	'LIMIT'										=> 'Grænse',
	'LIMIT_FORUMS'								=> 'Forum Ider (valgfrit)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Indtast hvert forum id adskilt af et komma (,). Hvis angivet, vil kun emner fra angivne fora blive vist.',
	'LIMIT_POST_TIME'							=> 'Begræns efter indlægstid',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Hvis angivet, vil kun emner som er publiceret inden for den angivne periode blive hentet',

	'MAX_DEPTH'									=> 'Maksimal dybde',
	'MAX_ITEMS'									=> 'Maksimalt antal elementer',
	'MAX_MEMBERS'								=> 'Maks. Medlemmer',
	'MAX_POSTS'									=> 'Maksimalt antal indlæg',
	'MAX_TOPICS'								=> 'Maksimalt antal emner',
	'MAX_WORDS'									=> 'Maksimalt antal ord',
	'MANAGE_MENUS'								=> 'Administrer Menuer',
	'MAP_COORDINATES'							=> 'Koordinater',
	'MAP_COORDINATES_EXPLAIN'					=> 'Indtast koordinater i formularens bredde,længdegrad',
	'MAP_HEIGHT'								=> 'Højde',
	'MAP_LOCATION'								=> 'Placering',
	'MAP_TITLE'									=> 'Titel',
	'MAP_VIEW'									=> 'Vis',
	'MAP_VIEW_HYBRID'							=> 'Hybridmajs',
	'MAP_VIEW_MAP'								=> 'Kort',
	'MAP_VIEW_SATELITE'							=> 'Satelit',
	'MAP_VIEW_TERRAIN'							=> 'Terrain',
	'MAP_ZOOM_LEVEL'							=> 'Zoom Niveau',
	'MEMBERS_DATE'								=> 'Dato',
	'MENU_NO_ITEMS'								=> 'Ingen aktive elementer at vise',
	'MINI'										=> 'Mini',

	'OR'										=> '<strong>ELLER</strong>',
	'ORDER_BY'									=> 'Sorter efter',

	'POLL_FROM_FORUMS'							=> 'Vis afstemninger fra forummer',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Kun afstemninger fra de valgte fora vil blive vist, så længe ingen emner er angivet ovenfor',
	'POLL_FROM_GROUPS'							=> 'Vis afstemninger fra grupper',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Kun afstemninger fra medlemmer af de valgte grupper vil blive vist, så længe ingen brugere/er angivet ovenfor',
	'POLL_FROM_TOPICS'							=> 'Vis afstemninger fra emne(r)',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(s) af emner til at hente meningsmålinger fra, adskilt af <strong>kommaer</strong>(,). Lad feltet stå tomt for at vælge ethvert emne.',
	'POLL_FROM_USERS'							=> 'Vis afstemninger fra bruger(e)',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id(s) af brugere(r) hvis meningsmålinger du gerne vil vise, adskilt af <strong>kommaer</strong>(,). Efterlad blank for at vælge meningsmålinger fra enhver bruger.',
	'POSTS_TITLE_LIMIT'							=> 'Maksimum # tegn for post titel',
	'PREVIEW_MAX_CHARS'							=> 'Antal tegn der skal forhåndsvises',

	'QUERY_TYPE'								=> 'Visningstilstand',

	'ROTATE_DAILY'								=> 'Dagligt',
	'ROTATE_HOURLY'								=> 'Time',
	'ROTATE_MONTHLY'							=> 'Månedligt',
	'ROTATE_PAGELOAD'							=> 'Side indlæsning',
	'ROTATE_WEEKLY'								=> 'Ugentlig',

	'SAMPLES'									=> 'Prøver',
	'SCRIPTS'									=> 'Scripts',
	'SELECT_FORUMS'								=> 'Vælg fora',
	'SELECT_FORUMS_EXPLAIN'						=> 'Vælg de fora, hvorfra emner/indlæg skal vises. Lad feltet stå tomt for at vælge mellem alle fora',
	'SELECT_MENU'								=> 'Vælg Menu',
	'SELECT_PROFILE_FIELDS'						=> 'Vælg profilfelter',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Kun de valgte profilfelter vil blive vist, hvis de er tilgængelige.',
	'SHOW_FIRST_POST'							=> 'Første Indlæg',
	'SHOW_HIDE_ME'								=> 'Vil du skjule online-status?',
	'SHOW_LAST_POST'							=> 'Sidste Indlæg',
	'SHOW_MEMBER_MENU'							=> 'Vis brugermenu?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Erstat login-boks med brugermenuen, hvis brugeren er logget ind',
	'SHOW_WORD_COUNT'							=> 'Vis antal ord?',

	'TEMPLATE'									=> 'Skabelon',
	'TOPIC_TITLE_LIMIT'							=> 'Maksimum # tegn for emnetitel',
	'TOPIC_TYPE'								=> 'Emne Type',
	'TOPIC_TYPE_EXPLAIN'						=> 'Vælg de emnetyper du vil vise. Efterlad felterne ikke markerede for at vælge fra alle emnetyper',
	'TOPICS_LOOK_BACK'							=> 'Se tilbage',
	'TOPICS_ONLY'								=> 'Emner kun?',
	'TOPICS_PER_PAGE'							=> 'Pr. side',

	'WORD_MAX_SIZE'								=> 'Maksimal skriftstørrelse',
	'WORD_MIN_SIZE'								=> 'Mindste skriftstørrelse',
));
