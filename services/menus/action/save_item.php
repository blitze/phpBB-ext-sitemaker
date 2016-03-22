<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\menus\action;

class save_item extends base_action
{
	public function execute()
	{
		$item_id = $this->request->variable('item_id', 0);

		$item_mapper = $this->mapper_factory->create('menus', 'items');

		$condition = array(
			array('item_id', '=', $item_id),
		);

		if (($entity = $item_mapper->load($condition)) === null)
		{
			throw new \blitze\sitemaker\exception\out_of_bounds('MENU_ITEM_NOT_FOUND');
		}

		$entity->set_item_title($this->request->variable('item_title', '', true))
			->set_item_url($this->request->variable('item_url', ''))
			->set_item_target($this->request->variable('item_target', 0));

		$item_mapper->save($entity);

		return $entity->to_array();
	}
}
