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

	'NAVIGATION_SETTINGS'		=> 'Ajustes de navegación',

	'SETTINGS_SAVED'			=> 'La configuración ha sido guardada',
	'SHOW'						=> 'Mostrar',
	'SHOW_FORUM_NAV'			=> '¿Mostrar \'Foro\' en la barra de navegación?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Cuando una página se establece como página de inicio en lugar del índice del foro, debería mostrar \'Foro\' en la barra de navegación',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Sí - con icono:',
]);
