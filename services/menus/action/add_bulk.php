<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\menus\action;

class add_bulk extends base_action
{
	/**
	 * {@inheritdoc}
	 * @throws \blitze\sitemaker\exception\out_of_bounds
	 */
	public function execute()
	{
		$menu_id = $this->request->variable('menu_id', 0);
		$parent_id = $this->request->variable('parent_id', 0);
		$bulk_list = $this->request->variable('add_list', '', true);

		$menu_mapper = $this->mapper_factory->create('menus');
		$items_mapper = $this->mapper_factory->create('items');

		if ($menu_mapper->load(array('menu_id', '=', $menu_id)) === null)
		{
			throw new \blitze\sitemaker\exception\out_of_bounds('menu_id');
		}

		/** @type \blitze\sitemaker\model\mapper\items $items_mapper */
		$collection = $items_mapper->add_items($menu_id, $parent_id, $bulk_list);

		return $this->get_items($collection);
	}
}
