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
	'AUTHOR'			=> 'författare',
	'AUTHORS'			=> 'författare (array)',
	'BITRATE'			=> 'bithastighet',
	'CAPTIONS'			=> 'bildtexter',
	'CATEGORIES'		=> 'kategorier (array)',
	'CATEGORY'			=> 'Kategori',
	'CHANNELS'			=> 'kanaler',
	'CONTENT'			=> 'innehåll',
	'CONTRIBUTOR'		=> 'medverkande',
	'CONTRIBUTORS'		=> 'bidragsgivare (array)',
	'COPYRIGHT'			=> 'upphovsrätt',
	'CREDITS'			=> 'krediter',
	'DATE'				=> 'datum',
	'DESCRIPTION'		=> 'beskrivning',
	'DURATION'			=> 'varaktighet',
	'ENCLOSURE'			=> 'kapsling',
	'ENCLOSURES'		=> 'kapslingar (array)',
	'EXPRESSION'		=> 'uttryck',
	'FEED'				=> 'flöde',
	'FRAMERATE'			=> 'bildfrekvens',
	'GMDATE'			=> 'GM datum',
	'HANDLER'			=> 'handler',
	'HASHES'			=> 'hashar',
	'HEIGHT'			=> 'höjd',
	'ID'				=> 'id',
	'IMAGE_HEIGHT'		=> 'Bildens höjd',
	'IMAGE_LINK'		=> 'länk till bild',
	'IMAGE_TITLE'		=> 'bildens titel',
	'IMAGE_URL'			=> 'bild-URL',
	'IMAGE_WIDTH'		=> 'bild bredd',
	'ITEMS'				=> 'objekt',
	'JAVASCRIPT'		=> 'JavaScript',
	'KEYWORDS'			=> 'nyckelord',
	'LABEL'				=> 'etikett',
	'LANG'				=> 'lang',
	'LATITUDE'			=> 'latitud',
	'LENGTH'			=> 'längd',
	'LINK'				=> 'länk',
	'LINKS'				=> 'länkar',
	'LONGITUDE'			=> 'longitud',
	'MEDIUM'			=> 'medium',
	'NAME'				=> 'namn',
	'PERMALINK'			=> 'permalänk',
	'PLAYER'			=> 'spelare',
	'RATINGS'			=> 'betyg',
	'RELATIONSHIP'		=> 'förhållande',
	'RESTRICTIONS'		=> 'begränsningar (array)',
	'SAMPLINGRATE'		=> 'samplingshastighet',
	'SCHEME'			=> 'schema',
	'SOURCE'			=> 'källa',
	'TERM'				=> 'termin',
	'THUMBNAILS'		=> 'thumbnails',
	'TITLE'				=> 'titel',
	'TYPE'				=> 'typ',
	'UPDATED_DATE'		=> 'uppdaterat datum',
	'UPDATED_GMDATE'	=> 'uppdaterat GM-datum',
	'VALUE'				=> 'värde',
	'WIDTH'				=> 'width',
));
