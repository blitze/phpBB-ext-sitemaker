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
	'EXCEPTION_FIELD_MISSING'		=> 'Campo obrigatório faltando',
	'EXCEPTION_INVALID_ACTION'		=> 'A ação não existe',
	'EXCEPTION_INVALID_ARGUMENT'	=> 'Argumento inválido especificado para `%1$s`. Motivo: %2$s',
	'EXCEPTION_INVALID_DATA_TYPE'	=> 'O valor fornecido é de um tipo de dado inesperado',
	'EXCEPTION_INVALID_ENTITY'		=> 'A entidade fornecida é de uma classe de entidade inesperada',
	'EXCEPTION_INVALID_PROPERTY'	=> 'A propriedade solicitada não existe',
	'EXCEPTION_OUT_OF_BOUNDS'		=> 'O pedido `%1$s` não existe',
	'EXCEPTION_SERVICE_NOT_FOUND'	=> 'O serviço solicitado não foi encontrado',
	'EXCEPTION_UNEXPECTED_VALUE'	=> 'A ação solicitada `%1$s` não pôde ser executada. Motivo: %2$s',
));
