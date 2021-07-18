<?php

/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
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

$lang = array_merge($lang, array(
	'ACTIVE_ELEMENT'			=> '有効な要素',
	'BORDER'					=> 'Border',
	'BORDER_COLOR'				=> '枠線の色',
	'BORDER_RADIUS'				=> '境界半径',
	'BORDER_WIDTH'				=> 'Border Width',
	'BOTTOM'					=> '下揃え',
	'BOTTOM_LEFT'				=> '左下',
	'BOTTOM_RIGHT'				=> '右下',
	'CAPITALIZE'				=> '大文字化',
	'COLOR'						=> '色',
	'DIVIDERS'					=> 'Dividers',
	'END'						=> '終了',
	'GRADIENT'					=> 'Gradient',
	'HEADERS'					=> 'ヘッダー',
	'HOVER'						=> 'Hover',
	'LEFT'						=> '左',
	'LOWERCASE'					=> '小文字',
	'MARGIN'					=> 'マージン（マージン）',
	'NAVBAR'					=> 'ナビゲーションバー',
	'NAVBAR_MENU'				=> 'Navbar menu',
	'NAVBAR_DROPDOWN'			=> 'ドロップダウン',
	'NAVBAR_LOCATION'			=> '場所',
	'NAVBAR_LOCATION_OPTION'	=> '場所 #%s',
	'NAVBAR_TOP_MENU'			=> 'トップメニュー',
	'NONE'						=> 'なし',
	'PADDING'					=> 'Padding',
	'RESPONSIVE_TOGGLE'			=> 'レスポンシブ切り替え',
	'RESPONSIVE_TOGGLE_EXPLAIN'	=> '小型（モバイル）画面でのみ閲覧可能',
	'RIGHT'						=> '右',
	'SAVE'						=> '保存',
	'SIZE'						=> 'サイズ',
	'START'						=> '開始',
	'TEXT'						=> 'テキスト',
	'TOP'						=> '上',
	'TOP_LEFT'					=> '上部左',
	'TOP_RIGHT'					=> '右',
	'TRANSFORM'					=> '変換',
	'UPPERCASE'					=> '大文字・小文字',
));
