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
	'LIST_ARROW'			=> 'Marcador Lista de Flechas',
	'LIST_CIRCLE'			=> 'Marcador Lista Círculo',
	'LIST_DISC'				=> 'Marcador de lista com marcadores',
	'LIST_SQUARE'			=> 'Marcador de lista quadrado',
	'LIST_NUMBERED'			=> 'Lista numerada',
	'LIST_NUMBERED_ALPHABET' => 'Numerado com alfabeto',
	'LIST_NUMBERED_NESTED'	=> 'Numerado com subseções',
	'LIST_NUMBERED_ROMAN'	=> 'Numerado com numerais romanos',
	'LIST_NUMBERED_ZERO'	=> 'Numerado com zero à esquerda',
	'LIST_INLINE'			=> 'Lista em linha',
	'LIST_INLINE_SEP'		=> 'Lista separada por vírgulas',
	'LIST_REVERSE'			=> 'Ordem inversa',
	'LIST_STRIPED'			=> 'Lista listrada',
	'LIST_STACKED'			=> 'Lista empilhada',
	'LIST_TRIANGLE'			=> 'Triângulo',
	'LIST_HYPHEN'			=> 'Hífen',
	'LIST_PLUS'				=> 'Mais',
	'LIST_SPADE'			=> 'Spade',
	'LIST_CLUB'				=> 'Clava',
	'LIST_DIAMOND'			=> 'Diamante',
	'LIST_HEART'			=> 'Coração',
	'LIST_STAR'				=> 'Estrela',
	'LIST_CHECK'			=> 'Verificar',
	'LIST_SNOWFLAKE'		=> 'Floco de Neve',
	'LIST_MUSIC'			=> 'Música',
	'LIST_AUTOWIDTH'		=> 'Auto width',
	'LIST_FIT_CONTENT'		=> 'Ajustar conteúdo',
	'LIST_2COLS'			=> 'Lista de 2 colunas',
	'LIST_3COLS'			=> 'Lista de 3 colunas',
	'LIST_4COLS'			=> 'Lista de 4 colunas',
	'LIST_5COLS'			=> 'Lista de 5 colunas',
	'LIST_X_DIVIDER_DOTTED'	=> 'Divisor pontilhado horizontal',
	'LIST_X_DIVIDER_LINE'	=> 'Divisor de linha horizontal',
	'LIST_Y_DIVIDER_DOTTED'	=> 'Divisor pontilhado vertical',
	'LIST_Y_DIVIDER_LINE'	=> 'Divisor de linha vertical',

	'IMAGE_SMALL'			=> 'Imagem pequena',
	'IMAGE_MEDIUM'			=> 'Imagem média',
	'IMAGE_LARGE'			=> 'Imagem grande',
	'IMAGE_FULL_WIDTH'		=> 'Largura total da imagem',
	'IMAGE_ALIGN_LEFT'		=> 'Imagem flutuante à esquerda',
	'IMAGE_ALIGN_RIGHT'		=> 'Imagem flutuante direita',
	'IMAGE_CIRCLE'			=> 'Imagem circular',
	'IMAGE_ROUNDED'			=> 'Imagem arredondada',
	'IMAGE_BORDER'			=> 'Imagem com Borda',
	'IMAGE_BORDER_PADDING'	=> 'Image border padding',
	'IMAGE_RATIO_SQUARE'	=> 'Imagem do quadrado',
	'IMAGE_RATIO_4_BY_3'	=> '4 por 3 imagens',
	'IMAGE_RATIO_16_BY_9'	=> '16 por 9 imagens',

	'RESPONSIVE_SHOW'		=> 'Mostrar apenas em dispositivos pequenos',
	'RESPONSIVE_HIDE'		=> 'Ocultar em dispositivos pequenos',

	'ALIGN_LEFT'			=> 'Texto alinhado à esquerda',
	'ALIGN_CENTER'			=> 'Texto centralizado',
	'ALIGN_RIGHT'			=> 'Texto alinhado à direita',
	'NO_PADDING'			=> 'No padding',
	'LABEL'					=> 'Descrição',
	'BADGE'					=> 'Distintivo',
	'PRIMARY_COLOR'			=> 'Cor principal',
	'SECONDARY_COLOR'		=> 'Cor secundária',
	'GRAYSCALE_COLOR'		=> 'Grayscale',
	'INFO_COLOR'			=> 'Informações',
	'SUCCESS_COLOR'			=> 'Sucesso',
	'WARNING_COLOR'			=> 'ATENÇÃO',
	'DANGER_COLOR'			=> 'Perigo',
));
