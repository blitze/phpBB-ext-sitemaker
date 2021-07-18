<?php

/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
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
//
$lang = array_merge($lang, array(
	'LIST_ARROW'			=> '矢印リストマーカー',
	'LIST_CIRCLE'			=> 'サークル一覧マーカー',
	'LIST_DISC'				=> '箇条書きリストのマーカー',
	'LIST_SQUARE'			=> '正方形リストマーカー',
	'LIST_NUMBERED'			=> '番号付きリスト',
	'LIST_NUMBERED_ALPHABET' => 'アルファベットで数値',
	'LIST_NUMBERED_NESTED'	=> 'サブセクションで番号付け',
	'LIST_NUMBERED_ROMAN'	=> 'ローマ数字で数値',
	'LIST_NUMBERED_ZERO'	=> '先頭ゼロで数値',
	'LIST_INLINE'			=> 'インラインリスト',
	'LIST_INLINE_SEP'		=> 'カンマ区切りリスト',
	'LIST_REVERSE'			=> '順序を逆にする',
	'LIST_STRIPED'			=> 'ストライプリスト',
	'LIST_STACKED'			=> '積み上げリスト',
	'LIST_TRIANGLE'			=> 'Triangle',
	'LIST_HYPHEN'			=> 'ハイフン（ハイフン）',
	'LIST_PLUS'				=> 'プラス',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'クラブ',
	'LIST_DIAMOND'			=> 'ダイヤモンド',
	'LIST_HEART'			=> 'ハート',
	'LIST_STAR'				=> 'スター',
	'LIST_CHECK'			=> 'チェック',
	'LIST_SNOWFLAKE'		=> 'スノーフレーク',
	'LIST_MUSIC'			=> '音楽',
	'LIST_AUTOWIDTH'		=> 'Auto width',
	'LIST_FIT_CONTENT'		=> 'コンテンツを合わせる',
	'LIST_2COLS'			=> '2列リスト',
	'LIST_3COLS'			=> '3列リスト',
	'LIST_4COLS'			=> '4列リスト',
	'LIST_5COLS'			=> '5列リスト',
	'LIST_X_DIVIDER_DOTTED'	=> '水平方向の点線区切り線',
	'LIST_X_DIVIDER_LINE'	=> '水平線区切り線',
	'LIST_Y_DIVIDER_DOTTED'	=> '縦方向の点線区切り線',
	'LIST_Y_DIVIDER_LINE'	=> '垂直線区切り線',

	'IMAGE_SMALL'			=> '小さい画像',
	'IMAGE_MEDIUM'			=> '画像（中）',
	'IMAGE_LARGE'			=> '大きな画像',
	'IMAGE_FULL_WIDTH'		=> 'フル幅の画像',
	'IMAGE_ALIGN_LEFT'		=> '左のフロート画像',
	'IMAGE_ALIGN_RIGHT'		=> '右のフロート画像',
	'IMAGE_CIRCLE'			=> '円形の画像',
	'IMAGE_ROUNDED'			=> '丸い画像',
	'IMAGE_BORDER'			=> '境界線の画像',
	'IMAGE_BORDER_PADDING'	=> 'Image border padding',
	'IMAGE_RATIO_SQUARE'	=> '平方画像',
	'IMAGE_RATIO_4_BY_3'	=> '4×3の画像',
	'IMAGE_RATIO_16_BY_9'	=> '16 by 9 image',

	'RESPONSIVE_SHOW'		=> '小さな端末でのみ表示',
	'RESPONSIVE_HIDE'		=> '小型端末では非表示',

	'ALIGN_LEFT'			=> '左揃えのテキスト',
	'ALIGN_CENTER'			=> '中央揃えのテキスト',
	'ALIGN_RIGHT'			=> '右揃えのテキスト',
	'NO_PADDING'			=> 'No padding',
	'LABEL'					=> 'ラベル',
	'BADGE'					=> 'バッジ',
	'PRIMARY_COLOR'			=> 'プライマリ色',
	'SECONDARY_COLOR'		=> 'セカンダリカラー',
	'GRAYSCALE_COLOR'		=> 'Grayscale',
	'INFO_COLOR'			=> '情報',
	'SUCCESS_COLOR'			=> '成功',
	'WARNING_COLOR'			=> '警告',
	'DANGER_COLOR'			=> '危険',
));
