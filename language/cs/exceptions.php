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
	'EXCEPTION_FIELD_MISSING'		=> 'Chybí povinné pole',
	'EXCEPTION_INVALID_ACTION'		=> 'Akce neexistuje',
	'EXCEPTION_INVALID_ARGUMENT'	=> 'Byl zadán neplatný argument pro `%1$s`. Důvod: %2$s',
	'EXCEPTION_INVALID_DATA_TYPE'	=> 'Poskytnutá hodnota je neočekávaný datový typ',
	'EXCEPTION_INVALID_ENTITY'		=> 'Poskytnutá účetní jednotka patří do neočekávané třídy účetní jednotky',
	'EXCEPTION_INVALID_PROPERTY'	=> 'Požadovaná vlastnost neexistuje',
	'EXCEPTION_OUT_OF_BOUNDS'		=> 'Požadovaný `%1$s` neexistuje',
	'EXCEPTION_SERVICE_NOT_FOUND'	=> 'Požadovaná služba nebyla nalezena',
	'EXCEPTION_UNEXPECTED_VALUE'	=> 'Požadovanou akci `%1$s` nelze provést. Důvod: %2$s',
));
