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
	'ALL_TIME'						=> 'За всё время',

	'BLOCK_TITLE'					=> 'Заголовок блока',

	'CHANGE_ME'						=> 'Изменить меня',

	'DAILY_MEMBER'					=> 'Член дня',

	'FEATURED_MEMBER'				=> 'Избранный участник',
	'FEATURED_MEMBERLIST'			=> 'Список избранных участников',
	'FEEDS'							=> 'Ленты',
	'FORUM_ANNOUNCEMENTS'			=> 'Объявления форума',
	'FORUM_GLOBAL_ANNOUNCEMENTS'	=> 'Объявления Глобального форума',
	'FORUM_RECENT_POSTS'			=> 'Последние сообщения на форуме',
	'FORUM_RECENT_TOPICS'			=> 'Последние темы на форуме',
	'FORUM_STICKY_POSTS'			=> 'Закреплённые сообщения',

	'HELP'							=> 'Справка',
	'HOURLY_MEMBER'					=> 'Член часа',

	'GOOGLE_MAP'					=> 'Карта Google',

	'JOIN_DATE'						=> 'Дата вступления',

	'LAST_POST_BY_AUTHOR'			=> 'Последнее сообщение от',
	'LAST_VISITED'					=> 'Последний визит',
	'LINKS'							=> 'Ссылки',

	'MCP_SITEMAKER_CONTENT'			=> 'Содержание',
	'MEMBERS_DATE'					=> 'Дата',
	'MENU'							=> 'Меню',
	'MONTHLY_MEMBER'				=> 'Член месяца',
	'MOST_TENURED'					=> 'Самые распространенные',
	'MY_BOOKMARKS'					=> 'Мои закладки',

	'NO_BOOKMARKED_TOPICS'			=> 'У вас нет добавленных в закладки тем',
	'NO_NEW_TOPICS'					=> 'Нет новых тем для отображения',

	'POLL'							=> 'Опрос',
	'POPULAR_TOPICS'				=> 'Популярные темы',
	'POSTS_MEMBER'					=> 'Верхний плакат',
	'PROCESSING'					=> 'обработка...',

	'QTYPE_POSTS'					=> 'Поздравляем:',
	'QTYPE_RECENT'					=> 'Пожалуйста, добро пожаловать в наш новый член:',

	'RECENT_BOTS'					=> 'Последние поисковые системы',
	'RECENT_MEMBER'					=> 'Последние участники',
	'RECENT_MEMBERS'				=> 'Недавние участники',

	'SESSION_HIDE_ME'				=> 'Скрыть меня',
	'SM_NAVIGATION'					=> 'Navigation',
	'SM_TOGGLE_DROPDOWN'			=> 'Переключить выпадающий список',
	'STYLE_SWITCHER'				=> 'Переключатель стилей',

	'THIS_MONTH'					=> 'В этом месяце',
	'THIS_WEEK'						=> 'На этой неделе',
	'THIS_YEAR'						=> 'В этом году',
	'TODAY'							=> 'Сегодня',
	'TOPICS_LAST_READ'				=> 'Последние прочитанные темы',
	'TOPIC_LAST_READ'				=> 'Последнее чтение %s',
	'TOP_POSTERS'					=> 'Лучшие плакаты',

	'UCP_SITEMAKER_CONTENT'			=> 'Мои вещи',

	'VIEW_DETAILS'					=> 'Детали',
	'VIEW_USER_PROFILE'				=> 'Все около %s',

	'WEEKLY_MEMBER'					=> 'Член недели',
	'WELCOME'						=> 'Добро пожаловать',
	'WHATS_NEW'						=> 'Что нового?',
	'WORDGRAPH'						=> 'Wordgraph',
));
