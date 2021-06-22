<?php
/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

/**
* DO NOT CHANGE
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

/*
* These are errors which can be triggered by sending invalid data to the
* boardrules extension API.
*
* These errors will never show to a user unless they are either modifying
* the core boardrules extension code OR unless they are writing an extension
* which makes calls to this extension.
*
* Translators: Feel free to not translate these language strings
*/
$lang = array_merge($lang, array(
	'AUTHOR'			=> 'auteur·rice',
	'AUTHORS'			=> 'auteurs (tableau)',
	'BITRATE'			=> 'débit binaire',
	'CAPTIONS'			=> 'légendes',
	'CATEGORIES'		=> 'Catégories (tableau)',
	'CATEGORY'			=> 'Catégorie',
	'CHANNELS'			=> 'Chaînes',
	'CONTENT'			=> 'contenu',
	'CONTRIBUTOR'		=> 'contributeur',
	'CONTRIBUTORS'		=> 'contributeurs (tableau)',
	'COPYRIGHT'			=> 'Droit d\'auteur',
	'CREDITS'			=> 'crédits',
	'DATE'				=> 'date',
	'DESCRIPTION'		=> 'Libellé',
	'DURATION'			=> 'durée',
	'ENCLOSURE'			=> 'encapsulé',
	'ENCLOSURES'		=> 'enveloppes (tableau)',
	'EXPRESSION'		=> 'expression',
	'FEED'				=> 'flux',
	'FRAMERATE'			=> 'framerate',
	'GMDATE'			=> 'Date de MJ',
	'HANDLER'			=> 'handler',
	'HASHES'			=> 'hachage',
	'HEIGHT'			=> 'Hauteur',
	'ID'				=> 'id',
	'IMAGE_HEIGHT'		=> 'Hauteur de l\'image',
	'IMAGE_LINK'		=> 'lien de l\'image',
	'IMAGE_TITLE'		=> 'titre de l\'image',
	'IMAGE_URL'			=> 'url de l\'image',
	'IMAGE_WIDTH'		=> 'largeur de l\'image',
	'ITEMS'				=> 'Eléments',
	'JAVASCRIPT'		=> 'javascript',
	'KEYWORDS'			=> 'mots-clés',
	'LABEL'				=> 'Etiquette',
	'LANG'				=> 'lang',
	'LATITUDE'			=> 'latitude',
	'LENGTH'			=> 'Longueur',
	'LINK'				=> 'lien',
	'LINKS'				=> 'liens',
	'LONGITUDE'			=> 'longitude',
	'MEDIUM'			=> 'Moyen',
	'NAME'				=> 'Nom',
	'PERMALINK'			=> 'permalien',
	'PLAYER'			=> 'Joueur',
	'RATINGS'			=> 'évaluations',
	'RELATIONSHIP'		=> 'relation',
	'RESTRICTIONS'		=> 'restrictions (tableau)',
	'SAMPLINGRATE'		=> 'taux d\'échantillonnage',
	'SCHEME'			=> 'Schéma',
	'SOURCE'			=> 'source',
	'TERM'				=> 'durée',
	'THUMBNAILS'		=> 'thumbnails',
	'TITLE'				=> 'Titre:',
	'TYPE'				=> 'Type de type',
	'UPDATED_DATE'		=> 'Date de mise à jour',
	'UPDATED_GMDATE'	=> 'Date de mise à jour GM',
	'VALUE'				=> 'valeur',
	'WIDTH'				=> 'width',
));
