<?php
/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
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

$lang = array_merge($lang, array(
	'ACP_MENU'					=> 'Menü',
	'ACP_MENU_MANAGE'			=> 'Menü Yönetimi',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Buradan siten için menüler oluşturabilir ve yönetebilirsin',
	'ADD_BULK_MENU'				=> 'Menü Öğelerini Toplu Ekle',
	'ADD_BULK_MENU_EXPLAIN'		=> 'Bir kerede birden çok menü öğesi ekleyin.<br /> - Her öğeyi ayrı bir satıra yerleştirin<br /> - Üst-alt ilişkisini temsil edecek öğeleri girintilemek için <strong>Tab</strong> tuşunu kullanın<br /> - Girin öğe ve URL şöyle: Ana Sayfa|index.php',
	'ADD_MENU'					=> 'Menü Ekle',
	'ADD_MENU_ITEM'				=> 'Menü öğesi ekle',
	'ADD_ITEM'					=> 'Yeni Öğe Ekle',
	'AJAX_PROCESSING'			=> 'Çalışıyor',

	'CHANGE_ME'					=> 'Beni Değiştir',

	'DELETE_ITEM'				=> 'Öğeyi Sil',
	'DELETE_KIDS'				=> 'Dalı Sil',
	'DELETE_MENU'				=> 'Menüyü sil',
	'DELETE_MENU_CONFIRM'		=> 'Bu menüyü silmek istediğinize emin misiniz?<br />Bu işlem menüyü ve onun tüm öğelerini silecek',
	'DELETE_MENU_ITEM'			=> 'Öğeyi Sil',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Bu menü öğesini silmek istediğinize emin misiniz?',
	'DELETE_SELECTED'			=> 'Seçileni Sil',

	'EDIT_ITEM'					=> 'Ögeyi Düzenle',

	'ITEM_ACTIVE'				=> 'Etkin',
	'ITEM_INACTIVE'				=> 'İnaktif',
	'ITEM_PARENT'				=> 'Üst',
	'ITEM_TITLE'				=> 'Öğe Başlığı',
	'ITEM_TITLE_EXPLAIN'		=> 'Ayırıcı için \'-\' olarak ayarla',
	'ITEM_TARGET'				=> 'Öğe Hedefi',
	'ITEM_URL'					=> 'Öğe URL\'si',
	'ITEM_URL_EXPLAIN'			=> '- Başlıklar için boş bırakın<br />- Harici siteler http(s)://, ftp://, // vb. ile başlamalıdır',

	'MENU_ITEMS'				=> 'Menü Öğeleri',

	'NO_MENU_ITEMS'				=> 'Hiçbir menü öğesi oluşturulmadı',
	'NO_PARENT'					=> 'Üst yok',

	'PROCESSING_ERROR'			=> 'İşleme hatası',

	'REBUILD_TREE'				=> 'Rebuild Tree',
	'REQUIRED'					=> 'Gerekli',
	'REQUIRED_FIELDS'			=> '* Zorunlu Alanlar',

	'SAVE_CHANGES'				=> 'Değişiklikleri Kaydet',
	'SAVE'						=> 'Kaydet',
	'SELECT_ALL'				=> 'Hepsini seç',

	'TARGET_BLANK'				=> 'Boş Sayfa',
	'TARGET_PARENT'				=> 'Üst',

	'UNSAVED_CHANGES'			=> 'Kaydedilmemiş değişiklikleriniz var',

	'VISIT_PAGE'				=> 'Sayfayı ziyaret et',
));
