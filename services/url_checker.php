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
	/**
	 * @param string $url
	 * @param bool $curl
	 * @return bool
	 */
	public function exists($url, $curl = true)
	{
		if (!filter_var($url, FILTER_VALIDATE_URL))
		{
			return false;
		}

		$status = array();
		$headers = $this->get_headers($url, $curl);

		preg_match('/HTTP\/.* ([0-9]+) .*/', $headers , $status);

		return ($status[1] == 200) ? true : false;
	}

	/**
	 * @param string $url
	 * @param bool $curl
	 * @return mixed
	 */
	protected function get_headers($url, $curl)
	{
		if (extension_loaded('curl') && $curl)
		{
			$headers = $this->curl_header($url);
		}
		else
		{
			$headers = get_headers($url);
			$headers = $headers[0];
		}

		return $headers;
	}

	/**
	 * http://snipplr.com/view.php?codeview&id=61985
	 * @param string $url
	 * @return mixed
	 */
	protected function curl_header($url)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);

		$info = curl_exec($ch);

		curl_close($ch);

		return $info;
	}
}
