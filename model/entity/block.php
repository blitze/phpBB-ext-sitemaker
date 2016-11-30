<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model\entity;

use blitze\sitemaker\model\base_entity;

/**
 * @method int get_bid()
 * @method object set_icon($icon)
 * @method string get_icon()
 * @method object set_name($name)
 * @method string get_name()
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
 * @method object set_hide_title(boolean $hide_title)
 * @method boolean get_hide_title()
 * @method object set_hash($hash)
 * @method string get_hash()
 * @method object set_view($view)
 * @method boolean get_view()
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
	protected $route_id = 0;

	/** @var string */
	protected $position = '';

	/** @var integer */
	protected $weight = 0;

	/** @var integer */
	protected $style = 0;

	/** @var string */
	protected $permission = '';

	/** @var string */
	protected $class = '';

	/** @var boolean */
	protected $status = true;

	/** @var integer */
	protected $type = 0;

	/** @var boolean */
	protected $hide_title = false;

	/** @var string */
	protected $hash = '';

	/** @var string */
	protected $settings = '';

	/** @var string */
	protected $view = '';

	/** @var array */
	protected $required_fields = array('name', 'route_id', 'position', 'style');

	/** @var array */
	protected $db_fields = array(
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
		'hide_title',
		'hash',
		'settings',
		'view',
	);

	/**
	 * Set block ID
	 * @param int $bid
	 * @return $this
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
	 * Set title
	 * @param string $title
	 * @return $this
	 */
	public function set_title($title)
	{
		$this->title = utf8_ucfirst(trim($title));
		return $this;
	}

	/**
	 * Set css class
	 * @param string $class
	 * @return $this
	 */
	public function set_class($class)
	{
		$this->class = ($class) ? ' ' . trim($class) : '';
		return $this;
	}

	/**
	 * Set permissions
	 * @param array|string $permission
	 * @return $this
	 */
	public function set_permission($permission)
	{
		$this->permission = is_array($permission) ? join(',', array_filter($permission)) : $permission;
		return $this;
	}

	/**
	 * Get permissions
	 * @return array
	 */
	public function get_permission()
	{
		return array_map('intval', array_filter(explode(',', $this->permission)));
	}

	/**
	 * Set settings
	 * @param array|string $settings
	 * @return $this
	 */
	public function set_settings($settings)
	{
		if (!is_array($settings))
		{
			$this->settings = $settings;
		}
		else if (sizeof($settings))
		{
			$this->settings = json_encode($settings);
			$this->hash = md5($this->settings);
		}
		return $this;
	}

	/**
	 * Get settings
	 * @return array
	 */
	public function get_settings()
	{
		return ($this->settings) ? json_decode($this->settings, true) : array();
	}

	/**
	 *
	 */
	public function __clone()
	{
		$this->bid = null;
	}
}
