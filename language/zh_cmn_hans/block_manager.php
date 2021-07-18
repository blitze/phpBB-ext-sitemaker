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
	'ADD_BLOCK_EXPLAIN'							=> '*拖放块',
	'AJAX_ERROR'								=> '哎呀！处理您的请求时出错。请再试一次。',
	'AJAX_LOADING'								=> '加载中...',
	'AJAX_PROCESSING'							=> '工作中...',

	'BACKGROUND'								=> '二. 背景',
	'BLOCKS'									=> '块',
	'BLOCKS_COPY_FROM'							=> '复制块',
	'BLOCK_ACTIVE'								=> '已启用',
	'BLOCK_CHILD_ROUTES_ONLY'					=> '仅在子路上显示',
	'BLOCK_CHILD_ROUTES_HIDE'					=> '在子路上隐藏',
	'BLOCK_CLASS'								=> 'CSS 类',
	'BLOCK_CLASS_EXPLAIN'						=> '使用 CSS 类修改方块外观',
	'BLOCK_DESIGN'								=> '外观',
	'BLOCK_DISPLAY_TYPE'						=> '显示',
	'BLOCK_HIDE_TITLE'							=> '隐藏方块标题？',
	'BLOCK_INACTIVE'							=> '未激活',
	'BLOCK_MISSING_TEMPLATE'					=> '缺少必需的块模板。请联系开发者',
	'BLOCK_NOT_FOUND'							=> '哎呀！找不到请求的块服务',
	'BLOCK_NO_DATA'								=> '没有要显示的数据',
	'BLOCK_NO_ID'								=> '哎呀！缺少方块id',
	'BLOCK_PERMISSION'							=> '权限',
	'BLOCK_PERMISSION_ALLOW'					=> '显示到',
	'BLOCK_PERMISSION_DENY'						=> '隐藏自',
	'BLOCK_PERMISSION_EXPLAIN'					=> '使用 CTRL + 点击切换选择',
	'BLOCK_SHOW_ALWAYS'							=> '总是显示',
	'BLOCK_STATUS'								=> '状态',
	'BLOCK_UPDATED'								=> '块设置已成功更新',

	'CANCEL'									=> '取消',
	'CHILD_ROUTE'								=> '儿童',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/my-article',
	'CLEAR'										=> '清空',
	'COPY'										=> '复制',
	'COPY_BLOCKS'								=> '复制块？',
	'COPY_BLOCKS_CONFIRM'						=> '您确定要从另一页复制方块吗？<br /><br />这将删除此页面的所有现有方块及其设置，并用所选页面的方块替换它们。',

	'DEFAULT_LAYOUT_EXPLAIN'					=> '如果设置，您没有指定区块的所有站点页面都将继承默认布局中的区块。 然而，您可以使用右边的选项覆盖特定页面的默认布局。',
	'DELETE'									=> '删除',
	'DELETE_ALL_BLOCKS'							=> '删除所有块',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> '您确定要删除此页面的所有块吗？',
	'DELETE_BLOCK'								=> '删除块',
	'DELETE_BLOCK_CONFIRM'						=> '您确定要删除此块吗？<br /><br /><br /><strong>注意：</strong> 您需要保存布局更改才能使其永久化。',

	'EDIT'										=> '编辑',
	'EDIT_BLOCK'								=> '编辑块',
	'EXIT_EDIT_MODE'							=> '退出编辑模式',

	'FEED_PROBLEMS'								=> '处理提供的 rss/atom Feed 时出现问题',
	'FEED_URL_MISSING'							=> '请至少提供一个 rss/atom 种子来开始',
	'FIELD_INVALID'								=> '为“%s”字段提供的值有一个无效格式',
	'FIELD_REQUIRED'							=> '“%s”是必填字段',
	'FIELD_TOO_LONG'							=> '为“%1$s”字段提供的值太长。最大可接受值为 %2$d。',
	'FIELD_TOO_SHORT'							=> '为字段提供的值“%1$s”太短。最低可接受值为 %2$d。',

	'HIDE_ALL_BLOCKS'							=> '不显示此页面上的块',
	'HIDE_BLOCK_POSITIONS'						=> '不要为以下方块位置显示方块：',

	'IMAGES'									=> '图像',

	'LAYOUT'									=> '布局',
	'LAYOUT_SAVED'								=> '布局保存成功！',
	'LAYOUT_SETTINGS'							=> '布局设置',
	'LEAVE_CONFIRM'								=> '您在此页面有一些未保存的更改。请在继续操作之前保存您的工作',
	'LISTS'										=> '列表',

	'MAKE_DEFAULT_LAYOUT'						=> '设置为默认布局',

	'OR'										=> '<strong>或</strong>',

	'PARENT_ROUTE'								=> '父级',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/文章',
	'PREDEFINED_CLASSES'						=> '预定义类',

	'REDO'										=> '重做',
	'REMOVE_DEFAULT_LAYOUT'						=> '移除为默认布局',
	'REMOVE_STARTPAGE'							=> '删除起始页',
	'ROUTE_HIDDEN_BLOCKS'						=> '此页面的方块被隐藏',
	'ROUTE_HIDDEN_POSITIONS'					=> '方块被隐藏在以下位置',
	'ROUTE_UPDATED'								=> '页面设置已更新',

	'SAVE_CHANGES'								=> '保存更改',
	'SAVE_SETTINGS'								=> '保存设置',
	'SELECT_ICON'								=> '选择一个图标',
	'SETTINGS'									=> '设置',
	'SETTING_TOO_BIG'							=> '为“%1$s”设置提供的值过高。最大可接受值为 %2$d。',
	'SETTING_TOO_LONG'							=> '为“%1$s”设置提供的值太长。最大可接受的长度是 %2$d。',
	'SETTING_TOO_LOW'							=> '为“%1$s”设置提供的值太低。最低可接受值为 %2$d。',
	'SETTING_TOO_SHORT'							=> '为“%1$s”设置提供的值太短。最小可接受的长度是 %2$d。',
	'SET_STARTPAGE'								=> '设置为起始页',

	'TITLES'									=> '标题',

	'UPDATE_SIMILAR'							=> '更新有相似设置的块',
	'UNDO'										=> '撤消操作',

	'VIEW_DEFAULT_LAYOUT'						=> '查看/编辑默认布局',
	'VISIT_PAGE'								=> '访问页面',
));
