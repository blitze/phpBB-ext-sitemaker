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
	'TOPIC_POST_IDS'							=> 'Desde temas / Ids del post',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(s) de temas/publicaciones de los que recuperar archivos adjuntos, separados por <strong>comas</strong>(,). Especifique si esta lista es para temas o identificadores de publicación arriba.',
	'TOPIC_POST_IDS_TYPE'						=> 'Tipo de IDs (abajo)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Adjuntos',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Cumpleaños',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Bloque personalizado',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Miembro destacado',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'Alimentos RSS/Atom',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Encuesta del Foro',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Temas del foro',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Mapas de Google',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Temas populares',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Enlaces',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Caja de acceso',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Miembros',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Menú de miembros',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Menú',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Mis favoritos',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Temas recientes',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Estadísticas',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Cambiador de estilos',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> '¿Qué hay de nuevo?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Quién está conectado',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Wordgraph',

	// block views
	'BLOCK_VIEW'								=> 'Bloquear vista',
	'BLOCK_VIEW_BASIC'							=> 'Básico',
	'BLOCK_VIEW_BOXED'							=> 'Cajado',
	'BLOCK_VIEW_DEFAULT'						=> 'Por defecto',
	'BLOCK_VIEW_SIMPLE'							=> 'Simple',

	'CACHE_DURATION'							=> 'Duración del caché',
	'CONTEXT'									=> 'Contexto',
	'CSS_SCRIPTS'								=> 'CSS Scripts',
	'CUSTOM_PROFILE_FIELDS'						=> 'Campos de perfil personalizados',

	'DATE_RANGE'								=> 'Date Range',
	'DISPLAY_PREVIEW'							=> '¿Mostrar vista previa?',

	'EDIT_ME'									=> 'Por favor, editame',
	'ENABLE_TOPIC_TRACKING'						=> '¿Habilitar seguimiento de temas?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Si está activado, los temas no leídos serán indicados pero los resultados del bloque no serán almacenados en caché <strong>(No recomendado)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Ha introducido demasiadas palabras para excluir. El número máximo de caracteres posible es 255, ha introducido %s.',
	'EXCLUDE_WORDS'								=> 'Excluir palabras',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Lista de las palabras que desea excluir del gráfico de palabras separadas por una coma (,). Máximo 255 caracteres.',
	'EXPANDED'									=> 'Ampliado',
	'EXTENSION_GROUP'							=> 'Grupo de extensiones',

	'FEATURED_MEMBER_IDS'						=> 'IDs de usuario',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Lista separada por comas de usuarios a característica (sólo se aplica al modo Mostrar miembros destacados)',
	'FEED_DATA_PREVIEW'							=> 'Datos de alimentación',
	'FEED_ITEM_TEMPLATE'						=> 'Plantilla de artículo',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS:</strong><br />
		<ul class="sm-list">
			<li>Acceso a los datos del feed en <strong>elemento</strong> variable e. . itle</li>
			<li>Plantilla debe estar en <a href="https://twig.symfony.com/doc/2.x/" target="_blank">sintaxis de Twig</a></li>
			<li>Haga clic en <strong>Muestras</strong> arriba para plantillas de ejemplo</li>
			<li>Utilice <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> para obtener cualquier etiqueta del feed que no proporcionamos. .<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<li>Utilice el filtro json_encode de Twig para ver el contenido de la matriz. . <strong><code>{{ get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Fuente',
	'FEED_URL_PLACEHOLDER'						=> 'http://ejemplo.com/r(debate)',
	'FEED_URLS'									=> 'URLs de alimentación',
	'FIRST_POST_ONLY'							=> 'Sólo el primer mensaje',
	'FIRST_POST_TIME'							=> 'Primera Hora de Post',
	'FORUMS_GET_TYPE'							=> 'Obtener tipo',
	'FORUMS_MAX_TOPICS'							=> 'Máximo de temas/mensajes',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Máximo de caracteres por título',
	'FREQUENCY'									=> 'Frecuencia',
	'FULL'										=> 'Lleno',
	'FULLSCREEN'								=> 'Pantalla completa',

	'GET_TYPE'									=> '¿Mostrar tema/mensaje?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Usa este área de texto para introducir contenido HTML puro.</strong><br />Tenga en cuenta que cualquier contenido publicado aquí anulará el contenido de bloque personalizado y el editor visual de bloques no estará disponible.',
	'HOURS_SHORT'								=> 'hrs',

	'JS_SCRIPTS'								=> 'JS Scripts',

	'LAST_POST_TIME'							=> 'Último mensaje',
	'LAST_READ_TIME'							=> 'Última lectura',
	'LIMIT'										=> 'Límite',
	'LIMIT_FORUMS'								=> 'Ids del foro (opcional)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Introduzca el id de cada foro separado por una coma (,). Si se establece, sólo se mostrarán los temas de los foros especificados.',
	'LIMIT_POST_TIME'							=> 'Limitar por hora postal',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Si se establece, sólo los temas publicados en el período especificado serán recuperados',

	'MAX_DEPTH'									=> 'Profundidad máxima',
	'MAX_ITEMS'									=> 'Número máximo de artículos',
	'MAX_MEMBERS'								=> 'Max. Miembros',
	'MAX_POSTS'									=> 'Número máximo de mensajes',
	'MAX_TOPICS'								=> 'Número máximo de temas',
	'MAX_WORDS'									=> 'Número máximo de palabras',
	'MANAGE_MENUS'								=> 'Administrar Menús',
	'MAP_COORDINATES'							=> 'Coordenadas',
	'MAP_COORDINATES_EXPLAIN'					=> 'Introduzca coordenadas en la latitud del formulario, longitud',
	'MAP_HEIGHT'								=> 'Altura',
	'MAP_LOCATION'								=> 'Ubicación',
	'MAP_TITLE'									=> 'Título',
	'MAP_VIEW'									=> 'Ver',
	'MAP_VIEW_HYBRID'							=> 'Hibrida',
	'MAP_VIEW_MAP'								=> 'Mapa',
	'MAP_VIEW_SATELITE'							=> 'Satélite',
	'MAP_VIEW_TERRAIN'							=> 'Terrain',
	'MAP_ZOOM_LEVEL'							=> 'Nivel de zoom',
	'MEMBERS_DATE'								=> 'Fecha',
	'MENU_NO_ITEMS'								=> 'No hay elementos activos para mostrar',
	'MINI'										=> 'Mini',

	'OR'										=> '<strong>O</strong>',
	'ORDER_BY'									=> 'Ordenar por',

	'POLL_FROM_FORUMS'							=> 'Mostrar encuestas de foro(s)',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Sólo las encuestas de los foros seleccionados se mostrarán mientras no se especifique ningún tema arriba',
	'POLL_FROM_GROUPS'							=> 'Mostrar encuestas de grupo(s)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Solo las encuestas de los miembros de los grupos seleccionados se mostrarán mientras no se especifique ningún usuario/o usuario/a anterior',
	'POLL_FROM_TOPICS'							=> 'Mostrar encuestas de tema(s)',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(s) de temas de los que recuperar encuestas, separados por <strong>comas</strong>(,). Deje en blanco para seleccionar cualquier tema.',
	'POLL_FROM_USERS'							=> 'Mostrar encuestas de usuario(s)',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id(s) de usuario(s) cuyas encuestas desea mostrar, separadas por <strong>comas</strong>(,). Deje en blanco para seleccionar encuestas de cualquier usuario.',
	'POSTS_TITLE_LIMIT'							=> 'Número máximo de caracteres para el título del post',
	'PREVIEW_MAX_CHARS'							=> 'Número de caracteres a previsualizar',

	'QUERY_TYPE'								=> 'Modo de pantalla',

	'ROTATE_DAILY'								=> 'Diario',
	'ROTATE_HOURLY'								=> 'Por hora',
	'ROTATE_MONTHLY'							=> 'Mensual',
	'ROTATE_PAGELOAD'							=> 'Carga de página',
	'ROTATE_WEEKLY'								=> 'Semanal',

	'SAMPLES'									=> 'Muestras',
	'SCRIPTS'									=> 'Escrituras',
	'SELECT_FORUMS'								=> 'Seleccionar foros',
	'SELECT_FORUMS_EXPLAIN'						=> 'Selecciona los foros desde los que mostrar temas/mensajes. Déjalo en blanco para seleccionar de todos los foros',
	'SELECT_MENU'								=> 'Seleccionar Menú',
	'SELECT_PROFILE_FIELDS'						=> 'Seleccionar campos de perfil',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Sólo se mostrarán los campos de perfil seleccionados, si están disponibles.',
	'SHOW_FIRST_POST'							=> 'Primer mensaje',
	'SHOW_HIDE_ME'								=> '¿Permitir ocultar el estado de conexión?',
	'SHOW_LAST_POST'							=> 'Último mensaje',
	'SHOW_MEMBER_MENU'							=> '¿Mostrar menú de usuario?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Reemplazar la caja de inicio de sesión con el menú de usuario si el usuario está conectado',
	'SHOW_WORD_COUNT'							=> '¿Mostrar contador de palabras?',

	'TEMPLATE'									=> 'Plantilla',
	'TOPIC_TITLE_LIMIT'							=> 'Número máximo de caracteres para el título del tema',
	'TOPIC_TYPE'								=> 'Tipo de tema',
	'TOPIC_TYPE_EXPLAIN'						=> 'Seleccione los tipos de temas que desea mostrar. Deje las casillas desmarcadas para seleccionar de todos los tipos de temas',
	'TOPICS_LOOK_BACK'							=> 'Mirar atrás',
	'TOPICS_ONLY'								=> '¿Sólo temas?',
	'TOPICS_PER_PAGE'							=> 'Por página',

	'WORD_MAX_SIZE'								=> 'Tamaño máximo de fuente',
	'WORD_MIN_SIZE'								=> 'Tamaño mínimo de fuente',
));
