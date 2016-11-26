<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2016 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model;

interface mapper_factory_interface
{
	/**
	 * Create mapper object
	 *
	 * @param string $type		model type
	 * @return \blitze\sitemaker\model\mapper_interface
	 */
	public function create($type);
}
