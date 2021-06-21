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
	'ALL_TYPES'									=> 'Tous les Types',
	'ALL_GROUPS'								=> 'Tous les Groupes',
	'ARCHIVES'									=> 'Archives',
	'AUTO_LOGIN'								=> 'Autoriser la connexion automatique ?',
	'FILE_MANAGER'								=> 'Gestionnaire de fichiers',
	'TOPIC_POST_IDS'							=> 'Depuis les identifiants de Sujet/Message',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'Identifiant(s) des sujets/messages depuis lesquels récupérer les pièces-jointes, séparés par des <strong>virgules</strong>(,). Indiquez si cette liste concerne des identifiants de sujet ou de message ci-dessus.',
	'TOPIC_POST_IDS_TYPE'						=> 'Type d\'identifiant (ci-dessous)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'Pièces-jointes',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'Anniversaire',
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
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'Menu Membres',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'Menu',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'Mes marque-pages',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'Sujets récents',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'Statistiques',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'Commutateur de style',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'Quoi de neuf ?',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'Qui est en ligne ?',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'Wordgraphe',

	// block views
	'BLOCK_VIEW'								=> 'Vue du bloc',
	'BLOCK_VIEW_BASIC'							=> 'Basique',
	'BLOCK_VIEW_BOXED'							=> 'Boîtes',
	'BLOCK_VIEW_DEFAULT'						=> 'Défaut',
	'BLOCK_VIEW_SIMPLE'							=> 'Simple',

	'CACHE_DURATION'							=> 'Durée de mise en cache',
	'CONTEXT'									=> 'Contexte',
	'CSS_SCRIPTS'								=> 'Scripts CSS',
	'CUSTOM_PROFILE_FIELDS'						=> 'Champs de profil personnalisés',

	'DATE_RANGE'								=> 'Plage de dates',
	'DISPLAY_PREVIEW'							=> 'Afficher l\'aperçu ?',

	'EDIT_ME'									=> 'Merci de me modifier',
	'ENABLE_TOPIC_TRACKING'						=> 'Activer le suivi du sujet ?',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'Si activé, les sujets non lus seront indiqués mais les résultats du bloc ne seront pas mis en cache <strong>(non recommandé)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'Vous avez entré trop de mots pour exclure. Le nombre maximum de caractères possibles est de 255, vous avez entré %s.',
	'EXCLUDE_WORDS'								=> 'Exclure les mots',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'Lister les mots que vous aimeriez exclure du wordgraphe séparés par une virgule (,). Maximum 255 caractères.',
	'EXPANDED'									=> 'Développé',
	'EXTENSION_GROUP'							=> 'Groupe d\'extensions',

	'FEATURED_MEMBER_IDS'						=> 'ID utilisateur',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'Liste séparée par des virgules d\'utilisateurs à la fonctionnalité (s\'applique uniquement au mode d\'affichage des membres en vedette)',
	'FEED_DATA_PREVIEW'							=> 'Données du flux',
	'FEED_ITEM_TEMPLATE'						=> 'Modèle d\'article',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS :</strong><br />
		<ul class="sm-list">
			<li>Accès aux données de flux dans <strong>item</strong> variable e. . itle</li>
			<li>Le modèle doit être dans <a href="https://twig.symfony.com/doc/2.x/" target="_blank">syntaxe Twig</a></li>
			<li>Cliquez sur <strong>Échantillons</strong> ci-dessus pour des modèles</li>
			<li>Utilisez <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> pour obtenir les tags du flux que nous ne fournissons pas e. .<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			
			<li>Utilisez le filtre json_encode de Twig pour voir le contenu du tableau. . <strong><code>{{ get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'Source',
	'FEED_URL_PLACEHOLDER'						=> 'http://exemple.com/rss',
	'FEED_URLS'									=> 'URL du flux',
	'FIRST_POST_ONLY'							=> 'Premier message seulement',
	'FIRST_POST_TIME'							=> 'Premier message',
	'FORUMS_GET_TYPE'							=> 'Obtenir le type',
	'FORUMS_MAX_TOPICS'							=> 'Nombre maximum de sujets/messages',
	'FORUMS_TITLE_MAX_CHARS'					=> 'Nombre maximum de caractères par titre',
	'FREQUENCY'									=> 'Fréquence',
	'FULL'										=> 'Plein',
	'FULLSCREEN'								=> 'Plein écran',

	'GET_TYPE'									=> 'Afficher le sujet/message ?',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>Utilisez cette zone de texte pour entrer du contenu HTML brut.</strong><br />Veuillez noter que tout contenu publié ici remplacera le contenu de bloc personnalisé et que l\'éditeur de bloc visuel ne sera pas disponible.',
	'HOURS_SHORT'								=> 'h',

	'JS_SCRIPTS'								=> 'Scripts JS',

	'LAST_POST_TIME'							=> 'Dernier message',
	'LAST_READ_TIME'							=> 'Dernière lecture',
	'LIMIT'										=> 'Limite',
	'LIMIT_FORUMS'								=> 'Ids du forum (facultatif)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'Entrez chaque id de forum séparé par une virgule (,). Si défini, seuls les sujets des forums spécifiés seront affichés.',
	'LIMIT_POST_TIME'							=> 'Limiter par date de publication',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'Si défini, seuls les sujets postés dans la période spécifiée seront récupérés',

	'MAX_DEPTH'									=> 'Profondeur maximale',
	'MAX_ITEMS'									=> 'Nombre maximum d\'éléments',
	'MAX_MEMBERS'								=> 'Nombre maximum de membres',
	'MAX_POSTS'									=> 'Nombre maximum de messages',
	'MAX_TOPICS'								=> 'Nombre maximum de sujets',
	'MAX_WORDS'									=> 'Nombre maximum de mots',
	'MANAGE_MENUS'								=> 'Gérer les menus',
	'MAP_COORDINATES'							=> 'Coordonnées',
	'MAP_COORDINATES_EXPLAIN'					=> 'Entrez les coordonnées dans la latitude de la forme, longitude',
	'MAP_HEIGHT'								=> 'Hauteur',
	'MAP_LOCATION'								=> 'Lieu',
	'MAP_TITLE'									=> 'Titre',
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

	'POLL_FROM_FORUMS'							=> 'Afficher les sondages des forum(s)',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'Seuls les sondages des forums sélectionnés seront affichés tant qu\'aucun sujet n\'est spécifié ci-dessus',
	'POLL_FROM_GROUPS'							=> 'Afficher les sondages de groupe(s)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'Seuls les sondages des membres des groupes sélectionnés seront affichés tant qu\'aucun utilisateur n\'est ou n\'est spécifié ci-dessus',
	'POLL_FROM_TOPICS'							=> 'Afficher les sondages de sujet(s)',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'Id(s) des sujets à partir desquels récupérer les sondages, séparés par <strong>virgules</strong>(,). Laissez vide pour sélectionner un sujet.',
	'POLL_FROM_USERS'							=> 'Afficher les sondages des utilisateurs',
	'POLL_FROM_USERS_EXPLAIN'					=> 'Id(s) des utilisateurs dont vous aimeriez afficher les sondages, séparés par <strong>virgules</strong>(,). Laissez vide pour sélectionner les sondages de n\'importe quel utilisateur.',
	'POSTS_TITLE_LIMIT'							=> 'Nombre maximum de caractères pour le titre du message',
	'PREVIEW_MAX_CHARS'							=> 'Nombre de caractères à afficher',

	'QUERY_TYPE'								=> 'Mode d\'affichage',

	'ROTATE_DAILY'								=> 'Quotidien',
	'ROTATE_HOURLY'								=> 'Heures',
	'ROTATE_MONTHLY'							=> 'Mensuel',
	'ROTATE_PAGELOAD'							=> 'Chargement de page',
	'ROTATE_WEEKLY'								=> 'Hebdomadaire',

	'SAMPLES'									=> 'Échantillons',
	'SCRIPTS'									=> 'Scripts',
	'SELECT_FORUMS'								=> 'Sélectionner des forums',
	'SELECT_FORUMS_EXPLAIN'						=> 'Sélectionnez les forums à partir desquels afficher les sujets/messages. Laissez vide pour sélectionner dans tous les forums',
	'SELECT_MENU'								=> 'Choisir le menu',
	'SELECT_PROFILE_FIELDS'						=> 'Sélectionner les champs du profil',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'Seuls les champs de profil sélectionnés seront affichés, si disponible.',
	'SHOW_FIRST_POST'							=> 'Premier message',
	'SHOW_HIDE_ME'								=> 'Permettre de masquer le statut en ligne ?',
	'SHOW_LAST_POST'							=> 'Dernier message',
	'SHOW_MEMBER_MENU'							=> 'Afficher le menu utilisateur ?',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'Remplacer la boîte de connexion par le menu utilisateur si l\'utilisateur est connecté',
	'SHOW_WORD_COUNT'							=> 'Afficher le nombre de mots ?',

	'TEMPLATE'									=> 'Modèle',
	'TOPIC_TITLE_LIMIT'							=> 'Nombre maximum de caractères pour le titre du sujet',
	'TOPIC_TYPE'								=> 'Type de sujet',
	'TOPIC_TYPE_EXPLAIN'						=> 'Sélectionnez les types de sujets que vous souhaitez afficher. Laissez les cases décochées pour sélectionner dans tous les types de sujets',
	'TOPICS_LOOK_BACK'							=> 'Regarder en arrière',
	'TOPICS_ONLY'								=> 'Sujets seulement?',
	'TOPICS_PER_PAGE'							=> 'Par page',

	'WORD_MAX_SIZE'								=> 'Taille maximale de police',
	'WORD_MIN_SIZE'								=> 'Taille minimale de police',
));
