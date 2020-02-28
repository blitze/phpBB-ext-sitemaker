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
	'AUTHORS'			=> 'autoren (Array)',
	'BITRATE'			=> 'bitrate',
	'CAPTIONS'			=> 'untertitel',
	'CATEGORIES'		=> 'kategorien (Array)',
	'CATEGORY'			=> 'kategorie',
	'CHANNELS'			=> 'kanäle',
	'CONTENT'			=> 'inhalte',
	'CONTRIBUTOR'		=> 'mitwirkender',
	'CONTRIBUTORS'		=> 'mitwirkende (Array)',
	'COPYRIGHT'			=> 'urheberrechtlich',
	'CREDITS'			=> 'guthaben',
	'DATE'				=> 'datum',
	'DESCRIPTION'		=> 'beschreibung',
	'DURATION'			=> 'dauer',
	'ENCLOSURE'			=> 'eingeschlossen',
	'ENCLOSURES'		=> 'gehäuse (Array)',
	'EXPRESSION'		=> 'ausdruck',
	'FEED'				=> 'feed',
	'FRAMERATE'			=> 'framerieren',
	'GMDATE'			=> 'GM Datum',
	'HANDLER'			=> 'handler',
	'HASHES'			=> 'hashes',
	'HEIGHT'			=> 'höhe',
	'ID'				=> 'd',
	'IMAGE_HEIGHT'		=> 'bildhöhe',
	'IMAGE_LINK'		=> 'bild-Link',
	'IMAGE_TITLE'		=> 'bildtitel',
	'IMAGE_URL'			=> 'bild-Url',
	'IMAGE_WIDTH'		=> 'bilderbreite',
	'ITEMS'				=> 'gegenstände',
	'JAVASCRIPT'		=> 'Javascript',
	'KEYWORDS'			=> 'keywords',
	'LABEL'				=> 'beschriftung',
	'LANG'				=> 'lang',
	'LATITUDE'			=> 'breitengrad',
	'LENGTH'			=> 'lang',
	'LINK'				=> 'link',
	'LINKS'				=> 'verweise',
	'LONGITUDE'			=> 'längs',
	'MEDIUM'			=> 'mittel',
	'NAME'				=> 'name',
	'PERMALINK'			=> 'permalink',
	'PLAYER'			=> 'spieler',
	'RATINGS'			=> 'bewertungen',
	'RELATIONSHIP'		=> 'beziehung',
	'RESTRICTIONS'		=> 'Einschränkungen (Array)',
	'SAMPLINGRATE'		=> 'sampling Rate',
	'SCHEME'			=> 'schema',
	'SOURCE'			=> 'quelle',
	'TERM'				=> 'termin',
	'THUMBNAILS'		=> 'Thumbnails',
	'TITLE'				=> 'titel',
	'TYPE'				=> 'art',
	'UPDATED_DATE'		=> 'aktualisiert Datum',
	'UPDATED_GMDATE'	=> 'aktualisierte GM-Datum',
	'VALUE'				=> 'wert',
	'WIDTH'				=> 'breite',
));
