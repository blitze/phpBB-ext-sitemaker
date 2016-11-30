<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\menus\action;

class load_items extends base_action
{
	/**
	 * {@inheritdoc}
	 * @throws \blitze\sitemaker\exception\out_of_bounds
	 */
	public function execute()
	{
		$menu_id = $this->request->variable('menu_id', 0);

		if ($menu_id)
		{
			$menu_mapper = $this->mapper_factory->create('menus');

			/** @type \blitze\sitemaker\model\entity\menu $entity */
			if (($entity = $menu_mapper->load(array('menu_id', '=', $menu_id))) === null)
			{
				throw new \blitze\sitemaker\exception\out_of_bounds('menu_id');
			}

			$collection = $entity->get_items();

			return $this->get_items($collection);
		}

		return array(
			'items' => array()
		);
	}
}
