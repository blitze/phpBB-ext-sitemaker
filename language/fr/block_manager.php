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
	'ADD_BLOCK_EXPLAIN'							=> '*Blocs Glisser-déposer',
	'AJAX_ERROR'								=> 'Oups ! Une erreur est survenue durant le traitement de votre demande. Veuillez réessayer s\'il vous plaît.',
	'AJAX_LOADING'								=> 'Chargement...',
	'AJAX_PROCESSING'							=> 'En cours...',

	'BACKGROUND'								=> 'Arrière-plan',
	'BLOCKS'									=> 'Blocs',
	'BLOCKS_COPY_FROM'							=> 'Copier les blocs',
	'BLOCK_ACTIVE'								=> 'Actif',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Afficher uniquement sur les routes enfants',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Masquer sur les routes enfants',
	'BLOCK_CLASS'								=> 'Classe CSS',
	'BLOCK_CLASS_EXPLAIN'						=> 'Modifier l\'apparence du bloc avec les classes CSS',
	'BLOCK_DESIGN'								=> 'Apparence',
	'BLOCK_DISPLAY_TYPE'						=> 'Affichage',
	'BLOCK_HIDE_TITLE'							=> 'Masquer le titre du bloc ?',
	'BLOCK_INACTIVE'							=> 'Inactif',
	'BLOCK_MISSING_TEMPLATE'					=> 'Modèle de bloc requis manquant. Veuillez contacter le développeur',
	'BLOCK_NOT_FOUND'							=> 'Oups! Le service de bloc demandé n\'a pas été trouvé',
	'BLOCK_NO_DATA'								=> 'Aucune donnée à afficher',
	'BLOCK_NO_ID'								=> 'Oups ! L\'identifiant de bloc est manquant',
	'BLOCK_PERMISSION'							=> 'Permission',
	'BLOCK_PERMISSION_ALLOW'					=> 'Afficher à',
	'BLOCK_PERMISSION_DENY'						=> 'Cacher de',
	'BLOCK_PERMISSION_EXPLAIN'					=> 'Utilisez CTRL + clic pour basculer la sélection',
	'BLOCK_SHOW_ALWAYS'							=> 'Toujours',
	'BLOCK_STATUS'								=> 'Etat',
	'BLOCK_UPDATED'								=> 'Les paramètres de blocs ont été mis à jour avec succès',

	'CANCEL'									=> 'Annuler',
	'CHILD_ROUTE'								=> 'Enfant',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/mon-article',
	'CLEAR'										=> 'Effacer',
	'COPY'										=> 'Copier',
	'COPY_BLOCKS'								=> 'Copier les blocs ?',
	'COPY_BLOCKS_CONFIRM'						=> 'Êtes-vous sûr de vouloir copier les blocs d\'une autre page ?<br /><br />Ceci supprimera tous les blocs existants et leurs paramètres sur cette page et les remplacera par les blocs de la page sélectionnée.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'Si défini, toutes les pages du site pour lesquelles vous n\'avez pas de blocs spécifiés hériteront des blocs de la disposition par défaut. Vous pouvez cependant remplacer la disposition par défaut pour certaines pages en utilisant les options à droite.',
	'DELETE'									=> 'Supprimer',
	'DELETE_ALL_BLOCKS'							=> 'Supprimer tous les blocs',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'Êtes-vous sûr de vouloir supprimer tous les blocs de cette page ?',
	'DELETE_BLOCK'								=> 'Supprimer le bloc',
	'DELETE_BLOCK_CONFIRM'						=> 'Êtes-vous sûr de vouloir supprimer ce bloc ?<br /><br /><br /><strong>Remarque :</strong> Vous devrez enregistrer les changements de disposition afin de rendre cette suppression permanente.',

	'EDIT'										=> 'Editer',
	'EDIT_BLOCK'								=> 'Editer le bloc',
	'EXIT_EDIT_MODE'							=> 'Quitter le mode d\'édition',

	'FEED_PROBLEMS'								=> 'Un problème est survenu lors du traitement des flux rss/atom fournis(s).',
	'FEED_URL_MISSING'							=> 'Veuillez indiquer au moins un flux rss/atom pour commencer',
	'FIELD_INVALID'								=> 'La valeur fournie pour le champ «%s» utilise un format invalide',
	'FIELD_REQUIRED'							=> 'Le champ «%s» est obligatoire',
	'FIELD_TOO_LONG'							=> 'La valeur indiquée pour le champ «%1$s» est trop longue. La valeur maximale acceptable est de %2$d.',
	'FIELD_TOO_SHORT'							=> 'La valeur indiquée pour le champ «%1$s» est trop courte. La valeur minimale acceptable est de %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'Ne pas afficher de bloc sur cette page',
	'HIDE_BLOCK_POSITIONS'						=> 'Ne pas afficher de bloc pour les positions de bloc suivantes :',

	'IMAGES'									=> 'Images',

	'LAYOUT'									=> 'Disposition',
	'LAYOUT_SAVED'								=> 'Disposition enregistrée avec succès !',
	'LAYOUT_SETTINGS'							=> 'Paramètres de Disposition',
	'LEAVE_CONFIRM'								=> 'Vous avez des modifications non enregistrées sur cette page. Veuillez enregistrer votre travail avant de quitter celle-ci',
	'LISTS'										=> 'Listes',

	'MAKE_DEFAULT_LAYOUT'						=> 'Définir comme disposition par défaut',

	'OR'										=> '<strong>OU</strong>',

	'PARENT_ROUTE'								=> 'Parent',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/articles',
	'PREDEFINED_CLASSES'						=> 'Classes prédéfinies',

	'REDO'										=> 'Rétablir',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Supprimer en tant que disposition par défaut',
	'REMOVE_STARTPAGE'							=> 'Supprimer la page d\'accueil',
	'ROUTE_HIDDEN_BLOCKS'						=> 'Les blocs sont masqués pour cette page',
	'ROUTE_HIDDEN_POSITIONS'					=> 'Les blocs sont masqués pour les positions suivantes',
	'ROUTE_UPDATED'								=> 'Les paramètres de la page ont été mis à jour avec succès',

	'SAVE_CHANGES'								=> 'Enregistrer les modifications',
	'SAVE_SETTINGS'								=> 'Enregistrer les paramètres',
	'SELECT_ICON'								=> 'Sélectionner une icône',
	'SETTINGS'									=> 'Paramètres',
	'SETTING_TOO_BIG'							=> 'La valeur indiquée pour le paramètre «%1$s» est trop élevée. La valeur maximale acceptable est de %2$d.',
	'SETTING_TOO_LONG'							=> 'La valeur indiquée pour le paramètre «%1$s» est trop longue. La longueur maximale acceptable est de %2$d.',
	'SETTING_TOO_LOW'							=> 'La valeur indiquée pour le paramètre «%1$s» est trop faible. La valeur minimale acceptable est de %2$d.',
	'SETTING_TOO_SHORT'							=> 'La valeur indiquée pour le paramètre «%1$s» est trop courte. La longueur minimale acceptable est de %2$d.',
	'SET_STARTPAGE'								=> 'Définir en tant que page d\'accueil',

	'TITLES'									=> 'Titres',

	'UPDATE_SIMILAR'							=> 'Mettre à jour les blocs avec des paramètres similaires',
	'UNDO'										=> 'Annuler',

	'VIEW_DEFAULT_LAYOUT'						=> 'Afficher/Editer la disposition par défaut',
	'VISIT_PAGE'								=> 'Visiter la page',
));
