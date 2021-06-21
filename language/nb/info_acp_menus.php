<?php
/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
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

$lang = array_merge($lang, array(
	'ACP_MENU'					=> 'Meny',
	'ACP_MENU_MANAGE'			=> 'Meny Behandling',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Her kan du opprette og administrere menyer for din nettside',
	'ADD_BULK_MENU'				=> 'Flere menypunkter i menyen',
	'ADD_BULK_MENU_EXPLAIN'		=> 'Legg til flere menyelementer samtidig.<br /> - Plasser hvert element på en egen linje<br /> - Bruk knappen <strong>Fane</strong> for å registrere elementer for å representere foreldre/underforhold<br /> - Angi element og URL-adresse som så: Homedabindex.php',
	'ADD_MENU'					=> 'Legg til meny',
	'ADD_MENU_ITEM'				=> 'Legg til menyelement',
	'ADD_ITEM'					=> 'Legg til nytt element',
	'AJAX_PROCESSING'			=> 'Arbeider',

	'CHANGE_ME'					=> 'Endre meg',

	'DELETE_ITEM'				=> 'Slett element',
	'DELETE_KIDS'				=> 'Slett grenen',
	'DELETE_MENU'				=> 'Slett menyen',
	'DELETE_MENU_CONFIRM'		=> 'Er du sikker på at du vil slette denne menyen?<br />Dette vil slette menyen og alle dens elementer',
	'DELETE_MENU_ITEM'			=> 'Slett element',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Er du sikker på at du vil slette dette menyelementet?',
	'DELETE_SELECTED'			=> 'Slett valgte',

	'EDIT_ITEM'					=> 'Rediger element',

	'ITEM_ACTIVE'				=> 'Aktiv',
	'ITEM_INACTIVE'				=> 'Inaktiv',
	'ITEM_PARENT'				=> 'Forelder',
	'ITEM_TITLE'				=> 'Elementet Tittel',
	'ITEM_TITLE_EXPLAIN'		=> 'Angi som en ’-’ for skildring',
	'ITEM_TARGET'				=> 'Item Target',
	'ITEM_URL'					=> 'Elementet URL',
	'ITEM_URL_EXPLAIN'			=> '- La være tom for overskrifter<br />- Eksterne nettsteder må begynne med http(s)://, ftp://, /, etc',

	'MENU_ITEMS'				=> 'Menyelementer',

	'NO_MENU_ITEMS'				=> 'Ingen menyelementer har blitt opprettet',
	'NO_PARENT'					=> 'Ingen overordnet',

	'PROCESSING_ERROR'			=> 'Behandler feil',

	'REBUILD_TREE'				=> 'Gjenoppbygg treet',
	'REQUIRED'					=> 'Påkrevd',
	'REQUIRED_FIELDS'			=> 'Obligatorisk felt',

	'SAVE_CHANGES'				=> 'Lagre endringer',
	'SAVE'						=> 'Lagre',
	'SELECT_ALL'				=> 'Velg alle',

	'TARGET_BLANK'				=> 'Tom side',
	'TARGET_PARENT'				=> 'Forelder',

	'UNSAVED_CHANGES'			=> 'Du har ulagrede endringer',

	'VISIT_PAGE'				=> 'Besøk side',
));
