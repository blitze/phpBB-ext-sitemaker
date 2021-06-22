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
	'AUTHORS'			=> 'autoři (pole)',
	'BITRATE'			=> 'bitrate',
	'CAPTIONS'			=> 'titulky',
	'CATEGORIES'		=> 'kategorie (pole)',
	'CATEGORY'			=> 'Kategorie',
	'CHANNELS'			=> 'kanály',
	'CONTENT'			=> 'Obsah',
	'CONTRIBUTOR'		=> 'přispěvatel',
	'CONTRIBUTORS'		=> 'přispěvatelé (pole)',
	'COPYRIGHT'			=> 'autorská práva',
	'CREDITS'			=> 'kredity',
	'DATE'				=> 'Datum',
	'DESCRIPTION'		=> 'Popis',
	'DURATION'			=> 'doba trvání',
	'ENCLOSURE'			=> 'uzavřený prostor',
	'ENCLOSURES'		=> 'prostory (pole)',
	'EXPRESSION'		=> 'výraz',
	'FEED'				=> 'krmivo',
	'FRAMERATE'			=> 'snímková frekvence',
	'GMDATE'			=> 'Datum GM',
	'HANDLER'			=> 'handler',
	'HASHES'			=> 'pomlčky',
	'HEIGHT'			=> 'Výška',
	'ID'				=> 'id',
	'IMAGE_HEIGHT'		=> 'výška obrázku',
	'IMAGE_LINK'		=> 'odkaz na obrázek',
	'IMAGE_TITLE'		=> 'název obrázku',
	'IMAGE_URL'			=> 'URL obrázku',
	'IMAGE_WIDTH'		=> 'šířka obrázku',
	'ITEMS'				=> 'položky',
	'JAVASCRIPT'		=> 'javascript',
	'KEYWORDS'			=> 'klíčová slova',
	'LABEL'				=> 'štítek',
	'LANG'				=> 'lang',
	'LATITUDE'			=> 'Zeměpisná šířka',
	'LENGTH'			=> 'délka',
	'LINK'				=> 'odkaz',
	'LINKS'				=> 'odkazy',
	'LONGITUDE'			=> 'zeměpisná délka',
	'MEDIUM'			=> 'střední',
	'NAME'				=> 'jméno',
	'PERMALINK'			=> 'trvalý odkaz',
	'PLAYER'			=> 'hráč',
	'RATINGS'			=> 'hodnocení',
	'RELATIONSHIP'		=> 'vztah',
	'RESTRICTIONS'		=> 'omezení (pole)',
	'SAMPLINGRATE'		=> 'četnost odběru vzorků',
	'SCHEME'			=> 'Schéma',
	'SOURCE'			=> 'Zdroj',
	'TERM'				=> 'termín',
	'THUMBNAILS'		=> 'thumbnails',
	'TITLE'				=> 'titulek',
	'TYPE'				=> 'typ',
	'UPDATED_DATE'		=> 'aktualizované datum',
	'UPDATED_GMDATE'	=> 'aktualizováno GM datum',
	'VALUE'				=> 'hodnota',
	'WIDTH'				=> 'width',
));
