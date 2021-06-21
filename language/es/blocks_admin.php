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
	'ALL_TYPES'									=> 'Todos los tipos',
	'ALL_GROUPS'								=> 'Todos los grupos',
	'ARCHIVES'									=> 'Archivos',
	'AUTO_LOGIN'								=> '¿Permitir acceso automático?',
	'FILE_MANAGER'								=> 'Gestor de archivos',
	'TOPIC_POST_IDS'							=> 'Desde Ids de temas/post',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(s) de temas/mensajes de los que recuperar archivos adjuntos, separados por <strong>comas</strong>(,). Especifique si esta lista es para temas o entradas de ids de arriba.',
	'TOPIC_POST_IDS_TYPE'						=> 'Tipo de ID (abajo)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Adjuntos',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Cumpleaños',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Bloque personalizado',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Miembro destacado',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'Fuentes RSS/Atom',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Encuesta del Foro',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Temas del foro',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Mapas de Google',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Temas populares',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Enlaces',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Caja de Login',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Miembros',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Menú de miembros',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Menú',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Mis Favoritos',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Temas recientes',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Estadísticas',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Conmutador de estilo',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> '¿Qué hay de nuevo?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Quién está conectado',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Gráfico de palabras',

	// block views
	'BLOCK_VIEW'								=> 'Bloquear vista',
	'BLOCK_VIEW_BASIC'							=> 'Básico',
	'BLOCK_VIEW_BOXED'							=> 'Boxed',
	'BLOCK_VIEW_DEFAULT'						=> 'Por defecto',
	'BLOCK_VIEW_SIMPLE'							=> 'Fácil',

	'CACHE_DURATION'							=> 'Duración del caché',
	'CONTEXT'									=> 'Contexto',
	'CSS_SCRIPTS'								=> 'Scripts CSS',
	'CUSTOM_PROFILE_FIELDS'						=> 'Campos personalizados del perfil',

	'DATE_RANGE'								=> 'Rango de fechas',
	'DISPLAY_PREVIEW'							=> '¿Mostrar vista previa?',

	'EDIT_ME'									=> 'Por favor, edítame',
	'ENABLE_TOPIC_TRACKING'						=> '¿Habilitar seguimiento de temas?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Si está activado, los temas no leídos se indicarán pero los resultados del bloque no se almacenarán en caché <strong>(no recomendado)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Has introducido demasiadas palabras para excluir. El número máximo de caracteres posible es de 255, has introducido %s.',
	'EXCLUDE_WORDS'								=> 'Excluir palabras',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Lista las palabras que desea excluir de la gráfica de palabras separadas por una coma (,). Máximo 255 caracteres.',
	'EXPANDED'									=> 'Ampliado',
	'EXTENSION_GROUP'							=> 'Grupo de extensiones',

	'FEATURED_MEMBER_IDS'						=> 'IDs de usuario',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Lista separada por comas de usuarios a la función (solo se aplica al modo de visualización de miembros destacados)',
	'FEED_DATA_PREVIEW'							=> 'Datos del feed',
	'FEED_ITEM_TEMPLATE'						=> 'Plantilla de artículo',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>CONSEJO:</strong><br />
		<ul class="sm-list">
			<li>Datos del feed de acceso en <strong>elemento</strong> variable e. . itle</li>
			<li>La plantilla debe estar en la sintaxis de Twig <a href="https://twig.symfony.com/doc/2.x/" target="_blank"></a></li>
			<li>Haga clic en <strong>Muestras</strong> arriba para plantillas de ejemplo</li>
			<li>Utilizar <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> para obtener cualquier etiqueta del feed que no proporcionamos e. .<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<li>Use el filtro json_encode de Twig\'s para ver el contenido de la matriz e. . <strong><code>{{ get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Fuente',
	'FEED_URL_PLACEHOLDER'						=> 'http://ejemplo.com/rss',
	'FEED_URLS'									=> 'URL del feed',
	'FIRST_POST_ONLY'							=> 'Primer mensaje sólo',
	'FIRST_POST_TIME'							=> 'Primer post',
	'FORUMS_GET_TYPE'							=> 'Obtener tipo',
	'FORUMS_MAX_TOPICS'							=> 'Máximo de temas/mensajes',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Máximo de caracteres por título',
	'FREQUENCY'									=> 'Frecuencia',
	'FULL'										=> 'Lleno',
	'FULLSCREEN'								=> 'Pantalla completa',

	'GET_TYPE'									=> '¿Mostrar tema/publicación?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Usa este área de texto para introducir contenido HTML en bruto.</strong><br />Por favor, ten en cuenta que cualquier contenido publicado aquí prevalecerá sobre el contenido del bloque personalizado y el editor de bloques visuales no estará disponible.',
	'HOURS_SHORT'								=> 'h',

	'JS_SCRIPTS'								=> 'Scripts JS',

	'LAST_POST_TIME'							=> 'Último mensaje',
	'LAST_READ_TIME'							=> 'Última lectura',
	'LIMIT'										=> 'Límite',
	'LIMIT_FORUMS'								=> 'Ids del foro (opcional)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Introduzca cada id de foro separado por una coma (,). Si se establece, sólo se mostrarán los temas de los foros especificados.',
	'LIMIT_POST_TIME'							=> 'Limitar por tiempo de publicación',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Si se establece, sólo se recuperarán los temas publicados dentro del período especificado',

	'MAX_DEPTH'									=> 'Profundidad máxima',
	'MAX_ITEMS'									=> 'Número máximo de elementos',
	'MAX_MEMBERS'								=> 'Máximo de miembros',
	'MAX_POSTS'									=> 'Número máximo de mensajes',
	'MAX_TOPICS'								=> 'Número máximo de temas',
	'MAX_WORDS'									=> 'Número máximo de palabras',
	'MANAGE_MENUS'								=> 'Administrar Menús',
	'MAP_COORDINATES'							=> 'Coordenadas',
	'MAP_COORDINATES_EXPLAIN'					=> 'Introduzca las coordenadas en la latitud del formulario, longitud',
	'MAP_HEIGHT'								=> 'Altura',
	'MAP_LOCATION'								=> 'Ubicación',
	'MAP_TITLE'									=> 'Título',
	'MAP_VIEW'									=> 'Ver',
	'MAP_VIEW_HYBRID'							=> 'Híbrido',
	'MAP_VIEW_MAP'								=> 'Mapa',
	'MAP_VIEW_SATELITE'							=> 'Satélite',
	'MAP_VIEW_TERRAIN'							=> 'Terreno',
	'MAP_ZOOM_LEVEL'							=> 'Nivel de zoom',
	'MEMBERS_DATE'								=> 'Fecha',
	'MENU_NO_ITEMS'								=> 'No hay elementos activos para mostrar',
	'MINI'										=> 'Mínimo',

	'OR'										=> '<strong>O</strong>',
	'ORDER_BY'									=> 'Ordenar por',

	'POLL_FROM_FORUMS'							=> 'Mostrar encuestas de foro(s)',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Sólo se mostrarán las encuestas de los foros seleccionados mientras no se especifique ningún tema',
	'POLL_FROM_GROUPS'							=> 'Mostrar encuestas de grupos(s)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Sólo se mostrarán las encuestas de los miembros de los grupos seleccionados mientras no se especifique ningún usuario/usuario(s) arriba',
	'POLL_FROM_TOPICS'							=> 'Mostrar encuestas de tema(s)',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(s) de los temas desde los que recuperar encuestas, separados por <strong>comas</strong>(,). Dejar en blanco para seleccionar cualquier tema.',
	'POLL_FROM_USERS'							=> 'Mostrar encuestas de Usuario(s)',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id(s) de usuario(s) cuyas encuestas quieres mostrar, separadas por <strong>comas</strong>(,). Dejar en blanco para seleccionar encuestas de cualquier usuario.',
	'POSTS_TITLE_LIMIT'							=> 'Máximo número de caracteres para el título del mensaje',
	'PREVIEW_MAX_CHARS'							=> 'Número de caracteres a previsualizar',

	'QUERY_TYPE'								=> 'Modo de visualización',

	'ROTATE_DAILY'								=> 'Diario',
	'ROTATE_HOURLY'								=> 'Por hora',
	'ROTATE_MONTHLY'							=> 'Mensual',
	'ROTATE_PAGELOAD'							=> 'Carga de página',
	'ROTATE_WEEKLY'								=> 'Semanalmente',

	'SAMPLES'									=> 'Muestras',
	'SCRIPTS'									=> 'Scripts',
	'SELECT_FORUMS'								=> 'Seleccionar foros',
	'SELECT_FORUMS_EXPLAIN'						=> 'Selecciona los foros desde los que mostrar temas/mensajes. Deje en blanco para seleccionar de todos los foros',
	'SELECT_MENU'								=> 'Seleccionar Menú',
	'SELECT_PROFILE_FIELDS'						=> 'Seleccionar campos de perfil',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Sólo se mostrarán los campos de perfil seleccionados, si está disponible.',
	'SHOW_FIRST_POST'							=> 'Primer mensaje',
	'SHOW_HIDE_ME'								=> '¿Permitir ocultar el estado en línea?',
	'SHOW_LAST_POST'							=> 'Último mensaje',
	'SHOW_MEMBER_MENU'							=> '¿Mostrar menú del usuario?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Reemplazar cuadro de inicio de sesión con el menú de usuario si el usuario ha iniciado sesión',
	'SHOW_WORD_COUNT'							=> '¿Mostrar conteo de palabras?',

	'TEMPLATE'									=> 'Plantilla',
	'TOPIC_TITLE_LIMIT'							=> 'Máximo número de caracteres para el título del tema',
	'TOPIC_TYPE'								=> 'Tipo de tema',
	'TOPIC_TYPE_EXPLAIN'						=> 'Seleccione los tipos de temas que desea mostrar. Deje las casillas desmarcadas para seleccionar de todos los tipos de temas',
	'TOPICS_LOOK_BACK'							=> 'Mirar atrás',
	'TOPICS_ONLY'								=> '¿Solo temas?',
	'TOPICS_PER_PAGE'							=> 'Por página',

	'WORD_MAX_SIZE'								=> 'Tamaño máximo de fuente',
	'WORD_MIN_SIZE'								=> 'Tamaño mínimo de fuente',
));
