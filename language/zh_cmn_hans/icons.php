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
	'ICON_ACCESSIBILITY'	=> '无障碍环境',
	'ICON_BRAND'			=> '品牌版',
	'ICON_CHART'			=> '图表',
	'ICON_COLOR'			=> '颜色',
	'ICON_COLOR_DEFAULT'	=> '默认颜色',
	'ICON_CURRENCY'			=> '货币',
	'ICON_DIRECTIONAL'		=> '方向',
	'ICON_FILE_TYPE'		=> '文件类型',
	'ICON_FLIP_HORIZONTAL'	=> '水平翻转',
	'ICON_FLIP_VERTICAL'	=> '垂直翻转',
	'ICON_FLOAT'			=> '浮点数',
	'ICON_FLOAT_LEFT'		=> '左侧',
	'ICON_FLOAT_RIGHT'		=> '右侧',
	'ICON_FONT'				=> '字体图标',
	'ICON_FORM_CONTROL'		=> '表单控制',
	'ICON_GENDER'			=> '两性平等',
	'ICON_HANDS'			=> '手',
	'ICON_IMAGE'			=> '图片',
	'ICON_INSERT_UPDATE'	=> '插入/更新',
	'ICON_MEDICAL'			=> '医疗服务',
	'ICON_MISC'				=> '其他',
	'ICON_MISC_BORDERED'	=> '有边框',
	'ICON_MISC_FIXED_WIDTH'	=> '固定宽度',
	'ICON_MISC_SPINNING'	=> '连环画',
	'ICON_PAYMENT'			=> '付款',
	'ICON_ROTATION'			=> '旋转',
	'ICON_ROTATION_90_DEG'	=> '90°',
	'ICON_ROTATION_180_DEG'	=> '180°',
	'ICON_ROTATION_270_DEG'	=> '270°',
	'ICON_SIZE'				=> '大小',
	'ICON_SIZE_DEFAULT'		=> '默认设置',
	'ICON_SIZE_LARGER'		=> '较大的',
	'ICON_SPINNER'			=> '旋转器',
	'ICON_TEXT_EDITOR'		=> '文本编辑器',
	'ICON_TRANSPORTATION'	=> '运输',
	'ICON_VIDEO_PLAYER'		=> '视频播放器',
	'ICON_WEB_APPLICATION'	=> 'Web 应用程序',

	'NO_ICON'				=> '无图标',
));
