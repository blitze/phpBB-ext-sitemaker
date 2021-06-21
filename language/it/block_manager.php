<?php

/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2012 Daniel A. (blitze)
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

$lang = array_merge($lang, array(
	'ADD_BLOCK_EXPLAIN'							=> '*Blocchi trascina e rilascia',
	'AJAX_ERROR'								=> 'Oops! Si è verificato un errore durante l\'elaborazione della tua richiesta. Riprova.',
	'AJAX_LOADING'								=> 'Caricamento...',
	'AJAX_PROCESSING'							=> 'Elaborazione...',

	'BACKGROUND'								=> 'Sfondo',
	'BLOCKS'									=> 'Blocchi',
	'BLOCKS_COPY_FROM'							=> 'Copia i blocchi',
	'BLOCK_ACTIVE'								=> 'Attivo',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Mostra solo sulle rotte figlie',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Nascondi sulle rotte per bambini',
	'BLOCK_CLASS'								=> 'Classe CSS',
	'BLOCK_CLASS_EXPLAIN'						=> 'Modifica l\'aspetto del blocco con le classi CSS',
	'BLOCK_DESIGN'								=> 'Aspetto',
	'BLOCK_DISPLAY_TYPE'						=> 'Schermo',
	'BLOCK_HIDE_TITLE'							=> 'Nascondi il titolo del blocco?',
	'BLOCK_INACTIVE'							=> 'Inattivo',
	'BLOCK_MISSING_TEMPLATE'					=> 'Modello di blocco richiesto mancante. Contatta lo sviluppatore',
	'BLOCK_NOT_FOUND'							=> 'Oops! Il servizio di blocco richiesto non è stato trovato',
	'BLOCK_NO_DATA'								=> 'Nessun dato da visualizzare',
	'BLOCK_NO_ID'								=> 'Oops! Id del blocco mancante',
	'BLOCK_PERMISSION'							=> 'Permesso',
	'BLOCK_PERMISSION_ALLOW'					=> 'Mostra a',
	'BLOCK_PERMISSION_DENY'						=> 'Nascondi da',
	'BLOCK_PERMISSION_EXPLAIN'					=> 'Usa CTRL + clic per attivare la selezione',
	'BLOCK_SHOW_ALWAYS'							=> 'Sempre',
	'BLOCK_STATUS'								=> 'Stato',
	'BLOCK_UPDATED'								=> 'Impostazioni del blocco aggiornate con successo',

	'CANCEL'									=> 'Annullare',
	'CHILD_ROUTE'								=> 'Figlio',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articolo/my-article',
	'CLEAR'										=> 'Svuota',
	'COPY'										=> 'Copia',
	'COPY_BLOCKS'								=> 'Copiare i blocchi?',
	'COPY_BLOCKS_CONFIRM'						=> 'Sei sicuro di voler copiare i blocchi da un\'altra pagina?<br /><br />Questo eliminerà tutti i blocchi esistenti e le relative impostazioni per questa pagina e li sostituirà con i blocchi dalla pagina selezionata.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'Se impostato, tutte le pagine del sito per le quali non hai specificato blocchi erediteranno i blocchi dal layout predefinito. È tuttavia possibile ignorare la disposizione predefinita per le pagine particolari utilizzando le opzioni a destra.',
	'DELETE'									=> 'Cancella',
	'DELETE_ALL_BLOCKS'							=> 'Elimina tutti i blocchi',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'Sei sicuro di voler eliminare tutti i blocchi per questa pagina?',
	'DELETE_BLOCK'								=> 'Elimina blocco',
	'DELETE_BLOCK_CONFIRM'						=> 'Sei sicuro di voler eliminare questo blocco?<br /><br /><br /><strong>Nota:</strong> Dovrai salvare le modifiche del layout per renderlo permanente.',

	'EDIT'										=> 'Edita',
	'EDIT_BLOCK'								=> 'Modifica blocco',
	'EXIT_EDIT_MODE'							=> 'Esci da Modifica Modalità',

	'FEED_PROBLEMS'								=> 'Si è verificato un problema durante l\'elaborazione del feed rss/atomico(i) fornito',
	'FEED_URL_MISSING'							=> 'Si prega di fornire almeno un feed rss/atomico per iniziare',
	'FIELD_INVALID'								=> 'Il valore fornito per il campo "%s" ha un formato non valido',
	'FIELD_REQUIRED'							=> '"%s" è un campo obbligatorio',
	'FIELD_TOO_LONG'							=> 'Il valore previsto per il campo "%1$s" è troppo lungo. Il valore massimo accettabile è %2$d.',
	'FIELD_TOO_SHORT'							=> 'Il valore fornito per il campo "%1$s" è troppo breve. Il valore minimo accettabile è %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'Non mostrare blocchi su questa pagina',
	'HIDE_BLOCK_POSITIONS'						=> 'Non mostrare i blocchi per le posizioni dei seguenti blocchi:',

	'IMAGES'									=> 'Immagini',

	'LAYOUT'									=> 'Layout',
	'LAYOUT_SAVED'								=> 'Layout salvato con successo!',
	'LAYOUT_SETTINGS'							=> 'Impostazioni Layout',
	'LEAVE_CONFIRM'								=> 'Ci sono alcune modifiche non salvate in questa pagina. Si prega di salvare il lavoro prima di muoverti',
	'LISTS'										=> 'Liste',

	'MAKE_DEFAULT_LAYOUT'						=> 'Imposta Layout Predefinito',

	'OR'										=> '<strong>O</strong>',

	'PARENT_ROUTE'								=> 'Padre',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/articles',
	'PREDEFINED_CLASSES'						=> 'Classi predefinite',

	'REDO'										=> 'Ripeti',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Rimuovi come layout predefinito',
	'REMOVE_STARTPAGE'							=> 'Rimuovi Pagina Iniziale',
	'ROUTE_HIDDEN_BLOCKS'						=> 'I blocchi vengono nascosti per questa pagina',
	'ROUTE_HIDDEN_POSITIONS'					=> 'I blocchi vengono nascosti per i seguenti punti',
	'ROUTE_UPDATED'								=> 'Impostazioni pagina aggiornate con successo',

	'SAVE_CHANGES'								=> 'Salva Modifiche',
	'SAVE_SETTINGS'								=> 'Salva impostazioni',
	'SELECT_ICON'								=> 'Seleziona un\'icona',
	'SETTINGS'									=> 'Impostazioni',
	'SETTING_TOO_BIG'							=> 'Il valore previsto per l\'impostazione "%1$s" è troppo alto. Il valore massimo accettabile è %2$d.',
	'SETTING_TOO_LONG'							=> 'Il valore fornito per l\'impostazione "%1$s" è troppo lungo. La lunghezza massima accettabile è %2$d.',
	'SETTING_TOO_LOW'							=> 'Il valore fornito per l\'impostazione "%1$s" è troppo basso. Il valore minimo accettabile è %2$d.',
	'SETTING_TOO_SHORT'							=> 'Il valore fornito per l\'impostazione "%1$s" è troppo breve. La lunghezza minima accettabile è %2$d.',
	'SET_STARTPAGE'								=> 'Imposta come pagina iniziale',

	'TITLES'									=> 'Titoli',

	'UPDATE_SIMILAR'							=> 'Aggiorna i blocchi con impostazioni simili',
	'UNDO'										=> 'Annulla',

	'VIEW_DEFAULT_LAYOUT'						=> 'Vedi/Modifica Layout Predefinito',
	'VISIT_PAGE'								=> 'Pagina Visita',
));
