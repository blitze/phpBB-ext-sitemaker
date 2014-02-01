<?php
/**
 *
 * @package phpBB Primetime [English]
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
	'EDIT_ME'		=> 'Please edit me',
	'MY_BLOCK'		=> 'Block Title',
	'SHOW_HIDE_ME'	=> 'Show Hide me?',
	'AUTO_LOGIN'	=> 'Show Remember me?',

	'PRIMETIME.BLOCK.LOGIN'		=> 'Login Box',
	'PRIMETIME.BLOCK.MYBLOCK'	=> 'My Block',
	'PRIMETIME.BLOCK.STATS'		=> 'Board Statistics',
	'PRIMETIME.BLOCK.WHOIS'		=> 'Who is online',
));