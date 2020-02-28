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
	'ACP_SITEMAKER'				=> 'SiteMaker',
	'ACP_SM_SETTINGS'			=> 'Nastavení',

	'BLOCKS_CLEANUP'			=> 'Čištění bloků',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'Následující položky byly nalezeny tak, že již neexistují nebo nejsou dostupné, a proto můžete odstranit všechny bloky s nimi spojené. Mějte prosím na paměti, že některé z nich mohou být falešná pozitiva',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Neplatné bloky (např. z odinstalovaných rozšíření):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Nedostupné/poškozené stránky:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Odinstalované styly (ids):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Vyčištěné bloky',

	'FILEMANAGER_SETTINGS'						=> 'Nastavení souborového správce souborů',
	'FILEMANAGER_STATUS'						=> 'Stav',
	'FILEMANAGER_NO_EXIST'						=> 'You will need to install the File Manager before you can enable it. Installation instructions are found <a href="%s" target="_blank"  rel="noopener noreferrer"><strong>here</strong></a>',
	'FILEMANAGER_IMAGE_AUTO_RESIZE'				=> 'Automaticky změnit velikost nahraných obrázků?',
	'FILEMANAGER_IMAGE_AUTO_RESIZE_DIMENSIONS'	=> 'Změnit velikost na zadané rozměry',
	'FILEMANAGER_IMAGE_AUTO_RESIZING_MODE'		=> 'Režim automatické změny velikosti',
	'FILEMANAGER_IMAGE_MAX_DIMENSIONS'			=> 'Max. velikost obrázku',
	'FILEMANAGER_IMAGE_MAX_MODE'				=> 'Max. velikost obrázku',
	'FILEMANAGER_IMAGE_MODE_EXPLAIN'			=> 'Používá se k výpočtu výšky/šířky, pokud poskytnete pouze výšku nebo šířku, ale ne obojí nahoře',
	'FILEMANAGER_IMAGE_MODE_AUTO'				=> 'Autom.',
	'FILEMANAGER_IMAGE_MODE_CROP'				=> 'Oříznout',
	'FILEMANAGER_IMAGE_MODE_EXACT'				=> 'Přesně',
	'FILEMANAGER_IMAGE_MODE_LANDSCAPE'			=> 'Na šířku',
	'FILEMANAGER_IMAGE_MODE_PORTRAIT'			=> 'Na výšku',
	'FILEMANAGER_WATERMARK'						=> 'Vodoznak',
	'FILEMANAGER_WATERMARK_EXPLAIN'				=> 'URL adresa obrázku, který má být použit jako vodoznak na všechny nahrané obrázky',
	'FILEMANAGER_WATERMARK_POSITION'			=> 'Pozice vodoznaku',
	'FILEMANAGER_WATERMARK_POSITION_EXPLAIN'	=> 'Vyberte předurčenou pozici, kde by se vodoznak měl objevit nebo zadat souřadnice, např. 50x100.',
	'FILEMANAGER_WATERMARK_POSITION_TL'			=> 'Nahoře vlevo',
	'FILEMANAGER_WATERMARK_POSITION_T'			=> 'Nahoře',
	'FILEMANAGER_WATERMARK_POSITION_TR'			=> 'Nahoře vpravo',
	'FILEMANAGER_WATERMARK_POSITION_L'			=> 'Levý',
	'FILEMANAGER_WATERMARK_POSITION_M'			=> 'Uprostřed',
	'FILEMANAGER_WATERMARK_POSITION_R'			=> 'Pravý',
	'FILEMANAGER_WATERMARK_POSITION_BL'			=> 'Vlevo dole',
	'FILEMANAGER_WATERMARK_POSITION_B'			=> 'Dolní',
	'FILEMANAGER_WATERMARK_POSITION_BR'			=> 'Dolní pravá',
	'FILEMANAGER_WATERMARK_POSITION_SUFFIX'		=> 'nebo',
	'FILEMANAGER_WATERMARK_PADDING'				=> 'Odsazení vodníku',
	'FILEMANAGER_WATERMARK_PADDING_EXPLAIN'		=> 'Pokud používáte předem určenou pozici, můžete upravit odsazení od hran. Pokud používáte souřadnice, tato hodnota je ignorována',

	'FORUM_INDEX_SETTINGS'			=> 'Nastavení indexu Fóra',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Tato nastavení platí pouze v případě, že není definována žádná úvodní stránka',

	'HIDE'						=> 'Skrýt',
	'HIDE_BIRTHDAY'				=> 'Skrýt sekci narozeniny',
	'HIDE_LOGIN'				=> 'Skrýt přihlašovací pole',
	'HIDE_ONLINE'				=> 'Skrýt oddíl Whos online',

	'LAYOUT_BLOG'				=> 'Blog',
	'LAYOUT_CUSTOM'				=> 'Vlastní',
	'LAYOUT_HOLYGRAIL'			=> 'Svatý grál',
	'LAYOUT_PORTAL'				=> 'Portál',
	'LAYOUT_PORTAL_ALT'			=> 'Portál (alt)',
	'LAYOUT_SETTINGS'			=> 'Nastavení rozvržení',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Sitemaker bloky smazané pro chybějící styl s id %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Bloky Sitemaker smazané pro poškozené stránky:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Neplatné bloky Sitemaker odstraněny:<br />%s',

	'NAVIGATION_SETTINGS'		=> 'Nastavení navigace',
	'NO_NAVBAR'					=> 'Žádný',

	'SELECT_NAVBAR_MENU'		=> 'Vybrat hlavní navigační menu',
	'SETTINGS_SAVED'			=> 'Vaše nastavení bylo uloženo',
	'SHOW'						=> 'Zobrazit',
	'SHOW_FORUM_NAV'			=> 'Zobrazit \'Forum\' v navigačním panelu?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Pokud je stránka nastavena jako startpage místo indexu fóra, měli bychom zobrazit \'Fórum\' v navigačním panelu',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Ano - s ikonou:',
));
