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
	'ADD_BLOCK_EXPLAIN'							=> '*Trascina e rilascia blocchi',
	'AJAX_ERROR'								=> 'Oops! Si è verificato un errore nell\'elaborazione della richiesta. Si prega di riprovare.',
	'AJAX_LOADING'								=> 'Caricamento...',
	'AJAX_PROCESSING'							=> 'Lavorando...',

	'BACKGROUND'								=> 'Sfondo',
	'BLOCKS'									=> 'Blocchi',
	'BLOCKS_COPY_FROM'							=> 'Copia Blocchi',
	'BLOCK_ACTIVE'								=> 'Attivo',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Mostra solo sugli itinerari figli',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Nascondi sui percorsi figli',
	'BLOCK_CLASS'								=> 'Classe CSS',
	'BLOCK_CLASS_EXPLAIN'						=> 'Modifica l\'aspetto del blocco con le classi CSS',
	'BLOCK_DESIGN'								=> 'Aspetto',
	'BLOCK_DISPLAY_TYPE'						=> 'Visualizzazione',
	'BLOCK_HIDE_TITLE'							=> 'Nascondi il titolo del blocco?',
	'BLOCK_INACTIVE'							=> 'Inattivo',
	'BLOCK_MISSING_TEMPLATE'					=> 'Modello di blocco richiesto mancante. Contatta lo sviluppatore',
	'BLOCK_NOT_FOUND'							=> 'Oops! Il servizio di blocco richiesto non è stato trovato',
	'BLOCK_NO_DATA'								=> 'Nessun dato da visualizzare',
	'BLOCK_NO_ID'								=> 'Oops! Id blocco mancante',
	'BLOCK_PERMISSION'							=> 'Permesso',
	'BLOCK_PERMISSION_ALLOW'					=> 'Mostra a',
	'BLOCK_PERMISSION_DENY'						=> 'Nascondi da',
	'BLOCK_PERMISSION_EXPLAIN'					=> 'Usa CTRL + clic per attivare la selezione',
	'BLOCK_SHOW_ALWAYS'							=> 'Sempre',
	'BLOCK_STATUS'								=> 'Stato',
	'BLOCK_UPDATED'								=> 'Impostazioni blocco aggiornate con successo',

	'CANCEL'									=> 'Annulla',
	'CHILD_ROUTE'								=> 'Figlio',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/my-article',
	'CLEAR'										=> 'Pulisci',
	'COPY'										=> 'Copia',
	'COPY_BLOCKS'								=> 'Copiare I Blocchi?',
	'COPY_BLOCKS_CONFIRM'						=> 'Sei sicuro di voler copiare blocchi da un\'altra pagina?<br /><br />Questo eliminerà tutti i blocchi esistenti e le loro impostazioni per questa pagina e li sostituirà con i blocchi dalla pagina selezionata.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'Se impostata, tutte le pagine del sito per le quali non hai specificato i blocchi erediteranno i blocchi dal layout predefinito. Si può, tuttavia, sovrascrivere il layout predefinito per particolari pagine utilizzando le opzioni a destra.',
	'DELETE'									=> 'Elimina',
	'DELETE_ALL_BLOCKS'							=> 'Elimina Tutti I Blocchi',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'Sei sicuro di voler eliminare tutti i blocchi per questa pagina?',
	'DELETE_BLOCK'								=> 'Elimina Blocco',
	'DELETE_BLOCK_CONFIRM'						=> 'Sei sicuro di voler eliminare questo blocco?<br /><br /><br /><strong>Nota:</strong> Dovrai salvare le modifiche del layout per renderlo permanente.',

	'EDIT'										=> 'Modifica',
	'EDIT_BLOCK'								=> 'Modifica Blocco',
	'EXIT_EDIT_MODE'							=> 'Esci Dalla Modalità Modifica',

	'FEED_PROBLEMS'								=> 'Si è verificato un problema nell\'elaborazione dei feed rss/atom forniti',
	'FEED_URL_MISSING'							=> 'Si prega di fornire almeno un feed rss/atomo per iniziare',
	'FIELD_INVALID'								=> 'Il valore fornito per il campo «%s» ha un formato non valido',
	'FIELD_REQUIRED'							=> '“%s” è un campo obbligatorio',
	'FIELD_TOO_LONG'							=> 'Il valore fornito per il campo «%1$s» è troppo lungo. Il valore massimo accettabile è %2$d.',
	'FIELD_TOO_SHORT'							=> 'Il valore fornito per il campo «%1$s» è troppo breve. Il valore minimo accettabile è %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'Non mostrare blocchi su questa pagina',
	'HIDE_BLOCK_POSITIONS'						=> 'Non mostrare i blocchi per le seguenti posizioni di blocco:',

	'IMAGES'									=> 'Immagini',

	'LAYOUT'									=> 'Layout',
	'LAYOUT_SAVED'								=> 'Layout salvato con successo!',
	'LAYOUT_SETTINGS'							=> 'Impostazioni Layout',
	'LEAVE_CONFIRM'								=> 'Hai alcune modifiche non salvate a questa pagina. Per favore salva il tuo lavoro prima di spostarti',
	'LISTS'										=> 'Liste',

	'MAKE_DEFAULT_LAYOUT'						=> 'Imposta Come Layout Predefinito',

	'OR'										=> '<strong>O</strong>',

	'PARENT_ROUTE'								=> 'Genitore',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/articles',
	'PREDEFINED_CLASSES'						=> 'Lezioni predefinite',

	'REDO'										=> 'Ripeti',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Rimuovi Come Layout Predefinito',
	'REMOVE_STARTPAGE'							=> 'Rimuovi Pagina Iniziale',
	'ROUTE_HIDDEN_BLOCKS'						=> 'I blocchi sono nascosti per questa pagina',
	'ROUTE_HIDDEN_POSITIONS'					=> 'I blocchi sono nascosti per le seguenti posizioni',
	'ROUTE_UPDATED'								=> 'Impostazioni pagina aggiornate con successo',

	'SAVE_CHANGES'								=> 'Salva Modifiche',
	'SAVE_SETTINGS'								=> 'Salva Impostazioni',
	'SELECT_ICON'								=> 'Seleziona un\'icona',
	'SETTINGS'									=> 'Impostazioni',
	'SETTING_TOO_BIG'							=> 'Il valore fornito per l\'impostazione «%1$s» è troppo alto. Il valore massimo accettabile è %2$d.',
	'SETTING_TOO_LONG'							=> 'Il valore fornito per l\'impostazione «%1$s» è troppo lungo. La lunghezza massima accettabile è %2$d.',
	'SETTING_TOO_LOW'							=> 'Il valore fornito per l\'impostazione «%1$s» è troppo basso. Il valore minimo accettabile è %2$d.',
	'SETTING_TOO_SHORT'							=> 'Il valore fornito per l\'impostazione «%1$s» è troppo breve. La lunghezza minima accettabile è %2$d.',
	'SET_STARTPAGE'								=> 'Imposta Come Pagina Iniziale',

	'TITLES'									=> 'Titoli',

	'UPDATE_SIMILAR'							=> 'Aggiorna blocchi con impostazioni simili',
	'UNDO'										=> 'Annulla',

	'VIEW_DEFAULT_LAYOUT'						=> 'Visualizza/Modifica Layout Predefinito',
	'VISIT_PAGE'								=> 'Visita Pagina',
));
