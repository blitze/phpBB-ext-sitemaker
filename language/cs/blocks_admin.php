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
	'TOPIC_POST_IDS'							=> 'Z ID tématu/příspěvků',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'ID tématu/příspěvků pro načtení příloh od,oddělených <strong>čárkou</strong>(,). Určete, jestli je tento seznam pro téma nebo post ids výše.',
	'TOPIC_POST_IDS_TYPE'						=> 'Typ ID (níže)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Přílohy',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Narozeniny',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Vlastní blok',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Doporučený člen',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'RSS/Atom kanály',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Fórum anketa',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Témata fóra',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Google mapy',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Populární témata',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Odkazy',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Přihlašovací pole',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Členové',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Nabídka členství',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Nabídka',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Moje záložky',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Nedávná témata',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Statistika',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Přepínač stylů',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Co je nového?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Kdo je online',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Wordgraf',

	// block views
	'BLOCK_VIEW'								=> 'Zobrazení bloku',
	'BLOCK_VIEW_BASIC'							=> 'Základní',
	'BLOCK_VIEW_BOXED'							=> 'Krabice',
	'BLOCK_VIEW_DEFAULT'						=> 'Výchozí nastavení',
	'BLOCK_VIEW_SIMPLE'							=> 'Jednoduché',

	'CACHE_DURATION'							=> 'Doba trvání mezipaměti',
	'CONTEXT'									=> 'Kontext',
	'CSS_SCRIPTS'								=> 'CSS skripty',
	'CUSTOM_PROFILE_FIELDS'						=> 'Vlastní pole profilu',

	'DATE_RANGE'								=> 'Časový rozsah',
	'DISPLAY_PREVIEW'							=> 'Zobrazit náhled?',

	'EDIT_ME'									=> 'Prosím upravte mě',
	'ENABLE_TOPIC_TRACKING'						=> 'Povolit sledování tématu?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Je-li povoleno, budou uvedena nepřečtená témata, ale výsledky bloku nebudou ukládány do mezipaměti <strong>(nedoporučujeme)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Zadali jste příliš mnoho slov k vynechání. Maximální možný počet znaků je 255, zadali jste %s.',
	'EXCLUDE_WORDS'								=> 'Vyloučit slova',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Uveďte slova, která chcete vyloučit ze slovníku odděleného čárkou (,). Maximálně 255 znaků.',
	'EXPANDED'									=> 'Rozšířené',
	'EXTENSION_GROUP'							=> 'Skupina rozšíření',

	'FEATURED_MEMBER_IDS'						=> 'ID uživatele',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Čárkami oddělený seznam uživatelů pro funkce (platí pouze pro režim zobrazení hlavních osob)',
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
	'FIRST_POST_TIME'							=> 'První Post čas',
	'FORUMS_GET_TYPE'							=> 'Získat typ',
	'FORUMS_MAX_TOPICS'							=> 'Maximální počet témat/příspěvků',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Maximální počet znaků na titulek',
	'FREQUENCY'									=> 'Frekvence',
	'FULL'										=> 'Plné',
	'FULLSCREEN'								=> 'Celá obrazovka',

	'GET_TYPE'									=> 'Zobrazit téma/příspěvek?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Use this textarea to enter raw HTML content.</strong><br />Vezměte prosím na vědomí, že jakýkoli zde uvedený obsah přepíše vlastní obsah bloku a editor vizuálního bloku nebude k dispozici.',
	'HOURS_SHORT'								=> 'hod.',

	'JS_SCRIPTS'								=> 'JS skripty',

	'LAST_POST_TIME'							=> 'Poslední čas příspěvku',
	'LAST_READ_TIME'							=> 'Naposledy čtený',
	'LIMIT'										=> 'Omezení',
	'LIMIT_FORUMS'								=> 'ID fóra (volitelné)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Zadejte každé ID fóra oddělené čárkou (,). Pokud je nastaveno, budou se zobrazovat pouze témata ze zadaných fór.',
	'LIMIT_POST_TIME'							=> 'Omezit na čas příspěvku',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Je-li nastaveno, budou načtena pouze témata zveřejněná během zadaného období',

	'MAX_DEPTH'									=> 'Maximální hloubka',
	'MAX_ITEMS'									=> 'Maximální počet položek',
	'MAX_MEMBERS'								=> 'Max. členů',
	'MAX_POSTS'									=> 'Maximální počet příspěvků',
	'MAX_TOPICS'								=> 'Maximální počet témat',
	'MAX_WORDS'									=> 'Maximální počet slov',
	'MANAGE_MENUS'								=> 'Správa nabídek',
	'MAP_COORDINATES'							=> 'Souřadnice',
	'MAP_COORDINATES_EXPLAIN'					=> 'Zadejte souřadnice v zeměpisné šířce formuláře, délku',
	'MAP_HEIGHT'								=> 'Výška',
	'MAP_LOCATION'								=> 'Poloha',
	'MAP_TITLE'									=> 'Titulek',
	'MAP_VIEW'									=> 'Zobrazit',
	'MAP_VIEW_HYBRID'							=> 'Hybridy',
	'MAP_VIEW_MAP'								=> 'Mapa',
	'MAP_VIEW_SATELITE'							=> 'Satelit',
	'MAP_VIEW_TERRAIN'							=> 'Terén',
	'MAP_ZOOM_LEVEL'							=> 'Úroveň přiblížení',
	'MEMBERS_DATE'								=> 'Datum',
	'MENU_NO_ITEMS'								=> 'Žádné aktivní položky k zobrazení',
	'MINI'										=> 'Malý',

	'OR'										=> '<strong>NEBO</strong>',
	'ORDER_BY'									=> 'Seřadit podle',

	'POLL_FROM_FORUMS'							=> 'Zobrazit ankety z fóra(ů)',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Pouze ankety z vybraných fór se budou zobrazovat tak dlouho, dokud nejsou zadána žádná témata výše',
	'POLL_FROM_GROUPS'							=> 'Zobrazit ankety ze skupin(í)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Pouze ankety od členů vybrané skupiny se zobrazí tak dlouho, dokud nejsou zadáni žádní uživatel(é)',
	'POLL_FROM_TOPICS'							=> 'Zobrazit ankety z témat',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'ID témat pro načtení anket odloučených <strong>čárkami</strong>(,). Pro výběr jakéhokoliv tématu ponechte prázdné.',
	'POLL_FROM_USERS'							=> 'Zobrazit ankety od uživatelů',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id(s) of user(s) jejichž ankety chcete zobrazit, odděleny <strong>čárkami</strong>(,). Pro výběr průzkumů od každého uživatele ponechte prázdné.',
	'POSTS_TITLE_LIMIT'							=> 'Maximální počet znaků pro název příspěvku',
	'PREVIEW_MAX_CHARS'							=> 'Počet znaků pro náhled',

	'QUERY_TYPE'								=> 'Režim zobrazení',

	'ROTATE_DAILY'								=> 'Denně',
	'ROTATE_HOURLY'								=> 'Každou hodinu',
	'ROTATE_MONTHLY'							=> 'Měsíčně',
	'ROTATE_PAGELOAD'							=> 'Načítání stránky',
	'ROTATE_WEEKLY'								=> 'Týdenní',

	'SAMPLES'									=> 'Ukázky',
	'SCRIPTS'									=> 'Skripty',
	'SELECT_FORUMS'								=> 'Vybrat fóra',
	'SELECT_FORUMS_EXPLAIN'						=> 'Vyberte fóra, ze kterých chcete zobrazit témata/příspěvky. Pro výběr ze všech fór ponechte prázdné.',
	'SELECT_MENU'								=> 'Vybrat nabídku',
	'SELECT_PROFILE_FIELDS'						=> 'Vyberte pole profilu',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Zobrazí se pouze vybrané profilové pole, pokud jsou k dispozici.',
	'SHOW_FIRST_POST'							=> 'První příspěvek',
	'SHOW_HIDE_ME'								=> 'Povolit skrytí online stavu?',
	'SHOW_LAST_POST'							=> 'Poslední příspěvek',
	'SHOW_MEMBER_MENU'							=> 'Zobrazit uživatelské menu?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Nahradit přihlašovací pole uživatelskou nabídkou, pokud je uživatel přihlášen',
	'SHOW_WORD_COUNT'							=> 'Zobrazit počet slov?',

	'TEMPLATE'									=> 'Šablona',
	'TOPIC_TITLE_LIMIT'							=> 'Maximální počet znaků v názvu tématu',
	'TOPIC_TYPE'								=> 'Typ tématu',
	'TOPIC_TYPE_EXPLAIN'						=> 'Vyberte typy témat, které chcete zobrazit. Nechte pole nezaškrtnuté pro výběr ze všech typů témat.',
	'TOPICS_LOOK_BACK'							=> 'Pohled zpět',
	'TOPICS_ONLY'								=> 'Pouze témata?',
	'TOPICS_PER_PAGE'							=> 'Na stránku',

	'WORD_MAX_SIZE'								=> 'Maximální velikost písma',
	'WORD_MIN_SIZE'								=> 'Minimální velikost písma',
));
