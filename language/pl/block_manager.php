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
	'ADD_BLOCK_EXPLAIN'							=> '*Przeciągnij i upuść bloki',
	'AJAX_ERROR'								=> 'Ups! Wystąpił błąd podczas przetwarzania żądania. Spróbuj ponownie.',
	'AJAX_LOADING'								=> 'Wczytywanie...',
	'AJAX_PROCESSING'							=> 'Pracuję...',

	'BACKGROUND'								=> 'Tło',
	'BLOCKS'									=> 'Bloki',
	'BLOCKS_COPY_FROM'							=> 'Kopiuj bloki',
	'BLOCK_ACTIVE'								=> 'Aktywny',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Pokaż tylko na podrzędnych trasach',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Ukryj na podrzędnych trasach',
	'BLOCK_CLASS'								=> 'Klasa CSS',
	'BLOCK_CLASS_EXPLAIN'						=> 'Modyfikuj wygląd bloku za pomocą klas CSS',
	'BLOCK_DESIGN'								=> 'Wygląd',
	'BLOCK_DISPLAY_TYPE'						=> 'Wyświetlanie',
	'BLOCK_HIDE_TITLE'							=> 'Ukryj tytuł bloku?',
	'BLOCK_INACTIVE'							=> 'Nieaktywne',
	'BLOCK_MISSING_TEMPLATE'					=> 'Missing required block template. Please contact developer',
	'BLOCK_NOT_FOUND'							=> 'Ups! Żądana usługa blokowa nie została znaleziona',
	'BLOCK_NO_DATA'								=> 'Brak danych do wyświetlenia',
	'BLOCK_NO_ID'								=> 'Ups! Brakujący id bloku',
	'BLOCK_PERMISSION'							=> 'Permission',
	'BLOCK_PERMISSION_ALLOW'					=> 'Show to',
	'BLOCK_PERMISSION_DENY'						=> 'Hide from',
	'BLOCK_PERMISSION_EXPLAIN'					=> 'Use CTRL + click to toggle selection',
	'BLOCK_SHOW_ALWAYS'							=> 'Zawsze',
	'BLOCK_STATUS'								=> 'Status',
	'BLOCK_UPDATED'								=> 'Ustawienia bloku pomyślnie zaktualizowane',

	'CANCEL'									=> 'Anuluj',
	'CHILD_ROUTE'								=> 'Dziecko',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/moja artykuł',
	'CLEAR'										=> 'Wyczyść',
	'COPY'										=> 'Kopiuj',
	'COPY_BLOCKS'								=> 'Skopiować bloki?',
	'COPY_BLOCKS_CONFIRM'						=> 'Czy na pewno chcesz skopiować bloki z innej strony?<br /><br />Spowoduje to usunięcie wszystkich istniejących bloków i ich ustawień dla tej strony i zastąpi je blokami z wybranej strony.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'Jeśli ustawione, wszystkie strony witryny, dla których nie określiłeś bloków, odziedziczą bloki z domyślnego układu. Możesz jednak zastąpić domyślny układ dla poszczególnych stron używając opcji po prawej stronie.',
	'DELETE'									=> 'Usuń',
	'DELETE_ALL_BLOCKS'							=> 'Usuń wszystkie bloki',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'Czy na pewno chcesz usunąć wszystkie bloki dla tej strony?',
	'DELETE_BLOCK'								=> 'Usuń blok',
	'DELETE_BLOCK_CONFIRM'						=> 'Czy na pewno chcesz usunąć ten blok?<br /><br /><br /><strong>Uwaga:</strong> Będziesz musiał zapisać zmiany układu aby uczynić to stałe.',

	'EDIT'										=> 'Edytuj',
	'EDIT_BLOCK'								=> 'Edytuj blok',
	'EXIT_EDIT_MODE'							=> 'Wyjdź z trybu edycji',

	'FEED_PROBLEMS'								=> 'Wystąpił błąd podczas przetwarzania podanych kanałów rss/atom',
	'FEED_URL_MISSING'							=> 'Proszę podać co najmniej jeden kanał rss/atom na początek',
	'FIELD_INVALID'								=> 'Podana wartość dla pola „%s” ma nieprawidłowy format',
	'FIELD_REQUIRED'							=> '„%s” jest wymaganym polem',
	'FIELD_TOO_LONG'							=> 'Podana wartość dla pola „%1$s” jest za długa. Maksymalna dopuszczalna wartość to %2$d.',
	'FIELD_TOO_SHORT'							=> 'Podana wartość dla pola „%1$s” jest za krótka. Minimalna dopuszczalna wartość to %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'Nie pokazuj bloków na tej stronie',
	'HIDE_BLOCK_POSITIONS'						=> 'Nie pokazuj bloków dla następujących pozycji bloku:',

	'IMAGES'									=> 'Obrazy',

	'LAYOUT'									=> 'Układ',
	'LAYOUT_SAVED'								=> 'Układ zapisany pomyślnie!',
	'LAYOUT_SETTINGS'							=> 'Ustawienia układu',
	'LEAVE_CONFIRM'								=> 'Masz niezapisane zmiany na tej stronie. Proszę zapisać swoją pracę przed przeniesieniem',
	'LISTS'										=> 'Listy',

	'MAKE_DEFAULT_LAYOUT'						=> 'Ustaw jako domyślny układ',

	'OR'										=> '<strong>LUB</strong>',

	'PARENT_ROUTE'								=> 'Nadrzędny',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/articles',
	'PREDEFINED_CLASSES'						=> 'Wstępnie zdefiniowane klasy',

	'REDO'										=> 'Powtórz',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Usuń jako domyślny układ',
	'REMOVE_STARTPAGE'							=> 'Usuń stronę początkową',
	'ROUTE_HIDDEN_BLOCKS'						=> 'Bloki są ukryte dla tej strony',
	'ROUTE_HIDDEN_POSITIONS'					=> 'Bloki są ukryte dla następujących pozycji',
	'ROUTE_UPDATED'								=> 'Ustawienia strony pomyślnie zaktualizowane',

	'SAVE_CHANGES'								=> 'Zapisz zmiany',
	'SAVE_SETTINGS'								=> 'Zapisz ustawienia',
	'SELECT_ICON'								=> 'Wybierz ikonę',
	'SETTINGS'									=> 'Ustawienia',
	'SETTING_TOO_BIG'							=> 'Podana wartość dla ustawienia "%1$s" jest zbyt wysoka. Maksymalna dopuszczalna wartość to %2$d.',
	'SETTING_TOO_LONG'							=> 'Podana wartość dla ustawienia "%1$s" jest za długa. Maksymalna dopuszczalna długość to %2$d.',
	'SETTING_TOO_LOW'							=> 'Podana wartość dla ustawienia "%1$s" jest zbyt niska. Minimalna dopuszczalna wartość to %2$d.',
	'SETTING_TOO_SHORT'							=> 'Podana wartość dla ustawienia "%1$s" jest za krótka. Minimalna dopuszczalna długość to %2$d.',
	'SET_STARTPAGE'								=> 'Ustaw jako stronę początkową',

	'TITLES'									=> 'Tytuły',

	'UPDATE_SIMILAR'							=> 'Aktualizuj bloki z podobnymi ustawieniami',
	'UNDO'										=> 'Cofnij',

	'VIEW_DEFAULT_LAYOUT'						=> 'Widok/Edytuj domyślny układ',
	'VISIT_PAGE'								=> 'Odwiedź stronę',
));
