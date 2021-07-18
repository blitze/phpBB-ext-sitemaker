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
	'ADD_BLOCK_EXPLAIN'							=> '*Arraste e solte blocos',
	'AJAX_ERROR'								=> 'Opa! Ocorreu um erro ao processar seu pedido. Por favor, tente novamente.',
	'AJAX_LOADING'								=> 'Carregandochar@@0',
	'AJAX_PROCESSING'							=> 'Trabalhando...',

	'BACKGROUND'								=> 'Fundo',
	'BLOCKS'									=> 'blocos',
	'BLOCKS_COPY_FROM'							=> 'Copiar Blocos',
	'BLOCK_ACTIVE'								=> 'ativo',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Mostrar apenas em rotas filhas',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Ocultar em rotas filhas',
	'BLOCK_CLASS'								=> 'Classe CSS',
	'BLOCK_CLASS_EXPLAIN'						=> 'Modificar a aparência do bloco com classes CSS',
	'BLOCK_DESIGN'								=> 'Aparência',
	'BLOCK_DISPLAY_TYPE'						=> 'Visualização',
	'BLOCK_HIDE_TITLE'							=> 'Ocultar o título do bloco?',
	'BLOCK_INACTIVE'							=> 'Inativo',
	'BLOCK_MISSING_TEMPLATE'					=> 'Falta o modelo de bloco necessário. Entre em contato com o desenvolvedor',
	'BLOCK_NOT_FOUND'							=> 'Opa! O serviço de bloco solicitado não foi encontrado',
	'BLOCK_NO_DATA'								=> 'Nenhum dado para exibir',
	'BLOCK_NO_ID'								=> 'Opa! ID do bloco ausente',
	'BLOCK_PERMISSION'							=> 'Permisschar@@0o',
	'BLOCK_PERMISSION_ALLOW'					=> 'Mostrar para',
	'BLOCK_PERMISSION_DENY'						=> 'Ocultar de',
	'BLOCK_PERMISSION_EXPLAIN'					=> 'Use CTRL + clique para alternar a seleção',
	'BLOCK_SHOW_ALWAYS'							=> 'sempre',
	'BLOCK_STATUS'								=> 'SItuação',
	'BLOCK_UPDATED'								=> 'Configurações do bloco atualizadas com sucesso',

	'CANCEL'									=> 'cancelar',
	'CHILD_ROUTE'								=> 'Filho(a)',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/meu-artigo',
	'CLEAR'										=> 'Limpar',
	'COPY'										=> 'copiar',
	'COPY_BLOCKS'								=> 'Copiar Blocos?',
	'COPY_BLOCKS_CONFIRM'						=> 'Você tem certeza que gostaria de copiar blocos de outra página?<br /><br />Isto irá apagar todos os blocos existentes e suas configurações para esta página e substituí-los pelos blocos da página selecionada.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'Se definido, todas as páginas do site para as quais você não tem blocos especificados herdarão os blocos do layout padrão. No entanto, você pode substituir o layout padrão para páginas específicas usando as opções à direita.',
	'DELETE'									=> 'excluir',
	'DELETE_ALL_BLOCKS'							=> 'Excluir Todos os Blocos',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'Tem certeza que deseja excluir todos os blocos desta página?',
	'DELETE_BLOCK'								=> 'Excluir Bloco',
	'DELETE_BLOCK_CONFIRM'						=> 'Tem certeza que deseja excluir este bloco?<br /><br /><br /><strong>Nota:</strong> Você terá que salvar as alterações no layout para tornar isso permanente.',

	'EDIT'										=> 'Alterar',
	'EDIT_BLOCK'								=> 'Editar Bloco',
	'EXIT_EDIT_MODE'							=> 'Sair do modo de edição',

	'FEED_PROBLEMS'								=> 'Houve um problema ao processar o rss/combo fornecido(s)',
	'FEED_URL_MISSING'							=> 'Por favor, forneça pelo menos um rss/atom-feed para começar',
	'FIELD_INVALID'								=> 'O valor fornecido para o campo “%s” tem um formato inválido',
	'FIELD_REQUIRED'							=> '“%s” é um campo obrigatório',
	'FIELD_TOO_LONG'							=> 'O valor fornecido para o campo “%1$s” é muito longo. O valor máximo aceitável é %2$d.',
	'FIELD_TOO_SHORT'							=> 'O valor fornecido para o campo “%1$s” é muito curto. O valor mínimo aceitável é %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'Não mostrar blocos nesta página',
	'HIDE_BLOCK_POSITIONS'						=> 'Não mostrar blocos para as seguintes posições de bloco:',

	'IMAGES'									=> 'Imagens',

	'LAYOUT'									=> 'Disposição',
	'LAYOUT_SAVED'								=> 'Layout salvo com sucesso!',
	'LAYOUT_SETTINGS'							=> 'Definições de Distribuição',
	'LEAVE_CONFIRM'								=> 'Você tem algumas alterações não salvas nesta página. Por favor, salve seu trabalho antes de seguir em frente',
	'LISTS'										=> 'Listas',

	'MAKE_DEFAULT_LAYOUT'						=> 'Definir como Layout Padrão',

	'OR'										=> '<strong>OU</strong>',

	'PARENT_ROUTE'								=> 'Antecessor',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/artigos',
	'PREDEFINED_CLASSES'						=> 'Classes predefinidas',

	'REDO'										=> 'Refazer',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Remover como Layout Padrão',
	'REMOVE_STARTPAGE'							=> 'Remover Página Inicial',
	'ROUTE_HIDDEN_BLOCKS'						=> 'Os blocos estão sendo ocultos para esta página',
	'ROUTE_HIDDEN_POSITIONS'					=> 'Os blocos estão sendo ocultados para as seguintes posições',
	'ROUTE_UPDATED'								=> 'Configurações da página atualizadas com sucesso',

	'SAVE_CHANGES'								=> 'Salvar as alterações',
	'SAVE_SETTINGS'								=> 'Salvar Configurações',
	'SELECT_ICON'								=> 'Selecione um ícone',
	'SETTINGS'									=> 'Confirgurações',
	'SETTING_TOO_BIG'							=> 'O valor fornecido para a configuração "%1$s" é muito alto. O valor máximo aceitável é %2$d.',
	'SETTING_TOO_LONG'							=> 'O valor fornecido para a configuração “%1$s” é muito longo. O comprimento máximo aceitável é %2$d.',
	'SETTING_TOO_LOW'							=> 'O valor fornecido para a configuração “%1$s” é muito baixo. O valor mínimo aceitável é “ %2$d.',
	'SETTING_TOO_SHORT'							=> 'O valor fornecido para a configuração “%1$s” é muito curto. A extensão mínima aceitável é %2$d.',
	'SET_STARTPAGE'								=> 'Definir como página inicial',

	'TITLES'									=> 'Títulos',

	'UPDATE_SIMILAR'							=> 'Atualizar blocos com configurações similares',
	'UNDO'										=> 'Desfazer',

	'VIEW_DEFAULT_LAYOUT'						=> 'Visualizar/Editar Layout Padrão',
	'VISIT_PAGE'								=> 'Visitar página',
));
