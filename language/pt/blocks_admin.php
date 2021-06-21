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
	'TOPIC_POST_IDS'							=> 'De Tópico/Postar Ids',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(s) de tópicos/postagens para recuperar anexos, separados por <strong>vírgulas</strong>(,). Especifique se esta lista é para tópicos ou identificadores de postagens acima.',
	'TOPIC_POST_IDS_TYPE'						=> 'Tipo de IDs (abaixo)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Anexos',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Aniversário',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Bloco personalizado',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Membro em destaque',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'Feeds RSS/Atom',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Enquete no fórum',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Tópicos do fórum',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Google Maps',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Popular Topics',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Links',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Caixa de login',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Membros',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Menu do membro',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Menu',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Meus Favoritos',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Recent Topics',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Estatísticas',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Alternador de estilo',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'O que é novo?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Quem está online',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Wordgraph',

	// block views
	'BLOCK_VIEW'								=> 'Ver Bloco',
	'BLOCK_VIEW_BASIC'							=> 'Base',
	'BLOCK_VIEW_BOXED'							=> 'Boxeado',
	'BLOCK_VIEW_DEFAULT'						=> 'Padrão',
	'BLOCK_VIEW_SIMPLE'							=> 'Simples',

	'CACHE_DURATION'							=> 'Duração do cache',
	'CONTEXT'									=> 'Contexto',
	'CSS_SCRIPTS'								=> 'Scripts CSS',
	'CUSTOM_PROFILE_FIELDS'						=> 'Campos de perfil personalizados',

	'DATE_RANGE'								=> 'Período',
	'DISPLAY_PREVIEW'							=> 'Exibir Visualização?',

	'EDIT_ME'									=> 'Por favor me edite',
	'ENABLE_TOPIC_TRACKING'						=> 'Ativar o rastreamento do tópico?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Se ativado, tópicos não lidos serão indicados, mas os resultados do bloco não serão armazenados em cache <strong>(não recomendado)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Você digitou muitas palavras para excluir. O número máximo de caracteres possível é 255, você digitou %s.',
	'EXCLUDE_WORDS'								=> 'Excluir palavras',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Liste as palavras que você gostaria de excluir da palavra separadas por vírgula (,). Máximo de 255 caracteres.',
	'EXPANDED'									=> 'Expandido',
	'EXTENSION_GROUP'							=> 'Grupo de extensões',

	'FEATURED_MEMBER_IDS'						=> 'IDs de usuário',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Lista de usuários separados por vírgula para o recurso (Somente se aplica ao modo de exibição de membros em destaque)',
	'FEED_DATA_PREVIEW'							=> 'Dados do feed',
	'FEED_ITEM_TEMPLATE'						=> 'Modelo de Item',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS:</strong><br />
		<ul class="sm-list">
			<li>Acessar dados de feed em <strong>item</strong> variável e. . itle</li>
			<li>Modelo deve estar em <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Sintaxe Twig</a></li>
			<li>Clique <strong>Amostras</strong> acima dos modelos de amostragem</li>
			<li>Use <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> para obter qualquer tag do feed que não fornecemos. .<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<li>Use o filtro json_encode do Twig\'s para ver o conteúdo do array. . <strong><code>{{ get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Fonte',
	'FEED_URL_PLACEHOLDER'						=> 'http://exemplo.com/rss',
	'FEED_URLS'									=> 'URLs do Feed',
	'FIRST_POST_ONLY'							=> 'Somente primeira postagem',
	'FIRST_POST_TIME'							=> 'Primeira postagem',
	'FORUMS_GET_TYPE'							=> 'Obter tipo',
	'FORUMS_MAX_TOPICS'							=> 'Máximo de tópicos/postagens',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Máximo de caracteres por título',
	'FREQUENCY'									=> 'Frequência',
	'FULL'										=> 'Cheio',
	'FULLSCREEN'								=> 'Tela Cheia',

	'GET_TYPE'									=> 'Exibir Tópico/Post?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Use esta textarea para entrar no conteúdo HTML bruto.</strong><br />Por favor, note que qualquer conteúdo postado aqui irá substituir o conteúdo personalizado do bloco e o editor do bloco visual não estará disponível.',
	'HOURS_SHORT'								=> 'horas',

	'JS_SCRIPTS'								=> 'Scripts JS',

	'LAST_POST_TIME'							=> 'Última postagem',
	'LAST_READ_TIME'							=> 'Hora da última leitura',
	'LIMIT'										=> 'Limite',
	'LIMIT_FORUMS'								=> 'Ids do fórum (opcional)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Digite cada id do fórum separado por vírgula (,). Se configurado, apenas serão exibidos tópicos de fóruns especificados.',
	'LIMIT_POST_TIME'							=> 'Limitar por horário de post',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Se definido, apenas os tópicos postados no período especificado serão recuperados',

	'MAX_DEPTH'									=> 'Profundidade máxima',
	'MAX_ITEMS'									=> 'Número máximo de itens',
	'MAX_MEMBERS'								=> 'Max. Membros',
	'MAX_POSTS'									=> 'Número máximo de postagens',
	'MAX_TOPICS'								=> 'Número máximo de tópicos',
	'MAX_WORDS'									=> 'Número máximo de palavras',
	'MANAGE_MENUS'								=> 'Manage Menus',
	'MAP_COORDINATES'							=> 'Coordenadas',
	'MAP_COORDINATES_EXPLAIN'					=> 'Digite as coordenadas na latitude do formulário, longitude',
	'MAP_HEIGHT'								=> 'Altura',
	'MAP_LOCATION'								=> 'Localização',
	'MAP_TITLE'									=> 'Título',
	'MAP_VIEW'									=> 'Ver',
	'MAP_VIEW_HYBRID'							=> 'Híbrido',
	'MAP_VIEW_MAP'								=> 'Mapa',
	'MAP_VIEW_SATELITE'							=> 'Escala',
	'MAP_VIEW_TERRAIN'							=> 'Terreno',
	'MAP_ZOOM_LEVEL'							=> 'Nível de zoom',
	'MEMBERS_DATE'								=> 'Data',
	'MENU_NO_ITEMS'								=> 'Nenhum item ativo para exibir',
	'MINI'										=> 'Mini',

	'OR'										=> '<strong>OU</strong>',
	'ORDER_BY'									=> 'Ordenar por',

	'POLL_FROM_FORUMS'							=> 'Mostrar enquetes de fóruns (s)',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Somente as pesquisas dos fóruns selecionados serão exibidas enquanto nenhum tópico for especificado acima',
	'POLL_FROM_GROUPS'							=> 'Mostrar enquetes de grupos(s)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Somente as enquetes dos membros dos grupos selecionados serão exibidas desde que nenhum usuário(s) este/seja especificado acima',
	'POLL_FROM_TOPICS'							=> 'Exibir enquetes de tópico(s)',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(s) de tópicos de que as enquetes serão recuperadas, separadas por <strong>vírgulas</strong>(,). Deixe em branco para selecionar qualquer tópico.',
	'POLL_FROM_USERS'							=> 'Mostrar enquetes do usuário(s)',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id(s) de usuário(s) cujas enquetes gostaria de exibir, separadas por <strong>vírgulas</strong>(,). Deixe em branco para selecionar enquetes de qualquer usuário.',
	'POSTS_TITLE_LIMIT'							=> 'Número máximo de caracteres para o título da postagem',
	'PREVIEW_MAX_CHARS'							=> 'Número de caracteres para pré-visualizar',

	'QUERY_TYPE'								=> 'Modo de exibição',

	'ROTATE_DAILY'								=> 'Diário',
	'ROTATE_HOURLY'								=> 'Por hora',
	'ROTATE_MONTHLY'							=> 'Mensal',
	'ROTATE_PAGELOAD'							=> 'Carga da página',
	'ROTATE_WEEKLY'								=> 'Semanal',

	'SAMPLES'									=> 'Amostras',
	'SCRIPTS'									=> 'Scripts',
	'SELECT_FORUMS'								=> 'Selecionar fóruns',
	'SELECT_FORUMS_EXPLAIN'						=> 'Selecione os fóruns dos quais exibir tópicos/postagens. Deixe em branco para selecionar de todos os fóruns',
	'SELECT_MENU'								=> 'Selecionar Menu',
	'SELECT_PROFILE_FIELDS'						=> 'Selecionar campos de perfil',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Somente os campos de perfil selecionados serão exibidos, se disponível.',
	'SHOW_FIRST_POST'							=> 'Primeira postagem',
	'SHOW_HIDE_ME'								=> 'Permitir esconder status online?',
	'SHOW_LAST_POST'							=> 'Último Post',
	'SHOW_MEMBER_MENU'							=> 'Mostrar menu do usuário?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Substituir a caixa de login pelo menu do usuário se o usuário estiver logado',
	'SHOW_WORD_COUNT'							=> 'Mostrar contagem de palavras?',

	'TEMPLATE'									=> 'Modelo',
	'TOPIC_TITLE_LIMIT'							=> 'Número máximo de caracteres para o título do tópico',
	'TOPIC_TYPE'								=> 'Tipo de Tópico',
	'TOPIC_TYPE_EXPLAIN'						=> 'Selecione os tipos de tópicos que você gostaria de exibir. Deixe as caixas desmarcadas para selecionar de todos os tipos de tópicos',
	'TOPICS_LOOK_BACK'							=> 'Look back',
	'TOPICS_ONLY'								=> 'Apenas tópicos?',
	'TOPICS_PER_PAGE'							=> 'Per page',

	'WORD_MAX_SIZE'								=> 'Tamanho máximo da fonte',
	'WORD_MIN_SIZE'								=> 'Tamanho mínimo da fonte',
));
