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
	'ADD_BLOCK_EXPLAIN'							=> '*Sleep en plaats blokken',
	'AJAX_ERROR'								=> 'Oeps! Er is een fout opgetreden bij het verwerken van uw verzoek. Probeer het opnieuw.',
	'AJAX_LOADING'								=> 'Laden...',
	'AJAX_PROCESSING'							=> 'Bezig...',

	'BACKGROUND'								=> 'Achtergrond',
	'BLOCKS'									=> 'Blokken',
	'BLOCKS_COPY_FROM'							=> 'Blokken kopiëren',
	'BLOCK_ACTIVE'								=> 'Actief',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Toon alleen op subroutes',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Verberg op subroutes',
	'BLOCK_CLASS'								=> 'CSS-klasse',
	'BLOCK_CLASS_EXPLAIN'						=> 'Bewerk blokuiterlijk met CSS classes',
	'BLOCK_DESIGN'								=> 'Uiterlijk',
	'BLOCK_DISPLAY_TYPE'						=> 'Weergave',
	'BLOCK_HIDE_TITLE'							=> 'Blok titel verbergen?',
	'BLOCK_INACTIVE'							=> 'Inactief',
	'BLOCK_MISSING_TEMPLATE'					=> 'Ontbrekende vereiste block template. Neem contact op met de ontwikkelaar',
	'BLOCK_NOT_FOUND'							=> 'Oeps! De gevraagde blokservice is niet gevonden',
	'BLOCK_NO_DATA'								=> 'Geen gegevens om weer te geven',
	'BLOCK_NO_ID'								=> 'Oeps! Ontbrekende blok id',
	'BLOCK_PERMISSION'							=> 'Bevoegdheden',
	'BLOCK_PERMISSION_ALLOW'					=> 'Tonen aan',
	'BLOCK_PERMISSION_DENY'						=> 'Verbergen van',
	'BLOCK_PERMISSION_EXPLAIN'					=> 'Gebruik CTRL + klik om te schakelen tussen selectie',
	'BLOCK_SHOW_ALWAYS'							=> 'Altijd',
	'BLOCK_STATUS'								=> 'Status',
	'BLOCK_UPDATED'								=> 'Blok instellingen succesvol bijgewerkt',

	'CANCEL'									=> 'Annuleer',
	'CHILD_ROUTE'								=> 'Kind',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/mijn-artikel',
	'CLEAR'										=> 'Leeg',
	'COPY'										=> 'Kopiëren',
	'COPY_BLOCKS'								=> 'Blokken kopiëren?',
	'COPY_BLOCKS_CONFIRM'						=> 'Weet u zeker dat u blokken wilt kopiëren van een andere pagina?<br /><br />Dit zal alle bestaande blokken en hun instellingen voor deze pagina verwijderen en vervangen door de blokken van de geselecteerde pagina.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'Indien ingesteld, zullen alle website pagina\'s waarvoor u geen blokken hebt opgegeven de blokken van de standaard lay-out erven. U kunt echter wel de standaard lay-out overschrijven voor bepaalde pagina\'s met behulp van de opties aan de rechterkant.',
	'DELETE'									=> 'Verwijderen',
	'DELETE_ALL_BLOCKS'							=> 'Verwijder alle blokken',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'Weet u zeker dat u alle blokken voor deze pagina wilt verwijderen?',
	'DELETE_BLOCK'								=> 'Blok verwijderen',
	'DELETE_BLOCK_CONFIRM'						=> 'Weet je zeker dat je dit blok wilt verwijderen?<br /><br /><br /><strong>Opmerking:</strong> U moet de wijzigingen in de lay-out opslaan om dit permanent te maken.',

	'EDIT'										=> 'Bewerken',
	'EDIT_BLOCK'								=> 'Blok bewerken',
	'EXIT_EDIT_MODE'							=> 'Bewerken modus afsluiten',

	'FEED_PROBLEMS'								=> 'Er was een probleem bij het verwerken van de verstrekte rss/atom feed(s)',
	'FEED_URL_MISSING'							=> 'Geef minstens één rss/atom feed om te beginnen',
	'FIELD_INVALID'								=> 'De opgegeven waarde voor het veld "%s" heeft een ongeldig formaat',
	'FIELD_REQUIRED'							=> '"%s" is een verplicht veld',
	'FIELD_TOO_LONG'							=> 'De opgegeven waarde voor het veld "%1$s" is te lang. De maximaal aanvaardbare waarde is %2$d.',
	'FIELD_TOO_SHORT'							=> 'De opgegeven waarde voor het veld "%1$s" is te kort. De minimale aanvaardbare waarde is %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'Blokken op deze pagina niet weergeven',
	'HIDE_BLOCK_POSITIONS'						=> 'Blokken voor de volgende posities niet laten zien:',

	'IMAGES'									=> 'Afbeeldingen',

	'LAYOUT'									=> 'Lay-out',
	'LAYOUT_SAVED'								=> 'Lay-out succesvol opgeslagen!',
	'LAYOUT_SETTINGS'							=> 'Lay-out instellingen',
	'LEAVE_CONFIRM'								=> 'U heeft enkele niet opgeslagen wijzigingen op deze pagina. Sla uw werk op voordat u verdergaat',
	'LISTS'										=> 'Lijsten',

	'MAKE_DEFAULT_LAYOUT'						=> 'Instellen als standaard lay-out',

	'OR'										=> '<strong>OF</strong>',

	'PARENT_ROUTE'								=> 'Bovenliggend',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/artikelen',
	'PREDEFINED_CLASSES'						=> 'Voorgedefinieerde klassen',

	'REDO'										=> 'Opnieuw',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Verwijder als standaard lay-out',
	'REMOVE_STARTPAGE'							=> 'Verwijder Startpagina',
	'ROUTE_HIDDEN_BLOCKS'						=> 'Blokken voor deze pagina worden verborgen',
	'ROUTE_HIDDEN_POSITIONS'					=> 'Blokken worden verborgen voor de volgende posities',
	'ROUTE_UPDATED'								=> 'Pagina-instellingen succesvol bijgewerkt',

	'SAVE_CHANGES'								=> 'Wijzigingen opslaan',
	'SAVE_SETTINGS'								=> 'Instellingen opslaan',
	'SELECT_ICON'								=> 'Selecteer een icoon',
	'SETTINGS'									=> 'Instellingen',
	'SETTING_TOO_BIG'							=> 'De opgegeven waarde voor de instelling "%1$s" is te hoog. De maximale aanvaardbare waarde is %2$d.',
	'SETTING_TOO_LONG'							=> 'De opgegeven waarde voor instelling "%1$s" is te lang. De maximaal aanvaardbare lengte is %2$d.',
	'SETTING_TOO_LOW'							=> 'De opgegeven waarde voor instelling "%1$s" is te laag. De minimale aanvaardbare waarde is %2$d.',
	'SETTING_TOO_SHORT'							=> 'De opgegeven waarde voor de instelling "%1$s" is te kort. De minimale aanvaardbare lengte is %2$d.',
	'SET_STARTPAGE'								=> 'Instellen als startpagina',

	'TITLES'									=> 'Titels',

	'UPDATE_SIMILAR'							=> 'Update blokken met soortgelijke instellingen',
	'UNDO'										=> 'Herstel',

	'VIEW_DEFAULT_LAYOUT'						=> 'Weergeven/wijzigen standaard lay-out',
	'VISIT_PAGE'								=> 'Bezoek pagina',
));
