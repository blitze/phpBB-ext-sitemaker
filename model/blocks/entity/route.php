<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model\blocks\entity;

use blitze\sitemaker\model\base_entity;

/**
 * @method object set_ext_name($ext_name)
 * @method string get_ext_name()
 * @method object set_route($route)
 * @method string get_route()
 * @method object set_style($style)
 * @method integer get_style()
 * @method object set_hide_blocks($hide_blocks)
 * @method boolean get_hide_blocks()
 * @method object set_has_blocks($has_blocks)
 * @method boolean get_has_blocks()
 * @method object set_blocks(\blitze\sitemaker\model\blocks\collections\blocks $blocks)
 * @method \blitze\sitemaker\model\blocks\collections\blocks get_blocks()
 */
final class route extends base_entity
{
	/** @var integer */
	protected $route_id;

	/** @var string */
	protected $ext_name = '';

	/** @var string */
	protected $route = '';

	/** @var integer */
	protected $style = 0;

	/** @var boolean */
	protected $hide_blocks = false;

	/** @var boolean */
	protected $has_blocks = false;

	/** @var string */
	protected $ex_positions = '';

	/** @var \blitze\sitemaker\model\blocks\collections\blocks */
	protected $blocks = array();

	/**
	 * Set route ID
	 */
	public function set_route_id($route_id)
	{
		if (!$this->route_id)
		{
			$this->route_id = (int) $route_id;
		}
		return $this;
	}

	/**
	 * Set excluded positions
	 */
	public function set_ex_positions($ex_positions)
	{
		$this->ex_positions = is_array($ex_positions) ? join(',', array_filter($ex_positions)) : $ex_positions;
		return $this;
	}

	/**
	 * Get excluded positions
	 */
	public function get_ex_positions()
	{
		return array_filter(explode(',', $this->ex_positions));
	}

	public function __clone()
	{
		$this->route_id = null;
	}
}
