<?php

/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

/**
 * DO NOT CHANGE
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
	'ALL_TIME'						=> 'Všechny časy',

	'BLOCK_TITLE'					=> 'Titulek bloku',

	'CHANGE_ME'						=> 'Změnit mě',

	'DAILY_MEMBER'					=> 'Člen dne',

	'FEATURED_MEMBER'				=> 'Doporučený člen',
	'FEATURED_MEMBERLIST'			=> 'Seznam doporučených členů',
	'FEEDS'							=> 'Informační kanály',
	'FORUM_ANNOUNCEMENTS'			=> 'Oznámení fóra',
	'FORUM_GLOBAL_ANNOUNCEMENTS'	=> 'Globální oznámení fóra',
	'FORUM_RECENT_POSTS'			=> 'Poslední příspěvky na fóru',
	'FORUM_RECENT_TOPICS'			=> 'Poslední témata fóra',
	'FORUM_STICKY_POSTS'			=> 'Poslední označené příspěvky',

	'HELP'							=> 'Nápověda',
	'HOURLY_MEMBER'					=> 'Člen hodiny',

	'GOOGLE_MAP'					=> 'Google mapa',

	'JOIN_DATE'						=> 'Datum připojení',

	'LAST_POST_BY_AUTHOR'			=> 'Poslední příspěvek od',
	'LAST_VISITED'					=> 'Naposledy navštíveno',
	'LINKS'							=> 'Odkazy',

	'MCP_SITEMAKER_CONTENT'			=> 'Obsah',
	'MEMBERS_DATE'					=> 'Datum',
	'MENU'							=> 'Nabídka',
	'MONTHLY_MEMBER'				=> 'Člen měsíce',
	'MOST_TENURED'					=> 'Nejvytíženější',
	'MY_BOOKMARKS'					=> 'Moje záložky',

	'NO_BOOKMARKED_TOPICS'			=> 'Nemáte přiřazeny žádné téma do záložek',
	'NO_NEW_TOPICS'					=> 'Žádná nová témata k zobrazení',

	'POLL'							=> 'Anketa',
	'POPULAR_TOPICS'				=> 'Populární témata',
	'POSTS_MEMBER'					=> 'Horní plakát',
	'PROCESSING'					=> 'zpracovávání...',

	'QTYPE_POSTS'					=> 'Blahopřeji:',
	'QTYPE_RECENT'					=> 'Prosím, přivítejte našeho nejnovějšího člena:',

	'RECENT_BOTS'					=> 'Nedávné vyhledávače',
	'RECENT_MEMBER'					=> 'Nedávný člen',
	'RECENT_MEMBERS'				=> 'Poslední členové',

	'SESSION_HIDE_ME'				=> 'Schovat mě',
	'SM_NAVIGATION'					=> 'Navigace',
	'SM_TOGGLE_DROPDOWN'			=> 'Přepnout rozevírací nabídku',
	'STYLE_SWITCHER'				=> 'Přepínač stylů',

	'THIS_MONTH'					=> 'Tento měsíc',
	'THIS_WEEK'						=> 'Tento týden',
	'THIS_YEAR'						=> 'Tento rok',
	'TODAY'							=> 'Dnes',
	'TOPICS_LAST_READ'				=> 'Poslední přečtená témata',
	'TOPIC_LAST_READ'				=> 'Naposledy čteno %s',
	'TOP_POSTERS'					=> 'Nejlepší plakáty',

	'UCP_SITEMAKER_CONTENT'			=> 'Moje předměty',

	'VIEW_DETAILS'					=> 'Zobrazit podrobnosti',
	'VIEW_USER_PROFILE'				=> 'Vše o %s',

	'WEEKLY_MEMBER'					=> 'Člen týdne',
	'WELCOME'						=> 'Přivítání',
	'WHATS_NEW'						=> 'Co je nového?',
	'WORDGRAPH'						=> 'Wordgraf',
));
