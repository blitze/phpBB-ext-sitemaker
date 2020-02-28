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
	'AUTHORS'			=> 'autorů (poli)',
	'BITRATE'			=> 'bitrate',
	'CAPTIONS'			=> 'titulky',
	'CATEGORIES'		=> 'kategorie (pole)',
	'CATEGORY'			=> 'kategorie',
	'CHANNELS'			=> 'kanály',
	'CONTENT'			=> 'obsah',
	'CONTRIBUTOR'		=> 'přispěvatel',
	'CONTRIBUTORS'		=> 'Přispěvatelé (pole)',
	'COPYRIGHT'			=> 'autorská práva',
	'CREDITS'			=> 'kredity',
	'DATE'				=> 'datum',
	'DESCRIPTION'		=> 'popis',
	'DURATION'			=> 'trvání',
	'ENCLOSURE'			=> 'uzavírka',
	'ENCLOSURES'		=> 'opevnění (poli)',
	'EXPRESSION'		=> 'výraz',
	'FEED'				=> 'zdroj',
	'FRAMERATE'			=> 'snímková frekvence',
	'GMDATE'			=> 'Datum GM',
	'HANDLER'			=> 'ovladač',
	'HASHES'			=> 'hashy',
	'HEIGHT'			=> 'výška',
	'ID'				=> 'ID',
	'IMAGE_HEIGHT'		=> 'výška obrázku',
	'IMAGE_LINK'		=> 'odkaz obrázku',
	'IMAGE_TITLE'		=> 'název obrázku',
	'IMAGE_URL'			=> 'adresa obrázku',
	'IMAGE_WIDTH'		=> 'šířka obrázku',
	'ITEMS'				=> 'položky',
	'JAVASCRIPT'		=> 'javascript',
	'KEYWORDS'			=> 'Klíčová slova',
	'LABEL'				=> 'štítek',
	'LANG'				=> 'jazyk',
	'LATITUDE'			=> 'zem. šířka',
	'LENGTH'			=> 'délka',
	'LINK'				=> 'odkaz',
	'LINKS'				=> 'odkazy',
	'LONGITUDE'			=> 'zem. délka',
	'MEDIUM'			=> 'střední',
	'NAME'				=> 'název',
	'PERMALINK'			=> 'trvalý odkaz',
	'PLAYER'			=> 'hráč',
	'RATINGS'			=> 'hodnocení',
	'RELATIONSHIP'		=> 'vztah',
	'RESTRICTIONS'		=> 'omezení (pole)',
	'SAMPLINGRATE'		=> 'vzorkování',
	'SCHEME'			=> 'schéma',
	'SOURCE'			=> 'zdroj',
	'TERM'				=> 'termín',
	'THUMBNAILS'		=> 'miniatury',
	'TITLE'				=> 'titulek',
	'TYPE'				=> 'typ',
	'UPDATED_DATE'		=> 'datum aktualizace',
	'UPDATED_GMDATE'	=> 'GM datum aktualizace',
	'VALUE'				=> 'hodnota',
	'WIDTH'				=> 'Šířka',
));
