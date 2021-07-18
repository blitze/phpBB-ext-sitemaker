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
	'CATEGORY'			=> 'Categoria',
	'CHANNELS'			=> 'Canais',
	'CONTENT'			=> 'conteúdo',
	'CONTRIBUTOR'		=> 'Colaborador',
	'CONTRIBUTORS'		=> 'contribuidores (matriz)',
	'COPYRIGHT'			=> 'direitos',
	'CREDITS'			=> 'créditos',
	'DATE'				=> 'Data',
	'DESCRIPTION'		=> 'Descrição',
	'DURATION'			=> 'Duração',
	'ENCLOSURE'			=> 'invólucro',
	'ENCLOSURES'		=> 'invólucro (matriz)',
	'EXPRESSION'		=> 'Expressão',
	'FEED'				=> 'Feed',
	'FRAMERATE'			=> 'framerate',
	'GMDATE'			=> 'Data do GM',
	'HANDLER'			=> 'handler',
	'HASHES'			=> 'hashes',
	'HEIGHT'			=> 'Altura',
	'ID'				=> 'id',
	'IMAGE_HEIGHT'		=> 'altura da imagem',
	'IMAGE_LINK'		=> 'link da imagem',
	'IMAGE_TITLE'		=> 'título da imagem',
	'IMAGE_URL'			=> 'URL da imagem',
	'IMAGE_WIDTH'		=> 'largura da imagem',
	'ITEMS'				=> 'Itens',
	'JAVASCRIPT'		=> 'JavaScript',
	'KEYWORDS'			=> 'Palavras-chave',
	'LABEL'				=> 'Etiqueta',
	'LANG'				=> 'lang',
	'LATITUDE'			=> 'latitude',
	'LENGTH'			=> 'comprimento',
	'LINK'				=> 'ligação',
	'LINKS'				=> 'links',
	'LONGITUDE'			=> 'longitude',
	'MEDIUM'			=> 'Médio',
	'NAME'				=> 'Nome',
	'PERMALINK'			=> 'permalink',
	'PLAYER'			=> 'jogador',
	'RATINGS'			=> 'avaliações',
	'RELATIONSHIP'		=> 'relação',
	'RESTRICTIONS'		=> 'restrições (matriz)',
	'SAMPLINGRATE'		=> 'taxa de amostragem',
	'SCHEME'			=> 'esquema',
	'SOURCE'			=> 'Fonte',
	'TERM'				=> 'Termo',
	'THUMBNAILS'		=> 'thumbnails',
	'TITLE'				=> 'Título',
	'TYPE'				=> 'Tipo',
	'UPDATED_DATE'		=> 'data de atualização',
	'UPDATED_GMDATE'	=> 'data do GM atualizada',
	'VALUE'				=> 'Valor',
	'WIDTH'				=> 'width',
));
