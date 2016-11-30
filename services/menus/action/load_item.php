<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\menus\action;

class load_item extends base_action
{
	/**
	 * {@inheritdoc}
	 * @throws \blitze\sitemaker\exception\out_of_bounds
	 */
	public function execute()
	{
		$item_id = $this->request->variable('item_id', 0);

		$item_mapper = $this->mapper_factory->create('items');

		if (($entity = $item_mapper->load(array('item_id', '=', $item_id))) === null)
		{
			throw new \blitze\sitemaker\exception\out_of_bounds('item_id');
		}

		return $entity->to_array();
	}
}
