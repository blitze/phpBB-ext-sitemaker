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
	'ALL_TIME'						=> 'За все время',

	'BLOCK_TITLE'					=> 'Заголовок блока',

	'CHANGE_ME'						=> 'Измени меня',

	'DAILY_MEMBER'					=> 'Пользователь дня',

	'FEATURED_MEMBER'				=> 'Избранный пользователь',
	'FEATURED_MEMBERLIST'			=> 'Список избранных пользователей',
	'FEEDS'							=> 'Новостные ленты',
	'FORUM_ANNOUNCEMENTS'			=> 'Объявления',
	'FORUM_GLOBAL_ANNOUNCEMENTS'	=> 'Глобальные объявления',
	'FORUM_RECENT_POSTS'			=> 'Последние сообщения',
	'FORUM_RECENT_TOPICS'			=> 'Последние темы',
	'FORUM_STICKY_POSTS'			=> 'Последние прилепленные сообщения',

	'HELP'							=> 'Справка',
	'HOURLY_MEMBER'					=> 'Пользователь часа',

	'GOOGLE_MAP'					=> 'Карты Google',

	'JOIN_DATE'						=> 'Дата регистрации',

	'LAST_POST_BY_AUTHOR'			=> 'Последнее сообщение от',
	'LAST_VISITED'					=> 'Последнее посещение',
	'LINKS'							=> 'Ссылки',

	'MCP_SITEMAKER_CONTENT'			=> 'Содержимое',
	'MEMBERS_DATE'					=> 'Дата',
	'MENU'							=> 'Меню',
	'MONTHLY_MEMBER'				=> 'Пользователь месяца',
	'MOST_TENURED'					=> 'Самый активный',
	'MY_BOOKMARKS'					=> 'Мои закладки',

	'NO_BOOKMARKED_TOPICS'			=> 'У Вас отсутствуют закладки',
	'NO_NEW_TOPICS'					=> 'Отсутствуют новые темы',

	'POLL'							=> 'Опрос',
	'POSTS_MEMBER'					=> 'Самый активный пользователь',
	'PROCESSING'					=> 'обработка ...',

	'QTYPE_POSTS'					=> 'Поздравления:',
	'QTYPE_RECENT'					=> 'Пожалуйста, поприветствуйте нового пользователя:',

	'RECENT_BOTS'					=> 'Последние поисковые запросы',
	'RECENT_MEMBER'					=> 'Новый пользователь',
	'RECENT_MEMBERS'				=> 'Новые пользователи',

	'SESSION_HIDE_ME'				=> 'Скрыть меня',
	'SM_NAVIGATION'					=> 'Навигация',
	'SM_TOGGLE_DROPDOWN'			=> 'Переключить выпадающий',
	'STYLE_SWITCHER'				=> 'Выбор стиля',

	'THIS_MONTH'					=> 'Этот месяц',
	'THIS_WEEK'						=> 'Эта неделя',
	'THIS_YEAR'						=> 'Этот год',
	'TODAY'							=> 'Сегодня',
	'TOPICS_LAST_READ'				=> 'Последние прочитанные темы',
	'TOPIC_LAST_READ'				=> 'Последнее прочитанное %s',
	'TOP_POSTERS'					=> 'Активные пользователи',

	'UCP_SITEMAKER_CONTENT'			=> 'Мои материалы',

	'VIEW_DETAILS'					=> 'Подробно',
	'VIEW_USER_PROFILE'				=> 'Все о(б) %s',

	'WEEKLY_MEMBER'					=> 'Пользователь недели',
	'WELCOME'						=> 'Добро пожаловать',
	'WHATS_NEW'						=> 'Что нового?',
	'WORDGRAPH'						=> 'Ключевые слова',
));
