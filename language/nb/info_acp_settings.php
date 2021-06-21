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
	'ACP_SM_SETTINGS'	=> 'Innstillinger',

	'BLOCKS_CLEANUP'			=> 'Blokker opprydding',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'Følgende produkter ble funnet til å ikke lenger finnes eller være tilgjengelige, og du kan derfor slette alle blokker som er knyttet til dem. Vær oppmerksom på at noen av disse kan være falske positiver',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Ugyldige blokker (f.eks. fra avinstallerte utvidelser):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Ikke-tilgjengelige/ødelagte sider:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Uinstallerte stiler (ider):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Blokker tømt sur',

	'FORUM_INDEX_SETTINGS'			=> 'Forum Instillinger',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Disse innstillingene gjelder bare når det ikke er noen startside definert',

	'HIDE'			=> 'Skjul',
	'HIDE_BIRTHDAY'	=> 'Skjul bursdagsseksjonen',
	'HIDE_LOGIN'	=> 'Skjul innloggingsboks',
	'HIDE_ONLINE'	=> 'Skjul Whos online seksjon',

	'LAYOUT_BLOG'		=> 'Blogg',
	'LAYOUT_CUSTOM'		=> 'Egendefinert',
	'LAYOUT_HOLYGRAIL'	=> 'Hellig grus',
	'LAYOUT_PORTAL'		=> 'Portal',
	'LAYOUT_PORTAL_ALT'	=> 'Portal (alt)',
	'LAYOUT_SETTINGS'	=> 'Oppsett Innstillinger',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Elementaker-blokker slettet for manglende stil med id %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Endrede blokker slettet for ødelagte sider:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Ugyldig itemaker blokker slettet:<br />%s',

	'NAVIGATION_SETTINGS'		=> 'Navigasjon innstillinger',

	'SETTINGS_SAVED'			=> 'Dine lagret innstillinger har blitt',
	'SHOW'						=> 'Vis',
	'SHOW_FORUM_NAV'			=> 'Vis \'Forum\' i navigasjonslinjen?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Når en side er satt som startside i stedet for forumindeksen, bør vi vise \'Forum\' i navigasjonslinjen',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Ja - med ikon:',
]);
