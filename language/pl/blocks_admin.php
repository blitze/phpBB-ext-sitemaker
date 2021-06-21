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
	'ALL_TYPES'									=> 'Wszystkie typy',
	'ALL_GROUPS'								=> 'Wszystkie grupy',
	'ARCHIVES'									=> 'Archiwum',
	'AUTO_LOGIN'								=> 'Zezwolić na automatyczne logowanie?',
	'FILE_MANAGER'								=> 'Menedżer plików',
	'TOPIC_POST_IDS'							=> 'Z ID tematu/wpisu',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(y) tematów/postów z których pobierane są załączniki, oddzielone przez <strong>przecinkami</strong>(,). Określ czy ta lista jest dla tematów lub identyfikatorów postów powyżej.',
	'TOPIC_POST_IDS_TYPE'						=> 'Rodzaj identyfikatorów (poniżej)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Załączniki',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Data urodzin',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Własny blok',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Polecany członek',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'Kanały RSS/Atom',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Ankieta forum',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Tematy forum',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Mapy Google',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Popularne tematy',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Linki',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Pole logowania',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Członkowie',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Menu użytkownika',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Menu',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Moje zakładki',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Ostatnie tematy',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Statystyki',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Przełącznik stylu',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Co nowego?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Kto jest online',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Słowo',

	// block views
	'BLOCK_VIEW'								=> 'Widok bloku',
	'BLOCK_VIEW_BASIC'							=> 'Podstawowe',
	'BLOCK_VIEW_BOXED'							=> 'Pudełko',
	'BLOCK_VIEW_DEFAULT'						=> 'Domyślne',
	'BLOCK_VIEW_SIMPLE'							=> 'Prosty',

	'CACHE_DURATION'							=> 'Czas trwania pamięci podręcznej',
	'CONTEXT'									=> 'Kontekst',
	'CSS_SCRIPTS'								=> 'Skrypty CSS',
	'CUSTOM_PROFILE_FIELDS'						=> 'Pola niestandardowe profilu',

	'DATE_RANGE'								=> 'Zakres dat',
	'DISPLAY_PREVIEW'							=> 'Wyświetlić podgląd?',

	'EDIT_ME'									=> 'Proszę edytować mnie',
	'ENABLE_TOPIC_TRACKING'						=> 'Włączyć śledzenie tematu?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Jeśli włączone, nieprzeczytane tematy będą wskazane, ale wyniki bloku nie będą buforowane <strong>(nie zalecane)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Wpisałeś zbyt wiele słów, aby wykluczyć. Maksymalna liczba możliwych znaków to 255, wpisałeś %s.',
	'EXCLUDE_WORDS'								=> 'Wyklucz słowa',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Lista słów, które chcesz wyłączyć z wyrazów oddzielonych przecinkami (,). Maksymalnie 255 znaków.',
	'EXPANDED'									=> 'Rozszerzone',
	'EXTENSION_GROUP'							=> 'Grupa rozszerzeń',

	'FEATURED_MEMBER_IDS'						=> 'ID Użytkownika',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Oddzielona przecinkami lista użytkowników (dotyczy tylko trybu wyświetlania polecanych użytkowników)',
	'FEED_DATA_PREVIEW'							=> 'Dane kanału',
	'FEED_ITEM_TEMPLATE'						=> 'Szablon elementu',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS:</strong><br />
		<ul class="sm-list">
			<li>Access feed data in <strong>item</strong> variable e.g. item.title</li>
			<li>Template must be in <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Twig syntax</a></li>
			<li>Click <strong>Samples</strong> above for sample templates</li>
			<li>Use <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> to get any tag from the feed that we do not provide e.g.<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<li>Use Twig’s json_encode filter to see contents of array e.g. <strong><code>{{ get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Źródło',
	'FEED_URL_PLACEHOLDER'						=> 'http://przyklad.com/rss',
	'FEED_URLS'									=> 'URL kanału',
	'FIRST_POST_ONLY'							=> 'Tylko pierwszy post',
	'FIRST_POST_TIME'							=> 'Czas pierwszego postu',
	'FORUMS_GET_TYPE'							=> 'Pobierz typ',
	'FORUMS_MAX_TOPICS'							=> 'Maksymalna liczba tematów/postów',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Maksymalna liczba znaków na tytuł',
	'FREQUENCY'									=> 'Częstotliwość',
	'FULL'										=> 'Pełna',
	'FULLSCREEN'								=> 'Pełny ekran',

	'GET_TYPE'									=> 'Wyświetlić temat/post?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Użyj tego pola tekstowego, aby wprowadzić surową zawartość HTML.</strong><br />Pamiętaj, że zamieszczona tutaj treść nadpisze niestandardową zawartość bloku i edytor bloków wizualnych nie będzie dostępny.',
	'HOURS_SHORT'								=> 'godz.',

	'JS_SCRIPTS'								=> 'Skrypty JS',

	'LAST_POST_TIME'							=> 'Czas ostatniego postu',
	'LAST_READ_TIME'							=> 'Ostatni czas odczytu',
	'LIMIT'										=> 'Wartość graniczna',
	'LIMIT_FORUMS'								=> 'Id Forum (opcjonalnie)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Wprowadź każdy identyfikator forum oddzielony przecinkami (,). Jeśli ustawione, wyświetlane będą tylko tematy z określonych forów.',
	'LIMIT_POST_TIME'							=> 'Ogranicz przez czas postu',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Jeśli ustawione, tylko wątki opublikowane w określonym okresie zostaną pobrane',

	'MAX_DEPTH'									=> 'Maksymalna głębokość',
	'MAX_ITEMS'									=> 'Maksymalna liczba elementów',
	'MAX_MEMBERS'								=> 'Max. członków',
	'MAX_POSTS'									=> 'Maksymalna liczba postów',
	'MAX_TOPICS'								=> 'Maksymalna liczba tematów',
	'MAX_WORDS'									=> 'Maksymalna liczba słów',
	'MANAGE_MENUS'								=> 'Zarządzaj menu',
	'MAP_COORDINATES'							=> 'Współrzędne',
	'MAP_COORDINATES_EXPLAIN'					=> 'Wprowadź współrzędne w formie szerokości geograficznej, długość geograficzna',
	'MAP_HEIGHT'								=> 'Wysokość',
	'MAP_LOCATION'								=> 'Lokalizacja',
	'MAP_TITLE'									=> 'Tytuł',
	'MAP_VIEW'									=> 'Widok',
	'MAP_VIEW_HYBRID'							=> 'Hybrydowe',
	'MAP_VIEW_MAP'								=> 'Mapa',
	'MAP_VIEW_SATELITE'							=> 'Satelita',
	'MAP_VIEW_TERRAIN'							=> 'Teren',
	'MAP_ZOOM_LEVEL'							=> 'Poziom powiększenia',
	'MEMBERS_DATE'								=> 'Data',
	'MENU_NO_ITEMS'								=> 'Brak aktywnych elementów do wyświetlenia',
	'MINI'										=> 'Mini',

	'OR'										=> '<strong>LUB</strong>',
	'ORDER_BY'									=> 'Sortuj według',

	'POLL_FROM_FORUMS'							=> 'Wyświetl ankiety z forów',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Tylko ankiety z wybranych forów będą wyświetlane tak długo, jak nie określono tematów powyżej',
	'POLL_FROM_GROUPS'							=> 'Wyświetl ankiety z grup(ów)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Tylko ankiety członków wybranych grup będą wyświetlane tak długo, jak żaden użytkownik jest/nie jest określony powyżej',
	'POLL_FROM_TOPICS'							=> 'Wyświetl ankiety z tematów',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(y) tematów do pobrania z ankiet, oddzielone przez <strong>przecinkami</strong>(,). Pozostaw puste, aby wybrać dowolny temat.',
	'POLL_FROM_USERS'							=> 'Wyświetl ankiety od użytkownika(i)',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id(y) użytkownika(ów) których ankiety chcesz wyświetlać, oddzielone przez <strong>komend</strong>(,). Pozostaw puste, aby wybrać ankiety od dowolnego użytkownika.',
	'POSTS_TITLE_LIMIT'							=> 'Maksymalna liczba znaków dla tytułu postu',
	'PREVIEW_MAX_CHARS'							=> 'Liczba znaków do podglądu',

	'QUERY_TYPE'								=> 'Tryb wyświetlania',

	'ROTATE_DAILY'								=> 'Codziennie',
	'ROTATE_HOURLY'								=> 'Godzina',
	'ROTATE_MONTHLY'							=> 'Miesięcznie',
	'ROTATE_PAGELOAD'							=> 'Wczytywanie strony',
	'ROTATE_WEEKLY'								=> 'Tygodniowe',

	'SAMPLES'									=> 'Próbki',
	'SCRIPTS'									=> 'Skrypty',
	'SELECT_FORUMS'								=> 'Wybierz fora',
	'SELECT_FORUMS_EXPLAIN'						=> 'Wybierz fora, z których chcesz wyświetlać tematy/posty. Pozostaw puste, aby wybrać z wszystkich forów',
	'SELECT_MENU'								=> 'Wybierz Menu',
	'SELECT_PROFILE_FIELDS'						=> 'Wybierz pola profilu',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Wyświetlane będą tylko wybrane pola profilowe, jeśli są dostępne.',
	'SHOW_FIRST_POST'							=> 'Pierwszy post',
	'SHOW_HIDE_ME'								=> 'Zezwolić na ukrycie statusu online?',
	'SHOW_LAST_POST'							=> 'Ostatni post',
	'SHOW_MEMBER_MENU'							=> 'Pokaż menu użytkownika?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Zamień pole logowania na menu użytkownika jeśli użytkownik jest zalogowany',
	'SHOW_WORD_COUNT'							=> 'Pokazać liczbę słów?',

	'TEMPLATE'									=> 'Szablon',
	'TOPIC_TITLE_LIMIT'							=> 'Maksymalna liczba znaków dla tytułu tematu',
	'TOPIC_TYPE'								=> 'Typ tematu',
	'TOPIC_TYPE_EXPLAIN'						=> 'Wybierz typy tematów, które chcesz wyświetlić. Pozostaw pola niezaznaczone aby wybrać spośród wszystkich typów tematów',
	'TOPICS_LOOK_BACK'							=> 'Spójrz z powrotem',
	'TOPICS_ONLY'								=> 'Tylko tematy?',
	'TOPICS_PER_PAGE'							=> 'Na stronę',

	'WORD_MAX_SIZE'								=> 'Maksymalny rozmiar czcionki',
	'WORD_MIN_SIZE'								=> 'Minimalny rozmiar czcionki',
));
