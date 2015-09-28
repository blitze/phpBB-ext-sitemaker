<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model\menu\entity;

use blitze\sitemaker\model\base_entity;

/**
 * @method integer get_item_id()
 * @method object set_menu_id($menu_id)
 * @method integer get_menu_id()
 * @method object set_group_id($group_id)
 * @method integer get_group_id()
 * @method object set_parent_id($parent_id)
 * @method integer get_parent_id()
 * @method string get_item_title()
 * @method string get_item_url()
 * @method object set_item_icon($item_icon)
 * @method string get_item_icon()
 * @method object set_item_desc($item_desc)
 * @method string get_item_desc()
 * @method object set_item_target($item_target)
 * @method integer get_item_target()
 * @method object set_item_status($item_status)
 * @method integer get_item_status()
 * @method object set_left_id($left_id)
 * @method integer get_left_id()
 * @method object set_right_id($right_id)
 * @method integer get_right_id()
 * @method object set_depth($depth)
 * @method integer get_depth()
 */
final class item extends base_entity
{
	/** @var integer */
	protected $item_id;

	/** @var integer */
	protected $menu_id;

	/** @var integer */
	protected $group_id = 0;

	/** @var integer */
	protected $parent_id = 0;

	/** @var string */
	protected $item_title = '';

	/** @var string */
	protected $item_url = '';

	/** @var string */
	protected $item_icon = '';

	/** @var string */
	protected $item_desc = '';

	/** @var integer */
	protected $item_target = 0;

	/** @var integer */
	protected $item_status = 0;

	/** @var integer */
	protected $left_id = 0;

	/** @var integer */
	protected $right_id = 0;

	/** @var integer */
	protected $depth = 0;

	/**
	 * Set block ID
	 */
	public function set_item_id($item_id)
	{
		if (!$this->item_id)
		{
			$this->item_id = (int) $item_id;
		}
		return $this;
	}

	public function set_item_title($item_title)
	{
		$this->item_title = ucwords(trim($item_title));
		return $this;
	}

	public function set_item_url($item_url)
	{
		$this->item_url = $this->sanitize_url($item_url);
		return $this;
	}

	private function sanitize_url($url)
	{
		$board_url = generate_board_url();
		$url = ltrim(str_replace($board_url, '', $url), './');
		$parts = parse_url($url);

		if ($url && empty($parts['host']) && strpos($parts['path'], '.') === false)
		{
			$url = 'app.php/' . $url;
		}

		return $url;
	}
}
