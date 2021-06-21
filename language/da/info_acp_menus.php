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
	'ACP_MENU'					=> 'Menu',
	'ACP_MENU_MANAGE'			=> 'Menu Håndtering',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Her kan du oprette og administrere menuer til dit websted',
	'ADD_BULK_MENU'				=> 'Masse Tilføj Menupunkter',
	'ADD_BULK_MENU_EXPLAIN'		=> 'Tilføj flere menupunkter på én gang.<br /> - Placer hvert element på en separat linje<br /> - Brug <strong>Tab</strong> -tasten til at indrykke elementer til at repræsentere relationer mellem forældre og barn<br /> - Indtast element og URL som så: Hjemme index.php',
	'ADD_MENU'					=> 'Tilføj Menu',
	'ADD_MENU_ITEM'				=> 'Tilføj Menupunkt',
	'ADD_ITEM'					=> 'Tilføj Nyt Element',
	'AJAX_PROCESSING'			=> 'Arbejder',

	'CHANGE_ME'					=> 'Ændre Mig',

	'DELETE_ITEM'				=> 'Slet Element',
	'DELETE_KIDS'				=> 'Slet Gren',
	'DELETE_MENU'				=> 'Slet Menu',
	'DELETE_MENU_CONFIRM'		=> 'Er du sikker på, at du vil slette denne menu?<br />Dette vil slette menuen og alle dens elementer',
	'DELETE_MENU_ITEM'			=> 'Slet Element',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Er du sikker på du vil slette dette menupunkt?',
	'DELETE_SELECTED'			=> 'Slet Valgte',

	'EDIT_ITEM'					=> 'Rediger Element',

	'ITEM_ACTIVE'				=> 'Aktiv',
	'ITEM_INACTIVE'				=> 'Inaktiv',
	'ITEM_PARENT'				=> 'Overordnet',
	'ITEM_TITLE'				=> 'Element Titel',
	'ITEM_TITLE_EXPLAIN'		=> 'Sæt som ’-’ til skillevæg',
	'ITEM_TARGET'				=> 'Item Target',
	'ITEM_URL'					=> 'Vare URL',
	'ITEM_URL_EXPLAIN'			=> '- Efterlad tom for overskrifter<br />- Eksterne websteder skal begynde med http(s)://, ftp://, //, etc',

	'MENU_ITEMS'				=> 'Menupunkter',

	'NO_MENU_ITEMS'				=> 'Ingen menupunkter er blevet oprettet',
	'NO_PARENT'					=> 'Ingen Overordnet',

	'PROCESSING_ERROR'			=> 'Fejl under behandling',

	'REBUILD_TREE'				=> 'Genopbyg Træ',
	'REQUIRED'					=> 'Påkrævet',
	'REQUIRED_FIELDS'			=> '* Obligatoriske felter',

	'SAVE_CHANGES'				=> 'Gem Ændringer',
	'SAVE'						=> 'Gem',
	'SELECT_ALL'				=> 'Vælg Alle',

	'TARGET_BLANK'				=> 'Tom Side',
	'TARGET_PARENT'				=> 'Overordnet',

	'UNSAVED_CHANGES'			=> 'Du har ugemte ændringer',

	'VISIT_PAGE'				=> 'Besøg Side',
));
