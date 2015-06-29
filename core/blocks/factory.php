<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core\blocks;

class factory
{
	/**
	 * Cache
	 * @var \phpbb\cache\service
	 */
	protected $cache;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\service	$cache		Cache object
	 */
	public function __construct($blocks)
	{
		$this->load_blocks($blocks);
	}

	/**
	 * Load available blocks
	 */
	public function load_blocks($blocks)
	{
		$this->blocks = array();
		foreach ($blocks as $service => $driver)
		{
			$this->blocks[$service] = $driver->get_name();
		}
	}

	/**
	 * Get available primetime blocks
	 */
	public function get_all_blocks()
	{
		return $this->blocks;
	}
}
