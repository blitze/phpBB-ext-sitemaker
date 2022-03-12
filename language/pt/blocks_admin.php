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
	'ALL_TYPES'									=> 'Todos os tipos',
	'ALL_GROUPS'								=> 'Todos os Grupos',
	'ARCHIVES'									=> 'Arquivos',
	'AUTO_LOGIN'								=> 'Permitir login automático?',
	'FILE_MANAGER'								=> 'Gerenciador de Arquivos',
	'TOPIC_POST_IDS'							=> 'Do Tópico/Publicar Identificações',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(s) de tópicos/postagens para recuperar anexos, separados por <strong>vírgulas</strong>(,). Especifique se esta lista é para tópicos ou IDs de postagens acima.',
	'TOPIC_POST_IDS_TYPE'						=> 'Tipo de IDs (abaixo)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Anexos',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Aniversário',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Bloco personalizado',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Membro em destaque',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'RSS/Atom Feed',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Fórum da Enquete',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Tópicos do fórum',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Google Maps',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Tópicos Populares',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Links',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Caixa de Entrada',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'membros',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Menu de Membro',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Menu',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Meus Favoritos',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Tópicos Recentes',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'estatísticas',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Alternador de estilo',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Quais as novidades?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Quem está online',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Wordgraph',

	// block views
	'BLOCK_VIEW'								=> 'Visualização de Bloco',
	'BLOCK_VIEW_BASIC'							=> 'Básico',
	'BLOCK_VIEW_BOXED'							=> 'Encaixado',
	'BLOCK_VIEW_DEFAULT'						=> 'Padrão',
	'BLOCK_VIEW_SIMPLE'							=> 'Simples',

	'CACHE_DURATION'							=> 'Duração do cache',
	'CONTEXT'									=> 'Contexto',
	'CSS_SCRIPTS'								=> 'CSS Scripts',
	'CUSTOM_PROFILE_FIELDS'						=> 'Campos de perfil personalizados',

	'DATE_RANGE'								=> 'Date Range',
	'DISPLAY_PREVIEW'							=> 'Exibir pré-visualização?',

	'EDIT_ME'									=> 'Por favor, edite-me',
	'ENABLE_TOPIC_TRACKING'						=> 'Ativar rastreamento do tópico?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Se ativado, tópicos não lidos serão indicados, mas os resultados do bloco não serão armazenados em cache <strong>(não recomendado)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Você inseriu muitas palavras para excluir. O número máximo de caracteres possível é 255, você digitou %s.',
	'EXCLUDE_WORDS'								=> 'Excluir palavras',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Liste as palavras que você gostaria de excluir do wordgraph separados por vírgula (,). Máximo de 255 caracteres.',
	'EXPANDED'									=> 'Expandido',
	'EXTENSION_GROUP'							=> 'Grupo de extensão',

	'FEATURED_MEMBER_IDS'						=> 'IDs de usuário',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Lista separada por vírgulas de usuários em destaque (aplica-se apenas ao modo de exibição de membros em destaque)',
	'FEED_DATA_PREVIEW'							=> 'Dados do Feed',
	'FEED_ITEM_TEMPLATE'						=> 'Modelo de Item',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS:</strong><br />
		<ul class="sm-list">
			<li>Access feed data in <strong>item</strong> variable e.g. item.title</li>
			<li>Template must be in <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Twig syntax</a></li>
			<li>Click <strong>Samples</strong> above for sample templates</li>
			<li>Use <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> to get any tag from the feed that we do not provide e.g.<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<li>Use Twig’s json_encode filter to see contents of array e.g. <strong><code>{{ get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'fonte',
	'FEED_URL_PLACEHOLDER'						=> 'http://exemplo.com/rss',
	'FEED_URLS'									=> 'URLs do feed',
	'FIRST_POST_ONLY'							=> 'Apenas primeira publicação',
	'FIRST_POST_TIME'							=> 'Horário da primeira postagem',
	'FORUMS_GET_TYPE'							=> 'Pegar tipo',
	'FORUMS_MAX_TOPICS'							=> 'Máximo de tópicos/postagens',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Máximo de caracteres por título',
	'FREQUENCY'									=> 'Frequência',
	'FULL'										=> 'Completo',
	'FULLSCREEN'								=> 'Tela cheia',

	'GET_TYPE'									=> 'Exibir tópico/postar?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Use este textarea para inserir conteúdo HTML bruto.</strong><br />Por favor, note que qualquer conteúdo publicado aqui irá sobrescrever o conteúdo do bloco personalizado e o editor de bloco visual não estará disponível.',
	'HOURS_SHORT'								=> 'h',

	'JS_SCRIPTS'								=> 'Scripts JS',

	'LAST_POST_TIME'							=> 'Hora da Última Postagem',
	'LAST_READ_TIME'							=> 'Último horário de leitura',
	'LIMIT'										=> 'Limitar',
	'LIMIT_FORUMS'								=> 'Id do fórum (opcional)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Insira cada id de fórum separado por uma vírgula (,). Se definido, apenas tópicos de fóruns específicos serão exibidos.',
	'LIMIT_POST_TIME'							=> 'Limite por tempo da postagem',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Se definido, apenas tópicos postados dentro do período especificado serão recuperados',

	'MAX_DEPTH'									=> 'Profundidade máxima',
	'MAX_ITEMS'									=> 'Número máximo de itens',
	'MAX_MEMBERS'								=> 'Máximo de membros',
	'MAX_POSTS'									=> 'Número máximo de postagens',
	'MAX_TOPICS'								=> 'Número máximo de tópicos',
	'MAX_WORDS'									=> 'Número máximo de palavras',
	'MANAGE_MENUS'								=> 'Gerenciar menus',
	'MAP_COORDINATES'							=> 'Coordenadas',
	'MAP_COORDINATES_EXPLAIN'					=> 'Insira coordenadas no formato latitude, longitude',
	'MAP_HEIGHT'								=> 'Altura',
	'MAP_LOCATION'								=> 'Local:',
	'MAP_TITLE'									=> 'Título',
	'MAP_VIEW'									=> 'Visualizar',
	'MAP_VIEW_HYBRID'							=> 'Híbrido',
	'MAP_VIEW_MAP'								=> 'Mapear',
	'MAP_VIEW_SATELITE'							=> 'Satélite',
	'MAP_VIEW_TERRAIN'							=> 'Terrain',
	'MAP_ZOOM_LEVEL'							=> 'Nível de zoom',
	'MEMBERS_DATE'								=> 'Encontro',
	'MENU_NO_ITEMS'								=> 'Não há itens ativos para exibir',
	'MINI'										=> 'Mini',

	'OR'										=> '<strong>OU</strong>',
	'ORDER_BY'									=> 'Ordenar por',

	'POLL_FROM_FORUMS'							=> 'Exibir enquetes dos fóruns',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Apenas as enquetes dos fóruns selecionados serão exibidas enquanto nenhum tópico for especificado acima',
	'POLL_FROM_GROUPS'							=> 'Exibir enquetes do(s) grupo(s)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Apenas as enquetes dos membros dos grupos selecionados serão exibidas enquanto nenhum usuário for / forem especificados acima',
	'POLL_FROM_TOPICS'							=> 'Exibir enquetes do tópico (s)',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(s) de tópicos para recuperar enquetes, separados por <strong>vírgulas</strong>(,). Deixe em branco para selecionar qualquer tópico.',
	'POLL_FROM_USERS'							=> 'Exibir enquetes do usuário',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id(s) do(s) usuário(s) cujas enquetes você gostaria de exibir, separados por <strong>vírgulas</strong>(,). Deixe em branco para selecionar enquetes de qualquer usuário.',
	'POSTS_TITLE_LIMIT'							=> 'Número máximo de caracteres para o título da postagem',
	'PREVIEW_MAX_CHARS'							=> 'Número de caracteres para pré-visualização',

	'QUERY_TYPE'								=> 'Modo de exibição',

	'ROTATE_DAILY'								=> 'Diariamente',
	'ROTATE_HOURLY'								=> 'Horário',
	'ROTATE_MONTHLY'							=> 'Mensual',
	'ROTATE_PAGELOAD'							=> 'Carregar página',
	'ROTATE_WEEKLY'								=> 'Semanalmente',

	'SAMPLES'									=> 'Amostras',
	'SCRIPTS'									=> 'Scripts',
	'SELECT_FORUMS'								=> 'Selecionar fóruns',
	'SELECT_FORUMS_EXPLAIN'						=> 'Selecione os fóruns de onde exibir tópicos/postagens. Deixe em branco para selecionar de todos os fóruns',
	'SELECT_MENU'								=> 'Selecione o Menu',
	'SELECT_PROFILE_FIELDS'						=> 'Selecione campos de perfil',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Somente os campos do perfil selecionados serão exibidos, se disponíveis.',
	'SHOW_FIRST_POST'							=> 'Primeira publicação',
	'SHOW_HIDE_ME'								=> 'Permitir ocultar o estado online?',
	'SHOW_LAST_POST'							=> 'Última postagem',
	'SHOW_MEMBER_MENU'							=> 'Mostrar menu do usuário?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Substituir caixa de login pelo menu do usuário se o usuário estiver logado',
	'SHOW_WORD_COUNT'							=> 'Mostrar contagem de palavras?',

	'TEMPLATE'									=> 'Modelo',
	'TOPIC_TITLE_LIMIT'							=> 'Número máximo de caracteres para o título do tópico',
	'TOPIC_TYPE'								=> 'Tipo de tópico',
	'TOPIC_TYPE_EXPLAIN'						=> 'Selecione os tipos de tópicos que você gostaria de exibir. Deixe as caixas não marcadas para selecionar de todos os tipos de tópicos',
	'TOPICS_LOOK_BACK'							=> 'Olhe para trás',
	'TOPICS_ONLY'								=> 'Apenas tópicos?',
	'TOPICS_PER_PAGE'							=> 'Por página',

	'WORD_MAX_SIZE'								=> 'Tamanho máximo da fonte',
	'WORD_MIN_SIZE'								=> 'Tamanho mínimo da fonte',
));
