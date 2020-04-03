<?php
/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
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
	'ACP_MENU'					=> 'Menú',
	'ACP_MENU_MANAGE'			=> 'Administración de Menú',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Aquí puedes crear y administrar menús para tu sitio',
	'ADD_BULK_MENU'				=> 'Añadir elementos de menú',
	'ADD_BULK_MENU_EXPLAIN'		=> 'Añadir varios elementos de menú a la vez.<br /> - Coloca cada elemento en una línea separada<br /> - Usa la tecla <strong>Pestaña</strong> para sangrar los elementos para representar las relaciones parentales<br /> - Ingresa el elemento y la URL así: Home|index.php',
	'ADD_MENU'					=> 'Añadir menú',
	'ADD_MENU_ITEM'				=> 'Añadir elemento de menú',
	'ADD_ITEM'					=> 'Añadir nuevo elemento',
	'AJAX_PROCESSING'			=> 'Trabajando',

	'CHANGE_ME'					=> 'Cambiarme',

	'DELETE_ITEM'				=> 'Eliminar elemento',
	'DELETE_KIDS'				=> 'Eliminar Rama',
	'DELETE_MENU'				=> 'Eliminar Menú',
	'DELETE_MENU_CONFIRM'		=> '¿Está seguro que desea eliminar este menú?<br />Esto eliminará el menú y todos sus elementos',
	'DELETE_MENU_ITEM'			=> 'Eliminar elemento',
	'DELETE_MENU_ITEM_CONFIRM'	=> '¿Está seguro que desea eliminar este elemento del menú?',
	'DELETE_SELECTED'			=> 'Eliminar Seleccionado',

	'EDIT_ITEM'					=> 'Editar elemento',

	'ITEM_ACTIVE'				=> 'Activo',
	'ITEM_INACTIVE'				=> 'Inactivo',
	'ITEM_PARENT'				=> 'Padre',
	'ITEM_TITLE'				=> 'Título del artículo',
	'ITEM_TITLE_EXPLAIN'		=> 'Establecer como \'-\' para divisor',
	'ITEM_TARGET'				=> 'Objetivo del artículo',
	'ITEM_URL'					=> 'URL del artículo',
	'ITEM_URL_EXPLAIN'			=> '- Dejar en blanco para los encabezamientos<br />- Los sitios externos deben comenzar con http(s)://, ftp://, //, etc',

	'MENU_ITEMS'				=> 'Ítems de menú',

	'NO_MENU_ITEMS'				=> 'No se han creado elementos de menú',
	'NO_PARENT'					=> 'No hay padre',

	'PROCESSING_ERROR'			=> 'Error de procesamiento',

	'REBUILD_TREE'				=> 'Reconstruir árbol',
	'REQUIRED'					=> 'Requerido',
	'REQUIRED_FIELDS'			=> '* Campos requeridos',

	'SAVE_CHANGES'				=> 'Guardar cambios',
	'SAVE'						=> 'Guardar',
	'SELECT_ALL'				=> 'Seleccionar todo',

	'TARGET_BLANK'				=> 'Página en blanco',
	'TARGET_PARENT'				=> 'Padre',

	'UNSAVED_CHANGES'			=> 'Tienes cambios sin guardar',

	'VISIT_PAGE'				=> 'Visitar página',
));
