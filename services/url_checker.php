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
	public function exists($url, $curl = true)
	{
		if (!$url)
		{
			return false;
		}

		$status = array();
		if (!extension_loaded('curl') && $curl)
		{
			$headers = $this->curl_header($url);
		}
		else
		{
			$headers = get_headers($url);
			$headers = $headers[0];
		}

		preg_match('/HTTP\/.* ([0-9]+) .*/', $headers , $status);

		return ($status[1] == 200) ? true : false;
	}

	// http://snipplr.com/view.php?codeview&id=61985
	protected function curl_header($url)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,            $url);
		curl_setopt($ch, CURLOPT_HEADER,         TRUE);
		curl_setopt($ch, CURLOPT_NOBODY,         TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_TIMEOUT,        10);

		$info = curl_exec($ch);

		curl_close($ch);

		return $info;
	}
}
