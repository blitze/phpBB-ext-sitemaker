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
	'ACP_SM_SETTINGS'	=> 'Confirgurações',

	'BLOCKS_CLEANUP'			=> 'Limpar blocos',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'Os seguintes itens foram encontrados para não existirem mais ou serem inacessíveis, e você pode, portanto, excluir todos os blocos associados a eles. Tenha em mente que alguns destes podem ser falsos positivos',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Blocos inválidos (por exemplo, de extensões desinstaladas):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Páginas inalcançáveis/quebradas:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Estilos desinstalados (ids):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Blocos removidos com sucesso',

	'FORUM_INDEX_SETTINGS'			=> 'Configurações do Fórum Índice',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Estas configurações só se aplicam quando não há nenhuma página inicial definida',

	'HIDE'			=> 'Esconder',
	'HIDE_BIRTHDAY'	=> 'Ocultar seção de aniversário',
	'HIDE_LOGIN'	=> 'Ocultar caixa de entrada',
	'HIDE_ONLINE'	=> 'Ocultar a seção Whos online',

	'LAYOUT_BLOG'		=> 'Blogue',
	'LAYOUT_CUSTOM'		=> 'Personalizado',
	'LAYOUT_HOLYGRAIL'	=> 'Grave Sagrado',
	'LAYOUT_PORTAL'		=> 'Portal',
	'LAYOUT_PORTAL_ALT'	=> 'Portal (alternativo)',
	'LAYOUT_SETTINGS'	=> 'Definições de Distribuição',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Blocos do Sitemaker excluídos para falta de estilo com id %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Blocos do Sitemaker excluídos para páginas quebradas:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Blocos do Sitemaker inválidos excluídos:<br />%s',

	'NAVIGATION_SETTINGS'		=> 'Configurações de navegação',

	'SETTINGS_SAVED'			=> 'Suas configurações foram salvas',
	'SHOW'						=> 'Apresentar',
	'SHOW_FORUM_NAV'			=> 'Mostrar o "Fórum" na barra de navegação?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Quando uma página é definida como página inicial em vez do índice do fórum, devemos exibir o \'Fórum\' na barra de navegação',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Sim - com ícone:',
]);
