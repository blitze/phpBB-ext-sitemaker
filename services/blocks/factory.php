<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks;

class factory
{
	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\template */
	protected $ptemplate;

	/** @var array */
	private $blocks;

	/**
	 * Constructor
	 *
	 * @param \phpbb\user							$user				User object
	 * @param \blitze\sitemaker\services\template	$ptemplate			Template Object
	 * @param array									$blocks				Service Collection
	 */
	public function __construct(\phpbb\user $user, \blitze\sitemaker\services\template $ptemplate, array $blocks)
	{
		$this->user = $user;
		$this->ptemplate = $ptemplate;

		$this->register_blocks($blocks);
	}

	/**
	 * Register available blocks
	 */
	public function register_blocks($blocks)
	{
		$this->blocks = array();
		foreach ($blocks as $service => $driver)
		{
			$this->blocks[$service] = $driver;
		}
	}

	/**
	 * Get block instance
	 */
	public function get_block($service_name)
	{
		if (!isset($this->blocks[$service_name]))
		{
			return null;
		}

		$block = $this->blocks[$service_name];
		$block->set_template($this->ptemplate);

		return $block;
	}

	/**
	 * Get available sitemaker blocks
	 */
	public function get_all_blocks()
	{
		$blocks = array();
		foreach ($this->blocks as $service => $driver)
		{
			$lname = strtoupper(str_replace('.', '_', $driver->get_name()));
			$blocks[$service] = $this->user->lang($lname);
		}

		asort($blocks);

		return $blocks;
	}
}
