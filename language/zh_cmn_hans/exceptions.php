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

$lang = array_merge($lang, array(
	'EXCEPTION_FIELD_MISSING'		=> '缺少必填字段',
	'EXCEPTION_INVALID_ACTION'		=> '该操作不存在',
	'EXCEPTION_INVALID_ARGUMENT'	=> '为`%1$s`指定的参数无效。原因： %2$s',
	'EXCEPTION_INVALID_DATA_TYPE'	=> '提供的值是意外的数据类型',
	'EXCEPTION_INVALID_ENTITY'		=> '提供的实体是意外的实体类',
	'EXCEPTION_INVALID_PROPERTY'	=> '请求的属性不存在',
	'EXCEPTION_OUT_OF_BOUNDS'		=> '请求的%1$s不存在',
	'EXCEPTION_SERVICE_NOT_FOUND'	=> '找不到请求的服务',
	'EXCEPTION_UNEXPECTED_VALUE'	=> '请求的操作%1$s无法执行。原因： %2$s',
));
