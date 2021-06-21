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

	'BLOCKS_CLEANUP'			=> 'Blokken Opruimen',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'De volgende items blijken niet langer te bestaan of onbereikbaar te zijn, en je kunt daarom alle blokken die eraan gekoppeld zijn verwijderen. Houdt u er alstublieft rekening mee dat sommige van deze misschien onjuiste positieve punten zijn',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Ongeldige blokken (bijvoorbeeld uit gedeïnstalleerde extensies):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Onbereikbare/kapotte pagina\'s:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Gedeïnstalleerde stijlen (ids):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Blokken succesvol verwijderd',

	'FORUM_INDEX_SETTINGS'			=> 'Forum Index Instellingen',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Deze instellingen worden alleen toegepast wanneer er geen startpagina gedefinieerd is',

	'HIDE'			=> 'Verbergen',
	'HIDE_BIRTHDAY'	=> 'Verjaardag sectie verbergen',
	'HIDE_LOGIN'	=> 'Inlogvak verbergen',
	'HIDE_ONLINE'	=> 'Wie online sectie verbergen',

	'LAYOUT_BLOG'		=> 'Blog',
	'LAYOUT_CUSTOM'		=> 'Aangepaste',
	'LAYOUT_HOLYGRAIL'	=> 'Heilige Graal',
	'LAYOUT_PORTAL'		=> 'Portaal',
	'LAYOUT_PORTAL_ALT'	=> 'Portaal (alt)',
	'LAYOUT_SETTINGS'	=> 'Instellingen schermindeling',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Sitemaker blokken verwijderd voor ontbrekende stijl met id %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Sitemaker blokken verwijderd voor gebroken pagina\'s:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Ongeldige Sitemaker blokken verwijderd:<br />%s',

	'NAVIGATION_SETTINGS'		=> 'Navigatie instellingen',

	'SETTINGS_SAVED'			=> 'Uw instellingen zijn opgeslagen',
	'SHOW'						=> 'Weergeven',
	'SHOW_FORUM_NAV'			=> 'Toon \'Forum\' in de navigatiebalk?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Als een pagina is ingesteld als startpagina in plaats van de forumindex, moeten we \'Forum\' in de navigatiebalk weergeven',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Ja - met pictogram:',
]);
