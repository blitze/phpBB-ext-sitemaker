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
	'ARCHIVES'									=> 'Архив',
	'AUTO_LOGIN'								=> 'Разрешить автоматический вход?',
	'FILE_MANAGER'								=> 'Менеджер файлов',
	'TOPIC_POST_IDS'							=> 'Из темы / идентификаторов сообщений',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Идентификатор(ы) тем / сообщений для извлечения вложений, разделенных <strong>запятыми</strong>(,). Укажите, предназначен ли этот список для идентификаторов тем или сообщений выше.',
	'TOPIC_POST_IDS_TYPE'						=> 'Тип идентификаторов (ниже)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Вложения',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Дни рождения',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Пользовательский блок',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Выбранный пользователь',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'Новостные ленты RSS/Atom',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Опрос',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Последние темы',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Карты Google',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Ссылки',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Окно входа',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Выбранные пользователи',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Меню пользователя',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Меню',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Мои закладки',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Статистика',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Выбор стиля',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Что нового?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Кто в сети',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Ключевые слова',

	// block views
	'BLOCK_VIEW'								=> 'Вид блоков',
	'BLOCK_VIEW_BASIC'							=> 'Basic',
	'BLOCK_VIEW_BOXED'							=> 'Boxed',
	'BLOCK_VIEW_DEFAULT'						=> 'По умолчанию',
	'BLOCK_VIEW_SIMPLE'							=> 'Простой',

	'CACHE_DURATION'							=> 'Длительность кэша',
	'CONTEXT'									=> 'Context',
	'CSS_SCRIPTS'								=> 'CSS скрипты',
	'CUSTOM_PROFILE_FIELDS'						=> 'Пользовательские поля профиля',

	'DATE_RANGE'								=> 'Диапазон дат',
	'DISPLAY_PREVIEW'							=> 'Предварительный просмотр?',

	'EDIT_ME'									=> 'Пожалуйста, отредактируйте меня',
	'ENABLE_TOPIC_TRACKING'						=> 'Следить за статусом просмотра темы?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Если включено, непрочитанные темы будут указаны, но блок не будет кэшироваться <strong>(Не рекомендуется)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Вы ввели слишком много ключевых слов для исключения. Максимально возможное количество символов - 255, вы ввели %s.',
	'EXCLUDE_WORDS'								=> 'Исключить слова',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Перечислите слова, которые вы хотите исключить из блока ключевых слово через запятую (,). Максимум 255 символов.',
	'EXPANDED'									=> 'Раскрыть',
	'EXTENSION_GROUP'							=> 'Расширения групп',

	'FEATURED_MEMBER_IDS'						=> 'Идентификатор пользователя',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Разделенный запятыми список пользователей (относится только к режиму отображения Избранных пользователей)',
	'FEED_DATA_PREVIEW'							=> 'Данные новостной ленты',
	'FEED_ITEM_TEMPLATE'						=> 'Шаблон новостной ленты',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>Подсказки:</strong><br />
		<ul class="sm-list">
			<li>Доступ к данным канала указан в переменной <strong>item</strong> Например item.title</li>
			<li>Шаблон должен соответствовать <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Синтаксису Twig</a></li>
			<li>Нажмите <strong>Примеры</strong> выше для ознакомления с примерами шаблонов</li>
			<li>Используйте <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> для получения тегов из канала, например <br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<li>Используйте Twig’s json_encode фильтр для отображения содержимого массива, например <strong><code>{{ get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Источник',
	'FEED_URL_PLACEHOLDER'						=> 'http://example.com/rss',
	'FEED_URLS'									=> 'URL новостных лент',
	'FIRST_POST_ONLY'							=> 'Только первое сообщение',
	'FIRST_POST_TIME'							=> 'Время первого сообщения',
	'FORUMS_GET_TYPE'							=> 'Получить тип',
	'FORUMS_MAX_TOPICS'							=> 'Максимум тем/сообщений',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Максимальное количество символов в заголовке',
	'FREQUENCY'									=> 'Частота',
	'FULL'										=> 'Полный',
	'FULLSCREEN'								=> 'Полный экран',

	'GET_TYPE'									=> 'Показать тему/сообщение?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Используйте эту текстовую область для ввода кода HTML.</strong><br />Обратите внимание, что любое содержимое, размещенное здесь, заменит содержимое пользовательского блока, и редактор блока будет недоступен..',
	'HOURS_SHORT'								=> 'hrs',

	'JS_SCRIPTS'								=> 'JS Scripts',

	'LAST_POST_TIME'							=> 'Время последнего сообщения',
	'LAST_READ_TIME'							=> 'Время последнего просмотра',
	'LIMIT'										=> 'Ограничение',
	'LIMIT_FORUMS'								=> 'Идентификаторы форума (опционально)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Введите идентификаторы форумов, разделенне запятой (,). Если выбрано, будут отображаться только темы из указанных форумов.',
	'LIMIT_POST_TIME'							=> 'Ограничение по времени',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Если выбрано, будут отображаться только темы, опубликованные в указанный период',

	'MAX_DEPTH'									=> 'Максимальная глубина',
	'MAX_ITEMS'									=> 'Максимальное количество элементов',
	'MAX_MEMBERS'								=> 'Макс. пользователей',
	'MAX_POSTS'									=> 'Максимальное количество сообщений',
	'MAX_TOPICS'								=> 'Максимальное количество тем',
	'MAX_WORDS'									=> 'Максимальное количество слов',
	'MAP_COORDINATES'							=> 'Координаты',
	'MAP_COORDINATES_EXPLAIN'					=> 'Введите координаты в формате: широта, долгота',
	'MAP_HEIGHT'								=> 'Высота',
	'MAP_LOCATION'								=> 'Место нахождения',
	'MAP_TITLE'									=> 'Заголовок',
	'MAP_VIEW'									=> 'Просмотр',
	'MAP_VIEW_HYBRID'							=> 'Гибридный',
	'MAP_VIEW_MAP'								=> 'Карта',
	'MAP_VIEW_SATELITE'							=> 'Спутник',
	'MAP_VIEW_TERRAIN'							=> 'Поверхность',
	'MAP_ZOOM_LEVEL'							=> 'Уровень масштабирования',
	'MEMBERS_DATE'								=> 'Дата',
	'MENU_NO_ITEMS'								=> 'Отсутствуют активные элементы для отображения',
	'MINI'										=> 'Mini',

	'OR'										=> '<strong>ИЛИ</strong>',
	'ORDER_BY'									=> 'Сортировать по',

	'POLL_FROM_FORUMS'							=> 'Показать опросы из форумов',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Будут отображаться только опросы из выбранных форумов, если темы не указаны выше',
	'POLL_FROM_GROUPS'							=> 'Показать опросы из групп(ы)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Будут отображаться только опросы участников выбранных групп, если ни один из пользователей не указан',
	'POLL_FROM_TOPICS'							=> 'Показать опросы из тем(ы)',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Идентификатор тем для получения опросов, разделенных <strong>запятыми</strong>(,). Оставьте пустым, чтобы выбрать любую тему..',
	'POLL_FROM_USERS'							=> 'Показать опросы пользователей',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Идентификаторы пользователей, чьи опросы вы хотите отобразить, разделенные <strong>запятыми</strong>(,). Оставьте пустым, чтобы выбрать опросы от любого пользователя.',
	'POSTS_TITLE_LIMIT'							=> 'Maximum # символов для заголовка сообщения',
	'PREVIEW_MAX_CHARS'							=> 'Количество символов для отображения',

	'QUERY_TYPE'								=> 'Режим отображения',

	'ROTATE_DAILY'								=> 'Ежедневный',
	'ROTATE_HOURLY'								=> 'Почасовой',
	'ROTATE_MONTHLY'							=> 'Ежемесячный',
	'ROTATE_PAGELOAD'							=> 'Загрузка страницы',
	'ROTATE_WEEKLY'								=> 'Еженедельный',

	'SAMPLES'									=> 'Примеры',
	'SCRIPTS'									=> 'Скрипты',
	'SELECT_FORUMS'								=> 'Выберите форумы',
	'SELECT_FORUMS_EXPLAIN'						=> 'Выберите форумы для отображения тем / сообщений. Оставьте пустым, чтобы выбрать из всех форумов',
	'SELECT_MENU'								=> 'Выберите Меню',
	'SELECT_PROFILE_FIELDS'						=> 'Выберите поля профиля',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Будут отображены только выбранные поля профиля, если они доступны.',
	'SHOW_FIRST_POST'							=> 'Первое сообщение',
	'SHOW_HIDE_ME'								=> 'Разрешить скрывать статус (в сети)?',
	'SHOW_LAST_POST'							=> 'Последнее сообщение',
	'SHOW_MEMBER_MENU'							=> 'Показать меню пользователя?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Заменить окно входа в меню пользователя, если пользователь авторизовался',
	'SHOW_WORD_COUNT'							=> 'Показать количество слов?',

	'TEMPLATE'									=> 'Шаблон',
	'TOPICS_ONLY'								=> 'Только темы?',
	'TOPIC_TITLE_LIMIT'							=> 'Maximum # символов для названия темы',
	'TOPIC_TYPE'								=> 'Тип темы',
	'TOPIC_TYPE_EXPLAIN'						=> 'Выберите типы тем, которые вы хотите отобразить. Оставьте не отмеченными, чтобы выбрать из всех типов темы',

	'WORD_MAX_SIZE'								=> 'Максимальный размер шрифта',
	'WORD_MIN_SIZE'								=> 'Минимальный размер шрифта',
));
