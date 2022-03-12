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
	'ACTIVE_ELEMENT'			=> '活动元素',
	'BORDER'					=> 'Border',
	'BORDER_COLOR'				=> '边框颜色',
	'BORDER_RADIUS'				=> '边框半径',
	'BORDER_WIDTH'				=> 'Border Width',
	'BOTTOM'					=> '底部',
	'BOTTOM_LEFT'				=> '左下',
	'BOTTOM_RIGHT'				=> '右下',
	'CAPITALIZE'				=> '首页',
	'COLOR'						=> '颜色',
	'DIVIDERS'					=> '分隔符',
	'END'						=> '结束',
	'GRADIENT'					=> '渐变',
	'HEADERS'					=> '信头',
	'HOVER'						=> 'Hover',
	'LEFT'						=> '左侧',
	'LOWERCASE'					=> '小写',
	'MARGIN'					=> '边距',
	'NAVBAR'					=> '导航栏',
	'NAVBAR_MENU'				=> 'Navbar menu',
	'NAVBAR_DROPDOWN'			=> '下拉列表',
	'NAVBAR_LOCATION'			=> '地点',
	'NAVBAR_LOCATION_OPTION'	=> '位置 #%s',
	'NAVBAR_TOP_MENU'			=> '顶部菜单',
	'NONE'						=> '无',
	'PADDING'					=> 'Padding',
	'RESPONSIVE_TOGGLE'			=> '响应式切换',
	'RESPONSIVE_TOGGLE_EXPLAIN'	=> '仅在小屏幕上可查看 (移动)',
	'RIGHT'						=> '右侧',
	'SAVE'						=> '保存',
	'SIZE'						=> '大小',
	'START'						=> '开始',
	'TEXT'						=> '文本',
	'TOP'						=> '顶端',
	'TOP_LEFT'					=> '左上',
	'TOP_RIGHT'					=> '右上',
	'TRANSFORM'					=> '变换',
	'UPPERCASE'					=> '大写',
));
