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
	'ACP_SM_SETTINGS'	=> 'Ustawienia',

	'BLOCKS_CLEANUP'			=> 'Czyszczenie bloków',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'Następujące elementy nie istnieją lub nie są już osiągalne, dlatego możesz usunąć wszystkie bloki z nimi związane. Pamiętaj, że niektóre z nich mogą być fałszywie dodatnie',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Nieprawidłowe bloki (np. z odinstalowanych rozszerzeń):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Nieosiągalne/uszkodzone strony:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Odinstalowane style (id):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Bloki wyczyszczone pomyślnie',

	'FORUM_INDEX_SETTINGS'			=> 'Ustawienia indeksu forum',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Te ustawienia mają zastosowanie tylko wtedy, gdy nie zdefiniowano strony startowej',

	'HIDE'			=> 'Ukryj',
	'HIDE_BIRTHDAY'	=> 'Ukryj sekcję urodzin',
	'HIDE_LOGIN'	=> 'Ukryj pole logowania',
	'HIDE_ONLINE'	=> 'Ukryj sekcję online',

	'LAYOUT_BLOG'		=> 'Blog',
	'LAYOUT_CUSTOM'		=> 'Własny',
	'LAYOUT_HOLYGRAIL'	=> 'Święty Gróz',
	'LAYOUT_PORTAL'		=> 'Portal',
	'LAYOUT_PORTAL_ALT'	=> 'Portal (alt)',
	'LAYOUT_SETTINGS'	=> 'Ustawienia układu',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Bloki strony zostały usunięte dla brakującego stylu z id %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Bloki sitakera usunięte dla uszkodzonych stron:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Usunięto nieprawidłowe bloki Sitemakera:<br />%s',

	'NAVIGATION_SETTINGS'		=> 'Ustawienia nawigacji',

	'SETTINGS_SAVED'			=> 'Twoje ustawienia zostały zapisane',
	'SHOW'						=> 'Pokaż',
	'SHOW_FORUM_NAV'			=> 'Pokazać "Forum" na pasku nawigacyjnym?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Kiedy strona jest ustawiona jako strona startowa zamiast indeksu forum, powinniśmy wyświetlić "Forum" na pasku nawigacyjnym',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Tak - z ikoną:',
]);
