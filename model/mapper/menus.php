<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\model\mapper;

use blitze\sitemaker\model\base_mapper;

class menus extends base_mapper
{
	/** @var string */
	protected $entity_class = 'blitze\sitemaker\model\entity\menu';

	/** @var string */
	protected $entity_pkey = 'menu_id';

	/**
	 * {@inheritdoc}
	 */
	public function load(array $condition = array())
	{
		/** @type \blitze\sitemaker\model\entity\menu|null $entity */
		$entity = parent::load($condition);

		if ($entity)
		{
			$items_mapper = $this->mapper_factory->create('items');

			/** @type \blitze\sitemaker\model\collections\items $collection */
			$collection = $items_mapper->find(array('%smenu_id', '=', $entity->get_menu_id()));
			$entity->set_items($collection);
		}

		return $entity;
	}

	/**
	 * @param array|\blitze\sitemaker\model\entity\menu $condition
	 */
	public function delete($condition)
	{
		parent::delete($condition);

		// delete menu items associated with this menu
		if ($condition instanceof $this->entity_class)
		{
			$items_mapper = $this->mapper_factory->create('items');
			$items_mapper->delete(array('menu_id', '=', $condition->get_menu_id()));
		}
	}
}
