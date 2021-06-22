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
	'ALL_TYPES'									=> 'Tutti I Tipi',
	'ALL_GROUPS'								=> 'Tutti I Gruppi',
	'ARCHIVES'									=> 'Archivi',
	'AUTO_LOGIN'								=> 'Consentire il login automatico?',
	'FILE_MANAGER'								=> 'Gestore File',
	'TOPIC_POST_IDS'							=> 'Da Id Argomento/Post',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id di argomenti/post da cui recuperare gli allegati, separati da <strong>virgole</strong>(,). Specificare se questa lista è per topic o post id sopra.',
	'TOPIC_POST_IDS_TYPE'						=> 'Tipo di ID (sotto)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Allegati',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Compleanno',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Blocco Personalizzato',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Membro In Evidenza',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'Feed RSS/Atom',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Forum Sondaggio',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Argomenti Forum',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Google Maps',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Argomenti Popolari',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Collegamenti',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Casella Di Accesso',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Membri',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Menu Membri',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Menu',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'I Miei Segnalibri',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Argomenti Recenti',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Statistiche',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Commutatore Di Stile',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Che Cosa È Nuovo?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Chi è online',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Wordgraph',

	// block views
	'BLOCK_VIEW'								=> 'Blocca Vista',
	'BLOCK_VIEW_BASIC'							=> 'Base',
	'BLOCK_VIEW_BOXED'							=> 'Boxed',
	'BLOCK_VIEW_DEFAULT'						=> 'Predefinito',
	'BLOCK_VIEW_SIMPLE'							=> 'Semplice',

	'CACHE_DURATION'							=> 'Durata cache',
	'CONTEXT'									=> 'Contesto',
	'CSS_SCRIPTS'								=> 'CSS Scripts',
	'CUSTOM_PROFILE_FIELDS'						=> 'Campi Profilo Personalizzato',

	'DATE_RANGE'								=> 'Date Range',
	'DISPLAY_PREVIEW'							=> 'Visualizza Anteprima?',

	'EDIT_ME'									=> 'Per favore modificami',
	'ENABLE_TOPIC_TRACKING'						=> 'Abilitare il tracciamento degli argomenti?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Se abilitato, gli argomenti non letti saranno indicati ma i risultati del blocco non saranno memorizzati nella cache <strong>(Non consigliato)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Hai inserito troppe parole da escludere. Il numero massimo di caratteri possibili è 255, hai inserito %s.',
	'EXCLUDE_WORDS'								=> 'Escludi parole',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Elenca le parole che vuoi escludere dal grafico delle parole separate da una virgola (,). Massimo 255 caratteri.',
	'EXPANDED'									=> 'Espanso',
	'EXTENSION_GROUP'							=> 'Gruppo Estensioni',

	'FEATURED_MEMBER_IDS'						=> 'Id Utente',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Elenco di utenti separati da virgole da funzionalità (si applica solo alla modalità di visualizzazione membri in evidenza)',
	'FEED_DATA_PREVIEW'							=> 'Dati Feed',
	'FEED_ITEM_TEMPLATE'						=> 'Template Oggetto',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>SUGGERIMENTI:</strong><br />
		<unk>		<ul class="sm-list">
			<unk> <unk>			<li>Accesso dati feed in <strong>elemento</strong> variabile e. . oggetto. itle</li>
			<unk> <unk>			<li>Il modello deve essere in <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Sintassi Twig</a></li>
			<unk>			<li>Clicca <strong>Campioni</strong> sopra per i modelli di esempio</li>
			<unk>			<li>Usa <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> per ottenere qualsiasi tag dal feed che non forniamo . .<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<unk>			<li>Usa il filtro json_encode di Twig, per vedere i contenuti dell\'array e. . <strong><code>{{ get_item_tags(\'\', \'image\')<unk> json_encode() }}</code></strong></li>
		<unk>		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Fonte',
	'FEED_URL_PLACEHOLDER'						=> 'http://example.com/rss',
	'FEED_URLS'									=> 'Url Feed',
	'FIRST_POST_ONLY'							=> 'Solo Primo Post',
	'FIRST_POST_TIME'							=> 'Primo Post Time',
	'FORUMS_GET_TYPE'							=> 'Ottieni tipo',
	'FORUMS_MAX_TOPICS'							=> 'Argomenti/post massimi',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Numero massimo di caratteri per titolo',
	'FREQUENCY'									=> 'Frequenza',
	'FULL'										=> 'Pieno',
	'FULLSCREEN'								=> 'Schermo',

	'GET_TYPE'									=> 'Visualizzare Argomento/Post?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Usa questa area di testo per inserire il contenuto HTML grezzo.</strong><br />Si prega di notare che qualsiasi contenuto pubblicato qui sovrascriverà il contenuto del blocco personalizzato e l\'editor di blocchi visivi non sarà disponibile.',
	'HOURS_SHORT'								=> 'ore',

	'JS_SCRIPTS'								=> 'Script JS',

	'LAST_POST_TIME'							=> 'Ultimo Tempo Post',
	'LAST_READ_TIME'							=> 'Ultimo Tempo Di Lettura',
	'LIMIT'										=> 'Limite',
	'LIMIT_FORUMS'								=> 'Id Forum (Opzionale)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Inserisci ogni id del forum separato da una virgola (,). Se impostata, verranno visualizzati solo gli argomenti dai forum specificati.',
	'LIMIT_POST_TIME'							=> 'Limite per post time',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Se impostato, verranno recuperati solo gli argomenti postati entro il periodo specificato',

	'MAX_DEPTH'									=> 'Profondità massima',
	'MAX_ITEMS'									=> 'Numero massimo di elementi',
	'MAX_MEMBERS'								=> 'Max. Membri',
	'MAX_POSTS'									=> 'Numero massimo di posti',
	'MAX_TOPICS'								=> 'Numero massimo di argomenti',
	'MAX_WORDS'									=> 'Numero massimo di parole',
	'MANAGE_MENUS'								=> 'Gestisci Menu',
	'MAP_COORDINATES'							=> 'Coordinate',
	'MAP_COORDINATES_EXPLAIN'					=> 'Inserisci le coordinate nella latitudine del modulo, longitudine',
	'MAP_HEIGHT'								=> 'Altezza',
	'MAP_LOCATION'								=> 'Posizione',
	'MAP_TITLE'									=> 'Titolo',
	'MAP_VIEW'									=> 'Visualizza',
	'MAP_VIEW_HYBRID'							=> 'Ibrido',
	'MAP_VIEW_MAP'								=> 'Mappa',
	'MAP_VIEW_SATELITE'							=> 'Satelite',
	'MAP_VIEW_TERRAIN'							=> 'Terrain',
	'MAP_ZOOM_LEVEL'							=> 'Livello Zoom',
	'MEMBERS_DATE'								=> 'Data',
	'MENU_NO_ITEMS'								=> 'Nessun elemento attivo da visualizzare',
	'MINI'										=> 'Mini',

	'OR'										=> '<strong>O</strong>',
	'ORDER_BY'									=> 'Ordina per',

	'POLL_FROM_FORUMS'							=> 'Visualizza sondaggi da forum',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Verranno visualizzati solo i sondaggi dei forum selezionati, purché non siano specificati argomenti sopra',
	'POLL_FROM_GROUPS'							=> 'Visualizza sondaggi da gruppo(i)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Verranno visualizzati solo i sondaggi dei membri dei gruppi selezionati a condizione che nessun utente(i) sia specificato sopra',
	'POLL_FROM_TOPICS'							=> 'Visualizza sondaggi da argomenti',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id degli argomenti da cui recuperare i sondaggi, separati da <strong>virgole</strong>(,). Lascia vuoto per selezionare qualsiasi argomento.',
	'POLL_FROM_USERS'							=> 'Visualizza sondaggi da utente(i)',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id degli utenti di cui desideri visualizzare i sondaggi, separati da <strong>virgole</strong>(,). Lascia vuoto per selezionare i sondaggi da qualsiasi utente.',
	'POSTS_TITLE_LIMIT'							=> 'Numero massimo di caratteri per il titolo del post',
	'PREVIEW_MAX_CHARS'							=> 'Numero di caratteri da visualizzare in anteprima',

	'QUERY_TYPE'								=> 'Modalità Di Visualizzazione',

	'ROTATE_DAILY'								=> 'Giornaliero',
	'ROTATE_HOURLY'								=> 'Orario',
	'ROTATE_MONTHLY'							=> 'Mensile',
	'ROTATE_PAGELOAD'							=> 'Caricamento pagina',
	'ROTATE_WEEKLY'								=> 'Settimanale',

	'SAMPLES'									=> 'Campioni',
	'SCRIPTS'									=> 'Script',
	'SELECT_FORUMS'								=> 'Seleziona forum',
	'SELECT_FORUMS_EXPLAIN'						=> 'Seleziona i forum da cui visualizzare argomenti/post. Lascia vuoto per selezionare da tutti i forum',
	'SELECT_MENU'								=> 'Seleziona Menu',
	'SELECT_PROFILE_FIELDS'						=> 'Seleziona i campi del profilo',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Verranno visualizzati solo i campi del profilo selezionati, se disponibili.',
	'SHOW_FIRST_POST'							=> 'Primo Post',
	'SHOW_HIDE_ME'								=> 'Consenti di nascondere lo stato online?',
	'SHOW_LAST_POST'							=> 'Ultimo Post',
	'SHOW_MEMBER_MENU'							=> 'Mostrare il menu utente?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Sostituisci la casella di accesso con il menu utente se l\'utente ha effettuato l\'accesso',
	'SHOW_WORD_COUNT'							=> 'Mostrare il conteggio delle parole?',

	'TEMPLATE'									=> 'Modello',
	'TOPIC_TITLE_LIMIT'							=> 'Numero massimo di caratteri per il titolo dell\'argomento',
	'TOPIC_TYPE'								=> 'Tipo Di Topic',
	'TOPIC_TYPE_EXPLAIN'						=> 'Selezionare i tipi di argomento che si desidera visualizzare. Lasciare le caselle deselezionate per selezionare da tutti i tipi di argomento',
	'TOPICS_LOOK_BACK'							=> 'Guarda indietro',
	'TOPICS_ONLY'								=> 'Solo argomenti?',
	'TOPICS_PER_PAGE'							=> 'Per pagina',

	'WORD_MAX_SIZE'								=> 'Dimensione massima del carattere',
	'WORD_MIN_SIZE'								=> 'Dimensione minima del carattere',
));
