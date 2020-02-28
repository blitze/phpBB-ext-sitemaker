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
	'AUTHOR'			=> 'auteur',
	'AUTHORS'			=> 'auteurs (tableau)',
	'BITRATE'			=> 'bitrate',
	'CAPTIONS'			=> 'légendes',
	'CATEGORIES'		=> 'catégories (tableau)',
	'CATEGORY'			=> 'catégorie',
	'CHANNELS'			=> 'chaînes',
	'CONTENT'			=> 'contenu',
	'CONTRIBUTOR'		=> 'contributeur',
	'CONTRIBUTORS'		=> 'contributeurs (tableau)',
	'COPYRIGHT'			=> 'droit d\'auteur',
	'CREDITS'			=> 'crédits',
	'DATE'				=> 'date',
	'DESCRIPTION'		=> 'description',
	'DURATION'			=> 'durée',
	'ENCLOSURE'			=> 'clôture',
	'ENCLOSURES'		=> 'enclos (tableau)',
	'EXPRESSION'		=> 'expression',
	'FEED'				=> 'flux',
	'FRAMERATE'			=> 'framerate',
	'GMDATE'			=> 'Date de GM',
	'HANDLER'			=> 'gestionnaire',
	'HASHES'			=> 'hachages',
	'HEIGHT'			=> 'hauteur',
	'ID'				=> 'id',
	'IMAGE_HEIGHT'		=> 'hauteur de l\'image',
	'IMAGE_LINK'		=> 'lien image',
	'IMAGE_TITLE'		=> 'titre de l\'image',
	'IMAGE_URL'			=> 'url de l\'image',
	'IMAGE_WIDTH'		=> 'largeur de l\'image',
	'ITEMS'				=> 'articles',
	'JAVASCRIPT'		=> 'javascript',
	'KEYWORDS'			=> 'mots-clés',
	'LABEL'				=> 'étiquette',
	'LANG'				=> 'langue',
	'LATITUDE'			=> 'latitude',
	'LENGTH'			=> 'longueur',
	'LINK'				=> 'lien',
	'LINKS'				=> 'liens',
	'LONGITUDE'			=> 'longitude',
	'MEDIUM'			=> 'moyen',
	'NAME'				=> 'nom',
	'PERMALINK'			=> 'lien permalin',
	'PLAYER'			=> 'joueur',
	'RATINGS'			=> 'évaluations',
	'RELATIONSHIP'		=> 'relation',
	'RESTRICTIONS'		=> 'restrictions (tableau)',
	'SAMPLINGRATE'		=> 'taux d\'échantillonnage',
	'SCHEME'			=> 'schéma',
	'SOURCE'			=> 'source',
	'TERM'				=> 'terme',
	'THUMBNAILS'		=> 'miniatures',
	'TITLE'				=> 'titre',
	'TYPE'				=> 'type',
	'UPDATED_DATE'		=> 'date mise à jour',
	'UPDATED_GMDATE'	=> 'date de GM mise à jour',
	'VALUE'				=> 'valeur',
	'WIDTH'				=> 'largeur',
));
