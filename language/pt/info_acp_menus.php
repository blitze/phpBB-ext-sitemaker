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
	'ACP_MENU'					=> 'Menu',
	'ACP_MENU_MANAGE'			=> 'Gerenciamento de Menu',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Aqui você pode criar e gerenciar menus para o seu site',
	'ADD_BULK_MENU'				=> 'Itens de menu adicionados em massa',
	'ADD_BULK_MENU_EXPLAIN'		=> 'Add multiple menu items at once.<br /> - Place each item on a separate line<br /> - Use the <strong>Tab</strong> key to indent items to represent parent-child relationships<br /> - Enter item and URL like so: Home|index.php',
	'ADD_MENU'					=> 'Adicionar Menu',
	'ADD_MENU_ITEM'				=> 'Adicionar item de menu',
	'ADD_ITEM'					=> 'Adicionar Novo Item',
	'AJAX_PROCESSING'			=> 'Trabalhando',

	'CHANGE_ME'					=> 'Mude-me',

	'DELETE_ITEM'				=> 'Excluir Item',
	'DELETE_KIDS'				=> 'Excluir Branch',
	'DELETE_MENU'				=> 'Excluir Menu',
	'DELETE_MENU_CONFIRM'		=> 'Tem certeza que deseja excluir este menu?<br />Isto irá excluir o menu e todos os seus itens',
	'DELETE_MENU_ITEM'			=> 'Excluir Item',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Tem certeza que deseja excluir este item de menu?',
	'DELETE_SELECTED'			=> 'Excluir selecionados',

	'EDIT_ITEM'					=> 'Editar item',

	'ITEM_ACTIVE'				=> 'Ativo',
	'ITEM_INACTIVE'				=> 'Inativo',
	'ITEM_PARENT'				=> 'Pai',
	'ITEM_TITLE'				=> 'Título do Item',
	'ITEM_TITLE_EXPLAIN'		=> 'Definir como \'-\' para divisor',
	'ITEM_TARGET'				=> 'Alvo do Item',
	'ITEM_URL'					=> 'URL do item',
	'ITEM_URL_EXPLAIN'			=> '- Deixe vazio para os cabeçalhos<br />- Sites externos devem começar com http(s)://, ftp://, //, etc',

	'MENU_ITEMS'				=> 'Itens de menu',

	'NO_MENU_ITEMS'				=> 'Nenhum item de menu foi criado',
	'NO_PARENT'					=> 'Sem pai',

	'PROCESSING_ERROR'			=> 'Erro de processamento',

	'REBUILD_TREE'				=> 'Reconstruir Árvore',
	'REQUIRED'					=> 'Obrigatório',
	'REQUIRED_FIELDS'			=> '* Campos obrigatórios',

	'SAVE_CHANGES'				=> 'Salvar alterações',
	'SAVE'						=> 'Salvar',
	'SELECT_ALL'				=> 'Selecionar tudo',

	'TARGET_BLANK'				=> 'Página em branco',
	'TARGET_PARENT'				=> 'Pai',

	'UNSAVED_CHANGES'			=> 'Você tem alterações não salvas',

	'VISIT_PAGE'				=> 'Visitar página',
));
