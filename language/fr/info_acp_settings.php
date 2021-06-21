<?php

/**
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	$lang = [];
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

$lang = array_merge($lang, [
	'ACP_SITEMAKER'		=> 'SiteMaker',
	'ACP_SM_SETTINGS'	=> 'Paramètres',

	'BLOCKS_CLEANUP'			=> 'Nettoyage des blocs',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'Les éléments suivant apparaissent comme étant inexistants ou injoignables, vous pouvez donc supprimer les blocs qui y sont associés. Veuillez toutefois garder à l\'esprit qu\'il peut s\'agir, pour certains d\'entre eux, de faux-positifs',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Blocs non valides (ex : extensions désinstallées) :',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Pages injoignables/cassées:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Styles désinstallés (ids) :',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Blocs purgés avec succès',

	'FORUM_INDEX_SETTINGS'			=> 'Paramètres Index du Forum',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Ces paramètres ne s\'appliquent que lorsqu\'aucune page d\'accueil n\'est définie',

	'HIDE'			=> 'Masquer',
	'HIDE_BIRTHDAY'	=> 'Masquer la section Anniversaire',
	'HIDE_LOGIN'	=> 'Masquer la boîte de connexion',
	'HIDE_ONLINE'	=> 'Masquer la section "Qui est en ligne ?"',

	'LAYOUT_BLOG'		=> 'Blog',
	'LAYOUT_CUSTOM'		=> 'Personnalisé',
	'LAYOUT_HOLYGRAIL'	=> 'Sacré Graal',
	'LAYOUT_PORTAL'		=> 'Portail',
	'LAYOUT_PORTAL_ALT'	=> 'Portail (alternative)',
	'LAYOUT_SETTINGS'	=> 'Paramètres de Disposition',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Blocs Sitemaker supprimés en raison de l\'absence du style dont l\'identifiant est %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Blocs Sitemaker supprimés en raison de pages cassées:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Blocs Sitemaker invalides supprimés :<br />%s',

	'NAVIGATION_SETTINGS'		=> 'Paramètres de Navigation',

	'SETTINGS_SAVED'			=> 'Vos paramètres ont été enregistrés',
	'SHOW'						=> 'Afficher',
	'SHOW_FORUM_NAV'			=> 'Afficher \'Forum\' sur la barre de navigation ?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Lorsqu\'une page est définie comme page d\'accueil à la place de l\'index du forum, devons-nous afficher \'Forum\' dans la barre de navigation ?',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Oui - avec l\'icône :',
]);
