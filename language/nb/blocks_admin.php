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
	'ALL_TYPES'									=> 'Alle typer',
	'ALL_GROUPS'								=> 'Alle grupper',
	'ARCHIVES'									=> 'Arkiv',
	'AUTO_LOGIN'								=> 'Tillat automatisk innlogging?',
	'FILE_MANAGER'								=> 'Fil Behandler',
	'TOPIC_POST_IDS'							=> 'Fra emnet/Post Ids',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(s) of topics/posts for å hente vedlegg fra, atskilt med <strong>komma</strong>(,). Angi om denne listen er for emnet eller innlegget ovenfor.',
	'TOPIC_POST_IDS_TYPE'						=> 'Type IDer (under)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Vedlegg',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Fødselsdag',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Egendefinert blokk',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Fremhevet medlem',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'RSS/Atommating',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Forum Avstemning',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Forum Emner',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Google kart',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Populære emner',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Lenker',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Innloggingsboks',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Medlemmer',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Medlems meny',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Meny',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Mine bokmerker',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Siste emner',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Statistikk',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Stilbryteren (Automatic Translation)',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Hva er nytt?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Hvem er pålogget',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Orddiagram',

	// block views
	'BLOCK_VIEW'								=> 'Blokker visning',
	'BLOCK_VIEW_BASIC'							=> 'Grunnleggende',
	'BLOCK_VIEW_BOXED'							=> 'Innrammet',
	'BLOCK_VIEW_DEFAULT'						=> 'Standard',
	'BLOCK_VIEW_SIMPLE'							=> 'Enkel',

	'CACHE_DURATION'							=> 'Cache varighet',
	'CONTEXT'									=> 'Kontekst',
	'CSS_SCRIPTS'								=> 'CSS Scripts',
	'CUSTOM_PROFILE_FIELDS'						=> 'Egendefinerte profilfelt',

	'DATE_RANGE'								=> 'Date Range',
	'DISPLAY_PREVIEW'							=> 'Vis forhåndsvisning?',

	'EDIT_ME'									=> 'Rediger meg',
	'ENABLE_TOPIC_TRACKING'						=> 'Aktiver sporing av emne?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Hvis aktivert, vil uleste emner bli angitt, men blokkresultatene vil ikke bli bufredd <strong>(Anbefales ikke)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Du har skrevet inn for mange ord for å ekskludere. Maksimalt antall tegn kan være 255, du har angitt %s.',
	'EXCLUDE_WORDS'								=> 'Ekskluder ord',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'List ordene du vil ekskludere fra ordgrafen separert med komma (,). Maksimalt 255 tegn.',
	'EXPANDED'									=> 'Utvidet',
	'EXTENSION_GROUP'							=> 'Gruppe for utvidelse',

	'FEATURED_MEMBER_IDS'						=> 'Bruker ID-er',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Kommaseparert liste over brukere som skal vises (gjelder bare for utvalgte medlemsmodus)',
	'FEED_DATA_PREVIEW'							=> 'Feed data',
	'FEED_ITEM_TEMPLATE'						=> 'Produkt mal',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS:</strong><br />
		EU/1/13/		<ul class="sm-list">
			
			<li>Aksessmatdata i <strong>artikkel</strong> variabel e. . produkt. øvrighet</li>
			</li> 
 ε			<li>Mal må være i <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Twig-syntaks</a></li>
			εephal			<li>Klikk <strong>Prøver</strong> over for eksempelmalene</li>
			›			<li>Bruk <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> for å få en tag fra feeden vi ikke angir. .<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			Glen			<li>Bruk Twig’s json_encode filter for å se innholdet i matrise. <strong><code>{{ get_item_tags(\'\', \'image\')″json_encode() }}</code></strong></li>
		ah.		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Kilde',
	'FEED_URL_PLACEHOLDER'						=> 'http://eksempel.com/rss',
	'FEED_URLS'									=> 'Feed URL-er',
	'FIRST_POST_ONLY'							=> 'Bare første innlegg',
	'FIRST_POST_TIME'							=> 'Første innleggs tid',
	'FORUMS_GET_TYPE'							=> 'Få type',
	'FORUMS_MAX_TOPICS'							=> 'Maksimalt antall emner/innlegg',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Maksimalt antall tegn per tittel',
	'FREQUENCY'									=> 'Frekvens',
	'FULL'										=> 'Full',
	'FULLSCREEN'								=> 'Fullskjerm',

	'GET_TYPE'									=> 'Vis emnet/innlegg?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Bruk dette tekstområdet for å skrive rå HTML-innholdet.</strong><br />Vær oppmerksom på at noe innhold postet her, vil overstyre det tilpassede blokkinnholdet og det visuelle redigeringsprogrammet for blokk vil ikke være tilgjengelig.',
	'HOURS_SHORT'								=> 'TIMER',

	'JS_SCRIPTS'								=> 'JS skript',

	'LAST_POST_TIME'							=> 'Siste innlegg',
	'LAST_READ_TIME'							=> 'Sist leste tid',
	'LIMIT'										=> 'Grense',
	'LIMIT_FORUMS'								=> 'Forum Ids (valgfritt)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Angi hver forum id som er adskilt med et komma (,). Hvis angitt, vil bare emner fra angitte forum vises.',
	'LIMIT_POST_TIME'							=> 'Begrens etter ettertid',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Dersom dette er angitt, vil bare emner postet i den angitte perioden bli hentet',

	'MAX_DEPTH'									=> 'Maksimal dybde',
	'MAX_ITEMS'									=> 'Maksimalt antall elementer',
	'MAX_MEMBERS'								=> 'Maks. antall medlemmer',
	'MAX_POSTS'									=> 'Maksimalt antall innlegg',
	'MAX_TOPICS'								=> 'Maksimalt antall emner',
	'MAX_WORDS'									=> 'Maksimalt antall ord',
	'MANAGE_MENUS'								=> 'Administrer menyer',
	'MAP_COORDINATES'							=> 'Koordinater',
	'MAP_COORDINATES_EXPLAIN'					=> 'Angi koordinater i formens bredde,lengdegrad',
	'MAP_HEIGHT'								=> 'Høyde',
	'MAP_LOCATION'								=> 'Sted',
	'MAP_TITLE'									=> 'Tittel',
	'MAP_VIEW'									=> 'Vis',
	'MAP_VIEW_HYBRID'							=> 'Hybrid',
	'MAP_VIEW_MAP'								=> 'Kart',
	'MAP_VIEW_SATELITE'							=> 'Satelitt',
	'MAP_VIEW_TERRAIN'							=> 'Terrain',
	'MAP_ZOOM_LEVEL'							=> 'Zoom nivå',
	'MEMBERS_DATE'								=> 'Dato',
	'MENU_NO_ITEMS'								=> 'Ingen aktive elementer å vise',
	'MINI'										=> 'Mini',

	'OR'										=> '<strong>ELLER</strong>',
	'ORDER_BY'									=> 'Sorter etter',

	'POLL_FROM_FORUMS'							=> 'Vis avstemninger fra forum(er)',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Bare avstemninger fra valgte forum vil vises så lenge ingen emner er angitt ovenfor',
	'POLL_FROM_GROUPS'							=> 'Vis avstemninger fra grupper/grupper',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Bare avstemninger fra medlemmer av de valgte gruppene vil bli vist så lenge ingen brukere er/er angitt ovenfor',
	'POLL_FROM_TOPICS'							=> 'Vis avstemninger fra emn(er)',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(s) emner som kan hente ut avstemninger fra, adskilt med <strong>komma</strong>(,). La være blank for å velge hvilket som helst emne.',
	'POLL_FROM_USERS'							=> 'Vis avstemninger fra bruker(e)',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id(s) av brukere med meningsmålinger du ønsker å vise, separert med <strong>komma</strong>(,). La stå tomt for å velge meningsmålinger fra en bruker.',
	'POSTS_TITLE_LIMIT'							=> 'Maksimalt antall tegn for tittel på innlegg',
	'PREVIEW_MAX_CHARS'							=> 'Antall tegn å forhåndsvise',

	'QUERY_TYPE'								=> 'Visnings modus',

	'ROTATE_DAILY'								=> 'Daglig',
	'ROTATE_HOURLY'								=> 'Hver',
	'ROTATE_MONTHLY'							=> 'Månedlig',
	'ROTATE_PAGELOAD'							=> 'Lastet side',
	'ROTATE_WEEKLY'								=> 'Ukentlig',

	'SAMPLES'									=> 'Utvalg',
	'SCRIPTS'									=> 'Skript',
	'SELECT_FORUMS'								=> 'Velg forum',
	'SELECT_FORUMS_EXPLAIN'						=> 'Velg forum for å vise emner/innlegg fra. La stå tomt for å velge mellom alle forumene',
	'SELECT_MENU'								=> 'Velg meny',
	'SELECT_PROFILE_FIELDS'						=> 'Velg profilfelter',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Bare valgte profilfelt vil bli vist dersom tilgjengelig.',
	'SHOW_FIRST_POST'							=> 'Første innlegg',
	'SHOW_HIDE_ME'								=> 'Tillat Skjul pålogget status?',
	'SHOW_LAST_POST'							=> 'Siste innlegg',
	'SHOW_MEMBER_MENU'							=> 'Vis brukermenyen?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Erstatt innloggingsboks med brukermeny hvis brukeren er innlogget',
	'SHOW_WORD_COUNT'							=> 'Vis ordnavn?',

	'TEMPLATE'									=> 'Mal',
	'TOPIC_TITLE_LIMIT'							=> 'Maksimalt antall tegn for emnetittel',
	'TOPIC_TYPE'								=> 'Emne Type',
	'TOPIC_TYPE_EXPLAIN'						=> 'Velg de emnetypene du ønsker å vise. La boksene avkrysses for å velge mellom alle emnetyper',
	'TOPICS_LOOK_BACK'							=> 'Se tilbake',
	'TOPICS_ONLY'								=> 'Kun emner?',
	'TOPICS_PER_PAGE'							=> 'Pr. side',

	'WORD_MAX_SIZE'								=> 'Maksimal skriftstørrelse',
	'WORD_MIN_SIZE'								=> 'Minste skriftstørrelse',
));
