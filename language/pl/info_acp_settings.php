<?php

/**
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

/**
 * @ignore
 */
if (!defined('IN_PHPBB')) {
    exit;
}

if (empty($lang) || !is_array($lang)) {
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
    'ACP_SITEMAKER' => 'SiteMaker',
    'ACP_SM_SETTINGS' => 'Ustawienia',

    'BLOCKS_CLEANUP' => 'Oczyszczanie bloków',
    'BLOCKS_CLEANUP_EXPLAIN' => 'Następujące elementy zostały uznane za nieistniejące lub nieosiągalne, dlatego możesz usunąć wszystkie związane z nimi bloki. Należy pamiętać, że niektóre z nich mogą być fałszywie dodatnie',
    'BLOCKS_CLEANUP_BLOCKS' => 'Nieprawidłowe bloki (np. z odinstalowanych rozszerzeń):',
    'BLOCKS_CLEANUP_ROUTES' => 'Nieosiągalne/uszkodzone strony:',
    'BLOCKS_CLEANUP_STYLES' => 'Odinstalowane style (ids):',
    'BLOCKS_CLEANUP_SUCCESS' => 'Pomyślnie wyczyszczono bloki',

    'FILEMANAGER_SETTINGS' => 'Ustawienia Menedżera Plików',
    'FILEMANAGER_STATUS' => 'Status',
    'FILEMANAGER_NO_EXIST' => 'You will need to install the File Manager before you can enable it. Installation instructions are found <a href="%s" target="_blank"  rel="noopener noreferrer"><strong>here</strong></a>',
    'FILEMENAGER_NOT_WRITABLE' => 'Filemanager config folder (root/ResponsiveFilemanager/filemanager/config/) is not writable. Please change the permissions to writable by all (777 or -rwxrwxrwx within your FTP Client)',
    'FILEMANAGER_IMAGE_AUTO_RESIZE' => 'Automatycznie zmienić rozmiar przesłanych zdjęć?',
    'FILEMANAGER_IMAGE_AUTO_RESIZE_DIMENSIONS' => 'Zmień rozmiar do określonych wymiarów',
    'FILEMANAGER_IMAGE_AUTO_RESIZING_MODE' => 'Tryb automatycznej zmiany rozmiaru',
    'FILEMANAGER_IMAGE_MAX_DIMENSIONS' => 'Maksymalny rozmiar obrazu',
    'FILEMANAGER_IMAGE_MAX_MODE' => 'Tryb maksymalnej wielkości obrazu',
    'FILEMANAGER_IMAGE_MODE_EXPLAIN' => 'Używane do obliczania wysokości/szerokości, jeśli podasz tylko wysokość lub szerokość, ale nie obie powyżej',
    'FILEMANAGER_IMAGE_MODE_AUTO' => 'Automatyczne',
    'FILEMANAGER_IMAGE_MODE_CROP' => 'Przytnij',
    'FILEMANAGER_IMAGE_MODE_EXACT' => 'Dokładny',
    'FILEMANAGER_IMAGE_MODE_LANDSCAPE' => 'Poziomy',
    'FILEMANAGER_IMAGE_MODE_PORTRAIT' => 'Portret',
    'FILEMANAGER_WATERMARK' => 'Znak wodny',
    'FILEMANAGER_WATERMARK_EXPLAIN' => 'Adres URL obrazka do użycia jako znak wodny na wszystkich przesłanych zdjęciach',
    'FILEMANAGER_WATERMARK_POSITION' => 'Pozycja znaku wodnego',
    'FILEMANAGER_WATERMARK_POSITION_EXPLAIN' => 'Wybierz z góry określoną pozycję, gdzie powinien pojawić się znak wodny lub wprowadź współrzędne, np. 50x100',
    'FILEMANAGER_WATERMARK_POSITION_TL' => 'Lewy górny róg',
    'FILEMANAGER_WATERMARK_POSITION_T' => 'Góra',
    'FILEMANAGER_WATERMARK_POSITION_TR' => 'Górny prawy',
    'FILEMANAGER_WATERMARK_POSITION_L' => 'Lewy',
    'FILEMANAGER_WATERMARK_POSITION_M' => 'Środkowy',
    'FILEMANAGER_WATERMARK_POSITION_R' => 'Prawy',
    'FILEMANAGER_WATERMARK_POSITION_BL' => 'Lewy dolny róg',
    'FILEMANAGER_WATERMARK_POSITION_B' => 'Dół',
    'FILEMANAGER_WATERMARK_POSITION_BR' => 'Prawo dolne',
    'FILEMANAGER_WATERMARK_POSITION_SUFFIX' => 'lub',
    'FILEMANAGER_WATERMARK_PADDING' => 'Wypełnienie znaku wodnego',
    'FILEMANAGER_WATERMARK_PADDING_EXPLAIN' => 'Jeśli używasz z góry określonej pozycji, możesz dostosować dopełnienie z krawędzi. Jeśli używasz współrzędnych, ta wartość jest ignorowana',

    'FORUM_INDEX_SETTINGS' => 'Ustawienia indeksu forum',
    'FORUM_INDEX_SETTINGS_EXPLAIN' => 'Te ustawienia mają zastosowanie tylko wtedy, gdy nie ma zdefiniowanej strony startowej',

    'HIDE' => 'Ukryj',
    'HIDE_BIRTHDAY' => 'Ukryj sekcję urodzin',
    'HIDE_LOGIN' => 'Ukryj pole logowania',
    'HIDE_ONLINE' => 'Ukryj sekcję online',

    'LAYOUT_BLOG' => 'Blog',
    'LAYOUT_CUSTOM' => 'Własny',
    'LAYOUT_HOLYGRAIL' => 'Święta Grail',
    'LAYOUT_PORTAL' => 'Portal',
    'LAYOUT_PORTAL_ALT' => 'Portal (alt)',
    'LAYOUT_SETTINGS' => 'Ustawienia układu',

    'LOG_DELETED_BLOCKS_FOR_STYLE' => 'Bloki Sitemaker usunięte za brakujący styl o id %s',
    'LOG_DELETED_BLOCKS_FOR_ROUTE' => 'Bloki Sitemaker usunięte dla uszkodzonych stron:<br />%s',
    'LOG_DELETED_BLOCKS' => 'Usunięto nieprawidłowe bloki Sitemakera:<br />%s',

    'NAVIGATION_SETTINGS' => 'Ustawienia nawigacji',
    'NO_NAVBAR' => 'Brak',

    'SELECT_NAVBAR_MENU' => 'Wybierz menu nawigacji',
    'SETTINGS_SAVED' => 'Twoje ustawienia zostały zapisane',
    'SHOW' => 'Pokaż',
    'SHOW_FORUM_NAV' => 'Pokazać "Forum" na pasku nawigacyjnym?',
    'SHOW_FORUM_NAV_EXPLAIN' => 'Kiedy strona jest ustawiona jako strona startowa zamiast indeksu forum, powinniśmy wyświetlić \'Forum\' na pasku nawigacji',
    'SHOW_FORUM_NAV_WITH_ICON' => 'Tak - z ikoną:',
]);
