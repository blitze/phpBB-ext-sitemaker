<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services;

class url_checker
{
	public function exists($url)
	{
		$headers = @get_headers($url);
		return (strpos($headers[0], '200')) ? true : false;
	}
}
