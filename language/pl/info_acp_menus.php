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
	'ACP_MENU_MANAGE'			=> 'Zarządzanie menu',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Tutaj możesz tworzyć menu dla swojej witryny i zarządzać nim',
	'ADD_BULK_MENU'				=> 'Masowe dodawanie pozycji menu',
	'ADD_BULK_MENU_EXPLAIN'		=> 'Dodaj wiele elementów menu jednocześnie.<br /> - Umieść każdy element w osobnej linii<br /> - Użyj klawisza <strong>Tab</strong> do wcięć, aby reprezentować relacje rodzicielskie-potomne<br /> - Wprowadź element i adres URL jak tak: Home|index.php',
	'ADD_MENU'					=> 'Dodaj Menu',
	'ADD_MENU_ITEM'				=> 'Dodaj pozycję menu',
	'ADD_ITEM'					=> 'Dodaj nowy element',
	'AJAX_PROCESSING'			=> 'Praca',

	'CHANGE_ME'					=> 'Zmień',

	'DELETE_ITEM'				=> 'Usuń element',
	'DELETE_KIDS'				=> 'Usuń gałąź',
	'DELETE_MENU'				=> 'Usuń menu',
	'DELETE_MENU_CONFIRM'		=> 'Czy na pewno chcesz usunąć to menu?<br />To usunie menu i wszystkie jego elementy',
	'DELETE_MENU_ITEM'			=> 'Usuń element',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Czy na pewno chcesz usunąć tę pozycję menu?',
	'DELETE_SELECTED'			=> 'Usuń zaznaczone',

	'EDIT_ITEM'					=> 'Edytuj element',

	'ITEM_ACTIVE'				=> 'Aktywne',
	'ITEM_INACTIVE'				=> 'Nieaktywny',
	'ITEM_PARENT'				=> 'Rodzic',
	'ITEM_TITLE'				=> 'Tytuł Produktu',
	'ITEM_TITLE_EXPLAIN'		=> 'Ustaw jako „-” dla separatora',
	'ITEM_TARGET'				=> 'Item Target',
	'ITEM_URL'					=> 'Adres URL elementu',
	'ITEM_URL_EXPLAIN'			=> '- Pozostaw puste dla pozycji<br />- Zewnętrzne strony muszą zaczynać się od http(s)://, ftp://, //, itp',

	'MENU_ITEMS'				=> 'Elementy menu',

	'NO_MENU_ITEMS'				=> 'Nie utworzono żadnych pozycji menu',
	'NO_PARENT'					=> 'Brak rodzica',

	'PROCESSING_ERROR'			=> 'Błąd przetwarzania',

	'REBUILD_TREE'				=> 'Przebuduj drzewo',
	'REQUIRED'					=> 'Wymagane',
	'REQUIRED_FIELDS'			=> '* Wymagane pola',

	'SAVE_CHANGES'				=> 'Zapisz zmiany',
	'SAVE'						=> 'Zapisz',
	'SELECT_ALL'				=> 'Zaznacz wszystko',

	'TARGET_BLANK'				=> 'Pusta strona',
	'TARGET_PARENT'				=> 'Rodzic',

	'UNSAVED_CHANGES'			=> 'Masz niezapisane zmiany',

	'VISIT_PAGE'				=> 'Odwiedź stronę',
));
