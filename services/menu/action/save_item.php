<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\menu\action;

class save_item extends base_action
{
	public function execute()
	{
		$item_id = $this->request->variable('item_id', 0);

		if (!$item_id)
		{
			return array('errors' => $this->user->lang('MENU_ITEM_NOT_FOUND'));
		}

		$item_mapper = $this->mapper_factory->create('menu', 'items');

		if (($entity = $item_mapper->load(array('item_id' => $item_id))) === null)
		{
			return array('errors' => $this->user->lang('MENU_ITEM_NOT_FOUND'));
		}

		$entity->set_item_title($this->request->variable('item_title', '', true))
			->set_item_url($this->request->variable('item_url', ''))
			->set_item_target($this->request->variable('item_target', 0))
			->set_item_status($this->request->variable('item_status', 1));

		return $item_mapper->save($entity);
	}
}
