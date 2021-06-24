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
	'ALL_TYPES'									=> 'Tüm Türler',
	'ALL_GROUPS'								=> 'Tüm Gruplar',
	'ARCHIVES'									=> 'Arşivler',
	'AUTO_LOGIN'								=> 'Otomatik girişe izin ver?',
	'FILE_MANAGER'								=> 'Dosya Yöneticisi',
	'TOPIC_POST_IDS'							=> 'From Topic/Post Ids',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(s) of topics/posts to retrieve attachments from, separated by <strong>commas</strong>(,). Specify if this list is for topic or post ids above.',
	'TOPIC_POST_IDS_TYPE'						=> 'Type of IDs (below)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Ekli Dosyalar',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Doğum Günü',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Özel Blok',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Özellikli Üye',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'RSS/Atom Beslemesi',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Forum Anketi',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Forum Konuları',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Google Haritalar',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Popüler Konular',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Bağlantılar',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Giriş Kutusu',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Üyeler',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Üye Menüsü',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Menü',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Yer İmlerim',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Son Konular',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'İstatistikler',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Stil Değiştirici',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Neler yeni?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Kimler Çevrimiçi',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Sözcük Bulutu',

	// block views
	'BLOCK_VIEW'								=> 'Blok Görüntüsü',
	'BLOCK_VIEW_BASIC'							=> 'Temel',
	'BLOCK_VIEW_BOXED'							=> 'Kutulu',
	'BLOCK_VIEW_DEFAULT'						=> 'Varsayılan',
	'BLOCK_VIEW_SIMPLE'							=> 'Basit',

	'CACHE_DURATION'							=> 'Önbellek süresi',
	'CONTEXT'									=> 'İçerik',
	'CSS_SCRIPTS'								=> 'CSS Scriptleri',
	'CUSTOM_PROFILE_FIELDS'						=> 'Özel Profil Alanları',

	'DATE_RANGE'								=> 'Tarih Aralığı',
	'DISPLAY_PREVIEW'							=> 'Görüntüyü Önizle?',

	'EDIT_ME'									=> 'Lütfen beni düzenle',
	'ENABLE_TOPIC_TRACKING'						=> 'Konu izlemeyi etkinleştir?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'If enabled, unread topics will be indicated but the block results will not be cached <strong>(Not recommended)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'You have entered too many words to exclude. The maximum number of characters possible is 255, you have entered %s.',
	'EXCLUDE_WORDS'								=> 'Yok Sayılan Sözcükler',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'List the words you’d like to exclude from the wordgraph separated by a comma (,). Maximum 255 characters.',
	'EXPANDED'									=> 'Genişletilmiş',
	'EXTENSION_GROUP'							=> 'Eklenti Grubu',

	'FEATURED_MEMBER_IDS'						=> 'Kullanıcı Kimlikleri (IDleri)',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Comma separated list of users to feature (Only applies to Featured Member display mode)',
	'FEED_DATA_PREVIEW'							=> 'Feed Data',
	'FEED_ITEM_TEMPLATE'						=> 'Item Template',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS:</strong><br />
		<ul class="sm-list">
			<li>Access feed data in <strong>item</strong> variable e.g. item.title</li>
			<li>Template must be in <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Twig syntax</a></li>
			<li>Click <strong>Samples</strong> above for sample templates</li>
			<li>Use <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> to get any tag from the feed that we do not provide e.g.<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<li>Use Twig’s json_encode filter to see contents of array e.g. <strong><code>{{ get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Source',
	'FEED_URL_PLACEHOLDER'						=> 'http://example.com/rss',
	'FEED_URLS'									=> 'Feed URLs',
	'FIRST_POST_ONLY'							=> 'First Post Only',
	'FIRST_POST_TIME'							=> 'First Post Time',
	'FORUMS_GET_TYPE'							=> 'Get type',
	'FORUMS_MAX_TOPICS'							=> 'Maximum topics/posts',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Maximum characters per title',
	'FREQUENCY'									=> 'Frequency',
	'FULL'										=> 'Full',
	'FULLSCREEN'								=> 'Fullscreen',

	'GET_TYPE'									=> 'Display Topic/Post?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Use this textarea to enter raw HTML content.</strong><br />Please note that any content posted here will override the custom block content and the visual block editor will not be available.',
	'HOURS_SHORT'								=> 'hrs',

	'JS_SCRIPTS'								=> 'JS Scripts',

	'LAST_POST_TIME'							=> 'Last Post Time',
	'LAST_READ_TIME'							=> 'Last Read Time',
	'LIMIT'										=> 'Limit',
	'LIMIT_FORUMS'								=> 'Forum Ids (optional)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Enter each forum id separated by a comma (,). If set, only topics from specified forums will be displayed.',
	'LIMIT_POST_TIME'							=> 'Limit by Post time',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'If set, only topics posted within the specified period will be retrieved',

	'MAX_DEPTH'									=> 'Maximum depth',
	'MAX_ITEMS'									=> 'Maximum number of items',
	'MAX_MEMBERS'								=> 'Max. Members',
	'MAX_POSTS'									=> 'Maximum number of posts',
	'MAX_TOPICS'								=> 'Maximum number of topics',
	'MAX_WORDS'									=> 'Maximum number of words',
	'MANAGE_MENUS'								=> 'Manage Menus',
	'MAP_COORDINATES'							=> 'Coordinates',
	'MAP_COORDINATES_EXPLAIN'					=> 'Enter coordinates in the form latitude,longitude',
	'MAP_HEIGHT'								=> 'Height',
	'MAP_LOCATION'								=> 'Location',
	'MAP_TITLE'									=> 'Title',
	'MAP_VIEW'									=> 'View',
	'MAP_VIEW_HYBRID'							=> 'Hybrid',
	'MAP_VIEW_MAP'								=> 'Map',
	'MAP_VIEW_SATELITE'							=> 'Satelite',
	'MAP_VIEW_TERRAIN'							=> 'Terrain',
	'MAP_ZOOM_LEVEL'							=> 'Yakınlaştırma Düzeyi',
	'MEMBERS_DATE'								=> 'Tarih',
	'MENU_NO_ITEMS'								=> 'Görüntülenecek aktif öğe yok',
	'MINI'										=> 'Mini',

	'OR'										=> '<strong>VEYA</strong>',
	'ORDER_BY'									=> 'Sırala',

	'POLL_FROM_FORUMS'							=> 'Şu forum(lar)daki anketleri göster',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Only polls from the selected forums will be displayed as long as no topics are specified above',
	'POLL_FROM_GROUPS'							=> 'Display polls from groups(s)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Only polls from members of the selected groups will be displayed as long as no user(s) is/are specified above',
	'POLL_FROM_TOPICS'							=> 'Display polls from topic(s)',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(s) of topics to retrieve polls from, separated by <strong>commas</strong>(,). Leave blank to select any topic.',
	'POLL_FROM_USERS'							=> 'Display polls from user(s)',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id(s) of user(s) whose polls you’d like to display, separated by <strong>commas</strong>(,). Leave blank to select polls from any user.',
	'POSTS_TITLE_LIMIT'							=> 'Maximum # of characters for post title',
	'PREVIEW_MAX_CHARS'							=> 'Number of characters to preview',

	'QUERY_TYPE'								=> 'Görüntüleme modu',

	'ROTATE_DAILY'								=> 'Günlük',
	'ROTATE_HOURLY'								=> 'Saatlik',
	'ROTATE_MONTHLY'							=> 'Aylık',
	'ROTATE_PAGELOAD'							=> 'Page load',
	'ROTATE_WEEKLY'								=> 'Haftalık',

	'SAMPLES'									=> 'Örnekler',
	'SCRIPTS'									=> 'Scriptler',
	'SELECT_FORUMS'								=> 'Forumları Seçin',
	'SELECT_FORUMS_EXPLAIN'						=> 'Select the forums from which to display topics/posts. Leave blank to select from all forums',
	'SELECT_MENU'								=> 'Select Menu',
	'SELECT_PROFILE_FIELDS'						=> 'Select profile fields',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Only the selected profile fields will be displayed, if available.',
	'SHOW_FIRST_POST'							=> 'First Post',
	'SHOW_HIDE_ME'								=> 'Allow hide online status?',
	'SHOW_LAST_POST'							=> 'Last Post',
	'SHOW_MEMBER_MENU'							=> 'Show user menu?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Replace login box with user menu if user is logged in',
	'SHOW_WORD_COUNT'							=> 'Show word count?',

	'TEMPLATE'									=> 'Template',
	'TOPIC_TITLE_LIMIT'							=> 'Maximum # of characters for topic title',
	'TOPIC_TYPE'								=> 'Topic Type',
	'TOPIC_TYPE_EXPLAIN'						=> 'Select the topic types you’d like to display. Leave the boxes unchecked to select from all topic types',
	'TOPICS_LOOK_BACK'							=> 'Look back',
	'TOPICS_ONLY'								=> 'Topics only?',
	'TOPICS_PER_PAGE'							=> 'Sayfa başına',

	'WORD_MAX_SIZE'								=> 'En fazla yazı boyutu',
	'WORD_MIN_SIZE'								=> 'Minimum font size',
));
