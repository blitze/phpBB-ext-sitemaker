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
	'TOPIC_POST_IDS'							=> 'Z ID tematu/postów',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(i) wątków/postów do pobrania załączników, oddzielone <strong>przecinkami</strong>(,). Określ czy ta lista jest dla tematu lub id postów powyżej.',
	'TOPIC_POST_IDS_TYPE'						=> 'Typ identyfikatorów (poniżej)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Załączniki',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Urodziny',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Własny blok',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Polecany użytkownik',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'Kanały RSS/Atom',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Ankieta na forum',
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
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Wykres słów',

	// block views
	'BLOCK_VIEW'								=> 'Widok bloku',
	'BLOCK_VIEW_BASIC'							=> 'Podstawowe',
	'BLOCK_VIEW_BOXED'							=> 'Pudełko',
	'BLOCK_VIEW_DEFAULT'						=> 'Domyślny',
	'BLOCK_VIEW_SIMPLE'							=> 'Prosty',

	'CACHE_DURATION'							=> 'Czas trwania pamięci podręcznej',
	'CONTEXT'									=> 'Kontekst',
	'CSS_SCRIPTS'								=> 'CSS Scripts',
	'CUSTOM_PROFILE_FIELDS'						=> 'Własne pola profilu',

	'DATE_RANGE'								=> 'Date Range',
	'DISPLAY_PREVIEW'							=> 'Wyświetlać podgląd?',

	'EDIT_ME'									=> 'Proszę edytować mnie',
	'ENABLE_TOPIC_TRACKING'						=> 'Włączyć śledzenie tematu?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Jeśli włączone, nieprzeczytane tematy zostaną wskazane, ale wyniki bloku nie będą buforowane <strong>(Nie zalecane)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Wprowadziłeś zbyt wiele słów, aby je wykluczyć. Maksymalna możliwa liczba znaków to 255, wpisałeś %s.',
	'EXCLUDE_WORDS'								=> 'Wyklucz słowa',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Wymień słowa, które chcesz wykluczyć z wykresu słów oddzielonego przecinkiem (,). Maksymalnie 255 znaków.',
	'EXPANDED'									=> 'Rozszerzone',
	'EXTENSION_GROUP'							=> 'Grupa rozszerzeń',

	'FEATURED_MEMBER_IDS'						=> 'ID użytkownika',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Oddzielona przecinkami lista użytkowników do funkcji (dotyczy tylko trybu wyświetlania polecanych użytkowników)',
	'FEED_DATA_PREVIEW'							=> 'Dane RSS',
	'FEED_ITEM_TEMPLATE'						=> 'Szablon Produktu',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS:</strong><br />
		<ul class="sm-list">
			<li>Access feed data in <strong>item</strong> variable e.g. item.title</li>
			<li>Template must be in <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Twig syntax</a></li>
			<li>Click <strong>Samples</strong> above for sample templates</li>
			<li>Use <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> to get any tag from the feed that we do not provide e.g.<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<li>Use Twig’s json_encode filter to see contents of array e.g. <strong><code>{{ get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Źródło',
	'FEED_URL_PLACEHOLDER'						=> 'http://example.com/rss',
	'FEED_URLS'									=> 'Adres URL kanału',
	'FIRST_POST_ONLY'							=> 'Tylko pierwszy post',
	'FIRST_POST_TIME'							=> 'Pierwszy czas po',
	'FORUMS_GET_TYPE'							=> 'Pobierz typ',
	'FORUMS_MAX_TOPICS'							=> 'Maksymalna liczba tematów/postów',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Maksymalna liczba znaków na tytuł',
	'FREQUENCY'									=> 'Częstotliwość',
	'FULL'										=> 'Pełna',
	'FULLSCREEN'								=> 'Pełny ekran',

	'GET_TYPE'									=> 'Wyświetlić temat/post?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Użyj tego obszaru tekstowego, aby wprowadzić surową zawartość HTML.</strong><br />Pamiętaj, że każda zawartość zamieszczona tutaj nadpisze niestandardową zawartość bloku, a edytor bloków wizualnych nie będzie dostępny.',
	'HOURS_SHORT'								=> 'godz.',

	'JS_SCRIPTS'								=> 'Skrypty JS',

	'LAST_POST_TIME'							=> 'Ostatni czas',
	'LAST_READ_TIME'							=> 'Czas ostatniego czytania',
	'LIMIT'										=> 'Ograniczenie',
	'LIMIT_FORUMS'								=> 'Identyfikatory forum (opcjonalne)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Wprowadź identyfikator każdego forum oddzielony przecinkiem (,). Jeśli ustawione, wyświetlane będą tylko tematy z określonych forów.',
	'LIMIT_POST_TIME'							=> 'Ogranicz przez czas wysyłania wiadomości',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Jeśli ustawione, tylko tematy opublikowane w określonym okresie będą pobierane',

	'MAX_DEPTH'									=> 'Maksymalna głębokość',
	'MAX_ITEMS'									=> 'Maksymalna liczba elementów',
	'MAX_MEMBERS'								=> 'Maksymalna liczba członków',
	'MAX_POSTS'									=> 'Maksymalna liczba postów',
	'MAX_TOPICS'								=> 'Maksymalna liczba tematów',
	'MAX_WORDS'									=> 'Maksymalna liczba słów',
	'MANAGE_MENUS'								=> 'Zarządzaj menu',
	'MAP_COORDINATES'							=> 'Współrzędne',
	'MAP_COORDINATES_EXPLAIN'					=> 'Wprowadź współrzędne w postaci szerokości geograficznej, długość geograficzna',
	'MAP_HEIGHT'								=> 'Wysokość',
	'MAP_LOCATION'								=> 'Lokalizacja',
	'MAP_TITLE'									=> 'Rozporządzenie Rady (EWG) nr 2658/87 z dnia 23 lipca 1987 r. w sprawie nomenklatury taryfowej i statystycznej oraz w sprawie Wspólnej Taryfy Celnej (Dz.U. L 256 z 7.9.1987, s. 1).',
	'MAP_VIEW'									=> 'Widok',
	'MAP_VIEW_HYBRID'							=> 'Hybrydowe',
	'MAP_VIEW_MAP'								=> 'Mapa',
	'MAP_VIEW_SATELITE'							=> 'Satelita',
	'MAP_VIEW_TERRAIN'							=> 'Terrain',
	'MAP_ZOOM_LEVEL'							=> 'Poziom powiększenia',
	'MEMBERS_DATE'								=> 'Data',
	'MENU_NO_ITEMS'								=> 'Brak aktywnych elementów do wyświetlenia',
	'MINI'										=> 'Mini',

	'OR'										=> '<strong>LUB</strong>',
	'ORDER_BY'									=> 'Sortuj według',

	'POLL_FROM_FORUMS'							=> 'Wyświetlaj ankiety z forów',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Tylko ankiety z wybranych forów będą wyświetlane tak długo, jak nie określono tematów powyżej',
	'POLL_FROM_GROUPS'							=> 'Wyświetl ankiety z grup(y)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Tylko ankiety od członków wybranych grup będą wyświetlane tak długo, jak żaden użytkownik jest/nie są określone powyżej',
	'POLL_FROM_TOPICS'							=> 'Wyświetlaj ankiety z tematów',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(i) wątków do pobrania ankiet, oddzielone przecinkami <strong></strong>(,). Pozostaw puste, aby wybrać dowolny wątek.',
	'POLL_FROM_USERS'							=> 'Wyświetl ankiety od użytkownika(ów)',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id(y) użytkownika(ów) których ankiety chcesz wyświetlić, oddzielone <strong>przecinkami</strong>(,). Pozostaw puste, aby wybrać ankiety od dowolnego użytkownika.',
	'POSTS_TITLE_LIMIT'							=> 'Maksymalnie # znaków dla tytułu wpisu',
	'PREVIEW_MAX_CHARS'							=> 'Liczba znaków do podglądu',

	'QUERY_TYPE'								=> 'Tryb wyświetlania',

	'ROTATE_DAILY'								=> 'Codziennie',
	'ROTATE_HOURLY'								=> 'Godzina',
	'ROTATE_MONTHLY'							=> 'Miesięczny',
	'ROTATE_PAGELOAD'							=> 'Wczytywanie strony',
	'ROTATE_WEEKLY'								=> 'Tygodniowo',

	'SAMPLES'									=> 'Próbki',
	'SCRIPTS'									=> 'Skrypty',
	'SELECT_FORUMS'								=> 'Wybierz fora',
	'SELECT_FORUMS_EXPLAIN'						=> 'Wybierz fora, z których chcesz wyświetlać wątki/posty. Pozostaw puste, aby wybrać spośród wszystkich forów',
	'SELECT_MENU'								=> 'Wybierz menu',
	'SELECT_PROFILE_FIELDS'						=> 'Wybierz pola profilu',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Wyświetlane będą tylko wybrane pola profilowe, jeśli są dostępne.',
	'SHOW_FIRST_POST'							=> 'Pierwszy post',
	'SHOW_HIDE_ME'								=> 'Zezwolić na ukrycie stanu online?',
	'SHOW_LAST_POST'							=> 'Ostatni post',
	'SHOW_MEMBER_MENU'							=> 'Pokazać menu użytkownika?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Zastąp pole logowania menu użytkownika, jeśli użytkownik jest zalogowany',
	'SHOW_WORD_COUNT'							=> 'Pokazać licznik słow?',

	'TEMPLATE'									=> 'Szablon',
	'TOPIC_TITLE_LIMIT'							=> 'Maksymalnie # znaków dla tytułu tematu',
	'TOPIC_TYPE'								=> 'Typ tematu',
	'TOPIC_TYPE_EXPLAIN'						=> 'Wybierz typy tematów, które chcesz wyświetlić. Pozostaw pola odznaczone, aby wybrać spośród wszystkich typów tematów',
	'TOPICS_LOOK_BACK'							=> 'Spójrz z powrotem',
	'TOPICS_ONLY'								=> 'Tylko tematy?',
	'TOPICS_PER_PAGE'							=> 'Na stronę',

	'WORD_MAX_SIZE'								=> 'Maksymalny rozmiar czcionki',
	'WORD_MIN_SIZE'								=> 'Minimalny rozmiar czcionki',
));
