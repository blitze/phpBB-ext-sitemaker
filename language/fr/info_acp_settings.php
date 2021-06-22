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
	'ACP_SM_SETTINGS'	=> 'Réglages',

	'BLOCKS_CLEANUP'			=> 'Nettoyage des blocs',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'Les éléments suivants ont été trouvés pour ne plus exister ou inaccessibles, et vous pouvez donc supprimer tous les blocs qui leur sont associés. Veuillez garder à l\'esprit que certaines d\'entre elles peuvent être fausses positives',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Blocs non valides (par exemple à partir d\'extensions désinstallées) :',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Pages injoignables/cassées :',
	'BLOCKS_CLEANUP_STYLES'		=> 'Styles désinstallés (IDs) :',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Blocs purgés avec succès',

	'FORUM_INDEX_SETTINGS'			=> 'Paramètres de l\'index du forum',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'Ces paramètres ne s\'appliquent que s\'il n\'y a pas de page de démarrage définie',

	'HIDE'			=> 'Cacher',
	'HIDE_BIRTHDAY'	=> 'Masquer la section Anniversaire',
	'HIDE_LOGIN'	=> 'Cacher la boîte de connexion',
	'HIDE_ONLINE'	=> 'Cacher la section Qui est en ligne',

	'LAYOUT_BLOG'		=> 'Blogue',
	'LAYOUT_CUSTOM'		=> 'Personnalisé',
	'LAYOUT_HOLYGRAIL'	=> 'Saint Graal',
	'LAYOUT_PORTAL'		=> 'Portail',
	'LAYOUT_PORTAL_ALT'	=> 'Portail (alt)',
	'LAYOUT_SETTINGS'	=> 'Paramètres de mise en page',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Blocs du constructeur de site supprimés pour le style manquant avec l\'id %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Blocs du constructeur de site supprimés pour les pages cassées :<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Blocs de Sitemaker invalides supprimés :<br />%s',

	'NAVIGATION_SETTINGS'		=> 'Paramètres de navigation',

	'SETTINGS_SAVED'			=> 'Vos paramètres ont été enregistrés',
	'SHOW'						=> 'Afficher',
	'SHOW_FORUM_NAV'			=> 'Afficher \'Forum\' dans la barre de navigation ?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'Quand une page est définie comme page de démarrage au lieu de l\'index du forum, devrions-nous afficher le \'Forum\' dans la barre de navigation',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Oui - avec l\'icône :',
]);
