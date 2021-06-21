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
	'ALL_TYPES'									=> 'Tous les types',
	'ALL_GROUPS'								=> 'Tous les groupes',
	'ARCHIVES'									=> 'Archives',
	'AUTO_LOGIN'								=> 'Autoriser la connexion automatique ?',
	'FILE_MANAGER'								=> 'Gestionnaire de fichiers',
	'TOPIC_POST_IDS'							=> 'À partir du sujet/ID de publication',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Id(s) des sujets/messages pour récupérer les pièces jointes, séparées par <strong>virgules</strong>(,). Spécifiez si cette liste est pour les identifiants de sujet ou de publication ci-dessus.',
	'TOPIC_POST_IDS_TYPE'						=> 'Type d\'ID (ci-dessous)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Fichiers joints',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Date d\'anniversaire',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'Bloc personnalisé',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'Membre en vedette',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'Flux RSS/Atom',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'Sondage du forum',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'Sujets du forum',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'Google Maps',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'Sujets populaires',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'Liens',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'Boîte de connexion',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'Membres',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Menu des membres',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Menu',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Mes favoris',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Sujets récents',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Statistiques',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Sélecteur de style',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Quoi de neuf ?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Qui est en ligne',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Wordgraphe',

	// block views
	'BLOCK_VIEW'								=> 'Vue Bloc',
	'BLOCK_VIEW_BASIC'							=> 'Basique',
	'BLOCK_VIEW_BOXED'							=> 'Boîtes',
	'BLOCK_VIEW_DEFAULT'						=> 'Par défaut',
	'BLOCK_VIEW_SIMPLE'							=> 'Simple',

	'CACHE_DURATION'							=> 'Durée de la cache',
	'CONTEXT'									=> 'Contexte',
	'CSS_SCRIPTS'								=> 'CSS Scripts',
	'CUSTOM_PROFILE_FIELDS'						=> 'Champs de profil personnalisés',

	'DATE_RANGE'								=> 'Date Range',
	'DISPLAY_PREVIEW'							=> 'Aperçu de l\'affichage?',

	'EDIT_ME'									=> 'Veuillez me modifier',
	'ENABLE_TOPIC_TRACKING'						=> 'Activer le suivi des sujets ?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Si activé, les discussions non lues seront indiquées mais les résultats du bloc ne seront pas mis en cache <strong>(non recommandé)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Vous avez entré trop de mots à exclure. Le nombre maximum de caractères possibles est de 255, vous avez entré %s.',
	'EXCLUDE_WORDS'								=> 'Exclure les mots',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Listez les mots que vous souhaitez exclure du wordgraph séparés par une virgule (,). Maximum 255 caractères.',
	'EXPANDED'									=> 'Étendu',
	'EXTENSION_GROUP'							=> 'Groupe d\'extension',

	'FEATURED_MEMBER_IDS'						=> 'IDs utilisateur',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Liste des utilisateurs séparés par des virgules à utiliser (s\'applique uniquement au mode d\'affichage des membres en vedette)',
	'FEED_DATA_PREVIEW'							=> 'Données du flux',
	'FEED_ITEM_TEMPLATE'						=> 'Modèle d\'article',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS:</strong><br />
		<ul class="sm-list">
			<li>Access feed data in <strong>item</strong> variable e.g. item.title</li>
			<li>Template must be in <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Twig syntax</a></li>
			<li>Click <strong>Samples</strong> above for sample templates</li>
			<li>Use <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> to get any tag from the feed that we do not provide e.g.<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<li>Use Twig’s json_encode filter to see contents of array e.g. <strong><code>{{ get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Source',
	'FEED_URL_PLACEHOLDER'						=> 'http://exemple.com/rss',
	'FEED_URLS'									=> 'URL du flux',
	'FIRST_POST_ONLY'							=> 'Premier message uniquement',
	'FIRST_POST_TIME'							=> 'Heure de la première publication',
	'FORUMS_GET_TYPE'							=> 'Obtenir le type',
	'FORUMS_MAX_TOPICS'							=> 'Nombre maximum de discussions/publications',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Nombre maximum de caractères par titre',
	'FREQUENCY'									=> 'Fréquence',
	'FULL'										=> 'Plein',
	'FULLSCREEN'								=> 'Plein écran',

	'GET_TYPE'									=> 'Afficher le sujet/message ?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Utilisez cette zone de texte pour entrer du contenu HTML brut.</strong><br />Veuillez noter que tout contenu publié ici remplacera le contenu du bloc personnalisé et que l\'éditeur de bloc visuel ne sera pas disponible.',
	'HOURS_SHORT'								=> 'heures',

	'JS_SCRIPTS'								=> 'Scripts JS',

	'LAST_POST_TIME'							=> 'Dernier message',
	'LAST_READ_TIME'							=> 'Dernière lecture',
	'LIMIT'										=> 'Limite',
	'LIMIT_FORUMS'								=> 'ID du forum (facultatif)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Entrez chaque identifiant de forum séparé par une virgule (,). Si défini, seuls les sujets des forums spécifiés seront affichés.',
	'LIMIT_POST_TIME'							=> 'Limiter par message',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Si défini, seuls les sujets postés dans la période spécifiée seront récupérés',

	'MAX_DEPTH'									=> 'Profondeur maximale',
	'MAX_ITEMS'									=> 'Nombre maximum d\'éléments',
	'MAX_MEMBERS'								=> 'Nombre maximum de membres',
	'MAX_POSTS'									=> 'Nombre maximum de publications',
	'MAX_TOPICS'								=> 'Nombre maximum de sujets',
	'MAX_WORDS'									=> 'Nombre maximum de mots',
	'MANAGE_MENUS'								=> 'Gérer les menus',
	'MAP_COORDINATES'							=> 'Coordonnées',
	'MAP_COORDINATES_EXPLAIN'					=> 'Entrez les coordonnées sous la forme latitude, longitude',
	'MAP_HEIGHT'								=> 'Hauteur',
	'MAP_LOCATION'								=> 'Localisation',
	'MAP_TITLE'									=> 'Titre de la page',
	'MAP_VIEW'									=> 'Voir',
	'MAP_VIEW_HYBRID'							=> 'Hybride',
	'MAP_VIEW_MAP'								=> 'Carte',
	'MAP_VIEW_SATELITE'							=> 'Satelite',
	'MAP_VIEW_TERRAIN'							=> 'Terrain',
	'MAP_ZOOM_LEVEL'							=> 'Niveau de zoom',
	'MEMBERS_DATE'								=> 'Date',
	'MENU_NO_ITEMS'								=> 'Aucun élément actif à afficher',
	'MINI'										=> 'Mini',

	'OR'										=> '<strong>OU</strong>',
	'ORDER_BY'									=> 'Trier par',

	'POLL_FROM_FORUMS'							=> 'Afficher les sondages depuis le(s) forum(s)',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Seuls les sondages des forums sélectionnés seront affichés tant qu\'aucun sujet n\'est spécifié ci-dessus',
	'POLL_FROM_GROUPS'							=> 'Afficher les sondages des groupes',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Seuls les sondages des membres des groupes sélectionnés seront affichés tant qu\'aucun utilisateur/utilisateur ne sera spécifié ci-dessus',
	'POLL_FROM_TOPICS'							=> 'Afficher les sondages depuis le(s) sujet(s)',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(s) de sujets à récupérer des sondages, séparés par <strong>virgules</strong>(,). Laisser vide pour sélectionner un sujet.',
	'POLL_FROM_USERS'							=> 'Afficher les sondages de Utilisateur(s)',
	'POLL_FROM_USERS_EXPLAIN'					=> 'ID (s) de Utilisateur(s) dont vous souhaitez afficher les sondages, séparés par <strong>virgules</strong>(,). Laissez vide pour sélectionner les sondages de n\'importe quel utilisateur.',
	'POSTS_TITLE_LIMIT'							=> 'Nombre maximum de caractères pour le titre du message',
	'PREVIEW_MAX_CHARS'							=> 'Nombre de caractères à prévisualiser',

	'QUERY_TYPE'								=> 'Mode d\'affichage',

	'ROTATE_DAILY'								=> 'Tous les jours',
	'ROTATE_HOURLY'								=> 'Heures',
	'ROTATE_MONTHLY'							=> 'Mensuel',
	'ROTATE_PAGELOAD'							=> 'Chargement de la page',
	'ROTATE_WEEKLY'								=> 'Hebdomadaire',

	'SAMPLES'									=> 'Échantillons',
	'SCRIPTS'									=> 'Scripts',
	'SELECT_FORUMS'								=> 'Sélectionnez les forums',
	'SELECT_FORUMS_EXPLAIN'						=> 'Sélectionnez les forums à partir desquels afficher les sujets/publications. Laissez vide pour sélectionner à partir de tous les forums',
	'SELECT_MENU'								=> 'Sélectionner le menu',
	'SELECT_PROFILE_FIELDS'						=> 'Sélectionner les champs de profil',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Seuls les champs de profil sélectionnés seront affichés, si disponible.',
	'SHOW_FIRST_POST'							=> 'Premier message',
	'SHOW_HIDE_ME'								=> 'Permettre de masquer le statut en ligne ?',
	'SHOW_LAST_POST'							=> 'Dernier message',
	'SHOW_MEMBER_MENU'							=> 'Afficher le menu utilisateur?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Remplacer la boîte de connexion par le menu utilisateur si l\'utilisateur est connecté',
	'SHOW_WORD_COUNT'							=> 'Afficher le nombre de mots ?',

	'TEMPLATE'									=> 'Gabarit',
	'TOPIC_TITLE_LIMIT'							=> 'Nombre maximum de caractères pour le titre du sujet',
	'TOPIC_TYPE'								=> 'Type de sujet',
	'TOPIC_TYPE_EXPLAIN'						=> 'Sélectionnez les types de sujet que vous souhaitez afficher. Laissez les cases décochées pour sélectionner à partir de tous les types de sujet',
	'TOPICS_LOOK_BACK'							=> 'Regarder en arrière',
	'TOPICS_ONLY'								=> 'Sujets seulement?',
	'TOPICS_PER_PAGE'							=> 'Par page',

	'WORD_MAX_SIZE'								=> 'Taille maximale de la police',
	'WORD_MIN_SIZE'								=> 'Taille minimale de la police',
));
