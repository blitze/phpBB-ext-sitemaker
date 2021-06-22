<?php

/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2013 Daniel A. (blitze)
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
//
$lang = array_merge($lang, array(
	'LIST_ARROW'			=> 'Marcatore elenco frecce',
	'LIST_CIRCLE'			=> 'Marcatore elenco cerchio',
	'LIST_DISC'				=> 'Indicatore elenco proiettile',
	'LIST_SQUARE'			=> 'Indicatore elenco quadrato',
	'LIST_NUMBERED'			=> 'Elenco numerato',
	'LIST_NUMBERED_ALPHABET' => 'Numerato con alfabeto',
	'LIST_NUMBERED_NESTED'	=> 'Numerato con sottosezioni',
	'LIST_NUMBERED_ROMAN'	=> 'Numerato con numeri romani',
	'LIST_NUMBERED_ZERO'	=> 'Numerato con zero iniziale',
	'LIST_INLINE'			=> 'Elenco inline',
	'LIST_INLINE_SEP'		=> 'Lista separata da virgole',
	'LIST_REVERSE'			=> 'Ordine inverso',
	'LIST_STRIPED'			=> 'Lista a righe',
	'LIST_STACKED'			=> 'Lista impilata',
	'LIST_TRIANGLE'			=> 'Triangolo',
	'LIST_HYPHEN'			=> 'Iphen',
	'LIST_PLUS'				=> 'Plus',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'Club',
	'LIST_DIAMOND'			=> 'Diamante',
	'LIST_HEART'			=> 'Cuore',
	'LIST_STAR'				=> 'Stella',
	'LIST_CHECK'			=> 'Controlla',
	'LIST_SNOWFLAKE'		=> 'Fiocco Di Neve',
	'LIST_MUSIC'			=> 'Musica',
	'LIST_AUTOWIDTH'		=> 'Auto width',
	'LIST_FIT_CONTENT'		=> 'Adatta al contenuto',
	'LIST_2COLS'			=> 'elenco di 2 colonne',
	'LIST_3COLS'			=> 'Elenco di 3 colonne',
	'LIST_4COLS'			=> 'Elenco 4 colonne',
	'LIST_5COLS'			=> 'Elenco di 5 colonne',
	'LIST_X_DIVIDER_DOTTED'	=> 'Divisore punteggiato orizzontale',
	'LIST_X_DIVIDER_LINE'	=> 'Divisore di linea orizzontale',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Divisore tratteggiato verticale',
	'LIST_Y_DIVIDER_LINE'	=> 'Divisore verticale di linea',

	'IMAGE_SMALL'			=> 'Immagine piccola',
	'IMAGE_MEDIUM'			=> 'Immagine media',
	'IMAGE_LARGE'			=> 'Immagine grande',
	'IMAGE_FULL_WIDTH'		=> 'Immagine a tutta larghezza',
	'IMAGE_ALIGN_LEFT'		=> 'Immagine fluttuante a sinistra',
	'IMAGE_ALIGN_RIGHT'		=> 'Immagine fluttuante a destra',
	'IMAGE_CIRCLE'			=> 'Immagine circolare',
	'IMAGE_ROUNDED'			=> 'Immagine arrotondata',
	'IMAGE_BORDER'			=> 'Immagine confinata',
	'IMAGE_BORDER_PADDING'	=> 'Image border padding',
	'IMAGE_RATIO_SQUARE'	=> 'Immagine Quadrata',
	'IMAGE_RATIO_4_BY_3'	=> 'da 4 a 3 immagine',
	'IMAGE_RATIO_16_BY_9'	=> '16 di 9 immagine',

	'RESPONSIVE_SHOW'		=> 'Mostra solo su piccoli dispositivi',
	'RESPONSIVE_HIDE'		=> 'Nascondi su piccoli dispositivi',

	'ALIGN_LEFT'			=> 'Testo allineato a sinistra',
	'ALIGN_CENTER'			=> 'Testo Centrato',
	'ALIGN_RIGHT'			=> 'Testo allineato a destra',
	'NO_PADDING'			=> 'No padding',
	'LABEL'					=> 'Etichetta',
	'BADGE'					=> 'Distintivo',
	'PRIMARY_COLOR'			=> 'Colore primario',
	'SECONDARY_COLOR'		=> 'Colore secondario',
	'GRAYSCALE_COLOR'		=> 'Grayscale',
	'INFO_COLOR'			=> 'Informazioni',
	'SUCCESS_COLOR'			=> 'Successo',
	'WARNING_COLOR'			=> 'Attenzione',
	'DANGER_COLOR'			=> 'Pericolo',
));
