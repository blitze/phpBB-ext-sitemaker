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
	'ACP_SM_SETTINGS'	=> 'Instellingen',

	'BLOCKS_CLEANUP'			=> 'Blokken Opschonen',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'De volgende items bleken niet meer te bestaan of onbereikbaar te zijn en daarom kunt u alle blokken die eraan gekoppeld zijn verwijderen. Houdt u er alstublieft rekening mee dat sommige van deze voordelen vals positief kunnen zijn',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Ongeldige blokken (bijv. van gedeïnstalleerde extensies):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Onbereikbare/gebroken pagina\'s:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Gedeïnstalleerde stijlen (ids):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Succesvol opgeschoond Blokken',

	'FORUM_INDEX_SETTINGS'			=> 'Forum Index instellingen',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Deze instellingen zijn alleen van toepassing als er geen startpagina is gedefinieerd',

	'HIDE'			=> 'Verbergen',
	'HIDE_BIRTHDAY'	=> 'Verberg verjaardagssectie',
	'HIDE_LOGIN'	=> 'Verberg login-box',
	'HIDE_ONLINE'	=> 'Verberg wie online is',

	'LAYOUT_BLOG'		=> 'Blog',
	'LAYOUT_CUSTOM'		=> 'Aangepast',
	'LAYOUT_HOLYGRAIL'	=> 'Heilige Grail',
	'LAYOUT_PORTAL'		=> 'Portaal',
	'LAYOUT_PORTAL_ALT'	=> 'Portaal (alt)',
	'LAYOUT_SETTINGS'	=> 'Lay-out instellingen',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Sitemakerblokken verwijderd voor ontbrekende stijl met id %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Sitemakerblokken verwijderd voor gebroken pagina\'s:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Ongeldige sitemaker blokken verwijderd:<br />%s',

	'NAVIGATION_SETTINGS'		=> 'Navigatie instellingen',

	'SETTINGS_SAVED'			=> 'Uw instellingen zijn opgeslagen',
	'SHOW'						=> 'Tonen',
	'SHOW_FORUM_NAV'			=> 'Toon \'Forum\' in de navigatiebalk?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Als een pagina is ingesteld als startpagina in plaats van de forumindex, moeten we \'Forum\' weergeven in de navigatiebalk',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Ja - met pictogram:',
]);
