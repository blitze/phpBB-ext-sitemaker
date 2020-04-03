<?php

/**
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

/**
 * @ignore
 */
if (!defined('IN_PHPBB')) {
    exit;
}

if (empty($lang) || !is_array($lang)) {
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
    'ACP_SITEMAKER' => 'Fabricant de site',
    'ACP_SM_SETTINGS' => 'Réglages',

    'BLOCKS_CLEANUP' => 'Nettoyage des blocs',
    'BLOCKS_CLEANUP_EXPLAIN' => 'Les éléments suivants ont été trouvés pour ne plus exister ou injoignable, et vous pouvez donc supprimer tous les blocs qui leur sont associés. Veuillez garder à l\'esprit que certains d\'entre eux peuvent être de faux positifs',
    'BLOCKS_CLEANUP_BLOCKS' => 'Blocs invalides (ex: depuis les extensions désinstallées) :',
    'BLOCKS_CLEANUP_ROUTES' => 'Pages injoignables/cassées:',
    'BLOCKS_CLEANUP_STYLES' => 'Styles désinstallés (ids) :',
    'BLOCKS_CLEANUP_SUCCESS' => 'Blocs purgés avec succès',

    'FILEMANAGER_SETTINGS' => 'Paramètres du Gestionnaire de fichiers',
    'FILEMANAGER_STATUS' => 'Statut',
    'FILEMANAGER_NO_EXIST' => 'You will need to install the File Manager before you can enable it. Installation instructions are found <a href="%s" target="_blank"  rel="noopener noreferrer"><strong>here</strong></a>',
    'FILEMENAGER_NOT_WRITABLE' => 'Filemanager config folder (root/ResponsiveFilemanager/filemanager/config/) is not writable. Please change the permissions to writable by all (777 or -rwxrwxrwx within your FTP Client)',
    'FILEMANAGER_IMAGE_AUTO_RESIZE' => 'Redimensionner automatiquement les images téléchargées ?',
    'FILEMANAGER_IMAGE_AUTO_RESIZE_DIMENSIONS' => 'Redimensionner aux dimensions spécifiées',
    'FILEMANAGER_IMAGE_AUTO_RESIZING_MODE' => 'Mode de redimensionnement automatique',
    'FILEMANAGER_IMAGE_MAX_DIMENSIONS' => 'Taille maximale de l\'image',
    'FILEMANAGER_IMAGE_MAX_MODE' => 'Mode max. taille d\'image',
    'FILEMANAGER_IMAGE_MODE_EXPLAIN' => 'Utilisé pour calculer la hauteur/largeur si vous ne fournissez que la hauteur ou la largeur mais pas les deux ci-dessus',
    'FILEMANAGER_IMAGE_MODE_AUTO' => 'Auto',
    'FILEMANAGER_IMAGE_MODE_CROP' => 'Rogner',
    'FILEMANAGER_IMAGE_MODE_EXACT' => 'Exactement',
    'FILEMANAGER_IMAGE_MODE_LANDSCAPE' => 'Paysage',
    'FILEMANAGER_IMAGE_MODE_PORTRAIT' => 'Portrait',
    'FILEMANAGER_WATERMARK' => 'Filigrane',
    'FILEMANAGER_WATERMARK_EXPLAIN' => 'URL de l\'image à utiliser comme filigrane sur toutes les images téléchargées',
    'FILEMANAGER_WATERMARK_POSITION' => 'Position du filigrane',
    'FILEMANAGER_WATERMARK_POSITION_EXPLAIN' => 'Sélectionnez une position prédéterminée où le filigrane doit apparaître ou entrez les coordonnées par ex. 50x100',
    'FILEMANAGER_WATERMARK_POSITION_TL' => 'Haut Gauche',
    'FILEMANAGER_WATERMARK_POSITION_T' => 'Haut',
    'FILEMANAGER_WATERMARK_POSITION_TR' => 'Haut Droit',
    'FILEMANAGER_WATERMARK_POSITION_L' => 'Gauche',
    'FILEMANAGER_WATERMARK_POSITION_M' => 'Milieu',
    'FILEMANAGER_WATERMARK_POSITION_R' => 'Droite',
    'FILEMANAGER_WATERMARK_POSITION_BL' => 'En bas à gauche',
    'FILEMANAGER_WATERMARK_POSITION_B' => 'En bas',
    'FILEMANAGER_WATERMARK_POSITION_BR' => 'En bas à droite',
    'FILEMANAGER_WATERMARK_POSITION_SUFFIX' => 'ou',
    'FILEMANAGER_WATERMARK_PADDING' => 'Remplissage du filigrane',
    'FILEMANAGER_WATERMARK_PADDING_EXPLAIN' => 'Si vous utilisez une position prédéterminée, vous pouvez ajuster le remplissage à partir des arbres. Si vous utilisez des coordonnées, cette valeur est ignorée',

    'FORUM_INDEX_SETTINGS' => 'Paramètres d\'index du forum',
    'FORUM_INDEX_SETTINGS_EXPLAIN' => 'Ces paramètres ne s\'appliquent que lorsqu\'il n\'y a pas de page de démarrage définie',

    'HIDE' => 'Cacher',
    'HIDE_BIRTHDAY' => 'Cacher la section Anniversaire',
    'HIDE_LOGIN' => 'Masquer le login',
    'HIDE_ONLINE' => 'Cacher la section en ligne',

    'LAYOUT_BLOG' => 'Blog',
    'LAYOUT_CUSTOM' => 'Personnalisé',
    'LAYOUT_HOLYGRAIL' => 'Graal Sacré',
    'LAYOUT_PORTAL' => 'Portail',
    'LAYOUT_PORTAL_ALT' => 'Portail (alt)',
    'LAYOUT_SETTINGS' => 'Paramètres de mise en page',

    'LOG_DELETED_BLOCKS_FOR_STYLE' => 'Blocs du sitemaker supprimés pour le style manquant avec l\'id %s',
    'LOG_DELETED_BLOCKS_FOR_ROUTE' => 'Blocs du sitemaker supprimés pour les pages cassées:<br />%s',
    'LOG_DELETED_BLOCKS' => 'Blocs de sitemaker invalides supprimés :<br />%s',

    'NAVIGATION_SETTINGS' => 'Paramètres de navigation',
    'NO_NAVBAR' => 'Aucun',

    'SELECT_NAVBAR_MENU' => 'Sélectionnez le menu de navigation principal',
    'SETTINGS_SAVED' => 'Vos paramètres ont été sauvegardés',
    'SHOW' => 'Montrer',
    'SHOW_FORUM_NAV' => 'Afficher \'Forum\' dans la barre de navigation ?',
    'SHOW_FORUM_NAV_EXPLAIN' => 'Lorsqu\'une page est définie comme page de démarrage au lieu de l\'index du forum, devrions-nous afficher \'Forum\' dans la barre de navigation',
    'SHOW_FORUM_NAV_WITH_ICON' => 'Oui - avec l\'icône :',
]);
