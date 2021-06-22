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
	'ADD_BLOCK_EXPLAIN'							=> '*Sleep en laat blokken vallen',
	'AJAX_ERROR'								=> 'Oeps! Er is een fout opgetreden tijdens het verwerken van uw verzoek. Probeer het opnieuw.',
	'AJAX_LOADING'								=> 'Laden...',
	'AJAX_PROCESSING'							=> 'Bezig...',

	'BACKGROUND'								=> 'Achtergrond',
	'BLOCKS'									=> 'Blokken',
	'BLOCKS_COPY_FROM'							=> 'Blokken kopiëren',
	'BLOCK_ACTIVE'								=> 'actief',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Toon alleen op onderliggende routes',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Verberg bij onderliggende routes',
	'BLOCK_CLASS'								=> 'CSS class',
	'BLOCK_CLASS_EXPLAIN'						=> 'Pas blokweergave aan met CSS-klassen',
	'BLOCK_DESIGN'								=> 'Uiterlijk',
	'BLOCK_DISPLAY_TYPE'						=> 'Weergeven',
	'BLOCK_HIDE_TITLE'							=> 'Verberg bloktitel?',
	'BLOCK_INACTIVE'							=> 'Inactief',
	'BLOCK_MISSING_TEMPLATE'					=> 'Ontbrekende vereiste block template. Neem contact op met de ontwikkelaar',
	'BLOCK_NOT_FOUND'							=> 'Oeps! De gevraagde block-service is niet gevonden',
	'BLOCK_NO_DATA'								=> 'Geen gegevens om weer te geven',
	'BLOCK_NO_ID'								=> 'Oeps! Ontbrekende blok-ID',
	'BLOCK_PERMISSION'							=> 'Bevoegdheden',
	'BLOCK_PERMISSION_ALLOW'					=> 'Tonen aan',
	'BLOCK_PERMISSION_DENY'						=> 'Verbergen van',
	'BLOCK_PERMISSION_EXPLAIN'					=> 'Gebruik CTRL + klik om te schakelen tussen selectie',
	'BLOCK_SHOW_ALWAYS'							=> 'altijd',
	'BLOCK_STATUS'								=> 'status',
	'BLOCK_UPDATED'								=> 'Blok instellingen succesvol bijgewerkt',

	'CANCEL'									=> 'annuleren',
	'CHILD_ROUTE'								=> 'Kind',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/mijn-artikel',
	'CLEAR'										=> 'Verwijderen',
	'COPY'										=> 'Kopiëren',
	'COPY_BLOCKS'								=> 'Blokken kopiëren?',
	'COPY_BLOCKS_CONFIRM'						=> 'Weet je zeker dat je blokken wilt kopiëren van een andere pagina?<br /><br />Dit zal alle bestaande blokken en hun instellingen voor deze pagina verwijderen en vervangen door de blokken van de geselecteerde pagina.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'Als dit is ingesteld zullen alle website pagina\'s waarvoor u geen specifieke blokken hebt erven de blokken van de standaard indeling. U kunt echter de standaard lay-out voor bepaalde pagina\'s overschrijven door gebruik te maken van de opties naar rechts.',
	'DELETE'									=> 'Verwijderen',
	'DELETE_ALL_BLOCKS'							=> 'Alle blokken verwijderen',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'Weet je zeker dat je alle blokken voor deze pagina wilt verwijderen?',
	'DELETE_BLOCK'								=> 'Blok verwijderen',
	'DELETE_BLOCK_CONFIRM'						=> 'Weet u zeker dat u dit blok wilt verwijderen?<br /><br /><br /><strong>Opmerking:</strong> U moet de lay-out wijzigingen opslaan om dit permanent te maken.',

	'EDIT'										=> 'Bewerken',
	'EDIT_BLOCK'								=> 'Blok bewerken',
	'EXIT_EDIT_MODE'							=> 'Verlaat de bewerkingsmodus',

	'FEED_PROBLEMS'								=> 'Er is een probleem opgetreden bij het verwerken van de geleverde rss/atom feed(s)',
	'FEED_URL_MISSING'							=> 'Geef ten minste één rss/atom feed om te beginnen',
	'FIELD_INVALID'								=> 'De opgegeven waarde voor het veld%s" heeft een ongeldig formaat',
	'FIELD_REQUIRED'							=> '"%s" is een verplicht veld',
	'FIELD_TOO_LONG'							=> 'De opgegeven waarde voor het veld "%1$s" is te lang. De maximaal aanvaardbare waarde is %2$d.',
	'FIELD_TOO_SHORT'							=> 'De opgegeven waarde voor het veld "%1$s" is te kort. De minimaal aanvaardbare waarde is %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'Toon geen blokken op deze pagina',
	'HIDE_BLOCK_POSITIONS'						=> 'Blokken voor de volgende blokposities niet weergeven:',

	'IMAGES'									=> 'Afbeeldingen',

	'LAYOUT'									=> 'Indeling',
	'LAYOUT_SAVED'								=> 'Layout succesvol opgeslagen!',
	'LAYOUT_SETTINGS'							=> 'Instellingen schermindeling',
	'LEAVE_CONFIRM'								=> 'U hebt enkele niet-opgeslagen wijzigingen op deze pagina. Sla uw werk op voordat u verdergaat',
	'LISTS'										=> 'Lijsten',

	'MAKE_DEFAULT_LAYOUT'						=> 'Instellen als standaard lay-out',

	'OR'										=> '<strong>OF</strong>',

	'PARENT_ROUTE'								=> 'Bovenliggende',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/artikelen',
	'PREDEFINED_CLASSES'						=> 'Vooraf gedefinieerde klassen',

	'REDO'										=> 'Opnieuw',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Verwijder als standaard lay-out',
	'REMOVE_STARTPAGE'							=> 'Verwijder startpagina',
	'ROUTE_HIDDEN_BLOCKS'						=> 'Blokken worden verborgen voor deze pagina',
	'ROUTE_HIDDEN_POSITIONS'					=> 'Blokken worden verborgen voor de volgende posities',
	'ROUTE_UPDATED'								=> 'Paginainstellingen succesvol bijgewerkt',

	'SAVE_CHANGES'								=> 'Wijzigingen opslaan',
	'SAVE_SETTINGS'								=> 'Instellingen opslaan',
	'SELECT_ICON'								=> 'Selecteer een pictogram',
	'SETTINGS'									=> 'Instellingen',
	'SETTING_TOO_BIG'							=> 'De opgegeven waarde voor de instelling "%1$s" is te hoog. De maximaal aanvaardbare waarde is %2$d.',
	'SETTING_TOO_LONG'							=> 'De opgegeven waarde voor de instelling "%1$s" is te lang. De maximaal aanvaardbare lengte is %2$d.',
	'SETTING_TOO_LOW'							=> 'De opgegeven waarde voor de instelling "%1$s" is te laag. De minimaal aanvaardbare waarde is %2$d.',
	'SETTING_TOO_SHORT'							=> 'De opgegeven waarde voor de instelling "%1$s" is te kort. De minimale aanvaardbare lengte is %2$d.',
	'SET_STARTPAGE'								=> 'Als startpagina instellen',

	'TITLES'									=> 'Titels',

	'UPDATE_SIMILAR'							=> 'Update blokken met vergelijkbare instellingen',
	'UNDO'										=> 'Herstel',

	'VIEW_DEFAULT_LAYOUT'						=> 'Bekijk/Bewerk standaard lay-out',
	'VISIT_PAGE'								=> 'Pagina bezoeken',
));
