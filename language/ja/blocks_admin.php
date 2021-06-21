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
	'ALL_TYPES'									=> 'すべてのタイプ',
	'ALL_GROUPS'								=> 'すべてのグループ',
	'ARCHIVES'									=> 'アーカイブ',
	'AUTO_LOGIN'								=> '自動ログインを許可する',
	'FILE_MANAGER'								=> 'ファイルマネージャー',
	'TOPIC_POST_IDS'							=> 'トピック/投稿IDから',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(s) of topics/posts to retrieve attachments from, separated by <strong>commas</strong>(,). このリストがトピックまたは上記の投稿IDのためのものであるかを指定します。',
	'TOPIC_POST_IDS_TYPE'						=> 'IDの種類 (下記)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> '添付ファイル',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> '誕生日',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'カスタムブロック',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'おすすめメンバー',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'RSS/Atomフィード',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'フォーラムの投票',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'フォーラム・トピック',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Google Maps',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> '人気のトピック',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'リンク',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'ログインボックス',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'メンバー',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'メンバーメニュー',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'メニュー',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> '自分のブックマーク',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> '最近のトピック',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> '統計情報',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'スタイル切り替え',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> '新着情報',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'オンラインのユーザー',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'ワードグラフ',

	// block views
	'BLOCK_VIEW'								=> 'ブロックビュー',
	'BLOCK_VIEW_BASIC'							=> '基本',
	'BLOCK_VIEW_BOXED'							=> '箱',
	'BLOCK_VIEW_DEFAULT'						=> 'デフォルト',
	'BLOCK_VIEW_SIMPLE'							=> '単純な',

	'CACHE_DURATION'							=> 'キャッシュの長さ',
	'CONTEXT'									=> 'コンテキスト',
	'CSS_SCRIPTS'								=> 'CSS Scripts',
	'CUSTOM_PROFILE_FIELDS'						=> 'カスタムプロファイルフィールド',

	'DATE_RANGE'								=> 'Date Range',
	'DISPLAY_PREVIEW'							=> 'プレビューを表示？',

	'EDIT_ME'									=> '私を編集してください',
	'ENABLE_TOPIC_TRACKING'						=> 'トピック追跡を有効にしますか？',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> '有効にすると未読のトピックが表示されますが、ブロックの結果はキャッシュされません <strong>(非推奨)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> '除外する単語が多すぎます。可能な文字の最大数は 255 文字です。 %s を入力しました。',
	'EXCLUDE_WORDS'								=> '除外する単語',
	'EXCLUDE_WORDS_EXPLAIN'						=> '単語グラフから除外したい単語をカンマ(,)で区切って表示します。最大255文字までです。',
	'EXPANDED'									=> '展開済み',
	'EXTENSION_GROUP'							=> 'エクステンショングループ',

	'FEATURED_MEMBER_IDS'						=> 'ユーザー ID',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> '機能に使用するユーザのカンマ区切りリスト (注目メンバー表示モードのみに適用されます)',
	'FEED_DATA_PREVIEW'							=> 'フィードデータ',
	'FEED_ITEM_TEMPLATE'						=> 'アイテムテンプレート',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS:</strong><br />
		<ul class="sm-list">
			<li>Access feed data in <strong>item</strong> variable e.g. item.title</li>
			<li>Template must be in <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Twig syntax</a></li>
			<li>Click <strong>Samples</strong> above for sample templates</li>
			<li>Use <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> to get any tag from the feed that we do not provide e.g.<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<li>Use Twig’s json_encode filter to see contents of array e.g. <strong><code>{{ get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'ソース',
	'FEED_URL_PLACEHOLDER'						=> 'http://example.com/rss',
	'FEED_URLS'									=> 'フィードURL',
	'FIRST_POST_ONLY'							=> '最初の投稿のみ',
	'FIRST_POST_TIME'							=> '最初の投稿時間',
	'FORUMS_GET_TYPE'							=> '種類を取得',
	'FORUMS_MAX_TOPICS'							=> '最大トピック/投稿',
	'FORUMS_TITLE_MAX_CHARS'					=> 'タイトルあたりの最大文字数',
	'FREQUENCY'									=> '利息支払回数',
	'FULL'										=> 'フル',
	'FULLSCREEN'								=> '全画面',

	'GET_TYPE'									=> 'トピック/投稿を表示しますか？',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Use this textarea to enter raw HTML content.</strong><br />Please note that any content posted here will override the custom block content and the visual block editor will not be available.',
	'HOURS_SHORT'								=> '時間',

	'JS_SCRIPTS'								=> 'JSスクリプト',

	'LAST_POST_TIME'							=> '最終投稿日時',
	'LAST_READ_TIME'							=> '最終読み込み時間',
	'LIMIT'										=> '制限',
	'LIMIT_FORUMS'								=> 'フォーラムID (オプション)',
	'LIMIT_FORUMS_EXPLAIN'						=> '各フォーラムIDをカンマで区切って入力します。設定されている場合は、指定されたフォーラムのトピックのみが表示されます。',
	'LIMIT_POST_TIME'							=> '投稿時間で制限',
	'LIMIT_POST_TIME_EXPLAIN'					=> '設定されている場合、指定された期間内に投稿されたトピックのみが取得されます',

	'MAX_DEPTH'									=> '最大深さ',
	'MAX_ITEMS'									=> 'アイテムの最大数',
	'MAX_MEMBERS'								=> 'メンバー数上限',
	'MAX_POSTS'									=> '投稿の最大数',
	'MAX_TOPICS'								=> 'トピックの最大数',
	'MAX_WORDS'									=> '最大単語数',
	'MANAGE_MENUS'								=> 'メニューの管理',
	'MAP_COORDINATES'							=> '座標',
	'MAP_COORDINATES_EXPLAIN'					=> '緯度、経度のフォームに座標を入力します',
	'MAP_HEIGHT'								=> '高さ',
	'MAP_LOCATION'								=> '場所',
	'MAP_TITLE'									=> 'タイトル',
	'MAP_VIEW'									=> '表示',
	'MAP_VIEW_HYBRID'							=> 'ハイブリッド',
	'MAP_VIEW_MAP'								=> '地図',
	'MAP_VIEW_SATELITE'							=> 'Satelite',
	'MAP_VIEW_TERRAIN'							=> 'Terrain',
	'MAP_ZOOM_LEVEL'							=> 'ズームレベル',
	'MEMBERS_DATE'								=> '日付',
	'MENU_NO_ITEMS'								=> '表示するアクティブなアイテムがありません',
	'MINI'										=> 'ミニ',

	'OR'										=> '<strong>または</strong>',
	'ORDER_BY'									=> '並び順',

	'POLL_FROM_FORUMS'							=> 'フォーラムからのアンケートを表示',
	'POLL_FROM_FORUMS_EXPLAIN'					=> '上記のトピックが指定されていない限り、選択したフォーラムのアンケートのみが表示されます',
	'POLL_FROM_GROUPS'							=> 'グループからのアンケートを表示',
	'POLL_FROM_GROUPS_EXPLAIN'					=> '選択したグループのメンバからのアンケートのみが上記のユーザーが指定されていない限り表示されます',
	'POLL_FROM_TOPICS'							=> 'トピックからのアンケートを表示',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(s) of topics to retrieve polls from <strong>separated by</strong>(,). 空白のままにしてください。',
	'POLL_FROM_USERS'							=> 'ユーザからのアンケートを表示',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id(s) of user(s) who polls you want to display, separated by <strong>commas</strong>(,). 空白のままにすると、どのユーザーからでもアンケートを選択します。',
	'POSTS_TITLE_LIMIT'							=> '投稿タイトルの最大文字数',
	'PREVIEW_MAX_CHARS'							=> 'プレビューする文字数',

	'QUERY_TYPE'								=> '表示モード',

	'ROTATE_DAILY'								=> '毎日',
	'ROTATE_HOURLY'								=> '１時間ごと',
	'ROTATE_MONTHLY'							=> '月ごと',
	'ROTATE_PAGELOAD'							=> 'ページの読み込み',
	'ROTATE_WEEKLY'								=> 'Weekly',

	'SAMPLES'									=> 'サンプル',
	'SCRIPTS'									=> 'スクリプト',
	'SELECT_FORUMS'								=> 'フォーラムを選択',
	'SELECT_FORUMS_EXPLAIN'						=> 'トピック/投稿を表示するフォーラムを選択します。すべてのフォーラムから選択する場合は空白のままにします。',
	'SELECT_MENU'								=> 'メニューを選択',
	'SELECT_PROFILE_FIELDS'						=> 'プロファイルフィールドを選択',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> '利用可能な場合は、選択したプロファイル フィールドのみが表示されます。',
	'SHOW_FIRST_POST'							=> '最初の投稿',
	'SHOW_HIDE_ME'								=> 'オンラインステータスを非表示にしますか？',
	'SHOW_LAST_POST'							=> '最後の投稿',
	'SHOW_MEMBER_MENU'							=> 'ユーザーメニューを表示しますか？',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'ユーザーがログインしている場合、ログインボックスをユーザーメニューに置き換えます。',
	'SHOW_WORD_COUNT'							=> '単語数を表示しますか？',

	'TEMPLATE'									=> 'テンプレート',
	'TOPIC_TITLE_LIMIT'							=> 'トピックタイトルの最大文字数',
	'TOPIC_TYPE'								=> 'トピックの種類',
	'TOPIC_TYPE_EXPLAIN'						=> '表示したいトピックタイプを選択します。すべてのトピックタイプから選択するにはチェックを外してください。',
	'TOPICS_LOOK_BACK'							=> '振り返ってみよう',
	'TOPICS_ONLY'								=> 'トピックのみ？',
	'TOPICS_PER_PAGE'							=> 'ページごと',

	'WORD_MAX_SIZE'								=> '最大フォントサイズ',
	'WORD_MIN_SIZE'								=> '最小フォントサイズ',
));
