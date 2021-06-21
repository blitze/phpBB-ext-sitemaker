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
	'ACP_SM_SETTINGS'	=> 'Nastavení',

	'BLOCKS_CLEANUP'			=> 'Blokování vyčištění',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'Následující položky již neexistují nebo nejsou dostupné, a proto můžete odstranit všechny přidružené bloky. Mějte prosím na paměti, že některé z nich mohou být falešné pozitivy',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Neplatné bloky (např. z odinstalovaných rozšíření):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Nedostupné/rozbité stránky:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Odinstalované Styly (ids):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Blokování úspěšně vyprázdněno',

	'FORUM_INDEX_SETTINGS'			=> 'Nastavení indexu fóra',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Tato nastavení platí pouze v případě, že není zadána hvězdička',

	'HIDE'			=> 'Skrýt',
	'HIDE_BIRTHDAY'	=> 'Skrýt sekci narozenin',
	'HIDE_LOGIN'	=> 'Skrýt přihlašovací pole',
	'HIDE_ONLINE'	=> 'Skrýt sekci online',

	'LAYOUT_BLOG'		=> 'Blog',
	'LAYOUT_CUSTOM'		=> 'Vlastní',
	'LAYOUT_HOLYGRAIL'	=> 'Svatý Král',
	'LAYOUT_PORTAL'		=> 'Portál',
	'LAYOUT_PORTAL_ALT'	=> 'Portál (alt)',
	'LAYOUT_SETTINGS'	=> 'Nastavení rozvržení',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Sitemaker bloky odstraněny pro chybějící styl s ID %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Odstraněné bloky Sitemakeru pro rozbité stránky:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Odstraněny neplatné bloky Sitemaker:<br />%s',

	'NAVIGATION_SETTINGS'		=> 'Nastavení navigace',

	'SETTINGS_SAVED'			=> 'Vaše nastavení bylo uloženo',
	'SHOW'						=> 'Zobrazit',
	'SHOW_FORUM_NAV'			=> 'Zobrazit \'Fóru\' v navigačním panelu?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Pokud je stránka nastavena jako startpage namísto indexu fóra, měli bychom v navigačním panelu zobrazit \'Fóru\'',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Ano - s ikonou:',
]);
