<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\menus\action;

class save_tree extends base_action
{
	/**
	 * {@inheritdoc}
	 * @throws \blitze\sitemaker\exception\out_of_bounds
	 */
	public function execute()
	{
		$menu_id = $this->request->variable('menu_id', 0);
		$raw_tree = $this->request->variable('tree', array(0 => array('' => 0)));

		/** @type \blitze\sitemaker\model\mapper\items $item_mapper */
		$item_mapper = $this->mapper_factory->create('items');
		$menu_mapper = $this->mapper_factory->create('menus');

		if ($menu_mapper->load(array('menu_id', '=', $menu_id)) === null)
		{
			throw new \blitze\sitemaker\exception\out_of_bounds('menu_id');
		}

		$tree = $this->prepare_tree($raw_tree);

		return $item_mapper->update_items($menu_id, $tree);
	}

	/**
	 * @param array $raw_tree
	 * @return array
	 */
	protected function prepare_tree(array $raw_tree)
	{
		$tree = array();
		$raw_tree = array_values($raw_tree);

		for ($i = 0, $size = sizeof($raw_tree); $i < $size; $i++)
		{
			$item_id = (int) $raw_tree[$i]['item_id'];
			$parent_id = (int) $raw_tree[$i]['parent_id'];

			if ($item_id)
			{
				$tree[$item_id] = array(
					'item_id'	=> $item_id,
					'parent_id' => $parent_id,
				);
			}
		}

		return $tree;
	}
}
