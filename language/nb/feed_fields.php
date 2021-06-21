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
	'CAPTIONS'			=> 'bildetekster',
	'CATEGORIES'		=> 'kategorier (matrise)',
	'CATEGORY'			=> 'kategori',
	'CHANNELS'			=> 'kanaler',
	'CONTENT'			=> 'innhold',
	'CONTRIBUTOR'		=> 'bidrager',
	'CONTRIBUTORS'		=> 'bidragsytere (sjelden)',
	'COPYRIGHT'			=> 'opphavsrett',
	'CREDITS'			=> 'kreditter',
	'DATE'				=> 'dato',
	'DESCRIPTION'		=> 'beskrivelse',
	'DURATION'			=> 'varighet',
	'ENCLOSURE'			=> 'kabinett',
	'ENCLOSURES'		=> 'innkapslinger (matrise)',
	'EXPRESSION'		=> 'uttrykk',
	'FEED'				=> 'nyhetsstrøm',
	'FRAMERATE'			=> 'bildefrekvens',
	'GMDATE'			=> 'GM dato',
	'HANDLER'			=> 'handler',
	'HASHES'			=> 'hashes',
	'HEIGHT'			=> 'høyde',
	'ID'				=> 'id',
	'IMAGE_HEIGHT'		=> 'bilde høyde',
	'IMAGE_LINK'		=> 'bildelink',
	'IMAGE_TITLE'		=> 'bilde tittel',
	'IMAGE_URL'			=> 'Bilde url',
	'IMAGE_WIDTH'		=> 'bredde på bilde',
	'ITEMS'				=> 'elementer',
	'JAVASCRIPT'		=> 'JavaScript',
	'KEYWORDS'			=> 'nøkkelord',
	'LABEL'				=> 'etikett',
	'LANG'				=> 'lang',
	'LATITUDE'			=> 'breddegrad',
	'LENGTH'			=> 'lengde',
	'LINK'				=> 'kobling',
	'LINKS'				=> 'linker',
	'LONGITUDE'			=> 'lengdegrad',
	'MEDIUM'			=> 'middels',
	'NAME'				=> 'navn',
	'PERMALINK'			=> 'permalenke',
	'PLAYER'			=> 'spiller',
	'RATINGS'			=> 'vurderinger',
	'RELATIONSHIP'		=> 'forhold',
	'RESTRICTIONS'		=> 'restriksjoner (matrise)',
	'SAMPLINGRATE'		=> 'hyppighet for prøvetaking',
	'SCHEME'			=> 'skjema',
	'SOURCE'			=> 'kilde',
	'TERM'				=> 'term',
	'THUMBNAILS'		=> 'thumbnails',
	'TITLE'				=> 'tittel',
	'TYPE'				=> 'type',
	'UPDATED_DATE'		=> 'oppdatert dato',
	'UPDATED_GMDATE'	=> 'oppdatert GM-dato',
	'VALUE'				=> 'verdi',
	'WIDTH'				=> 'width',
));
