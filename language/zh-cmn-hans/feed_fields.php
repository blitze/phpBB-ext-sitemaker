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
	'AUTHOR'			=> '作者',
	'AUTHORS'			=> '作者(数组)',
	'BITRATE'			=> '位速率',
	'CAPTIONS'			=> '标题',
	'CATEGORIES'		=> '类别(数组)',
	'CATEGORY'			=> '类别',
	'CHANNELS'			=> '频道',
	'CONTENT'			=> '内容',
	'CONTRIBUTOR'		=> '贡献者',
	'CONTRIBUTORS'		=> '贡献者(数组)',
	'COPYRIGHT'			=> '版权所有',
	'CREDITS'			=> '点数',
	'DATE'				=> '日期',
	'DESCRIPTION'		=> '描述',
	'DURATION'			=> '持续时间',
	'ENCLOSURE'			=> '附文',
	'ENCLOSURES'		=> '附文(数组)',
	'EXPRESSION'		=> '表达式',
	'FEED'				=> '订阅源',
	'FRAMERATE'			=> '帧率',
	'GMDATE'			=> 'GM 日期',
	'HANDLER'			=> 'handler',
	'HASHES'			=> '哈希值',
	'HEIGHT'			=> '高度',
	'ID'				=> 'id',
	'IMAGE_HEIGHT'		=> '图像高度',
	'IMAGE_LINK'		=> '图片链接',
	'IMAGE_TITLE'		=> '图片标题',
	'IMAGE_URL'			=> '图片网址',
	'IMAGE_WIDTH'		=> '图像宽度',
	'ITEMS'				=> '项目',
	'JAVASCRIPT'		=> 'javascript',
	'KEYWORDS'			=> '关键字',
	'LABEL'				=> '标签',
	'LANG'				=> 'lang',
	'LATITUDE'			=> '纬度',
	'LENGTH'			=> '长度',
	'LINK'				=> '链接',
	'LINKS'				=> '链接',
	'LONGITUDE'			=> '经度',
	'MEDIUM'			=> '介质',
	'NAME'				=> '名称',
	'PERMALINK'			=> '永久链接',
	'PLAYER'			=> '播放器',
	'RATINGS'			=> '评分',
	'RELATIONSHIP'		=> '关系',
	'RESTRICTIONS'		=> '限制(数组)',
	'SAMPLINGRATE'		=> '采样率',
	'SCHEME'			=> '方案',
	'SOURCE'			=> '来源',
	'TERM'				=> '学期',
	'THUMBNAILS'		=> 'thumbnails',
	'TITLE'				=> '标题',
	'TYPE'				=> '类型',
	'UPDATED_DATE'		=> '更新日期',
	'UPDATED_GMDATE'	=> '更新 GM 日期',
	'VALUE'				=> '值',
	'WIDTH'				=> 'width',
));
