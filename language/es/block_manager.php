<?php

/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2012 Daniel A. (blitze)
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

$lang = array_merge($lang, array(
	'ADD_BLOCK_EXPLAIN'							=> '* Arrastrar y soltar bloques',
	'AJAX_ERROR'								=> '¡Uy! Hubo un error al procesar su solicitud. Por favor, inténtelo de nuevo.',
	'AJAX_LOADING'								=> 'Cargando...',
	'AJAX_PROCESSING'							=> 'Trabajando...',

	'BACKGROUND'								=> 'Fondo',
	'BLOCKS'									=> 'Bloques',
	'BLOCKS_COPY_FROM'							=> 'Copiar Bloques',
	'BLOCK_ACTIVE'								=> 'Activo',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Mostrar solo en rutas secundarias',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Ocultar en rutas secundarias',
	'BLOCK_CLASS'								=> 'Clase CSS',
	'BLOCK_CLASS_EXPLAIN'						=> 'Modificar la apariencia del bloque con clases CSS',
	'BLOCK_DESIGN'								=> 'Apariencia',
	'BLOCK_DISPLAY_TYPE'						=> 'Mostrar',
	'BLOCK_HIDE_TITLE'							=> '¿Ocultar título del bloque?',
	'BLOCK_INACTIVE'							=> 'Inactivo',
	'BLOCK_MISSING_TEMPLATE'					=> 'Falta la plantilla de bloque requerida. Póngase en contacto con el desarrollador',
	'BLOCK_NOT_FOUND'							=> '¡Uy! No se encontró el servicio de bloqueo solicitado',
	'BLOCK_NO_DATA'								=> 'No hay datos para mostrar',
	'BLOCK_NO_ID'								=> '¡Uy! Faltan id de bloque',
	'BLOCK_PERMISSION'							=> 'Permiso',
	'BLOCK_PERMISSION_ALLOW'					=> 'Mostrar a',
	'BLOCK_PERMISSION_DENY'						=> 'Ocultar de',
	'BLOCK_PERMISSION_EXPLAIN'					=> 'Usar CTRL + clic para alternar la selección',
	'BLOCK_SHOW_ALWAYS'							=> 'Siempre',
	'BLOCK_STATUS'								=> 'Estado',
	'BLOCK_UPDATED'								=> 'Configuración del bloque actualizada correctamente',

	'CANCEL'									=> 'Cancelar',
	'CHILD_ROUTE'								=> 'Hijo',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/my-article',
	'CLEAR'										=> 'Limpiar',
	'COPY'										=> 'Copiar',
	'COPY_BLOCKS'								=> '¿Copiar bloques?',
	'COPY_BLOCKS_CONFIRM'						=> '¿Estás seguro de que quieres copiar bloques de otra página?<br /><br />Esto eliminará todos los bloques existentes y sus ajustes para esta página y los reemplazará con los bloques de la página seleccionada.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'Si se establece, todas las páginas del sitio para las que no haya especificado bloques heredarán los bloques del diseño por defecto. Sin embargo, puede reemplazar el diseño predeterminado para páginas en particular usando las opciones a la derecha.',
	'DELETE'									=> 'Eliminar',
	'DELETE_ALL_BLOCKS'							=> 'Borrar todos los bloques',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> '¿Está seguro que desea eliminar todos los bloques de esta página?',
	'DELETE_BLOCK'								=> 'Eliminar bloque',
	'DELETE_BLOCK_CONFIRM'						=> '¿Está seguro que desea eliminar este bloqueo?<br /><br /><br /><strong>Nota:</strong> Tendrás que guardar los cambios de diseño para hacer esto permanente.',

	'EDIT'										=> 'Editar',
	'EDIT_BLOCK'								=> 'Editar bloque',
	'EXIT_EDIT_MODE'							=> 'Salir del modo edición',

	'FEED_PROBLEMS'								=> 'Hubo un problema al procesar los rss/atom proporcionado(s)',
	'FEED_URL_MISSING'							=> 'Por favor proporciona al menos una fuente rss/atom para comenzar',
	'FIELD_INVALID'								=> 'El valor proporcionado para el campo “%s” tiene un formato no válido',
	'FIELD_REQUIRED'							=> '“%s” es un campo obligatorio',
	'FIELD_TOO_LONG'							=> 'El valor proporcionado para el campo “%1$s” es demasiado largo. El valor máximo aceptable es %2$d.',
	'FIELD_TOO_SHORT'							=> 'El valor proporcionado para el campo “%1$s” es demasiado corto. El valor mínimo aceptable es %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'No mostrar bloques en esta página',
	'HIDE_BLOCK_POSITIONS'						=> 'No mostrar bloques para las siguientes posiciones de bloque:',

	'IMAGES'									=> 'Imágenes',

	'LAYOUT'									=> 'Diseño',
	'LAYOUT_SAVED'								=> 'Diseño guardado con éxito!',
	'LAYOUT_SETTINGS'							=> 'Ajustes de diseño',
	'LEAVE_CONFIRM'								=> 'Tienes algunos cambios sin guardar en esta página. Por favor, guarda tu trabajo antes de moverte en',
	'LISTS'										=> 'Listas',

	'MAKE_DEFAULT_LAYOUT'						=> 'Establecer como diseño por defecto',

	'OR'										=> '<strong>O</strong>',

	'PARENT_ROUTE'								=> 'Padre',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/articles',
	'PREDEFINED_CLASSES'						=> 'Clases predefinidas',

	'REDO'										=> 'Rehacer',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Eliminar como diseño por defecto',
	'REMOVE_STARTPAGE'							=> 'Eliminar página de inicio',
	'ROUTE_HIDDEN_BLOCKS'						=> 'Los bloques se están ocultando para esta página',
	'ROUTE_HIDDEN_POSITIONS'					=> 'Los bloques se están ocultando para las siguientes posiciones',
	'ROUTE_UPDATED'								=> 'Configuración de página actualizada correctamente',

	'SAVE_CHANGES'								=> 'Guardar cambios',
	'SAVE_SETTINGS'								=> 'Guardar ajustes',
	'SELECT_ICON'								=> 'Seleccione un icono',
	'SETTINGS'									=> 'Preferencias',
	'SETTING_TOO_BIG'							=> 'El valor proporcionado para el ajuste “%1$s” es demasiado alto. El valor máximo aceptable es %2$d.',
	'SETTING_TOO_LONG'							=> 'El valor proporcionado para el ajuste “%1$s” es demasiado largo. La longitud máxima aceptable es %2$d.',
	'SETTING_TOO_LOW'							=> 'El valor proporcionado para el ajuste “%1$s” es demasiado bajo. El valor mínimo aceptable es %2$d.',
	'SETTING_TOO_SHORT'							=> 'El valor proporcionado para el ajuste “%1$s” es demasiado corto. La longitud mínima aceptable es %2$d.',
	'SET_STARTPAGE'								=> 'Establecer como página de inicio',

	'TITLES'									=> 'Títulos',

	'UPDATE_SIMILAR'							=> 'Actualizar bloques con ajustes similares',
	'UNDO'										=> 'Deshacer',

	'VIEW_DEFAULT_LAYOUT'						=> 'Ver/Editar diseño por defecto',
	'VISIT_PAGE'								=> 'Visitar página',
));
