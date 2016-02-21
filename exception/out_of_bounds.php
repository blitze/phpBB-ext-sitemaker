<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\exception;

/**
* OutOfBounds exception
*/
class out_of_bounds extends base
{
	/**
	* Translate this exception
	*
	* @param \phpbb\language\language $translator
	* @return array|string
	* @access public
	*/
	public function get_message(\phpbb\language\language $translator)
	{
		return $this->translate_portions($translator, $this->message_full, 'EXCEPTION_OUT_OF_BOUNDS');
	}
}
