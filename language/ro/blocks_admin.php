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
	'ALL_TYPES'									=> 'Toate tipurile',
	'ALL_GROUPS'								=> 'Toate Grupurile',
	'ARCHIVES'									=> 'Arhive',
	'AUTO_LOGIN'								=> 'Permiteți autentificarea automată?',
	'FILE_MANAGER'								=> 'Manager fişiere',
	'TOPIC_POST_IDS'							=> 'De la ID-uri Topic/Post',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(uri) de subiecte/postări de la care să se preia atașamentele, separate prin <strong>virgulă</strong>(,). Specificați dacă această listă este pentru subiectul sau postările de mai sus.',
	'TOPIC_POST_IDS_TYPE'						=> 'Tip de ID-uri (deasupra)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Atașamente',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Data nasterii',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Bloc personalizat',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Membru Recomandat',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'Fluxuri RSS/Atom',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Sondaj forum',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Subiecte forum',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Hărţi Google',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Subiecte populare',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Link-uri',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Cutie de conectare',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Membri',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Meniu membru',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Meniu',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Marcajele mele',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Subiecte recente',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Statistici',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Comutator de stil',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Ce este nou?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Cine este online',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Cuvinte',

	// block views
	'BLOCK_VIEW'								=> 'Vizualizare bloc',
	'BLOCK_VIEW_BASIC'							=> 'Baza',
	'BLOCK_VIEW_BOXED'							=> 'Cuprins',
	'BLOCK_VIEW_DEFAULT'						=> 'Implicit',
	'BLOCK_VIEW_SIMPLE'							=> 'Simplu',

	'CACHE_DURATION'							=> 'Durată geocutie',
	'CONTEXT'									=> 'Context',
	'CSS_SCRIPTS'								=> 'CSS Scripts',
	'CUSTOM_PROFILE_FIELDS'						=> 'Câmpuri de profil personalizate',

	'DATE_RANGE'								=> 'Date Range',
	'DISPLAY_PREVIEW'							=> 'Afişare previzualizare?',

	'EDIT_ME'									=> 'Te rog editeaza-ma',
	'ENABLE_TOPIC_TRACKING'						=> 'Activați urmărirea subiectelor?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Daca sunt activate, subiectele necitite vor fi indicate, dar rezultatele blocului nu vor fi memorate in cache <strong>(nu este recomandat)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Ați introdus prea multe cuvinte pentru a le exclude. Numărul maxim de caractere posibil este 255, ați introdus %s.',
	'EXCLUDE_WORDS'								=> 'Exclude cuvintele',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Listați cuvintele pe care doriți să le excludeți din cuvintele separate prin virgulă (,). Maxim 255 de caractere.',
	'EXPANDED'									=> 'Extins',
	'EXTENSION_GROUP'							=> 'Grup de extensii',

	'FEATURED_MEMBER_IDS'						=> 'ID-uri de utilizator',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Lista utilizatorilor separați prin virgulă pentru funcție (se aplică numai la modul de afișare al membrilor recomandați)',
	'FEED_DATA_PREVIEW'							=> 'Date flux',
	'FEED_ITEM_TEMPLATE'						=> 'Temă articol',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS:</strong><br />
		<ul class="sm-list">
			<li>Access feed data in <strong>item</strong> variable e.g. item.title</li>
			<li>Template must be in <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Twig syntax</a></li>
			<li>Click <strong>Samples</strong> above for sample templates</li>
			<li>Use <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> to get any tag from the feed that we do not provide e.g.<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<li>Use Twig’s json_encode filter to see contents of array e.g. <strong><code>{{ get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Sursa',
	'FEED_URL_PLACEHOLDER'						=> 'http://exemplu.ro/rss',
	'FEED_URLS'									=> 'URL-uri flux',
	'FIRST_POST_ONLY'							=> 'Doar prima postare',
	'FIRST_POST_TIME'							=> 'Prima Postare',
	'FORUMS_GET_TYPE'							=> 'Obține tipul',
	'FORUMS_MAX_TOPICS'							=> 'Maxim subiecte/postări',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Caractere maxime per titlu',
	'FREQUENCY'									=> 'Frecvenţă',
	'FULL'										=> 'Complet',
	'FULLSCREEN'								=> 'Ecran complet',

	'GET_TYPE'									=> 'Afişare subiect/postare?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Folosește această zonă de text pentru a introduce conținut brut HTML.</strong><br />Vă rugăm să reţineţi că orice conţinut postat aici va suprascrie conţinutul blocului personalizat şi că editorul de bloc vizual nu va fi disponibil.',
	'HOURS_SHORT'								=> 'ore',

	'JS_SCRIPTS'								=> 'Scripturi JS',

	'LAST_POST_TIME'							=> 'Ultima postare',
	'LAST_READ_TIME'							=> 'Ultima lectură',
	'LIMIT'										=> 'Limită',
	'LIMIT_FORUMS'								=> 'Id forum (opţional)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Introduceți fiecare id al forumului, separat prin virgulă (,). Dacă setați, vor fi afișate doar subiectele din forumurile specificate.',
	'LIMIT_POST_TIME'							=> 'Limita de timp postare',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Dacă este setat, numai subiectele postate în perioada specificată vor fi recuperate',

	'MAX_DEPTH'									=> 'Adâncime maximă',
	'MAX_ITEMS'									=> 'Numărul maxim de elemente',
	'MAX_MEMBERS'								=> 'Max. Membri',
	'MAX_POSTS'									=> 'Numărul maxim de postări',
	'MAX_TOPICS'								=> 'Numărul maxim de subiecte',
	'MAX_WORDS'									=> 'Numărul maxim de cuvinte',
	'MANAGE_MENUS'								=> 'Gestionează meniurile',
	'MAP_COORDINATES'							=> 'Coordonate',
	'MAP_COORDINATES_EXPLAIN'					=> 'Introduceți coordonatele în formatul latitudine, longitudine',
	'MAP_HEIGHT'								=> 'Înălțime',
	'MAP_LOCATION'								=> 'Locaţie',
	'MAP_TITLE'									=> 'Titlu',
	'MAP_VIEW'									=> 'Vizualizare',
	'MAP_VIEW_HYBRID'							=> 'Hibrid',
	'MAP_VIEW_MAP'								=> 'Hartă',
	'MAP_VIEW_SATELITE'							=> 'Satelit',
	'MAP_VIEW_TERRAIN'							=> 'Terrain',
	'MAP_ZOOM_LEVEL'							=> 'Nivel de mărire',
	'MEMBERS_DATE'								=> 'Data',
	'MENU_NO_ITEMS'								=> 'Niciun element activ de afișat',
	'MINI'										=> 'Mini',

	'OR'										=> '<strong>SAU</strong>',
	'ORDER_BY'									=> 'Ordonare după',

	'POLL_FROM_FORUMS'							=> 'Afişează sondajele de opinie de la forumuri',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Doar sondajele de opinie de pe forumurile selectate vor fi afişate atâta timp cât nici un subiect nu este specificat mai sus',
	'POLL_FROM_GROUPS'							=> 'Afişează sondajele de opinie din grup(uri)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Doar sondajele de opinie de la membrii grupurilor selectate vor fi afișate atâta timp cât nici un utilizator(uri) nu este) este/sunt specificate mai sus',
	'POLL_FROM_TOPICS'							=> 'Afişează sondajele de opinie de la subiect(e)',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(uri) de subiecte de la care să se preia sondajele, separate prin <strong>virgulă</strong>(,). Lăsați necompletat pentru a selecta orice subiect.',
	'POLL_FROM_USERS'							=> 'Afişează sondajele de la utilizator(i)',
	'POLL_FROM_USERS_EXPLAIN'					=> 'ID-uri de utilizator(i) ale căror sondaje dorești să afișezi, separate prin <strong>virgulă</strong>(,). Lăsați necompletat pentru a selecta sondaje de opinie de la orice utilizator.',
	'POSTS_TITLE_LIMIT'							=> 'Nr. maxim de caractere pentru titlul postării',
	'PREVIEW_MAX_CHARS'							=> 'Numărul de caractere de previzualizat',

	'QUERY_TYPE'								=> 'Mod de afişare',

	'ROTATE_DAILY'								=> 'Zilnic',
	'ROTATE_HOURLY'								=> 'Oră',
	'ROTATE_MONTHLY'							=> 'Lunar',
	'ROTATE_PAGELOAD'							=> 'Încărcare pagină',
	'ROTATE_WEEKLY'								=> 'Săptămânal',

	'SAMPLES'									=> 'Mostre',
	'SCRIPTS'									=> 'Scripturi',
	'SELECT_FORUMS'								=> 'Selectaţi forumurile',
	'SELECT_FORUMS_EXPLAIN'						=> 'Selectați forumurile din care să se afișeze subiecte/postări. Lăsați necompletat pentru a selecta din toate forumurile',
	'SELECT_MENU'								=> 'Selectare meniu',
	'SELECT_PROFILE_FIELDS'						=> 'Selectați câmpurile profilului',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Doar câmpurile de profil selectate vor fi afișate, dacă sunt disponibile.',
	'SHOW_FIRST_POST'							=> 'Prima postare',
	'SHOW_HIDE_ME'								=> 'Permite ascunderea stării online?',
	'SHOW_LAST_POST'							=> 'Ultima postare',
	'SHOW_MEMBER_MENU'							=> 'Arată meniul utilizatorului?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Înlocuiți căsuța de conectare cu meniul utilizatorului dacă utilizatorul este conectat',
	'SHOW_WORD_COUNT'							=> 'Arata numarul de cuvinte?',

	'TEMPLATE'									=> 'Șablon',
	'TOPIC_TITLE_LIMIT'							=> 'Nr. maxim de caractere pentru titlul subiectului',
	'TOPIC_TYPE'								=> 'Tip subiect',
	'TOPIC_TYPE_EXPLAIN'						=> 'Selectați tipurile de subiecte pe care doriți să le afișați. Lăsați casetele debifate pentru a selecta din toate tipurile de subiecte',
	'TOPICS_LOOK_BACK'							=> 'Priveşte înapoi',
	'TOPICS_ONLY'								=> 'Doar subiectele?',
	'TOPICS_PER_PAGE'							=> 'Pe pagină',

	'WORD_MAX_SIZE'								=> 'Dimensiunea maximă a fontului',
	'WORD_MIN_SIZE'								=> 'Dimensiunea minimă a fontului',
));
