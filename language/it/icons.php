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
	'ICON_ACCESSIBILITY'	=> 'Accessibilità',
	'ICON_BRAND'			=> 'Marca',
	'ICON_CHART'			=> 'Grafico',
	'ICON_COLOR'			=> 'Colore',
	'ICON_COLOR_DEFAULT'	=> 'Colore predefinito',
	'ICON_CURRENCY'			=> 'Valuta',
	'ICON_DIRECTIONAL'		=> 'Direzionale',
	'ICON_FILE_TYPE'		=> 'Tipo di file',
	'ICON_FLIP_HORIZONTAL'	=> 'Capovolgi orizzontalmente',
	'ICON_FLIP_VERTICAL'	=> 'Capovolgi verticali',
	'ICON_FLOAT'			=> 'Float',
	'ICON_FLOAT_LEFT'		=> 'Sinistra',
	'ICON_FLOAT_RIGHT'		=> 'Destra',
	'ICON_FONT'				=> 'Icone Font',
	'ICON_FORM_CONTROL'		=> 'Controllo Form',
	'ICON_GENDER'			=> 'Sesso',
	'ICON_HANDS'			=> 'Mani',
	'ICON_IMAGE'			=> 'Immagine',
	'ICON_INSERT_UPDATE'	=> 'Inserisci/Aggiorna',
	'ICON_MEDICAL'			=> 'Medico',
	'ICON_MISC'				=> 'Varie',
	'ICON_MISC_BORDERED'	=> 'Bordo',
	'ICON_MISC_FIXED_WIDTH'	=> 'Larghezza fissa',
	'ICON_MISC_SPINNING'	=> 'Giro',
	'ICON_PAYMENT'			=> 'Pagamento',
	'ICON_ROTATION'			=> 'Rotazione',
	'ICON_ROTATION_90_DEG'	=> '90°',
	'ICON_ROTATION_180_DEG'	=> '180°',
	'ICON_ROTATION_270_DEG'	=> '270°',
	'ICON_SIZE'				=> 'Taglia',
	'ICON_SIZE_DEFAULT'		=> 'Predefinito',
	'ICON_SIZE_LARGER'		=> 'Più grande',
	'ICON_SPINNER'			=> 'Spinner',
	'ICON_TEXT_EDITOR'		=> 'Editor di testo',
	'ICON_TRANSPORTATION'	=> 'Trasporto',
	'ICON_VIDEO_PLAYER'		=> 'Lettore video',
	'ICON_WEB_APPLICATION'	=> 'Applicazione Web',

	'NO_ICON'				=> 'Nessuna icona',
));
