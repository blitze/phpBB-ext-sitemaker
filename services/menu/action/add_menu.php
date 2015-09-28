<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\menu\action;

class add_menu extends base_action
{
	public function execute()
	{
		$entity = new \blitze\sitemaker\model\menu\entity\menu(array(
			'menu_name' => $this->user->lang('MENU') . '-' . mt_rand(1000, 9999),
		));

		$menu_mapper = $this->mapper_factory->create('menu', 'menus');
		$entity = $menu_mapper->save($entity);

		return array(
			'id'	=> $entity->get_menu_id(),
			'title'	=> $entity->get_menu_name(),
		);
	}
}
