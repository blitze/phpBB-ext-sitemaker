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
	'ADD_BLOCK_EXPLAIN'							=> '*Dra og slipp blokker',
	'AJAX_ERROR'								=> 'Oops! Det oppstod en feil ved behandling av forespørselen. Prøv på nytt.',
	'AJAX_LOADING'								=> 'Laster...',
	'AJAX_PROCESSING'							=> 'Arbeider...',

	'BACKGROUND'								=> 'Bakgrunn',
	'BLOCKS'									=> 'Blokker',
	'BLOCKS_COPY_FROM'							=> 'Kopier blokker',
	'BLOCK_ACTIVE'								=> 'Aktiv',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Vis kun på underrute',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Skjul på underordnede ruter',
	'BLOCK_CLASS'								=> 'CSS klasse',
	'BLOCK_CLASS_EXPLAIN'						=> 'Endre blokkutseende med CSS-klasser',
	'BLOCK_DESIGN'								=> 'Utseende',
	'BLOCK_DISPLAY_TYPE'						=> 'Skjerm',
	'BLOCK_HIDE_TITLE'							=> 'Skjul blokktittel?',
	'BLOCK_INACTIVE'							=> 'Inaktiv',
	'BLOCK_MISSING_TEMPLATE'					=> 'Mangler nødvendig blokkmal. Kontakt utvikler',
	'BLOCK_NOT_FOUND'							=> 'Oops! Den forespurte blokk-tjenesten ble ikke funnet',
	'BLOCK_NO_DATA'								=> 'Ingen data å vise',
	'BLOCK_NO_ID'								=> 'Oops! Mangler blokk-ID',
	'BLOCK_PERMISSION'							=> 'Tillatelse',
	'BLOCK_PERMISSION_ALLOW'					=> 'Vis til',
	'BLOCK_PERMISSION_DENY'						=> 'Skjul i',
	'BLOCK_PERMISSION_EXPLAIN'					=> 'Bruk CTRL + klikk for å veksle',
	'BLOCK_SHOW_ALWAYS'							=> 'Alltid',
	'BLOCK_STATUS'								=> 'Status:',
	'BLOCK_UPDATED'								=> 'Innstillingene for blokken ble oppdatert',

	'CANCEL'									=> 'Avbryt',
	'CHILD_ROUTE'								=> 'Barn',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/my-article',
	'CLEAR'										=> 'Tøm',
	'COPY'										=> 'Kopier',
	'COPY_BLOCKS'								=> 'Kopiere blokker?',
	'COPY_BLOCKS_CONFIRM'						=> 'Er du sikker på at du vil kopiere blokker fra en annen side?<br /><br />Dette vil slette alle eksisterende blokker og deres innstillinger for denne siden og erstatte dem med blokkene fra den valgte siden.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'Hvis satt vil alle nettstedssider du ikke har angitte blokker arve blokkene fra standardoppsettet. Du kan imidlertid overstyre standard oppsett for bestemte sider ved å bruke alternativene til høyre.',
	'DELETE'									=> 'Slett',
	'DELETE_ALL_BLOCKS'							=> 'Slett alle blokker',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'Er du sikker på at du vil slette alle blokker for denne siden?',
	'DELETE_BLOCK'								=> 'Slett blokk',
	'DELETE_BLOCK_CONFIRM'						=> 'Er du sikker på at du vil slette denne blokken?<br /><br /><br /><strong>Merk:</strong> Du må lagre oppsettet endringer for å gjøre denne permanent.',

	'EDIT'										=> 'Rediger',
	'EDIT_BLOCK'								=> 'Redigere blokk',
	'EXIT_EDIT_MODE'							=> 'Avslutt redigeringsmodus',

	'FEED_PROBLEMS'								=> 'Det oppsto et problem med behandlingen av vedlagte rener/om-feed(s)',
	'FEED_URL_MISSING'							=> 'Oppgi minst én rss/atom-feed for å begynne',
	'FIELD_INVALID'								=> 'Den angitte verdien for feltet «%s» har et ugyldig format',
	'FIELD_REQUIRED'							=> '«%s» er et obligatorisk felt',
	'FIELD_TOO_LONG'							=> 'Den oppgitte verdien for feltet "%1$s" er for lang. Maksimal akseptabel verdi er %2$d.',
	'FIELD_TOO_SHORT'							=> 'Den angitte verdien for feltet “%1$s” er for kort. Minimumverdien er %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'Ikke vis blokker på denne siden',
	'HIDE_BLOCK_POSITIONS'						=> 'Ikke vis blokker for følgende blokkplasseringer:',

	'IMAGES'									=> 'Bilder',

	'LAYOUT'									=> 'Oppsett',
	'LAYOUT_SAVED'								=> 'Oppsett lagret!',
	'LAYOUT_SETTINGS'							=> 'Oppsett Innstillinger',
	'LEAVE_CONFIRM'								=> 'Du har noen ulagrede endringer i denne siden. Vennligst lagre ditt arbeid før du går videre',
	'LISTS'										=> 'Lister',

	'MAKE_DEFAULT_LAYOUT'						=> 'Sett som standard oppsett',

	'OR'										=> '<strong>ELLER</strong>',

	'PARENT_ROUTE'								=> 'Forelder',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/artikler',
	'PREDEFINED_CLASSES'						=> 'Forhåndsdefinerte klasser',

	'REDO'										=> 'Gjenta',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Fjern som standardoppsett',
	'REMOVE_STARTPAGE'							=> 'Fjern startside',
	'ROUTE_HIDDEN_BLOCKS'						=> 'Blokker er skjult for denne siden',
	'ROUTE_HIDDEN_POSITIONS'					=> 'Blokker er skjult for følgende posisjoner',
	'ROUTE_UPDATED'								=> 'Sideinnstillinger ble oppdatert',

	'SAVE_CHANGES'								=> 'Lagre endringer',
	'SAVE_SETTINGS'								=> 'Lagre innstillinger',
	'SELECT_ICON'								=> 'Velg et ikon',
	'SETTINGS'									=> 'Innstillinger',
	'SETTING_TOO_BIG'							=> 'Den oppgitte verdien for innstillingen «%1$s» er for høy. Maksimal akseptabel verdi er %2$d.',
	'SETTING_TOO_LONG'							=> 'Den oppgitte verdien for innstillingen “%1$s” er for lang. Maksimal akseptabel lengde er %2$d.',
	'SETTING_TOO_LOW'							=> 'Den angitte verdien for innstillingen “%1$s” er for lav. Laveste akseptable verdi er %2$d.',
	'SETTING_TOO_SHORT'							=> 'Den oppgitte verdien for innstillingen “%1$s” er for kort. Den minste akseptable lengden er %2$d.',
	'SET_STARTPAGE'								=> 'Angi som startside',

	'TITLES'									=> 'Titler',

	'UPDATE_SIMILAR'							=> 'Oppdater blokker med lignende innstillinger',
	'UNDO'										=> 'Angre',

	'VIEW_DEFAULT_LAYOUT'						=> 'Vis/rediger standard oppsett',
	'VISIT_PAGE'								=> 'Besøk side',
));
