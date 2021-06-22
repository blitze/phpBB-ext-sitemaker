<?php

/**
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	$lang = [];
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

$lang = array_merge($lang, [
	'ACP_SITEMAKER'		=> 'SiteMaker',
	'ACP_SM_SETTINGS'	=> 'Inställningar',

	'BLOCKS_CLEANUP'			=> 'Blocks rensning',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'Följande objekt hittades inte längre existerar eller kan inte längre nås, och du kan därför ta bort alla block som är kopplade till dem. Kom ihåg att en del av dessa kan vara falskt positiva',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Ogiltiga block (t.ex. från avinstallerade tillägg):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Onåbara/trasiga sidor:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Oinstallerade stilar (ids):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Blocken rensades utan problem',

	'FORUM_INDEX_SETTINGS'			=> 'Inställningar för Forum Index',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Dessa inställningar gäller endast när det inte finns någon definierad startsida',

	'HIDE'			=> 'Dölj',
	'HIDE_BIRTHDAY'	=> 'Dölj sektion för födelsedag',
	'HIDE_LOGIN'	=> 'Dölj inloggningsrutan',
	'HIDE_ONLINE'	=> 'Dölj Whos online-sektion',

	'LAYOUT_BLOG'		=> 'Blogg',
	'LAYOUT_CUSTOM'		=> 'Anpassad',
	'LAYOUT_HOLYGRAIL'	=> 'Helig Graal',
	'LAYOUT_PORTAL'		=> 'Portal',
	'LAYOUT_PORTAL_ALT'	=> 'Portal (alt)',
	'LAYOUT_SETTINGS'	=> 'Inställningar för layout',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Sitemaker block borttagna för saknad stil med id %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Sitemaker block borttagna för trasiga sidor:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Ogiltig Sitemaker block borttagna:<br />%s',

	'NAVIGATION_SETTINGS'		=> 'Navigeringsinställningar',

	'SETTINGS_SAVED'			=> 'Dina inställningar har sparats',
	'SHOW'						=> 'Visa',
	'SHOW_FORUM_NAV'			=> 'Visa ‘Forum’ i navigeringsfältet?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'När en sida är inställd som startsida istället för forumindexet, ska vi visa \'Forum\' i navigationsfältet',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Ja - med ikon:',
]);
