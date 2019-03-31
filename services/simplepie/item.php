<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\simplepie;

use SimplePie_Item;

class item extends SimplePie_Item
{
	/**
	 * Magic method handler
	 *
	 * @param string $name Property name
	 * @return mixed
	 */
	public function __get($name)
	{
		return $this->{'get_' . $name}();
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
}
