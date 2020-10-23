<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\config\fields;

/**
 * @package sitemaker
 */
abstract class cfg_field_base implements cfg_field_interface
{
	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \phpbb\template\template */
	protected $template;

	/**
	 * Constructor
	 *
	 * @param \phpbb\language\language				$translator		Language object
	 * @param \phpbb\template\template				$template		Template object
	 */
	public function __construct(\phpbb\language\language $translator, \phpbb\template\template $template)
	{
		$this->translator = $translator;
		$this->template = $template;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_template()
	{
		return '';
	}
}
