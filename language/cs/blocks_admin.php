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
	'ALL_TYPES'									=> 'Všechny typy',
	'ALL_GROUPS'								=> 'Všechny skupiny',
	'ARCHIVES'									=> 'Archivy',
	'AUTO_LOGIN'								=> 'Povolit automatické přihlášení?',
	'FILE_MANAGER'								=> 'Správce souborů',
	'TOPIC_POST_IDS'							=> 'Z ID tématu/příspěvku',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'ID témat/příspěvků pro načtení příloh oddělených <strong>čárkami</strong>(,). Určete, zda je tento seznam pro téma nebo příspěvek id výše.',
	'TOPIC_POST_IDS_TYPE'						=> 'Typ ID (níže)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Přílohy',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Narozeniny',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Vlastní blok',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Doporučený člen',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'RSS/Atom kanály',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Anketa fóra',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Témata fóra',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Google Mapy',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Populární témata',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Odkazy',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Přihlašovací krabice',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Členové',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Nabídka člena',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Menu',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Moje záložky',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Nedávná témata',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Statistiky',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Přepínač stylu',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Co je nového?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Kdo je online',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Slovník',

	// block views
	'BLOCK_VIEW'								=> 'Zobrazení bloku',
	'BLOCK_VIEW_BASIC'							=> 'Základní',
	'BLOCK_VIEW_BOXED'							=> 'Krabice',
	'BLOCK_VIEW_DEFAULT'						=> 'Výchozí',
	'BLOCK_VIEW_SIMPLE'							=> 'Jednoduchý',

	'CACHE_DURATION'							=> 'Doba trvání mezipaměti',
	'CONTEXT'									=> 'Kontext',
	'CSS_SCRIPTS'								=> 'CSS Scripts',
	'CUSTOM_PROFILE_FIELDS'						=> 'Vlastní pole profilu',

	'DATE_RANGE'								=> 'Date Range',
	'DISPLAY_PREVIEW'							=> 'Zobrazit náhled?',

	'EDIT_ME'									=> 'Prosím upravte mě',
	'ENABLE_TOPIC_TRACKING'						=> 'Povolit sledování témat?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Pokud je povoleno, budou zobrazena nepřečtená témata, ale výsledky bloku nebudou uloženy v mezipaměti <strong>(nedoporučeno)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Zadali jste příliš mnoho slov k vyloučení. Maximální možný počet znaků je 255, zadali jste %s.',
	'EXCLUDE_WORDS'								=> 'Vyloučit slova',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Vyplňte slova, která chcete vyloučit ze slovníku odděleného čárkou (,). Maximálně 255 znaků.',
	'EXPANDED'									=> 'Rozšířené',
	'EXTENSION_GROUP'							=> 'Skupina rozšíření',

	'FEATURED_MEMBER_IDS'						=> 'ID uživatele',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Čárkami oddělený seznam uživatelů k funkci. (Pouze se vztahuje na režim zobrazení doporučených členů)',
	'FEED_DATA_PREVIEW'							=> 'Data kanálu',
	'FEED_ITEM_TEMPLATE'						=> 'Šablona položky',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS:</strong><br />
		<ul class="sm-list">
			<li>Přístup k datům kanálu v proměnné <strong>položka</strong> . . položka. šablona</li>
			<li>musí být v <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Twig syntaxe</a></li>
			<li>Klikni <strong>Vzorků</strong> výše pro šablony vzorových</li>
			<li>Použít <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> pro získání tagu z kanálu, který neposkytujeme.<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<li>Použijte Twig\'s json_encode filtr pro zobrazení obsahu pole. . <strong><code>{{ get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Zdroj',
	'FEED_URL_PLACEHOLDER'						=> 'http://example.com/rss',
	'FEED_URLS'									=> 'URL kanálu',
	'FIRST_POST_ONLY'							=> 'Pouze první příspěvek',
	'FIRST_POST_TIME'							=> 'Čas prvního příspěvku',
	'FORUMS_GET_TYPE'							=> 'Získat typ',
	'FORUMS_MAX_TOPICS'							=> 'Maximální počet témat a příspěvků',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Maximální počet znaků na titulek',
	'FREQUENCY'									=> 'Frekvence',
	'FULL'										=> 'Plné',
	'FULLSCREEN'								=> 'Celá obrazovka',

	'GET_TYPE'									=> 'Zobrazit téma/příspěvek?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Použijte tento text pro zadání surového HTML obsahu.</strong><br />Vezměte prosím na vědomí, že jakýkoli zde vložený obsah přepíše obsah vlastního bloku a editor vizuálních bloků nebude k dispozici.',
	'HOURS_SHORT'								=> 'hodin',

	'JS_SCRIPTS'								=> 'JS skripty',

	'LAST_POST_TIME'							=> 'Poslední čas příspěvku',
	'LAST_READ_TIME'							=> 'Poslední čtecí čas',
	'LIMIT'										=> 'Limit',
	'LIMIT_FORUMS'								=> 'ID fóra (volitelné)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Zadejte každé ID fóra oddělené čárkou (,). Pokud je nastaveno, zobrazí se pouze témata z určených fór.',
	'LIMIT_POST_TIME'							=> 'Limit podle času odeslání',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Pokud je nastaveno, budou načtena pouze témata odeslaná ve stanovené lhůtě',

	'MAX_DEPTH'									=> 'Maximální hloubka',
	'MAX_ITEMS'									=> 'Maximální počet položek',
	'MAX_MEMBERS'								=> 'Max. počet členů',
	'MAX_POSTS'									=> 'Maximální počet příspěvků',
	'MAX_TOPICS'								=> 'Maximální počet témat',
	'MAX_WORDS'									=> 'Maximální počet slov',
	'MANAGE_MENUS'								=> 'Správa nabídek',
	'MAP_COORDINATES'							=> 'Souřadnice',
	'MAP_COORDINATES_EXPLAIN'					=> 'Zadejte souřadnice ve tvaru zeměpisné šířky, zeměpisná délka',
	'MAP_HEIGHT'								=> 'Výška',
	'MAP_LOCATION'								=> 'Poloha',
	'MAP_TITLE'									=> 'Hlava 1 – Celkem',
	'MAP_VIEW'									=> 'Zobrazit',
	'MAP_VIEW_HYBRID'							=> 'Hybridy',
	'MAP_VIEW_MAP'								=> 'Mapa',
	'MAP_VIEW_SATELITE'							=> 'Satelit',
	'MAP_VIEW_TERRAIN'							=> 'Terrain',
	'MAP_ZOOM_LEVEL'							=> 'Úroveň přiblížení',
	'MEMBERS_DATE'								=> 'Datum:',
	'MENU_NO_ITEMS'								=> 'Žádné aktivní položky k zobrazení',
	'MINI'										=> 'Mini',

	'OR'										=> '<strong>NEBO</strong>',
	'ORDER_BY'									=> 'Řadit podle',

	'POLL_FROM_FORUMS'							=> 'Zobrazit ankety z fór',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Budou zobrazeny pouze ankety z vybraných fór, pokud nejsou specifikována žádná témata',
	'POLL_FROM_GROUPS'							=> 'Zobrazit ankety ze skupin(ů)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Pouze ankety od členů vybraných skupin budou zobrazeny za předpokladu, že nejsou výše specifikováni žádní uživatelé',
	'POLL_FROM_TOPICS'							=> 'Zobrazit ankety z témat',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'ID témat k načtení anket, oddělené <strong>čárkou</strong>(,). Nechte prázdné pro výběr tématu.',
	'POLL_FROM_USERS'							=> 'Zobrazit ankety od uživatelů',
	'POLL_FROM_USERS_EXPLAIN'					=> 'ID uživatelů(ů), jejichž ankety chcete zobrazit, oddělené <strong>čárkami</strong>(,). Nechte prázdné pro výběr anket od každého uživatele.',
	'POSTS_TITLE_LIMIT'							=> 'Maximální počet znaků pro název příspěvku',
	'PREVIEW_MAX_CHARS'							=> 'Počet znaků k náhledu',

	'QUERY_TYPE'								=> 'Režim zobrazení',

	'ROTATE_DAILY'								=> 'Denní',
	'ROTATE_HOURLY'								=> 'Hodina',
	'ROTATE_MONTHLY'							=> 'Měsíčně',
	'ROTATE_PAGELOAD'							=> 'Načítání stránky',
	'ROTATE_WEEKLY'								=> 'Týdenní',

	'SAMPLES'									=> 'Vzorky',
	'SCRIPTS'									=> 'Skripty',
	'SELECT_FORUMS'								=> 'Vybrat fóra',
	'SELECT_FORUMS_EXPLAIN'						=> 'Vyberte fóra, ze kterých chcete zobrazit témata/příspěvky. Nechte prázdné pro výběr ze všech fór',
	'SELECT_MENU'								=> 'Vybrat nabídku',
	'SELECT_PROFILE_FIELDS'						=> 'Vyberte pole profilu',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Zobrazí se pouze vybraná pole profilu, pokud jsou k dispozici.',
	'SHOW_FIRST_POST'							=> 'První příspěvek',
	'SHOW_HIDE_ME'								=> 'Povolit skrytí stavu online?',
	'SHOW_LAST_POST'							=> 'Poslední příspěvek',
	'SHOW_MEMBER_MENU'							=> 'Zobrazit uživatelské menu?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Nahradit přihlašovací pole v uživatelském menu, pokud je uživatel přihlášen',
	'SHOW_WORD_COUNT'							=> 'Zobrazit počet slov?',

	'TEMPLATE'									=> 'Šablona',
	'TOPIC_TITLE_LIMIT'							=> 'Maximální počet znaků pro titulek tématu',
	'TOPIC_TYPE'								=> 'Typ tématu',
	'TOPIC_TYPE_EXPLAIN'						=> 'Vyberte typy témat, které chcete zobrazit. Ponechte políčka bez zaškrtnutí pro výběr ze všech typů témat',
	'TOPICS_LOOK_BACK'							=> 'Pohled zpět',
	'TOPICS_ONLY'								=> 'Pouze témata?',
	'TOPICS_PER_PAGE'							=> 'Na stránku',

	'WORD_MAX_SIZE'								=> 'Maximální velikost písma',
	'WORD_MIN_SIZE'								=> 'Minimální velikost písma',
));
