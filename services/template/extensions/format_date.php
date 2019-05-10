<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\template\extensions;

class format_date extends \Twig\Extension\AbstractExtension
{
	/** @var \phpbb\user */
	protected $user;

	/**
	* Constructor
	*
	* @param \phpbb\user $user
	* @return \phpbb\template\twig\extension
	*/
	public function __construct(\phpbb\user $user)
	{
		$this->user = $user;
	}

	/**
	 * @inheritdoc
	 */
	public function getFilters()
	{
		return [
			new \Twig\TwigFilter('format_date', [$this, 'format_date_filter']),
		];
	}

	/**
	* Format user date
	*
	* @param int $gmepoch unix timestamp
	* @param string $format date format in date() notation. | used to indicate relative dates, for example |d m Y|, h:i is translated to Today, h:i.
	* @param bool $forcedate force non-relative date format.
	*
	* @return mixed translated date
	*/
	public function format_date_filter($timestamp, $format = false, $forcedate = false)
	{
		return $this->user->format_date($timestamp, $format, $forcedate);
	}
}
