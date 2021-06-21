<?php
/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2019 Daniel A. (blitze)
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

/*
* These are errors which can be triggered by sending invalid data to the
* boardrules extension API.
*
* These errors will never show to a user unless they are either modifying
* the core boardrules extension code OR unless they are writing an extension
* which makes calls to this extension.
*
* Translators: Feel free to not translate these language strings
*/
$lang = array_merge($lang, array(
	'AUTHOR'			=> 'autor',
	'AUTHORS'			=> 'autores (array)',
	'BITRATE'			=> 'bitrate',
	'CAPTIONS'			=> 'subtítulos',
	'CATEGORIES'		=> 'categorías (array)',
	'CATEGORY'			=> 'categoría',
	'CHANNELS'			=> 'canales',
	'CONTENT'			=> 'contenido',
	'CONTRIBUTOR'		=> 'colaborador',
	'CONTRIBUTORS'		=> 'colaboradores (array)',
	'COPYRIGHT'			=> 'copyright',
	'CREDITS'			=> 'créditos',
	'DATE'				=> 'fecha',
	'DESCRIPTION'		=> 'descripción',
	'DURATION'			=> 'duración',
	'ENCLOSURE'			=> 'adjunto',
	'ENCLOSURES'		=> 'recintos (array)',
	'EXPRESSION'		=> 'expresión',
	'FEED'				=> 'alimento',
	'FRAMERATE'			=> 'frenar',
	'GMDATE'			=> 'Fecha GM',
	'HANDLER'			=> 'handler',
	'HASHES'			=> 'hash',
	'HEIGHT'			=> 'altura',
	'ID'				=> 'id',
	'IMAGE_HEIGHT'		=> 'altura de imagen',
	'IMAGE_LINK'		=> 'enlace de imagen',
	'IMAGE_TITLE'		=> 'título de la imagen',
	'IMAGE_URL'			=> 'url de imagen',
	'IMAGE_WIDTH'		=> 'ancho de imagen',
	'ITEMS'				=> 'objetos',
	'JAVASCRIPT'		=> 'javascript',
	'KEYWORDS'			=> 'palabras clave',
	'LABEL'				=> 'etiqueta',
	'LANG'				=> 'lang',
	'LATITUDE'			=> 'latitud',
	'LENGTH'			=> 'largo',
	'LINK'				=> 'enlace',
	'LINKS'				=> 'enlaces',
	'LONGITUDE'			=> 'longitud',
	'MEDIUM'			=> 'medio',
	'NAME'				=> 'nombre',
	'PERMALINK'			=> 'permalink',
	'PLAYER'			=> 'jugador',
	'RATINGS'			=> 'calificaciones',
	'RELATIONSHIP'		=> 'relación',
	'RESTRICTIONS'		=> 'restricciones (array)',
	'SAMPLINGRATE'		=> 'tasa de muestreo',
	'SCHEME'			=> 'esquema',
	'SOURCE'			=> 'fuente',
	'TERM'				=> 'término',
	'THUMBNAILS'		=> 'thumbnails',
	'TITLE'				=> 'título',
	'TYPE'				=> 'tipo',
	'UPDATED_DATE'		=> 'fecha actualizada',
	'UPDATED_GMDATE'	=> 'fecha GM actualizada',
	'VALUE'				=> 'valor',
	'WIDTH'				=> 'width',
));
