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
	'ALL_TYPES'									=> 'Tutti i tipi',
	'ALL_GROUPS'								=> 'Tutti i gruppi',
	'ARCHIVES'									=> 'Archivi',
	'AUTO_LOGIN'								=> 'Consentire il login automatico?',
	'FILE_MANAGER'								=> 'Gestore file',
	'TOPIC_POST_IDS'							=> 'Dagli Ids Argomenti/Post',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(i) di argomenti/post da cui recuperare gli allegati, separati da <strong>virgole</strong>(,). Specificare se questa lista è per argomenti o id post di cui sopra.',
	'TOPIC_POST_IDS_TYPE'						=> 'Tipo di ID (sotto)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Allegati',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Compleanno',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Blocco personalizzato',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Membro in evidenza',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'Feed RSS/Atom',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Forum Sondaggio',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Forum Argomenti',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Google Maps',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Argomenti Popolari',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Link',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Box di accesso',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Membri',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Menù Membri',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Menù',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'I miei segnalibri',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Argomenti Recenti',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Statistiche',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Selettore stili',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Novità?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Chi è online',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Parola',

	// block views
	'BLOCK_VIEW'								=> 'Vista Blocco',
	'BLOCK_VIEW_BASIC'							=> 'Base',
	'BLOCK_VIEW_BOXED'							=> 'Scatola',
	'BLOCK_VIEW_DEFAULT'						=> 'Predefinito',
	'BLOCK_VIEW_SIMPLE'							=> 'Semplice',

	'CACHE_DURATION'							=> 'Durata cache',
	'CONTEXT'									=> 'Contesto',
	'CSS_SCRIPTS'								=> 'Script CSS',
	'CUSTOM_PROFILE_FIELDS'						=> 'Campi personalizzati del profilo',

	'DATE_RANGE'								=> 'Intervallo Date',
	'DISPLAY_PREVIEW'							=> 'Visualizzare l\'anteprima?',

	'EDIT_ME'									=> 'Modifica',
	'ENABLE_TOPIC_TRACKING'						=> 'Abilitare il monitoraggio degli argomenti?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Se abilitato, verranno indicati gli argomenti non letti ma i risultati dei blocchi non saranno memorizzati nella cache <strong>(non consigliato)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Hai inserito troppe parole da escludere. Il numero massimo di caratteri possibile è 255, hai inserito %s.',
	'EXCLUDE_WORDS'								=> 'Escludi parole',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Elenca le parole che vorresti escludere dalla parola separata da una virgola (,). Massimo 255 caratteri.',
	'EXPANDED'									=> 'Espanso',
	'EXTENSION_GROUP'							=> 'Gruppo di estensioni',

	'FEATURED_MEMBER_IDS'						=> 'ID Utente',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Elenco separato da virgole di utenti alla funzione (si applica solo alla modalità di visualizzazione dei membri in evidenza)',
	'FEED_DATA_PREVIEW'							=> 'Dati feed',
	'FEED_ITEM_TEMPLATE'						=> 'Modello Articolo',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>SUGGERIMENTI:</strong><br />
		<unk>		<ul class="sm-list">
			<unk> <unk>			<li>Accesso dati feed in <strong>elemento</strong> variabile e. . oggetto. itle</li>
			<unk> <unk>			<li>Il modello deve essere in <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Sintassi Twig</a></li>
			<unk>			<li>Clicca <strong>Campioni</strong> sopra per i modelli di esempio</li>
			<unk>			<li>Usa <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> per ottenere qualsiasi tag dal feed che non forniamo . .<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<unk>			<li>Usa il filtro json_encode di Twig, per vedere i contenuti dell\'array e. . <strong><code>{{ get_item_tags(\'\', \'image\')<unk> json_encode() }}</code></strong></li>
		<unk>		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Sorgente',
	'FEED_URL_PLACEHOLDER'						=> 'http://esempio.com/rss',
	'FEED_URLS'									=> 'URL feed',
	'FIRST_POST_ONLY'							=> 'Solo primo post',
	'FIRST_POST_TIME'							=> 'Prima fase di invio',
	'FORUMS_GET_TYPE'							=> 'Preleva tipo',
	'FORUMS_MAX_TOPICS'							=> 'Numero massimo di argomenti/post',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Numero massimo di caratteri per titolo',
	'FREQUENCY'									=> 'Frequenza',
	'FULL'										=> 'Pieno',
	'FULLSCREEN'								=> 'Schermo intero',

	'GET_TYPE'									=> 'Mostrare argomento/post?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Usa questa area di testo per inserire il contenuto HTML grezzo.</strong><br />Nota che qualsiasi contenuto pubblicato qui sovrascriverà il contenuto del blocco personalizzato e l\'editor di blocco visivo non sarà disponibile.',
	'HOURS_SHORT'								=> 'ore',

	'JS_SCRIPTS'								=> 'Script JS',

	'LAST_POST_TIME'							=> 'Ultimo Post',
	'LAST_READ_TIME'							=> 'Data ultima lettura',
	'LIMIT'										=> 'Limite',
	'LIMIT_FORUMS'								=> 'Id del forum (opzionale)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Immetti ogni id del forum separato da una virgola (,). Se impostato, verranno visualizzati solo gli argomenti dei forum specificati.',
	'LIMIT_POST_TIME'							=> 'Limita per ora post',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Se impostato, solo gli argomenti postati entro il periodo specificato saranno recuperati',

	'MAX_DEPTH'									=> 'Profondità massima',
	'MAX_ITEMS'									=> 'Numero massimo di elementi',
	'MAX_MEMBERS'								=> 'Max. Membri',
	'MAX_POSTS'									=> 'Numero massimo di messaggi',
	'MAX_TOPICS'								=> 'Numero massimo di argomenti',
	'MAX_WORDS'									=> 'Numero massimo di parole',
	'MANAGE_MENUS'								=> 'Gestisci Menu',
	'MAP_COORDINATES'							=> 'Coordinate',
	'MAP_COORDINATES_EXPLAIN'					=> 'Inserisci le coordinate nella latitudine della forma, longitudine',
	'MAP_HEIGHT'								=> 'Altezza',
	'MAP_LOCATION'								=> 'Località',
	'MAP_TITLE'									=> 'Titolo',
	'MAP_VIEW'									=> 'Vedi',
	'MAP_VIEW_HYBRID'							=> 'Ibrido',
	'MAP_VIEW_MAP'								=> 'Mappa',
	'MAP_VIEW_SATELITE'							=> 'Satée',
	'MAP_VIEW_TERRAIN'							=> 'Terreno',
	'MAP_ZOOM_LEVEL'							=> 'Livello di zoom',
	'MEMBERS_DATE'								=> 'Data',
	'MENU_NO_ITEMS'								=> 'Nessun elemento attivo da visualizzare',
	'MINI'										=> 'Mini',

	'OR'										=> '<strong>O</strong>',
	'ORDER_BY'									=> 'Ordina per',

	'POLL_FROM_FORUMS'							=> 'Visualizza sondaggio(i) dai forum(i)',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Verranno visualizzati solo i sondaggi dei forum selezionati fino a quando nessun argomento sarà specificato sopra',
	'POLL_FROM_GROUPS'							=> 'Visualizza sondaggi da gruppo(i)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Saranno visualizzati solo i sondaggi provenienti dai membri dei gruppi selezionati fino a quando non è specificato alcun utente/è specificato sopra',
	'POLL_FROM_TOPICS'							=> 'Mostra sondaggio(i) dall\'argomento',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(s) degli argomenti da cui recuperare i sondaggi, separati da <strong>virgole</strong>(,). Lasciare vuoto per selezionare qualsiasi argomento.',
	'POLL_FROM_USERS'							=> 'Mostra sondaggi da utente(i)',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id(i) di utente(i) di cui vuoi visualizzare i sondaggi, separati da <strong>virgole</strong>(,). Lascia vuoto per selezionare i sondaggi di qualsiasi utente.',
	'POSTS_TITLE_LIMIT'							=> 'Numero massimo di caratteri per il titolo del post',
	'PREVIEW_MAX_CHARS'							=> 'Numero di caratteri per l\'anteprima',

	'QUERY_TYPE'								=> 'Modalità Display',

	'ROTATE_DAILY'								=> 'Giornaliero',
	'ROTATE_HOURLY'								=> 'Ogni ora',
	'ROTATE_MONTHLY'							=> 'Mensile',
	'ROTATE_PAGELOAD'							=> 'Carico pagina',
	'ROTATE_WEEKLY'								=> 'Settimanale',

	'SAMPLES'									=> 'Campioni',
	'SCRIPTS'									=> 'Script',
	'SELECT_FORUMS'								=> 'Seleziona forum',
	'SELECT_FORUMS_EXPLAIN'						=> 'Seleziona i forum da cui visualizzare argomenti/post. Lascia vuoto per selezionare tutti i forum',
	'SELECT_MENU'								=> 'Seleziona Menu',
	'SELECT_PROFILE_FIELDS'						=> 'Seleziona i campi del profilo',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Verranno visualizzati solo i campi del profilo selezionati, se disponibili.',
	'SHOW_FIRST_POST'							=> 'Primo Post',
	'SHOW_HIDE_ME'								=> 'Permettere di nascondere lo stato online?',
	'SHOW_LAST_POST'							=> 'Ultimo Post',
	'SHOW_MEMBER_MENU'							=> 'Mostra menù utente?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Sostituisci la casella di accesso con il menu utente se l\'utente è connesso',
	'SHOW_WORD_COUNT'							=> 'Mostra il numero di parole?',

	'TEMPLATE'									=> 'Modello',
	'TOPIC_TITLE_LIMIT'							=> 'Numero massimo di caratteri per il titolo del topic',
	'TOPIC_TYPE'								=> 'Tipo Topic',
	'TOPIC_TYPE_EXPLAIN'						=> 'Seleziona i tipi di topic che desideri visualizzare. Lascia le caselle deselezionata per selezionare tra tutti i tipi di topic',
	'TOPICS_LOOK_BACK'							=> 'Guarda indietro',
	'TOPICS_ONLY'								=> 'Solo argomenti?',
	'TOPICS_PER_PAGE'							=> 'Per pagina',

	'WORD_MAX_SIZE'								=> 'Dimensione massima font',
	'WORD_MIN_SIZE'								=> 'Dimensione minima carattere',
));
