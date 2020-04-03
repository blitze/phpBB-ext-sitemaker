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
    'ACP_SM_SETTINGS' => 'Настройки',

    'BLOCKS_CLEANUP' => 'Очистка блоков',
    'BLOCKS_CLEANUP_EXPLAIN' => 'Следующие элементы были найдены не существующими или недоступными, и вы можете удалить все блоки, связанные с ними. Пожалуйста, имейте в виду, что некоторые из них могут быть ложными',
    'BLOCKS_CLEANUP_BLOCKS' => 'Недопустимые блоки (например, из удаленных расширений):',
    'BLOCKS_CLEANUP_ROUTES' => 'Недоступные/поврежденные страницы:',
    'BLOCKS_CLEANUP_STYLES' => 'Удаленные Стили (ids):',
    'BLOCKS_CLEANUP_SUCCESS' => 'Блоки очищены успешно',

    'FILEMANAGER_SETTINGS' => 'Настройки файлового менеджера',
    'FILEMANAGER_STATUS' => 'Статус',
    'FILEMANAGER_NO_EXIST' => 'You will need to install the File Manager before you can enable it. Installation instructions are found <a href="%s" target="_blank"  rel="noopener noreferrer"><strong>here</strong></a>',
    'FILEMENAGER_NOT_WRITABLE' => 'Filemanager config folder (root/ResponsiveFilemanager/filemanager/config/) is not writable. Please change the permissions to writable by all (777 or -rwxrwxrwx within your FTP Client)',
    'FILEMANAGER_IMAGE_AUTO_RESIZE' => 'Автоматически изменять размер загруженных изображений?',
    'FILEMANAGER_IMAGE_AUTO_RESIZE_DIMENSIONS' => 'Изменить размер до заданных размеров',
    'FILEMANAGER_IMAGE_AUTO_RESIZING_MODE' => 'Авто изменение размера',
    'FILEMANAGER_IMAGE_MAX_DIMENSIONS' => 'Макс. размер изображения',
    'FILEMANAGER_IMAGE_MAX_MODE' => 'Макс. размер изображения',
    'FILEMANAGER_IMAGE_MODE_EXPLAIN' => 'Используется для вычисления высоты/ширины, если вы только обеспечиваете высоту или ширину, но не обе выше',
    'FILEMANAGER_IMAGE_MODE_AUTO' => 'Авто',
    'FILEMANAGER_IMAGE_MODE_CROP' => 'Обрезка',
    'FILEMANAGER_IMAGE_MODE_EXACT' => 'Точно',
    'FILEMANAGER_IMAGE_MODE_LANDSCAPE' => 'Ландшафт',
    'FILEMANAGER_IMAGE_MODE_PORTRAIT' => 'Портретный',
    'FILEMANAGER_WATERMARK' => 'Водяной знак',
    'FILEMANAGER_WATERMARK_EXPLAIN' => 'URL изображения для использования в качестве водяного знака на всех загруженных изображениях',
    'FILEMANAGER_WATERMARK_POSITION' => 'Положение водяного знака',
    'FILEMANAGER_WATERMARK_POSITION_EXPLAIN' => 'Выберите место, где должен появиться водяной знак, или введите координаты, например 50x100',
    'FILEMANAGER_WATERMARK_POSITION_TL' => 'Сверху слева',
    'FILEMANAGER_WATERMARK_POSITION_T' => 'Вверх',
    'FILEMANAGER_WATERMARK_POSITION_TR' => 'Вверху справа',
    'FILEMANAGER_WATERMARK_POSITION_L' => 'Влево',
    'FILEMANAGER_WATERMARK_POSITION_M' => 'Средний',
    'FILEMANAGER_WATERMARK_POSITION_R' => 'Правый',
    'FILEMANAGER_WATERMARK_POSITION_BL' => 'Внизу слева',
    'FILEMANAGER_WATERMARK_POSITION_B' => 'Нижний',
    'FILEMANAGER_WATERMARK_POSITION_BR' => 'Снизу справа',
    'FILEMANAGER_WATERMARK_POSITION_SUFFIX' => 'или',
    'FILEMANAGER_WATERMARK_PADDING' => 'Отступ от водяного знака',
    'FILEMANAGER_WATERMARK_PADDING_EXPLAIN' => 'Если используется предопределенная позиция, вы можете настроить отступ из краев. Если использовать координаты, это значение игнорируется',

    'FORUM_INDEX_SETTINGS' => 'Настройки индекса форума',
    'FORUM_INDEX_SETTINGS_EXPLAIN' => 'Эти настройки применяются только в том случае, когда начальная страница не определена',

    'HIDE' => 'Скрыть',
    'HIDE_BIRTHDAY' => 'Скрыть раздел «День рождения»',
    'HIDE_LOGIN' => 'Скрыть окно входа',
    'HIDE_ONLINE' => 'Скрыть секцию онлайн',

    'LAYOUT_BLOG' => 'Блог',
    'LAYOUT_CUSTOM' => 'Другое',
    'LAYOUT_HOLYGRAIL' => 'Святой Грааль',
    'LAYOUT_PORTAL' => 'Портал',
    'LAYOUT_PORTAL_ALT' => 'Портал (alt)',
    'LAYOUT_SETTINGS' => 'Настройки макета',

    'LOG_DELETED_BLOCKS_FOR_STYLE' => 'Блоки Sitemaker удалены для отсутствующих стилей с id %s',
    'LOG_DELETED_BLOCKS_FOR_ROUTE' => 'Блоки Sitemaker удалены для сломанных страниц:<br />%s',
    'LOG_DELETED_BLOCKS' => 'Некорректные блоки сайта удалены:<br />%s',

    'NAVIGATION_SETTINGS' => 'Настройки навигации',
    'NO_NAVBAR' => 'Никто не воздержался',

    'SELECT_NAVBAR_MENU' => 'Выберите главное меню навигации',
    'SETTINGS_SAVED' => 'Ваши настройки сохранены',
    'SHOW' => 'Показать',
    'SHOW_FORUM_NAV' => 'Показывать «Форум» в панели навигации?',
    'SHOW_FORUM_NAV_EXPLAIN' => 'Когда страница установлена как стартовая страница вместо индекса форума, мы должны показывать «Форум» в панели навигации',
    'SHOW_FORUM_NAV_WITH_ICON' => 'Да - со значком:',
]);
