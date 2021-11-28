<?php

/**
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	'ACP_SITEMAKER'		=> 'SiteMaker',
	'ACP_SM_SETTINGS'	=> 'Ayarlar',

	'BLOCKS_CLEANUP'			=> 'Blocks Cleanup',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'Aşağıdaki öğelerin artık mevcut olmadığı veya erişilemediği bulundu ve bu nedenle bunlarla ilişkili tüm blokları silebilirsiniz. Lütfen bunlardan bazılarının yanlış pozitif olabileceğini unutmayın',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Geçersiz Bloklar (ör. kaldırılan uzantılardan):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Ulaşılamayan/bozuk Sayfalar:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Kaldırılan Stiller (id\'ler):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Bloklar başarıyla budandı',

	'FORUM_INDEX_SETTINGS'			=> 'Forum Anasayfa Ayarları',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Bu ayarlar yalnızca tanımlanmış bir başlangıç sayfası olmadığında geçerlidir',

	'HIDE'			=> 'Gizle',
	'HIDE_BIRTHDAY'	=> 'Doğumgünü alanını gizle',
	'HIDE_LOGIN'	=> 'Giriş kutucuğunu gizle',
	'HIDE_ONLINE'	=> 'Kimler çevirimiçi alanını gizle',

	'LAYOUT_BLOG'		=> 'Blog',
	'LAYOUT_CUSTOM'		=> 'Özel',
	'LAYOUT_HOLYGRAIL'	=> 'Kutsal Kâse',
	'LAYOUT_PORTAL'		=> 'Portal',
	'LAYOUT_PORTAL_ALT'	=> 'Portal (alt)',
	'LAYOUT_SETTINGS'	=> 'Şablon Ayarları',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Sitemaker blocks deleted for missing style with id %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Sitemaker blocks deleted for broken pages:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Invalid Sitemaker blocks deleted:<br />%s',

	'NAVIGATION_SETTINGS'		=> 'Gezinme çubuğu Ayarları',

	'SETTINGS_SAVED'			=> 'Ayarlarınız kaydedildi',
	'SHOW'						=> 'Göster',
	'SHOW_FORUM_NAV'			=> 'Show ’Forum’ in navigation bar?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'When a page is set as startpage instead of the forum index, should we display ’Forum’ in navigation bar',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Evet - Simge ile:',
]);
