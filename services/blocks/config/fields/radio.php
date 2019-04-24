<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\config\fields;

use blitze\sitemaker\services\blocks\config\cfg_utils;

/**
 * @package sitemaker
 */
class radio implements cfg_field_interface
{
	/** @var \phpbb\language\language */
	protected $translator;

	/**
	 * Constructor
	 *
	 * @param \phpbb\language\language	$translator		Language object
	 */
	public function __construct(\phpbb\language\language $translator)
	{
		$this->translator = $translator;
	}

	/**
	 * @inheritdoc
	 */
	public function get_name()
	{
		return 'radio';
	}

	/**
	 * {@inheritdoc}
	 */
	public function prep_field(array &$vars, array &$type, $field, array $db_settings)
	{
		if (!isset($type[1]))
		{
			$vars['method'] = 'build_radio';
			$vars['params'][] = $field;
			$type[0] = 'custom';
		}
	}

	/**
	 * Build radio buttons other than yes_no/enable_disable in blocks config
	 *
	 * @param array $option_ary
	 * @param mixed $selected_item
	 * @param string $key
	 * @return string
	 */
	public function build_radio(array $option_ary, $selected_item, $key)
	{
		$selected_item = (is_array($selected_item)) ? $selected_item : array($selected_item);

		$html = '';
		foreach ($option_ary as $value => $title)
		{
			$selected = cfg_utils::get_selected_option($value, $selected_item, 'checked');
			$html .= '<label><input type="radio" name="config[' . $key . ']" value="' . $value . '"' . $selected . ' class="radio" /> ' . $this->translator->lang($title) . '</label><br />';
		}

		return $html;
	}
}
