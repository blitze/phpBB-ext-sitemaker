<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\simplepie;

class item extends \SimplePie_Item
{
	/**
	 * Magic method handler
	 *
	 * @param string $name Property name
	 * @return mixed
	 */
	public function __get($name)
	{
		$method = 'get_' . $name;
		return (isset($this, $method)) ? $this->{$method}() : '';
	}

	/**
	 * Magic method handler
	 *
	 * @param string $name Property name
	 * @return bool
	 */
	public function __isset($name)
	{
		return method_exists($this, 'get_' . $name) ? true : false;
	}

	/**
	 * Override this method to fix issue in php 7.4
	 * Get a single link for the item
	 *
	 * @since Beta 3
	 * @param int $key The link that you want to return.  Remember that arrays begin with 0, not 1
	 * @param string $rel The relationship of the link to return
	 * @return string|null Link URL
	 */
	public function get_link($key = 0, $rel = 'alternate')
	{
		$links = $this->get_links($rel);
		if (isset($links[$key]))
		{
			return $links[$key];
		}

		return null;
	}
}
