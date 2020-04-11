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

	'BLOCKS_CLEANUP'			=> 'Pulizia blocchi',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'I seguenti elementi non esistono più o non sono raggiungibili, quindi è possibile eliminare tutti i blocchi associati a essi. Si prega di tenere a mente che alcuni di questi potrebbero essere falsi positivi',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Blocchi non validi (es. da estensioni disinstallate):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Pagine non raggiungibili/rotte:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Stili disinstallati (ids):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'I blocchi sono stati eliminati con successo',

	'FILEMANAGER_SETTINGS'						=> 'Impostazioni del gestore file',
	'FILEMANAGER_STATUS'						=> 'Stato',
	'FILEMANAGER_NO_EXIST'						=> 'You will need to install the File Manager before you can enable it. Installation instructions are found <a href="%s" target="_blank"  rel="noopener noreferrer"><strong>here</strong></a>',
	'FILEMENAGER_NOT_WRITABLE'					=> 'File manager config folder (root/ResponsiveFilemanager/filemanager/config/) is not writable. Please change the permissions to writable by all (777 or -rwxrwxrwx within your FTP Client)',
	'FILEMANAGER_IMAGE_AUTO_RESIZE'				=> 'Ridimensionare automaticamente le immagini caricate?',
	'FILEMANAGER_IMAGE_AUTO_RESIZE_DIMENSIONS'	=> 'Ridimensiona alle dimensioni specificate',
	'FILEMANAGER_IMAGE_AUTO_RESIZING_MODE'		=> 'Modalità ridimensionamento automatico',
	'FILEMANAGER_IMAGE_MAX_DIMENSIONS'			=> 'Dimensione massima immagine',
	'FILEMANAGER_IMAGE_MAX_MODE'				=> 'Massimo modalità dimensione immagine',
	'FILEMANAGER_IMAGE_MODE_EXPLAIN'			=> 'Usato per calcolare l\'altezza/larghezza se si fornisce solo altezza o larghezza ma non entrambe sopra',
	'FILEMANAGER_IMAGE_MODE_AUTO'				=> 'Auto',
	'FILEMANAGER_IMAGE_MODE_CROP'				=> 'Ritaglia',
	'FILEMANAGER_IMAGE_MODE_EXACT'				=> 'Esatto',
	'FILEMANAGER_IMAGE_MODE_LANDSCAPE'			=> 'Orizzontale',
	'FILEMANAGER_IMAGE_MODE_PORTRAIT'			=> 'Ritratto',
	'FILEMANAGER_WATERMARK'						=> 'Filigrana',
	'FILEMANAGER_WATERMARK_EXPLAIN'				=> 'URL dell\'immagine da usare come filigrana su tutte le immagini caricate',
	'FILEMANAGER_WATERMARK_POSITION'			=> 'Posizione filigrana',
	'FILEMANAGER_WATERMARK_POSITION_EXPLAIN'	=> 'Seleziona una posizione predeterminata dove la filigrana deve apparire o inserire le coordinate ad es. 50x100',
	'FILEMANAGER_WATERMARK_POSITION_TL'			=> 'In alto a sinistra',
	'FILEMANAGER_WATERMARK_POSITION_T'			=> 'Sopra',
	'FILEMANAGER_WATERMARK_POSITION_TR'			=> 'Alto a destra',
	'FILEMANAGER_WATERMARK_POSITION_L'			=> 'Sinistra',
	'FILEMANAGER_WATERMARK_POSITION_M'			=> 'Al centro',
	'FILEMANAGER_WATERMARK_POSITION_R'			=> 'Destra',
	'FILEMANAGER_WATERMARK_POSITION_BL'			=> 'In basso a sinistra',
	'FILEMANAGER_WATERMARK_POSITION_B'			=> 'Basso',
	'FILEMANAGER_WATERMARK_POSITION_BR'			=> 'In basso a destra',
	'FILEMANAGER_WATERMARK_POSITION_SUFFIX'		=> 'o',
	'FILEMANAGER_WATERMARK_PADDING'				=> 'Riempimento filigrana',
	'FILEMANAGER_WATERMARK_PADDING_EXPLAIN'		=> 'Se si utilizza una posizione predeterminata è possibile regolare il padding dai bordi. Se si utilizza il coordinatore, questo valore viene ignorato',

	'FORUM_INDEX_SETTINGS'			=> 'Impostazioni indice forum',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Queste impostazioni si applicano solo quando non c\'è nessuna pagina iniziale definita',

	'HIDE'			=> 'Pelle',
	'HIDE_BIRTHDAY'	=> 'Nascondi sezione compleanno',
	'HIDE_LOGIN'	=> 'Nascondi casella di accesso',
	'HIDE_ONLINE'	=> 'Nascondi Whos online',

	'LAYOUT_BLOG'		=> 'Blog',
	'LAYOUT_CUSTOM'		=> 'Personale',
	'LAYOUT_HOLYGRAIL'	=> 'Rotaia Santa',
	'LAYOUT_PORTAL'		=> 'Portale',
	'LAYOUT_PORTAL_ALT'	=> 'Portale (alt)',
	'LAYOUT_SETTINGS'	=> 'Impostazioni Layout',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Blocchi Sitemaker eliminati per mancanza di stile con id %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Blocchi di sitemaker eliminati per pagine guastate:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Blocchi Sitemaker non validi:<br />%s',

	'NAVIGATION_SETTINGS'	=> 'Impostazioni di navigazione',
	'NO_NAVBAR'				=> 'Nulla',

	'SELECT_NAVBAR_MENU'		=> 'Seleziona il menu di navigazione principale',
	'SETTINGS_SAVED'			=> 'Le tue impostazioni sono state salvate',
	'SHOW'						=> 'Mostra',
	'SHOW_FORUM_NAV'			=> 'Mostrare \'Forum\' nella barra di navigazione?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Quando una pagina è impostata come pagina iniziale invece dell\'indice del forum, se mostrassimo \'Forum\' nella barra di navigazione',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Sì - con l\'icona:',
]);
