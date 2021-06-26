<?php
/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

/**
* DO NOT CHANGE
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

/*
* These are errors which can be triggered by sending invalid data to the
* boardrules extension API.
*
* These errors will never show to a user unless they are either modifying
* the core boardrules extension code OR unless they are writing an extension
* which makes calls to this extension.
*
* Translators: Feel free to not translate these language strings
*/
$lang = array_merge($lang, array(
	'AUTHOR'			=> 'yazar',
	'AUTHORS'			=> 'authors (array)',
	'BITRATE'			=> 'bitrate',
	'CAPTIONS'			=> 'captions',
	'CATEGORIES'		=> 'categories (array)',
	'CATEGORY'			=> 'kategori',
	'CHANNELS'			=> 'kanallar',
	'CONTENT'			=> 'içerik',
	'CONTRIBUTOR'		=> 'katkıda bulunan',
	'CONTRIBUTORS'		=> 'contributors (array)',
	'COPYRIGHT'			=> 'Telif Hakkı',
	'CREDITS'			=> 'Emeği Geçenler',
	'DATE'				=> 'tarih',
	'DESCRIPTION'		=> 'tanım',
	'DURATION'			=> 'süre',
	'ENCLOSURE'			=> 'enclosure',
	'ENCLOSURES'		=> 'enclosures (array)',
	'EXPRESSION'		=> 'ifade',
	'FEED'				=> 'besleme',
	'FRAMERATE'			=> 'kare hızı',
	'GMDATE'			=> 'GM date',
	'HANDLER'			=> 'handler',
	'HASHES'			=> 'hashler',
	'HEIGHT'			=> 'yükseklik',
	'ID'				=> 'id',
	'IMAGE_HEIGHT'		=> 'görsel yüksekliği',
	'IMAGE_LINK'		=> 'görsel bağlantısı',
	'IMAGE_TITLE'		=> 'görsel başlığı',
	'IMAGE_URL'			=> 'görsel url\'si',
	'IMAGE_WIDTH'		=> 'görsel genişliği',
	'ITEMS'				=> 'öğeler',
	'JAVASCRIPT'		=> 'javascript',
	'KEYWORDS'			=> 'anahtar kelimeler',
	'LABEL'				=> 'etiket',
	'LANG'				=> 'dil',
	'LATITUDE'			=> 'enlem',
	'LENGTH'			=> 'uzunluk',
	'LINK'				=> 'bağlantı',
	'LINKS'				=> 'bağlantılar',
	'LONGITUDE'			=> 'boylam',
	'MEDIUM'			=> 'orta',
	'NAME'				=> 'isim',
	'PERMALINK'			=> 'kalıcı bağlantı',
	'PLAYER'			=> 'oyuncu',
	'RATINGS'			=> 'puanlar',
	'RELATIONSHIP'		=> 'ilişki',
	'RESTRICTIONS'		=> 'restrictions (array)',
	'SAMPLINGRATE'		=> 'örnekleme oranı',
	'SCHEME'			=> 'şema',
	'SOURCE'			=> 'kaynak',
	'TERM'				=> 'şart',
	'THUMBNAILS'		=> 'küçükresimler',
	'TITLE'				=> 'başlık',
	'TYPE'				=> 'tür',
	'UPDATED_DATE'		=> 'güncelleme tarihi',
	'UPDATED_GMDATE'	=> 'updated GM date',
	'VALUE'				=> 'değer',
	'WIDTH'				=> 'genişlik',
));
