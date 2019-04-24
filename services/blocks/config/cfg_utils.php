<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\config;

class cfg_utils
{
	/**
	 * Force array
	 *
	 * @param mixed $items
	 * @return array
	 */
	public static function ensure_array($items)
	{
		return is_array($items) ? $items : explode(',', $items);
	}

	/**
	 * Force multi dimensional array
	 *
	 * @param mixed $options
	 * @param string $css_class
	 * @return array
	 */
	public static function ensure_multi_array($options, &$css_class)
	{
		$test = current(cfg_utils::ensure_array($options));
		if (!is_array($test))
		{
			$css_class = '';
			$options = array($options);
		}

		return array_map('array_filter', $options);
	}

	/**
	 * @param string $needle
	 * @param array $haystack
	 * @param string $type selected|checked
	 * @return string
	 */
	public static function get_selected_option($needle, array $haystack, $type = 'selected')
	{
		return (in_array($needle, $haystack)) ? ' ' . $type . '="' . $type . '"' : '';
	}
}
