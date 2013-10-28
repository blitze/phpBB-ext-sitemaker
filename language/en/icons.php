<?php
/**
 *
 * primetime [English]
 *
 * @package language
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

$lang = array_merge($lang, array(
    'DIRECTIONAL'           => 'Directional',
    'MEDICAL'               => 'Medical',
    'SOCIAL'                => 'Social',
	'TEXT_EDITOR'			=> 'Text Editor',
    'VIDEO_PLAYER'          => 'Video Player',
	'WEB_APPLICATIONS'		=> 'Web Applications',
));