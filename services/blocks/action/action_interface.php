<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\action;

interface action_interface
{
	/**
	 * Execute the action
	 *
	 * @param int $style_id
	 * @return array
	 */
	public function execute($style_id);
}
