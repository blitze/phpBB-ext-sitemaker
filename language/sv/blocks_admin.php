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
	'ALL_TYPES'									=> 'Alla typer',
	'ALL_GROUPS'								=> 'Alla grupper',
	'ARCHIVES'									=> 'Arkiv',
	'AUTO_LOGIN'								=> 'Tillåt automatisk inloggning?',
	'FILE_MANAGER'								=> 'Filhanterare',
	'TOPIC_POST_IDS'							=> 'Från ämnen/inlägg Id',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(er) av ämnen/inlägg för att hämta bilagor från, separerade med <strong>kommatecken</strong>(,). Ange om denna lista är för ämne eller inlägg ID ovan.',
	'TOPIC_POST_IDS_TYPE'						=> 'Typ av ID (nedan)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Bilagor',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Födelsedag',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Anpassat block',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Utvald medlem',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'RSS-/Atom Flöden',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Forumundersökning',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Forumets ämnen',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Google Maps',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Populära ämnen',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Länkar',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Inloggningsbox',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Medlemmar',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Medlemmens meny',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Meny',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Mina bokmärken',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Senaste trådar',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Statistik',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Stil växlare',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Vad är nytt?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Vem är online',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Wordgraph',

	// block views
	'BLOCK_VIEW'								=> 'Blockera vy',
	'BLOCK_VIEW_BASIC'							=> 'Grundläggande',
	'BLOCK_VIEW_BOXED'							=> 'Boxad',
	'BLOCK_VIEW_DEFAULT'						=> 'Standard',
	'BLOCK_VIEW_SIMPLE'							=> 'Enkel',

	'CACHE_DURATION'							=> 'Cachens varaktighet',
	'CONTEXT'									=> 'Kontext',
	'CSS_SCRIPTS'								=> 'CSS Scripts',
	'CUSTOM_PROFILE_FIELDS'						=> 'Anpassade profilfält',

	'DATE_RANGE'								=> 'Date Range',
	'DISPLAY_PREVIEW'							=> 'Visa förhandsgranskning?',

	'EDIT_ME'									=> 'Redigera mig',
	'ENABLE_TOPIC_TRACKING'						=> 'Aktivera trådspårning?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Om aktiverad, kommer olästa ämnen att visas men blockresultaten kommer inte att cachelagras <strong>(rekommenderas inte)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Du har angett för många ord för att utesluta. Maximalt antal tecken är 255, du har angett %s.',
	'EXCLUDE_WORDS'								=> 'Exkludera ord',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Lista de ord du vill exkludera från orddiagrammet separerat med ett kommatecken (,). Maximalt 255 tecken.',
	'EXPANDED'									=> 'Utökat',
	'EXTENSION_GROUP'							=> 'Tilläggsgrupp',

	'FEATURED_MEMBER_IDS'						=> 'Användar-ID',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Kommaseparerad lista över användare att funktionen (gäller endast för Visningsläge för Utvalda medlemmar)',
	'FEED_DATA_PREVIEW'							=> 'Flöde Data',
	'FEED_ITEM_TEMPLATE'						=> 'Mall för objekt',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS:</strong><br />
		<unk>		<ul class="sm-list">
			<unk>			<li>Åtkomstflödesdata i <strong>objekt</strong> variabel e. . objekt. itle</li>
			<unk>			<li>Mall måste vara i <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Twig syntax</a></li>
			<unk>			<li>Klicka på <strong>Exempel</strong> ovan för exempelmallar</li>
			<unk>			<li>Använd <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> för att få någon tagg från det flöde som vi inte tillhandahåller. .<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<unk>			<li>Använd Twigs json_encode filter för att se innehållet i array e. . <strong><code>{{ get_item_tags(\'\', \'image\')<unk> json_encode() }}</code></strong></li>
		<unk>		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Källa',
	'FEED_URL_PLACEHOLDER'						=> 'http://example.com/rss',
	'FEED_URLS'									=> 'Webbadresser för flöde',
	'FIRST_POST_ONLY'							=> 'Endast första inlägget',
	'FIRST_POST_TIME'							=> 'Första inlägget tid',
	'FORUMS_GET_TYPE'							=> 'Hämta typ',
	'FORUMS_MAX_TOPICS'							=> 'Maximalt antal trådar/inlägg',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Maximalt antal tecken per titel',
	'FREQUENCY'									=> 'Frekvens',
	'FULL'										=> 'Fullt',
	'FULLSCREEN'								=> 'Helskärm',

	'GET_TYPE'									=> 'Visa ämne/inlägg?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Använd detta textområde för att ange rå HTML-innehåll.</strong><br />Observera att allt innehåll som läggs upp här kommer att åsidosätta det anpassade blockinnehållet och den visuella blockredigeraren kommer inte att vara tillgänglig.',
	'HOURS_SHORT'								=> 'timmar',

	'JS_SCRIPTS'								=> 'JS skript',

	'LAST_POST_TIME'							=> 'Senaste inlägget',
	'LAST_READ_TIME'							=> 'Senast läst',
	'LIMIT'										=> 'Gräns',
	'LIMIT_FORUMS'								=> 'Forum-ID (valfritt)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Ange varje forum-id separerat med ett kommatecken (,). Om inställd, kommer endast trådar från angivna forum att visas.',
	'LIMIT_POST_TIME'							=> 'Begränsa med inläggstid',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Om angivet, kommer endast ämnen som postats inom den angivna perioden att hämtas',

	'MAX_DEPTH'									=> 'Maximalt djup',
	'MAX_ITEMS'									=> 'Maximalt antal artiklar',
	'MAX_MEMBERS'								=> 'Max. medlemmar',
	'MAX_POSTS'									=> 'Maximalt antal inlägg',
	'MAX_TOPICS'								=> 'Maximalt antal ämnen',
	'MAX_WORDS'									=> 'Maximalt antal ord',
	'MANAGE_MENUS'								=> 'Hantera menyer',
	'MAP_COORDINATES'							=> 'Koordinater',
	'MAP_COORDINATES_EXPLAIN'					=> 'Ange koordinater i formuläret breddgrad, longitud',
	'MAP_HEIGHT'								=> 'Höjd',
	'MAP_LOCATION'								=> 'Plats',
	'MAP_TITLE'									=> 'Titel',
	'MAP_VIEW'									=> 'Visa',
	'MAP_VIEW_HYBRID'							=> 'Hybridning',
	'MAP_VIEW_MAP'								=> 'Karta',
	'MAP_VIEW_SATELITE'							=> 'Satelit',
	'MAP_VIEW_TERRAIN'							=> 'Terrain',
	'MAP_ZOOM_LEVEL'							=> 'Zooma nivå',
	'MEMBERS_DATE'								=> 'Datum',
	'MENU_NO_ITEMS'								=> 'Inga aktiva objekt att visa',
	'MINI'										=> 'Mini',

	'OR'										=> '<strong>ELLER</strong>',
	'ORDER_BY'									=> 'Sortera efter',

	'POLL_FROM_FORUMS'							=> 'Visa omröstningar från forum(er)',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Endast omröstningar från de valda forumen kommer att visas så länge inga trådar anges ovan',
	'POLL_FROM_GROUPS'							=> 'Visa omröstningar från grupper',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Endast omröstningar från medlemmar i de valda grupperna kommer att visas så länge inga användare är/är specificerade ovan',
	'POLL_FROM_TOPICS'							=> 'Visa omröstningar från ämnen(n)',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(er) av ämnen att hämta enkäter från, separerade med <strong>kommatecken</strong>(,). Lämna tomt för att välja något ämne.',
	'POLL_FROM_USERS'							=> 'Visa omröstningar från användare',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id (er) för användare vars omröstningar du vill visa, separerade med <strong>kommatecken</strong>(,). Lämna tomt för att välja omröstningar från alla användare.',
	'POSTS_TITLE_LIMIT'							=> 'Maximalt antal tecken för postrubrik',
	'PREVIEW_MAX_CHARS'							=> 'Antal tecken att förhandsgranska',

	'QUERY_TYPE'								=> 'Visa läge',

	'ROTATE_DAILY'								=> 'Dagligen',
	'ROTATE_HOURLY'								=> 'Timvis',
	'ROTATE_MONTHLY'							=> 'Månadsvis',
	'ROTATE_PAGELOAD'							=> 'Ladda sidan',
	'ROTATE_WEEKLY'								=> 'Veckovis',

	'SAMPLES'									=> 'Prov',
	'SCRIPTS'									=> 'Skript',
	'SELECT_FORUMS'								=> 'Välj forum',
	'SELECT_FORUMS_EXPLAIN'						=> 'Välj från vilka forum du vill visa ämnen/inlägg. Lämna tomt för att välja från alla forum',
	'SELECT_MENU'								=> 'Välj meny',
	'SELECT_PROFILE_FIELDS'						=> 'Välj profilfält',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Endast de markerade profilfälten kommer att visas, om tillgängligt.',
	'SHOW_FIRST_POST'							=> 'Första inlägget',
	'SHOW_HIDE_ME'								=> 'Tillåt gömma status online?',
	'SHOW_LAST_POST'							=> 'Senaste inlägg',
	'SHOW_MEMBER_MENU'							=> 'Visa användarmenyn?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Ersätt inloggningsrutan med användarmenyn om användaren är inloggad',
	'SHOW_WORD_COUNT'							=> 'Visa antal ord?',

	'TEMPLATE'									=> 'Mall',
	'TOPIC_TITLE_LIMIT'							=> 'Maximalt antal tecken för ämnestitel',
	'TOPIC_TYPE'								=> 'Typ av ämne',
	'TOPIC_TYPE_EXPLAIN'						=> 'Välj de trådtyper du vill visa. Lämna rutorna avmarkerade för att välja från alla trådtyper',
	'TOPICS_LOOK_BACK'							=> 'Titta tillbaka',
	'TOPICS_ONLY'								=> 'Endast ämnen?',
	'TOPICS_PER_PAGE'							=> 'Per sida',

	'WORD_MAX_SIZE'								=> 'Maximal teckenstorlek',
	'WORD_MIN_SIZE'								=> 'Minsta teckenstorlek',
));
