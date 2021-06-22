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
	'AUTHOR'			=> 'autor',
	'AUTHORS'			=> 'autori (array)',
	'BITRATE'			=> 'bitrate',
	'CAPTIONS'			=> 'subtitrări',
	'CATEGORIES'		=> 'categorii (array)',
	'CATEGORY'			=> 'categorie',
	'CHANNELS'			=> 'canale',
	'CONTENT'			=> 'Conținut',
	'CONTRIBUTOR'		=> 'contribuitor',
	'CONTRIBUTORS'		=> 'contribuitori (array)',
	'COPYRIGHT'			=> 'drepturi de autor',
	'CREDITS'			=> 'credite',
	'DATE'				=> 'dată',
	'DESCRIPTION'		=> 'descriere',
	'DURATION'			=> 'durată',
	'ENCLOSURE'			=> 'delimitate',
	'ENCLOSURES'		=> 'închideri (array)',
	'EXPRESSION'		=> 'expresie',
	'FEED'				=> 'feed',
	'FRAMERATE'			=> 'framerate',
	'GMDATE'			=> 'Data GM',
	'HANDLER'			=> 'handler',
	'HASHES'			=> 'hash-uri',
	'HEIGHT'			=> 'înălțime',
	'ID'				=> 'id',
	'IMAGE_HEIGHT'		=> 'înălțimea imaginii',
	'IMAGE_LINK'		=> 'link-ul imaginii',
	'IMAGE_TITLE'		=> 'titlu imagine',
	'IMAGE_URL'			=> 'URL-ul imaginii',
	'IMAGE_WIDTH'		=> 'lăţimea imaginii',
	'ITEMS'				=> 'articole',
	'JAVASCRIPT'		=> 'javascript',
	'KEYWORDS'			=> 'cuvinte cheie',
	'LABEL'				=> 'etichetă',
	'LANG'				=> 'lang',
	'LATITUDE'			=> 'latitudine',
	'LENGTH'			=> 'lungime',
	'LINK'				=> 'link',
	'LINKS'				=> 'link-uri',
	'LONGITUDE'			=> 'longitudine',
	'MEDIUM'			=> 'medie',
	'NAME'				=> 'nume',
	'PERMALINK'			=> 'permalink',
	'PLAYER'			=> 'jucător',
	'RATINGS'			=> 'evaluări',
	'RELATIONSHIP'		=> 'relatie',
	'RESTRICTIONS'		=> 'restricții (array)',
	'SAMPLINGRATE'		=> 'rata de eşantionare',
	'SCHEME'			=> 'schemă',
	'SOURCE'			=> 'sursă',
	'TERM'				=> 'termen',
	'THUMBNAILS'		=> 'thumbnails',
	'TITLE'				=> 'titlu',
	'TYPE'				=> 'tip',
	'UPDATED_DATE'		=> 'dată actualizată',
	'UPDATED_GMDATE'	=> 'Actualizare dată GM',
	'VALUE'				=> 'valoare',
	'WIDTH'				=> 'width',
));
