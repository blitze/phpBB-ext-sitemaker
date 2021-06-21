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
	'AJAX_ERROR'								=> 'Oops! Houve um erro ao processar seu pedido. Por favor, tente novamente.',
	'AJAX_LOADING'								=> 'Carregando...',
	'AJAX_PROCESSING'							=> 'Trabalhando...',

	'BACKGROUND'								=> 'Fundo',
	'BLOCKS'									=> 'Blocos',
	'BLOCKS_COPY_FROM'							=> 'Copiar Blocos',
	'BLOCK_ACTIVE'								=> 'Ativo',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Mostrar apenas nas rotas descendentes',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Esconder nas rotas filhos',
	'BLOCK_CLASS'								=> 'Classe CSS',
	'BLOCK_CLASS_EXPLAIN'						=> 'Modificar a aparência do bloco com classes CSS',
	'BLOCK_DESIGN'								=> 'Aparência',
	'BLOCK_DISPLAY_TYPE'						=> 'Exibir',
	'BLOCK_HIDE_TITLE'							=> 'Ocultar título do bloco?',
	'BLOCK_INACTIVE'							=> 'Inativo',
	'BLOCK_MISSING_TEMPLATE'					=> 'Missing required block template. Please contact developer',
	'BLOCK_NOT_FOUND'							=> 'Ops! O serviço de bloqueio solicitado não foi encontrado',
	'BLOCK_NO_DATA'								=> 'Sem dados para exibir',
	'BLOCK_NO_ID'								=> 'Oops! Falta id do bloco',
	'BLOCK_PERMISSION'							=> 'Permission',
	'BLOCK_PERMISSION_ALLOW'					=> 'Show to',
	'BLOCK_PERMISSION_DENY'						=> 'Hide from',
	'BLOCK_PERMISSION_EXPLAIN'					=> 'Use CTRL + click to toggle selection',
	'BLOCK_SHOW_ALWAYS'							=> 'Sempre',
	'BLOCK_STATUS'								=> 'Situação',
	'BLOCK_UPDATED'								=> 'Configurações do bloco atualizadas com sucesso',

	'CANCEL'									=> 'Cancelar',
	'CHILD_ROUTE'								=> 'Filho',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/my-article',
	'CLEAR'										=> 'Limpar',
	'COPY'										=> 'Copiar',
	'COPY_BLOCKS'								=> 'Copiar Blocos?',
	'COPY_BLOCKS_CONFIRM'						=> 'Tem certeza que deseja copiar os blocos de outra página?<br /><br />Isto irá apagar todos os blocos existentes e suas configurações para esta página e substituí-los pelos blocos da página selecionada.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'Se definido, todas as páginas do site para as quais você não especificou blocos herdarão os blocos a partir do layout padrão. No entanto, você pode substituir o layout padrão para páginas específicas usando as opções à direita.',
	'DELETE'									=> 'Excluir',
	'DELETE_ALL_BLOCKS'							=> 'Excluir Todos os Blocos',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'Tem certeza que deseja excluir todos os blocos desta página?',
	'DELETE_BLOCK'								=> 'Excluir Bloco',
	'DELETE_BLOCK_CONFIRM'						=> 'Tem certeza que deseja excluir este bloco?<br /><br /><br /><strong>Nota:</strong> Você terá que salvar as alterações de layout para tornar isto permanente.',

	'EDIT'										=> 'Editar',
	'EDIT_BLOCK'								=> 'Editar Bloco',
	'EXIT_EDIT_MODE'							=> 'Sair do Modo de Edição',

	'FEED_PROBLEMS'								=> 'Houve um problema ao processar a fonte de rss/atom fornecida(s)',
	'FEED_URL_MISSING'							=> 'Por favor, forneça pelo menos um feed rss/atom para começar',
	'FIELD_INVALID'								=> 'O valor fornecido para o campo "%s" tem um formato inválido',
	'FIELD_REQUIRED'							=> '"%s" é um campo obrigatório',
	'FIELD_TOO_LONG'							=> 'O valor fornecido para o campo "%1$s" é muito longo. O valor máximo aceitável é %2$d.',
	'FIELD_TOO_SHORT'							=> 'O valor fornecido para o campo "%1$s" é muito curto. O valor mínimo aceitável é %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'Não mostrar blocos nesta página',
	'HIDE_BLOCK_POSITIONS'						=> 'Não mostrar blocos para as seguintes posições de bloco:',

	'IMAGES'									=> 'Imagens',

	'LAYOUT'									=> 'Layout',
	'LAYOUT_SAVED'								=> 'Layout salvo com sucesso!',
	'LAYOUT_SETTINGS'							=> 'Definições de layout',
	'LEAVE_CONFIRM'								=> 'Você tem algumas alterações não salvas nesta página. Por favor, salve seu trabalho antes de continuar',
	'LISTS'										=> 'Listas',

	'MAKE_DEFAULT_LAYOUT'						=> 'Definir como Layout Padrão',

	'OR'										=> '<strong>OU</strong>',

	'PARENT_ROUTE'								=> 'Pai',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/artigos',
	'PREDEFINED_CLASSES'						=> 'Classes predefinidas',

	'REDO'										=> 'Refazer',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Remover como Layout Padrão',
	'REMOVE_STARTPAGE'							=> 'Remover página inicial',
	'ROUTE_HIDDEN_BLOCKS'						=> 'Blocos estão sendo escondidos para esta página',
	'ROUTE_HIDDEN_POSITIONS'					=> 'Blocos estão sendo escondidos para as seguintes posições',
	'ROUTE_UPDATED'								=> 'Configurações da página atualizadas com sucesso',

	'SAVE_CHANGES'								=> 'Salvar alterações',
	'SAVE_SETTINGS'								=> 'Salvar configurações',
	'SELECT_ICON'								=> 'Selecione um Ícone',
	'SETTINGS'									=> 'Configurações',
	'SETTING_TOO_BIG'							=> 'O valor fornecido para a configuração "%1$s" é muito alto. O valor máximo aceitável é %2$d.',
	'SETTING_TOO_LONG'							=> 'O valor fornecido para a configuração "%1$s" é muito longo. O comprimento máximo aceitável é %2$d.',
	'SETTING_TOO_LOW'							=> 'O valor fornecido para a configuração "%1$s" é muito baixo. O valor mínimo aceitável é %2$d.',
	'SETTING_TOO_SHORT'							=> 'O valor fornecido para a configuração "%1$s" é muito curto. O comprimento mínimo aceitável é %2$d.',
	'SET_STARTPAGE'								=> 'Definir como Página Inicial',

	'TITLES'									=> 'Títulos',

	'UPDATE_SIMILAR'							=> 'Atualizar blocos com configurações similares',
	'UNDO'										=> 'Desfazer',

	'VIEW_DEFAULT_LAYOUT'						=> 'Visualizar/Editar Layout Padrão',
	'VISIT_PAGE'								=> 'Visitar página',
));
