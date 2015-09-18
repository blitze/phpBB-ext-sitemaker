<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model\blocks\entity;

use blitze\sitemaker\model as model;

final class block extends model\base_entity
{
	/** @var integer */
	protected $bid;

	/** @var string */
	protected $icon = '';

	/** @var string */
	protected $name = '';

	/** @var string */
	protected $title = '';

	/** @var integer */
	protected $route_id;

	/** @var string */
	protected $position = '';

	/** @var integer */
	protected $weight = 0;

	/** @var integer */
	protected $style;

	/** @var string */
	protected $permission = '';

	/** @var string */
	protected $class = '';

	/** @var boolean */
	protected $status = true;

	/** @var integer */
	protected $type = 0;

	/** @var boolean */
	protected $no_wrap = false;

	/** @var boolean */
	protected $hide_title = false;

	/** @var string */
	protected $hash = '';

	/** @var string */
	protected $settings = '';

	/**
	 * Set block ID
	 */
	public function set_bid($bid)
	{
		if (!$this->bid)
		{
			$this->bid = (int) $bid;
		}
		return $this;
	}

	/**
	 * Set css class
	 */
	public function set_class($class)
	{
		$this->class = ($class) ? ' ' . $class : '';
		return $this;
	}

	/**
	 * Set permissions
	 */
	public function set_permission($permission)
	{
		$this->permission = is_array($permission) ? join(',', array_filter($permission)) : $permission;
		return $this;
	}

	/**
	 * Get permissions
	 */
	public function get_permission()
	{
		return array_filter(explode(',', $this->permission));
	}

	/**
	 * Set settings
	 */
	public function set_settings($settings)
	{
		$this->settings = is_array($settings) ? serialize($settings) : $settings;
		return $this;
	}

	/**
	 * Get settings
	 */
	public function get_settings()
	{
		return unserialize(stripslashes($this->settings));
	}

	public function __clone()
	{
		$this->bid = null;
	}
}
