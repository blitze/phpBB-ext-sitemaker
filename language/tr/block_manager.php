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
	'ADD_BLOCK_EXPLAIN'							=> '*Blokları Sürükle ve Bırak',
	'AJAX_ERROR'								=> 'Üzgünüm! İsteğiniz işlenirken bir hata oluştu. Lütfen yeniden deneyin.',
	'AJAX_LOADING'								=> 'Yükleniyor...',
	'AJAX_PROCESSING'							=> 'Çalışıyor...',

	'BACKGROUND'								=> 'Arkaplan',
	'BLOCKS'									=> 'Bloklar',
	'BLOCKS_COPY_FROM'							=> 'Blokları kopyala',
	'BLOCK_ACTIVE'								=> 'Etkin',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Show on child routes only',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Hide on child routes',
	'BLOCK_CLASS'								=> 'CSS Sınıfı',
	'BLOCK_CLASS_EXPLAIN'						=> 'Blok görünümünü CSS sınıfına göre modifiye et',
	'BLOCK_DESIGN'								=> 'Görünüm',
	'BLOCK_DISPLAY_TYPE'						=> 'Görüntüle',
	'BLOCK_HIDE_TITLE'							=> 'Blok başlığını gizle?',
	'BLOCK_INACTIVE'							=> 'İnaktif',
	'BLOCK_NOT_FOUND'							=> 'Oops! The requested block service was not found',
	'BLOCK_NO_DATA'								=> 'Gösterilecek veri yok',
	'BLOCK_NO_ID'								=> 'Oops! Missing block id',
	'BLOCK_PERMISSION'							=> 'Viewable by',
	'BLOCK_SHOW_ALWAYS'							=> 'Her zaman',
	'BLOCK_STATUS'								=> 'Durum',
	'BLOCK_UPDATED'								=> 'Block settings successfully updated',

	'CANCEL'									=> 'Vazgeç',
	'CHILD_ROUTE'								=> 'Child',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/my-article',
	'CLEAR'										=> 'Temizle',
	'COPY'										=> 'Kopyala',
	'COPY_BLOCKS'								=> 'Blokları kopyala?',
	'COPY_BLOCKS_CONFIRM'						=> 'Are you sure that you’d like to copy blocks from another page?<br /><br />This will delete all existing blocks and their settings for this page and replace them with the blocks from the selected page.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'If set, all site pages for which you have not specified blocks will inherit the blocks from the default layout. You may, however, override the default layout for particular pages using the options to the right.',
	'DELETE'									=> 'Sil',
	'DELETE_ALL_BLOCKS'							=> 'Tüm Blokları Sil',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'Bu sayfa için tüm blokları silmek istediğinize emin misiniz?',
	'DELETE_BLOCK'								=> 'Bloğu Sil',
	'DELETE_BLOCK_CONFIRM'						=> 'Are you sure you want to delete this block?<br /><br /><br /><strong>Note:</strong> You will have to save the layout changes to make this permanent.',

	'EDIT'										=> 'Düzenle',
	'EDIT_BLOCK'								=> 'Bloğu Düzenle',
	'EXIT_EDIT_MODE'							=> 'Düzenleme Modundan Çık',

	'FEED_PROBLEMS'								=> 'There was a problem processing the provided rss/atom feed(s)',
	'FEED_URL_MISSING'							=> 'Please provide at least one rss/atom feed to begin',
	'FIELD_INVALID'								=> 'The provided value for the field “%s” has an invalid format',
	'FIELD_REQUIRED'							=> '“%s” is a required field',
	'FIELD_TOO_LONG'							=> 'The provided value for the field “%1$s” is too long. The maximum acceptable value is %2$d.',
	'FIELD_TOO_SHORT'							=> 'The provided value for the field “%1$s” is too short. The minimum acceptable value is %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'Do not show blocks on this page',
	'HIDE_BLOCK_POSITIONS'						=> 'Do not show blocks for the following block positions:',

	'IMAGES'									=> 'Görseller',

	'LAYOUT'									=> 'Şablon',
	'LAYOUT_SAVED'								=> 'Şablon başaryla kaydedildi!',
	'LAYOUT_SETTINGS'							=> 'Layout Settings',
	'LEAVE_CONFIRM'								=> 'You have some unsaved changes to this page. Please save your work before moving on',
	'LISTS'										=> 'Lists',

	'MAKE_DEFAULT_LAYOUT'						=> 'Set As Default Layout',

	'OR'										=> '<strong>VEYA</strong>',

	'PARENT_ROUTE'								=> 'Üst',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/articles',
	'PREDEFINED_CLASSES'						=> 'Predefined classes',

	'REDO'										=> 'Yinele',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Remove As Default Layout',
	'REMOVE_STARTPAGE'							=> 'Başlangıç Sayfasını Kaldır',
	'ROUTE_HIDDEN_BLOCKS'						=> 'Blocks are being hidden for this page',
	'ROUTE_HIDDEN_POSITIONS'					=> 'Blocks are being hidden for the following positions',
	'ROUTE_UPDATED'								=> 'Page settings successfully updated',

	'SAVE_CHANGES'								=> 'Değişiklikleri Kaydet',
	'SAVE_SETTINGS'								=> 'Ayarları kaydet',
	'SELECT_ICON'								=> 'Simge seç',
	'SETTINGS'									=> 'Ayarlar',
	'SETTING_TOO_BIG'							=> 'The provided value for the setting “%1$s” is too high. The maximum acceptable value is %2$d.',
	'SETTING_TOO_LONG'							=> 'The provided value for the setting “%1$s” is too long. The maximum acceptable length is %2$d.',
	'SETTING_TOO_LOW'							=> 'The provided value for the setting “%1$s” is too low. The minimum acceptable value is %2$d.',
	'SETTING_TOO_SHORT'							=> 'The provided value for the setting “%1$s” is too short. The minimum acceptable length is %2$d.',
	'SET_STARTPAGE'								=> 'Başlangıç Sayfası Olarak Ayarla',

	'TITLES'									=> 'Başlıklar',

	'UPDATE_SIMILAR'							=> 'Update blocks with similar settings',
	'UNDO'										=> 'Geri al',

	'VIEW_DEFAULT_LAYOUT'						=> 'Varsayılan Şablonu Görüntüle/Düzenle',
	'VISIT_PAGE'								=> 'Sayfayı ziyaret et',
));
