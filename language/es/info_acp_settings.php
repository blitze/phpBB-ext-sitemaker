<?php

/**
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	$lang = [];
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

$lang = array_merge($lang, [
	'ACP_SITEMAKER'		=> 'SiteMaker',
	'ACP_SM_SETTINGS'	=> 'Preferencias',

	'BLOCKS_CLEANUP'			=> 'Limpieza de bloques',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'Se han encontrado los siguientes elementos que ya no existen o inalcanzables, por lo que puedes eliminar todos los bloques asociados a ellos. Por favor, tenga en cuenta que algunos de estos pueden ser falsos positivos',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Bloques no válidos (por ejemplo, de extensiones desinstaladas):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Páginas inalcanzables/rotas:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Estilos desinstalados (ids):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Bloques eliminados con éxito',

	'FILEMANAGER_SETTINGS'						=> 'Configuración del Administrador de Archivos',
	'FILEMANAGER_STATUS'						=> 'Estado',
	'FILEMANAGER_NO_EXIST'						=> 'You will need to install the File Manager before you can enable it. Installation instructions are found <a href="%s" target="_blank"  rel="noopener noreferrer"><strong>here</strong></a>',
	'FILEMANAGER_NOT_WRITABLE'					=> 'File manager config folder (root/ResponsiveFilemanager/filemanager/config/) is not writable. Please change the permissions to writable by all (777 or -rwxrwxrwx within your FTP Client)',
	'FILEMANAGER_IMAGE_AUTO_RESIZE'				=> '¿Redimensionar automáticamente las imágenes subidas?',
	'FILEMANAGER_IMAGE_AUTO_RESIZE_DIMENSIONS'	=> 'Redimensionar a dimensiones especificadas',
	'FILEMANAGER_IMAGE_AUTO_RESIZING_MODE'		=> 'Modo redimensionado automático',
	'FILEMANAGER_IMAGE_MAX_DIMENSIONS'			=> 'Tamaño máximo de imagen',
	'FILEMANAGER_IMAGE_MAX_MODE'				=> 'Modo máximo de tamaño de imagen',
	'FILEMANAGER_IMAGE_MODE_EXPLAIN'			=> 'Utilizado para calcular la altura/anchura si sólo proporciona altura o ancho, pero no ambos por encima',
	'FILEMANAGER_IMAGE_MODE_AUTO'				=> 'Auto',
	'FILEMANAGER_IMAGE_MODE_CROP'				=> 'Recortar',
	'FILEMANAGER_IMAGE_MODE_EXACT'				=> 'Exacto',
	'FILEMANAGER_IMAGE_MODE_LANDSCAPE'			=> 'Horizontal',
	'FILEMANAGER_IMAGE_MODE_PORTRAIT'			=> 'Retrato',
	'FILEMANAGER_WATERMARK'						=> 'Marca de agua',
	'FILEMANAGER_WATERMARK_EXPLAIN'				=> 'URL de la imagen a utilizar como marca de agua en todas las imágenes subidas',
	'FILEMANAGER_WATERMARK_POSITION'			=> 'Posición de la marca de agua',
	'FILEMANAGER_WATERMARK_POSITION_EXPLAIN'	=> 'Seleccione una posición predeterminada donde la marca de agua debe aparecer o introduzca las coordenadas, por ejemplo, 50x100',
	'FILEMANAGER_WATERMARK_POSITION_TL'			=> 'Arriba izquierda',
	'FILEMANAGER_WATERMARK_POSITION_T'			=> 'Arriba',
	'FILEMANAGER_WATERMARK_POSITION_TR'			=> 'Arriba derecha',
	'FILEMANAGER_WATERMARK_POSITION_L'			=> 'Falta',
	'FILEMANAGER_WATERMARK_POSITION_M'			=> 'Medio',
	'FILEMANAGER_WATERMARK_POSITION_R'			=> 'Derecha',
	'FILEMANAGER_WATERMARK_POSITION_BL'			=> 'Abajo izquierdo',
	'FILEMANAGER_WATERMARK_POSITION_B'			=> 'Abajo',
	'FILEMANAGER_WATERMARK_POSITION_BR'			=> 'Abajo Derecha',
	'FILEMANAGER_WATERMARK_POSITION_SUFFIX'		=> 'o',
	'FILEMANAGER_WATERMARK_PADDING'				=> 'Relleno de marca de agua',
	'FILEMANAGER_WATERMARK_PADDING_EXPLAIN'		=> 'Si utiliza una posición predeterminada puede ajustar el relleno desde los bordes. Si utiliza coordenadas, este valor es ignorado',

	'FORUM_INDEX_SETTINGS'			=> 'Configuración de índice del foro',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Estos ajustes sólo se aplican cuando no hay ninguna página de inicio definida',

	'HIDE'			=> 'Ocultar',
	'HIDE_BIRTHDAY'	=> 'Ocultar sección de cumpleaños',
	'HIDE_LOGIN'	=> 'Ocultar login box',
	'HIDE_ONLINE'	=> 'Ocultar la sección en línea Whos',

	'LAYOUT_BLOG'		=> 'Blog',
	'LAYOUT_CUSTOM'		=> 'Personalizado',
	'LAYOUT_HOLYGRAIL'	=> 'Santo Grial',
	'LAYOUT_PORTAL'		=> 'Portal',
	'LAYOUT_PORTAL_ALT'	=> 'Portal (alto)',
	'LAYOUT_SETTINGS'	=> 'Ajustes de diseño',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Bloques del Sitemaker eliminados por falta de estilo con id %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Bloques del Sitemaker eliminados para páginas dañadas:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Bloques de Sitemaker inválidos eliminados:<br />%s',

	'NAVIGATION_SETTINGS'	=> 'Ajustes de navegación',
	'NO_NAVBAR'				=> 'Ninguno',

	'SELECT_NAVBAR_MENU'		=> 'Seleccionar menú principal de navegación',
	'SETTINGS_SAVED'			=> 'La configuración ha sido guardada',
	'SHOW'						=> 'Mostrar',
	'SHOW_FORUM_NAV'			=> '¿Mostrar \'Foro\' en la barra de navegación?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Cuando una página se establece como página de inicio en lugar del índice del foro, debería mostrar \'Foro\' en la barra de navegación',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Sí - con icono:',
]);
