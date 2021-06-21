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
	'ADD_BLOCK_EXPLAIN'							=> '* Træk og slip blokke',
	'AJAX_ERROR'								=> 'Ups! Der opstod en fejl under behandlingen af din anmodning. Prøv venligst igen.',
	'AJAX_LOADING'								=> 'Indlæser...',
	'AJAX_PROCESSING'							=> 'Arbejder...',

	'BACKGROUND'								=> 'Baggrund',
	'BLOCKS'									=> 'Blokke',
	'BLOCKS_COPY_FROM'							=> 'Kopier Blokke',
	'BLOCK_ACTIVE'								=> 'Aktiv',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Vis kun på underordnede ruter',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Skjul på underordnede ruter',
	'BLOCK_CLASS'								=> 'CSS Klasse',
	'BLOCK_CLASS_EXPLAIN'						=> 'Ændre blok udseende med CSS klasser',
	'BLOCK_DESIGN'								=> 'Udseende',
	'BLOCK_DISPLAY_TYPE'						=> 'Vis',
	'BLOCK_HIDE_TITLE'							=> 'Skjul bloktitel?',
	'BLOCK_INACTIVE'							=> 'Inaktiv',
	'BLOCK_MISSING_TEMPLATE'					=> 'Mangler påkrævet blok skabelon. Kontakt udvikleren',
	'BLOCK_NOT_FOUND'							=> 'Ups! Den forespurgte blok service blev ikke fundet',
	'BLOCK_NO_DATA'								=> 'Ingen data at vise',
	'BLOCK_NO_ID'								=> 'Ups! Mangler blok-id',
	'BLOCK_PERMISSION'							=> 'Tilladelse',
	'BLOCK_PERMISSION_ALLOW'					=> 'Vis til',
	'BLOCK_PERMISSION_DENY'						=> 'Skjul fra',
	'BLOCK_PERMISSION_EXPLAIN'					=> 'Brug CTRL + klik for at skifte valg',
	'BLOCK_SHOW_ALWAYS'							=> 'Altid',
	'BLOCK_STATUS'								=> 'Status',
	'BLOCK_UPDATED'								=> 'Bloker indstillinger opdateret',

	'CANCEL'									=> 'Annuller',
	'CHILD_ROUTE'								=> 'Barn',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/min-article',
	'CLEAR'										=> 'Ryd',
	'COPY'										=> 'Kopiér',
	'COPY_BLOCKS'								=> 'Kopier Blokke?',
	'COPY_BLOCKS_CONFIRM'						=> 'Er du sikker på, at du vil kopiere blokke fra en anden side?<br /><br />Dette vil slette alle eksisterende blokke og deres indstillinger for denne side og erstatte dem med blokke fra den valgte side.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'Hvis angivet, vil alle webstedssider, hvor du ikke har angivet blokke, arve blokkene fra standardlayoutet. Du kan dog tilsidesætte standard layout for bestemte sider ved hjælp af indstillingerne til højre.',
	'DELETE'									=> 'Slet',
	'DELETE_ALL_BLOCKS'							=> 'Slet Alle Blokke',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'Er du sikker på, at du vil slette alle blokke for denne side?',
	'DELETE_BLOCK'								=> 'Slet Blok',
	'DELETE_BLOCK_CONFIRM'						=> 'Er du sikker på, at du vil slette denne blok?<br /><br /><br /><strong>Bemærk:</strong> Du bliver nødt til at gemme layoutændringerne for at gøre dette permanent.',

	'EDIT'										=> 'Rediger',
	'EDIT_BLOCK'								=> 'Rediger Blok',
	'EXIT_EDIT_MODE'							=> 'Afslut Redigeringstilstand',

	'FEED_PROBLEMS'								=> 'Der opstod et problem med at behandle de(n) angivne rss/atom feed(er)',
	'FEED_URL_MISSING'							=> 'Angiv mindst et rss/atom feed til at begynde',
	'FIELD_INVALID'								=> 'Den angivne værdi for feltet “%s” har et ugyldigt format',
	'FIELD_REQUIRED'							=> '“%s” er et obligatorisk felt',
	'FIELD_TOO_LONG'							=> 'Den angivne værdi for feltet “%1$s” er for lang. Den maksimale acceptable værdi er %2$d.',
	'FIELD_TOO_SHORT'							=> 'Den angivne værdi for feltet “%1$s” er for kort. Den mindste acceptable værdi er %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'Vis ikke blokke på denne side',
	'HIDE_BLOCK_POSITIONS'						=> 'Vis ikke blokke for følgende blokpositioner:',

	'IMAGES'									=> 'Billeder',

	'LAYOUT'									=> 'Layout',
	'LAYOUT_SAVED'								=> 'Layout gemt!',
	'LAYOUT_SETTINGS'							=> 'Layout Indstillinger',
	'LEAVE_CONFIRM'								=> 'Du har nogle ikke-gemte ændringer på denne side. Gem venligst dit arbejde før du går videre',
	'LISTS'										=> 'Lister',

	'MAKE_DEFAULT_LAYOUT'						=> 'Sæt Som Standard Layout',

	'OR'										=> '<strong>ELLER</strong>',

	'PARENT_ROUTE'								=> 'Overordnet',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/articles',
	'PREDEFINED_CLASSES'						=> 'Prædefinerede klasser',

	'REDO'										=> 'Gendan',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Fjern Som Standard Layout',
	'REMOVE_STARTPAGE'							=> 'Fjern Startside',
	'ROUTE_HIDDEN_BLOCKS'						=> 'Blokke bliver skjult for denne side',
	'ROUTE_HIDDEN_POSITIONS'					=> 'Blokke skjules for følgende positioner',
	'ROUTE_UPDATED'								=> 'Sideindstillinger blev opdateret',

	'SAVE_CHANGES'								=> 'Gem Ændringer',
	'SAVE_SETTINGS'								=> 'Gem Indstillinger',
	'SELECT_ICON'								=> 'Vælg et ikon',
	'SETTINGS'									=> 'Indstillinger',
	'SETTING_TOO_BIG'							=> 'Den angivne værdi for indstillingen “%1$s” er for høj. Den maksimale acceptable værdi er %2$d.',
	'SETTING_TOO_LONG'							=> 'Den angivne værdi for indstillingen “%1$s” er for lang. Den maksimale acceptable længde er %2$d.',
	'SETTING_TOO_LOW'							=> 'Den angivne værdi for indstillingen “%1$s” er for lav. Den mindste acceptable værdi er %2$d.',
	'SETTING_TOO_SHORT'							=> 'Den angivne værdi for indstillingen “%1$s” er for kort. Den mindste acceptable længde er %2$d.',
	'SET_STARTPAGE'								=> 'Sæt Som Startside',

	'TITLES'									=> 'Titler',

	'UPDATE_SIMILAR'							=> 'Opdater blokke med lignende indstillinger',
	'UNDO'										=> 'Fortryd',

	'VIEW_DEFAULT_LAYOUT'						=> 'Vis/Rediger Standard Layout',
	'VISIT_PAGE'								=> 'Besøg Side',
));
