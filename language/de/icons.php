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
	'ICON_ACCESSIBILITY'		=> 'Accessibility',
	'ICON_ARROWS'				=> 'Arrows',
	'ICON_BRAND'				=> 'Brand',
	'ICON_CHART'				=> 'Chart',
	'ICON_CURRENCY'				=> 'Currency',
	'ICON_DIRECTIONAL'			=> 'Directional',
	'ICON_FILE_TYPE'			=> 'File Type',
	'ICON_FORM_CONTROL'			=> 'Form Control',
	'ICON_GENDER'				=> 'Gender',
	'ICON_HAND'					=> 'Hand',
	'ICON_MEDICAL'				=> 'Medical',
	'ICON_PAYMENT'				=> 'Payment',
	'ICON_SPINNER'				=> 'Spinner',
	'ICON_TEXT_EDITOR'			=> 'Text Editor',
	'ICON_TRANSPORTATION'		=> 'Transportation',
	'ICON_VIDEO_PLAYER'			=> 'Video Player',
	'ICON_WEB_APPLICATION'		=> 'Web Application',

	'ICON_COLOR'				=> 'Color',
	'ICON_DEFAULT'				=> 'Default',
	'ICON_FLIP_BOTH'			=> 'Flip Both',
	'ICON_FLIP_HORIZONTAL'		=> 'Flip Horizontal',
	'ICON_FLIP_VERTICAL'		=> 'Flip Vertical',
	'ICON_FLOAT'				=> 'Float',
	'ICON_FLOAT_LEFT'			=> 'Left',
	'ICON_FLOAT_RIGHT'			=> 'Right',
	'ICON_FONT'					=> 'Font Icons',
	'ICON_INSERT_UPDATE'		=> 'Insert/Update',
	'ICON_MISC'					=> 'Misc',
	'ICON_MISC_BORDERED'		=> 'Bordered',
	'ICON_MISC_FIXED_WIDTH'		=> 'Fixed Width',
	'ICON_MISC_PULSE'			=> 'Pulse',
	'ICON_MISC_SPINNING'		=> 'Spinning',
	'ICON_ROTATION'				=> 'Rotation',
	'ICON_ROTATE_90'			=> '90°',
	'ICON_ROTATE_180'			=> '180°',
	'ICON_ROTATE_270'			=> '270°',
	'ICON_SIZE'					=> 'Size',
	'ICON_SIZE_LG'				=> 'Larger',
	'ICON_SIZE_SM'				=> 'Small',
	'ICON_SIZE_2X'				=> '2x',
	'ICON_SIZE_3X'				=> '3x',
	'ICON_SIZE_4X'				=> '4x',
	'ICON_SIZE_5X'				=> '5x',

	'NO_ICON'					=> 'No Icon',
));
