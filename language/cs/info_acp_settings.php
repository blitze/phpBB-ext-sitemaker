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

	'BLOCKS_CLEANUP'			=> 'Čištění bloků',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'Následující položky byly nalezeny tak, že již neexistují nebo nejsou dostupné, a proto můžete odstranit všechny bloky s nimi spojené. Mějte prosím na paměti, že některé z nich mohou být falešná pozitiva',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Neplatné bloky (např. z odinstalovaných rozšíření):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Nedostupné/poškozené stránky:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Odinstalované styly (ids):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Vyčištěné bloky',

	'FORUM_INDEX_SETTINGS'			=> 'Nastavení indexu Fóra',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Tato nastavení platí pouze v případě, že není definována žádná úvodní stránka',

	'HIDE'			=> 'Skrýt',
	'HIDE_BIRTHDAY'	=> 'Skrýt sekci narozeniny',
	'HIDE_LOGIN'	=> 'Skrýt přihlašovací pole',
	'HIDE_ONLINE'	=> 'Skrýt oddíl Whos online',

	'LAYOUT_BLOG'		=> 'Blog',
	'LAYOUT_CUSTOM'		=> 'Vlastní',
	'LAYOUT_HOLYGRAIL'	=> 'Svatý grál',
	'LAYOUT_PORTAL'		=> 'Portál',
	'LAYOUT_PORTAL_ALT'	=> 'Portál (alt)',
	'LAYOUT_SETTINGS'	=> 'Nastavení rozvržení',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Sitemaker bloky smazané pro chybějící styl s id %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Bloky Sitemaker smazané pro poškozené stránky:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Neplatné bloky Sitemaker odstraněny:<br />%s',

	'NAVIGATION_SETTINGS'		=> 'Nastavení navigace',

	'SETTINGS_SAVED'			=> 'Vaše nastavení bylo uloženo',
	'SHOW'						=> 'Zobrazit',
	'SHOW_FORUM_NAV'			=> 'Zobrazit \'Forum\' v navigačním panelu?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Pokud je stránka nastavena jako startpage místo indexu fóra, měli bychom zobrazit \'Fórum\' v navigačním panelu',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Ano - s ikonou:',
]);
