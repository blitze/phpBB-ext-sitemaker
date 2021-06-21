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
	'ADD_BLOCK_EXPLAIN'							=> '*Dra och släpp block',
	'AJAX_ERROR'								=> 'Hoppsan! Det gick inte att behandla din begäran. Försök igen.',
	'AJAX_LOADING'								=> 'Laddar...',
	'AJAX_PROCESSING'							=> 'Arbetar...',

	'BACKGROUND'								=> 'Bakgrund',
	'BLOCKS'									=> 'Block',
	'BLOCKS_COPY_FROM'							=> 'Kopiera block',
	'BLOCK_ACTIVE'								=> 'Aktiv',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Visa endast på underordnade rutter',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Dölj på underordnade rutter',
	'BLOCK_CLASS'								=> 'CSS klass',
	'BLOCK_CLASS_EXPLAIN'						=> 'Ändra blockets utseende med CSS-klasser',
	'BLOCK_DESIGN'								=> 'Utseende',
	'BLOCK_DISPLAY_TYPE'						=> 'Visa',
	'BLOCK_HIDE_TITLE'							=> 'Dölj blocktitel?',
	'BLOCK_INACTIVE'							=> 'Inaktiv',
	'BLOCK_MISSING_TEMPLATE'					=> 'Saknar obligatorisk blockmall. Kontakta utvecklaren',
	'BLOCK_NOT_FOUND'							=> 'Hoppsan! Den begärda blocktjänsten kunde inte hittas',
	'BLOCK_NO_DATA'								=> 'Ingen data att visa',
	'BLOCK_NO_ID'								=> 'Hoppsan! Block-id saknas',
	'BLOCK_PERMISSION'							=> 'Behörighet',
	'BLOCK_PERMISSION_ALLOW'					=> 'Visa för',
	'BLOCK_PERMISSION_DENY'						=> 'Dölj från',
	'BLOCK_PERMISSION_EXPLAIN'					=> 'Använd CTRL + klicka för att växla markering',
	'BLOCK_SHOW_ALWAYS'							=> 'Alltid',
	'BLOCK_STATUS'								=> 'Status',
	'BLOCK_UPDATED'								=> 'Blockinställningar har uppdaterats',

	'CANCEL'									=> 'Avbryt',
	'CHILD_ROUTE'								=> 'Barn',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/my-article',
	'CLEAR'										=> 'Rensa',
	'COPY'										=> 'Kopiera',
	'COPY_BLOCKS'								=> 'Kopiera block?',
	'COPY_BLOCKS_CONFIRM'						=> 'Är du säker på att du vill kopiera block från en annan sida?<br /><br />Detta kommer att ta bort alla befintliga block och deras inställningar för denna sida och ersätta dem med blocken från den valda sidan.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'Om angiven kommer alla webbplatssidor som du inte har angett att ärva blocken från standardlayouten. Du kan dock åsidosätta standardlayouten för vissa sidor med hjälp av alternativen till höger.',
	'DELETE'									=> 'Radera',
	'DELETE_ALL_BLOCKS'							=> 'Ta bort alla block',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'Är du säker på att du vill ta bort alla block för den här sidan?',
	'DELETE_BLOCK'								=> 'Ta bort block',
	'DELETE_BLOCK_CONFIRM'						=> 'Är du säker på att du vill ta bort detta block?<br /><br /><br /><strong>Obs:</strong> Du måste spara layoutändringarna för att göra detta permanent.',

	'EDIT'										=> 'Redigera',
	'EDIT_BLOCK'								=> 'Redigera block',
	'EXIT_EDIT_MODE'							=> 'Avsluta redigeringsläge',

	'FEED_PROBLEMS'								=> 'Det gick inte att bearbeta den angivna rss/atom feed(en)',
	'FEED_URL_MISSING'							=> 'Ange minst ett rss/atom flöde för att börja',
	'FIELD_INVALID'								=> 'Det angivna värdet för fältet ”%s” har ett ogiltigt format',
	'FIELD_REQUIRED'							=> '“%s” är ett obligatoriskt fält',
	'FIELD_TOO_LONG'							=> 'Det angivna värdet för fältet ”%1$s” är för långt. Det maximala godtagbara värdet är %2$d.',
	'FIELD_TOO_SHORT'							=> 'Det angivna värdet för fältet ”%1$s” är för kort. Det minsta acceptabla värdet är %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'Visa inte block på denna sida',
	'HIDE_BLOCK_POSITIONS'						=> 'Visa inte block för följande blockpositioner:',

	'IMAGES'									=> 'Bilder',

	'LAYOUT'									=> 'Layout',
	'LAYOUT_SAVED'								=> 'Layout sparad!',
	'LAYOUT_SETTINGS'							=> 'Inställningar för layout',
	'LEAVE_CONFIRM'								=> 'Du har några osparade ändringar på denna sida. Spara ditt arbete innan du går vidare',
	'LISTS'										=> 'Listor',

	'MAKE_DEFAULT_LAYOUT'						=> 'Ange som standardlayout',

	'OR'										=> '<strong>ELLER</strong>',

	'PARENT_ROUTE'								=> 'Överordnad',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/articles',
	'PREDEFINED_CLASSES'						=> 'Fördefinierade klasser',

	'REDO'										=> 'Gör om',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Ta bort som standardlayout',
	'REMOVE_STARTPAGE'							=> 'Ta bort startsida',
	'ROUTE_HIDDEN_BLOCKS'						=> 'Blocken döljs för denna sida',
	'ROUTE_HIDDEN_POSITIONS'					=> 'Blocken döljs för följande positioner',
	'ROUTE_UPDATED'								=> 'Sidinställningarna har uppdaterats',

	'SAVE_CHANGES'								=> 'Spara ändringar',
	'SAVE_SETTINGS'								=> 'Spara inställningar',
	'SELECT_ICON'								=> 'Välj en ikon',
	'SETTINGS'									=> 'Inställningar',
	'SETTING_TOO_BIG'							=> 'Det angivna värdet för inställningen ”%1$s” är för högt. Det maximala godtagbara värdet är %2$d.',
	'SETTING_TOO_LONG'							=> 'Det angivna värdet för inställningen ”%1$s” är för lång. Maximal acceptabel längd är %2$d.',
	'SETTING_TOO_LOW'							=> 'Det angivna värdet för inställningen ”%1$s” är för lågt. Det minsta acceptabla värdet är %2$d.',
	'SETTING_TOO_SHORT'							=> 'Det angivna värdet för inställningen ”%1$s” är för kort. Minsta tillåtna längd är %2$d.',
	'SET_STARTPAGE'								=> 'Ställ in som startsida',

	'TITLES'									=> 'Titlar',

	'UPDATE_SIMILAR'							=> 'Uppdatera block med liknande inställningar',
	'UNDO'										=> 'Ångra',

	'VIEW_DEFAULT_LAYOUT'						=> 'Visa/Ändra standardlayout',
	'VISIT_PAGE'								=> 'Besök sida',
));
