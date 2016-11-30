<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\menus\action;

class add_menu extends base_action
{
	/**
	 * {@inheritdoc}
	 */
	public function execute()
	{
		$menu_mapper = $this->mapper_factory->create('menus');

		/** @type \blitze\sitemaker\model\entity\menu $entity */
		$entity = $menu_mapper->create_entity(array(
			'menu_name' => $this->translator->lang('MENU') . '-' . mt_rand(1000, 9999),
		));

		$entity = $menu_mapper->save($entity);

		return array(
			'id'	=> $entity->get_menu_id(),
			'title'	=> $entity->get_menu_name(),
		);
	}
}
