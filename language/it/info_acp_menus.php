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
	'ACP_MENU'					=> 'Menù',
	'ACP_MENU_MANAGE'			=> 'Gestione Menu',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Qui puoi creare e gestire menu per il tuo sito',
	'ADD_BULK_MENU'				=> 'Aggiungi in blocco voci di menu',
	'ADD_BULK_MENU_EXPLAIN'		=> 'Aggiungi più voci di menu in una sola volta.<br /> - Posiziona ogni elemento in una riga separata<br /> - Usa la <strong>Tab</strong> per rappresentare gli elementi per le relazioni parent-figlio<br /> - Inserisci l\'elemento e l\'URL come Home|index.php',
	'ADD_MENU'					=> 'Aggiungi Menu',
	'ADD_MENU_ITEM'				=> 'Aggiungi voce di menu',
	'ADD_ITEM'					=> 'Aggiungi nuovo oggetto',
	'AJAX_PROCESSING'			=> 'Lavorando',

	'CHANGE_ME'					=> 'Cambiami',

	'DELETE_ITEM'				=> 'Elimina elemento',
	'DELETE_KIDS'				=> 'Elimina ramo',
	'DELETE_MENU'				=> 'Elimina Menu',
	'DELETE_MENU_CONFIRM'		=> 'Sei sicuro di voler eliminare questo menu?<br />Questo eliminerà il menu e tutti i suoi elementi',
	'DELETE_MENU_ITEM'			=> 'Elimina elemento',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Sei sicuro di voler eliminare questa voce di menu?',
	'DELETE_SELECTED'			=> 'Elimina selezionati',

	'EDIT_ITEM'					=> 'Modifica elemento',

	'ITEM_ACTIVE'				=> 'Attivo',
	'ITEM_INACTIVE'				=> 'Inattivo',
	'ITEM_PARENT'				=> 'Padre',
	'ITEM_TITLE'				=> 'Titolo Articolo',
	'ITEM_TITLE_EXPLAIN'		=> 'Imposta come "-" per il separatore',
	'ITEM_TARGET'				=> 'Obiettivo Articolo',
	'ITEM_URL'					=> 'URL elemento',
	'ITEM_URL_EXPLAIN'			=> '- Lasciare vuoto per le intestazioni<br />- I siti esterni devono iniziare con http(s)://, ftp://, /, ecc',

	'MENU_ITEMS'				=> 'Voci di menu',

	'NO_MENU_ITEMS'				=> 'Non sono state create voci di menu',
	'NO_PARENT'					=> 'Nessun genitore',

	'PROCESSING_ERROR'			=> 'Errore di elaborazione',

	'REBUILD_TREE'				=> 'Ricostruisci albero',
	'REQUIRED'					=> 'Necessario',
	'REQUIRED_FIELDS'			=> '* Campi obbligatori',

	'SAVE_CHANGES'				=> 'Salva Modifiche',
	'SAVE'						=> 'Salva',
	'SELECT_ALL'				=> 'Seleziona tutti',

	'TARGET_BLANK'				=> 'Pagina vuota',
	'TARGET_PARENT'				=> 'Padre',

	'UNSAVED_CHANGES'			=> 'Ci sono modifiche non salvate',

	'VISIT_PAGE'				=> 'Pagina Visita',
));
