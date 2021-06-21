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
	'ADD_BLOCK_EXPLAIN'							=> '*ブロックをドラッグ＆ドロップ',
	'AJAX_ERROR'								=> 'リクエストの処理中にエラーが発生しました。もう一度やり直してください。',
	'AJAX_LOADING'								=> '読み込み中...',
	'AJAX_PROCESSING'							=> '処理中...',

	'BACKGROUND'								=> '背景',
	'BLOCKS'									=> 'ブロック',
	'BLOCKS_COPY_FROM'							=> 'ブロックをコピー',
	'BLOCK_ACTIVE'								=> 'アクティブ',
	'BLOCK_CHILD_ROUTES_ONLY'					=> '子ルートのみに表示',
	'BLOCK_CHILD_ROUTES_HIDE'					=> '子ルート上で非表示',
	'BLOCK_CLASS'								=> 'CSS クラス',
	'BLOCK_CLASS_EXPLAIN'						=> 'CSS クラスを使用したブロック外観の変更',
	'BLOCK_DESIGN'								=> '外観',
	'BLOCK_DISPLAY_TYPE'						=> '表示',
	'BLOCK_HIDE_TITLE'							=> 'ブロック名を非表示にしますか？',
	'BLOCK_INACTIVE'							=> '非アクティブ',
	'BLOCK_MISSING_TEMPLATE'					=> '必要なブロックテンプレートがありません。開発者にお問い合わせください。',
	'BLOCK_NOT_FOUND'							=> 'おっと！要求されたブロックサービスが見つかりませんでした。',
	'BLOCK_NO_DATA'								=> '表示するデータがありません',
	'BLOCK_NO_ID'								=> 'ブロックIDがありません',
	'BLOCK_PERMISSION'							=> 'アクセス許可',
	'BLOCK_PERMISSION_ALLOW'					=> '表示先',
	'BLOCK_PERMISSION_DENY'						=> '非表示:',
	'BLOCK_PERMISSION_EXPLAIN'					=> 'Ctrl + クリックで選択を切り替え',
	'BLOCK_SHOW_ALWAYS'							=> '常に表示',
	'BLOCK_STATUS'								=> 'ステータス',
	'BLOCK_UPDATED'								=> 'ブロック設定を更新しました',

	'CANCEL'									=> 'キャンセル',
	'CHILD_ROUTE'								=> '子要素',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/article',
	'CLEAR'										=> 'クリア',
	'COPY'										=> 'コピー',
	'COPY_BLOCKS'								=> 'ブロックをコピー?',
	'COPY_BLOCKS_CONFIRM'						=> '他のページからブロックをコピーしてもよろしいですか？<br /><br />このページの既存のすべてのブロックとその設定を削除し、選択したページのブロックに置き換えます。',

	'DEFAULT_LAYOUT_EXPLAIN'					=> '設定されている場合、ブロックを指定していないすべてのサイトページは、デフォルトレイアウトからブロックを継承します。 ただし、右側のオプションを使用して特定のページのデフォルトのレイアウトを上書きすることができます。',
	'DELETE'									=> '削除',
	'DELETE_ALL_BLOCKS'							=> 'すべてのブロックを削除',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'このページのすべてのブロックを削除してもよろしいですか？',
	'DELETE_BLOCK'								=> 'ブロックを削除',
	'DELETE_BLOCK_CONFIRM'						=> 'このブロックを削除してもよろしいですか？<br /><br /><br /><strong>注意:</strong> この変更を恒久的にするには、レイアウトの変更を保存する必要があります。',

	'EDIT'										=> '編集',
	'EDIT_BLOCK'								=> 'ブロックを編集',
	'EXIT_EDIT_MODE'							=> '編集モードを終了',

	'FEED_PROBLEMS'								=> '提供されたrss/atomフィードの処理中に問題が発生しました',
	'FEED_URL_MISSING'							=> '開始するには少なくとも1つのrss/atomフィードを提供してください',
	'FIELD_INVALID'								=> 'フィールド "%s" に指定された値は、無効な形式を持っています',
	'FIELD_REQUIRED'							=> '“%s”は必須項目です',
	'FIELD_TOO_LONG'							=> 'フィールド "%1$s" に指定された値が長すぎます。許容可能な最大値は %2$d です。',
	'FIELD_TOO_SHORT'							=> 'フィールド "%1$s" に指定された値が短すぎます。許容可能な最小値は %2$d です。',

	'HIDE_ALL_BLOCKS'							=> 'このページにブロックを表示しない',
	'HIDE_BLOCK_POSITIONS'						=> '次のブロック位置のブロックを表示しない:',

	'IMAGES'									=> '画像',

	'LAYOUT'									=> 'レイアウト',
	'LAYOUT_SAVED'								=> 'レイアウトは正常に保存されました！',
	'LAYOUT_SETTINGS'							=> 'レイアウト設定',
	'LEAVE_CONFIRM'								=> 'このページに保存されていない変更があります。移動する前に作業を保存してください',
	'LISTS'										=> 'リスト',

	'MAKE_DEFAULT_LAYOUT'						=> '既定のレイアウトに設定',

	'OR'										=> '<strong>または</strong>',

	'PARENT_ROUTE'								=> '親',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/articles',
	'PREDEFINED_CLASSES'						=> '定義済みクラス',

	'REDO'										=> 'Redo',
	'REMOVE_DEFAULT_LAYOUT'						=> '既定のレイアウトとして削除',
	'REMOVE_STARTPAGE'							=> 'スタートページを削除',
	'ROUTE_HIDDEN_BLOCKS'						=> 'このページでブロックは非表示にされています',
	'ROUTE_HIDDEN_POSITIONS'					=> '次の位置でブロックが非表示になっています',
	'ROUTE_UPDATED'								=> 'ページ設定を更新しました',

	'SAVE_CHANGES'								=> '変更を保存',
	'SAVE_SETTINGS'								=> '設定を保存',
	'SELECT_ICON'								=> 'アイコンを選択',
	'SETTINGS'									=> '設定',
	'SETTING_TOO_BIG'							=> '設定 "%1$s" に指定された値が高すぎます。許容可能な最大値は %2$d です。',
	'SETTING_TOO_LONG'							=> '設定 "%1$s" に指定された値が長すぎます。許容可能な最大長は %2$d です。',
	'SETTING_TOO_LOW'							=> '設定 "%1$s" に指定された値が低すぎます。最小許容値は %2$d です。',
	'SETTING_TOO_SHORT'							=> '設定 "%1$s" に指定された値が短すぎます。最小許容長は %2$d です。',
	'SET_STARTPAGE'								=> 'スタートページとして設定',

	'TITLES'									=> 'タイトル',

	'UPDATE_SIMILAR'							=> '同様の設定でブロックを更新',
	'UNDO'										=> '元に戻す',

	'VIEW_DEFAULT_LAYOUT'						=> 'デフォルトレイアウトの表示/編集',
	'VISIT_PAGE'								=> 'ページを開く',
));
