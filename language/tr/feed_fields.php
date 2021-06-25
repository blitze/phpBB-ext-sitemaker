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
	'AUTHOR'			=> 'yazar',
	'AUTHORS'			=> 'authors (array)',
	'BITRATE'			=> 'bitrate',
	'CAPTIONS'			=> 'captions',
	'CATEGORIES'		=> 'categories (array)',
	'CATEGORY'			=> 'category',
	'CHANNELS'			=> 'channels',
	'CONTENT'			=> 'content',
	'CONTRIBUTOR'		=> 'contributor',
	'CONTRIBUTORS'		=> 'contributors (array)',
	'COPYRIGHT'			=> 'copyright',
	'CREDITS'			=> 'credits',
	'DATE'				=> 'date',
	'DESCRIPTION'		=> 'description',
	'DURATION'			=> 'duration',
	'ENCLOSURE'			=> 'enclosure',
	'ENCLOSURES'		=> 'enclosures (array)',
	'EXPRESSION'		=> 'expression',
	'FEED'				=> 'feed',
	'FRAMERATE'			=> 'framerate',
	'GMDATE'			=> 'GM date',
	'HANDLER'			=> 'handler',
	'HASHES'			=> 'hashes',
	'HEIGHT'			=> 'height',
	'ID'				=> 'id',
	'IMAGE_HEIGHT'		=> 'image height',
	'IMAGE_LINK'		=> 'image link',
	'IMAGE_TITLE'		=> 'image title',
	'IMAGE_URL'			=> 'image url',
	'IMAGE_WIDTH'		=> 'image width',
	'ITEMS'				=> 'items',
	'JAVASCRIPT'		=> 'javascript',
	'KEYWORDS'			=> 'keywords',
	'LABEL'				=> 'label',
	'LANG'				=> 'lang',
	'LATITUDE'			=> 'latitude',
	'LENGTH'			=> 'length',
	'LINK'				=> 'link',
	'LINKS'				=> 'links',
	'LONGITUDE'			=> 'longitude',
	'MEDIUM'			=> 'medium',
	'NAME'				=> 'name',
	'PERMALINK'			=> 'permalink',
	'PLAYER'			=> 'player',
	'RATINGS'			=> 'ratings',
	'RELATIONSHIP'		=> 'relationship',
	'RESTRICTIONS'		=> 'restrictions (array)',
	'SAMPLINGRATE'		=> 'sampling rate',
	'SCHEME'			=> 'scheme',
	'SOURCE'			=> 'source',
	'TERM'				=> 'term',
	'THUMBNAILS'		=> 'thumbnails',
	'TITLE'				=> 'title',
	'TYPE'				=> 'type',
	'UPDATED_DATE'		=> 'updated date',
	'UPDATED_GMDATE'	=> 'updated GM date',
	'VALUE'				=> 'value',
	'WIDTH'				=> 'width',
));
