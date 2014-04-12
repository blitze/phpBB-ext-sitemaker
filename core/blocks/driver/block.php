<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core\blocks\driver;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * Base class for block drivers
 * @package primetime
 */
abstract class block implements block_interface
{
	/**
	 * Block name
	 * @var string
	 */
	protected $name;

	/**
	 * Template object for Primetime blocks
	 * @var \primetime\primetime\core\template
	 */
	protected $ptemplate;

	/**
	 * Set block template object
	 *
	 * @param \phpbb\template\template	$ptemplate	Template object
	 */
	public function set_template(\primetime\primetime\core\template $ptemplate)
	{
		$this->ptemplate = $ptemplate;
	}

	/**
	 * @inheritdoc
	 */
	public function get_name()
	{
		return $this->name;
	}

	/**
	 * @inheritdoc
	 */
	public function set_name($name)
	{
		$this->name = $name;
	}

	/**
	 * @inheritdoc
	 */
	public function get_config($data)
	{
		return array();
	}
}
