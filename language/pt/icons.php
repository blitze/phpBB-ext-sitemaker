<?php
/**
*
* @package phpBB Sitemaker [English]
* @copyright (c) 2012 Daniel A. (blitze)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ICON_ACCESSIBILITY'	=> 'Acessibilidade',
	'ICON_BRAND'			=> 'Marca',
	'ICON_CHART'			=> 'Gráfico',
	'ICON_COLOR'			=> 'Cor',
	'ICON_COLOR_DEFAULT'	=> 'Cor padrão',
	'ICON_CURRENCY'			=> 'Moeda',
	'ICON_DIRECTIONAL'		=> 'Direcional',
	'ICON_FILE_TYPE'		=> 'Tipo de arquivo',
	'ICON_FLIP_HORIZONTAL'	=> 'Inverter horizontal',
	'ICON_FLIP_VERTICAL'	=> 'Inverter Vertical',
	'ICON_FLOAT'			=> 'Flutuar',
	'ICON_FLOAT_LEFT'		=> 'Saiu',
	'ICON_FLOAT_RIGHT'		=> 'Direita',
	'ICON_FONT'				=> 'Ícones de fonte',
	'ICON_FORM_CONTROL'		=> 'Controle de formulário',
	'ICON_GENDER'			=> 'Sexo',
	'ICON_HANDS'			=> 'Mãos',
	'ICON_IMAGE'			=> 'Imagem',
	'ICON_INSERT_UPDATE'	=> 'Inserir/Atualizar',
	'ICON_MEDICAL'			=> 'Médico',
	'ICON_MISC'				=> 'Outros',
	'ICON_MISC_BORDERED'	=> 'Com Bordas',
	'ICON_MISC_FIXED_WIDTH'	=> 'Largura Fixa',
	'ICON_MISC_SPINNING'	=> 'Girando',
	'ICON_PAYMENT'			=> 'Pagamento',
	'ICON_ROTATION'			=> 'Rotação',
	'ICON_ROTATION_90_DEG'	=> '90°',
	'ICON_ROTATION_180_DEG'	=> '180°',
	'ICON_ROTATION_270_DEG'	=> '270°',
	'ICON_SIZE'				=> 'Tamanho',
	'ICON_SIZE_DEFAULT'		=> 'Padrão',
	'ICON_SIZE_LARGER'		=> 'Maior',
	'ICON_SPINNER'			=> 'Girador',
	'ICON_TEXT_EDITOR'		=> 'Editor de texto',
	'ICON_TRANSPORTATION'	=> 'Transporte',
	'ICON_VIDEO_PLAYER'		=> 'Player de vídeo',
	'ICON_WEB_APPLICATION'	=> 'Aplicação Web',

	'NO_ICON'				=> 'Sem ícone',
));
