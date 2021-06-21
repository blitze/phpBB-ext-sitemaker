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
	'ACP_MENU'					=> '菜单',
	'ACP_MENU_MANAGE'			=> '菜单管理',
	'ACP_MENU_MANAGE_EXPLAIN'	=> '您可以在此为您的站点创建和管理菜单',
	'ADD_BULK_MENU'				=> '批量添加菜单项',
	'ADD_BULK_MENU_EXPLAIN'		=> '一次添加多个菜单项。<br /> - 将每个项目放在单独一行<br /> - 使用 <strong>Tab</strong> 键缩进条目来表示父子关系<br /> - 输入条目和 URL 就这样: Home|index.php。',
	'ADD_MENU'					=> '添加菜单',
	'ADD_MENU_ITEM'				=> '添加菜单项',
	'ADD_ITEM'					=> '添加新项目',
	'AJAX_PROCESSING'			=> '工作',

	'CHANGE_ME'					=> '更改我',

	'DELETE_ITEM'				=> '删除项目',
	'DELETE_KIDS'				=> '删除分支',
	'DELETE_MENU'				=> '删除菜单',
	'DELETE_MENU_CONFIRM'		=> '您确定要删除此菜单吗？<br />这将删除菜单及其所有项目',
	'DELETE_MENU_ITEM'			=> '删除项目',
	'DELETE_MENU_ITEM_CONFIRM'	=> '您确定要删除此菜单项吗？',
	'DELETE_SELECTED'			=> '删除选中的',

	'EDIT_ITEM'					=> '编辑项目',

	'ITEM_ACTIVE'				=> '已启用',
	'ITEM_INACTIVE'				=> '未激活',
	'ITEM_PARENT'				=> '父级',
	'ITEM_TITLE'				=> '项目标题',
	'ITEM_TITLE_EXPLAIN'		=> '设置为分隔符',
	'ITEM_TARGET'				=> 'Item Target',
	'ITEM_URL'					=> '项目网址',
	'ITEM_URL_EXPLAIN'			=> '- 为标题<br />留空-外部站点必须以 http(s)://, ftp://, //, 等开头。',

	'MENU_ITEMS'				=> '菜单项',

	'NO_MENU_ITEMS'				=> '未创建任何菜单项',
	'NO_PARENT'					=> '无父类',

	'PROCESSING_ERROR'			=> '处理错误',

	'REBUILD_TREE'				=> '重建树',
	'REQUIRED'					=> '必填',
	'REQUIRED_FIELDS'			=> '* 必填字段',

	'SAVE_CHANGES'				=> '保存更改',
	'SAVE'						=> '保存',
	'SELECT_ALL'				=> '选择所有',

	'TARGET_BLANK'				=> '空白页面',
	'TARGET_PARENT'				=> '父级',

	'UNSAVED_CHANGES'			=> '您有未保存的更改',

	'VISIT_PAGE'				=> '访问页面',
));
