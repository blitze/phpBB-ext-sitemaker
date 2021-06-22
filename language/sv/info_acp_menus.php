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
	'ACP_MENU_MANAGE'			=> 'Menyhantering',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Här kan du skapa och hantera menyer för din webbplats',
	'ADD_BULK_MENU'				=> 'Bulk Lägg till menyobjekt',
	'ADD_BULK_MENU_EXPLAIN'		=> 'Lägg till flera menyalternativ på en gång.<br /> - Placera varje objekt på en separat rad<br /> - Använd fliken <strong></strong> -tangenten för att visa relationer mellan föräldrar och barn<br /> - Ange objekt och URL som så: Home<unk> index.php',
	'ADD_MENU'					=> 'Lägg till meny',
	'ADD_MENU_ITEM'				=> 'Lägg till menyobjekt',
	'ADD_ITEM'					=> 'Lägg till nytt objekt',
	'AJAX_PROCESSING'			=> 'Arbetar',

	'CHANGE_ME'					=> 'Ändra mig',

	'DELETE_ITEM'				=> 'Ta bort objekt',
	'DELETE_KIDS'				=> 'Ta bort gren',
	'DELETE_MENU'				=> 'Ta bort meny',
	'DELETE_MENU_CONFIRM'		=> 'Är du säker på att du vill ta bort denna menyn?<br />Detta kommer att ta bort menyn och alla dess objekt',
	'DELETE_MENU_ITEM'			=> 'Ta bort objekt',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Är du säker på att du vill ta bort detta menyobjekt?',
	'DELETE_SELECTED'			=> 'Ta bort markerade',

	'EDIT_ITEM'					=> 'Redigera objekt',

	'ITEM_ACTIVE'				=> 'Aktiv',
	'ITEM_INACTIVE'				=> 'Inaktiv',
	'ITEM_PARENT'				=> 'Överordnad',
	'ITEM_TITLE'				=> 'Objekt Titel',
	'ITEM_TITLE_EXPLAIN'		=> 'Ange som ’-’ för avdelare',
	'ITEM_TARGET'				=> 'Item Target',
	'ITEM_URL'					=> 'Punkt URL',
	'ITEM_URL_EXPLAIN'			=> '- Lämna tomt för rubriker<br />- Externa webbplatser måste börja med http(s)://, ftp://, //, etc',

	'MENU_ITEMS'				=> 'Menyobjekt',

	'NO_MENU_ITEMS'				=> 'Inga menyobjekt har skapats',
	'NO_PARENT'					=> 'Ingen överordnad',

	'PROCESSING_ERROR'			=> 'Bearbetar fel',

	'REBUILD_TREE'				=> 'Bygg om träd',
	'REQUIRED'					=> 'Krävs',
	'REQUIRED_FIELDS'			=> '* Obligatoriska fält',

	'SAVE_CHANGES'				=> 'Spara ändringar',
	'SAVE'						=> 'Spara',
	'SELECT_ALL'				=> 'Markera alla',

	'TARGET_BLANK'				=> 'Tom sida',
	'TARGET_PARENT'				=> 'Överordnad',

	'UNSAVED_CHANGES'			=> 'Du har osparade ändringar',

	'VISIT_PAGE'				=> 'Besök sida',
));
