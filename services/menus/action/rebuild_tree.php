<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\menus\action;

class rebuild_tree extends base_action
{
	public function execute()
	{
		$menu_id = $this->request->variable('menu_id', 0);

		if (!$menu_id)
		{
			return array('errors' => $this->user->lang('MENU_NOT_FOUND'));
		}

		$item_mapper = $this->mapper_factory->create('menus', 'items');

		$item_mapper->reorder_items($menu_id);

		$collection = $item_mapper->find(array(
			'menu_id'	=> $menu_id,
		));

		return $this->_get_items($collection);
	}
}
