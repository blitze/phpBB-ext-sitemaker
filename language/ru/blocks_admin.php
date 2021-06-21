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
	'ALL_TYPES'									=> 'Все типы',
	'ALL_GROUPS'								=> 'Все группы',
	'ARCHIVES'									=> 'Архивы',
	'AUTO_LOGIN'								=> 'Разрешить автовход?',
	'FILE_MANAGER'								=> 'Файловый менеджер',
	'TOPIC_POST_IDS'							=> 'Идентификаторы темы',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Идентификатор (идентификаторов) тем или постов для извлечения вложений, разделенных <strong>запятыми</strong>(,). Укажите, является ли этот список для темы или ID записи выше.',
	'TOPIC_POST_IDS_TYPE'						=> 'Тип ID (ниже)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Вложения',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'День рождения',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Пользовательский блок',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Избранный участник',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'Ленты RSS/Atom',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Форум опрос',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Темы форума',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Карты Google',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Популярные темы',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Ссылки',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Коробка входа',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Члены Комитета',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Меню участника',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Меню',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Мои закладки',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Последние темы',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Статистика',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Переключатель стилей',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Что нового?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Кто в сети',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Wordgraph',

	// block views
	'BLOCK_VIEW'								=> 'Вид блока',
	'BLOCK_VIEW_BASIC'							=> 'Базовый',
	'BLOCK_VIEW_BOXED'							=> 'Ящик',
	'BLOCK_VIEW_DEFAULT'						=> 'По умолчанию',
	'BLOCK_VIEW_SIMPLE'							=> 'Простой',

	'CACHE_DURATION'							=> 'Длительность кэша',
	'CONTEXT'									=> 'Контекст',
	'CSS_SCRIPTS'								=> 'CSS Scripts',
	'CUSTOM_PROFILE_FIELDS'						=> 'Пользовательские поля профиля',

	'DATE_RANGE'								=> 'Date Range',
	'DISPLAY_PREVIEW'							=> 'Показать предпросмотр?',

	'EDIT_ME'									=> 'Пожалуйста, отредактируйте меня',
	'ENABLE_TOPIC_TRACKING'						=> 'Включить отслеживание тем?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Если включено, непрочитанные темы будут показаны, но результаты блока не будут кэшироваться <strong>(Не рекомендуется)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Вы ввели слишком много слов для исключения. Максимальное количество возможных символов равно 255, вы ввели %s.',
	'EXCLUDE_WORDS'								=> 'Исключить слова',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Список слов, которые вы хотели бы исключить из словарного графа через запятую (,). Максимум 255 символов.',
	'EXPANDED'									=> 'Расширенный',
	'EXTENSION_GROUP'							=> 'Группа расширений',

	'FEATURED_MEMBER_IDS'						=> 'ID пользователя',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Разделенный запятыми список пользователей для функции (только для избранного пользователя)',
	'FEED_DATA_PREVIEW'							=> 'Данные канала',
	'FEED_ITEM_TEMPLATE'						=> 'Шаблон предмета',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS:</strong><br />
		<ul class="sm-list">
			<li>Access feed data in <strong>item</strong> variable e.g. item.title</li>
			<li>Template must be in <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Twig syntax</a></li>
			<li>Click <strong>Samples</strong> above for sample templates</li>
			<li>Use <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> to get any tag from the feed that we do not provide e.g.<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<li>Use Twig’s json_encode filter to see contents of array e.g. <strong><code>{{ get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Источник',
	'FEED_URL_PLACEHOLDER'						=> 'http://example.com/rss',
	'FEED_URLS'									=> 'URL ленты',
	'FIRST_POST_ONLY'							=> 'Только первый пост',
	'FIRST_POST_TIME'							=> 'Время первого поста',
	'FORUMS_GET_TYPE'							=> 'Получить тип',
	'FORUMS_MAX_TOPICS'							=> 'Максимальное количество тем/сообщений',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Максимальное количество символов в заголовке',
	'FREQUENCY'									=> 'Частота',
	'FULL'										=> 'Полностью',
	'FULLSCREEN'								=> 'Полноэкранный',

	'GET_TYPE'									=> 'Показать тему/сообщение?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Используйте этот textarea для ввода необработанного HTML содержимого.</strong><br />Пожалуйста, обратите внимание, что любое содержимое, размещенное здесь, переопределит пользовательский блок содержимого, а визуальный редактор не будет доступен.',
	'HOURS_SHORT'								=> 'час',

	'JS_SCRIPTS'								=> 'JS скрипты',

	'LAST_POST_TIME'							=> 'Время последнего поста',
	'LAST_READ_TIME'							=> 'Время последнего чтения',
	'LIMIT'										=> 'Лимит',
	'LIMIT_FORUMS'								=> 'Идентификаторы форума (опционально)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Введите идентификатор каждого форума, разделенный запятой (,). Если установлено, будут отображаться только темы из указанных форумов.',
	'LIMIT_POST_TIME'							=> 'Лимит по времени поста',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Если установлено, будут восстановлены только темы за указанный период',

	'MAX_DEPTH'									=> 'Максимальная глубина',
	'MAX_ITEMS'									=> 'Максимальное количество элементов',
	'MAX_MEMBERS'								=> 'Макс. участников',
	'MAX_POSTS'									=> 'Максимальное количество сообщений',
	'MAX_TOPICS'								=> 'Максимальное количество тем',
	'MAX_WORDS'									=> 'Максимальное количество слов',
	'MANAGE_MENUS'								=> 'Управление меню',
	'MAP_COORDINATES'							=> 'Координаты',
	'MAP_COORDINATES_EXPLAIN'					=> 'Введите координаты в виде широты, долготы',
	'MAP_HEIGHT'								=> 'Высота',
	'MAP_LOCATION'								=> 'Местоположение',
	'MAP_TITLE'									=> 'Заголовок',
	'MAP_VIEW'									=> 'Вид',
	'MAP_VIEW_HYBRID'							=> 'Гибридный',
	'MAP_VIEW_MAP'								=> 'Карта',
	'MAP_VIEW_SATELITE'							=> 'Сателит',
	'MAP_VIEW_TERRAIN'							=> 'Terrain',
	'MAP_ZOOM_LEVEL'							=> 'Масштаб',
	'MEMBERS_DATE'								=> 'Дата',
	'MENU_NO_ITEMS'								=> 'Нет активных элементов для отображения',
	'MINI'										=> 'Мини',

	'OR'										=> '<strong>ИЛИ</strong>',
	'ORDER_BY'									=> 'Сортировать по',

	'POLL_FROM_FORUMS'							=> 'Показывать опросы с форумов',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Только опросы выбранных форумов будут отображаться до тех пор, пока никакие темы не указаны выше',
	'POLL_FROM_GROUPS'							=> 'Показывать опросы групп',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Опросы только от участников выбранных групп будут показаны до тех пор, пока никакие пользователи/не указаны выше',
	'POLL_FROM_TOPICS'							=> 'Показывать опросы из темы(ов)',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Идентификатор (ы) тем для получения опросов, разделенных <strong>запятыми</strong>(,). Оставьте пустым, чтобы выбрать любую тему.',
	'POLL_FROM_USERS'							=> 'Показывать опросы от пользователя(ов)',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Идентификатор (ы) пользователей(ов), опросы которого вы хотели бы показать, разделенный <strong>запятыми</strong>(,). Оставьте пустым, чтобы выбрать опросы любого пользователя.',
	'POSTS_TITLE_LIMIT'							=> 'Максимальное количество символов для заголовка сообщения',
	'PREVIEW_MAX_CHARS'							=> 'Количество символов для предварительного просмотра',

	'QUERY_TYPE'								=> 'Режим отображения',

	'ROTATE_DAILY'								=> 'Ежедневно',
	'ROTATE_HOURLY'								=> 'Почасовой',
	'ROTATE_MONTHLY'							=> 'Ежемесячно',
	'ROTATE_PAGELOAD'							=> 'Загрузка страницы',
	'ROTATE_WEEKLY'								=> 'Еженедельно',

	'SAMPLES'									=> 'Образцы',
	'SCRIPTS'									=> 'Скрипты',
	'SELECT_FORUMS'								=> 'Выберите форумы',
	'SELECT_FORUMS_EXPLAIN'						=> 'Выберите форумы, из которых будут отображаться темы/сообщения. Оставьте пустым, чтобы выбрать из всех форумов',
	'SELECT_MENU'								=> 'Выберите меню',
	'SELECT_PROFILE_FIELDS'						=> 'Выберите поля профиля',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Отображаются только выбранные поля профиля, если таковые имеются.',
	'SHOW_FIRST_POST'							=> 'Первый пост',
	'SHOW_HIDE_ME'								=> 'Разрешить скрыть онлайн статус?',
	'SHOW_LAST_POST'							=> 'Последнее сообщение',
	'SHOW_MEMBER_MENU'							=> 'Показать меню пользователя?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Заменить поле "Логин" меню пользователя, если пользователь вошел в систему',
	'SHOW_WORD_COUNT'							=> 'Показать счетчик слов?',

	'TEMPLATE'									=> 'Шаблон',
	'TOPIC_TITLE_LIMIT'							=> 'Максимум # символов для названия темы',
	'TOPIC_TYPE'								=> 'Тип темы',
	'TOPIC_TYPE_EXPLAIN'						=> 'Выберите типы тем, которые вы хотите отобразить. Оставьте поле пустым, чтобы выбрать из всех типов тем',
	'TOPICS_LOOK_BACK'							=> 'Назад',
	'TOPICS_ONLY'								=> 'Только темы?',
	'TOPICS_PER_PAGE'							=> 'На страницу',

	'WORD_MAX_SIZE'								=> 'Максимальный размер шрифта',
	'WORD_MIN_SIZE'								=> 'Минимальный размер шрифта',
));
