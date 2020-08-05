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
	'ACP_SM_SETTINGS'	=> 'Configurações',

	'BLOCKS_CLEANUP'			=> 'Limpeza de blocos',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'Os seguintes itens não foram encontrados mais ou inacessíveis, e você pode, portanto, excluir todos os blocos associados a eles. Por favor, tenha em mente que alguns destes podem ser falsos positivos',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Blocos inválidos (ex. de extensões desinstaladas):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Páginas inalcançáveis/quebradas:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Estilos desinstalados (ids):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Blocos purgados com sucesso',

	'FILEMANAGER_SETTINGS'						=> 'Configurações do Gerenciador de Arquivos',
	'FILEMANAGER_STATUS'						=> 'Situação',
	'FILEMANAGER_NO_EXIST'						=> 'You will need to install the File Manager before you can enable it. Installation instructions are found <a href="%s" target="_blank"  rel="noopener noreferrer"><strong>here</strong></a>',
	'FILEMANAGER_NOT_WRITABLE'					=> 'File manager config folder (root/ResponsiveFilemanager/filemanager/config/) is not writable. Please change the permissions to writable by all (777 or -rwxrwxrwx within your FTP Client)',
	'FILEMANAGER_IMAGE_AUTO_RESIZE'				=> 'Redimensionar automaticamente as imagens carregadas?',
	'FILEMANAGER_IMAGE_AUTO_RESIZE_DIMENSIONS'	=> 'Redimensionar para dimensões especificadas',
	'FILEMANAGER_IMAGE_AUTO_RESIZING_MODE'		=> 'Modo redimensionamento automático',
	'FILEMANAGER_IMAGE_MAX_DIMENSIONS'			=> 'Tamanho máximo da imagem',
	'FILEMANAGER_IMAGE_MAX_MODE'				=> 'Modo máx. de tamanho de imagem',
	'FILEMANAGER_IMAGE_MODE_EXPLAIN'			=> 'Usado para calcular a altura/largura se você fornecer apenas altura ou largura mas não ambos acima',
	'FILEMANAGER_IMAGE_MODE_AUTO'				=> 'Sex',
	'FILEMANAGER_IMAGE_MODE_CROP'				=> 'Cortar',
	'FILEMANAGER_IMAGE_MODE_EXACT'				=> 'Exata',
	'FILEMANAGER_IMAGE_MODE_LANDSCAPE'			=> 'Paisagem',
	'FILEMANAGER_IMAGE_MODE_PORTRAIT'			=> 'Retrato',
	'FILEMANAGER_WATERMARK'						=> 'Marca d\'água',
	'FILEMANAGER_WATERMARK_EXPLAIN'				=> 'URL da imagem para usar como marca d\'água em todas as imagens carregadas',
	'FILEMANAGER_WATERMARK_POSITION'			=> 'Posição da marca d\'água',
	'FILEMANAGER_WATERMARK_POSITION_EXPLAIN'	=> 'Selecione uma posição pré-determinada onde a marca d\'água deve aparecer ou insira as coordenadas por exemplo, 50x100',
	'FILEMANAGER_WATERMARK_POSITION_TL'			=> 'Topo Esquerdo',
	'FILEMANAGER_WATERMARK_POSITION_T'			=> 'Topo',
	'FILEMANAGER_WATERMARK_POSITION_TR'			=> 'Superior Direito',
	'FILEMANAGER_WATERMARK_POSITION_L'			=> 'Saiu',
	'FILEMANAGER_WATERMARK_POSITION_M'			=> 'Média',
	'FILEMANAGER_WATERMARK_POSITION_R'			=> 'Direita',
	'FILEMANAGER_WATERMARK_POSITION_BL'			=> 'Inferior Esquerdo',
	'FILEMANAGER_WATERMARK_POSITION_B'			=> 'Abaixo',
	'FILEMANAGER_WATERMARK_POSITION_BR'			=> 'Inferior Direito',
	'FILEMANAGER_WATERMARK_POSITION_SUFFIX'		=> 'ou',
	'FILEMANAGER_WATERMARK_PADDING'				=> 'Marca d\'água',
	'FILEMANAGER_WATERMARK_PADDING_EXPLAIN'		=> 'Se estiver usando uma posição pré-determinada você pode ajustar a adição das bordas. Se usar coordenados, este valor é ignorado',

	'FORUM_INDEX_SETTINGS'			=> 'Configurações de Índice do Fórum',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Estas configurações só se aplicam quando não há nenhuma página inicial definida',

	'HIDE'			=> 'Ocultar',
	'HIDE_BIRTHDAY'	=> 'Ocultar seção de aniversário',
	'HIDE_LOGIN'	=> 'Ocultar caixa de login',
	'HIDE_ONLINE'	=> 'Esconder o Whos on-line',

	'LAYOUT_BLOG'		=> 'Blog',
	'LAYOUT_CUSTOM'		=> 'Personalizado',
	'LAYOUT_HOLYGRAIL'	=> 'Grau Sagrado',
	'LAYOUT_PORTAL'		=> 'Portal',
	'LAYOUT_PORTAL_ALT'	=> 'Portal (alt)',
	'LAYOUT_SETTINGS'	=> 'Definições de layout',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Blocos de Criador de Sitemaker apagados por falta de estilo com id %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Blocos de Criador de Sites excluídos para páginas quebradas:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Blocos inválidos eliminados:<br />%s',

	'NAVIGATION_SETTINGS'	=> 'Configurações de navegação',
	'NO_NAVBAR'				=> 'Nenhum',

	'SELECT_NAVBAR_MENU'		=> 'Selecione o menu de navegação principal',
	'SETTINGS_SAVED'			=> 'Suas configurações foram salvas',
	'SHOW'						=> 'Mostrar',
	'SHOW_FORUM_NAV'			=> 'Mostrar \'Fórum\' na barra de navegação?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Quando uma página é definida como página inicial em vez do índice do fórum, devemos exibir \'Fórum\' na barra de navegação',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Sim - com ícone:',
]);
