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
	'AUTHOR'			=> 'forfatter',
	'AUTHORS'			=> 'forfattere (array)',
	'BITRATE'			=> 'bitrate',
	'CAPTIONS'			=> 'billedtekster',
	'CATEGORIES'		=> 'kategorier (array)',
	'CATEGORY'			=> 'kategori',
	'CHANNELS'			=> 'kanaler',
	'CONTENT'			=> 'indhold',
	'CONTRIBUTOR'		=> 'bidragyder',
	'CONTRIBUTORS'		=> 'bidragsydere (array)',
	'COPYRIGHT'			=> 'ophavsret',
	'CREDITS'			=> 'kreditter',
	'DATE'				=> 'dato',
	'DESCRIPTION'		=> 'beskrivelse',
	'DURATION'			=> 'varighed',
	'ENCLOSURE'			=> 'anlæggelse',
	'ENCLOSURES'		=> 'anlæg (array)',
	'EXPRESSION'		=> 'udtryk',
	'FEED'				=> 'feed',
	'FRAMERATE'			=> 'framerate',
	'GMDATE'			=> 'GM dato',
	'HANDLER'			=> 'handler',
	'HASHES'			=> 'hasher',
	'HEIGHT'			=> 'højde',
	'ID'				=> 'id',
	'IMAGE_HEIGHT'		=> 'billede højde',
	'IMAGE_LINK'		=> 'link til billede',
	'IMAGE_TITLE'		=> 'billede titel',
	'IMAGE_URL'			=> 'billede url',
	'IMAGE_WIDTH'		=> 'billedbredde',
	'ITEMS'				=> 'varer',
	'JAVASCRIPT'		=> 'javascript',
	'KEYWORDS'			=> 'emneord',
	'LABEL'				=> 'etiket',
	'LANG'				=> 'lang',
	'LATITUDE'			=> 'breddegrad',
	'LENGTH'			=> 'længde',
	'LINK'				=> 'link',
	'LINKS'				=> 'links',
	'LONGITUDE'			=> 'længdegrad',
	'MEDIUM'			=> 'medium',
	'NAME'				=> 'navn',
	'PERMALINK'			=> 'permalink',
	'PLAYER'			=> 'spiller',
	'RATINGS'			=> 'Bedømmelser',
	'RELATIONSHIP'		=> 'forhold',
	'RESTRICTIONS'		=> 'begrænsninger (array)',
	'SAMPLINGRATE'		=> 'prøveudtagningsprocent',
	'SCHEME'			=> 'skema',
	'SOURCE'			=> 'kilde',
	'TERM'				=> 'term',
	'THUMBNAILS'		=> 'thumbnails',
	'TITLE'				=> 'titel',
	'TYPE'				=> 'type',
	'UPDATED_DATE'		=> 'opdateret dato',
	'UPDATED_GMDATE'	=> 'opdateret GM dato',
	'VALUE'				=> 'værdi',
	'WIDTH'				=> 'width',
));
