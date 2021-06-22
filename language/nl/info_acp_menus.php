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
	'ACP_MENU_MANAGE'			=> 'Menu beheer',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Hier kunt u menu\'s voor uw site maken en beheren',
	'ADD_BULK_MENU'				=> 'Bulk menu-items toevoegen',
	'ADD_BULK_MENU_EXPLAIN'		=> 'Meerdere menu-items tegelijk toevoegen.<br /> - Plaats elk item op een aparte regel<br /> - Gebruik de <strong>Tab</strong> toets om items in te laten springen om ouder-onderliggende relaties te vertegenwoordigen<br /> - Voer item en URL zoals bijvoorbeeld Homedad index.php',
	'ADD_MENU'					=> 'Menu toevoegen',
	'ADD_MENU_ITEM'				=> 'Menu-item toevoegen',
	'ADD_ITEM'					=> 'Nieuw item toevoegen',
	'AJAX_PROCESSING'			=> 'Werken',

	'CHANGE_ME'					=> 'Verander mij',

	'DELETE_ITEM'				=> 'Item verwijderen',
	'DELETE_KIDS'				=> 'Aftakking verwijderen',
	'DELETE_MENU'				=> 'Verwijder Menu',
	'DELETE_MENU_CONFIRM'		=> 'Weet u zeker dat u dit menu wilt verwijderen?<br />Dit zal het menu en alle items verwijderen',
	'DELETE_MENU_ITEM'			=> 'Item verwijderen',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Weet je zeker dat je dit menu-item wilt verwijderen?',
	'DELETE_SELECTED'			=> 'Geselecteerde verwijderen',

	'EDIT_ITEM'					=> 'Item bewerken',

	'ITEM_ACTIVE'				=> 'actief',
	'ITEM_INACTIVE'				=> 'Inactief',
	'ITEM_PARENT'				=> 'Bovenliggende',
	'ITEM_TITLE'				=> 'Artikel titel',
	'ITEM_TITLE_EXPLAIN'		=> 'Instellen als \'\' voor de deler',
	'ITEM_TARGET'				=> 'Item Target',
	'ITEM_URL'					=> 'Artikel URL',
	'ITEM_URL_EXPLAIN'			=> '- Laat leeg voor kopteksten<br />- Externe websites moeten beginnen met http(s)://, ftp://, //, etc',

	'MENU_ITEMS'				=> 'Menu items',

	'NO_MENU_ITEMS'				=> 'Er zijn geen menu-items aangemaakt',
	'NO_PARENT'					=> 'Geen bovenliggende pagina',

	'PROCESSING_ERROR'			=> 'Fout bij verwerken',

	'REBUILD_TREE'				=> 'Boom opnieuw opbouwen',
	'REQUIRED'					=> 'vereist',
	'REQUIRED_FIELDS'			=> '* Verplichte velden',

	'SAVE_CHANGES'				=> 'Wijzigingen opslaan',
	'SAVE'						=> 'Opslaan',
	'SELECT_ALL'				=> 'Alles selecteren',

	'TARGET_BLANK'				=> 'Lege pagina',
	'TARGET_PARENT'				=> 'Bovenliggende',

	'UNSAVED_CHANGES'			=> 'Je hebt niet-opgeslagen wijzigingen',

	'VISIT_PAGE'				=> 'Pagina bezoeken',
));
