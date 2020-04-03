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
	'AUTHORS'			=> 'autores (matriz)',
	'BITRATE'			=> 'bitrate',
	'CAPTIONS'			=> 'legendas',
	'CATEGORIES'		=> 'categorias (matriz)',
	'CATEGORY'			=> 'categoria',
	'CHANNELS'			=> 'canais',
	'CONTENT'			=> 'conteúdo',
	'CONTRIBUTOR'		=> 'colaborador',
	'CONTRIBUTORS'		=> 'contribuidores (matriz)',
	'COPYRIGHT'			=> 'direitos autorais',
	'CREDITS'			=> 'créditos',
	'DATE'				=> 'data',
	'DESCRIPTION'		=> 'descrição',
	'DURATION'			=> 'duração',
	'ENCLOSURE'			=> 'anexo',
	'ENCLOSURES'		=> 'encerramentos (matriz)',
	'EXPRESSION'		=> 'expressão',
	'FEED'				=> 'feed',
	'FRAMERATE'			=> 'taxa de quadros',
	'GMDATE'			=> 'Data GM',
	'HANDLER'			=> 'manipulador',
	'HASHES'			=> 'hashes',
	'HEIGHT'			=> 'altura',
	'ID'				=> 'id',
	'IMAGE_HEIGHT'		=> 'altura da imagem',
	'IMAGE_LINK'		=> 'link da imagem',
	'IMAGE_TITLE'		=> 'título da imagem',
	'IMAGE_URL'			=> 'url da imagem',
	'IMAGE_WIDTH'		=> 'largura da imagem',
	'ITEMS'				=> 'itens',
	'JAVASCRIPT'		=> 'javascript',
	'KEYWORDS'			=> 'palavras-chave',
	'LABEL'				=> 'rótulo',
	'LANG'				=> 'lang',
	'LATITUDE'			=> 'latitude',
	'LENGTH'			=> 'tamanho',
	'LINK'				=> 'link',
	'LINKS'				=> 'links',
	'LONGITUDE'			=> 'longitude',
	'MEDIUM'			=> 'média',
	'NAME'				=> 'nome',
	'PERMALINK'			=> 'permalink',
	'PLAYER'			=> 'jogador',
	'RATINGS'			=> 'avaliações',
	'RELATIONSHIP'		=> 'relação',
	'RESTRICTIONS'		=> 'restrições (matriz)',
	'SAMPLINGRATE'		=> 'taxa de amostragem',
	'SCHEME'			=> 'esquema',
	'SOURCE'			=> 'fonte',
	'TERM'				=> 'termo',
	'THUMBNAILS'		=> 'miniaturas',
	'TITLE'				=> 'título',
	'TYPE'				=> 'tipo',
	'UPDATED_DATE'		=> 'data atualizada',
	'UPDATED_GMDATE'	=> 'data atualizada de GM',
	'VALUE'				=> 'valor',
	'WIDTH'				=> 'largura',
));
