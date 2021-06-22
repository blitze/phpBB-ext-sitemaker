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
	'ACP_SM_SETTINGS'	=> 'Setări',

	'BLOCKS_CLEANUP'			=> 'Curățare blocuri',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'Următoarele elemente au fost găsite a nu mai exista sau inaccesibile, și, prin urmare, puteți șterge toate blocurile asociate lor. Vă rugăm să reţineţi că unele dintre acestea pot fi fals pozitive',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Blocuri invalide (de ex. din extensiile dezinstalate):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Pagini inaccesibile/inaccesibile:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Stiluri dezinstalate (id-uri):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Blocuri șterse cu succes',

	'FORUM_INDEX_SETTINGS'			=> 'Setări Index forum',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Aceste setări se aplică numai atunci când nu este definită o pagină de pornire',

	'HIDE'			=> 'Ascunde',
	'HIDE_BIRTHDAY'	=> 'Ascunde secţiunea aniversară',
	'HIDE_LOGIN'	=> 'Ascunde caseta de autentificare',
	'HIDE_ONLINE'	=> 'Ascunde secțiunea online Whos',

	'LAYOUT_BLOG'		=> 'Blog',
	'LAYOUT_CUSTOM'		=> 'Personalizat',
	'LAYOUT_HOLYGRAIL'	=> 'Gri Sfânt',
	'LAYOUT_PORTAL'		=> 'Portal',
	'LAYOUT_PORTAL_ALT'	=> 'Portal (alt)',
	'LAYOUT_SETTINGS'	=> 'Setări aspect',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Blocuri Sitemaker șterse pentru stilul lipsă cu ID %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Blocurile de articole au fost șterse pentru paginile defecte:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Blocuri Sitemaker nevalide şterse:<br />%s',

	'NAVIGATION_SETTINGS'		=> 'Setări de navigare',

	'SETTINGS_SAVED'			=> 'Setările au fost salvate',
	'SHOW'						=> 'Afișare',
	'SHOW_FORUM_NAV'			=> 'Arată \'Forum\' în bara de navigație?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Atunci când o pagină este setată ca pagină de pornire în loc de indexul forumului, ar trebui să afișăm \'Forum\' în bara de navigare',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Da - cu pictogramă:',
]);
