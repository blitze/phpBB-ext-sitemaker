<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\menus\action;

class add_item extends base_action
{
	/**
	 * {@inheritdoc}
	 * @throws \blitze\sitemaker\exception\out_of_bounds
	 */
	public function execute()
	{
		$menu_id = $this->request->variable('menu_id', 0);

		$menu_mapper = $this->mapper_factory->create('menus');
		$items_mapper = $this->mapper_factory->create('items');

		if ($menu_mapper->load(array('menu_id', '=', $menu_id)) === null)
		{
			throw new \blitze\sitemaker\exception\out_of_bounds('menu_id');
		}

		$entity = $items_mapper->create_entity(array(
			'menu_id'		=> $menu_id,
			'item_title'	=> $this->request->variable('item_title', '', true),
			'item_url'		=> $this->request->variable('item_url', ''),
			'item_target'	=> $this->request->variable('item_target', 0),
		));

		/** @var \blitze\sitemaker\model\entity\item $entity */
		$entity = $items_mapper->save($entity);

		return $entity->to_array();
	}
}
