<?php
/**
*
* @package phpBB Primetime [English]
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
	'ICON_BORDERED'			=> 'Bordered',
	'ICON_COLOR'			=> 'Color',
	'ICON_FIXED_WIDTH'		=> 'Fixed Width',
	'ICON_FLOAT'			=> 'Float',
	'ICON_FONT'				=> 'Font',
	'ICON_IMAGE'			=> 'Image',
	'ICON_LARGER'			=> 'Larger',
	'ICON_SIZE'				=> 'Size',
	'ICON_SPINNING'			=> 'Spinning',

	'ICON_BRAND'			=> 'Brand',
	'ICON_CURRENCY'			=> 'Currency',
    'ICON_DIRECTIONAL'		=> 'Directional',
    'ICON_FORM_CONTROL'		=> 'Form Control',
    'ICON_MEDICAL'			=> 'Medical',
    'ICON_SOCIAL'			=> 'Social',
	'ICON_TEXT_EDITOR'		=> 'Text Editor',
    'ICON_VIDEO_PLAYER'		=> 'Video Player',
	'ICON_WEB_APPLICATION'	=> 'Web Application',
));