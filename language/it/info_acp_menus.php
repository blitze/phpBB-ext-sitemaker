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
	'ACP_MENU_MANAGE'			=> 'Gestione Menu',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Qui puoi creare e gestire menu per il tuo sito',
	'ADD_BULK_MENU'				=> 'Aggiungi Elementi Del Menu In Massa',
	'ADD_BULK_MENU_EXPLAIN'		=> 'Aggiungi più voci di menu contemporaneamente.<br /> - Posiziona ogni elemento su una riga separata<br /> - Usa il tasto <strong>Tab</strong> per trattenere gli elementi per rappresentare le relazioni genitore-figlio<br /> - Inserisci l\'elemento e l\'URL in questo modo: Home<unk> index.php',
	'ADD_MENU'					=> 'Aggiungi Menu',
	'ADD_MENU_ITEM'				=> 'Aggiungi Elemento Menù',
	'ADD_ITEM'					=> 'Aggiungi Nuovo Elemento',
	'AJAX_PROCESSING'			=> 'Lavorare',

	'CHANGE_ME'					=> 'Cambiami',

	'DELETE_ITEM'				=> 'Elimina Elemento',
	'DELETE_KIDS'				=> 'Elimina Ramo',
	'DELETE_MENU'				=> 'Elimina Menu',
	'DELETE_MENU_CONFIRM'		=> 'Sei sicuro di voler eliminare questo menu?<br />Questo cancellerà il menu e tutti i suoi elementi',
	'DELETE_MENU_ITEM'			=> 'Elimina Elemento',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Sei sicuro di voler eliminare questa voce di menu?',
	'DELETE_SELECTED'			=> 'Elimina Selezionati',

	'EDIT_ITEM'					=> 'Modifica Elemento',

	'ITEM_ACTIVE'				=> 'Attivo',
	'ITEM_INACTIVE'				=> 'Inattivo',
	'ITEM_PARENT'				=> 'Genitore',
	'ITEM_TITLE'				=> 'Titolo Articolo',
	'ITEM_TITLE_EXPLAIN'		=> 'Imposta come \'-\' per il divisore',
	'ITEM_TARGET'				=> 'Item Target',
	'ITEM_URL'					=> 'Url Elemento',
	'ITEM_URL_EXPLAIN'			=> '- Lasciare vuoto per le intestazioni<br />- I siti esterni devono iniziare con http(s)://, ftp://, //, etc',

	'MENU_ITEMS'				=> 'Elementi Del Menu',

	'NO_MENU_ITEMS'				=> 'Nessuna voce di menu è stata creata',
	'NO_PARENT'					=> 'Nessun Genitore',

	'PROCESSING_ERROR'			=> 'Errore di elaborazione',

	'REBUILD_TREE'				=> 'Ricostruisci Albero',
	'REQUIRED'					=> 'Richiesto',
	'REQUIRED_FIELDS'			=> '* Campi obbligatori',

	'SAVE_CHANGES'				=> 'Salva Modifiche',
	'SAVE'						=> 'Salva',
	'SELECT_ALL'				=> 'Seleziona Tutto',

	'TARGET_BLANK'				=> 'Pagina Vuota',
	'TARGET_PARENT'				=> 'Genitore',

	'UNSAVED_CHANGES'			=> 'Hai modifiche non salvate',

	'VISIT_PAGE'				=> 'Visita Pagina',
));
