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
	'TOPIC_POST_IDS'							=> 'Из темы / ID сообщения',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(s) of topics/posts to retrieve attachments from, separated by <strong>commas</strong>(,). Specify if this list is for topic or post ids above.',
	'TOPIC_POST_IDS_TYPE'						=> 'Тип ID (ниже)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Вложения',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'День рождения',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Собственный блок',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Избранный участник',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'RSS/Atom каналы',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Опрос форума',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Темы форума',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Карты Google',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Popular Topics',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Ссылки',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Вход в поле',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Члены Комитета',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Меню участника',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Меню',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Мои закладки',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Recent Topics',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Статистика',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Переключатель стилей',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Что нового?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Кто в сети',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Словарь',

	// block views
	'BLOCK_VIEW'								=> 'Вид блока',
	'BLOCK_VIEW_BASIC'							=> 'Базовый',
	'BLOCK_VIEW_BOXED'							=> 'В коробке',
	'BLOCK_VIEW_DEFAULT'						=> 'По умолчанию',
	'BLOCK_VIEW_SIMPLE'							=> 'Простой',

	'CACHE_DURATION'							=> 'Продолжительность кэша',
	'CONTEXT'									=> 'Контекст',
	'CSS_SCRIPTS'								=> 'Скрипты CSS',
	'CUSTOM_PROFILE_FIELDS'						=> 'Поля пользовательского профиля',

	'DATE_RANGE'								=> 'Диапазон дат',
	'DISPLAY_PREVIEW'							=> 'Показать предпросмотр?',

	'EDIT_ME'									=> 'Пожалуйста, измените меня',
	'ENABLE_TOPIC_TRACKING'						=> 'Включить отслеживание тем?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Если включено, будут показаны непрочитанные темы, но результаты блоков не будут кэшироваться <strong>(не рекомендуется)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Вы ввели слишком много слов для исключения. Максимальное количество символов может быть 255, вы ввели %s.',
	'EXCLUDE_WORDS'								=> 'Исключить слова',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Перечислите слова, которые вы хотите исключить из графика через запятую (,). Максимум 255 символов.',
	'EXPANDED'									=> 'Расширенный',
	'EXTENSION_GROUP'							=> 'Группа расширений',

	'FEATURED_MEMBER_IDS'						=> 'ID пользователя',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Разделенный запятыми список пользователей (применяется только к режиму отображения избранных членов)',
	'FEED_DATA_PREVIEW'							=> 'Данные ленты',
	'FEED_ITEM_TEMPLATE'						=> 'Шаблон элемента',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS:</strong><br />
		<ul class="sm-list">
			<li>Доступ к данным ленты в <strong>элементе</strong> переменной e. . itle</li>
			<li>Шаблон должен быть в <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Twig синтаксис</a></li>
			<li>Нажмите <strong>Примеры</strong> выше для образцов шаблонов</li>
			<li>Использовать <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> , чтобы получить любой тэг из ленты, который мы не предоставляем. .<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<li>Используйте фильтр json_encode Twig’s для просмотра содержимого массива. . <strong><code>{{ get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Источник',
	'FEED_URL_PLACEHOLDER'						=> 'http://example.com/rss',
	'FEED_URLS'									=> 'URL-адреса ленты',
	'FIRST_POST_ONLY'							=> 'Только первая запись',
	'FIRST_POST_TIME'							=> 'Первое время записи',
	'FORUMS_GET_TYPE'							=> 'Получить тип',
	'FORUMS_MAX_TOPICS'							=> 'Максимум тем/сообщений',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Максимальное количество символов в заголовке',
	'FREQUENCY'									=> 'Частота',
	'FULL'										=> 'Полная',
	'FULLSCREEN'								=> 'Полноэкранный',

	'GET_TYPE'									=> 'Показать тему/сообщение?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Используйте эту textarea, чтобы ввести исходное HTML-содержимое.</strong><br />Пожалуйста, обратите внимание, что любой опубликованный здесь контент будет переопределять содержимое пользовательского блока, и визуальный редактор блоков не будет доступен.',
	'HOURS_SHORT'								=> 'часов',

	'JS_SCRIPTS'								=> 'Скрипты JS',

	'LAST_POST_TIME'							=> 'Время последнего сообщения',
	'LAST_READ_TIME'							=> 'Время последнего чтения',
	'LIMIT'										=> 'Лимит',
	'LIMIT_FORUMS'								=> 'Идентификаторы форума (опционально)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Введите каждый идентификатор форума, разделенный запятыми (,). Если установлено, будут показаны только темы заданных форумов.',
	'LIMIT_POST_TIME'							=> 'Лимит по времени записи',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Если установлено, то будут получены только темы, отправленные в течение указанного периода',

	'MAX_DEPTH'									=> 'Максимальная глубина',
	'MAX_ITEMS'									=> 'Максимальное количество элементов',
	'MAX_MEMBERS'								=> 'Макс. участников',
	'MAX_POSTS'									=> 'Максимальное количество сообщений',
	'MAX_TOPICS'								=> 'Максимальное количество тем',
	'MAX_WORDS'									=> 'Максимальное количество слов',
	'MANAGE_MENUS'								=> 'Manage Menus',
	'MAP_COORDINATES'							=> 'Координаты',
	'MAP_COORDINATES_EXPLAIN'					=> 'Введите координаты в форме широты, долготы',
	'MAP_HEIGHT'								=> 'Высота',
	'MAP_LOCATION'								=> 'Местоположение',
	'MAP_TITLE'									=> 'Заголовок',
	'MAP_VIEW'									=> 'Вид',
	'MAP_VIEW_HYBRID'							=> 'Гибрид',
	'MAP_VIEW_MAP'								=> 'Карта',
	'MAP_VIEW_SATELITE'							=> 'Сателит',
	'MAP_VIEW_TERRAIN'							=> 'Местность',
	'MAP_ZOOM_LEVEL'							=> 'Масштаб',
	'MEMBERS_DATE'								=> 'Date',
	'MENU_NO_ITEMS'								=> 'Нет активных элементов для отображения',
	'MINI'										=> 'Мини',

	'OR'										=> '<strong>ИЛИ</strong>',
	'ORDER_BY'									=> 'Сортировать по',

	'POLL_FROM_FORUMS'							=> 'Отобразить опросы из форума(ов)',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Будут показаны только опросы в выбранных форумах, если выше не указано ни одной темы',
	'POLL_FROM_GROUPS'							=> 'Отобразить опросы из групп(ов)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Только опросы членов выбранных групп будут показаны до тех пор, пока ни один пользователь (пользователи) не указан выше',
	'POLL_FROM_TOPICS'							=> 'Отобразить опросы из темы(ов)',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(s) of topics to retrieve polls from, separated by <strong>commas</strong>(,). Leave blank to select any topic.',
	'POLL_FROM_USERS'							=> 'Отобразить опросы от пользователя(ов)',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id(s) of user(s) whose polls you’d like to display, separated by <strong>commas</strong>(,). Leave blank to select polls from any user.',
	'POSTS_TITLE_LIMIT'							=> 'Максимальное количество символов для заголовка записи',
	'PREVIEW_MAX_CHARS'							=> 'Количество символов для просмотра',

	'QUERY_TYPE'								=> 'Режим отображения',

	'ROTATE_DAILY'								=> 'Ежедневно',
	'ROTATE_HOURLY'								=> 'Ежечасно',
	'ROTATE_MONTHLY'							=> 'Ежемесячно',
	'ROTATE_PAGELOAD'							=> 'Загрузка страницы',
	'ROTATE_WEEKLY'								=> 'Неделя',

	'SAMPLES'									=> 'Образцы',
	'SCRIPTS'									=> 'Скрипты',
	'SELECT_FORUMS'								=> 'Выберите форумы',
	'SELECT_FORUMS_EXPLAIN'						=> 'Выберите форумы для отображения тем и сообщений. Оставьте пустым, чтобы выбрать их из всех форумов',
	'SELECT_MENU'								=> 'Выберите меню',
	'SELECT_PROFILE_FIELDS'						=> 'Выберите поля профиля',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Будут отображаться только выбранные поля профиля, если таковые имеются.',
	'SHOW_FIRST_POST'							=> 'Первая запись',
	'SHOW_HIDE_ME'								=> 'Разрешить скрыть статус?',
	'SHOW_LAST_POST'							=> 'Последний пост',
	'SHOW_MEMBER_MENU'							=> 'Показать меню пользователя?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Заменить окно входа на пользовательское меню, если пользователь вошел в систему',
	'SHOW_WORD_COUNT'							=> 'Показать кол-во слов?',

	'TEMPLATE'									=> 'Шаблон',
	'TOPIC_TITLE_LIMIT'							=> 'Максимальное количество символов для заголовка темы',
	'TOPIC_TYPE'								=> 'Тип темы',
	'TOPIC_TYPE_EXPLAIN'						=> 'Выберите типы тем, которые вы хотите отобразить. Оставьте флажки отмеченными для выбора из всех типов тем',
	'TOPICS_LOOK_BACK'							=> 'Look back',
	'TOPICS_ONLY'								=> 'Только темы?',
	'TOPICS_PER_PAGE'							=> 'Per page',

	'WORD_MAX_SIZE'								=> 'Максимальный размер шрифта',
	'WORD_MIN_SIZE'								=> 'Минимальный размер шрифта',
));
