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
	public function execute()
	{
		$menu_id = $this->request->variable('menu_id', 0);

		if (!$menu_id)
		{
			return array('errors' => $this->user->lang('MENU_NOT_FOUND'));
		}

		$menu_mapper = $this->mapper_factory->create('menus', 'menus');
		$items_mapper = $this->mapper_factory->create('menus', 'items');

		if ($menu_mapper->load(array('menu_id' => $menu_id)) === null)
		{
			return array('errors' => $this->user->lang('MENU_NOT_FOUND'));
		}

		$entity = $items_mapper->create_entity(array(
			'menu_id'	=> $menu_id,
		));

		return $items_mapper->save($entity);
	}
}
