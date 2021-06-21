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
	'ADD_BLOCK_EXPLAIN'							=> '*Přetáhni a pusť bloky',
	'AJAX_ERROR'								=> 'Jejda! Došlo k chybě při zpracování vašeho požadavku. Prosím, zkuste to znovu.',
	'AJAX_LOADING'								=> 'Nahrávám...',
	'AJAX_PROCESSING'							=> 'Zpracovávám...',

	'BACKGROUND'								=> 'Pozadí',
	'BLOCKS'									=> 'Bloky',
	'BLOCKS_COPY_FROM'							=> 'Kopírovat bloky',
	'BLOCK_ACTIVE'								=> 'Aktivní',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Zobrazit pouze na podřízených trasách',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Skrýt na podřízených trasách',
	'BLOCK_CLASS'								=> 'CSS třída',
	'BLOCK_CLASS_EXPLAIN'						=> 'Upravit vzhled bloku pomocí CSS tříd',
	'BLOCK_DESIGN'								=> 'Vzhled',
	'BLOCK_DISPLAY_TYPE'						=> 'Displej',
	'BLOCK_HIDE_TITLE'							=> 'Skrýt název bloku?',
	'BLOCK_INACTIVE'							=> 'Neaktivní',
	'BLOCK_MISSING_TEMPLATE'					=> 'Chybí požadovaná šablona bloku. Kontaktujte prosím vývojáře',
	'BLOCK_NOT_FOUND'							=> 'Jejda! Požadovaná služba nebyla nalezena',
	'BLOCK_NO_DATA'								=> 'Žádná data k zobrazení',
	'BLOCK_NO_ID'								=> 'Jejda! Chybí id bloku',
	'BLOCK_PERMISSION'							=> 'Právo',
	'BLOCK_PERMISSION_ALLOW'					=> 'Zobrazit do',
	'BLOCK_PERMISSION_DENY'						=> 'Skrýt z',
	'BLOCK_PERMISSION_EXPLAIN'					=> 'Použít CTRL + kliknutí pro přepnutí výběru',
	'BLOCK_SHOW_ALWAYS'							=> 'Vždy',
	'BLOCK_STATUS'								=> 'Stav',
	'BLOCK_UPDATED'								=> 'Nastavení bloku bylo úspěšně aktualizováno',

	'CANCEL'									=> 'Zrušit',
	'CHILD_ROUTE'								=> 'Potomek',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/my-article',
	'CLEAR'										=> 'Vyčistit',
	'COPY'										=> 'Kopírovat',
	'COPY_BLOCKS'								=> 'Kopírovat bloky?',
	'COPY_BLOCKS_CONFIRM'						=> 'Jste si jisti, že chcete kopírovat bloky z jiné stránky?<br /><br />Tímto odstraníte všechny existující bloky a jejich nastavení pro tuto stránku a nahradíte je bloky z vybrané stránky.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'Pokud je nastaveno, všechny stránky stránek, pro které nemáte zadané bloky, zdědí bloky z výchozího rozložení. Můžete však přepsat výchozí vzhled pro konkrétní stránky pomocí volby vpravo.',
	'DELETE'									=> 'Odstranit',
	'DELETE_ALL_BLOCKS'							=> 'Odstranit všechny bloky',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'Jste si jisti, že chcete odstranit všechny bloky pro tuto stránku?',
	'DELETE_BLOCK'								=> 'Odstranit blok',
	'DELETE_BLOCK_CONFIRM'						=> 'Jste si jisti, že chcete odstranit tento blok?<br /><br /><br /><strong>Poznámka:</strong> budete muset uložit změny rozvržení, aby byla tato trvalá',

	'EDIT'										=> 'Upravit',
	'EDIT_BLOCK'								=> 'Upravit blok',
	'EXIT_EDIT_MODE'							=> 'Ukončit režim úprav',

	'FEED_PROBLEMS'								=> 'Při zpracování poskytnutých Rss/atomů došlo k potížím',
	'FEED_URL_MISSING'							=> 'Zadejte pro začátek alespoň jeden zdroj rss/atom',
	'FIELD_INVALID'								=> 'Zadaná hodnota pro pole “%smá neplatný formát',
	'FIELD_REQUIRED'							=> 'Pole „%s“ je povinné',
	'FIELD_TOO_LONG'							=> 'Zadaná hodnota pro pole "%1$sje příliš dlouhá. Maximální přijatelná hodnota je %2$d.',
	'FIELD_TOO_SHORT'							=> 'Zadaná hodnota pro pole “%1$sje příliš krátká. Minimální přijatelná hodnota je %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'Nezobrazovat bloky na této stránce',
	'HIDE_BLOCK_POSITIONS'						=> 'Nezobrazovat bloky pro následující pozice:',

	'IMAGES'									=> 'Obrázky',

	'LAYOUT'									=> 'Rozvržení',
	'LAYOUT_SAVED'								=> 'Rozložení bylo úspěšně uloženo!',
	'LAYOUT_SETTINGS'							=> 'Nastavení rozvržení',
	'LEAVE_CONFIRM'								=> 'Na této stránce máte nějaké neuložené změny. Prosím, uložte své dílo před tím, než přejdete na jinou stránku.',
	'LISTS'										=> 'Seznam',

	'MAKE_DEFAULT_LAYOUT'						=> 'Nastavit jako výchozí rozložení',

	'OR'										=> '<strong>NEBO</strong>',

	'PARENT_ROUTE'								=> 'Nadřazený',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/articles',
	'PREDEFINED_CLASSES'						=> 'Předdefinované třídy',

	'REDO'										=> 'Opakovat',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Odstranit výchozí rozložení',
	'REMOVE_STARTPAGE'							=> 'Odebrat úvodní stránku',
	'ROUTE_HIDDEN_BLOCKS'						=> 'Bloky jsou pro tuto stránku skryty',
	'ROUTE_HIDDEN_POSITIONS'					=> 'Bloky jsou skryty pro následující pozice',
	'ROUTE_UPDATED'								=> 'Nastavení stránky bylo úspěšně aktualizováno',

	'SAVE_CHANGES'								=> 'Uložit změny',
	'SAVE_SETTINGS'								=> 'Uložit nastavení',
	'SELECT_ICON'								=> 'Vyberte ikonu',
	'SETTINGS'									=> 'Nastavení',
	'SETTING_TOO_BIG'							=> 'Zadaná hodnota pro nastavení “%1$sje příliš vysoká. Maximální přijatelná hodnota je %2$d.',
	'SETTING_TOO_LONG'							=> 'Zadaná hodnota pro nastavení “%1$sje příliš dlouhá. Maximální přijatelná délka je %2$d.',
	'SETTING_TOO_LOW'							=> 'Zadaná hodnota pro nastavení “%1$sje příliš nízká. Minimální přijatelná hodnota je %2$d.',
	'SETTING_TOO_SHORT'							=> 'Zadaná hodnota pro nastavení “%1$sje příliš krátká. Minimální přijatelná délka je %2$d.',
	'SET_STARTPAGE'								=> 'Nastavit jako úvodní stránku',

	'TITLES'									=> 'Titulky',

	'UPDATE_SIMILAR'							=> 'Aktualizovat bloky s podobným nastavením',
	'UNDO'										=> 'Vrátit zpět',

	'VIEW_DEFAULT_LAYOUT'						=> 'Zobrazit/upravit výchozí rozložení',
	'VISIT_PAGE'								=> 'Návštěva stránky',
));
