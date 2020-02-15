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
	'ICON_ACCESSIBILITY'	=> 'Accessibility',
	'ICON_BRAND'			=> 'Brand',
	'ICON_CHART'			=> 'Chart',
	'ICON_COLOR'			=> 'Color',
	'ICON_COLOR_DEFAULT'	=> 'Default Color',
	'ICON_CURRENCY'			=> 'Currency',
	'ICON_DIRECTIONAL'		=> 'Directional',
	'ICON_FILE_TYPE'		=> 'File Type',
	'ICON_FLIP_HORIZONTAL'	=> 'Flip Horizontal',
	'ICON_FLIP_VERTICAL'	=> 'Flip Vertical',
	'ICON_FLOAT'			=> 'Float',
	'ICON_FLOAT_LEFT'		=> 'Left',
	'ICON_FLOAT_RIGHT'		=> 'Right',
	'ICON_FONT'				=> 'Font Icons',
	'ICON_FORM_CONTROL'		=> 'Form Control',
	'ICON_GENDER'			=> 'Gender',
	'ICON_HANDS'			=> 'Hands',
	'ICON_IMAGE'			=> 'Image',
	'ICON_INSERT_UPDATE'	=> 'Insert/Update',
	'ICON_MEDICAL'			=> 'Medical',
	'ICON_MISC'				=> 'Misc',
	'ICON_MISC_BORDERED'	=> 'Bordered',
	'ICON_MISC_FIXED_WIDTH'	=> 'Fixed Width',
	'ICON_MISC_SPINNING'	=> 'Spinning',
	'ICON_PAYMENT'			=> 'Payment',
	'ICON_ROTATION'			=> 'Rotation',
	'ICON_ROTATION_90_DEG'	=> '90°',
	'ICON_ROTATION_180_DEG'	=> '180°',
	'ICON_ROTATION_270_DEG'	=> '270°',
	'ICON_SIZE'				=> 'Size',
	'ICON_SIZE_DEFAULT'		=> 'Default',
	'ICON_SIZE_LARGER'		=> 'Larger',
	'ICON_SPINNER'			=> 'Spinner',
	'ICON_TEXT_EDITOR'		=> 'Text Editor',
	'ICON_TRANSPORTATION'	=> 'Transportation',
	'ICON_VIDEO_PLAYER'		=> 'Video Player',
	'ICON_WEB_APPLICATION'	=> 'Web Application',

	'NO_ICON'				=> 'No Icon',
));
