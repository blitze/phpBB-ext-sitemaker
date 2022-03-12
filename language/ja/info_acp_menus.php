<?php
/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
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

$lang = array_merge($lang, array(
	'ACP_MENU'					=> 'メニュー',
	'ACP_MENU_MANAGE'			=> 'メニュー管理',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'ここであなたのサイトのメニューを作成し、管理することができます',
	'ADD_BULK_MENU'				=> 'メニューアイテムの一括追加',
	'ADD_BULK_MENU_EXPLAIN'		=> '同時に複数のメニュー項目を追加します。<br /> - それぞれの項目を別の行に配置します。<br /> - 親子関係を表すために項目をインデントするには、 <strong>タブ</strong> キーを使用します。<br /> - 項目とURLを次のように入力します: ホーム|index.php',
	'ADD_MENU'					=> 'メニューを追加',
	'ADD_MENU_ITEM'				=> 'メニューアイテムを追加',
	'ADD_ITEM'					=> '新しいアイテムを追加',
	'AJAX_PROCESSING'			=> '作業中',

	'CHANGE_ME'					=> '自分を変更する',

	'DELETE_ITEM'				=> 'アイテムを削除',
	'DELETE_KIDS'				=> 'ブランチを削除',
	'DELETE_MENU'				=> 'メニューを削除',
	'DELETE_MENU_CONFIRM'		=> 'このメニューを削除してもよろしいですか？<br />メニューとすべてのアイテムが削除されます',
	'DELETE_MENU_ITEM'			=> 'アイテムを削除',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'このメニューアイテムを削除してもよろしいですか？',
	'DELETE_SELECTED'			=> '選択したものを削除',

	'EDIT_ITEM'					=> 'アイテムを編集',

	'ITEM_ACTIVE'				=> 'アクティブ',
	'ITEM_INACTIVE'				=> '非アクティブ',
	'ITEM_PARENT'				=> '親',
	'ITEM_TITLE'				=> 'アイテムタイトル',
	'ITEM_TITLE_EXPLAIN'		=> '分割線の「-」に設定',
	'ITEM_TARGET'				=> 'Item Target',
	'ITEM_URL'					=> 'アイテムURL',
	'ITEM_URL_EXPLAIN'			=> '- ヘッダー<br />の場合は空白のままにする - 外部サイトは http(s)://、ftp://、など で始まる必要があります',

	'MENU_ITEMS'				=> 'メニュー項目',

	'NO_MENU_ITEMS'				=> 'メニューアイテムが作成されていません',
	'NO_PARENT'					=> '親がありません',

	'PROCESSING_ERROR'			=> '処理エラー',

	'REBUILD_TREE'				=> 'ツリーを再構築',
	'REQUIRED'					=> '必須',
	'REQUIRED_FIELDS'			=> '* 必須項目',

	'SAVE_CHANGES'				=> '変更を保存',
	'SAVE'						=> '保存',
	'SELECT_ALL'				=> 'すべて選択',

	'TARGET_BLANK'				=> '空白のページ',
	'TARGET_PARENT'				=> '親',

	'UNSAVED_CHANGES'			=> '保存されていない変更があります',

	'VISIT_PAGE'				=> 'ページを開く',
));
