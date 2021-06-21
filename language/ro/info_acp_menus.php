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
	'ACP_MENU'					=> 'Meniu',
	'ACP_MENU_MANAGE'			=> 'Managementul meniului',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Aici puteţi crea şi gestiona meniuri pentru site-ul dvs',
	'ADD_BULK_MENU'				=> 'Adăugare în bloc elemente de meniu',
	'ADD_BULK_MENU_EXPLAIN'		=> 'Adăugați mai multe elemente de meniu simultan.<br /> - Plasați fiecare element pe o linie separată<br /> - Utilizați tasta <strong>Tab</strong> pentru a indenta elemente pentru a reprezenta relațiile părinte-copil<br /> - Introduceți elementul și adresa URL în felul următor: Home<unk> index.php',
	'ADD_MENU'					=> 'Adaugă meniu',
	'ADD_MENU_ITEM'				=> 'Adăugare element de meniu',
	'ADD_ITEM'					=> 'Adauga Element Nou',
	'AJAX_PROCESSING'			=> 'Munca',

	'CHANGE_ME'					=> 'Schimbă-mă pe mine',

	'DELETE_ITEM'				=> 'Ștergere element',
	'DELETE_KIDS'				=> 'Ștergere sucursală',
	'DELETE_MENU'				=> 'Ștergere meniu',
	'DELETE_MENU_CONFIRM'		=> 'Sunteţi sigur că doriţi să ştergeţi acest meniu?<br />Aceasta va şterge meniul şi toate elementele sale',
	'DELETE_MENU_ITEM'			=> 'Ștergere element',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Sunteţi sigur că doriţi să ştergeţi acest element de meniu?',
	'DELETE_SELECTED'			=> 'Şterge cele selectate',

	'EDIT_ITEM'					=> 'Editare articol',

	'ITEM_ACTIVE'				=> 'Activ',
	'ITEM_INACTIVE'				=> 'Inactiv',
	'ITEM_PARENT'				=> 'Părinte',
	'ITEM_TITLE'				=> 'Titlu articol',
	'ITEM_TITLE_EXPLAIN'		=> 'Setat ca \'-\' pentru divider',
	'ITEM_TARGET'				=> 'Item Target',
	'ITEM_URL'					=> 'URL Element',
	'ITEM_URL_EXPLAIN'			=> '- Lăsaţi gol pentru poziţiile<br />- Site-urile externe trebuie să înceapă cu http(s)://, ftp://, //, etc',

	'MENU_ITEMS'				=> 'Elemente de meniu',

	'NO_MENU_ITEMS'				=> 'Nici un element de meniu nu a fost creat',
	'NO_PARENT'					=> 'Niciun părinte',

	'PROCESSING_ERROR'			=> 'Eroare de procesare',

	'REBUILD_TREE'				=> 'Reconstruieşte copacul',
	'REQUIRED'					=> 'Necesar',
	'REQUIRED_FIELDS'			=> '* Câmpuri obligatorii',

	'SAVE_CHANGES'				=> 'Salvează modificările',
	'SAVE'						=> 'Salvează',
	'SELECT_ALL'				=> 'Selectează tot',

	'TARGET_BLANK'				=> 'Pagină goală',
	'TARGET_PARENT'				=> 'Părinte',

	'UNSAVED_CHANGES'			=> 'Aveți modificări nesalvate',

	'VISIT_PAGE'				=> 'Vizitează pagina',
));
