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
	'ADD_BLOCK_EXPLAIN'							=> '*Перетащите блоки и расположите в требуемой позиции',
	'AJAX_ERROR'								=> 'Произошла ошибка в процессе обработки вашего запроса. Пожалуйста, попробуйте еще раз.',
	'AJAX_LOADING'								=> 'Загрузка',
	'AJAX_PROCESSING'							=> 'Обработка...',

	'BACKGROUND'								=> 'Фон',
	'BLOCKS'									=> 'Блоки',
	'BLOCKS_COPY_FROM'							=> 'Копировать блоки',
	'BLOCK_ACTIVE'								=> 'Активный',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Только на дочерних страницах',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Скрыть на дочерних страницах',
	'BLOCK_CLASS'								=> 'Класс CSS',
	'BLOCK_CLASS_EXPLAIN'						=> 'Изменить внешний вид блока с помощью классов CSS',
	'BLOCK_DESIGN'								=> 'Оформление',
	'BLOCK_DISPLAY_TYPE'						=> 'Показывать',
	'BLOCK_HIDE_TITLE'							=> 'Скрыть заголовок блока?',
	'BLOCK_INACTIVE'							=> 'Скрытый',
	'BLOCK_NOT_FOUND'							=> 'Запрошенная служба блокировки не найдена',
	'BLOCK_NO_DATA'								=> 'Отсутствуют данные для отображения',
	'BLOCK_NO_ID'								=> 'Идентификатор блока отсутствует',
	'BLOCK_PERMISSION'							=> 'Отображается группам',
	'BLOCK_SHOW_ALWAYS'							=> 'Всегда',
	'BLOCK_STATUS'								=> 'Статус',
	'BLOCK_UPDATED'								=> 'Настройки блока успешно обновлены',

	'CANCEL'									=> 'Отменить',
	'CHILD_ROUTE'								=> 'Зависимые',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/my-article',
	'CLEAR'										=> 'Очистить',
	'COPY'										=> 'Копировать',
	'COPY_BLOCKS'								=> 'Копировать блоки?',
	'COPY_BLOCKS_CONFIRM'						=> 'Вы уверены, что хотите скопировать блоки с другой страницы? <br /> <br /> Это удалит все существующие блоки и их настройки для этой страницы и заменит их на блоки с выбранной страницы.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'Если установлено, все страницы сайта, для которых вы не указали блоки, будут наследовать блоки из макета по умолчанию. Однако вы можете переопределить макет по умолчанию для определенных страниц, используя параметры справа.',
	'DELETE'									=> 'Удалить',
	'DELETE_ALL_BLOCKS'							=> 'Удалить все блоки',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'Вы уверены, что хотите удалить все блоки для этой страницы?',
	'DELETE_BLOCK'								=> 'Удалить блок',
	'DELETE_BLOCK_CONFIRM'						=> 'Вы уверены, что хотите удалить этот блок? <br /><br /><br /><strong>Note:</strong> Необходимо сохранить изменения в макете.',

	'EDIT'										=> 'Редактировать',
	'EDIT_BLOCK'								=> 'Редактировать блок',
	'EXIT_EDIT_MODE'							=> 'Выйти из режима редактирования',

	'FEED_PROBLEMS'								=> 'Возникла проблема при обработке каналов rss/atom',
	'FEED_URL_MISSING'							=> 'Укажите хотя бы один канал rss/atom',
	'FIELD_INVALID'								=> 'Предоставленное значение для поля “%s” имеет неверный формат',
	'FIELD_REQUIRED'							=> 'Поле “%s” является обязательным',
	'FIELD_TOO_LONG'							=> 'Значение поля “%1$s” слишком длинное. Максимально допустимое значение %2$d.',
	'FIELD_TOO_SHORT'							=> 'Значение поля “%1$s” слишком короткое. Минимально допустимое значение %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'Не показывать блоки на этой странице',
	'HIDE_BLOCK_POSITIONS'						=> 'Не показывать блоки для следующих позиций блоков:',

	'IMAGES'									=> 'Изображения',

	'LAYOUT'									=> 'Макет',
	'LAYOUT_SAVED'								=> 'Макет успешно сохранен!',
	'LAYOUT_SETTINGS'							=> 'Настройки макета',
	'LEAVE_CONFIRM'								=> 'У вас есть несохраненные изменения на этой странице. Пожалуйста, сохраните изменения перед продолжением',
	'LISTS'										=> 'Списки',

	'MAKE_DEFAULT_LAYOUT'						=> 'Установить как макет по умолчанию',

	'OR'										=> '<strong>ИЛИ</strong>',

	'PARENT_ROUTE'								=> 'Главные',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/статьи',
	'PREDEFINED_CLASSES'						=> 'Предопределенные классы',

	'REDO'										=> 'Вернуть',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Отменть макет по умолчанию',
	'REMOVE_STARTPAGE'							=> 'Отменить стартовую страницу',
	'ROUTE_HIDDEN_BLOCKS'						=> 'Блоки скрыты для этой страницы',
	'ROUTE_HIDDEN_POSITIONS'					=> 'Блоки скрыты для следующих позиций',
	'ROUTE_UPDATED'								=> 'Настройки страницы успешно обновлены',

	'SAVE_CHANGES'								=> 'Сохранить изменения',
	'SAVE_SETTINGS'								=> 'Сохранить настройки',
	'SELECT_ICON'								=> 'Выберите иконку',
	'SETTINGS'									=> 'Настройки',
	'SETTING_TOO_BIG'							=> 'Значение поля “%1$s” слишком большое. Максимальное значение %2$d.',
	'SETTING_TOO_LONG'							=> 'Значение поля “%1$s” слишком длинное. Максимальная длина %2$d.',
	'SETTING_TOO_LOW'							=> 'Значение поля “%1$s” слишком маленькое. Минимальное значение %2$d.',
	'SETTING_TOO_SHORT'							=> 'Значение поля “%1$s” слишком короткое. Минимальная длина %2$d.',
	'SET_STARTPAGE'								=> 'Сделать стартовой страницей',

	'TITLES'									=> 'Заголовки',

	'UPDATE_SIMILAR'							=> 'Обновить блоки с похожими настройками',
	'UNDO'										=> 'Отменить',

	'VIEW_DEFAULT_LAYOUT'						=> 'Просмотр / редактирование макета по умолчанию',
	'VISIT_PAGE'								=> 'Посетить страницу',
));
