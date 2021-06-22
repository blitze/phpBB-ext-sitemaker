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
	'AUTHORS'			=> 'auteurs (array)',
	'BITRATE'			=> 'bitrate',
	'CAPTIONS'			=> 'bijschriften',
	'CATEGORIES'		=> 'categorieën (array)',
	'CATEGORY'			=> 'categorie',
	'CHANNELS'			=> 'kanalen',
	'CONTENT'			=> 'inhoud',
	'CONTRIBUTOR'		=> 'bijdrager',
	'CONTRIBUTORS'		=> 'bijdragers (array)',
	'COPYRIGHT'			=> 'auteursrechten',
	'CREDITS'			=> 'credits',
	'DATE'				=> 'datum',
	'DESCRIPTION'		=> 'beschrijving',
	'DURATION'			=> 'duur',
	'ENCLOSURE'			=> 'kast',
	'ENCLOSURES'		=> 'kasten (array)',
	'EXPRESSION'		=> 'expressie',
	'FEED'				=> 'feed',
	'FRAMERATE'			=> 'framerate',
	'GMDATE'			=> 'GM datum',
	'HANDLER'			=> 'handler',
	'HASHES'			=> 'hashes',
	'HEIGHT'			=> 'hoogte',
	'ID'				=> 'id',
	'IMAGE_HEIGHT'		=> 'hoogte afbeelding',
	'IMAGE_LINK'		=> 'link naar afbeelding',
	'IMAGE_TITLE'		=> 'titel afbeelding',
	'IMAGE_URL'			=> 'afbeelding url',
	'IMAGE_WIDTH'		=> 'breedte afbeelding',
	'ITEMS'				=> 'artikelen',
	'JAVASCRIPT'		=> 'javascript',
	'KEYWORDS'			=> 'trefwoorden',
	'LABEL'				=> 'Label',
	'LANG'				=> 'lang',
	'LATITUDE'			=> 'breedtegraad',
	'LENGTH'			=> 'Lengte',
	'LINK'				=> 'koppeling',
	'LINKS'				=> 'koppelingen',
	'LONGITUDE'			=> 'lengtegraad',
	'MEDIUM'			=> 'gemiddeld',
	'NAME'				=> 'Naam',
	'PERMALINK'			=> 'permalink',
	'PLAYER'			=> 'speler',
	'RATINGS'			=> 'waarderingen',
	'RELATIONSHIP'		=> 'relatie',
	'RESTRICTIONS'		=> 'beperkingen (array)',
	'SAMPLINGRATE'		=> 'sampling snelheid',
	'SCHEME'			=> 'schema',
	'SOURCE'			=> 'bron',
	'TERM'				=> 'term',
	'THUMBNAILS'		=> 'thumbnails',
	'TITLE'				=> 'Titel',
	'TYPE'				=> 'type',
	'UPDATED_DATE'		=> 'datum bijgewerkt',
	'UPDATED_GMDATE'	=> 'wijzigde GM datum',
	'VALUE'				=> 'waarde',
	'WIDTH'				=> 'width',
));
