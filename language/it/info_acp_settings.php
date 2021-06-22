<?php

/**
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	$lang = [];
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

$lang = array_merge($lang, [
	'ACP_SITEMAKER'		=> 'SiteMaker',
	'ACP_SM_SETTINGS'	=> 'Impostazioni',

	'BLOCKS_CLEANUP'			=> 'Pulizia Blocchi',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'I seguenti elementi sono stati trovati per non esistere più o irraggiungibile, e quindi è possibile eliminare tutti i blocchi ad essi associati. Si prega di tenere a mente che alcuni di questi possono essere falsi positivi',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Blocchi non validi (ad esempio da estensioni disinstallate):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Pagine Non raggiungibili/Interrotte:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Stili Disinstallati (id):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Blocchi purificati con successo',

	'FORUM_INDEX_SETTINGS'			=> 'Impostazioni Indice Forum',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Queste impostazioni si applicano solo quando non c\'è nessuna pagina iniziale definita',

	'HIDE'			=> 'Nascondi',
	'HIDE_BIRTHDAY'	=> 'Nascondi sezione Compleanno',
	'HIDE_LOGIN'	=> 'Nascondi casella di accesso',
	'HIDE_ONLINE'	=> 'Nascondi la sezione Whos online',

	'LAYOUT_BLOG'		=> 'Blog',
	'LAYOUT_CUSTOM'		=> 'Personalizzato',
	'LAYOUT_HOLYGRAIL'	=> 'Santo Graal',
	'LAYOUT_PORTAL'		=> 'Portale',
	'LAYOUT_PORTAL_ALT'	=> 'Portale (In Alte)',
	'LAYOUT_SETTINGS'	=> 'Impostazioni Layout',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Blocchi Sitemaker eliminati per lo stile mancante con id %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Blocchi Sitemaker eliminati per pagine rotte:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Blocchi Sitemaker eliminati non validi:<br />%s',

	'NAVIGATION_SETTINGS'		=> 'Impostazioni Di Navigazione',

	'SETTINGS_SAVED'			=> 'Le tue impostazioni sono state salvate',
	'SHOW'						=> 'Mostra',
	'SHOW_FORUM_NAV'			=> 'Mostra \'Forum\' nella barra di navigazione?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Quando una pagina è impostata come pagina iniziale invece dell\'indice del forum, dovremmo visualizzare \'Forum\' nella barra di navigazione',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Sì - con icona:',
]);
