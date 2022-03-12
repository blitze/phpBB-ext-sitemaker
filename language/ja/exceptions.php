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
	'EXCEPTION_FIELD_MISSING'		=> '必須項目がありません',
	'EXCEPTION_INVALID_ACTION'		=> 'アクションが存在しません',
	'EXCEPTION_INVALID_ARGUMENT'	=> '`%1$s`に無効な引数が指定されました。理由: %2$s',
	'EXCEPTION_INVALID_DATA_TYPE'	=> '指定された値は予期しないデータ型です',
	'EXCEPTION_INVALID_ENTITY'		=> '提供されたエンティティは予期しないエンティティクラスです。',
	'EXCEPTION_INVALID_PROPERTY'	=> '要求されたプロパティは存在しません',
	'EXCEPTION_OUT_OF_BOUNDS'		=> '要求された`%1$s`は存在しません',
	'EXCEPTION_SERVICE_NOT_FOUND'	=> '要求されたサービスが見つかりませんでした',
	'EXCEPTION_UNEXPECTED_VALUE'	=> '要求されたアクション `%1$s` を実行できませんでした。理由: %2$s',
));
