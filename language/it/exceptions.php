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
	'EXCEPTION_FIELD_MISSING'		=> 'Campo obbligatorio mancante',
	'EXCEPTION_INVALID_ACTION'		=> 'L\'azione non esiste',
	'EXCEPTION_INVALID_ARGUMENT'	=> 'Argomento non valido specificato per `%1$s`. Motivo: %2$s',
	'EXCEPTION_INVALID_DATA_TYPE'	=> 'Il valore fornito è di un tipo di dati imprevisto',
	'EXCEPTION_INVALID_ENTITY'		=> 'L’entità fornita è di una classe di entità imprevista',
	'EXCEPTION_INVALID_PROPERTY'	=> 'La proprietà richiesta non esiste',
	'EXCEPTION_OUT_OF_BOUNDS'		=> 'La richiesta `%1$s` non esiste',
	'EXCEPTION_SERVICE_NOT_FOUND'	=> 'Il servizio richiesto non è stato trovato',
	'EXCEPTION_UNEXPECTED_VALUE'	=> 'L\'azione richiesta `%1$s` non può essere eseguita. Motivo: %2$s',
));
