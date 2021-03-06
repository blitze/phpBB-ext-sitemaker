<?php
/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
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

$lang = array_merge($lang, array(
	'EXCEPTION_FIELD_MISSING'		=> 'Brak wymaganego pola',
	'EXCEPTION_INVALID_ACTION'		=> 'Akcja nie istnieje',
	'EXCEPTION_INVALID_ARGUMENT'	=> 'Nieprawidłowy argument dla `%1$s`. Powód: %2$s',
	'EXCEPTION_INVALID_DATA_TYPE'	=> 'Podana wartość jest nieoczekiwanym typem danych',
	'EXCEPTION_INVALID_ENTITY'		=> 'Dostarczony podmiot jest nieoczekiwaną klasą podmiotów',
	'EXCEPTION_INVALID_PROPERTY'	=> 'Żądana właściwość nie istnieje',
	'EXCEPTION_OUT_OF_BOUNDS'		=> 'Żądany `%1$s` nie istnieje',
	'EXCEPTION_SERVICE_NOT_FOUND'	=> 'Nie znaleziono żądanej usługi',
	'EXCEPTION_UNEXPECTED_VALUE'	=> 'Żądana akcja `%1$s` nie mogła zostać wykonana. Powód: %2$s',
));
