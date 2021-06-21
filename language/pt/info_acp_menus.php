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
	'ACP_MENU_MANAGE'			=> 'Gestão do Menu',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Aqui você pode criar e gerenciar menus do seu site',
	'ADD_BULK_MENU'				=> 'Adicionar itens de menu em massa',
	'ADD_BULK_MENU_EXPLAIN'		=> 'Adicionar múltiplos itens do menu de uma só vez.<br /> - Coloque cada item em uma linha separada<br /> - Use a tecla <strong>Tab</strong> para representar itens de relacionamento pai<br /> - Digite item e URL da seguinte forma: Home➲ index.php',
	'ADD_MENU'					=> 'Adicionar Menu',
	'ADD_MENU_ITEM'				=> 'Adicionar Item de Menu',
	'ADD_ITEM'					=> 'Adicionar novo item',
	'AJAX_PROCESSING'			=> 'Trabalhando',

	'CHANGE_ME'					=> 'Alterar para mim',

	'DELETE_ITEM'				=> 'Excluir Item',
	'DELETE_KIDS'				=> 'Excluir branch',
	'DELETE_MENU'				=> 'Excluir Menu',
	'DELETE_MENU_CONFIRM'		=> 'Tem certeza que deseja excluir este menu?<br />Isto irá excluir o menu e todos os seus itens',
	'DELETE_MENU_ITEM'			=> 'Excluir Item',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Tem certeza que deseja excluir este item de menu?',
	'DELETE_SELECTED'			=> 'Excluir Selecionados',

	'EDIT_ITEM'					=> 'Editar Item',

	'ITEM_ACTIVE'				=> 'ativo',
	'ITEM_INACTIVE'				=> 'Inativo',
	'ITEM_PARENT'				=> 'Antecessor',
	'ITEM_TITLE'				=> 'Título do Item',
	'ITEM_TITLE_EXPLAIN'		=> 'Definir como "-" para o divisor',
	'ITEM_TARGET'				=> 'Item Target',
	'ITEM_URL'					=> 'URL do item',
	'ITEM_URL_EXPLAIN'			=> '- Deixar vazio para cabeçalhos<br />- Sites externos devem começar com http(s)://, ftp://, //, etc',

	'MENU_ITEMS'				=> 'Itens do menu',

	'NO_MENU_ITEMS'				=> 'Nenhum item de menu foi criado',
	'NO_PARENT'					=> 'Sem pai',

	'PROCESSING_ERROR'			=> 'Erro de processamento',

	'REBUILD_TREE'				=> 'Reconstruir a Árvore',
	'REQUIRED'					=> 'Obrigatório',
	'REQUIRED_FIELDS'			=> '* Campos obrigatórios',

	'SAVE_CHANGES'				=> 'Salvar as alterações',
	'SAVE'						=> 'Guardar',
	'SELECT_ALL'				=> 'Selecionar Todos',

	'TARGET_BLANK'				=> 'Página em branco',
	'TARGET_PARENT'				=> 'Antecessor',

	'UNSAVED_CHANGES'			=> 'Você tem alterações não salvas',

	'VISIT_PAGE'				=> 'Visitar página',
));
