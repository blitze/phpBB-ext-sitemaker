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
	'AUTHOR'			=> 'autore',
	'AUTHORS'			=> 'autori (matrice)',
	'BITRATE'			=> 'bitrate',
	'CAPTIONS'			=> 'didascalie',
	'CATEGORIES'		=> 'categorie (array)',
	'CATEGORY'			=> 'categoria',
	'CHANNELS'			=> 'canali',
	'CONTENT'			=> 'contenuto',
	'CONTRIBUTOR'		=> 'contributore',
	'CONTRIBUTORS'		=> 'collaboratori (array)',
	'COPYRIGHT'			=> 'copyright',
	'CREDITS'			=> 'crediti',
	'DATE'				=> 'data',
	'DESCRIPTION'		=> 'descrizione',
	'DURATION'			=> 'durata',
	'ENCLOSURE'			=> 'involucro',
	'ENCLOSURES'		=> 'stabulari (matrice)',
	'EXPRESSION'		=> 'espressione',
	'FEED'				=> 'feed',
	'FRAMERATE'			=> 'framerate',
	'GMDATE'			=> 'Data GM',
	'HANDLER'			=> 'handler',
	'HASHES'			=> 'hashes',
	'HEIGHT'			=> 'altezza',
	'ID'				=> 'id',
	'IMAGE_HEIGHT'		=> 'altezza immagine',
	'IMAGE_LINK'		=> 'link immagine',
	'IMAGE_TITLE'		=> 'titolo immagine',
	'IMAGE_URL'			=> 'url immagine',
	'IMAGE_WIDTH'		=> 'larghezza immagine',
	'ITEMS'				=> 'elementi',
	'JAVASCRIPT'		=> 'JavaScript',
	'KEYWORDS'			=> 'parole chiave',
	'LABEL'				=> 'etichetta',
	'LANG'				=> 'lang',
	'LATITUDE'			=> 'latitudine',
	'LENGTH'			=> 'lunghezza',
	'LINK'				=> 'link',
	'LINKS'				=> 'link',
	'LONGITUDE'			=> 'longitudine',
	'MEDIUM'			=> 'medio',
	'NAME'				=> 'nome',
	'PERMALINK'			=> 'permalink',
	'PLAYER'			=> 'giocatore',
	'RATINGS'			=> 'valutazioni',
	'RELATIONSHIP'		=> 'relazione',
	'RESTRICTIONS'		=> 'restrizioni (array)',
	'SAMPLINGRATE'		=> 'frequenza di campionamento',
	'SCHEME'			=> 'schema',
	'SOURCE'			=> 'sorgente',
	'TERM'				=> 'termine',
	'THUMBNAILS'		=> 'thumbnails',
	'TITLE'				=> 'titolo',
	'TYPE'				=> 'tipo',
	'UPDATED_DATE'		=> 'data aggiornata',
	'UPDATED_GMDATE'	=> 'data GM aggiornata',
	'VALUE'				=> 'valore',
	'WIDTH'				=> 'width',
));
