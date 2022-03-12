<?php
/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2019 Daniel A. (blitze)
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

/*
* These are errors which can be triggered by sending invalid data to the
* boardrules extension API.
*
* These errors will never show to a user unless they are either modifying
* the core boardrules extension code OR unless they are writing an extension
* which makes calls to this extension.
*
* Translators: Feel free to not translate these language strings
*/
$lang = array_merge($lang, array(
	'AUTHOR'			=> '作成者',
	'AUTHORS'			=> '投稿者（配列）',
	'BITRATE'			=> 'ビットレート',
	'CAPTIONS'			=> '図表番号',
	'CATEGORIES'		=> 'カテゴリ (配列)',
	'CATEGORY'			=> 'カテゴリ',
	'CHANNELS'			=> 'チャンネル',
	'CONTENT'			=> 'コンテンツ',
	'CONTRIBUTOR'		=> '貢献者',
	'CONTRIBUTORS'		=> '貢献者（配列）',
	'COPYRIGHT'			=> '著作権',
	'CREDITS'			=> 'credit',
	'DATE'				=> '日付',
	'DESCRIPTION'		=> '説明',
	'DURATION'			=> '期間',
	'ENCLOSURE'			=> 'エンクロージャー',
	'ENCLOSURES'		=> 'エンクロージャー(配列)',
	'EXPRESSION'		=> '表現',
	'FEED'				=> 'フィード',
	'FRAMERATE'			=> 'フレーム',
	'GMDATE'			=> 'GM 日付',
	'HANDLER'			=> 'handler',
	'HASHES'			=> 'ハッシュ',
	'HEIGHT'			=> '高さ',
	'ID'				=> 'id',
	'IMAGE_HEIGHT'		=> '画像の高さ',
	'IMAGE_LINK'		=> '画像リンク',
	'IMAGE_TITLE'		=> '画像のタイトル',
	'IMAGE_URL'			=> '画像URL',
	'IMAGE_WIDTH'		=> '画像の幅',
	'ITEMS'				=> '項目',
	'JAVASCRIPT'		=> 'javascript',
	'KEYWORDS'			=> 'キーワード',
	'LABEL'				=> 'ラベル',
	'LANG'				=> 'lang',
	'LATITUDE'			=> '緯度',
	'LENGTH'			=> '長さ',
	'LINK'				=> 'リンク',
	'LINKS'				=> 'リンク',
	'LONGITUDE'			=> '経度:',
	'MEDIUM'			=> 'medium',
	'NAME'				=> '名前',
	'PERMALINK'			=> 'パーマリンク',
	'PLAYER'			=> 'プレイヤー',
	'RATINGS'			=> '評価',
	'RELATIONSHIP'		=> '関係',
	'RESTRICTIONS'		=> '制限 (配列)',
	'SAMPLINGRATE'		=> 'サンプリング速度',
	'SCHEME'			=> 'スキーム',
	'SOURCE'			=> 'ソース',
	'TERM'				=> '用語',
	'THUMBNAILS'		=> 'thumbnails',
	'TITLE'				=> 'タイトル',
	'TYPE'				=> 'タイプ',
	'UPDATED_DATE'		=> '更新日時',
	'UPDATED_GMDATE'	=> '更新されたGM 日付',
	'VALUE'				=> '値',
	'WIDTH'				=> 'width',
));
