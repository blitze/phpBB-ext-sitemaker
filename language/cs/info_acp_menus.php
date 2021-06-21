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
	'ACP_MENU'					=> 'Nabídka',
	'ACP_MENU_MANAGE'			=> 'Správa nabídek',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Zde můžete vytvářet a spravovat menu pro vaše stránky',
	'ADD_BULK_MENU'				=> 'Hromadné přidání položek nabídky',
	'ADD_BULK_MENU_EXPLAIN'		=> 'Přidat více položek nabídky najednou.<br /> - Umístěte každou položku na samostatnou řádku<br /> - Pomocí klávesy <strong>Tab</strong> můžete odsadit položky pro odsazení parent-child vztahů<br /> - Vložte položku a URL, jako jsou: Home|index.php',
	'ADD_MENU'					=> 'Přidat nabídku',
	'ADD_MENU_ITEM'				=> 'Přidat položku nabídky',
	'ADD_ITEM'					=> 'Přidat novou položku',
	'AJAX_PROCESSING'			=> 'Pracuje',

	'CHANGE_ME'					=> 'Změnit mě',

	'DELETE_ITEM'				=> 'Odstranit položku',
	'DELETE_KIDS'				=> 'Odstranit větev',
	'DELETE_MENU'				=> 'Odstranit menu',
	'DELETE_MENU_CONFIRM'		=> 'Jste si jisti, že chcete odstranit tuto nabídku?<br />Tato akce odstraní nabídku a všechny její položky.',
	'DELETE_MENU_ITEM'			=> 'Odstranit položku',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Jste si jisti, že chcete odstranit tuto položku nabídky?',
	'DELETE_SELECTED'			=> 'Odstranit vybrané',

	'EDIT_ITEM'					=> 'Upravit položku',

	'ITEM_ACTIVE'				=> 'Aktivní',
	'ITEM_INACTIVE'				=> 'Neaktivní',
	'ITEM_PARENT'				=> 'Nadřazený',
	'ITEM_TITLE'				=> 'Titulek položky',
	'ITEM_TITLE_EXPLAIN'		=> 'Nastavit jako \'pro oddělovače',
	'ITEM_TARGET'				=> 'Cíl položky',
	'ITEM_URL'					=> 'URL položky',
	'ITEM_URL_EXPLAIN'			=> '- Ponechte prázdné pro nadpisy<br />- externí stránky musí začínat http(s)://, ftp://, //, atd.',

	'MENU_ITEMS'				=> 'Položky nabídky',

	'NO_MENU_ITEMS'				=> 'Nebyly vytvořeny žádné položky nabídky',
	'NO_PARENT'					=> 'Žádný rodič',

	'PROCESSING_ERROR'			=> 'Chyba zpracování',

	'REBUILD_TREE'				=> 'Přebudovat strom',
	'REQUIRED'					=> 'Požadováno',
	'REQUIRED_FIELDS'			=> '* Povinná pole',

	'SAVE_CHANGES'				=> 'Uložit změny',
	'SAVE'						=> 'Uložit',
	'SELECT_ALL'				=> 'Vybrat vše',

	'TARGET_BLANK'				=> 'Prázdná stránka',
	'TARGET_PARENT'				=> 'Nadřazený',

	'UNSAVED_CHANGES'			=> 'Máte neuložené změny',

	'VISIT_PAGE'				=> 'Návštěva stránky',
));
