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
	'AUTHORS'			=> 'Autoren (Array)',
	'BITRATE'			=> 'bitrate',
	'CAPTIONS'			=> 'unterschriften',
	'CATEGORIES'		=> 'Kategorien (Array)',
	'CATEGORY'			=> 'kategorie',
	'CHANNELS'			=> 'kanäle',
	'CONTENT'			=> 'inhalt',
	'CONTRIBUTOR'		=> 'mitwirkender',
	'CONTRIBUTORS'		=> 'beitragszahler (Array)',
	'COPYRIGHT'			=> 'Urheberrecht',
	'CREDITS'			=> 'guthaben',
	'DATE'				=> 'datum',
	'DESCRIPTION'		=> 'beschreibung',
	'DURATION'			=> 'dauern',
	'ENCLOSURE'			=> 'einschließung',
	'ENCLOSURES'		=> 'gehäuse (Array)',
	'EXPRESSION'		=> 'ausdruck',
	'FEED'				=> 'federn',
	'FRAMERATE'			=> 'framerate',
	'GMDATE'			=> 'GM-Datum',
	'HANDLER'			=> 'handler',
	'HASHES'			=> 'hashes',
	'HEIGHT'			=> 'Höhe',
	'ID'				=> 'id',
	'IMAGE_HEIGHT'		=> 'Bildhöhe',
	'IMAGE_LINK'		=> 'bildlink',
	'IMAGE_TITLE'		=> 'bildtitel',
	'IMAGE_URL'			=> 'bild-URL',
	'IMAGE_WIDTH'		=> 'Bildbreite',
	'ITEMS'				=> 'gegenstände',
	'JAVASCRIPT'		=> 'Javascript',
	'KEYWORDS'			=> 'keywords',
	'LABEL'				=> 'bezeichnen',
	'LANG'				=> 'lang',
	'LATITUDE'			=> 'breiter',
	'LENGTH'			=> 'lang',
	'LINK'				=> 'link',
	'LINKS'				=> 'links',
	'LONGITUDE'			=> 'Längengrad',
	'MEDIUM'			=> 'mittel',
	'NAME'				=> 'name',
	'PERMALINK'			=> 'permalink',
	'PLAYER'			=> 'player',
	'RATINGS'			=> 'bewertungen',
	'RELATIONSHIP'		=> 'beziehung',
	'RESTRICTIONS'		=> 'Beschränkungen (Array)',
	'SAMPLINGRATE'		=> 'Abtastrate',
	'SCHEME'			=> 'schema',
	'SOURCE'			=> 'quell',
	'TERM'				=> 'begriff',
	'THUMBNAILS'		=> 'thumbnails',
	'TITLE'				=> 'titel',
	'TYPE'				=> 'typ',
	'UPDATED_DATE'		=> 'aktualisiertes Datum',
	'UPDATED_GMDATE'	=> 'aktualisiertes GM-Datum',
	'VALUE'				=> 'wert',
	'WIDTH'				=> 'width',
));
