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
	public function execute()
	{
		$menu_id = $this->request->variable('menu_id', 0);
		$raw_tree = $this->request->variable('tree', array(0 => array('' => 0)));

		$item_mapper = $this->mapper_factory->create('menus', 'items');

		$tree = array();
		for ($i = 1, $size = sizeof($raw_tree); $i < $size; $i++)
		{
			$row = $raw_tree[$i];
			$tree[$row['item_id']] = array(
				'item_id'	=> (int) $row['item_id'],
				'parent_id' => (int) $row['parent_id'],
			);
		}

		return $item_mapper->update_items($menu_id, $tree);
	}
}
