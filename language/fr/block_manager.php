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
	'ADD_BLOCK_EXPLAIN'							=> '*Blocs de glisser-déposer',
	'AJAX_ERROR'								=> 'Oups ! Une erreur s\'est produite lors du traitement de votre demande. Veuillez réessayer.',
	'AJAX_LOADING'								=> 'Chargement en cours...',
	'AJAX_PROCESSING'							=> 'Traitement...',

	'BACKGROUND'								=> 'Arrière-plan',
	'BLOCKS'									=> 'Blocs',
	'BLOCKS_COPY_FROM'							=> 'Copier les blocs',
	'BLOCK_ACTIVE'								=> 'Actif',
	'BLOCK_CHILD_ROUTES_ONLY'					=> 'Afficher uniquement sur les routes enfants',
	'BLOCK_CHILD_ROUTES_HIDE'					=> 'Cacher sur les routes enfants',
	'BLOCK_CLASS'								=> 'Classe CSS',
	'BLOCK_CLASS_EXPLAIN'						=> 'Modifier l\'apparence du bloc avec les classes CSS',
	'BLOCK_DESIGN'								=> 'Apparence',
	'BLOCK_DISPLAY_TYPE'						=> 'Afficher',
	'BLOCK_HIDE_TITLE'							=> 'Cacher le titre du bloc ?',
	'BLOCK_INACTIVE'							=> 'Inactif',
	'BLOCK_MISSING_TEMPLATE'					=> 'Modèle de bloc requis manquant. Veuillez contacter le développeur',
	'BLOCK_NOT_FOUND'							=> 'Oups ! Le service de bloc demandé n\'a pas été trouvé',
	'BLOCK_NO_DATA'								=> 'Aucune donnée à afficher',
	'BLOCK_NO_ID'								=> 'Oups! Identifiant de bloc manquant',
	'BLOCK_PERMISSION'							=> 'Permission',
	'BLOCK_PERMISSION_ALLOW'					=> 'Afficher à',
	'BLOCK_PERMISSION_DENY'						=> 'Cacher de',
	'BLOCK_PERMISSION_EXPLAIN'					=> 'Utilisez CTRL + clic pour basculer la sélection',
	'BLOCK_SHOW_ALWAYS'							=> 'Toujours',
	'BLOCK_STATUS'								=> 'Statut',
	'BLOCK_UPDATED'								=> 'Paramètres du bloc mis à jour avec succès',

	'CANCEL'									=> 'Abandonner',
	'CHILD_ROUTE'								=> 'Enfant',
	'CHILD_ROUTE_EXPLAIN'						=> '/viewforum.php, /dir/index.php<br />/viewtopic.php?f=2&t=1<br />/articles/my-article',
	'CLEAR'										=> 'Nettoyer',
	'COPY'										=> 'Copie',
	'COPY_BLOCKS'								=> 'Copier les blocs?',
	'COPY_BLOCKS_CONFIRM'						=> 'Êtes-vous sûr de vouloir copier des blocs depuis une autre page ?<br /><br />Ceci supprimera tous les blocs existants et leurs paramètres pour cette page et les remplacera par les blocs de la page sélectionnée.',

	'DEFAULT_LAYOUT_EXPLAIN'					=> 'Si défini, toutes les pages du site pour lesquelles vous n\'avez pas spécifié de blocs hériteront des blocs de la disposition par défaut. Vous pouvez cependant remplacer la mise en page par défaut pour des pages particulières en utilisant les options à droite.',
	'DELETE'									=> 'Supprimez',
	'DELETE_ALL_BLOCKS'							=> 'Supprimer tous les blocs',
	'DELETE_ALL_BLOCKS_CONFIRM'					=> 'Êtes-vous sûr de vouloir supprimer tous les blocs de cette page ?',
	'DELETE_BLOCK'								=> 'Supprimer le bloc',
	'DELETE_BLOCK_CONFIRM'						=> 'Êtes-vous sûr de vouloir supprimer ce bloc ?<br /><br /><br /><strong>Remarque :</strong> Vous devrez enregistrer les modifications de mise en page pour rendre ce permanent.',

	'EDIT'										=> 'Editer',
	'EDIT_BLOCK'								=> 'Modifier le bloc',
	'EXIT_EDIT_MODE'							=> 'Quitter le mode d\'édition',

	'FEED_PROBLEMS'								=> 'Un problème est survenu lors du traitement des flux rss/atom fournis',
	'FEED_URL_MISSING'							=> 'Veuillez fournir au moins un flux rss/atom pour commencer',
	'FIELD_INVALID'								=> 'La valeur fournie pour le champ “%s” a un format invalide',
	'FIELD_REQUIRED'							=> '«%s» est un champ obligatoire',
	'FIELD_TOO_LONG'							=> 'La valeur fournie pour le champ «%1$s» est trop longue. La valeur maximale acceptable est de %2$d.',
	'FIELD_TOO_SHORT'							=> 'La valeur fournie pour le champ «%1$s» est trop courte. La valeur minimale acceptable est de %2$d.',

	'HIDE_ALL_BLOCKS'							=> 'Ne pas afficher les blocs sur cette page',
	'HIDE_BLOCK_POSITIONS'						=> 'Ne pas afficher les blocs pour les positions de bloc suivantes:',

	'IMAGES'									=> 'Images',

	'LAYOUT'									=> 'Mise en page',
	'LAYOUT_SAVED'								=> 'Mise en page enregistrée avec succès !',
	'LAYOUT_SETTINGS'							=> 'Paramètres de mise en page',
	'LEAVE_CONFIRM'								=> 'Vous avez des modifications non enregistrées sur cette page. Veuillez enregistrer votre travail avant de vous déplacer',
	'LISTS'										=> 'Listes',

	'MAKE_DEFAULT_LAYOUT'						=> 'Définir comme mise en page par défaut',

	'OR'										=> '<strong>OU</strong>',

	'PARENT_ROUTE'								=> 'Parent',
	'PARENT_ROUTE_EXPLAIN'						=> '/index.php<br />/viewforum.php?f=2<br />/articles',
	'PREDEFINED_CLASSES'						=> 'Classes prédéfinies',

	'REDO'										=> 'Refaire',
	'REMOVE_DEFAULT_LAYOUT'						=> 'Retirer comme mise en page par défaut',
	'REMOVE_STARTPAGE'							=> 'Supprimer la page de démarrage',
	'ROUTE_HIDDEN_BLOCKS'						=> 'Les blocs sont masqués pour cette page',
	'ROUTE_HIDDEN_POSITIONS'					=> 'Les blocs sont masqués pour les positions suivantes',
	'ROUTE_UPDATED'								=> 'Paramètres de la page mis à jour avec succès',

	'SAVE_CHANGES'								=> 'Enregistrer les modifications',
	'SAVE_SETTINGS'								=> 'Enregistrer les paramètres',
	'SELECT_ICON'								=> 'Sélectionnez une icône',
	'SETTINGS'									=> 'Réglages',
	'SETTING_TOO_BIG'							=> 'La valeur fournie pour le paramètre «%1$s» est trop élevée. La valeur maximale acceptable est de %2$d.',
	'SETTING_TOO_LONG'							=> 'La valeur fournie pour le paramètre «%1$s» est trop longue. La longueur maximale acceptable est de %2$d.',
	'SETTING_TOO_LOW'							=> 'La valeur fournie pour le paramètre «%1$s» est trop faible. La valeur minimale acceptable est %2$d.',
	'SETTING_TOO_SHORT'							=> 'La valeur fournie pour le paramètre «%1$s» est trop courte. La longueur minimale acceptable est de %2$d.',
	'SET_STARTPAGE'								=> 'Définir comme page de départ',

	'TITLES'									=> 'Titres',

	'UPDATE_SIMILAR'							=> 'Mettre à jour les blocs avec des paramètres similaires',
	'UNDO'										=> 'Annuler',

	'VIEW_DEFAULT_LAYOUT'						=> 'Afficher/Modifier la mise en page par défaut',
	'VISIT_PAGE'								=> 'Visiter la page',
));
