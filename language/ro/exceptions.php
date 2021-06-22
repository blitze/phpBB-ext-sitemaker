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
	'EXCEPTION_FIELD_MISSING'		=> 'Câmp obligatoriu lipsă',
	'EXCEPTION_INVALID_ACTION'		=> 'Acțiunea nu există',
	'EXCEPTION_INVALID_ARGUMENT'	=> 'Argument nevalid specificat pentru `%1$s`. Motiv: %2$s',
	'EXCEPTION_INVALID_DATA_TYPE'	=> 'Valoarea furnizată este de un tip de date neașteptat',
	'EXCEPTION_INVALID_ENTITY'		=> 'Entitatea furnizată se află într-o clasă de entități neașteptată',
	'EXCEPTION_INVALID_PROPERTY'	=> 'Proprietatea solicitată nu există',
	'EXCEPTION_OUT_OF_BOUNDS'		=> 'The requested `%1$s` does not exist',
	'EXCEPTION_SERVICE_NOT_FOUND'	=> 'Serviciul solicitat nu a fost găsit',
	'EXCEPTION_UNEXPECTED_VALUE'	=> 'Acţiunea solicitată `%1$snu a putut fi efectuată. Motivul: %2$s',
));
