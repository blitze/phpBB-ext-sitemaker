<?php
/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
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

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'ACP_MENU'					=> 'Menu',
	'ACP_MENU_MANAGE'			=> 'Gestion des menus',
	'ACP_MENU_MANAGE_EXPLAIN'	=> 'Ici vous pouvez créer et gérer des menus pour votre site',
	'ADD_BULK_MENU'				=> 'Ajouter en masse des éléments de menu',
	'ADD_BULK_MENU_EXPLAIN'		=> 'Ajouter plusieurs éléments de menu à la fois.<br /> - Placez chacun des éléments sur une ligne séparée<br /> - Utilisez la touche <strong>Tab</strong> pour indenter les éléments afin de représenter les relations parents-enfants<br /> - Saisir les éléments et URL de cette façon : Accueil|index.php',
	'ADD_MENU'					=> 'Ajouter un menu',
	'ADD_MENU_ITEM'				=> 'Ajouter un élément de menu',
	'ADD_ITEM'					=> 'Ajouter un nouvel élément',
	'AJAX_PROCESSING'			=> 'En cours',

	'CHANGE_ME'					=> 'Changer moi',

	'DELETE_ITEM'				=> 'Supprimer l\'élément',
	'DELETE_KIDS'				=> 'Supprimer la branche',
	'DELETE_MENU'				=> 'Supprimer le menu',
	'DELETE_MENU_CONFIRM'		=> 'Êtes-vous sûr de vouloir supprimer ce menu ?<br />Cela supprimera le menu et tous ses éléments',
	'DELETE_MENU_ITEM'			=> 'Supprimer l\'élément',
	'DELETE_MENU_ITEM_CONFIRM'	=> 'Êtes-vous sûr de vouloir supprimer cet élément de menu ?',
	'DELETE_SELECTED'			=> 'Supprimer la sélection',

	'EDIT_ITEM'					=> 'Éditer',

	'ITEM_ACTIVE'				=> 'Actif',
	'ITEM_INACTIVE'				=> 'Inactif',
	'ITEM_PARENT'				=> 'Parent',
	'ITEM_TITLE'				=> 'Titre de l\'élément',
	'ITEM_TITLE_EXPLAIN'		=> 'Définir comme \'-\' pour le séparateur',
	'ITEM_TARGET'				=> 'Cible de l\'élément',
	'ITEM_URL'					=> 'URL de l\'élément',
	'ITEM_URL_EXPLAIN'			=> '- Laisser vide pour les rubriques<br />- Les sites externes doivent commencer par http(s)://, ftp://, //, etc',

	'MENU_ITEMS'				=> 'Éléments de menu',

	'NO_MENU_ITEMS'				=> 'Aucun élément de menu n\'a été créé',
	'NO_PARENT'					=> 'Aucun parent',

	'PROCESSING_ERROR'			=> 'Erreur de traitement',

	'REBUILD_TREE'				=> 'Reconstruire l\'arbre',
	'REQUIRED'					=> 'Requis',
	'REQUIRED_FIELDS'			=> '* Champs requis',

	'SAVE_CHANGES'				=> 'Enregistrer les modifications',
	'SAVE'						=> 'Sauver',
	'SELECT_ALL'				=> 'Tout sélectionner',

	'TARGET_BLANK'				=> 'Page vide',
	'TARGET_PARENT'				=> 'Parent',

	'UNSAVED_CHANGES'			=> 'Vous avez des modifications non enregistrées',

	'VISIT_PAGE'				=> 'Visiter la page',
));
