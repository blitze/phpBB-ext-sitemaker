<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model\blocks\entity;

use blitze\sitemaker\model\base_entity;

/**
 * @method object set_icon($icon)
 * @method string get_icon()
 * @method object set_name($name)
 * @method string get_name()
 * @method object set_title($title)
 * @method string get_title()
 * @method object set_route_id(integer $route_id)
 * @method integer get_route_id()
 * @method object set_position($position)
 * @method string get_position()
 * @method object set_weight(integer $weight)
 * @method integer get_weight()
 * @method object set_style(integer $style)
 * @method integer get_style()
 * @method object set_status(boolean $status)
 * @method boolean get_status()
 * @method object set_type(integer $type)
 * @method integer get_type()
 * @method object set_no_wrap(boolean $no_wrap)
 * @method boolean get_no_wrap()
 * @method object set_hide_title(boolean $hide_title)
 * @method boolean get_hide_title()
 * @method object set_hash($hash)
 * @method string get_hash()
 */
final class block extends base_entity
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

	/** @var array */
	protected $db_fields = array(
		'bid',
		'icon',
		'name',
		'title',
		'route_id',
		'position',
		'weight',
		'style',
		'permission',
		'class',
		'status',
		'type',
		'no_wrap',
		'hide_title',
		'hash',
		'settings'
	);

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
		return ($this->settings) ? unserialize(stripslashes($this->settings)) : array();
	}

	public function __clone()
	{
		$this->bid = null;
	}
}
