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
	'EXCEPTION_FIELD_MISSING'		=> 'Champ obligatoire manquant',
	'EXCEPTION_INVALID_ACTION'		=> 'L\'action n\'existe pas',
	'EXCEPTION_INVALID_ARGUMENT'	=> 'Argument non valide spécifié pour `%1$s`. Raison: %2$s',
	'EXCEPTION_INVALID_DATA_TYPE'	=> 'La valeur fournie est d\'un type de données inattendu',
	'EXCEPTION_INVALID_ENTITY'		=> 'L\'entité fournie est d\'une classe d\'entité inattendue',
	'EXCEPTION_INVALID_PROPERTY'	=> 'La propriété demandée n\'existe pas',
	'EXCEPTION_OUT_OF_BOUNDS'		=> 'Le `%1$s` demandé n\'existe pas',
	'EXCEPTION_SERVICE_NOT_FOUND'	=> 'Le service demandé n\'a pas été trouvé',
	'EXCEPTION_UNEXPECTED_VALUE'	=> 'L\'action demandée `%1$s` n\'a pas pu être exécutée. Raison : %2$s',
));
