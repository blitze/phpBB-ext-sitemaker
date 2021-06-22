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
	'ACP_SM_SETTINGS'	=> '设置',

	'BLOCKS_CLEANUP'			=> '方块清理',
	'BLOCKS_CLEANUP_EXPLAIN'	=> '以下项目不再存在或不可访问，因此您可以删除所有与它们相关联的方块。 请牢记其中一些可能是假肯定的',
	'BLOCKS_CLEANUP_BLOCKS'		=> '无效块(例如从未安装的扩展):',
	'BLOCKS_CLEANUP_ROUTES'		=> '不可访问/断开页面：',
	'BLOCKS_CLEANUP_STYLES'		=> '已卸载样式 (id):',
	'BLOCKS_CLEANUP_SUCCESS'	=> '成功清除块',

	'FORUM_INDEX_SETTINGS'			=> '论坛索引设置',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> '这些设置仅在没有定义启动页面时应用',

	'HIDE'			=> '隐藏',
	'HIDE_BIRTHDAY'	=> '隐藏生日部分',
	'HIDE_LOGIN'	=> '隐藏登录框',
	'HIDE_ONLINE'	=> '隐藏在线版块',

	'LAYOUT_BLOG'		=> '博客',
	'LAYOUT_CUSTOM'		=> '自定义',
	'LAYOUT_HOLYGRAIL'	=> '圣杯组织',
	'LAYOUT_PORTAL'		=> '门户网站',
	'LAYOUT_PORTAL_ALT'	=> '门户(备选)',
	'LAYOUT_SETTINGS'	=> '布局设置',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> '因缺少ID为 %s 的样式而删除站点块。',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> '已删除破损页面的站点块：<br />%s',
	'LOG_DELETED_BLOCKS'			=> '删除无效的站点块：<br />%s',

	'NAVIGATION_SETTINGS'		=> '导航设置',

	'SETTINGS_SAVED'			=> '您的设置已保存',
	'SHOW'						=> '显示',
	'SHOW_FORUM_NAV'			=> '在导航栏中显示论坛？',
	'SHOW_FORUM_NAV_EXPLAIN'	=> '当一个页面被设置为首页而不是论坛索引时，我们是否应该在导航栏中显示“论坛”',
	'SHOW_FORUM_NAV_WITH_ICON'	=> '是 - 图标：',
]);
