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
	'LIST_ARROW'			=> '箭头列表标记',
	'LIST_CIRCLE'			=> '圆形列表标记',
	'LIST_DISC'				=> '子弹列表标记',
	'LIST_SQUARE'			=> '方形列表标记',
	'LIST_NUMBERED'			=> '编号列表',
	'LIST_NUMBERED_ALPHABET' => '字母编号',
	'LIST_NUMBERED_NESTED'	=> '与小区段的编号',
	'LIST_NUMBERED_ROMAN'	=> '与罗马数字的数字',
	'LIST_NUMBERED_ZERO'	=> '前面为零的数字',
	'LIST_INLINE'			=> '内联列表',
	'LIST_INLINE_SEP'		=> '逗号分隔的列表',
	'LIST_REVERSE'			=> '反向顺序',
	'LIST_STRIPED'			=> '条形列表',
	'LIST_STACKED'			=> '堆栈列表',
	'LIST_TRIANGLE'			=> '三角形',
	'LIST_HYPHEN'			=> 'Hyphen',
	'LIST_PLUS'				=> '加号',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'Club',
	'LIST_DIAMOND'			=> '钻石：',
	'LIST_HEART'			=> '爱心',
	'LIST_STAR'				=> '星标',
	'LIST_CHECK'			=> '检查',
	'LIST_SNOWFLAKE'		=> '雪花',
	'LIST_MUSIC'			=> '音乐',
	'LIST_AUTOWIDTH'		=> '自动宽度',
	'LIST_FIT_CONTENT'		=> '适合内容',
	'LIST_2COLS'			=> '2 column list',
	'LIST_3COLS'			=> '3 columns list',
	'LIST_4COLS'			=> '4 columns list',
	'LIST_5COLS'			=> '5 columns list',
	'LIST_X_DIVIDER_DOTTED'	=> '水平虚线分隔符',
	'LIST_X_DIVIDER_LINE'	=> '水平线分隔符',
	'LIST_Y_DIVIDER_DOTTED'	=> '垂直虚线分隔符',
	'LIST_Y_DIVIDER_LINE'	=> '垂直线分隔符',

	'IMAGE_SMALL'			=> '小图像',
	'IMAGE_MEDIUM'			=> '中等图像',
	'IMAGE_LARGE'			=> '大图像',
	'IMAGE_FULL_WIDTH'		=> '全宽图像',
	'IMAGE_ALIGN_LEFT'		=> '向左浮点数',
	'IMAGE_ALIGN_RIGHT'		=> '向右浮动图像',
	'IMAGE_CIRCLE'			=> '圆形图像',
	'IMAGE_ROUNDED'			=> '圆角图像',
	'IMAGE_BORDER'			=> '带边框的图像',
	'IMAGE_BORDER_PADDING'	=> '图像边框填充',
	'IMAGE_RATIO_SQUARE'	=> '方形图像',
	'IMAGE_RATIO_4_BY_3'	=> '4 by 3 image',
	'IMAGE_RATIO_16_BY_9'	=> '16 by 9 image',

	'RESPONSIVE_SHOW'		=> '仅在小设备上显示',
	'RESPONSIVE_HIDE'		=> '在小设备上隐藏',

	'ALIGN_LEFT'			=> '左对齐文本',
	'ALIGN_CENTER'			=> 'Center文本',
	'ALIGN_RIGHT'			=> '右对齐文本',
	'NO_PADDING'			=> '无填充',
	'LABEL'					=> '标签',
	'BADGE'					=> '徽章',
	'PRIMARY_COLOR'			=> '主颜色',
	'SECONDARY_COLOR'		=> '次要颜色',
	'GRAYSCALE_COLOR'		=> '灰度',
	'INFO_COLOR'			=> '信息',
	'SUCCESS_COLOR'			=> '成功',
	'WARNING_COLOR'			=> '警告',
	'DANGER_COLOR'			=> '危险',
));
