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
	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \blitze\sitemaker\services\template */
	protected $ptemplate;

	/** @var array */
	private $blocks;

	/**
	 * Constructor
	 *
	 * @param \phpbb\language\language				$translator			Language object
	 * @param \blitze\sitemaker\services\template	$ptemplate			Template Object
	 * @param \phpbb\di\service_collection			$blocks				Service Collection
	 */
	public function __construct(\phpbb\language\language $translator, \blitze\sitemaker\services\template $ptemplate, \phpbb\di\service_collection $blocks)
	{
		$this->translator = $translator;
		$this->ptemplate = $ptemplate;

		$this->register_blocks($blocks);
	}

	/**
	 * Register available blocks
	 * @param \phpbb\di\service_collection $blocks
	 */
	public function register_blocks(\phpbb\di\service_collection $blocks)
	{
		$this->blocks = array();
		foreach ($blocks as $service => $driver)
		{
			$this->blocks[$service] = $driver;
		}
	}

	/**
	 * Get block instance
	 * @param $service_name
	 * @return \blitze\sitemaker\services\blocks\driver\block_interface|null
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
	 * @return array
	 */
	public function get_all_blocks()
	{
		$blocks = array();
		foreach ($this->blocks as $service => $driver)
		{
			$lname = strtoupper(str_replace('.', '_', $driver->get_name()));
			$blocks[$service] = $this->translator->lang($lname);
		}

		asort($blocks);

		return $blocks;
	}
}
