<?php
/**
 *
 * @package phpBB Primetime [English]
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

$lang = array_merge($lang, array(
	'FORM_FIELD_CHECKBOX'		=> 'Checkbox',
	'FORM_FIELD_COLOR'			=> 'Color',
	'FORM_FIELD_DATE'			=> 'Date',
	'FORM_FIELD_DATETIME'		=> 'Date/Time',
	'FORM_FIELD_EDITOR'			=> 'Large Textarea',
	'FORM_FIELD_EMAIL'			=> 'Email',
	'FORM_FIELD_HIDDEN'			=> 'Hidden Input',
	'FORM_FIELD_NUMBER'			=> 'Number',
	'FORM_FIELD_PASSWORD'		=> 'Password',
	'FORM_FIELD_RADIO'			=> 'Radio',
	'FORM_FIELD_RANGE'			=> 'Ranage',
	'FORM_FIELD_RESET'			=> 'Reset Button',
	'FORM_FIELD_SELECT'			=> 'Select',
	'FORM_FIELD_SUBMIT'			=> 'Submit Button',
	'FORM_FIELD_TELEPHONE'		=> 'Telephone',
	'FORM_FIELD_TEXT'			=> 'String',
	'FORM_FIELD_TEXTAREA'		=> 'Small Textarea',
	'FORM_FIELD_TIME'			=> 'Time',
	'FORM_FIELD_URL'			=> 'URL',
));
