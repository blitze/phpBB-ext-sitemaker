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
 * @method integer get_item_id()
 * @method object set_menu_id($menu_id)
 * @method integer get_menu_id()
 * @method object set_parent_id($parent_id)
 * @method integer get_parent_id()
 * @method string get_item_title()
 * @method string get_item_url()
 * @method string get_item_icon()
 * @method object set_item_target($item_target)
 * @method integer get_item_target()
 * @method object set_left_id($left_id)
 * @method integer get_left_id()
 * @method object set_right_id($right_id)
 * @method integer get_right_id()
 * @method object item_parents($item_parents)
 * @method integer get_item_parents()
 * @method object set_depth($depth)
 * @method integer get_depth()
 */
final class item extends base_entity
{
	/** @var integer */
	protected $item_id;

	/** @var integer */
	protected $menu_id = 0;

	/** @var integer */
	protected $parent_id = 0;

	/** @var string */
	protected $item_title = '';

	/** @var string */
	protected $item_url = '';

	/** @var string */
	protected $item_icon = '';

	/** @var integer */
	protected $item_target = 0;

	/** @var integer */
	protected $left_id = 0;

	/** @var integer */
	protected $right_id = 0;

	/** @var string */
	protected $item_parents = '';

	/** @var integer */
	protected $depth = 0;

	/** @var string */
	protected $full_url = '';

	/** @var string */
	protected $board_url;

	/** @var boolean */
	protected $mod_rewrite_enabled;

	/** @var array */
	protected $required_fields = array('menu_id', 'item_title');

	/** @var array */
	protected $db_fields = array(
		'item_id',
		'menu_id',
		'parent_id',
		'item_title',
		'item_url',
		'item_icon',
		'item_target',
		'left_id',
		'right_id',
		'item_parents',
		'depth',
	);

	/**
	 * Class constructor
	 * @param array $data
	 * @param bool  $mod_rewrite_enabled
	 */
	public function __construct(array $data, $mod_rewrite_enabled = false)
	{
		$this->board_url = generate_board_url();
		$this->mod_rewrite_enabled = $mod_rewrite_enabled;

		parent::__construct($data);
	}

	/**
	 * Set block ID
	 * @param int $item_id
	 * @return $this
	 */
	public function set_item_id($item_id)
	{
		if (!$this->item_id)
		{
			$this->item_id = (int) $item_id;
		}
		return $this;
	}

	/**
	 * @param string $item_title
	 * @return $this
	 */
	public function set_item_title($item_title)
	{
		$this->item_title = utf8_ucfirst(trim($item_title));
		return $this;
	}

	/**
	 * @param string $icon
	 * @return $this
	 */
	public function set_item_icon($icon)
	{
		$this->item_icon = ($icon) ? trim($icon) . ' ' : '';
		return $this;
	}

	/**
	 * @param string $item_url
	 * @return $this
	 */
	public function set_item_url($item_url)
	{
		$search = array('&amp;', $this->board_url);
		$replace = array('&', '');
		$this->item_url = str_replace($search, $replace, $item_url);

		// add leading / for local paths, except leading hashtags
		if ($this->is_local($this->item_url) && $this->item_url[0] !== '#')
		{
			$this->item_url = '/' . ltrim($this->item_url, './');
		}

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_full_url()
	{
		$item_url = $this->item_url;

		if ($this->is_local($item_url) && $item_url[0] === '/')
		{
			$item_url = $this->board_url . $item_url;
			if ($this->mod_rewrite_enabled)
			{
				$item_url = str_replace('app.php/', '', $item_url);
			}
		}

		return $item_url;
	}

	/**
	 * @param string $item_url
	 * @return true|false
	 */
	private function is_local($item_url)
	{
		$host = parse_url($item_url, PHP_URL_HOST);
		return (!$item_url || !empty($host) || substr($item_url, 0, 2) === '//') ? false: true;
	}
}
