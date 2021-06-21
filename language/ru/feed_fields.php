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
	'AUTHOR'			=> 'автор',
	'AUTHORS'			=> 'авторы (массив)',
	'BITRATE'			=> 'битрейт',
	'CAPTIONS'			=> 'субтитры',
	'CATEGORIES'		=> 'категории (массив)',
	'CATEGORY'			=> 'категория',
	'CHANNELS'			=> 'каналы',
	'CONTENT'			=> 'контент',
	'CONTRIBUTOR'		=> 'участник',
	'CONTRIBUTORS'		=> 'участники (массив)',
	'COPYRIGHT'			=> 'авторские права',
	'CREDITS'			=> 'кредиты',
	'DATE'				=> 'дата',
	'DESCRIPTION'		=> 'описание',
	'DURATION'			=> 'длительность',
	'ENCLOSURE'			=> 'вложение',
	'ENCLOSURES'		=> 'дополнения (массив)',
	'EXPRESSION'		=> 'выражение',
	'FEED'				=> 'канал',
	'FRAMERATE'			=> 'частота кадров',
	'GMDATE'			=> 'Дата ГМ',
	'HANDLER'			=> 'handler',
	'HASHES'			=> 'хэши',
	'HEIGHT'			=> 'высота',
	'ID'				=> 'id',
	'IMAGE_HEIGHT'		=> 'высота изображения',
	'IMAGE_LINK'		=> 'ссылка на изображение',
	'IMAGE_TITLE'		=> 'название изображения',
	'IMAGE_URL'			=> 'URL изображения',
	'IMAGE_WIDTH'		=> 'ширина изображения',
	'ITEMS'				=> 'элементы',
	'JAVASCRIPT'		=> 'javascript',
	'KEYWORDS'			=> 'ключевые слова',
	'LABEL'				=> 'этикетка',
	'LANG'				=> 'lang',
	'LATITUDE'			=> 'широта',
	'LENGTH'			=> 'длина',
	'LINK'				=> 'ссылка',
	'LINKS'				=> 'ссылки',
	'LONGITUDE'			=> 'долгота',
	'MEDIUM'			=> 'средняя',
	'NAME'				=> 'имя',
	'PERMALINK'			=> 'постоянная ссылка',
	'PLAYER'			=> 'игрок',
	'RATINGS'			=> 'рейтинги',
	'RELATIONSHIP'		=> 'отношения',
	'RESTRICTIONS'		=> 'ограничения (массив)',
	'SAMPLINGRATE'		=> 'частота отбора проб',
	'SCHEME'			=> 'схема',
	'SOURCE'			=> 'источник',
	'TERM'				=> 'термин',
	'THUMBNAILS'		=> 'thumbnails',
	'TITLE'				=> 'название',
	'TYPE'				=> 'тип',
	'UPDATED_DATE'		=> 'дата обновления',
	'UPDATED_GMDATE'	=> 'обновлена дата ГМ',
	'VALUE'				=> 'значение',
	'WIDTH'				=> 'width',
));
