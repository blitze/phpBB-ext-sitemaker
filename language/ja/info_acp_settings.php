<?php

/**
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	$lang = [];
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, [
	'ACP_SITEMAKER'		=> 'SiteMaker',
	'ACP_SM_SETTINGS'	=> '設定',

	'BLOCKS_CLEANUP'			=> 'ブロックのクリーンアップ',
	'BLOCKS_CLEANUP_EXPLAIN'	=> '以下の項目が存在しないか到達不能であることが判明しました。したがって、それらに関連付けられているすべてのブロックを削除することができます。 これらのいくつかは誤検出の可能性があることに注意してください。',
	'BLOCKS_CLEANUP_BLOCKS'		=> '無効なブロック (例: アンインストールされた拡張機能から):',
	'BLOCKS_CLEANUP_ROUTES'		=> '到達不能/壊れたページ:',
	'BLOCKS_CLEANUP_STYLES'		=> 'アンインストールされたスタイル (ID):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'ブロックを正常に削除しました',

	'FORUM_INDEX_SETTINGS'			=> 'フォーラムインデックス設定',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'これらの設定はスタートページが定義されていない場合にのみ適用されます',

	'HIDE'			=> '非表示',
	'HIDE_BIRTHDAY'	=> '誕生日セクションを非表示',
	'HIDE_LOGIN'	=> 'ログインボックスを隠す',
	'HIDE_ONLINE'	=> 'オンラインの相手を非表示にする',

	'LAYOUT_BLOG'		=> 'ブログ',
	'LAYOUT_CUSTOM'		=> 'カスタム',
	'LAYOUT_HOLYGRAIL'	=> '聖杯（聖杯）',
	'LAYOUT_PORTAL'		=> 'ポータル',
	'LAYOUT_PORTAL_ALT'	=> 'ポータル (Alt)',
	'LAYOUT_SETTINGS'	=> 'レイアウト設定',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'ID %s の不足しているスタイルのためにサイメーカーブロックが削除されました',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'サイトメーカーブロックが壊れたページで削除されました:<br />%s',
	'LOG_DELETED_BLOCKS'			=> '不正なサイトマッカーブロックが削除されました:<br />%s',

	'NAVIGATION_SETTINGS'		=> 'ナビゲーション設定',

	'SETTINGS_SAVED'			=> '設定が保存されました',
	'SHOW'						=> '表示',
	'SHOW_FORUM_NAV'			=> 'ナビゲーションバーに「フォーラム」を表示しますか？',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'フォーラムインデックスの代わりにページがスタートページに設定されている場合、ナビゲーションバーに「フォーラム」を表示する必要があります',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'はい - アイコン付き:',
]);
