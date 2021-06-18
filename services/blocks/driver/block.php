<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\driver;

/**
 * Base class for block drivers
 * @package sitemaker
 */
abstract class block implements block_interface
{
	/** @var string */
	protected $name;

	/**
	 * @inheritdoc
	 */
	public function get_name()
	{
		return $this->name;
	}

	/**
	 * {@inheritdoc}
	 */
	public function set_name($name)
	{
		$this->name = $name;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_config(array $settings)
	{
		return [];
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_template()
	{
		return '';
	}
}
