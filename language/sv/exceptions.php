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
	'EXCEPTION_FIELD_MISSING'		=> 'Obligatoriskt fält saknas',
	'EXCEPTION_INVALID_ACTION'		=> 'Åtgärden finns inte',
	'EXCEPTION_INVALID_ARGUMENT'	=> 'Ogiltigt argument specificerat för `%1$s`. Anledning: %2$s',
	'EXCEPTION_INVALID_DATA_TYPE'	=> 'Det angivna värdet är av en oväntad datatyp',
	'EXCEPTION_INVALID_ENTITY'		=> 'Den angivna enheten är av en oväntad varelseklass',
	'EXCEPTION_INVALID_PROPERTY'	=> 'Den begärda egenskapen finns inte',
	'EXCEPTION_OUT_OF_BOUNDS'		=> 'Den begärda `%1$s` finns inte',
	'EXCEPTION_SERVICE_NOT_FOUND'	=> 'Den begärda tjänsten hittades inte',
	'EXCEPTION_UNEXPECTED_VALUE'	=> 'Den begärda åtgärden `%1$s` kunde inte utföras. Anledning: %2$s',
));
