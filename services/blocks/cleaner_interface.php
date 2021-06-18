<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2020 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks;

interface cleaner_interface
{
	/**
	 * @param array $components		components to clean: styles|routes|blocks
	 * @return void
	 */
	public function run(array $components);

	/**
	 * @return array
	 */
	public function test();
}
