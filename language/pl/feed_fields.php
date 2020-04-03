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
	'AUTHORS'			=> 'autorzy (tablica)',
	'BITRATE'			=> 'bitrate',
	'CAPTIONS'			=> 'tytuły',
	'CATEGORIES'		=> 'Kategorie (tablica)',
	'CATEGORY'			=> 'kategoria',
	'CHANNELS'			=> 'kanały',
	'CONTENT'			=> 'zawartość',
	'CONTRIBUTOR'		=> 'współtwórca',
	'CONTRIBUTORS'		=> 'współtwórcy (tablica)',
	'COPYRIGHT'			=> 'prawa autorskie',
	'CREDITS'			=> 'kredyty',
	'DATE'				=> 'data',
	'DESCRIPTION'		=> 'opis',
	'DURATION'			=> 'czas trwania',
	'ENCLOSURE'			=> 'pomieszczenie',
	'ENCLOSURES'		=> 'pomieszczenia (tablica)',
	'EXPRESSION'		=> 'wyrażenie',
	'FEED'				=> 'kanał',
	'FRAMERATE'			=> 'ramerat',
	'GMDATE'			=> 'Data GM',
	'HANDLER'			=> 'obsługa',
	'HASHES'			=> 'hashy',
	'HEIGHT'			=> 'wysokość',
	'ID'				=> 'ID',
	'IMAGE_HEIGHT'		=> 'wysokość obrazu',
	'IMAGE_LINK'		=> 'link do obrazu',
	'IMAGE_TITLE'		=> 'tytuł obrazu',
	'IMAGE_URL'			=> 'adres url obrazu',
	'IMAGE_WIDTH'		=> 'szerokość obrazu',
	'ITEMS'				=> 'przedmioty',
	'JAVASCRIPT'		=> 'javascript',
	'KEYWORDS'			=> 'słowa kluczowe',
	'LABEL'				=> 'etykieta',
	'LANG'				=> 'piosenka',
	'LATITUDE'			=> 'szerokość geograficzna',
	'LENGTH'			=> 'długość',
	'LINK'				=> 'link',
	'LINKS'				=> 'linki',
	'LONGITUDE'			=> 'długość geograficzna',
	'MEDIUM'			=> 'Średni',
	'NAME'				=> 'Nazwisko',
	'PERMALINK'			=> 'permalink',
	'PLAYER'			=> 'gracz',
	'RATINGS'			=> 'oceny',
	'RELATIONSHIP'		=> 'relacja',
	'RESTRICTIONS'		=> 'ograniczenia (tablica)',
	'SAMPLINGRATE'		=> 'częstotliwość pobierania próbek',
	'SCHEME'			=> 'schemat',
	'SOURCE'			=> 'źródło',
	'TERM'				=> 'termin',
	'THUMBNAILS'		=> 'miniatury',
	'TITLE'				=> 'tytuł',
	'TYPE'				=> 'typ',
	'UPDATED_DATE'		=> 'zaktualizowana data',
	'UPDATED_GMDATE'	=> 'zaktualizowana data GM',
	'VALUE'				=> 'wartość',
	'WIDTH'				=> 'szerokość',
));
