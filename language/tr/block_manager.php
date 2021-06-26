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
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Yalnızca alt rotalarda göster',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Alt rotalarda gizle',
	'BLOCK_CLASS'								=> 'CSS Sınıfı',
	'BLOCK_CLASS_EXPLAIN'						=> 'Blok görünümünü CSS sınıfına göre modifiye et',
	'BLOCK_DESIGN'								=> 'Görünüm',
	'BLOCK_DISPLAY_TYPE'						=> 'Görünüm',
	'BLOCK_HIDE_TITLE'							=> 'Blok başlığını gizle?',
	'BLOCK_INACTIVE'							=> 'İnaktif',
	'BLOCK_MISSING_TEMPLATE'					=> 'Missing required block template. Please contact developer',
	'BLOCK_NOT_FOUND'							=> 'Oops! The requested block service was not found',
	'BLOCK_NO_DATA'								=> 'Gösterilecek veri yok',
	'BLOCK_NO_ID'								=> 'Üzgünüm! Blok id eksik',
	'BLOCK_PERMISSION'							=> 'İzin',
	'BLOCK_PERMISSION_ALLOW'					=> 'Şunlara Göster',
	'BLOCK_PERMISSION_DENY'						=> 'Şunlardan gizle',
	'BLOCK_PERMISSION_EXPLAIN'					=> 'CTRL + tıklamayı seçimi deşitirmek için kullanın',
	'BLOCK_SHOW_ALWAYS'							=> 'Her zaman',
	'BLOCK_STATUS'								=> 'Durum',
	'BLOCK_UPDATED'								=> 'Blok ayarları başarıyla güncellendi',

	'CANCEL'									=> 'İptal',
	'CHILD_ROUTE'								=> 'Alt',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/makaleler/benim-makalem',
	'CLEAR'										=> 'Temizle',
	'COPY'										=> 'Kopyala',
	'COPY_BLOCKS'								=> 'Blokları kopyala?',
	'COPY_BLOCKS_CONFIRM'						=> 'Blokları başka sayfadan kopyalamak istediğine emin misin?<br /><br />Bu tüm blokları ve onların ayarlarını bu sayfa için silecek ve onları seçili sayfa blokları ile değiştirecek.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'If set, all site pages for which you have not specified blocks will inherit the blocks from the default layout. You may, however, override the default layout for particular pages using the options to the right.',
	'DELETE'									=> 'Sil',
	'DELETE_ALL_BLOCKS'							=> 'Tüm Blokları Sil',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'Bu sayfa için tüm blokları silmek istediğine emin misin?',
	'DELETE_BLOCK'								=> 'Bloğu Sil',
	'DELETE_BLOCK_CONFIRM'						=> 'Bu bloğu silmek istediğine emin misin?<br /><br /><br /><strong>Not:</strong> Bunu kalıcı hale getirmek için şablon değişikliklerini kaydetmelisin.',

	'EDIT'										=> 'Düzenle',
	'EDIT_BLOCK'								=> 'Bloğu Düzenle',
	'EXIT_EDIT_MODE'							=> 'Düzenleme Modundan Çık',

	'FEED_PROBLEMS'								=> 'Sağlanan rss/atom besleme(leri) işlenirken bir sorun oluştu',
	'FEED_URL_MISSING'							=> 'Başlamak için lütfen en az bir rss/atom beslemesi sağlayın',
	'FIELD_INVALID'								=> 'The provided value for the field “%s” has an invalid format',
	'FIELD_REQUIRED'							=> '“%s” gerekli bir alandır',
	'FIELD_TOO_LONG'							=> 'The provided value for the field “%1$s” is too long. The maximum acceptable value is %2$d.',
	'FIELD_TOO_SHORT'							=> 'The provided value for the field “%1$s” is too short. The minimum acceptable value is %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'Blokları bu sayfada gösterme',
	'HIDE_BLOCK_POSITIONS'						=> 'Do not show blocks for the following block positions:',

	'IMAGES'									=> 'Görseller',

	'LAYOUT'									=> 'Şablon',
	'LAYOUT_SAVED'								=> 'Şablon başaryla kaydedildi!',
	'LAYOUT_SETTINGS'							=> 'Şablon Ayarları',
	'LEAVE_CONFIRM'								=> 'You have some unsaved changes to this page. Please save your work before moving on',
	'LISTS'										=> 'Listeler',

	'MAKE_DEFAULT_LAYOUT'						=> 'Varsayılan Şablon Olarak Ayarla',

	'OR'										=> '<strong>VEYA</strong>',

	'PARENT_ROUTE'								=> 'Üst',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/articles',
	'PREDEFINED_CLASSES'						=> 'Öntanımlı sınıflar',

	'REDO'										=> 'Yinele',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Remove As Default Layout',
	'REMOVE_STARTPAGE'							=> 'Başlangıç Sayfasını Kaldır',
	'ROUTE_HIDDEN_BLOCKS'						=> 'Bloklar bu sayfa için gizlendi',
	'ROUTE_HIDDEN_POSITIONS'					=> 'Blocks are being hidden for the following positions',
	'ROUTE_UPDATED'								=> 'Sayfa ayarları başarıyla güncellendi',

	'SAVE_CHANGES'								=> 'Değişiklikleri Kaydet',
	'SAVE_SETTINGS'								=> 'Ayarları kaydet',
	'SELECT_ICON'								=> 'Bir Simge Seçin',
	'SETTINGS'									=> 'Ayarlar',
	'SETTING_TOO_BIG'							=> 'The provided value for the setting “%1$s” is too high. The maximum acceptable value is %2$d.',
	'SETTING_TOO_LONG'							=> 'The provided value for the setting “%1$s” is too long. The maximum acceptable length is %2$d.',
	'SETTING_TOO_LOW'							=> 'The provided value for the setting “%1$s” is too low. The minimum acceptable value is %2$d.',
	'SETTING_TOO_SHORT'							=> 'The provided value for the setting “%1$s” is too short. The minimum acceptable length is %2$d.',
	'SET_STARTPAGE'								=> 'Başlangıç Sayfası Olarak Ayarla',

	'TITLES'									=> 'Başlıklar',

	'UPDATE_SIMILAR'							=> 'Blokları benzer ayarlarla güncelle',
	'UNDO'										=> 'Geri al',

	'VIEW_DEFAULT_LAYOUT'						=> 'Varsayılan Şablonu Görüntüle/Düzenle',
	'VISIT_PAGE'								=> 'Sayfayı ziyaret et',
));
